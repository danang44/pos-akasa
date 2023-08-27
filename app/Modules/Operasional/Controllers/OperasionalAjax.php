<?php

namespace App\Modules\Operasional\Controllers;

use App\Modules\Operasional\Models\OperasionalModel;
use App\Core\BaseController;
use App\Libraries\DataTables;

class OperasionalAjax extends BaseController
{
    private $operasionalModel;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->operasionalModel = new OperasionalModel();
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        return redirect()->to(base_url());
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

    public function idarmadamudik_select_get()
    {
        // $data = $this->request->getGet();
        // $query = "SELECT a.id , a.armada_name as 'text' FROM m_armada_mudik a where a.is_deleted='0'";
        // $where = ["a.armada_name"];

        // parent::_loadSelect2($data, $query, $where);
    }

    public function bptd_select_get()
    {
        $data = $this->request->getGet();
        $query = "SELECT lokker_id AS id, user_web_name AS 'text' FROM m_user_web WHERE is_deleted = 0 AND user_web_role_id = '4'";
        $where = ["user_web_name"];

        parent::_loadSelect2($data, $query, $where);
        // var_dump('<pre>', $this->db->getLastQuery() , '</pre>');
    }

    public function route_id_select_get()
    {
        $data = $this->request->getGet();
        
        if (isset($data['bptd_id'])) {
            $bptd_id = $data['bptd_id'];
            $bptd = $bptd_id != '' ? ' and a.bptd_id = "' . $data['bptd_id'] . '"' : '';
        } else {
            $bptd = $this->session->get('bptd_id') != 'all' ? ' and a.bptd_id = "' . $this->session->get('bptd_id') . '"' : '';
        }

        $operator_id = isset($data['operator_id']) ? $data['operator_id'] : '';
        if ($operator_id != '') {
            $operator = 'and b.operator_id = "' . $operator_id . '"';
        } else {
            $operator = $this->session->get('operator_id') != '' && $this->session->get('operator_id') != '0' ? ' and b.operator_id = "' . $this->session->get('operator_id') . '"' : '';
        }
        // $operator = $this->session->get('operator_id') != '' ? ' and b.operator_id = "' . $this->session->get('operator_id') . '"' : 'and b.operator_id = "' . $data['operator_id'] . '"';
        
        $query = "SELECT a.id, concat_ws(' | ',a.jenroute,a.group_nm,a.name) AS 'text'
                    FROM m_routes a
                    LEFT JOIN bus_routes b ON b.route_id = a.id
                    WHERE a.is_deleted = 0 $bptd";
        $where = ["a.jenroute", "a.name", "a.group_nm"];
        $orderBy = ["a.jenroute asc", "a.group_nm asc", "a.name"];
        $groupBy = ["a.id"];
        parent::_loadSelect2($data, $query, $where, $orderBy, $groupBy);
        // var_dump('<pre>', $this->db->getLastQuery() , '</pre>');
    }

    public function route_id_spda_select_get()
    {
        $data = $this->request->getGet();
        
        if (isset($data['bptd_id'])) {
            $bptd_id = $data['bptd_id'];
            $bptd = $bptd_id != '' ? ' and a.bptd_id = "' . $data['bptd_id'] . '"' : '';
        } else {
            $bptd = $this->session->get('bptd_id') != 'all' ? ' and a.bptd_id = "' . $this->session->get('bptd_id') . '"' : '';
        }

        $operator_id = isset($data['operator_id']) ? $data['operator_id'] : '';
        if ($operator_id != '') {
            $operator = 'and b.operator_id = "' . $operator_id . '"';
        } else {
            $operator = $this->session->get('operator_id') != '' && $this->session->get('operator_id') != '0' ? ' and b.operator_id = "' . $this->session->get('operator_id') . '"' : '';
        }
        // $operator = $this->session->get('operator_id') != '' ? ' and b.operator_id = "' . $this->session->get('operator_id') . '"' : 'and b.operator_id = "' . $data['operator_id'] . '"';
        
        $query = "SELECT a.id, concat_ws(' | ',a.jenroute,a.group_nm,a.name) AS 'text'
                    FROM m_routes a
                    LEFT JOIN bus_routes b ON b.route_id = a.id
                    WHERE a.is_deleted = 0 $bptd $operator";
        $where = ["a.jenroute", "a.name", "a.group_nm"];
        $orderBy = ["a.jenroute asc", "a.group_nm asc", "a.name"];
        $groupBy = ["a.id"];
        parent::_loadSelect2($data, $query, $where, $orderBy, $groupBy);
        // var_dump('<pre>', $this->db->getLastQuery() , '</pre>');
    }

