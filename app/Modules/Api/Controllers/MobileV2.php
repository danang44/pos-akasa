<?php

namespace App\Modules\Api\Controllers;

use App\Modules\Api\Models\ApiModel;
use App\Core\BaseController;
use App\Core\BaseModel;
use \DateTime;


class MobileV2 extends BaseController
{
	private $apiModel;
	private $dataroutesid;
    var $secretKey;

	/**
	 * Constructor.
	 */
	public function __construct()
	{
		$this->apiModel = new ApiModel();
		foreach ($this->apiModel->rec_armada_routesid() as $item) {
			$this->dataroutesid[$item->gps_sn] = $item->route_id;
		}
        $this->secretKey = '4zTWX3HKQJF52gtDNrcu16bZVweS07yO';
	}

    private function encrypted($data){
        $v = $data;
		if(strlen($this->secretKey) != 32){
			echo json_encode("SecretKey length is not 32 chars");
		}else{
			$iv = substr($this->secretKey, 0, 16);
			$key = [$this->secretKey, $iv];
			$encrypted = openssl_encrypt($v, 'aes-256-cbc', $key[0], 0, $key[1]);
			// echo "Encrypted: $encrypted\n";
			// return [$secretKey, $iv];
            return $encrypted;
			
		}
    }

    private function decrypted($data){
		if(strlen($this->secretKey) != 32){
			echo json_encode("SecretKey length is not 32 chars");
		}else{
			$iv = substr($this->secretKey, 0, 16);
			$key = [$this->secretKey, $iv];
			$decrypted = openssl_decrypt($data, 'aes-256-cbc', $key[0], 0, $key[1]);

			// echo "Decrypted: $decrypted\n";
            return $decrypted;
			// return [$secretKey, $iv];
			
		}
    }

    public function checkDec(){
        $secretKey = $this->secretKey;
        $encrypted = file_get_contents('php://input');
		
		if(strlen($secretKey) != 32){
			echo "SecretKey length is not 32 chars";
		}else{
			$iv = substr($secretKey, 0, 16);

			$key = [$secretKey, $iv];

			$decrypted = openssl_decrypt($encrypted, 'aes-256-cbc', $key[0], 0, $key[1]);
	
			echo $decrypted;

			
		}
    }

    public function cekEnkrip_form(){
		$secretKey = $this->secretKey;
        $datapost = http_build_query($_POST);
        // $datapostnya = json_encode($datapost);
    
	
		if(strlen($secretKey) != 32){
			echo "SecretKey length is not 32 chars";
		}else{
			$iv = substr($secretKey, 0, 16);
			
			$key = [$secretKey, $iv];
			$encrypted = openssl_encrypt($datapost, 'aes-256-cbc', $key[0], 0, $key[1]);
			echo $encrypted;

			
		}

	}
    public function cekEnkrip_json(){
		$secretKey = $this->secretKey;
        $datapost = file_get_contents('php://input');
		// echo $datapost;
		if(strlen($secretKey) != 32){
			echo "SecretKey length is not 32 chars";
		}else{
			$iv = substr($secretKey, 0, 16);
			
			$key = [$secretKey, $iv];
			$encrypted = openssl_encrypt($datapost, 'aes-256-cbc', $key[0], 0, $key[1]);
			echo $encrypted;

			
		}

	}


	public function index()
	{
		return redirect()->to(base_url());
	}

	public function test()
	{
		return view('App\Modules\Api\Views\test');
	}

	public function login()
	{
		$username = $this->request->getPost("username");
		$password = $this->request->getPost("password");

		$result = $this->db->query("select * from m_user_web where user_web_username = '" . addslashes($username) . "' and user_web_password = md5('" . addslashes($password) . "')")->getRow();
		if ($result) {
			$response = ["success" => true, "message" => "Success", "data" => $result];
		} else {
			$response = ["success" => false, "message" => "Invalid Login", "data" => null];
		}

		return $this->response->setJson($response);
	}


