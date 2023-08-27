<?php

namespace App\Modules\Main\Controllers;

use App\Modules\Main\Models\MainModel;
use App\Modules\Api\Controllers\MobileV1;
use App\Core\BaseController;

class MainAction extends BaseController
{
	private $mainModel;
	private $mobileV1Controller;

	/**
	 * Constructor.
	 */
	public function __construct()
	{
		$this->mainModel = new MainModel();
		$this->mobileV1Controller = new MobileV1();
	}

	public function index()
	{
		return redirect()->to(base_url());
	}

	function userprofile_save()
	{
		$session = \Config\Services::session();
		if ($this->request->getPost('user_web_password') != '') {
			$datapost['id'] = $session->get('id');
			$datapost['user_web_password'] = md5($this->request->getPost('user_web_password'));
			parent::_insert('m_user_web', $datapost);
		} else {
			$response['success'] = false;
			$response['message'] = "Nothing Action";
			echo json_encode($response);
		}
	}

	function bus_update()
	{
		$session = \Config\Services::session();
		$datapost = $this->request->getPost();
		$datapost['last_edited_by'] = $session->get('id');
		$where['gps_sn'] = $datapost['gps_sn'];
		unset($datapost['gps_sn']);
		if (!$this->db->table("s_last_log_armada")->where('gps_sn', $where['gps_sn'])->update($datapost)) {
			$response['success'] = false;
			$response['message'] = "Terjadi Kesalahan";
			echo json_encode($response);
		} else {
			$response['success'] = true;
			$response['message'] = "Data tersimpan";
			echo json_encode($response);
		}
	}

	function saveUpdateLocation()
	{
		$datapost = $this->request->getPost();
		$where['bs_id'] = $datapost['bs_id'];
		unset($datapost['bs_id']);
		if (!$this->db->table("bus_stop")->where('bs_id', $where['bs_id'])->update($datapost)) {
			$response['success'] = false;
			$response['message'] = "Terjadi Kesalahan";
			echo json_encode($response);
		} else {
			$response['success'] = true;
			$response['message'] = "Lokasi Update";
			echo json_encode($response);
		}
	}

	function savebusstop()
	{
		$datapost = $this->request->getPost('dataparam');
		if (!$this->db->table("bus_stop")->insert($datapost)) {
			$response['success'] = false;
			$response['message'] = "Terjadi Kesalahan";
			echo json_encode($response);
		} else {
			$response['success'] = true;
			$response['message'] = "Bus Stop tersimpan";
			echo json_encode($response);
		}
	}

	function renameBusstop()
	{
		$datapost = $this->request->getPost();

		$where['bs_id'] = $datapost['id'];
		unset($datapost['id']);
		if (!$this->db->table("bus_stop")->where('bs_id', $where['bs_id'])->update($datapost)) {
			$response['success'] = false;
			$response['message'] = "Terjadi Kesalahan";
			echo json_encode($response);
		} else {
			$response['success'] = true;
			$response['message'] = "Bus Stop Renamed";
			echo json_encode($response);
		}
	}

	function delfromroutesave()
	{
		$datapost = $this->request->getPost();
		//str_replace(search, replace, subject)
		$newroutes = str_replace($datapost['bs_id'], '', $datapost['routes']);
		$datapost['routes'] = str_replace(',,', ',', $newroutes);
		$where['id'] = $datapost['route_id'];
		$data['routes'] = $datapost['routes'];
		if (!$this->db->table("fleet_routes")->where('id', $where['id'])->update($data)) {
			$response['success'] = false;
			$response['message'] = "Terjadi Kesalahan";
			echo json_encode($response);
		} else {
			$response['success'] = true;
			$response['message'] = "Waypoint telah dihapus";
			echo json_encode($response);
		}
	}

	function addtoroutesave()
	{
		$datapost = $this->request->getPost();
		//str_replace(search, replace, subject)
		$newroutes = str_replace($datapost['bs_id_before'], $datapost['bs_id_before'] . "," . $datapost['bs_id'], $datapost['routes']);
		$datapost['routes'] = $newroutes;
		$where['id'] = $datapost['route_id'];
		$data['routes'] = $datapost['routes'];
		if (!$this->db->table("fleet_routes")->where('id', $where['id'])->update($data)) {
			$response['success'] = false;
			$response['message'] = "Terjadi Kesalahan";
			echo json_encode($response);
		} else {
			$response['success'] = true;
			$response['message'] = "Waypoint telah ditambahkan";
			echo json_encode($response);
		}
	}