    public function filter_route_id_select_get()
    {
        $data = $this->request->getGet();
        
        if (isset($data['bptd_id'])) {
            $bptd_id = $data['bptd_id'];
            $bptd = $bptd_id != '' ? ' and a.bptd_id = "' . $data['bptd_id'] . '"' : '';
        } else {
            $bptd = $this->session->get('bptd_id') != 'all' ? ' and a.bptd_id = "' . $this->session->get('bptd_id') . '"' : '';
        }

        $operator_id = isset($data['operator_id']) ? $data['operator_id'] : '';
        if ($operator_id != '') {
            $operator = 'and b.operator_id = "' . $operator_id . '"';
        } else {
            $operator = $this->session->get('operator_id') != '' && $this->session->get('operator_id') != '0' ? ' and b.operator_id = "' . $this->session->get('operator_id') . '"' : '';
        }
        // $operator = $this->session->get('operator_id') != '' ? ' and b.operator_id = "' . $this->session->get('operator_id') . '"' : 'and b.operator_id = "' . $data['operator_id'] . '"';
        
        $query = "SELECT a.id, concat_ws(' | ',a.jenroute,a.group_nm,a.name) AS 'text'
                    FROM m_routes a
                    LEFT JOIN bus_routes b ON b.route_id = a.id
                    WHERE a.is_deleted = 0 AND b.is_deleted = 0 $bptd $operator";
        $where = ["a.jenroute", "a.name", "a.group_nm"];
        $orderBy = ["a.jenroute asc", "a.group_nm asc", "a.name"];
        $groupBy = ["a.id"];
        parent::_loadSelect2($data, $query, $where, $orderBy, $groupBy);
        // var_dump('<pre>', $this->db->getLastQuery() , '</pre>');
    }

    function trip_id_select_get()
    {
        $data = $this->request->getGet();
        $trip_a = isset($data['trip_id_a']) ? $data['trip_id_a'] : '';
        $tripa = $trip_a != '' ? " and a.id != '" . $trip_a . "'" : '';
        $query = "SELECT 
                        a.id,
                        CONCAT_WS(' - ',b.jenroute,a.name) AS text,
                        GROUP_CONCAT(c.bs_nm ORDER BY a.kor,a.id,find_in_set(c.bs_id,a.routes) SEPARATOR '-') AS trip,
                        GROUP_CONCAT(concat_ws(',',c.bs_lat,c.bs_lng) ORDER BY a.kor,a.id,find_in_set(c.bs_id,a.routes) SEPARATOR '|') AS points
                    FROM fleet_routes a
                    LEFT JOIN m_routes b ON a.kor=b.kor
                    LEFT JOIN bus_stop c ON find_in_set(c.bs_id,a.routes)
                    WHERE a.is_deleted=0 AND b.id='" . $data['route_id'] . "' $tripa";
        $where = ["b.id"];
        $groupBy = ["a.id"];

        parent::_loadSelect2($data, $query, $where, null, $groupBy);
        // var_dump('<pre>', $this->db->getLastQuery(), '</pre>');
    }

