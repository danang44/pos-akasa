<?php namespace App\Modules\Auth\Controllers;

use App\Modules\Auth\Models\AuthModel;
use App\Core\BaseController;
// use Google_Client;
// use Google_Service_Oauth2;

class AuthAction extends BaseController
{
    // private $client;
    private $authModel;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->authModel = new AuthModel();
        // $this->client = new Google_Client();
        // $this->client->setClientId('884122324633-u06ijjlch1912n0l09f7gnkkqlj289ci.apps.googleusercontent.com');
        // $this->client->setClientSecret('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');
        // $this->client->setRedirectUri(base_url('Auth/callback'));
        // $this->client->addScope('email');
        // $this->client->addScope('profile');
    }

    public function index()
    {
        return redirect()->to(base_url()); 
    }

    public function login()
    {
        $session = \Config\Services::session();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        if ($username != '' && $password != '') {
            $encSHA512 = parent::sha512($password, getenv('app.salt'));
            $password = base64_encode($encSHA512);
            $user = $this->authModel->getUser($username, $password);
            if (!is_null($user)) {
                if ($user->is_deleted == 0) {
                    $menu = $this->authModel->getMenu($user->user_web_role_id);
                    $sessionData = array(
                        'logged_in_transtng'    => true,
                        'id'                    => $user->id,
                        'role'                  => $user->user_web_role_id,
                        'role_name'             => $user->user_web_role_name,
                        'username'              => $user->user_web_username,
                        'name'                  => $user->user_web_name,
                        'email'                 => $user->user_web_email,
                        'menu'                  => $menu
                    );
                    // var_dump($sessionData);
                    $session->set($sessionData);
                    $this->baseModel->log_action("login", "Akses Diberikan");

                    $response = ["success" => TRUE, "title"   => "Success", "text"    => "Berhasil"];
                } else {
                    $this->baseModel->log_action("login", "Akses Ditolak");
                    $response = ["success" => false, "title"   => "Error", "text"    => "Pengguna Sudah Tidak Aktif"];
                }
            } else {
                $this->baseModel->log_action("login", "Akses Ditolak");
                $response = ["success" => false, "title"   => "Error", "text"    => "Username & Password Salah"];
            }
        } else {
            $this->baseModel->log_action("login", "Akses Ditolak");
            $response = ["success" => false, "title" => "Error", "text" => "Username & Password Salah"];
        }
        echo json_encode($response);
    }

    public function loginGoogle()
    {
        $session = \Config\Services::session();
        $email = $this->request->getPost('email');
        $user = $this->authModel->getUserByEmail($email);
        if (!is_null($user)) {
            if ($user->is_deleted == 0) {
                $menu = $this->authModel->getMenu($user->user_web_role_id);
                $sessionData = array(
                    'logged_in_transtng'    => true,
                    'id'                    => $user->id,
                    'role'                  => $user->user_web_role_id,
                    'role_name'             => $user->user_web_role_name,
                    'username'              => $user->user_web_username,
                    'name'                  => $user->user_web_name,
                    'email'                 => $user->user_web_email,
                    'menu'                  => $menu
                );
                $session->set($sessionData);
                $this->baseModel->log_action("login", "Akses Diberikan");
                $response = ["success" => TRUE, "title" => "Success", "text" => "Berhasil"];
            } else {
                $this->baseModel->log_action("login", "Akses Ditolak");
                $response = ["success" => false, "title" => "Error", "text" => "Pengguna Sudah Tidak Aktif"];
            }
        } else {
            $this->baseModel->log_action("login", "Akses Ditolak");
            $response = ["success" => false, "title" => "Error", "text" => "User tidak terdaftar"];
        }
        echo json_encode($response);
    }

    function logout(){
        $session = \Config\Services::session();
        $session->destroy();
        return redirect()->to(base_url()); 
    }
}