	public function dataOp()
	{
		$rs = $this->db->query("
		select a.op_type,a.npwpd,a.resto_name as op_name,a.resto_addr as op_addr,a.resto_latlng as op_latlng
		from
		(
		select 'Restoran' as op_type,a.npwpd,a.resto_name,a.resto_addr,a.resto_latlng from op_restoran a where a.is_deleted=0
		union 
		select 'Hotel' as op_type,a.npwpd,a.hotel_name,a.hotel_addr,a.hotel_latlng from op_hotel a where a.is_deleted=0
		union 
		select 'Parkir' as op_type,a.npwpd,a.parkir_name,a.parkir_addr,a.parkir_latlng from op_parkir a where a.is_deleted=0
		union 
		select 'Reklame' as op_type,a.npwpd,a.reklame_name,a.reklame_addr,a.reklame_latlng from op_reklame a where a.is_deleted=0
		union 
		select 'Hiburan' as op_type,a.npwpd,a.hiburan_name,a.hiburan_addr,a.hiburan_latlng from op_hiburan a where a.is_deleted=0
		) a
		");
		if ($rs->getRow()) {
			$response = ["success" => true, "message" => "Success", "data" => $rs->getResult()];
		} else {
			$response = ["success" => false, "message" => "No Data", "data" => null];
		}
		return $this->response->setJson($response);
	}

	public function saveOpRestoran()
	{
		#print_r($this->request->getPost());
		parent::_mobile_insert('op_restoran', $this->request->getPost());
	}

	public function saveOpHotel()
	{
		#print_r($this->request->getPost());
		parent::_mobile_insert('op_hotel', $this->request->getPost());
	}

	public function saveOpParkir()
	{
		#print_r($this->request->getPost());
		parent::_mobile_insert('op_parkir', $this->request->getPost());
	}

	public function saveOpHiburan()
	{
		#print_r($this->request->getPost());
		parent::_mobile_insert('op_hiburan', $this->request->getPost());
	}

	public function saveOpReklame()
	{
		#print_r($this->request->getPost());
		parent::_mobile_insert('op_reklame', $this->request->getPost());
	}

	# select row to edit
	public function getRowOpRestoran()
	{
	}

	function rec_pos()
	{
		$return = json_encode($this->request->getJSON(), true);

		#print_r($_POST);
		$postdata = json_decode($return, true);

		$query = $this->db->table('s_last_log_armada_rec')->upsertBatch($postdata);

		if ($query) {
			$response = ["success" => true, "message" => "Success", "data" => null];
		} else {
			$response = ["success" => false, "message" => "No Data", "data" => null];
		}
		return $this->response->setJson($response);
	}

	public function voip()
	{
		$sender = $this->request->getPost('sender');
		$room = $this->request->getPost('room');
		$handler = $this->request->getPost('handler');

		$db2 = db_connect('hubdat');
		$query = $db2->query("select a.id,a.user_mobile_name as name,a.user_mobile_type as type,if(LOWER(a.user_mobile_type)='ios',a.user_mobile_jitsi,a.user_mobile_fcm) AS token from m_user_mobile a
							  inner join m_posko_mudik b on find_in_set(a.id,b.petugas_id) and b.is_deleted=0
							  where a.user_mobile_role=2 and a.id=7 having length(token)>10");
		$datapost['petugas'] = json_encode($query->getResultArray());

		$petugas = $query->getResultArray();
		print_r($petugas);
		#$petugas = json_decode($this->request->getPost('petugas'), true);
		$results = [];

		$curl = curl_init();

		foreach ($petugas as $pt) {
			$results[$pt['id']] = $pt['type'] == 'iOS' ? $this->ios($curl, $sender, $room, $pt['token'], $handler) : $this->android($curl, $sender, $room, $pt['token']);
		}

		curl_close($curl);

		return json_encode($results);
	}

	public function voipcall()
	{
		$sender = $this->request->getPost('sender');
		$room = $this->request->getPost('room');
		$handler = $this->request->getPost('handler');

		$db2 = db_connect('hubdat');
		$query = $db2->query("select a.id,a.user_mobile_name as name,a.user_mobile_type as type,if(LOWER(a.user_mobile_type)='ios',a.user_mobile_jitsi,a.user_mobile_fcm) AS token,a3.created_at,a2.id as iduserweb,a4.posko_mudik_name,a5.terminal_name from m_user_mobile a
			inner join m_user_web a2 on a.id=a2.user_mobile_id
			left join m_jadwal_posko a3 on a2.id=a3.user_id and a3.tgl_tugas=curdate()
			left join m_posko_mudik a4 on a3.posko_id=a4.id
			left join m_lokker a5 on a3.lokker_id=a5.id
			where a.user_mobile_role=2 and a.id=? having length(token)>10", array($this->request->getPost('petugas_id')));
		$datapost['petugas'] = json_encode($query->getResultArray());

		$petugas = $query->getResultArray();
		#print_r($petugas);
		#$petugas = json_decode($this->request->getPost('petugas'), true);
		$results = [];

		$curl = curl_init();

		foreach ($petugas as $pt) {
			$results[$pt['id']] = $pt['type'] == 'iOS' ? $this->ios($curl, $sender, $room, $pt['token'], $handler) : $this->android($curl, $sender, $room, $pt['token']);
		}

		curl_close($curl);

		return json_encode($results);
	}

	private function android($curl, $sender, $room, $token)
	{

		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://fcm.googleapis.com/fcm/send',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => '{
				"to": "' . $token . '",
				"data": {
					"incoming_video_call": "1",
					"incoming_name": "' . $sender . '",
					"room": "' . $room . '",
					"url": "https://devel2.nginovasi.id/"
				}
			}',
			CURLOPT_HTTPHEADER => array(
				'Authorization: key=AAAAzdnMDpk:APA91bHGqr46b8DXtkEnV1D_quks7zEImJwlSkDBXpt1NjMmgZgnc0K987tBlX3b8HgAppbCwkZ0RSK2HLEUVJMMcw5PozRy-rFCwuV8pwsrQg-XfCi6OlFxVt27Jr3aHB-23teNYRgl',
				'Content-Type: application/json'
			),
		));

		$response = curl_exec($curl);

		return $response;
	}

