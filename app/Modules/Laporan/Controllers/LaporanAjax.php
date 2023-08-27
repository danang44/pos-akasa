<?php

namespace App\Modules\Laporan\Controllers;

use App\Modules\Laporan\Models\LaporanModel;
use App\Core\BaseController;

class LaporanAjax extends BaseController
{
    private $laporanModel;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->laporanModel = new LaporanModel();
    }

    public function index()
    {
        return redirect()->to(base_url());
    }

    function id_select_get_bus()
    {
        $data = $this->request->getGet();
        if ($this->session->get('role_code') == 'pop' || $this->session->get('role_code') == 'ppo') {
            $query = "SELECT a.id, CONCAT(a.group_nm, ' (', a.nopol,')') AS 'text' 
                        FROM bus_routes a 
                        WHERE a.is_deleted = 0 
                        AND a.operator_id = '" . $this->session->get('operator_id') . "'";
        } else if ($this->session->get('role_code') == 'bpw') {
            $query = "SELECT a.id, CONCAT(a.group_nm, ' (', a.nopol,')') AS 'text' 
                        FROM bus_routes a 
                        INNER JOIN m_routes b ON a.route_id = b.id
                        WHERE a.is_deleted = 0 AND b.is_deleted = 0 
                        AND b.bptd_id = '" . $this->session->get('bptd_id') . "'";
        } else {
            $query = "SELECT a.id, CONCAT(a.group_nm, ' (', a.nopol,')') AS 'text' 
                        FROM bus_routes a 
                        WHERE a.is_deleted = 0";
        }
        $where = ["a.group_nm", "a.nopol"];

        parent::_loadSelect2($data, $query, $where);
    }

    function id_select_get_trayek()
    {
        $data = $this->request->getGet();
        $bptd = $this->session->get('bptd_id') != 'all' ? ' and a.bptd_id = "' . $this->session->get('bptd_id') . '"' : '';
        $query = "SELECT a.id, concat_ws(' | ',a.jenroute,a.group_nm,a.name) as 'text' FROM m_routes a where a.is_deleted='0' " . $bptd . " ";
        $where = ["a.jenroute", "a.name", "a.group_nm"];

        parent::_loadSelect2($data, $query, $where);
    }

   
}
