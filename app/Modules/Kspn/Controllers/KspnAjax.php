<?php namespace App\Modules\Kspn\Controllers;

use App\Modules\Kspn\Models\KspnModel;
use App\Core\BaseController;

class KspnAjax extends BaseController
{
    private $kspnModel;
    private $armadaTipe;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->kspnModel = new KspnModel();
        $this->armadaTipe = 'KSPN';
    }

    public function index()
    {
        return redirect()->to(base_url()); 
    }

    function jsonSearchBusStop() {
        $data = $this->request->getPost();
        $data['paramName'] = strtolower($data['paramName']);
        if(!isset($data['paramName'])){
            $data['paramName'] = 'Terminal Penggaron';
        }
        $param['name'] = "paramName";
        $rs = $this->db->query("select *,MD5(CONCAT_WS('',bs_nm,bs_lat,bs_lng)) as enc from bus_stop where LOWER(bs_nm) like ? limit 10", array('%'.$data['paramName'].'%'));
        $result = array();
        if($rs->getNumRows()>0){
            $result['bus_stop'] = $rs->getResult();
            
        }else{
            
            $rs2 = $this->db->query("select * from nominatim_cache where LOWER(json_data->>\"$[0].display_name\") like ? limit 10", array('%'.$data['paramName'].'%'));
            if($rs2->getNumRows()>0){ 
                foreach($rs2->getResult() as $item){
                    $jsonres = json_decode($item->json_data);

                    #$result['bus_stop'] = json_decode($item->json_data);
                    foreach($jsonres as $item){
                        $display_name = explode(",", $item->display_name);
                        $bs_nm = $display_name[0];
                        $addr = $item->display_name;
                        $result['bus_stop'][] = (object) array("bs_id"=>null,"bs_lat"=>$item->lat,"bs_lng"=>$item->lon,"bs_nm"=>$bs_nm,"addr"=>$addr,"enc"=>md5($bs_nm.$item->lat.$item->lon),"bs_stop" => "1");
                    }
                }
            }else{   
                $result['osm'] = json_decode($this->jsonSearchAllPlace($data));
                $datapost['json_data'] = json_encode($result['osm']);

                $this->db->table("nominatim_cache")->insert($datapost);
                foreach($result['osm'] as $item){
                    $display_name = explode(",", $item->display_name);
                    $bs_nm = $display_name[0];
                    $addr = $item->display_name;
                    $paramcoor = explode(',', $data['paramName']);
                    if(count($paramcoor)==2){
                      #echo count($paramcoor);
                      if($this->is_decimal($paramcoor[0]) && $this->is_decimal($paramcoor[1])){
                        $item->lat = $paramcoor[0];
                        $item->lon = $paramcoor[1];
                        $bs_nm = $item->lat.','.$item->lon;
                      }
                      #echo $this->is_decimal($paramcoor[1]);
                    }
                    $result['bus_stop'][] = (object) array("bs_id"=>null,"bs_lat"=>$item->lat,"bs_lng"=>$item->lon,"bs_nm"=>$bs_nm,"addr"=>$addr,"enc"=>md5($bs_nm.$item->lat.$item->lon),"bs_stop" => "1");
                }
                unset($result['osm']);
            }
            
        }
        echo json_encode($result);
        
    }

    function is_decimal( $val )
    {
        return is_numeric( $val ) && floor( $val ) != $val;
    }

    function jsonSearchAllPlace($data){
        $curl = curl_init();
        $agent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)';

        //$q = $this->request->getPost('paramName');
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://nominatim.openstreetmap.org/search.php?q='.urlencode($data['paramName']).'&countrycodes=id&language=Indonesia&polygon_geojson=1&format=jsonv2',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_USERAGENT => $agent,
          // CURLOPT_REFERER, 'https://www.domain.com/');
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    function jsonRouteById(){
        $route_id = $this->request->getPost('route_id');
        if($this->request->getPost('route_id')==null or $this->request->getPost('route_id')==''){
            $route_id = 483;
        }
        
        $rs = $this->db->query("SELECT a.id , a.name as 'text',a.name,a.origin,a.toward,a.or_lat,a.or_lng,a.tw_lat,a.tw_lng,a.waypoints,a.points,a.routes 
          from fleet_routes a where a.is_deleted=0 and a.id=?",array($route_id));
        $data['route'] = $rs->getResult();
        
        $rs = $this->db->query("select b.*,a.id as route_id,a.routes from fleet_routes a
        inner join bus_stop b on find_in_set(b.bs_id,a.routes)
        where a.id=? order by find_in_set(b.bs_id,a.routes)",array($route_id));
        $data['bus_stop'] = $rs->getResult();
        $latlngs = array();
        foreach($rs->getResult() as $item){
            $latlngs[] = $item->bs_lat.",".$item->bs_lng;
        }
        $latlngs_ = implode("|", $latlngs);
        
        $data['points'] = json_decode($this->jsonGetRoutesfromPoints($latlngs_));
        echo json_encode($data);
    }  

    function jsonGetRoutesfromPoints($points){
        $curl = curl_init();
        if($points==''){
            $points = '110.492726,-7.0177303|110.492726,-7.0177303';
        }
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://gps.brtnusantara.com/dev/api/route?points='.urlencode($points),
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
            'Authorization: Basic bmdpOm5naXJheWE='
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    function jsonGetRoutesfromPoints2($points){
        $curl = curl_init();
        $uri = service('uri');
        //echo $uri->getSegment(3);
        if($uri->getSegment(3)=='' ){
            $points = '110.492726,-7.0177303|110.492726,-7.0177303';
        }
        #http://localhost:8989/route?point=-8.675574%2C115.449547&point=-8.673876%2C115.44905&point=-8.666642%2C115.450778&point=-8.670255%2C115.461632&point=-8.69206%2C115.45#0612&type=json&locale=en-US&key=&elevation=false&profile=car
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://gps.brtnusantara.com/dev/api/route?points='.urlencode($points),
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
            'Authorization: Basic bmdpOm5naXJheWE='
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }

    function kor_select_get(){
        $data = $this->request->getGet();
        $bptd = $this->session->get('bptd_id') != 'all' ? ' and a.bptd_id = "'.$this->session->get('bptd_id').'"' : '';
        $query = "SELECT a.kor as id, concat(a.kor,' (', a.group_nm, ')') as 'text', a.color, a.group_nm, a.name from m_routes a where a.is_deleted='0' and a.jenroute='KSPN' ".$bptd." ";
        $where = ["a.kor", "a.group_nm"];

        parent::_loadSelect2($data, $query, $where, ["a.id asc"]);
        // var_dump($this->db->getLastQuery());
    }

    function groupnm_select_get()
    {
        $data = $this->request->getGet();
        $query = "SELECT a.group_nm as id,a.group_nm as 'text' from m_lokabkota a where a.is_deleted='0' and a.idprov='".$data['idprov']."'  
        and  a.group_nm is not null ";
        $where = ["a.group_nm"];

        parent::_loadSelect2($data, $query, $where);
    }

    function idprov_select_get()
    {
        $data = $this->request->getGet();
        $query = "SELECT a.id , a.prov as 'text',a.singkatan FROM m_lokprov a where a.is_deleted='0'";
        $where = ["a.prov","a.singkatan"];

        parent::_loadSelect2($data, $query, $where);
    }

    public function bptd_select_get() {
        $data = $this->request->getGet();
        $query = "SELECT lokker_id AS id, user_web_name AS 'text' FROM m_user_web WHERE is_deleted = 0 AND user_web_role_id = '4'";
        $where = ["user_web_name"];

        parent::_loadSelect2($data, $query, $where);
    }

    public function trayek_id_select_get()
    {
        $data = $this->request->getGet();
        $query = "SELECT a.id, concat(a.jenroute, ' | ',a.group_nm, ' (', a.name,')') AS 'text', a.color
                    FROM m_routes a 
                    LEFT JOIN m_user_web b ON b.lokker_id = a.bptd_id
                    WHERE a.is_deleted='0' AND a.jenroute = '".$this->armadaTipe."' AND a.bptd_id = '".$data['bptd_id']."'
                    GROUP BY a.kor, a.jenroute
                    ORDER BY a.idprov";
        $where = ["a.group_nm", "a.name", "a.jenroute"];

        parent::_loadSelect2($data, $query, $where);
    }
}