    function trip_select_get()
    {
        $data = $this->request->getPost();
        $query = "SELECT 
                        a.id,
                        CONCAT_WS(' - ',b.jenroute,a.name) AS text,
                        GROUP_CONCAT(c.bs_nm ORDER BY a.kor,a.id,find_in_set(c.bs_id,a.routes) SEPARATOR '-') AS trip,
                        GROUP_CONCAT(concat_ws(',',c.bs_lat,c.bs_lng) ORDER BY a.kor,a.id,find_in_set(c.bs_id,a.routes) SEPARATOR '|') AS points
                    FROM fleet_routes a
                    LEFT JOIN m_routes b ON a.kor=b.kor
                    LEFT JOIN bus_stop c ON find_in_set(c.bs_id,a.routes)
                    WHERE a.is_deleted=0 AND b.id='" . $data['route_id'] . "' GROUP BY a.id";

        $result = $this->db->query($query)->getResult();

        if ($result) {
            $data = ['success' => true, 'message' => 'Data berhasil ditemukan', 'data' => $result];
        } else {
            $data = ['success' => false, 'message' => 'Data tidak ditemukan'];
        }

        return json_encode($data);
    }

    public function driver_id_select_get()
    {
        $data = $this->request->getGet();
        $query = "SELECT a.id , a.driver_name as 'text',b.kor,b.name FROM driver_routes a 
        inner join m_routes b on a.route_id=b.id
        where a.is_deleted='0' and b.id='" . $data['route_id'] . "' and a.operator_id = '" . $this->session->get('operator_id') . "'";
        $where = ["a.driver_name"];

        parent::_loadSelect2($data, $query, $where);
        // var_dump('<pre>', $this->db->getLastQuery(), '</pre>');
    }

    public function armada_id_select_get()
    {
        $data = $this->request->getGet();
        $bptd = $this->session->get('bptd_id') != 'all' && $this->session->get('bptd_id') != '' ? ' AND b.bptd_id = "' . $this->session->get('bptd_id') . '"' : '';
        $operator = $this->session->get('operator_id') != '' ? ' AND a.operator_id = "' . $this->session->get('operator_id') . '"' : '';
        $query = "SELECT a.id, concat_ws('-',a.bus_code, a.nopol) as 'text',a.capacity,a.gps_sn,a.bus_code,a.group_nm,c.cp_name as company_nm,b.kor,b.name
                    FROM bus_routes a 
                    INNER JOIN m_routes b ON a.route_id = b.id
                    LEFT JOIN po_routes c ON a.operator_id = c.id
                    WHERE a.is_deleted = '0' $bptd $operator and b.id = '" . $data['route_id'] . "'";
        $where = ["a.bus_code", "a.nopol"];
        parent::_loadSelect2($data, $query, $where);
    }

    public function bus_operator_select_get()
    {
        $data = $this->request->getGet();
        $po = $this->session->get('operator_id') != '' ? ' and a.operator_id = "' . $this->session->get('operator_id') . '"' : '';
        $query = "SELECT a.id, concat_ws('-',a.bus_code, a.nopol) as 'text',a.capacity,a.gps_sn,a.bus_code,a.group_nm,c.cp_name as company_nm,b.kor,b.name FROM bus_routes a 
        inner join m_routes b on a.route_id=b.id
        left join po_routes c on a.operator_id=c.id
        where a.is_deleted = '0' and b.id='" . $data['route_id'] . "'$po";
        $where = ["a.bus_code", "a.nopol"];

        parent::_loadSelect2($data, $query, $where);
    }

    public function po_id_select_get()
    {
        $data = $this->request->getGet();
        $po = $this->session->get('operator_id') != '' ? ' and a.id = "' . $this->session->get('operator_id') . '"' : '';
        $query = "SELECT a.cp_name as id,a.cp_name as 'text' FROM po_routes a 
        where a.is_deleted = '0' " . $po . " ";
        $where = ["a.cp_name"];

        parent::_loadSelect2($data, $query, $where);
    }

