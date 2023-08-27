<?php namespace App\Modules\Perintis\Controllers;

use App\Modules\Perintis\Models\PerintisModel;
use App\Core\BaseController;

class Perintis extends BaseController
{
    private $perintisModel;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->perintisModel = new PerintisModel();
    }

    public function index()
	{
		return redirect()->to(base_url()); 
	}

    public function test()
    {
        return view('App\Modules\Perintis\Views\test'); 
    }

    public function mantrayek()
    {
        $data = [
            'title_meta' => view('App\Modules\Main\Views\partials\title-meta', ['title' => 'Manajemen Rute Trip Perintis']),
            'page_titles' => view('App\Modules\Main\Views\partials\page-title', ['title' => '', 'li_1' => 'Perintis','li_2'=>'Manajemen Rute Trip Perintis']),
            'load_view' => 'App\Modules\Administrator\Views\mantrayek',
        ];
        
        return parent::_authViewPage($data);
    }

    public function manrute()
    {
        $data = [
            'title_meta' => view('App\Modules\Main\Views\partials\title-meta', ['title' => 'Manajemen Trayek Perintis']),
            'page_titles' => view('App\Modules\Main\Views\partials\page-title', ['title' => '', 'li_1' => 'Perintis','li_2'=>'Manajemen Trayek Perintis']),
            'load_view' => 'App\Modules\Administrator\Views\manrute',
        ];
        
        return parent::_authViewPage($data);
    }
}
