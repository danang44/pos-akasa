<?php namespace App\Modules\Api\Controllers;

use App\Modules\Api\Models\ApiModel;
use App\Core\BaseController;

class Tes extends BaseController
{
    private $apiModel;

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

    public function testtime(){
        $issuedAt = time();
        echo $issuedAt;
        echo "<br/>";
        $expTime = $issuedAt + (60); # 60 --> 60 detik / 1 menit
        
    }

    public function ipaddress(){
        return tes_client_ip();
    }

    public function login()
    {
        date_default_timezone_set('Asia/Jakarta');
        $username = $this->request->getPost("username");
        $password = $this->request->getPost("password");

        $sign = json_decode($this->_signature());

        $jwt = json_decode($this->_token($sign->signature));

        $login = $this->_login($jwt->token, ["username" => $username, "password" => $password]);

        return $login;
    }

    /*
    1. request get signature, return signature;
    2. request jwt token, parameter yg dilempar adalah signature response, return token;
    3. request api method, header token + paramter;
    */

    protected function _signature(){
        $url = 'https://mitradarat-fms.dephub.go.id/api/token/signature';

        $headers = array(
            'Content-Type:application/json',
            'X-TIMESTAMP:' . date('Y-m-d H:i:s')
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);

        if ($result === FALSE) {
            die('Oops! FCM Send Error: ' . curl_error($ch));
        }

        curl_close($ch);

        return $result;
    }

    protected function _token($signature){
        $url = 'https://mitradarat-fms.dephub.go.id/api/token/jwt';

        $data = array(
            "signature" => $signature
        );

        $headers = array(
            'X-TIMESTAMP:' . date('Y-m-d H:i:s')
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $result = curl_exec($ch);

        if ($result === FALSE) {
            die('Oops! FCM Send Error: ' . curl_error($ch));
        }

        curl_close($ch);

        return $result;
    }

    protected function _login($token, $data){
        $url = 'https://mitradarat-fms.dephub.go.id/api/v1/login';
        
        $headers = array(
            'X-NGI-TOKEN:'.$token
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $result = curl_exec($ch);

        if ($result === FALSE) {
            die('Oops! FCM Send Error: ' . curl_error($ch));
        }

        curl_close($ch);

        return $result;
    }
}