    public function timetable_id_select_get()
    {
        $data = $this->request->getGet();
        $query = "SELECT a.id, concat('Rit Ke-',a.ritke,' (',concat_ws(' - ', date_format(a.dep_time,'%H:%i'), date_format(a.arr_time,'%H:%i')),')') as 'text' FROM timetable_armada a 
        where a.is_deleted = '0' and a.trip_id = '" . $data['trip_id'] . "' ";
        $where = ["a.ritke", "a.dep_time", "a.arr_time"];

        parent::_loadSelect2($data, $query, $where);
        // var_dump('<pre>', $this->db->getLastQuery(), '</pre>');
    }

    public function armada_kapasitas_select_get()
    {
        // $data = $this->request->getGet();
        // $query = "SELECT a.id, a.armada_kapasitas as 'text' FROM m_armada a where a.is_deleted = '0'";
        // $where = ["a.armada_kapasitas"];

        // parent::_loadSelect2($data, $query, $where);
    }

    public function kategori_angkutan_id_select_get()
    {
        $data = $this->request->getGet();
        $query = "SELECT a.id , a.kategori_angkutan_name as 'text' FROM m_kategori_angkutan a where a.is_deleted='0'";
        // print_r($query);
        $where = ["a.kategori_angkutan_name"];
        parent::_loadSelect2($data, $query, $where);
    }

    public function jenis_pelayanan_select_get()
    {
        $data = $this->request->getGet();
        $query = "SELECT a.jenroute as id , a.jenroute as 'text' FROM m_jenis_angkutan_routes a where a.is_deleted='0'";
        $where = ["a.jenroute"];
        parent::_loadSelect2($data, $query, $where);
    }

    public function trayek_id_select_get()
    {
        $data = $this->request->getGet();
        $query = "SELECT a.id , a.route_name as 'text' FROM m_route a where a.is_deleted='0' and a.kategori_angkutan_id = '$data[kategori_angkutan_id]'";
        $where = ["a.route_name"];

        parent::_loadSelect2($data, $query, $where);
    }

    public function route_distance_select_get()
    {
        // $data = $this->request->getGet();
        // $id = $data['id'];
        // $query = "SELECT a.id , a.route_distance, a.route_time FROM m_route a where a.is_deleted='0' and a.id = '$id'";

        // return json_encode($this->db->query($query)->getResult());
    }

    function groupnm_select_get()
    {
        $data = $this->request->getGet();
        $poid = $data['po_id'] == '' ? '' : " and b.id = '" . $data['po_id'] . "'";
        $query = "SELECT a.group_nm as id,a.group_nm as 'text' from m_lokabkota a LEFT JOIN po_routes b ON a.id = b.cp_kabkota_id where a.is_deleted='0' and a.group_nm is not null";
        $where = ["a.group_nm"];

        parent::_loadSelect2($data, $query, $where);
        // var_dump('<pre>', $this->db->getLastQuery(), '</pre>');
    }

    function po_select_get()
    {
        $data = $this->request->getGet();

        if (isset($data['bptd_id'])) {
            $bptd_id = $data['bptd_id'] != '' ? 'and a.bptd_id = "' . $data['bptd_id'] . '"' : '';
            $bptdid = $bptd_id != '' ? $bptd_id : '';
        } else {
            $bptdid = $this->session->get('bptd_id') != 'all' ? 'and a.bptd_id = "' . $this->session->get('bptd_id') . '"' : '';
        }
        $po = $this->session->get('operator_id') != '' && $this->session->get('operator_id') != '0' ? 'and a.id = "' . $this->session->get('operator_id') . '"' : '';

        $query = "SELECT a.id, a.cp_prov_id, a.cp_kabkota_id, a.cp_kec_id, a.cp_kel_id, a.bptd_id, a.cp_name AS 'text' from po_routes a where a.is_deleted='0'" . $po . " " . $bptdid . " ";
        $where = ["a.cp_name"];

        parent::_loadSelect2($data, $query, $where);
        // var_dump('<pre>', $this->db->getLastQuery(), '</pre>');
    }

