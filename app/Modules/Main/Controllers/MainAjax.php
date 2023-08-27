<?php

namespace App\Modules\Main\Controllers;

use App\Modules\Main\Models\MainModel;
use App\Core\BaseController;
use r;

class MainAjax extends BaseController
{
	private $mainModel;

	/**
	 * Constructor.
	 */
	public function __construct()
	{
		$this->mainModel = new MainModel();
	}

	public function index()
	{
		return redirect()->to(base_url());
	}

	function vehiclesLastPosition0()
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://vtsapi.easygo-gps.co.id/api/Report/lastposition',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => '{
		  "list_nopol": [],
		  "list_no_aset": [],
		  "status_vehicle": 0,
		  "geo_code": [],
		  "page": 0,
		  "encrypted": 0
		}',
			CURLOPT_HTTPHEADER => array(
				'Accept: application/json',
				'token: D0D2EA20A4A74F469E49910F3056D99A',
				'Content-Type: application/json'
			),
		));

		$response = curl_exec($curl);


		curl_close($curl);

		$responseArray = json_decode($response);
		$fields = array("gps_sn", "group_nm", "nopol", "company_nm", "direction", "stime", "lat", "lon", "acc", "battery_percent", "driver_nm", "speed", "no_aset", "car_type", "gps_time");
		$obj1 = new \stdClass;
		$dataArray = array();
		if ($responseArray->ResponseCode == 1) {
			foreach ($responseArray->Data as $key => $item) {
				$dataArray[$key]['id'] = $item->gps_sn;
				foreach ($item as $key2 => $value) {
					if (in_array($key2, $fields)) {
						$dataArray[$key][$key2] = $value;
					}
				}
			}
			$this->toRethink2("armada", $dataArray);
		}
		echo $response;
	}


	function toRethink2($table, $dataArray)
	{
		$curl = curl_init();
		$datapost['key']    = 'ngiraya';
		$datapost['table']  = $table;
		$datapost['data']   = $dataArray;

		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://stream.nginovasi.id:5002/api/listener',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => json_encode($datapost),
			CURLOPT_HTTPHEADER => array(
				'Authorization: Basic aHViZGF0Ok51c2FudGFyYTQw',
				'Content-Type: application/json'
			),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		echo $response;
	}


	function vehiclesLastPosition1()
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://vtsapi.easygo-gps.co.id/api/Report/lastposition',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => '{
		  "list_nopol": [],
		  "list_no_aset": [],
		  "status_vehicle": 1,
		  "geo_code": [],
		  "page": 0,
		  "encrypted": 0
		}',
			CURLOPT_HTTPHEADER => array(
				'Accept: application/json',
				'token: D0D2EA20A4A74F469E49910F3056D99A',
				'Content-Type: application/json'
			),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		$responseArray = json_decode($response);
		$fields = array("gps_sn", "group_nm", "nopol", "company_nm", "direction", "stime", "lat", "lon", "acc", "battery_percent", "driver_nm", "speed", "no_aset", "car_type", "gps_time");
		$obj1 = new \stdClass;
		$dataArray = array();
		if ($responseArray->ResponseCode == 1) {
			foreach ($responseArray->Data as $key => $item) {
				$dataArray[$key]['id'] = $item->gps_sn;
				foreach ($item as $key2 => $value) {
					if (in_array($key2, $fields)) {
						$dataArray[$key][$key2] = $value;
					}
				}
			}
			$this->toRethink2("armada", $dataArray);
		}
		echo $response;
	}

	function vehiclesLastPosition2()
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://vtsapi.easygo-gps.co.id/api/Report/lastposition',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => '{
		  "list_nopol": [],
		  "list_no_aset": [],
		  "status_vehicle": 2,
		  "geo_code": [],
		  "page": 0,
		  "encrypted": 0
		}',
			CURLOPT_HTTPHEADER => array(
				'Accept: application/json',
				'token: D0D2EA20A4A74F469E49910F3056D99A',
				'Content-Type: application/json'
			),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		$responseArray = json_decode($response);
		$fields = array("gps_sn", "group_nm", "nopol", "company_nm", "direction", "stime", "lat", "lon", "acc", "battery_percent", "driver_nm", "speed", "no_aset", "car_type", "gps_time");
		$obj1 = new \stdClass;
		$dataArray = array();
		if ($responseArray->ResponseCode == 1) {
			foreach ($responseArray->Data as $key => $item) {
				$dataArray[$key]['id'] = $item->gps_sn;
				foreach ($item as $key2 => $value) {
					if (in_array($key2, $fields)) {
						$dataArray[$key][$key2] = $value;
					}
				}
			}
			//$this->toRethink($dataArray);
			$this->toRethink2("armada", $dataArray);
		}
		echo $response;
	}


	function saveroutes()
	{
		// $db2 = db_connect('hubdat');
		// $query = $db2->query("select * from m_trayek limit 0,10");
		$result = json_decode($_REQUEST['jsondata']);
		$query = $this->db->table('fleet_routes')->upsertBatch($result);
	}

	function jsonroutes()
	{
		$rs = $this->db->query("select a.id,a.name,a.jenroute,a.origin,a.toward from fleet_routes a");
		echo json_encode($rs->getResult());
	}

	function jsonrestarea()
	{
		$rs = $this->db2->query("select * from m_rest_area where rest_area_latlong_nominatim!='' order by id");
		echo json_encode($rs->getResult());
	}

	function jsonposko()
	{
		$rs = $this->db2->query("select *, 'posko' as type, if(count(um.id) > 0,json_arrayagg(json_object('id',um.id,
								'name',uw.user_web_name,
								'type',um.user_mobile_type,
								'pic',um.user_mobile_photo,
								'status',IF(abs.id IS NULL,'offline',a.posko_mudik_name))), json_array()) as petugas
								FROM m_posko_mudik a
								left join m_jadwal_posko jp on a.id = jp.posko_id and jp.tgl_tugas=curdate() and jp.is_deleted = 0 
								left join m_user_web uw on jp.user_id = uw.id
								left join m_user_mobile um on uw.user_mobile_id = um.id
								left join t_absensi_internal abs on jp.user_id = abs.user_id and date(abs.created_at)=curdate() 
								where a.posko_mudik_latlong!='' and a.is_deleted = 0 group by a.id order by a.id");
		echo json_encode($rs->getResult());
	}

	function jsonresto()
	{
		$rs = $this->db2->query("select * from m_resto_mudik where resto_mudik_latlong!='' order by id");
		echo json_encode($rs->getResult());
	}

	function jsonwisata()
	{
		$rs = $this->db2->query("select * from m_wisata_mudik where wisata_mudik_latlong!='' order by id");
		echo json_encode($rs->getResult());
	}

	function jsonsinggah()
	{
		$rs = $this->db2->query("select a.*, concat('https://mitradarat.dephub.go.id/',b.marker) as icon,
		  'singgah' as type
		  from m_tempat_singgah a
		  inner join m_kategori_tempat b on b.id = a.kategori_tempat_id
		  where a.tempat_singgah_latlong!=''
		  order by a.id");
		echo json_encode($rs->getResult());
	}

	function jsonterminal()
	{
		$rs = $this->db2->query("select a.id,'terminal' as type,a.satpel_type,a.terminal_name,a.terminal_code,a.terminal_address,a.terminal_jenis_lokasi_id,a.terminal_type,a.terminal_lat,a.terminal_lng,a.fcode,a.srs_id,a.admpel,a.remark,a.kodbpl,a.konfbm,a.tpbmdr,a.jmdrmg,a.kpsmax,a.pjdrmg,a.jmdrmg_1,a.jlbrdl,a.tpdrm,a.km_pel,b.instansi_detail_name
		  ,if(terminal_img_url is null,'/public/uploads/restarea/default.png',terminal_img_url) as terminal_photo_path, if(count(um.id) > 0,json_arrayagg(json_object('id',um.id,
								'name',uw.user_web_name,
								'type',um.user_mobile_type,
								'pic',um.user_mobile_photo,
								'status',IF(abs.id IS NULL,'offline',a.terminal_name))), json_array()) as petugas

		  from m_terminal a
		left join m_instansi_detail b on a.api_id_bptd=b.id
		left join m_jadwal_posko jp on a.id = jp.satpel_id and jp.tgl_tugas=curdate() and jp.is_deleted = 0 
							  left join m_user_web uw on jp.user_id = uw.id
							  left join m_user_mobile um on uw.user_mobile_id = um.id and length(um.user_mobile_fcm)>10 
							  left join t_absensi_internal abs on jp.user_id = abs.user_id and date(abs.created_at)=curdate()
		where (a.terminal_type='A' or a.satpel_type not in('Terminal'))
		and a.terminal_lat!='' and a.terminal_lng!='' and a.terminal_lat is not null and a.terminal_lng is not null and a.is_deleted = 0 group by a.id");
		echo json_encode($rs->getResult());
	}

	function jsonpelabuhan()
	{
		$rs = $this->db2->query("select a.*,'/public/uploads/restarea/default.png' as pelabuhan_photo_path from ref_penyeberangan_pt a
	  where   a.lat!='' and a.lon!=''");
		echo json_encode($rs->getResult());
	}

	function jsonuppkb()
	{
		$rs = $this->db2->query("select a.*,'/public/uploads/restarea/default.png' as uppkb_photo_path from ref_uppkb_pt a
	  where   a.lat!='' and a.lon!=''");
		echo json_encode($rs->getResult());
	}

	public function loadDataPetugas()
	{
		$posko_id = $this->request->getPost('posko_id') == 'null' ? null : $this->request->getPost('posko_id');
		$satpel_id = $this->request->getPost('satpel_id') == 'null' ? null : $this->request->getPost('satpel_id');
		$petugas_id = $this->request->getPost('petugas_id') == 'null' ? null : $this->request->getPost('petugas_id');
		$posko_id = (strlen($posko_id) > 0) ? $posko_id : null;
		$satpel_id = (strlen($satpel_id) > 0) ? $satpel_id : null;
		$petugas_id = (strlen($petugas_id) > 0) ? $petugas_id : null;
		$satpel_id = ($satpel_id == 0) ? null : $satpel_id;

		$rs = $this->db2->query("select a.id,a1.user_web_name as name,a.user_mobile_type as type,a.user_mobile_photo,a2.posko_id,a2.satpel_id
		,IF(a3.id IS NULL,'offline',if(a2.posko_id is not null,a21.posko_mudik_name,a22.terminal_name)) as status,
		ifnull(if(a2.posko_id is not null,a21.posko_mudik_name,a22.terminal_name),'-') as lokasi
		from m_user_mobile a
		inner join m_user_web a1 on a.id=a1.user_mobile_id and a1.is_deleted = 0
		left join m_jadwal_posko a2 on a1.id=a2.user_id and a2.tgl_tugas=curdate() and a2.is_deleted = 0
		left join m_posko_mudik a21 on a2.posko_id=a21.id
		left join m_terminal a22 on COALESCE(a2.satpel_id,a1.satpel_id)=a22.id
		left join t_absensi_internal a3 on a2.user_id=a3.user_id and date(a3.created_at)=curdate()
		where length(a.user_mobile_fcm)>10 and COALESCE(a2.posko_id,'') = COALESCE(?,a2.posko_id,'') 
		and COALESCE(a2.satpel_id,'') = COALESCE(?,a2.satpel_id,'') and COALESCE(a.id,'') = COALESCE(?,a.id,'');", array($posko_id, $satpel_id, $petugas_id));
		echo json_encode($rs->getResult());
	}


	function databusload()
	{
		$rs = $this->db->query("select a.gps_sn,a.nopol,a.group_nm,a.company_nm,a.route_id,b.name as route_name from s_last_log_armada a left join fleet_routes b on a.route_id=b.id");
		$results['data'] = $rs->getResult();
		echo json_encode($results);
	}

	function dataaduan()
	{
		$rs = $this->db2->query("select a.id,a.aduan_email,a.aduan_user_id,a.aduan_judul,a.aduan_detail,a.aduan_lampiran,a.aduan_ip,a.aduan_reply,a.aduan_reply_lampiran,a.created_at
,b.id as user_mobile_id,b.user_mobile_name,b.user_mobile_email,b.user_mobile_phone,b.user_mobile_type,b.user_mobile_photo,b.user_mobile_fcm
,b.user_mobile_role,c.id as user_web_id,c.user_web_username,c.user_web_email,c.user_web_phone,c.user_web_name,c.user_web_nik,c.user_web_photo,if(e.satpel_id is not null,e.satpel_id,c.satpel_id) as satpel_id,
concat_ws(' ',d.lokker_type,d.terminal_name) as lokasi_name
,if(f.id is null,'offline','online') as status,d.terminal_lat as lat,d.terminal_lng as lon
 from t_aduan a
inner join m_user_mobile b on a.aduan_user_id=b.id
inner join m_user_web c on b.id=c.user_mobile_id
left join m_jadwal_posko e on c.id=e.user_id and e.tgl_tugas=curdate()
left join m_lokker d on e.satpel_id=d.id
left join t_absensi_internal f on e.user_id=f.user_id and date(f.created_at)=curdate()
where b.user_mobile_role in(2)
order by a.created_at desc");
		$results['data'] = $rs->getResult();
		echo json_encode($results);
	}

	function dataaduanbyid()
	{
		$rs = $this->db2->query("select a.id,a.aduan_email,a.aduan_user_id,a.aduan_judul,a.aduan_detail,a.aduan_lampiran,a.aduan_ip,a.aduan_reply,a.aduan_reply_lampiran,a.created_at
,b.id as user_mobile_id,b.user_mobile_name,b.user_mobile_email,b.user_mobile_phone,b.user_mobile_type,b.user_mobile_photo,b.user_mobile_fcm
,b.user_mobile_role,c.id as user_web_id,c.user_web_username,c.user_web_email,c.user_web_phone,c.user_web_name,c.user_web_nik,c.user_web_photo,if(e.satpel_id is not null,e.satpel_id,c.satpel_id) as satpel_id,
concat_ws(' ',d.lokker_type,d.terminal_name) as lokasi_name
,if(f.id is null,'offline','online') as status,d.terminal_lat as lat,d.terminal_lng as lon
 from t_aduan a
inner join m_user_mobile b on a.aduan_user_id=b.id
left join m_user_web c on b.id=c.user_mobile_id
inner join m_jadwal_posko e on c.id=e.user_id and e.tgl_tugas=curdate()
left join m_lokker d on e.satpel_id=d.id
left join t_absensi_internal f on e.user_id=f.user_id and date(f.created_at)=curdate()
where b.user_mobile_role in(2) and a.id=?
order by a.id desc", array($this->request->getPost('id')));
		$results['data'] = $rs->getResult();
		echo json_encode($results);
	}

	function jsonmonroute()
	{
		$rs = $this->db->query("select group_nm,count(*) as jml
		,sum(if(TIMESTAMPDIFF(day,gps_time_b,gps_time)>0,1,0)) as today_inactive
		,sum(if(TIMESTAMPDIFF(day,gps_time_b,gps_time)=0,1,0)) as today_active
		,sum(if(TIMESTAMPDIFF(minute,gps_time_b,gps_time)=0,1,0)) as today_active_less_minute
		,sum(if(TIMESTAMPDIFF(minute,gps_time_b,gps_time)=1,1,0)) as today_active_minute
		,sum(if(TIMESTAMPDIFF(hour,gps_time_b,gps_time)=0,1,0)) as today_active_less_hour
		from s_last_log_armada
		group by group_nm
		order by group_nm");
		echo json_encode($rs->getResult());
	}

	function jsonRouteById()
	{
		$route_id = $this->request->getPost('route_id');
		$rs = $this->db->query("SELECT a.id , a.name as 'text',a.name,a.origin,a.toward,a.or_lat,a.or_lng,a.tw_lat,a.tw_lng,a.waypoints,a.points,a.routes 
		  from fleet_routes a where a.is_deleted=0 and a.id=?", array($route_id));
		$data['route'] = $rs->getResult();

		$rs = $this->db->query("select b.*,a.id as route_id,a.routes from fleet_routes a
		inner join bus_stop b on find_in_set(b.bs_id,a.routes)
		where a.id=? order by find_in_set(b.bs_id,a.routes)", array($route_id));
		$data['bus_stop'] = $rs->getResult();
		$latlngs = array();
		foreach ($rs->getResult() as $item) {
			$latlngs[] = $item->bs_lat . "," . $item->bs_lng;
		}
		$latlngs_ = implode("|", $latlngs);

		$data['points'] = json_decode($this->jsonGetRoutesfromPoints($latlngs_));
		echo json_encode($data);
	}

	function jsonRouteByGroupNm()
	{
		$this->db->query("SET group_concat_max_len=10000");
		$route_id = $this->request->getPost('route_id');
		#print_r($route_id);
		if ($route_id != '') {
			$implode_route_id =  "'" . implode("','", $route_id) . "'";

			// $rs = $this->db->query("select a.kor,a.name as trayek,a.group_nm,b.name as rute,b.jenroute,b.color,b.origin,b.toward,b.points
			//   ,b.routes from m_routes a 
			//   inner join fleet_routes b on a.kor=b.kor
			//   where a.is_deleted=0 and a.group_nm in(".$implode_route_id.")");

			$rs = $this->db->query("select b.id as trip_id,a.id as route_id,a.kor,a.name as trayek,a.name,a.group_nm,b.name as rute,a.jenroute,a.color,b.origin,b.toward,b.points
			,b.routes
			,CAST(CONCAT('[',GROUP_CONCAT(JSON_OBJECT('bs_id',LPAD(c.bs_id,5,'0'),'bs_nm',c.bs_nm,'bs_lat',c.bs_lat,'bs_lng',c.bs_lng,'addr',c.addr,'bs_stop'
			,c.bs_stop,'enc',MD5(CONCAT_WS('',c.bs_nm,c.bs_lat,c.bs_lng)))
			ORDER BY b.id,find_in_set(c.bs_id,b.routes)
			)
			,']') AS JSON) as jsonroutes
			from m_routes a 
			inner join fleet_routes b on a.kor=b.kor
			inner join bus_stop c on find_in_set(c.bs_id,b.routes)
			where a.is_deleted=0 and a.group_nm in(" . $implode_route_id . ")
			group by b.id
			order by b.id,find_in_set(c.bs_id,b.routes);
			");
			$data['route'] = $rs->getResult();
			// $rs = $this->db->query("SELECT a.id , a.name as `text`,a.name,a.origin,a.toward,a.or_lat,a.or_lng,a.tw_lat,a.tw_lng,a.waypoints,a.points,a.routes from fleet_routes a where a.is_deleted=0 and a.group_nm in(".$implode_route_id.")");

			// $data['route'] = $rs->getResult();


			// $rs = $this->db->query("select b.*,a.id as route_id,a.routes,POSITION(b.bs_id in a.routes) as pos,(LENGTH(a.routes)-4) as endpos from fleet_routes a
			// inner join bus_stop b on find_in_set(b.bs_id,a.routes) where a.group_nm in(".$implode_route_id.")");

			// $data['bus_stop'] = $rs->getResult();
		} else {
			$data['route'] = [];
		}
		echo json_encode($data);
	}

	function route_select_get_old()
	{
		$data = $this->request->getGet();
		$query = "SELECT a.id , a.name as 'text',a.name,a.origin,a.toward,a.or_lat,a.or_lng,a.tw_lat,a.tw_lng,a.waypoints,a.points,a.routes from fleet_routes a where a.is_deleted='0'";
		$where = ["a.name", "a.origin", "a.toward"];
		$orderBy = array("a.name asc");


		parent::_loadSelect2($data, $query, $where, $orderBy);
	}

	function route_select_get()
	{
		$data = $this->request->getGet();
		$query = "SELECT a.id , a.name as 'text' from fleet_routes a where a.is_deleted='0'";
		$where = ["a.name", "a.origin", "a.toward"];
		$orderBy = array("a.name asc");


		parent::_loadSelect2($data, $query, $where, $orderBy);
	}

	function busstopnoroute_data()
	{
		$rs = $this->db->query("select a.bs_id,a.bs_nm,a.bs_lat,a.bs_lng,b.id as route_id from bus_stop a
left join fleet_routes b on find_in_set(a.bs_id,b.routes)
where b.id is null");
		$results['bus_stop'] = $rs->getResult();
		echo json_encode($results);
	}

	# 4 jul 2023 papod
	function group_nm_select_get()
	{
		$bptd = $this->session->get('bptd_id');
		$whereand = "";
		if ($bptd != '' && $bptd != 'all') {
			$whereand = " and bptd_id='" . $bptd . "'";
		}
		$data = $this->request->getGet();
		#fix is_deleted rey 24 AUG 2023
		// $query = "select distinct group_nm as id,group_nm as text from m_routes where 0=0" . $whereand;
		$query = "SELECT DISTINCT a.group_nm AS id, a.group_nm AS text FROM m_routes a WHERE a.is_deleted = 0 " . $whereand;
		$where = ["group_nm"];
		$orderBy = array("group_nm asc");

		parent::_loadSelect2($data, $query, $where, $orderBy);
	}


	function bus_select_get()
	{
		$data = $this->request->getGet();
		$query = "SELECT a.gps_sn as id, a.nopol as 'text',a.group_nm,a.company_nm,a.acc,a.lat,a.lon as lng,a.battery_percent,a.gps_time,a.gap from s_last_log_armada a";
		$where = ["a.gps_sn", "a.nopol"];
		$orderBy = array("a.nopol asc");


		parent::_loadSelect2($data, $query, $where, $orderBy);
	}

	function mudik_select_get()
	{
		$data = $this->request->getGet();
		$query = "select a.id,a.route_name as text 
		from m_route a where kategori_angkutan_id in(5,11) and a.is_deleted=0";
		$where = ["a.route_name", "a.route_from", "a.route_to"];
		$orderBy = array("a.route_name asc");


		parent::_loadSelect2hubdat($data, $query, $where, $orderBy);
	}

	function rute_mudik_select_get()
	{
		$data = $this->request->getGet();

		$query = "SELECT id, name as text, toward, origin, color, group_nm
				  FROM fleet_routes 
				  WHERE name IS NOT NULL 
				  AND is_deleted=0";

		$where = ["name"];

		$orderBy = array("name asc");

		parent::_loadSelect2($data, $query, $where, $orderBy);
	}

	function bus_stop_select_get()
	{
		$data = $this->request->getGet();
		// $query = "select a.id,a.route_name as text 
		// from m_route a where kategori_angkutan_id in(5,11) and a.is_deleted=0";
		$query = "SELECT a.bs_id as 'id', a.bs_nm as 'text' 
				  FROM bus_stop a
				  WHERE a.bs_nm IS NOT NULL";
		$where = ["a.bs_nm"];
		$orderBy = array("a.bs_nm asc");


		parent::_loadSelect2($data, $query, $where, $orderBy);
	}

	function jsonbusstopbyid()
	{
		$id = $this->request->getPost('id');

		$data = $this->db->query("Select * 
									from bus_stop
									where bs_id = " . $id)->getRow();

		echo json_encode($data);
	}

	function jsonmudikbyid()
	{
		$id = $this->request->getPost('id');
		$query = "select a.id,a.route_name as text,a.kategori_angkutan_id,a.subkategori_angkutan_id,a.route_from,a.route_to,a.route_from_latlng,a.route_to_latlng,a.route_polyline 
		from m_route a where kategori_angkutan_id in(5,11) and a.is_deleted=0 and a.id=?";
		$rs = $this->db2->query($query, array($id));
		echo json_encode($rs->getResult());
	}

	// API google traffic
	public function getDirection($origin, $destination, $waypoints)
	{
		$alternatives = '';
		if (strlen($waypoints) > 0) {
			$alternatives = '&waypoints=' . $waypoints;
		}
		// echo 'https://maps.googleapis.com/maps/api/directions/json?departure_time=now&destination='.$destination.'&origin='.$origin.$alternatives.'&language=en&mode=driving&region=id&traffic_model=best_guess&key=AIzaSyAZ_q0TfPwQAQTTxHZQ7OhkQP7Le7_e4mo';
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://maps.googleapis.com/maps/api/directions/json?departure_time=now&destination=' . $destination . '&origin=' . $origin . $alternatives . '&language=en&mode=driving&region=id&traffic_model=best_guess&key=AIzaSyAZ_q0TfPwQAQTTxHZQ7OhkQP7Le7_e4mo',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'GET',
			CURLOPT_HTTPHEADER => array(
				'Accept: application/json'
			),
		));

		$response = curl_exec($curl);

		curl_close($curl);

		return $response;
	}

	// public static DateTime::createFromFormat(string $format, string $datetime, ?DateTimeZone $timezone = null): DateTime|false

	public function getlivetraffic()
	{

		$curl = curl_init();
		$route_id = $this->request->getPost('route_id');
		$rs = $this->db->query("select a.id,a.group_nm,a.name,a.jenroute,a.routes,b.bs_id,b.bs_lat,b.bs_lng 
	,POSITION(b.bs_id IN a.routes) as pos
	,LENGTH(a.routes)-4 as endpos
	from fleet_routes a
	inner join bus_stop b on find_in_set(b.bs_id,a.routes)
	where a.id=?", array($route_id));
		$data = array();
		foreach ($rs->getResult() as $item) {
			if ($item->pos == 1) $data['origin'] = $item->bs_lat . ',' . $item->bs_lng;
			if ($item->endpos == $item->pos) $data['destination'] = $item->bs_lat . ',' . $item->bs_lng;
			if ($item->pos > 1 && $item->pos < $item->endpos) $data['waypoints'][] = $item->bs_lat . ',' . $item->bs_lng;
		}
		#print_r($data);
		if (isset($data['waypoints'])) {
			$waypoints_impolode = implode("|", $data['waypoints']);
			echo $this->getDirection($data['origin'], $data['destination'], $waypoints_impolode);
		} else {
			echo $this->getDirection($data['destination'], $data['origin'], null);
		}
	}

	function jsonSearchAll()
	{
		$data = $this->request->getPost();

		$rs = $this->db2->query("SELECT a.* 
							  from (
								select id as place_id, tempat_singgah_name as place_name, 'm_tempat_singgah' as place_category
								from m_tempat_singgah
								where tempat_singgah_name like ? and is_deleted = 0
								union
								select id as place_id, posko_mudik_name as place_name, 'm_posko_mudik' as place_category
								from m_posko_mudik
								where posko_mudik_name like ? and is_deleted = 0
								union
								select id as place_id,terminal_name as place_name,'m_lokker' as place_category
								from m_terminal
								where (terminal_type='A' or terminal_type not in('Terminal')) and terminal_name like ? and is_deleted = 0
							  ) a
							  ", array(
			'%' . $data['paramName'] . '%', '%' . $data['paramName'] . '%', '%' . $data['paramName'] . '%'
		));
		echo json_encode($rs->getResult());
	}

	function jsonSearchById()
	{
		$data = $this->request->getPost();

		switch ($data['category']) {
			case 'm_tempat_singgah':
				$rs = $this->db2->query("SELECT id, tempat_singgah_name as place_name, tempat_singgah_description as place_about, tempat_singgah_photo_path as place_img,
							  tempat_singgah_latlong as place_latlong
							  FROM m_tempat_singgah
							  WHERE id = ?", array($data['id']));
				break;
			case 'm_lokker':
				$rs = $this->db2->query("SELECT a.id, a.terminal_name as place_name, a.terminal_address as place_about, if(terminal_img_url is null,'/public/uploads/restarea/default.png',terminal_img_url) as place_img,
							  concat(a.terminal_lat,',',a.terminal_lng) as place_latlong, if(count(um.id) > 0,json_arrayagg(json_object('id',um.id,
								'name',uw.user_web_name,
								'type',um.user_mobile_type,
								'pic',um.user_mobile_photo,
								'status',IF(abs.id IS NULL,'offline',a.terminal_name))), json_array()) as petugas,1 as type
							  FROM m_terminal a
							  left join m_jadwal_posko jp on a.id = jp.satpel_id and jp.tgl_tugas=curdate() and jp.is_deleted = 0 
							  left join m_user_web uw on jp.user_id = uw.id
							  left join m_user_mobile um on uw.user_mobile_id = um.id and length(um.user_mobile_fcm)>10 
							  left join t_absensi_internal abs on jp.user_id = abs.user_id and date(abs.created_at)=curdate()
							  WHERE (a.terminal_type='A' or a.terminal_type not in('Terminal')) and a.id = ?", array($data['id']));
				break;
			default:
				$rs = $this->db2->query("SELECT a.id, a.posko_mudik_name as place_name, a.posko_mudik_about as place_about, a.posko_mudik_img as place_img,
								a.posko_mudik_latlong as place_latlong, if(count(um.id) > 0,json_arrayagg(json_object('id',um.id,
								'name',uw.user_web_name,
								'type',um.user_mobile_type,
								'pic',um.user_mobile_photo,
								'status',IF(abs.id IS NULL,'offline',a.posko_mudik_name))), json_array()) as petugas,0 as type
								FROM m_posko_mudik a
								left join m_jadwal_posko jp on a.id = jp.posko_id and jp.tgl_tugas=curdate() and jp.is_deleted = 0 
								left join m_user_web uw on jp.user_id = uw.id
								left join m_user_mobile um on uw.user_mobile_id = um.id and length(um.user_mobile_fcm)>10 
								left join t_absensi_internal abs on jp.user_id = abs.user_id and date(abs.created_at)=curdate()
								WHERE a.id = ?", array($data['id']));
				break;
		}

		echo json_encode($rs->getRow());
	}

	function jsonSearchAllPlace()
	{
		$curl = curl_init();
		$agent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)';

		//$q = $this->request->getPost('paramName');
		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://nominatim.openstreetmap.org/search.php?q=-6.222913687560847,106.83902997276742&polygon_geojson=1&format=jsonv2',
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
		echo $response;
	}

	function jsonGetRoutesfromPoints($points)
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://gps.brtnusantara.com/dev/api/route?points=' . urlencode($points),
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

	function getAllJenAng()
	{
		$data = $this->request->getPost();

		$bptd_id = $this->session->get('bptd_id') != 'all' ? 'AND bptd_id = ' . $this->session->get('bptd_id') : '';
		$bptd_idx = $this->session->get('bptd_id') != 'all' ? 'AND x.bptd_id = ' . $this->session->get('bptd_id') : '';
		$bptd_idy = $this->session->get('bptd_id') != 'all' ? 'AND y.bptd_id = ' . $this->session->get('bptd_id') : '';
		$bptd_ida = $this->session->get('bptd_id') != 'all' ? 'AND a.bptd_id = ' . $this->session->get('bptd_id') : '';

		$operator = $this->session->get('operator_id');
		$operator_x = $this->session->get('operator_id') != '' && $this->session->get('operator_id') != '0' ? "AND x.operator_id = $operator" : '';
		$operator_id = $this->session->get('operator_id') != '' && $this->session->get('operator_id') != '0' ? "AND id = $operator" : '';

		$query = "SELECT a.jenroute, count(a.id) AS route,
								IF(b.bus IS NULL, 0, b.bus) AS bus,
								IF(c.trip IS NULL, 0, c.trip) AS trip,
								IF(d.operator IS NULL, 0, d.operator) AS operator
								FROM m_routes a
								LEFT JOIN (
									SELECT count(*) AS bus, y.jenroute
									FROM bus_routes x
									LEFT JOIN m_routes y ON x.route_id = y.id
									WHERE x.is_deleted = 0 $bptd_idy AND y.is_deleted = 0 $operator_x
									GROUP BY y.jenroute
								) b ON b.jenroute = a.jenroute
								LEFT JOIN (
									SELECT count(*) AS trip, x.jenroute
									FROM m_routes x
									RIGHT JOIN fleet_routes y ON y.kor = x.kor
									WHERE x.is_deleted = 0 AND y.is_deleted = 0 $bptd_idx
									GROUP BY x.jenroute
								) c ON c.jenroute = a.jenroute
								LEFT JOIN (
									SELECT jenis_pelayanan, count(*) AS operator
									FROM po_routes
									WHERE is_deleted = 0 $bptd_id $operator_id
									GROUP BY jenis_pelayanan
								) d ON d.jenis_pelayanan = a.jenroute
								WHERE a.is_deleted = 0 $bptd_ida
								GROUP BY a.jenroute;";
		$rs = $this->db->query($query)->getResult();
		if ($rs) {
			$data = ['success' => TRUE, 'message' => 'Data berhasil ditemukan', 'data' => $rs];
		} else {
			$data = ['success' => FALSE, 'message' => 'Data tidak ditemukan', 'data' => []];
		}
		echo json_encode($data);
		// var_dump('<pre>' . $this->db->getLastQuery() . '</pre>');
	}

	function getAllJenBus()
	{
		$data = $this->request->getPost();
		$bptd = $this->session->get('bptd_id') != 'all' ? 'AND b.bptd_id = ' . $this->session->get('bptd_id') . '' : '';
		$operator = $this->session->get('operator_id') != '' && $this->session->get('operator_id') != '0' ? 'AND c.operator_id = ' . $this->session->get('operator_id') . '' : '';
		$query = "SELECT a.jenroute, count(c.id) AS bus
					FROM m_jenis_angkutan_routes a
					LEFT JOIN m_routes b ON a.jenroute LIKE concat('%', b.jenroute, '%')
					LEFT JOIN bus_routes c ON b.id = c.route_id
					WHERE a.is_deleted = 0 AND b.is_deleted = 0 AND c.is_deleted = 0
					$bptd $operator
					GROUP BY a.jenroute
					ORDER BY bus DESC;";

		$rs = $this->db->query($query)->getResult();
		if ($rs) {
			$data = ['success' => TRUE, 'message' => 'Data berhasil ditemukan', 'data' => $rs];
		} else {
			$data = ['success' => FALSE, 'message' => 'Data tidak ditemukan', 'data' => []];
		}
		echo json_encode($data);
		// var_dump('<pre>' . $this->db->getLastQuery() . '</pre>');
	}

	function getAllJenTrayek()
	{
		$data = $this->request->getPost();
		$bptd = $this->session->get('bptd_id') != 'all' ? 'AND a.bptd_id = ' . $this->session->get('bptd_id') . '' : '';
		$query = "SELECT a.jenroute, count(*) AS route
					FROM m_routes a
					WHERE a.is_deleted = 0 $bptd
					GROUP BY a.jenroute
					ORDER BY route DESC;";

		$rs = $this->db->query($query)->getResult();
		if ($rs) {
			$data = ['success' => TRUE, 'message' => 'Data berhasil ditemukan', 'data' => $rs];
		} else {
			$data = ['success' => FALSE, 'message' => 'Data tidak ditemukan', 'data' => []];
		}
		echo json_encode($data);
	}

	function getAllUser()
	{
		$data = $this->request->getPost();
		$bptd = $this->session->get('bptd_id') != 'all' ? 'AND a.lokker_id = ' . $this->session->get('bptd_id') . '' : '';
		$query = "SELECT b.user_web_role_code, COUNT(a.id) AS role_count
					FROM m_user_web a
					RIGHT JOIN s_user_web_role b ON a.user_web_role_id = b.id
					WHERE a.is_deleted = 0 AND b.is_deleted = 0 AND a.created_at > '2023-05-01' $bptd
					GROUP BY b.user_web_role_code";

		$rs = $this->db->query($query)->getResult();
		if ($rs) {
			$data = ['success' => TRUE, 'message' => 'Data berhasil ditemukan', 'data' => $rs];
		} else {
			$data = ['success' => FALSE, 'message' => 'Data tidak ditemukan', 'data' => []];
		}
		echo json_encode($data);
	}

	function getAllGps()
	{
		$data = $this->request->getPost();
		$bptd = $this->session->get('bptd_id') != 'all' ? 'AND b.bptd_id = ' . $this->session->get('bptd_id') . '' : '';
		$operator = $this->session->get('operator_id') != '' && $this->session->get('operator_id') != '0' ? 'AND c.operator_id = ' . $this->session->get('operator_id') . '' : '';

		$query = "SELECT x.jenroute, 
					SUM(IF(x.gps_status = 1, 1, 0)) AS 'online',
					SUM(IF(x.gps_status = 0, 1, 0)) AS 'offline',
					SUM(IF(x.gps_status = 2, 1, 0)) AS 'idle'
					FROM 
					(
						SELECT a.jenroute, d.gps_sn,
						CASE
							WHEN d.gps_time >= (NOW() - INTERVAL 5 MINUTE) THEN '1' 
							WHEN d.gps_time >= (NOW() - INTERVAL 1 DAY) THEN '2'
							ELSE '0'
						END AS gps_status
						FROM m_jenis_angkutan_routes a
						LEFT JOIN m_routes b ON a.jenroute LIKE concat('%', b.jenroute, '%')
						LEFT JOIN bus_routes c ON b.id = c.route_id
						LEFT JOIN s_last_log_armada d ON c.gps_sn = d.gps_sn
						WHERE a.is_deleted = 0 AND b.is_deleted = 0 AND c.is_deleted = 0
						$bptd $operator
					) x
					GROUP BY x.jenroute
					ORDER BY online DESC, offline DESC, idle DESC;";

		$rs = $this->db->query($query)->getResult();
		if ($rs) {
			$data = ['success' => TRUE, 'message' => 'Data berhasil ditemukan', 'data' => $rs];
		} else {
			$data = ['success' => FALSE, 'message' => 'Data tidak ditemukan', 'data' => []];
		}
		echo json_encode($data);
		// var_dump('<pre>' . $this->db->getLastQuery() . '</pre>');
	}

	function getAllJenArmada()
	{
		$data = $this->request->getPost();
		$bptd = $this->session->get('bptd_id') != 'all' ? 'AND b.bptd_id = ' . $this->session->get('bptd_id') . '' : '';
		$operator = $this->session->get('operator_id') != '' && $this->session->get('operator_id') != '0' ? 'AND c.id = ' . $this->session->get('operator_id') . '' : '';
		$query = "SELECT a.group_nm AS bus_group_name, a.nopol, b.group_nm AS rute_group_name, b.name AS rute_name
					FROM bus_routes a 
					INNER JOIN m_routes b ON a.route_id = b.id
					LEFT JOIN po_routes c ON a.operator_id = c.id
					WHERE a.is_deleted = 0 AND b.is_deleted = 0 AND c.is_deleted = 0 AND b.jenroute = 'KSPN'
					$bptd $operator";

		$rs = $this->db->query($query)->getResult();
		if ($rs) {
			$data = ['success' => TRUE, 'message' => 'Data berhasil ditemukan', 'data' => $rs];
		} else {
			$data = ['success' => FALSE, 'message' => 'Data tidak ditemukan', 'data' => []];
		}
		echo json_encode($data);
	}

	function getAllJenPerintis()
	{
		$data = $this->request->getPost();
		$bptd = $this->session->get('bptd_id') != 'all' ? 'AND b.bptd_id = ' . $this->session->get('bptd_id') . '' : '';
		$operator = $this->session->get('operator_id') != '' && $this->session->get('operator_id') != '0' ? 'AND c.id = ' . $this->session->get('operator_id') . '' : '';
		$query = "SELECT a.group_nm AS bus_group_name, a.nopol, b.group_nm AS rute_group_name, b.name AS rute_name
					FROM bus_routes a 
					INNER JOIN m_routes b ON a.route_id = b.id
					LEFT JOIN po_routes c ON a.operator_id = c.id
					WHERE a.is_deleted = 0 AND b.is_deleted = 0 AND c.is_deleted = 0 AND b.jenroute = 'PERINTIS'
					$bptd $operator";

		$rs = $this->db->query($query)->getResult();
		if ($rs) {
			$data = ['success' => TRUE, 'message' => 'Data berhasil ditemukan', 'data' => $rs];
		} else {
			$data = ['success' => FALSE, 'message' => 'Data tidak ditemukan', 'data' => []];
		}
		echo json_encode($data);
		// var_dump('<pre>' . $this->db->getLastQuery() . '</pre>');
	}

	function getSpdaPenumpang()
	{
		$data = $this->request->getPost();

		$query = "SELECT
					sum(naik_dl) AS naik_dl,
					sum(naik_dp) AS naik_dp,
					sum(naik_al) AS naik_al,
					sum(naik_ap) AS naik_ap
				FROM spda_pass_routes a
				LEFT JOIN spda_routes b ON a.spda_id = b.id
				LEFT JOIN m_routes c ON b.route_id = c.id
				WHERE a.is_deleted = 0
					AND b.is_deleted = 0
					AND c.is_deleted = 0
					AND c.bptd_id = '" . $data['bptd_id'] . "'
					AND (b.spda_date BETWEEN '" . $data['date'] . "' AND curdate());";

		$rs = $this->db->query($query)->getRow();
		$series = [(int) $rs->naik_dl, (int)$rs->naik_dp, (int) $rs->naik_al, (int) $rs->naik_ap];

		if ($rs) {
			$data = ['success' => TRUE, 'message' => 'Data berhasil ditemukan', 'data' => $series];
		} else {
			$data = ['success' => FALSE, 'message' => 'Data tidak ditemukan', 'data' => []];
		}
		echo json_encode($data);
	}

	function getSpdaStat()
	{
		$data = $this->request->getPost();
		$bptd = $this->session->get('bptd_id') != 'all' ? 'AND b.bptd_id = ' . $this->session->get('bptd_id') . '' : '';
		$operator = $this->session->get('operator_id') != '' && $this->session->get('operator_id') != '0' ? 'AND a.operator_id = ' . $this->session->get('operator_id') . '' : '';
		$rangeDate = $data['date'] != '' ? "AND (a.spda_date BETWEEN '" . $data['date'] . "' AND curdate())" : '';

		$query = "SELECT a1.name, IFNULL(a1.sts0, 0) AS sts0, IFNULL(a1.sts1, 0) AS sts1, IFNULL(a1.sts2, 0) AS sts2
					FROM (SELECT b.name,
					CASE WHEN a.spda_status = '0' THEN count(a.spda_status) END AS 'sts0',
					CASE WHEN a.spda_status = '1' THEN count(a.spda_status) END AS 'sts1',
					CASE WHEN a.spda_status = '2' THEN count(a.spda_status) END AS 'sts2'
					FROM spda_routes a
					LEFT JOIN m_routes b ON b.id = a.route_id 
					WHERE a.is_deleted = 0 $bptd $operator $rangeDate
					GROUP BY a.route_id) a1";

		$rs = $this->db->query($query)->getResult();

		$series = [];
		foreach ($rs as $key => $value) {
			$series[$key]['name'] = $value->name;
			$series[$key]['sts0'] = (int) $value->sts0;
			$series[$key]['sts1'] = (int) $value->sts1;
			$series[$key]['sts2'] = (int) $value->sts2;
		}

		if ($rs) {
			$data = ['success' => TRUE, 'message' => 'Data berhasil ditemukan', 'data' => $series];
		} else {
			$data = ['success' => FALSE, 'message' => 'Data tidak ditemukan', 'data' => []];
		}
		echo json_encode($data);
	}

	function getLoadFactor()
	{
		$data = $this->request->getPost();
		$bptd = $this->session->get('bptd_id') != 'all' ? 'AND d.bptd_id = ' . $this->session->get('bptd_id') . '' : '';
		$operator = $this->session->get('operator_id') != '' && $this->session->get('operator_id') != '0' ? 'AND a.operator_id = ' . $this->session->get('operator_id') . '' : '';
		$rangeDate = $data['date'] != '' ? "AND (a.spda_date BETWEEN '" . $data['date'] . "' AND curdate())" : '';
		$query = "SELECT x.spda_date, x.name, IFNULL(x.ttl_trip, 0) AS ttl_trip, IFNULL(x.naik_ttl, 0) AS naik_ttl, IFNULL(x.bus_capacity, 0) AS load_factor
					FROM 
					(SELECT a.spda_date,
					c.name,
					count(b.id) AS ttl_trip,
					sum(b.naik_total) AS naik_ttl,
					a.bus_capacity
					-- (sum(b.naik_total) / a.bus_capacity) AS load_factor
					FROM spda_routes a
					LEFT JOIN spda_pass_routes b ON b.spda_id = a.id AND b.is_deleted = 0
					LEFT JOIN fleet_routes c ON c.id = a.trip_id
					LEFT JOIN m_routes d ON d.id = a.route_id
					WHERE a.is_deleted = 0 $bptd $operator $rangeDate
					GROUP BY a.id LIMIT 5) x
					-- ORDER BY x.load_factor DESC
					";

		$result = $this->db->query($query)->getResult();
		if ($result) {
			$data = ['success' => TRUE, 'message' => 'Data berhasil ditemukan', 'data' => $result];
		} else {
			$data = ['success' => FALSE, 'message' => 'Data tidak ditemukan', 'data' => []];
		}
		echo json_encode($data);
	}

	function getAllDriver()
	{
		$data = $this->request->getPost();
		$bptd = $this->session->get('bptd_id') != 'all' ? 'AND b.bptd_id = ' . $this->session->get('bptd_id') . '' : '';
		$operator = $this->session->get('operator_id') != '' && $this->session->get('operator_id') != '0' ? 'AND a.operator_id = ' . $this->session->get('operator_id') . '' : '';

		$query = "SELECT
						a.id,
						a.driver_name,
						a.driver_pic,
						concat(c.cp_type, '. ', c.cp_name) AS po_name,
						c.jenis_pelayanan,
						concat(b.kor, ' | ', b.group_nm, ' (',b.name,')') AS trayek_name
					FROM
						driver_routes a
						LEFT JOIN m_routes b ON a.route_id = b.id
						LEFT JOIN po_routes c ON a.operator_id = c.id
					WHERE a.is_deleted = 0 $bptd $operator";

		$result = $this->db->query($query)->getResult();
		if ($result) {
			$data = ['success' => TRUE, 'message' => 'Data berhasil ditemukan', 'data' => $result];
		} else {
			$data = ['success' => FALSE, 'message' => 'Data tidak ditemukan', 'data' => []];
		}
		echo json_encode($data);
	}

	function getPnpJenis()
	{
		$data = $this->request->getPost();
		$bptd = $this->session->get('bptd_id') != 'all' ? 'AND a.bptd_id = ' . $this->session->get('bptd_id') . '' : '';
		$operator = $this->session->get('operator_id') != '' && $this->session->get('operator_id') != '0' ? 'AND b.operator_id = ' . $this->session->get('operator_id') . '' : '';
		$rangeDate = $data['date'] != '' ? "AND (b.spda_date BETWEEN '" . $data['date'] . "' AND curdate())" : '';

		$query = "SELECT a.jenroute, sum(b.bus_capacity) AS total_bus_capacity, sum(c.naik_total) AS naik_total, ((sum(c.naik_total)/sum(b.bus_capacity))*100) AS load_factor
					FROM m_routes a
					RIGHT JOIN spda_routes b ON b.route_id = a.id
					LEFT JOIN spda_pass_routes c ON c.spda_id = b.id
					LEFT JOIN fleet_routes d ON d.id = b.trip_id
					WHERE a.is_deleted = 0 AND b.is_deleted = 0 AND c.is_deleted = 0 AND d.is_deleted = 0
					$bptd $operator $rangeDate
					GROUP BY a.jenroute";

		$result = $this->db->query($query)->getResult();
		if ($result) {
			$data = ['success' => TRUE, 'message' => 'Data berhasil ditemukan', 'data' => $result];
		} else {
			$data = ['success' => FALSE, 'message' => 'Data tidak ditemukan', 'data' => []];
		}
		echo json_encode($data);
	}

	public function get_route()
	{
		$data = $this->request->getGet();
		$bptd = $this->session->get('bptd_id') != 'all' ? 'AND a.bptd_id = ' . $this->session->get('bptd_id') . '' : '';
		$operator = $this->session->get('operator_id') != '' && $this->session->get('operator_id') != '0' ? 'AND b.operator_id = ' . $this->session->get('operator_id') . '' : '';
		$query = "SELECT a.id, concat(a.jenroute, ' | ',a.group_nm, ' (', a.name,')') AS 'text', a.color
					FROM m_routes a 
					LEFT JOIN m_user_web b ON b.lokker_id = a.bptd_id
					WHERE a.is_deleted= 0 AND b.is_deleted = 0
					$bptd
					$operator
					GROUP BY a.kor, a.jenroute
					ORDER BY a.idprov";
		$where = ["a.group_nm", "a.name", "a.jenroute"];

		parent::_loadSelect2($data, $query, $where);
	}

	public function get_trip()
	{
		$data = $this->request->getGet();
		$trayekid = isset($data['route_id']) != '' ? 'AND a.id = ' . $data['route_id'] . '' : '';
		$bptd = $this->session->get('bptd_id') != 'all' ? 'AND a.bptd_id = ' . $this->session->get('bptd_id') . '' : '';
		$operator = $this->session->get('operator_id') != '' && $this->session->get('operator_id') != '0' ? 'AND c.operator_id = ' . $this->session->get('operator_id') . '' : '';
		$query = "SELECT b.id AS trip_id, a.id, a.group_nm, b.name AS 'text'
					FROM m_routes a
					LEFT JOIN fleet_routes b ON b.kor = a.kor
					LEFT JOIN bus_routes c ON c.route_id = a.id
					WHERE a.is_deleted = 0 AND b.is_deleted = 0 AND c.is_deleted = 0
					$bptd
					$trayekid
					$operator";

		$where = ["a.group_nm", "a.name", "a.jenroute"];
		$groupBy = "b.id";

		parent::_loadSelect2($data, $query, $where, null, $groupBy);
	}

	function getTrafficPnp()
	{
		$data = $this->request->getPost();

		$route_id = isset($data['route_id']) ? $data['route_id'] : '';
		$routeid = $route_id != '' ? 'AND b.route_id = ' . $route_id . '' : '';
		$trip_id = isset($filter['trip_id']) ? $filter['route_id'] : '';
		$tripid = $trip_id != '' ? 'AND b.trip_id = ' . $trip_id . '' : '';
		$spdadate = isset($data['spda_date']) != '' ? "AND b.spda_date = '" . $data['spda_date'] . "'" : '';
		$bptd = $this->session->get('bptd_id') != 'all' ? 'AND c.bptd_id = ' . $this->session->get('bptd_id') . '' : '';
		$operator = $this->session->get('operator_id') != '' && $this->session->get('operator_id') != '0' ? 'AND d.operator_id = ' . $this->session->get('operator_id') . '' : '';

		$query = "SELECT h.time_range, ifnull(a.created_at, '-') AS created_at, ifnull(a.time_interval, h.time_range) AS time_interval, ifnull(a.total_naik, '0') AS total_naik
					FROM (
						SELECT CONCAT(
							LPAD(hour_value, 2, '0'), ':00 - ', 
							LPAD(hour_value + 3, 2, '0'), ':00'
						) AS time_range
						FROM (
							SELECT 0 AS hour_value UNION SELECT 3 UNION SELECT 6 UNION SELECT 9
							UNION SELECT 12 UNION SELECT 15 UNION SELECT 18 UNION SELECT 21
						) hours
					) h
					LEFT JOIN (
						SELECT
							a.created_at,
							CASE
								WHEN (HOUR(a.created_at) BETWEEN 00 AND 3) AND (DATE(b.spda_date) >= DATE('2023-08-09')) THEN '00:00 - 03:00'
								WHEN (HOUR(a.created_at) BETWEEN 3 AND 5) AND (DATE(b.spda_date) >= DATE('2023-08-09')) THEN '03:00 - 06:00'
								WHEN (HOUR(a.created_at) BETWEEN 6 AND 8) AND (DATE(b.spda_date) >= DATE('2023-08-09')) THEN '06:00 - 09:00'
								WHEN (HOUR(a.created_at) BETWEEN 9 AND 11) AND (DATE(b.spda_date) >= DATE('2023-08-09')) THEN '09:00 - 12:00'
								WHEN (HOUR(a.created_at) BETWEEN 12 AND 14) AND (DATE(b.spda_date) >= DATE('2023-08-09')) THEN '12:00 - 15:00'
								WHEN (HOUR(a.created_at) BETWEEN 15 AND 17) AND (DATE(b.spda_date) >= DATE('2023-08-09')) THEN '15:00 - 18:00'
								WHEN (HOUR(a.created_at) BETWEEN 18 AND 20) AND (DATE(b.spda_date) >= DATE('2023-08-09')) THEN '18:00 - 21:00'
								WHEN (HOUR(a.created_at) BETWEEN 21 AND 23) AND (DATE(b.spda_date) >= DATE('2023-08-09')) THEN '21:00 - 24:00'
								ELSE '00:00 - 03:00'
							END AS time_interval,
							SUM(a.naik_total) AS total_naik
						FROM spda_pass_routes a
						LEFT JOIN spda_routes b ON b.id = a.spda_id
						LEFT JOIN m_routes c ON c.id = b.route_id
						LEFT JOIN bus_routes d ON d.route_id = c.id
						WHERE a.is_deleted = 0 AND b.is_deleted = 0 
						$routeid
						$tripid
						$spdadate
						$bptd
						$operator
						GROUP BY IF((DATE(b.spda_date) >= DATE('2023-08-09')), DATE(a.created_at), b.spda_date), time_interval
					) a ON a.time_interval = h.time_range";
		$result = $this->db->query($query)->getResult();

		if ($result) {
			$data = ['success' => TRUE, 'message' => 'Data berhasil ditemukan', 'data' => $result];
		} else {
			$data = ['success' => FALSE, 'message' => 'Data tidak ditemukan', 'data' => []];
		}
		echo json_encode($data);
	}

	function getTripPnp()
	{
		$data = $this->request->getPost();
		$bptd = $this->session->get('bptd_id') != 'all' ? 'AND b.bptd_id = ' . $this->session->get('bptd_id') . '' : '';
		$operator = $this->session->get('operator_id') != '' && $this->session->get('operator_id') != '0' ? 'AND a.operator_id = ' . $this->session->get('operator_id') . '' : '';
		$rangeDate = $data['date'] != '' ? "AND (a.created_at BETWEEN '" . $data['date'] . "' AND curdate())" : '';

		$query = "SELECT a.id, a.routes, a.bus_capacity, sum(c.naik_total) AS naik_total, ((a.bus_capacity / sum(c.naik_total))*100) AS load_factor
					FROM spda_routes a
					LEFT JOIN m_routes b ON b.id = a.route_id
					LEFT JOIN spda_pass_routes c ON c.spda_id = a.id
					WHERE a.is_deleted = 0 $bptd $operator $rangeDate
					GROUP BY a.trip_id";
		$result = $this->db->query($query)->getResult();

		if ($result) {
			$data = ['success' => TRUE, 'message' => 'Data berhasil ditemukan', 'data' => $result];
		} else {
			$data = ['success' => FALSE, 'message' => 'Data tidak ditemukan', 'data' => []];
		}
		echo json_encode($data);
	}
}
