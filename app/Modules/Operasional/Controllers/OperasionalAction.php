<?php

namespace App\Modules\Operasional\Controllers;

use App\Modules\Operasional\Models\OperasionalModel;
use App\Core\BaseController;

class OperasionalAction extends BaseController
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

    public function pengemudi_load()
    {
        parent::_authLoad(function () {
            $data = $this->request->getPost();
            $filter = $data['filter'];

            if (isset($filter['bptd_id'])) {
                $id = $filter['bptd_id'];
                $bptdid = $id == '' ? '' : 'AND b.bptd_id = "' . $id . '"';
            } else {
                $bptdid = $this->session->get('bptd_id') != 'all' ? 'AND b.bptd_id = "' . $this->session->get('bptd_id') . '"' : '';
            }

            if (isset($filter['operator_id'])) {
                $id = $filter['operator_id'];
                $operator_id = $id == '' ? '' : 'AND a.operator_id = "' . $id . '"';
            } else {
                $operator_id = $this->session->get('operator_id') != '' ? 'and a.operator_id = ' . $this->session->get('operator_id') : '';
            }

            $routeid = isset($filter['route_id']) ? $filter['route_id'] : '';
            $route_id = $routeid == '' ? '' : "AND b.id = '" . $routeid . "'";

            if ($this->session->get('role_code') == 'pop' ||  $this->session->get('role_code') == 'ppo') {
                $query = "SELECT a.*
                ,concat_ws(' - ',b.kor,b.group_nm,b.name) as route_name
                ,cp_name as operator_name
                FROM driver_routes a
                left join m_routes b on a.route_id=b.id
                left join po_routes c on a.operator_id=c.id
                WHERE a.is_deleted = 0 $operator_id $route_id";
            } else {
                $query = "SELECT a.*
                ,concat_ws(' - ',b.kor,b.group_nm,b.name) as route_name
                ,cp_name as operator_name
                FROM driver_routes a
                left join m_routes b on a.route_id=b.id
                left join po_routes c on a.operator_id=c.id
                WHERE a.is_deleted = 0 $bptdid $operator_id $route_id";
            }

            $where = ["a.id", "a.driver_name", "b.operator_name"];
            parent::_loadDatatable($query, $where, $data);
        });
    }

    function pengemudi_save()
    {
        parent::_authInsert(function () {
            $data = $this->request->getPost();
            $this->db->transStart();
            $bptd = $this->session->get('bptd_id');
            $operator_id = $this->session->get('operator_id') == '' ? $data['operator_id'] : $this->session->get('operator_id');

            $driver_routes = $this->db->table('driver_routes');
            $m_user_web = $this->db->table('m_user_web');
            $m_user_mobile = $this->db->table('m_user_mobile');

            $data_driver = [
                'id' => $data['id'],
                'driver_name' => $data['driver_name'],
                'driver_email' => $data['driver_email'],
                'ktp_no' => $data['ktp_no'],
                'sim_no' => $data['sim_no'],
                'phone_no' => $data['phone_no'],
                'route_id' => $data['route_id'],
                'operator_id' => $operator_id,
                'driver_pic' => $data['driver_pic'],
                'driver_addr' => $data['driver_addr'],
                'created_by' => $this->session->get('id'),
                'is_deleted' => 0
            ];

            $data_user_mobile = [
                'id' => '',
                'user_mobile_name' => $data['driver_email'],
                'user_mobile_email' => $data['driver_email'],
                'user_mobile_type' => '',
                'user_mobile_photo' => $data['driver_pic'],
                'user_mobile_uid' => '',
                'user_mobile_fcm' => '',
                'user_mobile_rating' => '',
                'user_mobile_version' => '',
                'user_mobile_passwd' => md5($data['driver_email']),
                'is_deleted' => 0,
                'created_by' => $this->session->get('id'),
            ];

            $data_user_web = [
                'id' => '',
                'user_web_username' => $data['driver_email'],
                'user_web_password' => md5($data['driver_email']),
                'user_web_email' => $data['driver_email'],
                'user_web_phone' => $data['phone_no'],
                'user_web_name' => $data['driver_name'],
                'user_web_role_id' => 9,
                'instansi_detail_id' => '',
                'lokker_id' => $bptd,
                'operator_id' => $operator_id,
                'user_web_nik' => $data['ktp_no'],
                'user_web_photo' => $data['driver_pic'],
                'is_deleted' => 0,
                'created_by' => $this->session->get('id'),
            ];

            // check email exist


            if ($data['id'] == '') {
                $query = "SELECT a.* FROM driver_routes a WHERE a.is_deleted = 0 and a.driver_email = ?";
                $query2 = "SELECT a.* FROM m_user_mobile a WHERE a.is_deleted = 0 and a.user_mobile_email = ?";
                $query3 = "SELECT a.* FROM m_user_web a WHERE a.is_deleted = 0 and a.user_web_email = ?";
                $exist = $this->db->query($query, array($data['driver_email']))->getRow();
                $exist2 = $this->db->query($query2, array($data['driver_email']))->getRow();
                $exist3 = $this->db->query($query3, array($data['driver_email']))->getRow();
                if ($exist) {
                    $this->db->transRollback();
                    $this->db->transComplete();
                    echo json_encode(['success' => FALSE, 'message' => 'Email sudah terdaftar']);
                    exit;
                }

                if ($exist2) {
                    $this->db->transRollback();
                    $this->db->transComplete();
                    echo json_encode(['success' => FALSE, 'message' => 'Email sudah terdaftar']);
                    exit;
                }

                if ($exist3) {
                    $this->db->transRollback();
                    $this->db->transComplete();
                    echo json_encode(['success' => FALSE, 'message' => 'Email sudah terdaftar']);
                    exit;
                }
                $insert_data_driver = $driver_routes->insert($data_driver);
                if ($insert_data_driver) {
                    $insert_data_user_mobile = $m_user_mobile->insert($data_user_mobile);
                    if ($insert_data_user_mobile) {
                        $data_user_web['user_mobile_id'] = $this->db->insertID();
                        $insert_data_user_web = $m_user_web->insert($data_user_web);
                        if ($insert_data_user_web) {
                            $this->db->transCommit();
                            $this->db->transComplete();
                            echo json_encode(['success' => TRUE, 'message' => 'Data berhasil disimpan']);
                        } else {
                            $this->db->transRollback();
                            $this->db->transComplete();
                            echo json_encode(['success' => FALSE, 'message' => $this->operasionalModel->errors()]);
                        }
                    } else {
                        $this->db->transRollback();
                        $this->db->transComplete();
                        echo json_encode(['success' => FALSE, 'message' => $this->operasionalModel->errors()]);
                    }
                } else {
                    $this->db->transRollback();
                    $this->db->transComplete();
                    echo json_encode(['success' => FALSE, 'message' => $this->operasionalModel->errors()]);
                }
            } else {
                $where['id'] = $data['id'];
                $where2['user_mobile_email'] = $data['driver_email'];
                $data_driver['last_edited_by'] = $this->session->get('id');
                $data_driver['last_edited_at'] = date('Y-m-d H:i:s');
                $update_data_driver = $driver_routes->update($data_driver, $where);
                if ($update_data_driver) {
                    $data_user_mobile['last_edited_by'] = $this->session->get('id');
                    $data_user_mobile['last_edited_at'] = date('Y-m-d H:i:s');
                    unset($data_user_mobile['id']);
                    $update_data_user_mobile = $m_user_mobile->update($data_user_mobile, $where2);
                    if ($update_data_user_mobile) {
                        $data_user_web['last_edited_by'] = $this->session->get('id');
                        $data_user_web['last_edited_at'] = date('Y-m-d H:i:s');
                        $where3['user_web_email'] = $data['driver_email'];
                        unset($data_user_web['id']);
                        $update_data_user_web = $m_user_web->update($data_user_web, $where3);
                        if ($update_data_user_web) {
                            $this->db->transCommit();
                            $this->db->transComplete();
                            echo json_encode(['success' => TRUE, 'message' => 'Data berhasil disimpan']);
                        } else {
                            $this->db->transRollback();
                            $this->db->transComplete();
                            echo json_encode(['success' => FALSE, 'message' => 'Data user web gagal disimpan']);
                        }
                    } else {
                        $this->db->transRollback();
                        $this->db->transComplete();
                        echo json_encode(['success' => FALSE, 'message' => 'Data user mobile gagal disimpan']);
                    }
                } else {
                    $this->db->transRollback();
                    $this->db->transComplete();
                    echo json_encode(['success' => FALSE, 'message' => 'Data driver gagal disimpan']);
                }
            }
        });
    }

    public function pengemudi_edit()
    {
        parent::_authEdit(function () {
            $data = $this->request->getPost();
            $query = "SELECT a.*
            ,concat_ws(' - ',b.kor,b.group_nm,b.name) as route_name
            ,cp_name as operator_name FROM driver_routes a 
            left join m_routes b on a.route_id=b.id 
            left join po_routes c on a.operator_id=c.id
            WHERE a.is_deleted = 0 and a.id = '" . $this->request->getPost('id') . "' ";
            parent::_edit('driver_routes', $data, null, $query);
        });
    }

    function pengemudi_delete()
    {
        parent::_authDelete(function () {
            $data = $this->request->getPost();
            $query = "SELECT a.* FROM driver_routes a WHERE a.is_deleted = 0 and a.id = ?";
            $driver = $this->db->query($query, array($data['id']))->getRow();
            $this->db->transStart();
            $driver_routes = $this->db->table('driver_routes');
            $m_user_web = $this->db->table('m_user_web');
            $m_user_mobile = $this->db->table('m_user_mobile');

            $data_driver = [
                'last_edited_by' => $this->session->get('id'),
                'last_edited_at' => date('Y-m-d H:i:s'),
                'is_deleted' => 1
            ];

            $data_user_mobile = [
                'last_edited_by' => $this->session->get('id'),
                'last_edited_at' => date('Y-m-d H:i:s'),
                'is_deleted' => 1
            ];

            $data_user_web = [
                'last_edited_by' => $this->session->get('id'),
                'last_edited_at' => date('Y-m-d H:i:s'),
                'is_deleted' => 1
            ];

            $where1['id'] = $data['id'];
            $where2['user_mobile_email'] = $driver->driver_email;
            $where3['user_web_email'] = $driver->driver_email;

            $update_data_driver = $driver_routes->update($data_driver, $where1);
            if ($update_data_driver) {
                unset($data_user_mobile['id']);
                $update_data_user_mobile = $m_user_mobile->update($data_user_mobile, $where2);
                if ($update_data_user_mobile) {
                    unset($data_user_web['id']);
                    $update_data_user_web = $m_user_web->update($data_user_web, $where3);
                    if ($update_data_user_web) {
                        $this->db->transCommit();
                        $this->db->transComplete();
                        echo json_encode(['success' => TRUE, 'message' => 'Data berhasil dihapus']);
                    } else {
                        $this->db->transRollback();
                        $this->db->transComplete();
                        echo json_encode(['success' => FALSE, 'message' => 'Data user web gagal dihapus']);
                    }
                } else {
                    $this->db->transRollback();
                    $this->db->transComplete();
                    echo json_encode(['success' => FALSE, 'message' => 'Data user mobile gagal dihapus']);
                }
            } else {
                $this->db->transRollback();
                $this->db->transComplete();
                echo json_encode(['success' => FALSE, 'message' => 'Data driver gagal dihapus']);
            }
        });
    }

    public function armada_load()
    {
        parent::_authLoad(function () {
            $data = $this->request->getPost();
            $filter = $data['filter'];

            if (isset($filter['bptd_id'])) {
                $id = $filter['bptd_id'];
                $bptdid = $id == '' ? '' : 'AND b.bptd_id = "' . $id . '"';
            } else {
                $bptdid = $this->session->get('bptd_id') != 'all' ? 'AND b.bptd_id = "' . $this->session->get('bptd_id') . '"' : '';
            }

            if (isset($filter['operator_id'])) {
                $id = $filter['operator_id'] != '0' ? $filter['operator_id'] : '';
                $operator_id = $id == '' ? '' : 'AND a.operator_id = "' . $id . '"';
            } else {
                $operator_id = $this->session->get('operator_id') != '' && $this->session->get('operator_id') != '0' ? 'and a.operator_id = ' . $this->session->get('operator_id') : '';
            }

            if (isset($filter['stskend'])) {
                $id = $filter['stskend'];
                $stskend = $id == '' ? '' : 'AND a.stskend = "' . $id . '"';
            } else {
                $stskend = '';
            }

            $routeid = isset($filter['route_id']) ? $filter['route_id'] : '';
            $route_id = $routeid == '' ? '' : "AND b.id = '" . $routeid . "'";

            if ($this->session->get('role_code') == 'pop' ||  $this->session->get('role_code') == 'ppo') {
                $query = "SELECT a.*,concat_ws(' - ',b.kor,b.group_nm,b.name) as route_name,
                c.cp_name as operator_name
                FROM bus_routes a
                left join m_routes b on a.route_id=b.id
                left join po_routes c on a.operator_id=c.id
                WHERE a.is_deleted = 0 $operator_id $route_id $stskend";
            } else {
                $query = "SELECT a.*,concat_ws(' - ',b.kor,b.group_nm,b.name) as route_name,
                c.cp_name as operator_name
                FROM bus_routes a
                left join m_routes b on a.route_id=b.id
                left join po_routes c on a.operator_id=c.id
                WHERE a.is_deleted = 0 $bptdid $operator_id $route_id $stskend";
            }
            $where = ["a.id", "c.cp_name", "a.group_nm", "a.nopol", "b.name", "b.kor"];
            parent::_loadDatatable($query, $where, $this->request->getPost());
            // var_dump('<pre>'.$this->db->getLastQuery().'</pre>');
        });
    }

    function armada_save()
    {
        parent::_authInsert(function () {
            $data = $this->request->getPost();
            $sendData = [];
            if ($data['id'] != '') {
                $aar1['id'] = $data['id'];
            }
            $aar1['gps_sn'] = $data['gps_sn'];
            $aar1['group_nm'] = $data['group_nm'];
            $aar1['nopol'] = $data['nopol'];
            $aar1['capacity'] = $data['capacity'];
            $aar1['jenis_pelayanan'] = $data['jenis_pelayanan'];
            $aar1['kode_kendaraan'] = $data['kode_kendaraan'];
            $aar1['no_uji'] = $data['no_uji'];
            $aar1['tgl_exp_uji'] = (($data['tgl_exp_uji'] != '') ? $data['tgl_exp_uji'] : null);
            $aar1['no_kps'] = $data['no_kps'];
            $aar1['tgl_exp_kps'] = (($data['tgl_exp_kps'] != '') ? $data['tgl_exp_kps'] : null);
            $aar1['no_srut'] = $data['no_srut'];
            $aar1['tgl_srut'] = (($data['tgl_srut'] != '') ? $data['tgl_srut'] : null);
            $aar1['no_rangka'] = $data['no_rangka'];
            $aar1['no_mesin'] = $data['no_mesin'];
            $aar1['merek'] = $data['merek'];
            $aar1['jenis_kend'] = $data['jenis_kend'];
            $aar1['tahun'] = $data['tahun'];
            $aar1['seat'] = $data['capacity'];
            $aar1['barang'] = $data['barang'];
            $aar1['route_id'] = $data['route_id'];
            $aar1['stskend'] = $data['stskend'];
            $aar1['id_bptd'] = $this->session->get('bptd_id') != 'all' ? $this->session->get('bptd_id') : '';
            $aar1['operator_id'] = $this->session->get('operator_id');
            $aar1['created_by'] = $this->session->get('id');

            array_push($sendData, $aar1);
            $query = $this->baseModel->base_upsert($sendData, 'bus_routes');

            if ($query) {
                echo json_encode(['success' => TRUE, 'message' => 'Data berhasil disimpan']);
            } else {
                echo json_encode(['success' => FALSE, 'message' => $this->baseModel->errors()]);
            }
        });
    }

    public function armada_edit()
    {
        parent::_authEdit(function () {
            $data = $this->request->getPost();
            $query = "SELECT a.*
            ,concat_ws(' - ',b.kor,b.group_nm,b.name) as route_name,
            c.cp_name as operator_name FROM bus_routes a 
            left join m_routes b on a.route_id=b.id 
            left join po_routes c on a.operator_id=c.id
            WHERE a.is_deleted = 0 and a.id = '" . $this->request->getPost('id') . "' ";
            parent::_edit('bus_routes', $data, null, $query);
        });
    }

    function armada_delete()
    {
        parent::_authDelete(function () {
            parent::_delete('bus_routes', $this->request->getPost());
        });
    }

    public function spda_load()
    {
        parent::_authLoad(function () {
            if ($this->session->get('role_code') == 'pop' ||  $this->session->get('role_code') == 'ppo') {
                $query = "SELECT a.*,b.kor,b.name as route_name,c.name as trip_name,d.nopol,e.driver_name,f.ritke, g.user_web_name as verivikator
                FROM spda_routes a
                LEFT JOIN m_routes b on a.route_id = b.id
                LEFT JOIN fleet_routes c on a.trip_id = c.id
                LEFT JOIN bus_routes d on a.bus_id = d.id
                LEFT JOIN driver_routes e on a.driver_id = e.id
                left join timetable_armada f on a.timetable_id = f.id
                left join m_user_web g on a.verif_by = g.id
                WHERE a.is_deleted = '0' and a.operator_id = '" . $this->session->get('operator_id') . "'";
            } else if ($this->session->get('role_code') == 'bpw') {
                $query = "SELECT a.*,b.kor,b.name as route_name,c.name as trip_name,d.nopol,e.driver_name,f.ritke, g.user_web_name as verivikator
                FROM spda_routes a
                LEFT JOIN m_routes b on a.route_id = b.id
                LEFT JOIN fleet_routes c on a.trip_id = c.id
                LEFT JOIN bus_routes d on a.bus_id = d.id
                LEFT JOIN driver_routes e on a.driver_id = e.id
                left join timetable_armada f on a.timetable_id = f.id
                left join m_user_web g on a.verif_by = g.id
                WHERE a.is_deleted = '0' and b.bptd_id = '" . $this->session->get('bptd_id') . "'";
            } else {
                $query = "SELECT a.*,b.kor,b.name as route_name,c.name as trip_name,d.nopol,e.driver_name,f.ritke, g.user_web_name as verivikator
                FROM spda_routes a
                LEFT JOIN m_routes b on a.route_id = b.id
                LEFT JOIN fleet_routes c on a.trip_id = c.id
                LEFT JOIN bus_routes d on a.bus_id = d.id
                LEFT JOIN driver_routes e on a.driver_id = e.id
                left join timetable_armada f on a.timetable_id = f.id
                left join m_user_web g on a.verif_by = g.id
                WHERE a.is_deleted = '0'";
            }

            $where = ["a.id", "b.kor", "b.name", "c.name", "e.driver_name", "d.nopol"];
            parent::_loadDatatable($query, $where, $this->request->getPost());
        });
    }

    public function spda_save()
    {
        $this->db->transStart();
        $data = $this->request->getPost();
        $spda_routes = $this->db->table('spda_routes');

        define('UPLOAD_DIR', 'assets/img/signatures/');
        $ttd_pengemudi = $this->request->getPost('sig-dataUrl');
        $img_pengemudi = str_replace('data:image/png;base64,', '', $ttd_pengemudi);
        $img_pengemudi = str_replace(' ', '+', $img_pengemudi);
        $data_pengemudi = base64_decode($img_pengemudi);
        $file_pengemudi = UPLOAD_DIR . md5('SPDA-Pengemudi-' . date('YmdHis')) . '.png';
        $filename_pengemudi = site_url('/assets/img/signatures/' . md5('SPDA-Pengemudi-' . date('YmdHis')) . '.png');
        $success_pengemudi = file_put_contents($file_pengemudi, $data_pengemudi);

        $ttd_manager = $this->request->getPost('sig-dataUrl-manager');
        $img_manager = str_replace('data:image/png;base64,', '', $ttd_manager);
        $img_manager = str_replace(' ', '+', $img_manager);
        $data_manager = base64_decode($img_manager);
        $file_manager = UPLOAD_DIR . md5('SPDA-Manager-' . date('YmdHis')) . '.png';
        $filename_manager = site_url('/assets/img/signatures/' . md5('SPDA-Manager-' . date('YmdHis')) . '.png');
        $success_manager = file_put_contents($file_manager, $data_manager);

        $data_spda = [
            'route_id' => $data['route_id'],
            'trip_id' => $data['trip_id'],
            'trip_distance' => $data['trip_distance'],
            'routes' => $data['routes'],
            'driver_id' => $data['driver_id'],
            'bus_id' => $data['bus_id'],
            'timetable_id' => $data['timetable_id'],
            'spda_date' => $data['spda_date'],
            'spda_dep_datetime' => $data['spda_dep_datetime'],
            'bus_capacity' => $data['bus_capacity'],
            'sign_driver' => $filename_pengemudi,
            'sign_manager' => $filename_manager,
            'manager_name' => $data['manager_name'],
            'operator_id' => $this->session->get('operator_id')
        ];
        #print_r($data_spda);
        if ($data['id'] != '') {
            $where['id'] = $data['id'];
            $spda_routes->update($data_spda, $where);
        } else {
            $spda_routes->insert($data_spda);
        }


        if ($this->db->transStatus() === FALSE) {
            $this->db->transRollback();
            $this->db->transComplete();
            echo json_encode(['success' => FALSE, 'message' => $this->operasionalModel->errors()]);
        } else {
            $this->db->transCommit();
            $this->db->transComplete();
            echo json_encode(['success' => TRUE, 'message' => 'Data berhasil disimpan']);
        }
    }

    public function spda_savedone()
    {
        parent::_authInsert(function () {
            $this->db->transStart();

            $data = $this->request->getPost();

            $data['spda_status'] = '1';
            $data['spda_earning'] = str_replace(".", "", $data['spda_earning']);
            $data['done_by'] = $this->session->get('id');
            $data['done_at'] = date('Y-m-d H:i:s');

            $id = $data['selesaikan_id'];
            $pnp['spda_id'] = $id;
            $pnp['turun_dl'] = $data['turun_dl'];
            $pnp['turun_dp'] = $data['turun_dp'];
            $pnp['turun_al'] = $data['turun_al'];
            $pnp['turun_ap'] = $data['turun_ap'];
            $pnp['turun_total'] = $data['turun_total'];
            $pnp['created_by'] = $this->session->get('id');
            unset($data['selesaikan_id']);
            unset($data['turun_dl']);
            unset($data['turun_dp']);
            unset($data['turun_al']);
            unset($data['turun_ap']);
            unset($data['turun_total']);


            $this->operasionalModel->base_insert($pnp, 'spda_pass_routes');
            $this->operasionalModel->base_update($data, 'spda_routes', ['id' => $id]);

            if ($this->db->transStatus() === FALSE) {
                $this->db->transRollback();
                $this->db->transComplete();
                echo json_encode(['success' => FALSE, 'message' => $this->operasionalModel->errors()]);
            } else {
                $this->db->transCommit();
                $this->db->transComplete();
                echo json_encode(['success' => TRUE, 'message' => 'Data berhasil disimpan']);
            }
        });
    }

    public function spda_savepnp()
    {
        parent::_authInsert(function () {
            $data = $this->request->getPost();
            $data['spda_id'] = $data['penumpang_id'];
            unset($data['penumpang_id']);

            if ($this->operasionalModel->base_insert($data, 'spda_pass_routes')) {
                echo json_encode(['success' => TRUE, 'message' => 'Data berhasil disimpan']);
            } else {
                echo json_encode(['success' => FALSE, 'message' => $this->operasionalModel->errors()]);
            }
        });
    }

    public function spda_saveverif()
    {
        define('UPLOAD_DIR', 'assets/img/signatures/');
        $ttd_bptd = $this->request->getPost('bptd-dataUrl');
        $img_bptd = str_replace('data:image/png;base64,', '', $ttd_bptd);
        $img_bptd = str_replace(' ', '+', $img_bptd);
        $data_bptd = base64_decode($img_bptd);
        $file_bptd = UPLOAD_DIR . md5('SPDA-BPTD-' . date('YmdHis')) . '.png';
        $filename_bptd = site_url('/assets/img/signatures/' . md5('SPDA-BPTD-' . date('YmdHis')) . '.png');
        $success_bptd = file_put_contents($file_bptd, $data_bptd);

        parent::_authVerif(function () use ($filename_bptd) {
            $data = $this->request->getPost();
            $data['spda_status'] = '2';
            $data['sign_bptd'] = $filename_bptd;
            $data['verif_by'] = $this->session->get('id');
            $data['verif_at'] = date('Y-m-d H:i:s');

            $id = $data['verifikasi_id'];
            unset($data['verifikasi_id']);
            unset($data['bptd-dataUrl']);

            if ($this->operasionalModel->base_update($data, 'spda_routes', ['id' => $id])) {
                echo json_encode(['success' => TRUE, 'message' => 'Data berhasil disimpan']);
            } else {
                echo json_encode(['success' => FALSE, 'message' => $this->operasionalModel->errors()]);
            }
        });
    }

    public function spda_edit()
    {
        parent::_authEdit(function () {
            $data = $this->request->getPost();
            $query = "SELECT a.*,concat_ws(' - ',b.kor,b.group_nm,b.name) as route_name,CONCAT_WS(' - ',b.jenroute,c.name) as trip_name
            ,concat_ws('-',d.bus_code, d.nopol) as bus_name,e.driver_name,d.capacity as bus_capacity
            ,concat('Rit Ke-',f.ritke,' (',concat_ws(' - ', date_format(f.dep_time,'%H:%i'), date_format(f.arr_time,'%H:%i')),')') as timetable_name
            FROM spda_routes a
            LEFT JOIN m_routes b on a.route_id = b.id
            LEFT JOIN fleet_routes c on a.trip_id = c.id
            LEFT JOIN bus_routes d on a.bus_id = d.id
            LEFT JOIN driver_routes e on a.driver_id = e.id
            LEFT JOIN timetable_armada f on a.timetable_id = f.id
            WHERE a.is_deleted = '0' and a.id = '" . $this->request->getPost('id') . "' ";

            parent::_edit('spda_routes', $data, null, $query);
        });
    }

    public function spda_delete()
    {
        parent::_authDelete(function () {
            parent::_delete('spda_routes', $this->request->getPost());
        });
    }

    public function spda_detail()
    {
        $id = $this->request->getPost('id');
        $detail = $this->operasionalModel->spda_detail($id);
        $pass = $this->operasionalModel->spda_passenger($id);

        return parent::_authDetail(function () use ($detail, $pass) {
            $data['spda'] = $detail;
            $data['pnp'] = $pass;

            return view('App\Modules\Operasional\Views\spda_detail', $data);
        });
    }

    public function spda_ppodetail($id)
    {
        $detail = $this->operasionalModel->spda_detail($id);
        $pass = $this->operasionalModel->spda_passenger($id);

        return parent::_authDetail(function () use ($detail, $pass) {
            $data['spda'] = $detail;
            $data['pnp'] = $pass;

            return view('App\Modules\Operasional\Views\spda_detail', $data);
        });
    }

    public function spda_pdf()
    {
        parent::_authDownload(function () {
            $id = $this->request->getPost('id_pdf');
            $query = "SELECT a.*,b.kor,b.name as route_name,c.name as trip_name,
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

            parent::_exportPdf(['data' => $data]);
        });
    }

    function datapo_load()
    {
        #echo $this->session->get('id');
        parent::_authLoad(function () {
            $data = $this->request->getPost();
            $filter = isset($data['filter']) ? $data['filter'] : '';
            $bptd = isset($filter['bptd']) ? $filter['bptd'] : '';
            $jenpel = isset($filter['jenis_pelayanan']) ? $filter['jenis_pelayanan'] : '';

            if ($bptd != '') {
                $bptd_id = "AND a.bptd_id = $bptd";
            } else {
                $bptd_id = "";
            }

            if ($jenpel != '') {
                foreach ($jenpel as $key => $value) {
                    $jenpel[$key] = "'$value'";
                }
                $jenpel_id = "AND (a.jenis_pelayanan IN (" . implode(',', $jenpel) . ") OR a.jenis_pelayanan LIKE '%" . implode(',', str_replace("'", "", $jenpel)) . "%') ";
            } else {
                $jenpel_id = "";
            }

            if ($this->session->get('role_code') == 'sad' || $this->session->get('role_code') == 'daj') {
                $query = "SELECT a.*,b.prov,c.kabkota,d.kec,e.kel
                            FROM po_routes a 
                            LEFT JOIN m_lokprov b ON a.cp_prov_id = b.id
                            LEFT JOIN m_lokabkota c ON a.cp_kabkota_id = c.id
                            LEFT JOIN m_lokec d ON a.cp_kec_id = d.id
                            LEFT JOIN m_lokkel e ON a.cp_kel_id = e.id
                            WHERE a.is_deleted = 0 $bptd_id $jenpel_id";
            } else {
                $query = "SELECT a.*,b.prov,c.kabkota,d.kec,e.kel
                            FROM po_routes a
                            LEFT JOIN m_lokprov b ON a.cp_prov_id = b.id
                            LEFT JOIN m_lokabkota c ON a.cp_kabkota_id = c.id
                            LEFT JOIN m_lokec d ON a.cp_kec_id = d.id
                            LEFT JOIN m_lokkel e ON a.cp_kel_id = e.id
                            WHERE a.is_deleted = 0 AND a.created_by ='" . $this->session->get('id') . "' $jenpel_id";
            }
            $where = ["a.cp_name", "a.cp_type", "a.cp_mngr_name", "a.cp_addr", "a.cp_phone", "a.cp_mngr_phone", "b.prov", "c.kabkota", "d.kec", "e.kel"];

            parent::_loadDatatable($query, $where, $this->request->getPost());
        });
    }

    function datapo_save()
    {
        parent::_authInsert(function () {
            $data = $this->request->getPost();
            $data['bptd_id'] = $this->session->get('bptd_id') != 'all' ? $this->session->get('bptd_id') : '';

            $data['cp_prov_id'] = $data['idprov'];
            $data['cp_kabkota_id'] = $data['idkabkota'];
            $data['cp_kec_id'] = $data['idkec'];
            $data['cp_kel_id'] = $data['idkel'];
            $data['jenis_pelayanan'] = implode(',', $data['jenis_pelayanan']);

            unset($data['idprov']);
            unset($data['idkabkota']);
            unset($data['idkec']);
            unset($data['idkel']);
            parent::_insert('po_routes', $data);
        });
    }

    function datapo_edit()
    {
        parent::_authEdit(function () {
            $data = $this->request->getPost();
            $query = "SELECT a.*,b.prov,b.singkatan,c.kabkota,d.kec,e.kel
            FROM po_routes a
            LEFT JOIN m_lokprov b on a.cp_prov_id = b.id
            LEFT JOIN m_lokabkota c on a.cp_kabkota_id = c.id
            LEFT JOIN m_lokec d on a.cp_kec_id = d.id
            LEFT JOIN m_lokkel e on a.cp_kel_id = e.id
            WHERE a.is_deleted = '0' and a.id = '" . $this->request->getPost('id') . "' ";

            parent::_edit('po_routes', $data, null, $query);
            // parent::_edit('po_routes', $this->request->getPost());
        });
    }

    function datapo_delete()
    {
        parent::_authDelete(function () {
            parent::_delete('po_routes', $this->request->getPost());
        });
    }

    function pdf()
    {
        //     $url = uri_segment("3");

        //     $ipaddress = $this->request->getIPAddress();
        //     $user = $this->session->get('name');

        //     $url_export = $url.'_export';
        //     $filter = $_GET['search'];
        //     $data['data_url'] = uri_segment("2");
        //     $data['data_excel'] = $this->spdaModel->export_view($url_export, $filter);

        //     $html = view('App\Modules\Spda\Views\export\\'.$url.'_export', $data);

        //     $mpdf = new \Mpdf\Mpdf(['setAutoTopMargin' => 'stretch', 'setAutoBottomMargin' => 'stretch']);

        //     $mpdf->SetHTMLHeader('
        //     <div style="text-align: center;"><img src="' . base_url() . '/assets/img/hubdat.png" style="display: block; padding-bottom: 10px; width: 20%;"></div>
        //     <div style="text-align: center;"><img src="' . base_url() . '/assets/img/logodamri.png" style="display: block; padding-bottom: 10px; width: 30%;"></div>
        //     <div style="text-align: center; font-size: 18px; font-weight: bold; letter-spacing: 3px;">SURAT PERINTAH DINAS ANGKUTAN (Spda) AP/1</div>
        //     <hr style="height:2px;border-width:0;color:gray;background-color:gray">
        //     ');
        //     $mpdf->SetHTMLFooter('
        //       <div style="text-align: center;"><img src="' . base_url() . '/assets/img/logo.png" style="display: block; width: 20%;"></div>
        //       <div style="text-align: left; font-size: 8px; font-style: italic: color:gray;">Printed on '. date('d/m/Y H:i:s').' from IP '. $ipaddress .' by '. $user .' </div>');
        //     $mpdf->SetWatermarkImage(base_url().'/assets/img/logodamri.png');
        //     $mpdf->watermarkImageAlpha = 0.1;
        //     $mpdf->showWatermarkImage = true;
        //     $mpdf->WriteHTML($html);
        //     $this->response->setHeader('Content-Type', 'application/pdf');
        //     $mpdf->Output($url.'-'.date('d-m-Y H:i:s').'.pdf','I');
    }

    function timetablesarmada_load()
    {
        parent::_authLoad(function () {
            if ($this->session->get('role_code') == 'pop' ||  $this->session->get('role_code') == 'ppo') {
                // $query = "SELECT
                //                 a.id,
                //                 a.route_id,
                //                 a.trip_id,
                //                 a.operator_id,
                //                 a.bus_id,
                //                 b.name AS route_name,
                //                 c.cp_name AS operator_name,
                //                 d.nopol AS bus_nopol,
                //                 e.ritke,
                //                 e.time_start AS dep_time,
                //                 e.time_end AS arr_time,
                //                 f.name AS trip_name
                //             FROM timetable_armada a
                //             LEFT JOIN m_routes b ON a.route_id = b.id
                //             LEFT JOIN po_routes c ON a.operator_id = c.id
                //             LEFT JOIN bus_routes d ON a.bus_id = d.id
                //             LEFT JOIN timetable_bptd e ON a.timetable_id = e.id
                //             LEFT JOIN fleet_routes f ON e.trip_id = f.id
                //             WHERE a.is_deleted = 0 and a.operator_id = '" . $this->session->get('operator_id') . "'";
                $query = "SELECT x.* 
                            FROM (
                                SELECT
                                    a.id,
                                    a.route_id,
                                    a.trip_id,
                                    a.operator_id,
                                    a.bus_id,
                                    -- a.dep_time AS dep_time,
                                    -- a.arr_time AS arr_time,
                                    group_concat(concat_ws(' - ', a.dep_time, a.arr_time) order by a.id separator '|' ) as trip_time, 
                                    a.timetable_code,
                                    b.name AS route_name,
                                    c.cp_name AS operator_name,
                                    d.nopol AS bus_nopol,
                                    e.ritke,
                                    group_concat(f.name order by a.id separator '|') AS trip_name
                                FROM timetable_armada a
                                LEFT JOIN m_routes b ON a.route_id = b.id
                                LEFT JOIN po_routes c ON a.operator_id = c.id
                                LEFT JOIN bus_routes d ON a.bus_id = d.id
                                LEFT JOIN timetable_bptd e ON a.timetable_id = e.id
                                LEFT JOIN fleet_routes f ON e.trip_id = f.id
                                WHERE a.is_deleted = 0 AND a.operator_id = '" . $this->session->get('operator_id') . "'
                                group by a.timetable_code
                                ORDER BY e.ritke, e.time_start, e.time_end) x 
                                WHERE 1=1 ";
            } else {
                $query = "SELECT x.* 
                            FROM (
                                SELECT
                                    a.id,
                                    a.route_id,
                                    a.trip_id,
                                    a.operator_id,
                                    a.bus_id,
                                    -- a.dep_time AS dep_time,
                                    -- a.arr_time AS arr_time,
                                    group_concat(concat_ws(' - ', a.dep_time, a.arr_time) order by a.id separator '|' ) as trip_time, 
                                    a.timetable_code,
                                    b.name AS route_name,
                                    c.cp_name AS operator_name,
                                    d.nopol AS bus_nopol,
                                    e.ritke,
                                    group_concat(f.name order by a.id separator '|') AS trip_name
                                FROM timetable_armada a
                                LEFT JOIN m_routes b ON a.route_id = b.id
                                LEFT JOIN po_routes c ON a.operator_id = c.id
                                LEFT JOIN bus_routes d ON a.bus_id = d.id
                                LEFT JOIN timetable_bptd e ON a.timetable_id = e.id
                                LEFT JOIN fleet_routes f ON e.trip_id = f.id
                                WHERE a.is_deleted = 0
                                group by a.timetable_code
                                ORDER BY e.ritke, e.time_start, e.time_end) x 
                                WHERE 1=1 ";
            }
            $where = ["x.route_name", "x.operator_name", "x.bus_nopol", "x.trip_name", "x.trip_time"];
            $groupby = [];
            $orderby = "x.trip_id";

            parent::_loadDatatableOrderBy($query, $where, $this->request->getPost(), NULL, $orderby);
        });
    }

    function timetablesarmada_save()
    {
        parent::_authInsert(function () {
            $data = $this->request->getPost();
            // echo json_encode($data);

            $this->db->transBegin();

            $checkCode = md5(date('YmdHis'));

            $sendData = [];
            $aar1['id'] = $data['id_a'] != '' ? $data['id_a'] : '';
            $aar1['timetable_code'] = $data['timetable_code'] != '' ? $data['timetable_code'] : $checkCode;
            $aar1['timetable_id'] = $data['timetable_id_a'];
            $aar1['operator_id'] = $this->session->get('operator_id');
            $aar1['bus_id'] = $data['bus_id'];
            $aar1['route_id'] = $data['route_id'];
            $aar1['ritke'] = $data['ritke_save'];
            $aar1['trip_id'] = $data['trip_id_a'];
            $aar1['dep_time'] = $data['time_start_a'];
            $aar1['arr_time'] = $data['time_end_a'];
            $aar1['created_by'] = $this->session->get('id');
            array_push($sendData, $aar1);

            $aar2['id'] = $data['id_b'] != '' ? $data['id_b'] : '';
            $aar2['timetable_code'] = $data['timetable_code'] != '' ? $data['timetable_code'] : $checkCode;
            $aar2['timetable_id'] = $data['timetable_id_b'];
            $aar2['operator_id'] = $this->session->get('operator_id');
            $aar2['bus_id'] = $data['bus_id'];
            $aar2['route_id'] = $data['route_id'];
            $aar2['ritke'] = $data['ritke_save'];
            $aar2['trip_id'] = $data['trip_id_b'];
            $aar2['dep_time'] = $data['time_start_b'];
            $aar2['arr_time'] = $data['time_end_b'];
            $aar2['created_by'] = $this->session->get('id');
            array_push($sendData, $aar2);

            $this->baseModel->base_upsertbatch($sendData, 'timetable_armada');

            if ($this->db->transStatus() === false) {
                echo json_encode(['success' => FALSE, 'message' => $this->operasionalModel->db->error()['message']]);
                $this->db->transRollback();
                $this->db->transComplete();
            } else {
                echo json_encode(['success' => TRUE, 'message' => 'Data berhasil disimpan']);
                $this->db->transCommit();
                $this->db->transComplete();
            }
        });
    }

    function timetablesarmada_edit()
    {
        parent::_authEdit(function () {
            $data = $this->request->getPost();
            $query = "SELECT 
                            group_concat(a.id) AS id,
                            a.route_id, 
                            group_concat(a.trip_id) AS trip_id, 
                            group_concat(a.timetable_id) AS timetable_id,
                            a.ritke, group_concat(a.dep_time) AS dep_time, 
                            group_concat(a.arr_time) AS arr_time,
                            b.name AS route_name,
                            c.cp_name AS operator_name,
                            d.nopol AS bus_nopol,
                            d.id as bus_id,
                            group_concat(e.name) AS trip_name,
                            CONCAT('Rit Ke-', a.ritke, ' | ', GROUP_CONCAT(CONCAT(DATE_FORMAT(a.dep_time, '%H:%i') ,'-', DATE_FORMAT(a.arr_time, '%H:%i')) separator ' | ')) as ritke_timetable
                        FROM timetable_armada a
                        LEFT JOIN m_routes b ON a.route_id = b.id
                        LEFT JOIN po_routes c ON a.operator_id = c.id
                        LEFT JOIN bus_routes d ON a.bus_id = d.id
                        LEFT JOIN fleet_routes e ON a.trip_id = e.id
                        WHERE a.is_deleted = '0' and a.timetable_code = '" . $this->request->getPost('id') . "' ";

            parent::_edit('timetable_armada', $data, null, $query);
            // var_dump('<pre>' . $this->db->getLastQuery() . '</pre>');
        });
    }

    function timetablesarmada_delete()
    {
        parent::_authDelete(function () {
            $data = $this->request->getPost();

            parent::_delete('timetable_armada', ["timetable_code" => $data['id']]);
        });
    }

    function timetablesbptd_load()
    {
        parent::_authLoad(function () {
            $data = $this->request->getPost('filter');
            if ($this->session->get('role_code') == 'bpw' || $this->session->get('role_code') == 'pop' ||  $this->session->get('role_code') == 'ppo') {
                if (isset($data['operator_id'])) {
                    $operator_id = $data['operator_id'] != '' ? ' AND a.operator_id = "' . $data['operator_id'] . '"' : '';
                } else {
                    $operator_id = '';
                }
                if (isset($data['route_id'])) {
                    $route_id = $data['route_id'] != '' ? ' AND a.route_id = "' . $data['route_id'] . '"' : '';
                } else {
                    $route_id = '';
                }
                if (isset($data['trip_id'])) {
                    $trip_id = $data['trip_id'] != '' ? ' AND a.trip_id = "' . $data['trip_id'] . '"' : '';
                } else {
                    $trip_id = '';
                }

                $query = "SELECT x.*
                            FROM 
                            (SELECT a.id, a.ritke, a.trip_id, 
                                group_concat(concat_ws(' - ', a.time_start, a.time_end) order by a.id separator '|' ) as trip_time, 
                                a.bptd_id, a.timetable_code, 
                                b.jenroute,
                                group_concat(c.name order by a.id separator '|') AS timetable_name,
                                c.kor, concat(d.cp_type, '. ', d.cp_name) AS po_name, b.id AS route_id
                            FROM timetable_bptd a
                            LEFT JOIN m_routes b ON a.route_id = b.id
                            LEFT JOIN fleet_routes c ON a.trip_id = c.id
                            LEFT JOIN po_routes d ON a.operator_id = d.id
                            WHERE a.is_deleted = 0 AND a.bptd_id = '" . $this->session->get('bptd_id') . "' $operator_id $route_id $trip_id
                            group by a.timetable_code
                            ORDER BY
                            a.ritke,
                            a.time_start,
                            a.time_end ASC) x 
                            where 1 = 1";
            } else if ($this->session->get('role_code') == 'sad' || $this->session->get('role_code') == 'daj') {
                if (isset($data['bptd_id'])) {
                    $bptd_id = $data['bptd_id'] != '' ? ' AND a.bptd_id = "' . $data['bptd_id'] . '"' : '';
                } else {
                    $bptd_id = '';
                }
                if (isset($data['operator_id'])) {
                    $operator_id = $data['operator_id'] != '' ? ' AND a.operator_id = "' . $data['operator_id'] . '"' : '';
                } else {
                    $operator_id = '';
                }
                if (isset($data['route_id'])) {
                    $route_id = $data['route_id'] != '' ? ' AND a.route_id = "' . $data['route_id'] . '"' : '';
                } else {
                    $route_id = '';
                }
                if (isset($data['trip_id'])) {
                    $trip_id = $data['trip_id'] != '' ? ' AND a.trip_id = "' . $data['trip_id'] . '"' : '';
                } else {
                    $trip_id = '';
                }

                $query = "SELECT x.*
                            FROM 
                            (SELECT a.id, a.ritke, a.trip_id, 
                                group_concat(concat_ws(' - ', a.time_start, a.time_end) order by a.id separator '|' ) as trip_time,
                                a.bptd_id, a.timetable_code, 
                                b.jenroute,
                                group_concat(c.name order by a.id separator '|') AS timetable_name,
                                c.kor, concat(d.cp_type, '. ', d.cp_name) AS po_name, b.id AS route_id, e.user_web_name
                            FROM timetable_bptd a
                            LEFT JOIN m_routes b ON a.route_id = b.id
                            LEFT JOIN fleet_routes c ON a.trip_id = c.id
                            LEFT JOIN po_routes d ON a.operator_id = d.id
                            LEFT JOIN m_user_web e ON e.lokker_id = a.bptd_id AND e.is_deleted = 0 AND e.user_web_role_id = '4'
                            WHERE a.is_deleted = 0 $bptd_id $operator_id $route_id $trip_id
                            group by a.timetable_code
                            ORDER BY
                            a.ritke,
                            a.time_start,
                            a.time_end ASC) x 
                            where 1 = 1";
            } else {
                if (isset($data['operator_id'])) {
                    $operator_id = $data['operator_id'] != '' ? ' AND a.operator_id = "' . $data['operator_id'] . '"' : '';
                } else {
                    $operator_id = '';
                }
                if (isset($data['route_id'])) {
                    $route_id = $data['route_id'] != '' ? ' AND a.route_id = "' . $data['route_id'] . '"' : '';
                } else {
                    $route_id = '';
                }
                if (isset($data['trip_id'])) {
                    $trip_id = $data['trip_id'] != '' ? ' AND a.trip_id = "' . $data['trip_id'] . '"' : '';
                } else {
                    $trip_id = '';
                }

                $query = "SELECT x.*
                            FROM 
                            (SELECT a.id, a.ritke, a.trip_id, 
                                group_concat(concat_ws(' - ', a.time_start, a.time_end) order by a.id separator '|' ) as trip_time,
                                a.bptd_id, a.timetable_code, 
                                b.jenroute,
                                group_concat(c.name order by a.id separator '|') AS timetable_name,
                                c.kor, concat(d.cp_type, '. ', d.cp_name) AS po_name
                            FROM timetable_bptd a
                            LEFT JOIN m_routes b ON a.route_id = b.id
                            LEFT JOIN fleet_routes c ON a.trip_id = c.id
                            LEFT JOIN po_routes d ON a.operator_id = d.id
                            WHERE a.is_deleted = 0" . $operator_id . $route_id . $trip_id . "
                            group by a.timetable_code
                            ORDER BY
                            a.ritke,
                            a.time_start,
                            a.time_end ASC) x 
                            where 1 = 1";
            }
            $where = ["x.trip_time", "x.ritke", "x.timetable_name", "x.jenroute", "x.kor", "x.po_name"];
            $groupby = [];
            $orderby = "x.trip_id";

            if (isset($data['operator_id']) || isset($data['route_id']) || isset($data['trip_id'])) {
                parent::_loadDatatableOrderBy($query, $where, $this->request->getPost(), NULL, $orderby);
            } else {
                parent::_loadDatatableOrderBy($query, $where, $this->request->getPost(), NULL, $orderby);
            }
        });
    }

    function timetablesbptd_save()
    {
        parent::_authInsert(function () {
            $data = $this->request->getPost();

            $this->db->transBegin();

            $checkCode = md5(date('YmdHis'));

            $sendData = [];
            $aar1['id'] = $data['id_a'] != '' ? $data['id_a'] : '';
            $aar1['operator_id'] = $data['operator_id'];
            $aar1['route_id'] = $data['route_id'];
            $aar1['ritke'] = $data['ritke'];
            $aar1['trip_id'] = $data['trip_id_a'];
            $aar1['time_start'] = $data['time_start_a'];
            $aar1['time_end'] = $data['time_end_a'];
            $aar1['bptd_id'] = $this->session->get('bptd_id') != 'all' ? $this->session->get('bptd_id') : '';
            $aar1['created_by'] = $this->session->get('id');
            $aar1['timetable_code'] = $data['timetable_code'] != '' ? $data['timetable_code'] : $checkCode;
            array_push($sendData, $aar1);

            $aar2['id'] = $data['id_b'] != '' ? $data['id_b'] : '';
            $aar2['operator_id'] = $data['operator_id'];
            $aar2['route_id'] = $data['route_id'];
            $aar2['ritke'] = $data['ritke'];
            $aar2['trip_id'] = $data['trip_id_b'];
            $aar2['time_start'] = $data['time_start_b'];
            $aar2['time_end'] = $data['time_end_b'];
            $aar2['bptd_id'] = $this->session->get('bptd_id') != 'all' ? $this->session->get('bptd_id') : '';
            $aar2['created_by'] = $this->session->get('id');
            $aar2['timetable_code'] = $data['timetable_code'] != '' ? $data['timetable_code'] : $checkCode;
            array_push($sendData, $aar2);

            $this->baseModel->base_upsertbatch($sendData, 'timetable_bptd');

            // var_dump('<pre>' . $this->db->getLastQuery() . '</pre>');

            // echo json_encode($sendData);

            if ($this->db->transStatus() === false) {
                echo json_encode(['success' => FALSE, 'message' => $this->operasionalModel->db->error()['message']]);
                $this->db->transRollback();
                $this->db->transComplete();
            } else {
                echo json_encode(['success' => TRUE, 'message' => 'Data berhasil disimpan']);
                $this->db->transCommit();
                $this->db->transComplete();
            }
        });
    }

    function timetablesbptd_edit()
    {
        parent::_authEdit(function () {
            $data = $this->request->getPost();
            $query = "SELECT a.*, concat_ws(' | ',b.jenroute,b.group_nm,b.name) AS route_name, CONCAT_WS(' - ',b.jenroute,c.name) AS trip_name, d.cp_name AS operator_name
                        FROM timetable_bptd a
                        LEFT JOIN m_routes b ON a.route_id = b.id
                        LEFT JOIN fleet_routes c ON a.trip_id = c.id
                        LEFT JOIN po_routes d ON a.operator_id = d.id
                        WHERE a.is_deleted = 0 AND a.timetable_code = '" . $data['id'] . "'";

            parent::_editbatch('timetable_bptd', $data, null, $query);
        });
    }

    function timetablesbptd_delete()
    {
        parent::_authDelete(function () {
            $data = $this->request->getPost();

            parent::_delete('timetable_bptd', ["timetable_code" => $data['id']]);
        });
    }
}
