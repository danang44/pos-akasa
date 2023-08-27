<?php

namespace App\Modules\Laporan\Controllers;

use App\Modules\Laporan\Models\LaporanModel;
use App\Core\BaseController;

class LaporanAction extends BaseController
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

    public function lapharianspda_load()
    {
        parent::_authLoad(function () {
            $data = $this->request->getPost();
            // print_r($data);
            // die;
            if (isset($data['trayek_id']) && $data['trayek_id'] != 'null') {
                $wh = $data['spda_status'] != '99' && $data['spda_status'] != '' ? " AND a.spda_status = '" . $data['spda_status'] . "' " : "";
                $query = "select CONCAT(c.group_nm, ' (', c.nopol,')') AS bus_name, d.ritke, a.spda_date,
                cast(concat('[', group_concat(json_object('trip_dist',a.trip_distance,'trip_name',b.name,'total_pnp',a.pnp_ttl, 'spda_status',a.spda_status)), ']') as json) as detail
                from (select a.*, ifnull(sum(b.naik_total),0) as pnp_ttl 
                FROM spda_routes a
                LEFT JOIN spda_pass_routes b ON a.id = b.spda_id
                group by a.id) a
                LEFT JOIN fleet_routes b ON a.trip_id = b.id
                LEFT JOIN bus_routes c ON a.bus_id = c.id
                LEFT JOIN timetable_armada d ON a.timetable_id = d.id
                WHERE a.is_deleted = 0 AND a.route_id = '" . $data['trayek_id'] . "' AND a.spda_date between '" . $data['spda_date_start'] . "' and '" . $data['spda_date_end'] . "' " . $wh . "
                GROUP BY a.bus_id, a.spda_date, d.ritke
                ORDER BY a.spda_date, d.ritke ASC";
                $result = $this->db->query($query)->getResult();
                // $result = 'hello';
            } else if (isset($data['bus_id']) && $data['bus_id'] != 'null') {
                $wh = $data['spda_status'] != '99' && $data['spda_status'] != '' ? " AND a.spda_status = '" . $data['spda_status'] . "' " : "";
                $query = "select CONCAT(c.group_nm, ' (', c.nopol,')') AS bus_name, d.ritke, a.spda_date,
                cast(concat('[', group_concat(json_object('trip_dist',a.trip_distance,'trip_name',b.name,'total_pnp',a.pnp_ttl, 'spda_status',a.spda_status)), ']') as json) as detail
                from (select a.*, ifnull(sum(b.naik_total),0) as pnp_ttl 
                FROM spda_routes a
                LEFT JOIN spda_pass_routes b ON a.id = b.spda_id
                group by a.id) a
                LEFT JOIN fleet_routes b ON a.trip_id = b.id
                LEFT JOIN bus_routes c ON a.bus_id = c.id
                LEFT JOIN timetable_armada d ON a.timetable_id = d.id
                WHERE a.is_deleted = 0 AND a.bus_id = '" . $data['bus_id'] . "' AND a.spda_date between '" . $data['spda_date_start'] . "' and '" . $data['spda_date_end'] . "' " . $wh . "
                GROUP BY a.bus_id, a.spda_date, d.ritke
                ORDER BY a.spda_date, d.ritke ASC";
                $result = $this->db->query($query)->getResult();
            //    $result = 'hello2';
            } else {
            }

            // echo $this->db->getLastQuery();
            if (count($result) > 0) {
                $data = ['success' => true, 'message' => 'Data berhasil diambil', 'data' => $result];
            } else {
                $data = ['success' => true, 'message' => 'Data tidak ditemukan', 'data' => []];
            }
            echo json_encode($data);
        });
    }

    public function lapharianspda_pdf()
    {
        parent::_authDownload(function () {
            $bus_id = $this->request->getPost('bus_id');
            $spda_date_start = $this->request->getPost('spda_dat_start');
            $spda_date_end = $this->request->getPost('spda_dat_end');
            $spda_status = $this->request->getPost('spda_status');

            $wh = $spda_status != '99' && $spda_status != '' ? " AND a.spda_status = '" . $spda_status . "' " : "";

            $query = "select CONCAT(c.group_nm, ' (', c.nopol,')') AS bus_name, d.ritke, a.spda_date,
                        cast(concat('[', group_concat(json_object('trip_dist',a.trip_distance,'trip_name',b.name,'total_pnp',a.pnp_ttl, 'spda_status',a.spda_status)), ']') as json) as detail
                        from (select a.*, ifnull(sum(b.naik_total),0) as pnp_ttl 
                        FROM spda_routes a
                        LEFT JOIN spda_pass_routes b ON a.id = b.spda_id
                        group by a.id) a
                        LEFT JOIN fleet_routes b ON a.trip_id = b.id
                        LEFT JOIN bus_routes c ON a.bus_id = c.id
                        LEFT JOIN timetable_armada d ON a.timetable_id = d.id
                        WHERE a.is_deleted = 0 AND a.bus_id = ? AND a.spda_date between ? and ?  " . $wh . "
                        GROUP BY a.bus_id, a.spda_date, d.ritke
                        ORDER BY a.spda_date, d.ritke ASC";

            $iferror = "SET SESSION group_concat_max_len = 500000;";

            $query1 = "SELECT
                        CONCAT(c.group_nm, ' (', c.nopol, ')') AS bus_name,
                        d.ritke, a.spda_date,
                        cast(
                            concat(
                                '[',
                                group_concat(
                                    json_object(
                                        'trip_dist',
                                        a.trip_distance,
                                        'trip_name',
                                        b.name,
                                        'naik_dl',
                                        a.naik_dl,
                                        'naik_dp',
                                        a.naik_dp,
                                        'naik_al',
                                        a.naik_al,
                                        'naik_ap',
                                        a.naik_ap,
                                        'naik_total',
                                        a.naik_total,
                                        'turun_dl',
                                        a.turun_dl,
                                        'turun_dp',
                                        a.turun_dp,
                                        'turun_al',
                                        a.turun_al,
                                        'turun_ap',
                                        a.turun_ap,
                                        'turun_total',
                                        a.turun_total,
                                        'spda_status',
                                        a.spda_status
                                    )
                                ),
                                ']'
                            ) AS JSON
                        ) AS detail
                    FROM
                        (
                            SELECT
                                a.*,
                                ifnull(sum(b.naik_dl), 0) AS naik_dl,
                                ifnull(sum(b.naik_dp), 0) AS naik_dp,
                                ifnull(sum(b.naik_al), 0) AS naik_al,
                                ifnull(sum(b.naik_ap), 0) AS naik_ap,
                                ifnull(sum(b.naik_total), 0) AS naik_total,
                                ifnull(sum(b.turun_dl), 0) AS turun_dl,
                                ifnull(sum(b.turun_dp), 0) AS turun_dp,
                                ifnull(sum(b.turun_al), 0) AS turun_al,
                                ifnull(sum(b.turun_ap), 0) AS turun_ap,
                                ifnull(sum(b.turun_total), 0) AS turun_total
                            FROM spda_routes a
                            LEFT JOIN spda_pass_routes b ON a.id = b.spda_id
                            GROUP BY a.id
                        ) a
                    LEFT JOIN fleet_routes b ON a.trip_id = b.id
                    LEFT JOIN bus_routes c ON a.bus_id = c.id
                    LEFT JOIN timetable_armada d ON a.timetable_id = d.id
                    WHERE a.is_deleted = 0 AND a.bus_id = ? AND a.spda_date between ? and ? " . $wh . "
                    GROUP BY a.bus_id, a.spda_date, d.ritke
                    ORDER BY d.ritke ASC";

            $query2 = "SELECT po.*,b.prov,c.kabkota,d.kec,e.kel from spda_routes a
                        left join po_routes po on a.operator_id = po.id
                        left join m_lokprov b on po.cp_prov_id = b.id
                        left join m_lokabkota c on po.cp_kabkota_id = c.id
                        left join m_lokec d on po.cp_kec_id = d.id
                        left join m_lokkel e on po.cp_kel_id = e.id
                        WHERE a.is_deleted = 0 AND a.bus_id = ? AND a.spda_date between ? and ? " . $wh . "
                        GROUP BY a.bus_id, a.spda_date;";

            $this->db->query($iferror);
            $data = $this->db->query($query1, [$bus_id, $spda_date_start, $spda_date_end])->getResult();
            $po = $this->db->query($query2, [$bus_id, $spda_date_start, $spda_date_end])->getRow();

            // print_r('<pre>');
            // print_r($this->db->getLastQuery());
            // print_r('</pre>');
            // die;
            parent::_exportPdfLapHarianSpda(['data' => $data, 'po' => $po]);
        });
    }

    public function lapharianspda_save()
    {
        parent::_authInsert(function () {
        });
    }

    public function lapharianspda_edit()
    {
        parent::_authEdit(function () {
        });
    }

    public function lapharianspda_delete()
    {
        parent::_authDelete(function () {
        });
    }
}
