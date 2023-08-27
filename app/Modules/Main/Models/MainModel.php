<?php namespace App\Modules\Main\Models;

use App\Core\BaseModel;

class MainModel extends BaseModel
{
    
    public function rutemudikdata(){
    	$rs = $this->db2->query("select a.id,a.route_name,a.kategori_angkutan_id,a.subkategori_angkutan_id,a.route_from,a.route_to,a.route_from_latlng,a.route_to_latlng from m_route a
where kategori_angkutan_id in(5,11) and a.is_deleted=0 limit 3");
    	return $rs->getResult();
    }

    public function loadDataPetugas(){
    	$db2 = db_connect('hubdat');
		$rs = $db2->query("select a.id,a.user_mobile_name as name,a.user_mobile_type as type,a.user_mobile_photo,a2.posko_id
,IF(a3.id IS NULL,'offline',a21.posko_mudik_name) as status
from 
m_user_mobile a
inner join m_user_web a1 on a.id=a1.user_mobile_id
inner join m_jadwal_posko a2 on a1.id=a2.user_id and a2.tgl_tugas=curdate()
inner join m_posko_mudik a21 on a2.posko_id=a21.id
left join t_absensi_internal a3 on a2.user_id=a3.user_id and date(a3.created_at)=curdate()
where a.user_mobile_role=2 and length(a.user_mobile_fcm)>10");
        return $rs->getResult();
    }

    
}