    function ppo_select_get()
    {
        $data = $this->request->getGet();
        $query = "SELECT a.id, a.user_web_name as 'text' from m_user_web a 
                  left join s_user_web_role b on a.user_web_role_id = b.id 
                  where a.is_deleted='0' and a.operator_id = '" . $this->session->get('operator_id') . "' and b.user_web_role_code='ppo'";
        $where = ["a.user_web_name"];

        parent::_loadSelect2($data, $query, $where);
    }

    function spda_select_get()
    {
        $data = $this->request->getGet();
        $query = "SELECT a.id, concat('Ritke-', d.ritke, ' | ', c.nopol, ' - ', b.name) as 'text' from spda_routes a 
        left join fleet_routes b on a.trip_id = b.id
        left join bus_routes c on a.bus_id = c.id
        left join timetable_armada d on a.timetable_id = d.id
        where a.is_deleted = '0' and a.spda_status = '0' and a.operator_id = '" . $this->session->get('operator_id') . "'";
        $where = ["b.name", "c.nopol", "d.ritke"];

        parent::_loadSelect2($data, $query, $where);
    }

    function ritke_select_get()
    {
        $data = $this->request->getGet();
        $bptd = $this->session->get('bptd_id') != 'all' ? ' and a.bptd_id = "' . $this->session->get('bptd_id') . '"' : '';
        $route = $data['route_id'] != '' ? ' and a.route_id = "' . $data['route_id'] . '"' : '';
        $operator = $this->session->get('operator_id') != '' ? ' and a.operator_id = "' . $this->session->get('operator_id') . '"' : '';
        $trip = $data['trip_id'] != '' ? ' and a.trip_id = "' . $data['trip_id'] . '"' : '';
        $query = "SELECT a.id, a.time_start, a.time_end, a.ritke, CONCAT('Rit Ke-', a.ritke, ' (', DATE_FORMAT(a.time_start, '%H:%i') ,'-', DATE_FORMAT(a.time_end, '%H:%i'),')') AS text
                    FROM timetable_bptd a
                    WHERE a.is_deleted = 0 " . $bptd . " " . $route . " " . $operator . " " . $trip . " ";
        $where = ["a.ritke"];
        $groupBy = ["a.ritke"];
        $orderBy = ["a.ritke ASC"];
        parent::_loadSelect2($data, $query, $where, $orderBy);
        // var_dump('<pre>', $this->db->getLastQuery(), '</pre>');
    }

    function ritke_tt_armada_select_get()
    {
        $data = $this->request->getGet();
        $bptd = $this->session->get('bptd_id') != 'all' ? ' and a.bptd_id = "' . $this->session->get('bptd_id') . '"' : '';
        $route = $data['route_id'] != '' ? ' and a.route_id = "' . $data['route_id'] . '"' : '';
        $operator = $this->session->get('operator_id') != '' ? ' and a.operator_id = "' . $this->session->get('operator_id') . '"' : '';
        if (strlen($route) > 0 ) {
        $query = "SELECT GROUP_CONCAT(a.id) as id, GROUP_CONCAT(a.time_start) AS time_start, GROUP_CONCAT(a.time_end) AS time_end, a.ritke, GROUP_CONCAT(b.name) AS trip_name, GROUP_CONCAT(b.id) AS trip_id,
                    CONCAT('Rit Ke-', a.ritke, ' | ', GROUP_CONCAT(CONCAT(DATE_FORMAT(a.time_start, '%H:%i') ,'-', DATE_FORMAT(a.time_end, '%H:%i')) separator ' | ')) AS text
                    FROM timetable_bptd a
                    LEFT JOIN fleet_routes b ON a.trip_id = b.id
                    WHERE a.is_deleted = 0 " . $bptd . " " . $route . " " . $operator . " ";
        } else {
            $query = "SELECT a.id, GROUP_CONCAT(a.time_start) AS time_start, GROUP_CONCAT(a.time_end) AS time_end, a.ritke, GROUP_CONCAT(b.name) AS trip_name, GROUP_CONCAT(b.id) AS trip_id,
                    CONCAT('Rit Ke-', a.ritke, ' | ', GROUP_CONCAT(CONCAT(DATE_FORMAT(a.time_start, '%H:%i') ,'-', DATE_FORMAT(a.time_end, '%H:%i')) separator ' | ')) AS text
                    FROM timetable_bptd a
                    LEFT JOIN fleet_routes b ON a.trip_id = b.id
                    WHERE a.is_deleted = 99 " . $route . " ";
        }
        $where = ["a.ritke"];
        $groupBy = ["a.timetable_code"];
        $orderBy = ["time_start ASC"];
        parent::_loadSelect2($data, $query, $where, $orderBy, $groupBy);
        // var_dump('<pre>', $this->db->getLastQuery(), '</pre>');
    }

