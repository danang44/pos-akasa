<?php namespace App\Modules\Akap\Controllers;

use App\Modules\Akap\Models\AkapModel;
use App\Core\BaseController;

class AkapAction extends BaseController
{
    private $akapModel;
    private $armadaTipe;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->akapModel = new AkapModel();
        $this->armadaTipe = 'AKAP';
    }

    public function index()
    {
        return redirect()->to(base_url()); 
    }

    function mantripakap_save(){
        parent::_authInsert(function(){
            $this->db->transBegin();
            $data = $this->request->getPost();
            
            $points["0"] = $data["points"];
            $data["points"] = json_encode((object)$points);

            $data["routes"] = implode(",", array_map(function($arr) {
                if($arr["bs_id"] == null){
                    unset($arr['enc']);
                    $this->akapModel->base_insert($arr, "bus_stop");
                    return str_pad($this->db->insertID(), 5, "0", STR_PAD_LEFT);
                }else{
                    $bs_id = $arr['bs_id'];
                    unset($arr['bs_id']);
                    unset($arr['enc']);
                    $this->akapModel->base_update($arr, "bus_stop", ['bs_id' => $bs_id]);
                    return str_pad($bs_id, 5, "0", STR_PAD_LEFT);
                }
            }, $data['routes']));

            if($data['id']==""){
                $this->akapModel->base_insert($data, "fleet_routes");
            }else{
                $this->akapModel->base_update($data, "fleet_routes", ["id" => $data['id']]);
            }

            if ($this->db->transStatus() === FALSE){
                $this->db->transRollback();
                $this->db->transComplete();
                
                echo json_encode(['success' => false, 'message' => $this->db->error(), 'data' => $data]);
            }else{
                $this->db->transCommit();
                $this->db->transComplete();

                echo json_encode(['success' => true]);
            }
        });
    }

    function mantripakap_load(){
        $this->db->query("SET group_concat_max_len=10000");
        // parent::_authLoad(function () {
        //     $bptd = $this->session->get('bptd_id') != 'all' ? ' and b.bptd_id = "'.$this->session->get('bptd_id').'"' : '';
        //     $query = "select a.id,ifnull(b.kor,a.kor) as kor,ifnull(b.jenroute,a.jenroute) as jenroute,ifnull(b.group_nm,a.group_nm) as group_nm,a.name,a.origin,a.toward,GROUP_CONCAT(c.bs_nm  order by a.kor,a.id,find_in_set(c.bs_id,a.routes) SEPARATOR '-')  as trip
        //     from fleet_routes a
        //     left join m_routes b on a.kor=b.kor
        //     left join bus_stop c on find_in_set(c.bs_id,a.routes)
        //     where a.is_deleted=0 and (b.jenroute='".$this->armadaTipe."' OR a.jenroute='".$this->armadaTipe."') and c.bs_stop = 1 ".$bptd."
        //     ";
        //     $where = ["a.kor","b.jenroute","a.name","a.origin","a.toward"];

        //     parent::_loadDatatable($query, $where, $this->request->getPost(), ["a.id"]);
        // });
        parent::_authLoad(function () {
            $filter = $this->request->getPost('filter');
            $idbptd = isset($filter['bptd_id']) ? $filter['bptd_id'] : '';
            $idtrayek = isset($filter['route_id']) ? $filter['route_id'] : '';

            if (!empty($idbptd) ) {
                if(!empty($idtrayek)){
                    $bptd = ' AND b.bptd_id = "' . $filter['bptd_id'] . '" AND b.id = "' . $filter['route_id'] . '"';
                } else {
                    $bptd = ' AND b.bptd_id = "' . $filter['bptd_id'] . '" ';
                }
            } else {
                if(!empty($idtrayek)){
                    $bptd = $this->session->get('bptd_id') != 'all' ? ' AND b.bptd_id = "' . $this->session->get('bptd_id') . '" AND b.id = "' . $filter['route_id'] . '" ' : '';
                } else {
                    $bptd = $this->session->get('bptd_id') != 'all' ? ' AND b.bptd_id = "' . $this->session->get('bptd_id') . '" ' : '';
                }
            }

            $query = "SELECT a.id,ifnull(b.kor,a.kor) AS kor,ifnull(b.jenroute,a.jenroute) AS jenroute,ifnull(b.group_nm,a.group_nm) AS group_nm,a.name,a.origin,a.toward,GROUP_CONCAT(c.bs_nm  ORDER BY a.kor,a.id,find_in_set(c.bs_id,a.routes) SEPARATOR '-')  AS trip
                        FROM fleet_routes a
                        LEFT JOIN m_routes b ON a.kor=b.kor
                        LEFT JOIN bus_stop c ON find_in_set(c.bs_id,a.routes)
                        WHERE a.is_deleted = 0 AND (b.jenroute='" . $this->armadaTipe . "' OR a.jenroute='" . $this->armadaTipe . "') AND c.bs_stop = 1 $bptd";
            $where = ["a.kor", "b.jenroute", "a.name", "a.origin", "a.toward"];

            parent::_loadDatatable($query, $where, $this->request->getPost(), ["a.id"]);
        });
    }

    function mantripakap_edit(){
        $this->db->query("SET group_concat_max_len=10000");
        parent::_authEdit(function(){
            $ret = array();
            $rs = $this->db->query("select a.id,a.kor,concat(c.kor,' - ', c.group_nm) as 'text',c.color,c.group_nm,c.jenroute,a.name,a.or_lat,a.or_lng,a.origin
            ,a.points
            ,CAST(CONCAT('[',GROUP_CONCAT(JSON_OBJECT('bs_id',LPAD(b.bs_id,5,'0'),'bs_nm',b.bs_nm,'bs_lat',b.bs_lat,'bs_lng',b.bs_lng,'addr',b.addr,'bs_stop',b.bs_stop,'enc',MD5(CONCAT_WS('',b.bs_nm,b.bs_lat,b.bs_lng)))
            ORDER BY a.id,find_in_set(b.bs_id,a.routes)
            )
            ,']') AS JSON) as routes,
            a.toward,a.tw_lat,a.tw_lng
            from fleet_routes a
            LEFT join bus_stop b on find_in_set(b.bs_id,a.routes)
            LEFT join m_routes c on a.kor = c.kor
            where a.id=? and (c.jenroute='".$this->armadaTipe."' OR a.jenroute='".$this->armadaTipe."')
            GROUP BY a.id
            order by a.id,find_in_set(b.bs_id,a.routes)",array($this->request->getPost('id')));

            if($rs->getNumRows()>0){
                $ret['success'] = 1;
                $ret['data']    = $rs->getRow();
            }else{
                $ret['success'] = 0;
                $ret['data']    = null;
            }

            echo json_encode($ret);
        });
    }

    function mantripakap_detail(){
        $this->db->query("SET group_concat_max_len=10000");
        parent::_authDetail(function(){
            $ret = array();
            $rs = $this->db->query("select a.id,a.kor,concat(c.kor,' - ', c.group_nm) as 'text',c.color,c.group_nm,c.jenroute,a.name,a.or_lat,a.or_lng,a.origin
            ,a.points
            ,CAST(CONCAT('[',GROUP_CONCAT(JSON_OBJECT('bs_id',LPAD(b.bs_id,5,'0'),'bs_nm',b.bs_nm,'bs_lat',b.bs_lat,'bs_lng',b.bs_lng,'addr',b.addr,'bs_stop',b.bs_stop,'enc',MD5(CONCAT_WS('',b.bs_nm,b.bs_lat,b.bs_lng)))
            ORDER BY a.id,find_in_set(b.bs_id,a.routes)
            )
            ,']') AS JSON) as routes,
            a.toward,a.tw_lat,a.tw_lng
            from fleet_routes a
            LEFT join bus_stop b on find_in_set(b.bs_id,a.routes)
            LEFT join m_routes c on a.kor = c.kor
            where a.id=? and (c.jenroute='".$this->armadaTipe."' OR a.jenroute='".$this->armadaTipe."')
            GROUP BY a.id
            order by a.id,find_in_set(b.bs_id,a.routes)",array($this->request->getPost('id')));

            if($rs->getNumRows()>0){
                $ret['success'] = 1;
                $ret['data']    = $rs->getRow();
            }else{
                $ret['success'] = 0;
                $ret['data']    = null;
            }

            echo json_encode($ret);
        });
    }

    function mantripakap_delete()
    {
        parent::_authDelete(function () {
            parent::_delete('fleet_routes', $this->request->getPost());
        });
    }

    function manrute_load()
    {
        parent::_authLoad(function () {
            $bptd = $this->session->get('bptd_id') != 'all' ? ' and a.bptd_id = "'.$this->session->get('bptd_id').'"' : '';
            $query = "select a.*, b.terminal_name from m_routes a 
            left join m_lokker b on a.bptd_id = b.id
            where a.is_deleted = 0 and a.jenroute = '".$this->armadaTipe."' ".$bptd."";
            $where = ["a.kor", "a.group_nm", "a.jenroute"];

            parent::_loadDatatable($query, $where, $this->request->getPost());
        });
    }

    function manrute_save()
    {
        parent::_authInsert(function () {
            $data = $this->request->getPost();
            $data["jenroute"] = $this->armadaTipe;
            $data["bptd_id"] = $this->session->get('bptd_id');
            parent::_insert('m_routes', $data);
        });
    }

    function manrute_edit()
    {
        parent::_authEdit(function () {
            $this->db->query("SET group_concat_max_len=10000");
            $ret = array();
            $rs = $this->db->query("select a.*,b.prov from m_routes a
                left join m_lokprov b on a.idprov=b.id
            where a.id=?
            GROUP BY a.id
            order by a.id",array($this->request->getPost('id')));

            if($rs->getNumRows()>0){
                $ret['success'] = 1;
                $ret['data']    = $rs->getRow();
            }else{
                $ret['success'] = 0;
                $ret['data']    = null;
            }

            echo json_encode($ret);
            // parent::_edit('m_routes', $this->request->getPost());
        });
    }

    function manrute_delete()
    {
        parent::_authDelete(function () {
            parent::_delete('m_routes', $this->request->getPost());
        });
    }
}