	private function ios($curl, $sender, $room, $token, $handler = null)
	{
		if (defined("CURL_VERSION_HTTP2") && (curl_version()["features"] & CURL_VERSION_HTTP2) !== 0) {
			$body['aps'] = array(
				"alert" => array(
					"status" => 1,
					"title" => "Mitra Darat",
					"body" => "VOIP service",
					"data" => array(
						"UUID" => "ABCDE-FGHIJ-KLMNO",
						"sender" => $sender,
						"room" => $room,
						"url" => "https://devel2.nginovasi.id/",
						"handler" => $handler
					),
				)
			);

			$curlconfig = array(
				CURLOPT_URL => "https://api.push.apple.com/3/device/" . $token,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_POSTFIELDS => json_encode($body),
				CURLOPT_SSLCERT => APPPATH . "../cert_call/voip_apns.pem",
				CURLOPT_SSLCERTPASSWD => "mitradarat",
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_2_0,
				CURLOPT_VERBOSE => true
			);

			curl_setopt_array($curl, $curlconfig);

			$res = curl_exec($curl);

			if ($res === FALSE) {
				return ('Curl failed: ' . curl_error($curl));
			} else {
				return $res;
			}
		} else {
			return "No HTTP/2 support on client.";
		}
	}

	function multi_thread_curl($tokenArray, $optionArray, $nThreads)
	{

		//Group your urls into groups/threads.
		$curlArray = array_chunk($tokenArray, $nThreads, $preserve_keys = true);

		//Iterate through each batch of urls.
		$ch = 'ch_';
		foreach ($curlArray as $threads) {
			//Create your cURL resources.
			foreach ($threads as $thread => $token) {
				${$ch . $thread} = curl_init();
				curl_setopt_array(${$ch . $thread}, $optionArray); //Set your main curl options.
				curl_setopt(${$ch . $thread}, CURLOPT_URL, "https://api.development.push.apple.com/3/device/" . $token); //Set url.
			}

			//Create the multiple cURL handler.
			$mh = curl_multi_init();

			//Add the handles.
			foreach ($threads as $thread => $value) {
				curl_multi_add_handle($mh, ${$ch . $thread});
			}

			$active = null;
			//execute the handles.

			do {
				$mrc = curl_multi_exec($mh, $active);
			} while ($mrc == CURLM_CALL_MULTI_PERFORM);


			while ($active && $mrc == CURLM_OK) {
				if (curl_multi_select($mh) != -1) {
					do {
						$mrc = curl_multi_exec($mh, $active);
					} while ($mrc == CURLM_CALL_MULTI_PERFORM);
				}
			}

			//Get your data and close the handles.
			foreach ($threads as $thread => $value) {
				$results[$thread] = curl_multi_getcontent(${$ch . $thread});
				curl_multi_remove_handle($mh, ${$ch . $thread});
			}

			//Close the multi handle exec.
			curl_multi_close($mh);
		}

		return $results;
	}

