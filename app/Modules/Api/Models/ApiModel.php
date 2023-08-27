<?php namespace App\Modules\Api\Models;

use App\Core\BaseModel;

class ApiModel extends BaseModel
{

	public function rec_armada_routesid(){
    	$rs = $this->db->query("select gps_sn,route_id from s_last_log_armada where route_id is not null");
    	return $rs->getResult();
    }

}