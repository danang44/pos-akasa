<?php

namespace App\Modules\Administrator\Controllers;

use App\Modules\Administrator\Models\AdministratorModel;
use App\Core\BaseController;

class AdministratorAction extends BaseController
{
    private $administratorModel;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->administratorModel = new AdministratorModel();
    }

    public function index()
    {
        return redirect()->to(base_url());
    }

    function manmodul_load()
    {
        parent::_authLoad(function () {
            $query = "select a.* from s_module a where a.is_deleted = 0";
            $where = ["a.module_url", "a.module_name"];

            parent::_loadDatatable($query, $where, $this->request->getPost());
        });
    }

    function manmodul_save()
    {
        parent::_authInsert(function () {
            parent::_insert('s_module', $this->request->getPost());
        });
    }

    function manmodul_edit()
    {
        parent::_authEdit(function () {
            parent::_edit('s_module', $this->request->getPost());
        });
    }

    function manmodul_delete()
    {
        parent::_authDelete(function () {
            parent::_delete('s_module', $this->request->getPost());
        });
    }

    function manmenu_load()
    {
        parent::_authLoad(function () {
            $query = "select a.*, b.module_name, c.menu_name as menu_parent from s_menu a 
            left join s_module b on a.module_id = b.id
            left join s_menu c on a.menu_id = c.id
            where a.is_deleted = 0 ";
            $where = ["a.menu_url", "a.menu_name", "b.module_name", "c.menu_name"];

            parent::_loadDatatable($query, $where, $this->request->getPost());
        });
    }

    function manmenu_save()
    {
        parent::_authInsert(function () {
            $data = $this->request->getPost();
            $data['menu_id'] = $this->request->getPost('menu_id') == "" ? null : $this->request->getPost('menu_id');
            parent::_insert('s_menu', $data);
        });
    }

    function manmenu_edit()
    {
        parent::_authEdit(function () {
            parent::_edit('s_menu', $this->request->getPost());
        });
    }

    function manmenu_delete()
    {
        parent::_authDelete(function () {
            parent::_delete('s_menu', $this->request->getPost());
        });
    }

    function manjenisuser_load()
    {
        parent::_authLoad(function () {
            $query = "select a.* from s_user_web_role a where a.is_deleted = 0";
            $where = ["a.user_web_role_name"];

            parent::_loadDatatable($query, $where, $this->request->getPost());
        });
    }

    function manjenisuser_save()
    {
        parent::_authInsert(function () {
            parent::_insert('s_user_web_role', $this->request->getPost());
        });
    }

    function manjenisuser_edit()
    {
        parent::_authEdit(function () {
            parent::_edit('s_user_web_role', $this->request->getPost());
        });
    }

    function manjenisuser_delete()
    {
        parent::_authDelete(function () {
            parent::_delete('s_user_web_role', $this->request->getPost());
        });
    }

    function manuser_load()
    {
        parent::_authLoad(function () {
            $data = $this->request->getPost();
            $filter = $data['filter'];
            $role = $this->session->get('role') == "1" ? '' : ' AND a.user_web_role_id > ' . $this->session->get('role') . ' ';
            $rolebyid = isset($filter['role_id']) && $filter['role_id'] != '' ? ' AND a.user_web_role_id = ' . $filter['role_id'] . ' ' : '';
            $bptd = $this->session->get('bptd_id') == 'all' ? '' : ' AND a.lokker_id = ' . $this->session->get('bptd_id') . ' ';
            $query = "SELECT a.*, b.user_web_role_name
                        FROM m_user_web a
                        LEFT JOIN s_user_web_role b ON a.user_web_role_id = b.id 
                        WHERE a.is_deleted = 0" . $role . $bptd . $rolebyid;
            $where = ["a.user_web_name", "a.user_web_username", "a.user_web_email", "b.user_web_role_name"];

            parent::_loadDatatable($query, $where, $this->request->getPost());
        });
    }

    function manuser_save()
    {
        parent::_authInsert(function () {
            $data = $this->request->getPost();
            if (isset($data["satpel_id"]) || isset($data["bptd_id"])) {
                $data["lokker_id"] = (isset($data["satpel_id"]) && $data["satpel_id"] != "") ? $data["satpel_id"] : $data["bptd_id"];
                unset($data['satpel_id']);
                unset($data['bptd_id']);
            }

            if ($data['id'] != '') {
                $record = $this->administratorModel->getUser($data['id'])[0];
                if ($record->user_web_password != $data['user_web_password']) {
                    $data["user_web_password"] = md5($data["user_web_password"]);
                }
            } else {
                $data["user_web_password"] = md5($data["user_web_password"]);
            }
            parent::_insert('m_user_web', $data);
        });
    }

    function manuser_edit()
    {
        parent::_authEdit(function () {
            $query = "SELECT a.*, b.terminal_name as lokker_name, 
            c.id as bptd_id, c.terminal_name as bptd_name, d.id as po_id, d.cp_name as po_name, e.user_web_role_code FROM m_user_web a
            left join m_lokker b on b.id = a.lokker_id
            left join m_lokker c on c.id = b.parent_id
            left join po_routes d on a.operator_id = d.id
            left join s_user_web_role e on a.user_web_role_id = e.id
            where a.is_deleted = 0 and a.id = '" . $this->request->getPost('id') . "' ";

            parent::_edit('m_user_web', $this->request->getPost(), null, $query);
        });
    }

    function manuser_delete()
    {
        parent::_authDelete(function () {
            parent::_delete('m_user_web', $this->request->getPost());
        });
    }


    function manhakakses_save()
    {
        parent::_authInsert(function () {
            $number_menu = count($this->request->getPost('idmenu'));
            $deleted = explode(",", $this->request->getPost('delete'));

            $previlagesData = [];
            for ($i = 0; $i < $number_menu; $i++) {
                $previlagesData[] = [
                    "id" => $this->request->getPost('id')[$i],
                    "menu_id" => $this->request->getPost('idmenu')[$i],
                    "v" => unwrap_null(@$this->request->getPost('v')[$i], "0"),
                    "i" => unwrap_null(@$this->request->getPost('i')[$i], "0"),
                    "d" => unwrap_null(@$this->request->getPost('d')[$i], "0"),
                    "e" => unwrap_null(@$this->request->getPost('e')[$i], "0"),
                    "o" => unwrap_null(@$this->request->getPost('o')[$i], "0"),
                    "user_web_role_id" => $this->request->getPost('iduser'),
                    "created_by" => $this->session->get('id'),
                    "created_at" => date("Y-m-d H:i:s")
                ];
            }

            if ($this->administratorModel->saveHakAkses($previlagesData, $deleted, $this->request->getPost('iduser'))) {
                echo json_encode(array('success' => true, 'message' => $previlagesData));
            } else {
                echo json_encode(array('success' => false, 'message' => $this->administratorModel->db->error()));
            }
        });
    }

    function dataprovinsi_load()
    {
        parent::_authLoad(function () {
            $query = "select a.* from m_lokprov a where a.is_deleted = 0";
            $where = ["a.prov"];

            parent::_loadDatatable($query, $where, $this->request->getPost());
        });
    }

    function dataprovinsi_save()
    {
        parent::_authInsert(function () {
            parent::_insert('m_lokprov', $this->request->getPost());
        });
    }

    function dataprovinsi_edit()
    {
        parent::_authEdit(function () {
            parent::_edit('m_lokprov', $this->request->getPost());
        });
    }

    function dataprovinsi_delete()
    {
        parent::_authDelete(function () {
            parent::_delete('m_lokprov', $this->request->getPost());
        });
    }

    function datakabupaten_load()
    {
        parent::_authLoad(function () {
            $query = "SELECT a.*, b.prov as namaprov from m_lokabkota a inner join m_lokprov b on a.idprov=b.id and b.is_deleted='0' where a.is_deleted = 0";
            $where = ["a.kabkota", "b.prov"];

            parent::_loadDatatable($query, $where, $this->request->getPost());
        });
    }

    function datakabupaten_save()
    {
        parent::_authInsert(function () {
            parent::_insert('m_lokabkota', $this->request->getPost());
        });
    }

    function datakabupaten_edit()
    {
        parent::_authEdit(function () {
            $data = $this->request->getPost();
            $query = "SELECT a.*, b.prov as namaprov from m_lokabkota a inner join m_lokprov b on a.idprov=b.id and b.is_deleted='0' where a.is_deleted = 0 and a.id = '" . $this->request->getPost('id') . "' ";

            parent::_edit('m_lokabkota', $data, null, $query);
        });
    }

    function datakabupaten_delete()
    {
        parent::_authDelete(function () {
            parent::_delete('m_lokabkota', $this->request->getPost());
        });
    }

    function datakecamatan_load()
    {
        parent::_authLoad(function () {
            $query = "SELECT a.*,b.kabkota, c.prov as namaprov FROM m_lokec a INNER JOIN m_lokabkota b on a.idkabkota=b.id and b.is_deleted='0' inner join m_lokprov c on b.idprov=c.id and c.is_deleted='0' where a.is_deleted = 0";
            $where = ["a.kec", "b.kabkota", "c.prov"];

            parent::_loadDatatable($query, $where, $this->request->getPost());
        });
    }

    function datakecamatan_save()
    {
        parent::_authInsert(function () {
            parent::_insert('m_lokec', $this->request->getPost());
        });
    }

    function datakecamatan_edit()
    {
        parent::_authEdit(function () {
            $data = $this->request->getPost();
            $query = "SELECT a.*, b.idprov ,b.kabkota as namakabkota, c.prov as namaprov FROM m_lokec a INNER JOIN m_lokabkota b on a.idkabkota=b.id and b.is_deleted='0' inner join m_lokprov c on b.idprov=c.id and c.is_deleted='0' where a.is_deleted = 0 and a.id = '" . $this->request->getPost('id') . "' ";

            parent::_edit('m_lokec', $data, null, $query);
        });
    }

    function datakecamatan_delete()
    {
        parent::_authDelete(function () {
            parent::_delete('m_lokec', $this->request->getPost());
        });
    }

    function datakelurahan_load()
    {
        parent::_authLoad(function () {
            $query = "SELECT a.id, a.kel, b.kec as namakec  , b.idkabkota, c.kabkota as namakabkota  , c.idprov, d.prov as namaprov FROM m_lokkel a INNER JOIN m_lokec b on a.idkec=b.id and b.is_deleted='0' INNER JOIN m_lokabkota c on b.idkabkota=c.id and c.is_deleted='0' INNER JOIN m_lokprov d on c.idprov=d.id and d.is_deleted='0' WHERE a.is_deleted = 0";
            $where = ["a.kel", "b.kec", "c.kabkota", "d.prov"];

            parent::_loadDatatable($query, $where, $this->request->getPost());
        });
    }

    function datakelurahan_save()
    {
        parent::_authInsert(function () {
            parent::_insert('m_lokkel', $this->request->getPost());
        });
    }

    function datakelurahan_edit()
    {
        parent::_authEdit(function () {
            $data = $this->request->getPost();
            $query = "SELECT a.*, b.kec as nama_kec  , b.idkabkota, c.kabkota as namakabkota  , c.idprov, d.prov as namaprov FROM m_lokkel a INNER JOIN m_lokec b on a.idkec=b.id and b.is_deleted='0' INNER JOIN m_lokabkota c on b.idkabkota=c.id and c.is_deleted='0' INNER JOIN m_lokprov d on c.idprov=d.id and d.is_deleted='0' WHERE a.is_deleted = 0 and a.id = '" . $this->request->getPost('id') . "' ";

            parent::_edit('m_lokkel', $data, null, $query);
        });
    }

    function datakelurahan_delete()
    {
        parent::_authDelete(function () {
            parent::_delete('m_lokkel', $this->request->getPost());
        });
    }
    function manjenpel_load()
    {
        parent::_authLoad(function () {
            $query = "SELECT a.id, a.jenroute FROM m_jenis_angkutan_routes a WHERE a.is_deleted = 0";
            $where = ["a.jenroute"];

            parent::_loadDatatable($query, $where, $this->request->getPost());
        });
    }

    function manjenpel_save()
    {
        parent::_authInsert(function () {
            parent::_insert('m_lokkel', $this->request->getPost());
        });
    }

    function manjenpel_edit()
    {
        parent::_authEdit(function () {
            $data = $this->request->getPost();
            $query = "SELECT a.* FROM m_jenis_angkutan_routes a WHERE a.is_deleted = 0 and a.id = '" . $this->request->getPost('id') . "' ";
            parent::_edit('m_lokkel', $data, null, $query);
        });
    }

    function manjenpel_delete()
    {
        parent::_authDelete(function () {
            parent::_delete('m_lokkel', $this->request->getPost());
        });
    }
}
