<?php
namespace App\Modules\Operasional\Models;

use App\Core\BaseModel;

class OperasionalModel extends BaseModel
{
    public function spda_export($filter)
	{
		// $data_explode = explode(".", $filter);
		// $no_spda = $data_explode[0];
		// $id_spda = $data_explode[1];
		
		// $query = "SELECT a.id, d.trayek_name, a.no_spda, a.tgl_spda, b.nama_pengemudi, c.armada_code, a.ritase_spda, a.jrk_tempuh_spda, a.wkt_tempuh_spda, a.bbm_spda, c.armada_kapasitas, a.ttl_penumpang_spda, a.ttl_pdptan_spda,
        // form_spda_ttd_pengemudi, form_spda_ttd_manager, form_spda_nama_manager
		// FROM t_form_spda a
		// LEFT JOIN m_driver b ON b.id = a.driver_spda
		// LEFT JOIN m_armada c ON c.id = a.kd_bus_spda 
		//  LEFT JOIN m_trayek d ON d.id = a.trayek_id
        // WHERE a.is_deleted = 0 AND a.id='" . base64_decode($data_explode['1']) . "' AND a.no_spda='" . base64_decode($data_explode['0']) . "' ";
		
		// return $this->db->query($query)->getRow();
	}

  public function saveSpdaForm( array $dataSpda) 
  {
		// $db = \Config\Database::connect();
		// $builderSpda = $db->table('t_form_spda');
		// $builderSpdaForm = $db->table('t_form_spda');
		// $this->db->transBegin();

		// if ($builderSpda->insert($dataSpda)) {
		// 	return $db->insertID();
		// } else {
		// 	return false;
		// }
	}

	public function spda_detail($id)
	{
		$query = "select a.*, b.name as route_name, c.name as trip_name, date_format(a.spda_date,'%d-%m-%Y') as tgl, date_format(a.spda_dep_datetime,'%H:%i') as jam,
		d.nopol as bus_nopol, e.driver_name,concat('Rit Ke-',f.ritke,' (',concat_ws(' - ', date_format(f.dep_time,'%H:%i'), 
		date_format(f.arr_time,'%H:%i')),')') as timetable_name from spda_routes a
		LEFT JOIN m_routes b on a.route_id = b.id
        LEFT JOIN fleet_routes c on a.trip_id = c.id
        LEFT JOIN bus_routes d on a.bus_id = d.id
        LEFT JOIN driver_routes e on a.driver_id = e.id
        LEFT JOIN timetable_armada f on a.timetable_id = f.id
		where a.id = ?";

		return $this->db->query($query, array($id))->getRow();
	}

	public function spda_passenger($id)
	{	
		$query = "select a.*, date_format(a.created_at,'%d-%m-%Y %H:%i:%s') as waktu from spda_pass_routes a where a.spda_id = ?";

		return $this->db->query($query, array($id))->getResult();
	}
}