	function aduan_update()
	{
		$datapost = $this->request->getPost();
		$where['id'] = $datapost['aduan_id'];
		$data['aduan_reply'] = $datapost['aduan_reply'];
		if (!$this->db2->table("t_aduan")->where('id', $where['id'])->update($data)) {
			$response['success'] = false;
			$response['message'] = "Terjadi Kesalahan";
			echo json_encode($response);
		} else {
			$response['success'] = true;
			$response['message'] = $datapost['aduan_id'];
			echo json_encode($response);
		}
	}

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

	function addtrayeksave()
	{
		$datapost = $this->request->getPost('dataparam');

		if ($datapost['group_nm'] == "" || $datapost["jenroute"] == "" || $datapost['start_point'] == "" || $datapost['end_point'] == "") {
			$response['success'] = false;
			$response['message'] = "Isi data dengan benar";
			echo json_encode($response);
			return;
		}

		$datapost['id'] = "";

		$origin = "";
		if ($datapost['start_point']) {
			$startPoint = $this->db->query("Select * From bus_stop Where bs_id = " . $datapost['start_point'])->getRow();
			$datapost['origin'] = $startPoint->bs_nm;
			$datapost['or_lat'] = $startPoint->bs_lat;
			$datapost['or_lng'] = $startPoint->bs_lng;

			$origin = $startPoint->bs_lat . "," .  $startPoint->bs_lng;
		}

		$destination = "";
		if ($datapost['end_point']) {
			$endPoint = $this->db->query("Select * From bus_stop Where bs_id = " . $datapost['end_point'])->getRow();
			$datapost['toward'] = $endPoint->bs_nm;
			$datapost['tw_lat'] = $endPoint->bs_lat;
			$datapost['tw_lng'] = $endPoint->bs_lng;

			$destination = $endPoint->bs_lat . "," . $endPoint->bs_lng;
		}

		$waypoints = "";

		$callApiMapsDirectionStart = $this->mobileV1Controller->getDirection($origin, $destination, $waypoints);
		$decodeApiMapsDirectionStart = json_decode($callApiMapsDirectionStart);

		if (!isset($decodeApiMapsDirectionStart->routes[0])) {
			$response['success'] = false;
			$response['message'] = "Rute tidak bisa digunakan";
			echo json_encode($response);
			return;
		}

		$pointStart = $decodeApiMapsDirectionStart->routes[0]->overview_polyline->points;
		$pointJsonStart = '{"0": "' . str_replace("\n", "\\n", addslashes($pointStart)) . '"}';

		$datapost['points_start'] = $pointJsonStart;

		$callApiMapsDirectionEnd = $this->mobileV1Controller->getDirection($destination, $origin, $waypoints);
		$decodeApiMapsDirectionEnd = json_decode($callApiMapsDirectionEnd);

		if (!isset($decodeApiMapsDirectionEnd->routes[0])) {
			$response['success'] = false;
			$response['message'] = "Rute tidak bisa digunakan";
			echo json_encode($response);
			return;
		}

		$pointEnd = $decodeApiMapsDirectionEnd->routes[0]->overview_polyline->points;
		$pointJsonEnd = '{"0": "' . str_replace("\n", "\\n", addslashes($pointEnd)) . '"}';

		$datapost['points_end'] = $pointJsonEnd;

		$datapost['routes_start'] = $startPoint->bs_id . "," . $endPoint->bs_id;
		$datapost['routes_end'] = $endPoint->bs_id . "," . $startPoint->bs_id;
		$datapost['created_at'] = date('Y-m-d H:i:s');
		$datapost['created_by'] = $this->session->get('id');

		$data = array(
			array(
				'id' => $datapost['id'],
				'group_nm' => $datapost['group_nm'],
				'name' => $datapost['origin'] . ' - ' . $datapost['toward'],
				'jenroute' => $datapost['jenroute'],
				'color' => $datapost['color'],
				'origin' => $datapost['origin'],
				'or_lat' => $datapost['or_lat'],
				'or_lng' => $datapost['or_lng'],
				'toward' => $datapost['toward'],
				'tw_lat' => $datapost['tw_lat'],
				'tw_lng' => $datapost['tw_lng'],
				'points' => $datapost['points_start'],
				'waypoints' => '{}',
				'routes' => $datapost['routes_start'],
				'created_at' => $datapost['created_at'],
				'created_by' => $datapost['created_by']
			),
			array(
				'id' => $datapost['id'],
				'group_nm' => $datapost['group_nm'],
				'name' => $datapost['toward'] . ' - ' . $datapost['origin'],
				'jenroute' => $datapost['jenroute'],
				'color' => $datapost['color'],
				'origin' => $datapost['toward'],
				'or_lat' => $datapost['tw_lat'],
				'or_lng' => $datapost['tw_lng'],
				'toward' => $datapost['origin'],
				'tw_lat' => $datapost['or_lat'],
				'tw_lng' => $datapost['or_lng'],
				'points' => $datapost['points_end'],
				'waypoints' => '{}',
				'routes' => $datapost['routes_end'],
				'created_at' => $datapost['created_at'],
				'created_by' => $datapost['created_by']
			)
		);

		parent::_insertbatch('fleet_routes', $data);
	}

