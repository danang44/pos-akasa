<?php

namespace App\Core;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use CodeIgniter\Controller;
use App\Core\BaseModel;

class BaseController extends Controller
{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = ['extension', 'apires'];

	protected $session;

	protected $baseModel;

	protected $db;


	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:
		// $this->session = \Config\Services::session();
		$this->baseModel = new BaseModel(\Config\Services::request());
		$this->session = \Config\Services::session();
		$this->db = \Config\Database::connect();
	}

    protected function sha512($payload, $secret_key)
    {
        $algo = 'sha512';
        $signed_payload = hash_hmac($algo, $payload, $secret_key, true);
        return $signed_payload;
    }

	protected function _authView($data = array())
	{
		$url = uri_segment(1);
		$module = uri_segment(0);
		$menu = $this->session->get('menu');

		$authentication = array_filter($menu, function ($arr) use ($url, $module) {
			return strtolower($arr->menu_url) == strtolower($url) && strtolower($arr->module_url) == strtolower($module);
		});

		if (count($authentication) == 1) {
			if (array_values($authentication)[0]->v != "1") {
				// $this->baseModel->log_action("view", "Akses Ditolak");

				$data['load_view'] = 'App\Modules\Main\Views\error';
				return view('App\Modules\Main\Views\layout', $data);
			} else {
				// $this->baseModel->log_action("view", "Akses Diberikan");

				$data['page_title'] = array_values($authentication)[0]->menu_name;
				$data['load_view'] = 'App\Modules\\' . ucfirst(array_values($authentication)[0]->module_url) . '\Views\\' . array_values($authentication)[0]->menu_url;
				$data['rules'] = array_values($authentication)[0];
				return view('App\Modules\Main\Views\layout', $data);
			}
		} else {
			// $this->baseModel->log_action("view", "Akses Ditolak");

			$data['load_view'] = 'App\Modules\Main\Views\error';
			return view('App\Modules\Main\Views\layout', $data);
		}
	}

	protected function _authViewPage($data = array())
	{
		$url = uri_segment(1);
		$module = uri_segment(0);
		$menu = $this->session->get('menu');

		$authentication = array_filter($menu, function ($arr) use ($url, $module) {
			return strtolower($arr->menu_url) == strtolower($url) && strtolower($arr->module_url) == strtolower($module);
		});

		if (count($authentication) == 1) {
			if (array_values($authentication)[0]->v != "1") {
				// $this->baseModel->log_action("view", "Akses Ditolak");

				$data['load_view'] = 'App\Modules\Main\Views\error';
				return view('App\Modules\Main\Views\layoutpage', $data);
			} else {
				// $this->baseModel->log_action("view", "Akses Diberikan");

				$data['page_title'] = array_values($authentication)[0]->menu_name;
				$data['load_view'] = 'App\Modules\\' . ucfirst(array_values($authentication)[0]->module_url) . '\Views\\' . array_values($authentication)[0]->menu_url;
				$data['rules'] = array_values($authentication)[0];
				return view('App\Modules\Main\Views\layoutpage', $data);
			}
		} else {
			// $this->baseModel->log_action("view", "Akses Ditolak");

			$data['load_view'] = 'App\Modules\Main\Views\error';
			return view('App\Modules\Main\Views\layoutpage', $data);
		}
	}

	protected function _authViewmodal($data = array())
	{
		$url = uri_segment(1);
		$module = uri_segment(0);
		$menu = $this->session->get('menu');

		$authentication = array_filter($menu, function ($arr) use ($url, $module) {
			return strtolower($arr->menu_url) == strtolower($url) && strtolower($arr->module_url) == strtolower($module);
		});

		if (count($authentication) == 1) {
			if (array_values($authentication)[0]->v != "1") {
				// $this->baseModel->log_action("view", "Akses Ditolak");

				$data['load_view'] = 'App\Modules\Main\Views\error';
				return view('App\Modules\Main\Views\layoutmodal', $data);
			} else {
				// $this->baseModel->log_action("view", "Akses Diberikan");

				$data['page_title'] = array_values($authentication)[0]->menu_name;
				$data['load_view'] = 'App\Modules\\' . ucfirst(array_values($authentication)[0]->module_url) . '\Views\\' . array_values($authentication)[0]->menu_url;
				$data['rules'] = array_values($authentication)[0];
				return view('App\Modules\Main\Views\layoutmodal', $data);
			}
		} else {
			// $this->baseModel->log_action("view", "Akses Ditolak");

			$data['load_view'] = 'App\Modules\Main\Views\error';
			return view('App\Modules\Main\Views\layoutmodal', $data);
		}
	}

	protected function _auth($action, $var_action, callable $authenticated)
	{
		$referers = explode("/", $_SERVER['HTTP_CUSTOMREF'] ?? $_SERVER['HTTP_REFERER']);
		$referer = end($referers);
		$module = $referers[count($referers) - 2];
		$menu = $this->session->get('menu');

		$authentication = array_filter($menu, function ($arr) use ($referer, $module) {
			return strtolower($arr->menu_url) == strtolower($referer) && strtolower($arr->module_url) == strtolower($module);
		});

		if (count($authentication) == 1 && $referer != "" && array_values($authentication)[0]->$var_action == "1") {
			$this->baseModel->log_action($action, "Akses Diberikan");

			if ($action == "detail") {
				return $authenticated();
			} else {
				$authenticated();
			}
		} else {
			$this->baseModel->log_action($action, "Akses Ditolak");

			if ($action == "load") {
				die(json_encode(array("data" => [], "recordsTotal" => 0, "recordsFiltered" => 0)));
			} else if ($action == "detail") {
				die(view('App\Modules\Main\Views\error'));
			} else {
				die(json_encode(array('success' => false, 'message' => 'Anda tidak mempunyai hak akses untuk ini', 'debug' => array_values($authentication)[0])));
			}
		}
	}

	protected function _authInsert(callable $authenticated)
	{
		$this->_auth("insert", "i", $authenticated);
	}

	protected function _authEdit(callable $authenticated)
	{
		$this->_auth("edit", "e", $authenticated);
	}

	protected function _authDelete(callable $authenticated)
	{
		$this->_auth("delete", "d", $authenticated);
	}

	protected function _authVerif(callable $authenticated)
	{
		$this->_auth("verif", "o", $authenticated);
	}

	protected function _authLoad(callable $authenticated)
	{
		$this->_auth("load", "v", $authenticated);
	}

	protected function _authUpload(callable $authenticated)
	{
		$this->_auth("upload", "i", $authenticated);
	}

	protected function _authDownload(callable $authenticated)
	{
		$this->_auth("download", "v", $authenticated);
	}

	protected function _authDetail(callable $authenticated)
	{
		return $this->_auth("detail", "v", $authenticated);
	}

	protected function _loadDatatable($query, $where, $data, $groupby = NULL)
	{
		$start = $_POST["start"];
		$length = $_POST["length"];
		$search = $_POST["search"];
		$order = $_POST["order"][0];
		$columns = $_POST["columns"];
		$key = $search["value"];
		$orderColumn = $columns[$order["column"]]["data"];
		$orderDirection = $order["dir"];

		$result = $this->baseModel->base_load_datatable($query, $where, $key, $start, $length, $orderColumn, $orderDirection, $groupby);

		echo json_encode(array("data" => $result["data"], "recordsTotal" => $result["allData"], "recordsFiltered" => $result["filteredData"]));
	}

	protected function _loadDatatableOrderBy($query, $where, $data, $groupby = NULL, $orderby)
	{
		$start = $_POST["start"];
		$length = $_POST["length"];
		$search = $_POST["search"];
		$order = $_POST["order"][0];
		$columns = $_POST["columns"];
		$key = $search["value"];
		$orderColumn = $columns[$order["column"]]["data"];
		$orderDirection = $order["dir"];

		$result = $this->baseModel->base_load_datatable_orderby($query, $where, $key, $start, $length, $orderColumn, $orderDirection, $groupby, $orderby);

		echo json_encode(array("data" => $result["data"], "recordsTotal" => $result["allData"], "recordsFiltered" => $result["filteredData"]));
	}

	protected function _insert($tableName, $data, callable $callback = NULL)
	{
		if ($data['id'] == "") {
			$data['created_by'] = $this->session->get('id');

			if ($this->baseModel->base_insert($data, $tableName)) {
				if ($callback != NULL) {
					$callback();
				}

				echo json_encode(array('success' => true, 'message' => $data));
			} else {
				echo json_encode(array('success' => false, 'message' => $this->baseModel->db->error()));
			}
		} else {
			$id = $data['id'];
			$data['last_edited_at'] = date('Y-m-d H:i:s');
			$data['last_edited_by'] = $this->session->get('id');
			unset($data['id']);

			if ($this->baseModel->base_update($data, $tableName, array('id' => $id))) {
				if ($callback != NULL) {
					$callback();
				}

				echo json_encode(array('success' => true, 'message' => $data));
			} else {
				echo json_encode(array('success' => false, 'message' => $this->baseModel->db->error()));
			}
		}
	}

	protected function _insertbatch($tableName, $data, callable $callback = NULL)
	{
		// if($data['id'] == ""){
		// $data['created_by'] = $this->session->get('id');

		if ($this->baseModel->base_insertbatch($data, $tableName)) {
			if ($callback != NULL) {
				$callback();
			}

			echo json_encode(array('success' => true, 'message' => 'data berhasil terinput'));
		} else {
			echo json_encode(array('success' => false, 'message' => $this->baseModel->db->error()));
		}
		// }else{
		// $id = $data['id'];
		// $data['last_edited_at'] = date('Y-m-d H:i:s');
		// $data['last_edited_by'] = $this->session->get('id');
		// unset($data['id']);

		// if($this->baseModel->base_update($data, $tableName, array('id' => $id))){
		// if($callback!=NULL) { $callback(); }

		// echo json_encode(array('success' => true, 'message' => $data));
		// }else{
		// echo json_encode(array('success' => false, 'message' => $this->baseModel->db->error()));
		// }
		// }
	}

	protected function _edit($tableName, $data, $keys = NULL, $query = NULL)
	{
		$key = $keys == NULL ? 'id' : $keys;
		$rs = $query == NULL ? $this->baseModel->base_get($tableName, [$key => $data[$key]])->getRow() : $this->baseModel->db->query($query)->getRow();

		if (!is_null($rs)) {
			echo json_encode(array('success' => true, 'data' => $rs));
		} else {
			echo json_encode(array('success' => false, 'message' => $this->baseModel->db->error()['message']));
		}
	}

	protected function _editbatch($tableName, $data, $keys = NULL, $query = NULL)
	{
		$key = $keys == NULL ? 'id' : $keys;
		$rs = $query == NULL ? $this->baseModel->base_get($tableName, [$key => $data[$key]])->getResult() : $this->baseModel->db->query($query)->getResult();

		if (!is_null($rs)) {
			echo json_encode(array('success' => true, 'data' => $rs));
		} else {
			echo json_encode(array('success' => false, 'message' => $this->baseModel->db->error()['message']));
		}
	}

	protected function _mobile_insert($tableName, $data, callable $callback = NULL)
	{
		if ($data['id'] == "") {
			$data['created_by'] = $data['user_id'];
			unset($data['user_id']);
			if ($this->baseModel->base_insert($data, $tableName)) {
				if ($callback != NULL) {
					$callback();
				}

				echo json_encode(array('success' => true, 'message' => 'success'));
			} else {
				echo json_encode(array('success' => false, 'message' => $this->baseModel->db->error()));
			}
		} else {
			$id = $data['id'];
			$data['last_edited_at'] = date('Y-m-d H:i:s');
			$data['last_edited_by'] = $data['user_id'];
			unset($data['id']);
			unset($data['user_id']);

			if ($this->baseModel->base_update($data, $tableName, array('id' => $id))) {
				if ($callback != NULL) {
					$callback();
				}

				echo json_encode(array('success' => true, 'message' => $data));
			} else {
				echo json_encode(array('success' => false, 'message' => $this->baseModel->db->error()));
			}
		}
	}

	protected function _delete($tableName, $data)
	{
		if ($this->baseModel->base_delete($tableName, $data)) {
			echo json_encode(array('success' => true));
		} else {
			echo json_encode(array('success' => false, 'message' => $this->baseModel->db->error()));
		}
	}

	protected function _loadSelect2($data, $query, $where, $orderBy = NULL, $groupBy = NULL)
	{
		$keyword = $data['keyword'] ?? "";
		$page = $data['page'];
		$perpage = $data['perpage'];

		$result = $this->baseModel->base_load_select2($query, $where, $keyword, $page, $perpage, $orderBy, $groupBy);

		echo json_encode(array("page" => $page, "perpage" => $perpage, "total" => count($result), "rows" => $result));
	}

	protected function _loadSelect2GroupBy($data, $query, $where, $orderBy = NULL, $groupBy = NULL)
	{
		$keyword = $data['keyword'] ?? "";
		$page = $data['page'];
		$perpage = $data['perpage'];

		$result = $this->baseModel->base_load_select2($query, $where, $keyword, $page, $perpage, $orderBy, $groupBy);

		echo json_encode(array("page" => $page, "perpage" => $perpage, "total" => count($result), "rows" => $result));
	}

	protected function _exportPdf($data)
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
