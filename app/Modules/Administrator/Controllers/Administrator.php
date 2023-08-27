<?php namespace App\Modules\Administrator\Controllers;

use App\Modules\Administrator\Models\AdministratorModel;
use App\Core\BaseController;

class Administrator extends BaseController
{
    private $administratorModel;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->administratorModel = new AdministratorModel();
    }

    public function index()
	{
		return redirect()->to(base_url()); 
	}

    public function test()
    {
        $data['load_view'] = "App\Modules\Administrator\Views\\test";
        return view('App\Modules\Main\Views\layout', $data); 
    }

    public function manmodul()
    {
        $data = [
			'title_meta' => view('App\Modules\Main\Views\partials\title-meta', ['title' => 'Manajemen Modul']),
			'page_titles' => view('App\Modules\Main\Views\partials\page-title', ['title' => '', 'li_1' => 'Administrator','li_2'=>'Manajemen Modul']),
            'load_view' => 'App\Modules\Administrator\Views\manmodul',
		];
        return parent::_authViewPage($data);
    }

    public function manmenu()
    {
        
        $data = [
			'title_meta' => view('App\Modules\Main\Views\partials\title-meta', ['title' => 'Manajemen Menu']),
			'page_titles' => view('App\Modules\Main\Views\partials\page-title', ['title' => '', 'li_1' => 'Administrator', 'li_2' => 'Manajemen Menu']),
            'modules' => $this->administratorModel->getModules(),
            'load_view' => 'App\Modules\Administrator\Views\manmenu',
		];
        //$data['modules'] = ;
        return parent::_authViewPage($data);
    }

    public function manjenisuser()
    {
        $data = [
			'title_meta' => view('App\Modules\Main\Views\partials\title-meta', ['title' => 'Jenis User']),
			'page_titles' => view('App\Modules\Main\Views\partials\page-title', ['title' => '', 'li_1' => 'Administrator', 'li_2' => 'Jenis User']),
            'modules' => $this->administratorModel->getModules(),
            'load_view' => 'App\Modules\Administrator\Views\manjenisuser',
		];
        return parent::_authViewPage($data);
    }

    public function manhakakses()
    {
        $data = [
			'title_meta' => view('App\Modules\Main\Views\partials\title-meta', ['title' => 'Hak Akses']),
			'page_titles' => view('App\Modules\Main\Views\partials\page-title', ['title' => '', 'li_1' => 'Administrator', 'li_2' => 'Hak Akses']),
            'modules' => $this->administratorModel->getModules(),
            'jenisusers' => $this->administratorModel->getUserRoles(),
            'load_view' => 'App\Modules\Administrator\Views\manhakakses',
		];
        
        return parent::_authViewPage($data);
    }

    public function manuser()
    {
        $data = [
			'title_meta' => view('App\Modules\Main\Views\partials\title-meta', ['title' => 'Manajemen User']),
			'page_titles' => view('App\Modules\Main\Views\partials\page-title', ['title' => '', 'li_1' => 'Administrator', 'li_2' => 'Manajemen User']),
            'modules' => $this->administratorModel->getModules(),
            'jenisusers' => $this->administratorModel->getUserRoles(),
            'load_view' => 'App\Modules\Administrator\Views\manuser',
		];
        

        return parent::_authViewPage($data);
    }

    public function dataprovinsi()
    {
        $data = [
			'title_meta' => view('App\Modules\Main\Views\partials\title-meta', ['title' => 'Data Provinsi']),
			'page_titles' => view('App\Modules\Main\Views\partials\page-title', ['title' => '', 'li_1' => 'Administrator', 'li_2' => 'Data Provinsi']),
            'modules' => $this->administratorModel->getModules(),
            'jenisusers' => $this->administratorModel->getUserRoles(),
            'load_view' => 'App\Modules\Administrator\Views\dataprovinsi',
		];
        return parent::_authViewPage($data);
    }

    public function datakabupaten()
    {
        $data = [
			'title_meta' => view('App\Modules\Main\Views\partials\title-meta', ['title' => 'Data /Kota']),
			'page_titles' => view('App\Modules\Main\Views\partials\page-title', ['title' => '', 'li_1' => 'Administrator', 'li_2' => 'Data /Kota']),
            'modules' => $this->administratorModel->getModules(),
            'jenisusers' => $this->administratorModel->getUserRoles(),
            'load_view' => 'App\Modules\Administrator\Views\datakabupaten',
		];
        return parent::_authViewPage($data);
    }

    public function datakecamatan()
    {
        $data = [
			'title_meta' => view('App\Modules\Main\Views\partials\title-meta', ['title' => 'Data Kecamatan']),
			'page_titles' => view('App\Modules\Main\Views\partials\page-title', ['title' => '', 'li_1' => 'Administrator', 'li_2' => 'Data Kecamatan']),
            'modules' => $this->administratorModel->getModules(),
            'jenisusers' => $this->administratorModel->getUserRoles(),
            'load_view' => 'App\Modules\Administrator\Views\datakecamatan',
		];
        return parent::_authViewPage($data);
    }

    public function datakelurahan()
    {
        $data = [
			'title_meta' => view('App\Modules\Main\Views\partials\title-meta', ['title' => 'Data Kelurahan']),
			'page_titles' => view('App\Modules\Main\Views\partials\page-title', ['title' => '', 'li_1' => 'Administrator', 'li_2' => 'Data Kelurahan']),
            'modules' => $this->administratorModel->getModules(),
            'jenisusers' => $this->administratorModel->getUserRoles(),
            'load_view' => 'App\Modules\Administrator\Views\datakelurahan',
		];
        return parent::_authViewPage($data);
    }

    public function dataTerminal()
    {
        $data = [
			'title_meta' => view('App\Modules\Main\Views\partials\title-meta', ['title' => 'Data Terminai']),
			'page_titles' => view('App\Modules\Main\Views\partials\page-title', ['title' => '', 'li_1' => 'Administrator', 'li_2' => 'Data Terminal']),
            'modules' => $this->administratorModel->getModules(),
            'jenisusers' => $this->administratorModel->getUserRoles(),
            'load_view' => 'App\Modules\Administrator\Views\dataTerminal',
		];
        return parent::_authViewPage($data);
    }

    public function spda()
    {
        $data = [
			'title_meta' => view('App\Modules\Main\Views\partials\title-meta', ['title' => 'spda']),
			'page_titles' => view('App\Modules\Main\Views\partials\page-title', ['title' => '', 'li_1' => 'Administrator', 'li_2' => 'spda']),
            'modules' => $this->administratorModel->getModules(),
            'jenisusers' => $this->administratorModel->getUserRoles(),
            'load_view' => 'App\Modules\Administrator\Views\spda',
		];
        return parent::_authViewPage($data);
    }

    public function manjenpel() {
        $data = [
			'title_meta' => view('App\Modules\Main\Views\partials\title-meta', ['title' => 'Manajemen Jenis Pelayanan']),
			'page_titles' => view('App\Modules\Main\Views\partials\page-title', ['title' => '', 'li_1' => 'Administrator', 'li_2' => 'Manajemen Jenis Pelayanan']),
            'modules' => $this->administratorModel->getModules(),
            'jenisusers' => $this->administratorModel->getUserRoles(),
            'load_view' => 'App\Modules\Administrator\Views\manjenpel',
		];
        

        return parent::_authViewPage($data);
    }
}