	//ini dipake untuk upload image dari core events
	function uploadFiles()
	{
		$files = $this->request->getFiles();
		$folder = $this->request->getPost('folder');

		if ($file = $files['file']) {
			if ($file->isValid() && !$file->hasMoved()) {
				$newName = $file->getRandomName();
				$file->move(ROOTPATH . 'assets/' . $folder, $newName);

				echo json_encode(array('success' => true, 'url' => base_url() . '/assets/' . $folder . $newName));
			} else {
				echo json_encode(array('success' => true, 'error' => $file->getErrorString()));
			}
		} else {
			echo json_encode(array('success' => true, 'error' => 'file null'));
		}
	}

	public function spda_pdf()
	{
		$id = $this->request->getPost('id_pdf');
		$query = "SELECT a.*,b.kor,b.name as trayek_name,c.name as trip_name,
            d.nopol,e.driver_name,f.ritke,g.user_web_name as bptd_name, sum(h.naik_total) as tot_passenger
            FROM spda_routes a
            LEFT JOIN m_routes b on a.route_id = b.id
            LEFT JOIN fleet_routes c on a.trip_id = c.id
            LEFT JOIN bus_routes d on a.bus_id = d.id
            LEFT JOIN driver_routes e on a.driver_id = e.id
            Left join timetable_armada f on a.timetable_id = f.id
            left join m_user_web g on a.verif_by = g.id
            left join spda_pass_routes h on a.id = h.spda_id
            WHERE a.is_deleted = '0' and a.id = ?";
		$data = $this->db->query($query, array($id))->getRow();

		// var_dump($this->db->getLastQuery());
		$this->_exportPdf(['data' => $data]);
	}

	function _exportPdf($data)
	{
		$view = uri_segment(2);
		$module = uri_segment(0);
		$mpdf = new \Mpdf\Mpdf([
			// 'format' => [210, 330], // F4 potrait
			// 'format' => [330, 210],
			'format' => [210, 297],
			'tempDir' => ROOTPATH . 'writable/cache'
		]);
		// $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [210, 297]]);
		// $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [210, 148]]);
		$html = view('App\Modules\\' . ucfirst($module) . '\Views\\' . $view, $data);

		$pagecount = $mpdf->SetSourceFile('./assets/templateF4P.pdf', 2);
		$tplId = $mpdf->importPage($pagecount);
		$mpdf->SetPageTemplate($tplId);

		$mpdf->AddPage(
			'P',
			'',
			'',
			'',
			'',
			7, // margin_left
			7, // margin right
			25, // margin top
			10, // margin bottom
			10, // margin header
			10
		); // margin footer

		// $mpdf->repeat_header = '1';

		// $mpdf->useTemplate($tplId, 0, 0, 210, 297);
		$mpdf->useTemplate($tplId, 0, 0, 210, 330);
		// $mpdf->useTemplate($tplId, 0, 0, 297, 210);
		// mpdf sethtmlfooter

		$mpdf->WriteHTML($html);
		$this->response->setHeader('Content-Type', 'application/pdf');
		$mpdf->Output($view . '-' . date('d-m-Y H:i:s') . '.pdf', 'I');
	}
}
