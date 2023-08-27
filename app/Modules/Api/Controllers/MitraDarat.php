<?php

namespace App\Modules\Api\Controllers;

use App\Modules\Api\Models\ApiModel;
use App\Core\BaseController;
use App\Core\BaseModel;
use \DateTime;


class MitraDarat extends BaseController
{
	private $apiModel;
	private $dataroutesid;

	/**
	 * Constructor.
	 */
	public function __construct()
	{
		$this->apiModel = new ApiModel();
	}

	public function index()
	{
		return redirect()->to(base_url());
	}

	public function test()
	{
		return view('App\Modules\Api\Views\test');
	}

	public function login()
	{
		$data = $this->request->getPost();
		$mobile_email = !isset($data['mobile_email']) ?: $res_where['user_mobile_email'] = addslashes($data['mobile_email']);
        $mobile_type = !isset($data['mobile_type']) ?: $res_where['user_mobile_type'] = addslashes($data['mobile_type']);
        $mobile_fcm = !isset($data['mobile_fcm']) ?: $res_where['user_mobile_fcm'] = addslashes($data['mobile_fcm']);
        $mobile_uid = !isset($data['mobile_uid']) ?: $res_where['user_mobile_uid'] = addslashes($data['mobile_uid']);
        $mobile_version = !isset($data['mobile_version']) ?: $res_where['user_mobile_version'] = addslashes($data['mobile_version']);

        $data = [
            "user_mobile_email" => $mobile_email,
            "user_mobile_type" => $mobile_type,	
            "user_mobile_fcm" => $mobile_fcm,
            "user_mobile_uid" => $mobile_uid,
            "user_mobile_version" => $mobile_version
        ];

        $driver = $this->db->query("SELECT a.id as id_petugas, b.id, a.user_web_name as user_mobile_name, b.user_mobile_email,
				b.user_mobile_type, if(a.user_web_photo is null, b.user_mobile_photo, a.user_web_photo) as user_mobile_photo,
				b.user_mobile_uid, b.user_mobile_fcm, b.user_mobile_rating, b.user_mobile_version,concat('4') as user_mobile_role,concat('') as user_mobile_jitsi,concat('') as user_web_nik 
				from m_user_web a
                inner join m_user_mobile b on a.user_mobile_id = b.id where a.user_web_email = ?", array($mobile_email))->getRow();

		// echo $this->db->getLastQuery();

		if(is_null($driver)){
			$this->apiModel->base_update($data, "m_user_mobile", ["user_mobile_email" => $mobile_email]);

			$response = [
				'success' => FALSE,
				'data' => null,
				'user_role_code' => null,
				'user_role_name' => null
			];
		}else{
			$response = [
				'success' => TRUE,
				'data' => $driver,
				'user_role_code' => 'PPO',
				'user_role_name' => 'Petugas PO'
			];
		}

		return $this->response->setJson($response);
	}
}