	function vehiclesLastPositionKSPN()
	{
		$gps_time = date_create("2023-02-06T10:10:40+07:00");
		#var_dump($gps_time);
		#echo "Tanggalaaaannn------------------------>".date_format($gps_time,"Y-m-d");
		echo "KSPN";
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
		  "status_vehicle": "all",
		  "geo_code": [],
		  "page": 0,
		  "encrypted": 0
		}',
			CURLOPT_HTTPHEADER => array(
				'Accept: application/json',
				'token: 8CB2EEBC65B0468FA2E959E16B983E0C', #DAMRI-KSPN
				'Content-Type: application/json'
			),
		));

		$response = curl_exec($curl);
		#echo $response;

		curl_close($curl);

		$responseArray = json_decode($response);
		#var_dump($responseArray);
		$fields = array("gps_sn", "group_nm", "nopol", "company_nm", "direction", "stime", "speed", "lat", "lon", "acc", "battery_percent", "gps_time");
		$obj1 = new \stdClass;
		$dataResult = array();
		if ($responseArray->ResponseCode == 1) {
			foreach ($responseArray->Data as $key => $item) {
				if (date_format(date_create($item->gps_time), "Ymd") == date("Ymd")) {
					$item->group_nm = (($item->group_nm == "") ? "DAMRI-KSPN" : $item->group_nm);
					$dataArray[$key]['id'] = $item->gps_sn;
					#echo $item->gps_sn;
					foreach ($item as $key2 => $value) {
						if (in_array($key2, $fields)) {
							$dataArray[$key][$key2] = $value;
							$dataResult[$key][$key2] = $value;
						}
					}
				}
			}
			if (isset($dataArray) && count($dataResult) > 0) {
				//echo json_encode($dataArray);
				#print_r($this->dataroutesid);
				foreach ($dataArray as $key => $value) {
					$dataArray[$key]['route_id'] = (isset($this->dataroutesid[$value['gps_sn']])) ? $this->dataroutesid[$value['gps_sn']] : null;
				}
				$this->toRethink2("armada", $dataArray);
				$query = $this->db->table('s_last_log_armada')->upsertBatch($dataResult);
			} else {
				$response = ["success" => false, "message" => "No Data", "data" => null];
			}
		}

		#print_r($responseArray);
		#echo "Jumlah Bus".count($dataArray);

		if ($responseArray->ResponseCode == 1 && isset($dataArray)) {
			$response = ["success" => true, "message" => "Success", "data" => null];
		} else {
			$response = ["success" => false, "message" => "No Data", "data" => null];
		}
		return $this->response->setJson($response);
	}

	function vehiclesLastPositionPERINTIS()
	{


		#var_dump($gps_time);
		#echo "Tanggalaaaannn------------------------>".date_format($gps_time,"Y-m-d");
		echo "PERINTIS";
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
		  "status_vehicle": "all",
		  "geo_code": [],
		  "page": 0,
		  "encrypted": 0
		}',
			CURLOPT_HTTPHEADER => array(
				'Accept: application/json',
				'token: 5D2E4107855D498CB469777B21D12525', #perintis
				'Content-Type: application/json'
			),
		));

		$response = curl_exec($curl);
		#echo $response;

		curl_close($curl);

		$responseArray = json_decode($response);
		#var_dump($responseArray);
		$fields = array("gps_sn", "group_nm", "nopol", "company_nm", "direction", "stime", "speed", "lat", "lon", "acc", "battery_percent", "gps_time");
		$obj1 = new \stdClass;
		$dataResult = array();
		if ($responseArray->ResponseCode == 1) {
			foreach ($responseArray->Data as $key => $item) {
				if (date_format(date_create($item->gps_time), "Ymd") == date("Ymd")) {
					$item->group_nm = (($item->group_nm == "") ? "DAMRI-PERINTIS" : $item->group_nm);
					$dataArray[$key]['id'] = $item->gps_sn;
					#echo $item->gps_sn;
					foreach ($item as $key2 => $value) {
						if (in_array($key2, $fields)) {
							$dataArray[$key][$key2] = $value;
							$dataResult[$key][$key2] = $value;
						}
					}
				}
			}
			if (isset($dataArray) && count($dataResult) > 0) {
				#print_r($dataArray);
				#echo json_encode($dataArray);
				foreach ($dataArray as $key => $value) {
					$dataArray[$key]['route_id'] = (isset($this->dataroutesid[$value['gps_sn']])) ? $this->dataroutesid[$value['gps_sn']] : null;
				}
				$this->toRethink2("armada", $dataArray);
				$query = $this->db->table('s_last_log_armada')->upsertBatch($dataResult);
			} else {
				$response = ["success" => false, "message" => "No Data", "data" => null];
			}
		}

		#print_r($responseArray);
		echo "Jumlah Bus" . count($dataArray);

		if ($responseArray->ResponseCode == 1 && isset($dataArray)) {
			$response = ["success" => true, "message" => "Success", "data" => null];
		} else {
			$response = ["success" => false, "message" => "No Data", "data" => null];
		}
		return $this->response->setJson($response);
	}

	function toRethink2($table, $dataArray)
	{
		$curl = curl_init();
		$datapost['key']    = 'ngiraya';
		$datapost['table']  = $table;
		$datapost['data']   = $dataArray;
		#echo json_encode($datapost);
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

	public function listKecamatan()
	{
		$rs = $this->db->query("select a.id,a.idkabkota,a.kec from m_lokec a
		where a.idkabkota='3210' order by a.kec asc");
		if ($rs->getRow()) {
			$response = ["success" => true, "message" => "Success", "data" => $rs->getResult()];
		} else {
			$response = ["success" => false, "message" => "No Data", "data" => null];
		}
		return $this->response->setJson($response);
	}

	public function listKelurahan()
	{
		$rs = $this->db->query("select a.id,a.idkec,a.kel from m_lokkel a
		where a.idkec='" . addslashes($this->request->getPost('idkec')) . "' order by a.kel asc");
		if ($rs->getRow()) {
			$response = ["success" => true, "message" => "Success", "data" => $rs->getResult()];
		} else {
			$response = ["success" => false, "message" => "No Data", "data" => null];
		}
		return $this->response->setJson($response);
	}

	public function updateroute()
	{
		//print_r($this->request->getPost('dataparam'));
		parent::_insert('fleet_routes', $this->request->getPost('dataparam'));
	}

	public function updatebus()
	{
		//print_r($this->request->getPost('dataparam'));
		$tableName  = 's_last_log_armada';
		$data       =  $this->request->getPost('dataparam');
		$data['last_edited_at'] = date('Y-m-d H:i:s');
		$data['last_edited_by'] = $this->session->get('id');


		if ($this->baseModel->base_update($data, $tableName, array('gps_sn' => $data['gps_sn']))) {
			echo json_encode(array('success' => true, 'message' => $data));
		} else {
			echo json_encode(array('success' => false, 'message' => $this->baseModel->db->error()));
		}
	}

	// API google traffic
	public function getDirection($origin, $destination, $waypoints)
	{
		// echo 'https://maps.googleapis.com/maps/api/directions/json?departure_time=now&destination='.$destination.'&origin='.$origin.'&language=en&mode=driving&region=id&traffic_model=best_guess&key=AIzaSyAZ_q0TfPwQAQTTxHZQ7OhkQP7Le7_e4mo';
		$alternatives = '';
		if (strlen($waypoints) > 0) {
			$alternatives = '&waypoints=' . $waypoints;
		}
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://maps.googleapis.com/maps/api/directions/json?departure_time=now&destination=' . $destination . '&origin=' . $origin . '&language=en&mode=driving&region=id&traffic_model=best_guess&key=AIzaSyAZ_q0TfPwQAQTTxHZQ7OhkQP7Le7_e4mo' . $waypoints,
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
		$origin = $this->request->getPost('origin');
		$destination = $this->request->getPost('destination');
		$waypoints = $this->request->getPost('waypoints');
		if ($origin != '') {
			$origin_split = explode(",", $origin);
			$originLat = $origin_split[0];
			$originLng = $origin_split[1];
			#echo $originLat;

			$now = date_create_from_format('U.u', microtime(true));
			$datenow = $now->format("Y-m-d");
			$timenow = $now->format("H:i:s.u");
			#echo date('Y-m-d H:i:s.u');
			$datetimeunow = $datenow . "T" . $timenow . "Z";
			$d = new DateTime();
			$datenow = $d->format("Y-m-d") . "T"; // v : Milliseconds 
			$microtimenow = $d->format("H:i:s.uZ") . "Z";
			#echo 'T'.date('H:i:s.u');
			#echo 'T'.$d->format("H:i:s.u");
			$datetimeunow = $datenow . $microtimenow;

			if ($destination != '') {
				echo $this->getDirection($origin, $destination, $waypoints);
			} else {
				echo "No spesific destination point";
			}
		} else {
			echo "no spesific origin point";
		}
	}

	public function loadopsbus()
	{
		$rs = $this->db->query("select * from s_last_log_armada");
		$data['resbus'] = $rs->getResult();
		return view('App\Modules\Main\Views\opsbus_data', $data);
	}

	public function loadaduan()
	{
		// $rs = $this->db2->query("select * from t_aduan");
		// $data['resbus'] = $rs->getResult();
		//return view('App\Modules\Main\Views\aduan_data',$data);
		return view('App\Modules\Main\Views\aduan_data');
	}

	public function editbusstop()
	{
		return view('App\Modules\Main\Views\editbusstop');
	}


	//MITRA DARAT --------------------------------------------------------------------------------------------------------------------------------

	public function getCorridor()
	{
		// header('Content-Type: application/json');
        $datapost = file_get_contents('php://input');

        $datadec = $this->decrypted($datapost);
        parse_str($datadec, $queryArray);
        
        $data = $queryArray;

        $jenroute = $data['jenroute'];

		if ($jenroute != '') {
			$rs = $this->db->query("select a.id,b.name as route,a.origin,a.toward,a.points->>'$.\"0\"' as points,a.color,a.jenroute 
			from fleet_routes a 
			inner join m_routes b on a.kor=b.kor
			where b.id in (select route_id from bus_routes group by route_id) and b.jenroute=?", array($jenroute));
		} else {
			$rs = $this->db->query("select a.id,b.name as route,a.origin,a.toward,a.points->>'$.\"0\"' as points,a.color,a.jenroute 
			from fleet_routes a 
			inner join m_routes b on a.kor=b.kor
			where b.id in (select route_id from bus_routes group by route_id) ");
		}
		if ($rs->getNumRows() > 0) {
			$ret['status'] = "1";
			$ret['message'] = "Success";
			$ret['data'] = $rs->getResult();
		} else {
			$ret['status'] = "1";
			$ret['message'] = "Data Not Found";
			$ret['data'] = null;
		}

		return $this->response->setJson($ret);
	}

	function getRouteCorridor()
	{
		//error_reporting(0);
		// get routes shelter by kor

        $datapost = file_get_contents('php://input');

        $datadec = $this->decrypted($datapost);
        parse_str($datadec, $queryArray);
        
        $data = $queryArray;

        $route_id = $data['route_id'];
        $toward = $data['toward'];
        $origin = $data['origin'];

		$sql = "
		SELECT b.bs_id AS sh_id,
		  b.bs_nm AS sh_name,
		  a.id as route_id,
		  a.origin,
		  a.toward,
		  b.bs_lat AS sh_lat,
		  b.bs_lng AS sh_lng,
		  a.or_lat,
		  a.or_lng,
		  a.tw_lat,
		  a.tw_lng,
		  a.points->>'$.\"0\"' as points
	   FROM fleet_routes a
	  INNER JOIN bus_stop b ON FIND_IN_SET(b.bs_id,a.routes)
	  where a.id=? and a.toward=?
	  and a.origin=? and b.bs_stop = 1
			ORDER BY a.id,a.toward,FIND_IN_SET(b.bs_id,a.routes)";

		$rs = $this->db->query($sql, array($route_id, $toward, $origin));

		if (sizeof($rs->getResult()) > 0) {
			$response = [
				"status" => 1,
				"message" => "Success",
				"data" => $rs->getResult()
			];
		} else {
			$response = [
				"status" => 0,
				"message" => "Data Not Found"
			];
		}
		#$jsonArray = json_decode(file_get_contents('php://input'),true); 
		#print_r($jsonArray);
		#print_r($this->request->getPost());
		return $this->response->setJson($response);
	}

	function spdaList()
	{
		$datapost = file_get_contents('php://input');

        $datadec = $this->decrypted($datapost);
        parse_str($datadec, $queryArray);
        
        $data = $queryArray;
        $email = isset($data['email']) ? $data['email'] : '';
        $status = isset($data['status']) ? $data['status'] : '';
        $query_status = $status == "1" ? " and a.spda_status = ? and a.spda_status = ?" : " and (a.spda_status = ? or a.spda_status = ?)";
        $status1 = $status == "1" ? "0" : "1";
        $status2 = $status == "1" ? "0" : "2";

        $query = "SELECT a.id, a.trip_distance, a.spda_date, date_format(a.spda_dep_datetime,'%H:%i') as spda_dep_datetime, a.bus_capacity,
		a.spda_travelling_time, a.spda_earning, a.spda_status,
		b.kor, b.name as trayek_name ,c.name as trip_name, d.nopol,
		e.driver_name, f.ritke, 
		concat('(',concat_ws(' - ', date_format(f.dep_time,'%H:%i'), date_format(f.arr_time,'%H:%i')),')') as schedule_time, 
		g.user_web_name as verifikator,a.verif_at
		FROM spda_routes a
		LEFT JOIN m_routes b on a.route_id = b.id
		LEFT JOIN fleet_routes c on a.trip_id = c.id
		LEFT JOIN bus_routes d on a.bus_id = d.id
		LEFT JOIN driver_routes e on a.driver_id = e.id
		left join timetable_armada f on a.timetable_id = f.id
		left join m_user_web g on a.verif_by = g.id
		WHERE a.is_deleted = '0' and e.driver_email = ? " . $query_status;

		$rs = $this->db->query($query, array($email, $status1, $status2));

		$response = [
			"status" => 1,
			"message" => "Success",
			"data" => $rs->getResult(),
			// "query" => $query,
			// "status1" => $status1,
			// "status2" => $status2,
		];

		return $this->response->setJson($response);
	}

	function spdaManifestHistory()
	{
		$datapost = file_get_contents('php://input');

        $datadec = $this->decrypted($datapost);
        parse_str($datadec, $queryArray);
        
        $data = $queryArray;
        $spda_id = $data['spda_id'];

        $query = "SELECT a.*, date_format(a.created_at,'%d-%m-%Y %H:%i:%s') as waktu from spda_pass_routes a where a.spda_id = ? ";

		$rs = $this->db->query($query, array($spda_id));

		$response = [
			"status" => 1,
			"message" => "Success",
			"data" => $rs->getResult()
		];

		return $this->response->setJson($response);
	}

	function spdaManifestInsert()
	{
		$datapost = file_get_contents('php://input');

        $datadec = $this->decrypted($datapost);
        parse_str($datadec, $queryArray);
        
        $data = $queryArray;
  		// $naik_dl = $data['naik_dl'];
		// $naik_dp = $data['naik_dp'];
		// $naik_al = $data['naik_al'];
		// $naik_ap = $data['naik_ap'];
		// $naik_total = $data['naik_total'];
		// $turun_dl = $data['turun_dl'];
		// $turun_dp = $data['turun_dp'];
		// $turun_al = $data['turun_al'];
		// $turun_ap = $data['turun_ap'];
		// $turun_total = $data['turun_total'];

        if ($this->apiModel->base_insert($data, 'spda_pass_routes')) {
            echo json_encode(['status' => 1, 'message' => 'Success']);
        } else {
            echo json_encode(['status' => 0, 'message' => $this->apiModel->errors()]);
        }
	}

	function spdaFinish()
	{
		$datapost = file_get_contents('php://input');

        $datadec = $this->decrypted($datapost);
        parse_str($datadec, $queryArray);
        
        $data = $queryArray;
        $doneBy = $this->db->query('select id from m_user_web where user_web_email = ?', array($data['email']))->getRow();

        $this->db->transStart();
        
        $data['spda_status'] = '1';
        $data['spda_earning'] = str_replace(".", "", $data['spda_earning']);
        $data['done_by'] = $doneBy->id;
        $data['done_at'] = date('Y-m-d H:i:s');

        $id = $data['spda_id'];
        $pnp['spda_id'] = $id;
        $pnp['turun_dl'] = $data['turun_dl'];
        $pnp['turun_dp'] = $data['turun_dp'];
        $pnp['turun_al'] = $data['turun_al'];
        $pnp['turun_ap'] = $data['turun_ap'];
        $pnp['turun_total'] = $data['turun_total'];
        unset($data['spda_id']);
        unset($data['turun_dl']);
        unset($data['turun_dp']);
        unset($data['turun_al']);
        unset($data['turun_ap']);
        unset($data['turun_total']);
		unset($data['email']);

        $this->apiModel->base_insert($pnp, 'spda_pass_routes');
        $this->apiModel->base_update($data, 'spda_routes', ['id' => $id]);

        if ($this->db->transStatus() === FALSE) {
            $this->db->transRollback();
            $this->db->transComplete();
            echo json_encode(['status' => 0, 'message' => $this->apiModel->errors()]);
        } else {
            $this->db->transCommit();
            $this->db->transComplete();
            echo json_encode(['status' => 1, 'message' => 'Success']);
        }
	}
	//MITRA DARAT --------------------------------------------------------------------------------------------------------------------------------
}
