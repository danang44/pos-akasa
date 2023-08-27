<?php namespace App\Modules\Rampcheck\Models;

use App\Core\BaseModel;
class RampcheckModel extends BaseModel
{
	public function getTerminal()
    {
    	return $this->db->query('select a.* from m_lokker a where a.is_deleted = 0')->getResult();	
    }
	
	public function getJenisAngkutan()
    {
    	return $this->db->query('select a.* from m_jenis_angkutan a where a.is_deleted = 0')->getResult();	
    }

	public function getJenisLokasi()
    {
    	return $this->db->query('select a.* from m_jenis_lokasi a where a.is_deleted = 0')->getResult();	
    }

	public function getProv()
    {
    	return $this->db->query('select a.* from m_provinsi a where a.is_deleted = 0')->getResult();	
    }

    // public function getKabKota($prov_id)
    // {
    // 	return $this->db->query('select a.*, b.*
    // 		from m_kabkota a 
    // 		left join m_provinsi b on a.provinsi_id = b.id and b.is_deleted = 0
    // 		where a.prov_id = ? and a.is_deleted = 0
    // 		', array($prov_id))->getResult();
    // }

	// public function getKec($kabkota_id)
    // {
    // 	return $this->db->query('select a.*, b.*
    // 		from m_kecamatan a 
    // 		left join m_kabkota b on a.kabkota_id = b.id and b.is_deleted = 0
    // 		where a.kabkota_id = ? and a.is_deleted = 0
    // 		', array($kabkota_id))->getResult();
    // }
}