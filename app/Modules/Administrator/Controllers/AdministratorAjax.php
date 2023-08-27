<?php

namespace App\Modules\Administrator\Controllers;

use App\Modules\Administrator\Models\AdministratorModel;
use App\Core\BaseController;

class AdministratorAjax extends BaseController
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

    public function menu_select_get($module_id)
    {
        $menu = $this->administratorModel->base_get('s_menu', ['module_id' => $module_id, 'menu_id' => NULL, 'is_deleted' => 0])->getResult();

        $option = array_map(function ($data) {
            return "<option value='" . $data->id . "'>" . $data->menu_name . "</option>";
        }, $menu);

        echo "<option value=''>Jadikan Menu Utama</option>" . implode("", $option);
    }

    public function moduleuser_get()
    {
        $module_user = groupby($this->administratorModel->getModuleUser($_POST['id']), 'module_id');

        echo json_encode($module_user);
    }

    public function menu_get($module_id)
    {
        $menus = $this->administratorModel->getParentMenu($module_id);
        $array = array_map(function ($menu) {
            $x = json_decode(json_encode($menu), true);
            $x['submenu'] = $this->administratorModel->getSubMenu($x['id']);

            return $x;
        }, $menus);

        echo json_encode($array);
    }

    public function module_select_get()
    {
        $module = $this->administratorModel->getModules();

        $option = array_map(function ($data) {
            return "<option value='" . $data->id . "'>" . $data->module_name . "</option>";
        }, $module);

        return "<select class='idmodule' name='idmodule[]' required>
                <option value=''>Pilih Modul</option>" .
            implode("", $option) . "<select>";
    }

    function idprov_select_get()
    {
        $data = $this->request->getGet();
        $query = "SELECT a.id , a.prov as 'text',a.singkatan FROM m_lokprov a where a.is_deleted='0'";
        $where = ["a.prov", "a.singkatan"];

        parent::_loadSelect2($data, $query, $where);
    }

    function idkabkota_select_get()
    {
        $data = $this->request->getGet();
        $query = "SELECT a.id , a.kabkota as 'text' from m_lokabkota a where a.is_deleted='0' and  a.idprov='" . $data['idprov'] . "'";
        $where = ["a.kabkota"];

        parent::_loadSelect2($data, $query, $where);
    }

    function id_kec_select_get()
    {
        $data = $this->request->getGet();
        $query = "SELECT a.id, a.kec as 'text' from m_lokec a where a.is_deleted='0' and  a.idkabkota='" . $data['idkabkota'] . "' ";
        $where = ["a.kec"];

        parent::_loadSelect2($data, $query, $where);
    }

    function id_kel_select_get()
    {
        $data = $this->request->getGet();
        $query = "SELECT a.id, a.kel as 'text' from m_lokkel a where a.is_deleted='0' and  a.idkec='" . $data['idkec'] . "' ";
        $where = ["a.kel"];

        parent::_loadSelect2($data, $query, $where);
    }

    function bptd_select_get()
    {
        $data = $this->request->getGet();
        $bptd_id = !isset($data['bptd_id'])?null:$data['bptd_id'];
        $bptdid = $bptd_id == 'all' || $bptd_id == null ? '' : " and a.id = '" . $bptd_id . "'";
        $query = "SELECT a.id, a.terminal_name as 'text' from m_lokker a where a.is_deleted='0' and a.lokker_type='BPTD' $bptdid";
        $where = ["a.terminal_name"];

        parent::_loadSelect2($data, $query, $where, ["a.lokprov_id"]);
        // var_dump('<pre>' . $this->db->getLastQuery() . '</pre>');
    }

    function satpel_select_get()
    {
        $data = $this->request->getGet();
        $bptd_id = $data['bptd_id'];
        $query = "SELECT a.id, a.terminal_name as 'text' from m_lokker a where a.is_deleted='0' and a.parent_id = '" . $bptd_id . "'";
        $where = ["a.terminal_name"];

        parent::_loadSelect2($data, $query, $where, ["a.lokprov_id"]);
    }

    function po_select_get()
    {
        $data = $this->request->getGet();
        $bptd_id = $data['bptd_id'];
        $bptdid = $bptd_id == 'all' ? '' : " and a.bptd_id = '" . $bptd_id . "'";
        $query = "SELECT a.id, a.cp_name as 'text' from po_routes a where a.is_deleted='0' $bptdid";
        $where = ["a.cp_name"];

        parent::_loadSelect2($data, $query, $where);
    }
}
