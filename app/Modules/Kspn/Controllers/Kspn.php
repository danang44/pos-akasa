<?php namespace App\Modules\Kspn\Controllers;

use App\Modules\Kspn\Models\KspnModel;
use App\Core\BaseController;

class Kspn extends BaseController
{
    private $kspnModel;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->kspnModel = new KspnModel();
    }

    public function index()
	{
		return redirect()->to(base_url()); 
	}

    public function test()
    {
        return view('App\Modules\Kspn\Views\test'); 
    }

    public function mantrayek()
    {
        $data = [
            'title_meta' => view('App\Modules\Main\Views\partials\title-meta', ['title' => 'Manajemen Rute Trip KPSN']),
            'page_titles' => view('App\Modules\Main\Views\partials\page-title', ['title' => '', 'li_1' => 'KSPN','li_2'=>'Manajemen Rute Trip KSPN']),
            'load_view' => 'App\Modules\Administrator\Views\mantrayek',
        ];
        
        return parent::_authViewPage($data);
    }

    public function manrute()
    {
        $data = [
            'title_meta' => view('App\Modules\Main\Views\partials\title-meta', ['title' => 'Manajemen Trayek KSPN']),
            'page_titles' => view('App\Modules\Main\Views\partials\page-title', ['title' => '', 'li_1' => 'KSPN','li_2'=>'Manajemen Trayek KSPN']),
            'load_view' => 'App\Modules\Administrator\Views\manrute',
        ];
        
        return parent::_authViewPage($data);
    }

}