    function get_time_start_end_by_ritke()
    {
        $data = $this->request->getPost();
        $query = "SELECT a.id, a.time_start, a.time_end
                    FROM timetable_bptd a
                    WHERE a.is_deleted = 0 AND a.bptd_id = '" . $this->session->get('bptd_id') . "' AND a.ritke = '" . $data['ritke'] . "'";
        $rs = $this->db->query($query)->getResult();

        if ($rs) {
            $result = ['success' => true, 'message' => 'Data berhasil ditemukan', 'data' => $rs];
        } else {
            $result = ['success' => false, 'message' => 'Data tidak ditemukan'];
        }

        return json_encode($result);
    }

    function dep_time_select_get()
    {
        $data = $this->request->getGet();
        $query = "SELECT a.id, a.time_start AS text
                    FROM timetable_bptd a
                    WHERE a.is_deleted = 0 AND a.bptd_id = '" . $this->session->get('bptd_id') . "' AND a.id = '" . $data['ritke'] . "'";
        $where = ["a.time_start"];
        $groupBy = ["a.time_start"];
        $orderBy = ["a.time_start ASC"];

        parent::_loadSelect2($data, $query, $where, $orderBy, $groupBy);
        // var_dump('<pre>', $this->db->getLastQuery(), '</pre>');
    }

    function arr_time_select_get()
    {
        $data = $this->request->getGet();
        $query = "SELECT a.id, a.time_end AS text
                    FROM timetable_bptd a
                    WHERE a.is_deleted = 0 AND a.bptd_id = '" . $this->session->get('bptd_id') . "' AND a.id = '" . $data['ritke'] . "' AND a.time_start = '" . $data['dep_time'] . "'";
        $where = ["a.time_end"];

        parent::_loadSelect2($data, $query, $where);
    }

    function getSpdaPending()
    {
        $data = $this->request->getGet();
        $bptd = $this->session->get('bptd_id') != 'all' ? "and b.bptd_id = '" . $this->session->get('bptd_id') . "'" : "";
        $po = $this->session->get('operator_id') != '' ? "and d.operator_id = '" . $this->session->get('operator_id') . "'" : "";

        if ($this->session->get('role_code') == 'pop') {
            $query = "SELECT a.*,b.kor,b.name AS route_name,c.name AS trip_name,d.nopol,e.driver_name,f.ritke, concat(g.cp_type, '. ', g.cp_name) AS po_name
            FROM spda_routes a
            LEFT JOIN m_routes b ON a.route_id = b.id
            LEFT JOIN fleet_routes c ON a.trip_id = c.id
            LEFT JOIN bus_routes d ON a.bus_id = d.id
            LEFT JOIN driver_routes e ON a.driver_id = e.id
            LEFT JOIN timetable_armada f ON a.timetable_id = f.id
            LEFT JOIN po_routes g ON d.operator_id = g.id
            WHERE a.is_deleted = '0' AND a.spda_status != '2' $bptd $po ORDER BY a.id DESC";
        } else if ($this->session->get('role_code') == 'ppo') {
            $query = "SELECT a.*,b.kor,b.name AS route_name,c.name AS trip_name,d.nopol,e.driver_name,f.ritke, concat(g.cp_type, '. ', g.cp_name) AS po_name
            FROM spda_routes a
            LEFT JOIN m_routes b ON a.route_id = b.id
            LEFT JOIN fleet_routes c ON a.trip_id = c.id
            LEFT JOIN bus_routes d ON a.bus_id = d.id
            LEFT JOIN driver_routes e ON a.driver_id = e.id
            LEFT JOIN timetable_armada f ON a.timetable_id = f.id
            LEFT JOIN po_routes g ON d.operator_id = g.id
            WHERE a.is_deleted = '0' AND a.spda_status = '0' $bptd $po ORDER BY a.id DESC";
        } else {
            $query = "SELECT a.*,b.kor,b.name AS route_name,c.name AS trip_name,d.nopol,e.driver_name,f.ritke, concat(g.cp_type, '. ', g.cp_name) AS po_name
            FROM spda_routes a
            LEFT JOIN m_routes b ON a.route_id = b.id
            LEFT JOIN fleet_routes c ON a.trip_id = c.id
            LEFT JOIN bus_routes d ON a.bus_id = d.id
            LEFT JOIN driver_routes e ON a.driver_id = e.id
            LEFT JOIN timetable_armada f ON a.timetable_id = f.id
            LEFT JOIN po_routes g ON d.operator_id = g.id
            WHERE a.is_deleted = '0' AND a.spda_status = '1' $bptd $po ORDER BY a.id DESC";
        }

        $result = $this->db->query($query)->getResult();

        if ($result) {
            $data = ['success' => true, 'message' => 'Data berhasil ditemukan', 'data' => $result];
        } else {
            $data = ['success' => false, 'message' => 'Data tidak ditemukan'];
        }

        // var_dump('<pre>', $this->db->getLastQuery(), '</pre>');
        return json_encode($data);
    }

    function timetable_select_get()
    {
        $data = $this->request->getGet();
        $bptd = $this->session->get('bptd_id') != 'all' ? "and b.bptd_id = '" . $this->session->get('bptd_id') . "'" : "";
        $po = $this->session->get('operator_id') != '' ? "and b.operator_id = '" . $this->session->get('operator_id') . "'" : "";
        $query = "SELECT a.id, concat('Ritke-',a.ritke,' | ',c.nopol,' - ',b.name) as 'text' FROM timetable_bptd a
        LEFT JOIN fleet_routes b ON a.trip_id = b.id
        LEFT JOIN bus_routes c ON a.bus_id = c.id
        WHERE a.is_deleted = '0' $bptd ORDER BY a.id DESC";
        $where = ["b.name", "c.nopol", "a.ritke"];

        parent::_loadSelect2($data, $query, $where);
    }

    public function getBlueAPI()
    {
        $noken = $this->request->getPost('no_registrasi_kendaraan');

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://mitradarat.dephub.go.id/api/v1/blue',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('no_registrasi_kendaraan' => $noken),
            CURLOPT_HTTPHEADER => array('X-NGI-TOKEN: dev'),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }

    public function checkGpsSn()
    {
        $data = $this->request->getPost();
        $query = "SELECT a.gps_sn, a.group_nm, a.nopol, a.company_nm, a.direction, a.speed, a.acc, a.stime, a.gps_time, a.lat, a.lon, a.battery_percent, a.stime_b, a.gps_time_b, a.gap, a.route_id, a.last_edited_at, a.last_edited_by 
                    FROM s_last_log_armada a 
                    WHERE a.gps_sn = ?";

        $result = $this->db->query($query, [$data['gps_sn']])->getRow();

        if ($result) {
            $data = ['success' => true, 'message' => 'Data berhasil ditemukan', 'data' => $result];
        } else {
            $data = ['success' => false, 'message' => 'Data tidak ditemukan'];
        }
        echo json_encode($data);
    }

    public function getSpionamAPI()
    {
        $curl = curl_init();

        $noken = $this->request->getPost('no_registrasi_kendaraan');

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://mitradarat.dephub.go.id//api/v1/spionam',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('noken' => $noken),
            CURLOPT_HTTPHEADER => array('X-NGI-TOKEN: dev',
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }
}
