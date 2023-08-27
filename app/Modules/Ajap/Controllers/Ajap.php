<?php namespace App\Modules\Ajap\Controllers;

use App\Modules\Ajap\Models\AjapModel;
use App\Core\BaseController;

class Ajap extends BaseController
{
    private $ajapModel;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->ajapModel = new AjapModel();
    }

    public function index()
	{
		return redirect()->to(base_url()); 
	}

    public function test()
    {
        return view('App\Modules\Ajap\Views\test'); 
    }

    public function mantripajap()
    {
        $data = [
            'title_meta' => view('App\Modules\Main\Views\partials\title-meta', ['title' => 'Manajemen Rute Trip Ajap']),
            'page_titles' => view('App\Modules\Main\Views\partials\page-title', ['title' => '', 'li_1' => 'Ajap','li_2'=>'Manajemen Rute Trip Ajap']),
            'load_view' => 'App\Modules\Administrator\Views\mantripajap',
        ];
        
        return parent::_authViewPage($data);
    }

    public function manrute()
    {
        $data = [
            'title_meta' => view('App\Modules\Main\Views\partials\title-meta', ['title' => 'Manajemen Trayek Ajap']),
            'page_titles' => view('App\Modules\Main\Views\partials\page-title', ['title' => '', 'li_1' => 'Ajap','li_2'=>'Manajemen Trayek Ajap']),
            'load_view' => 'App\Modules\Administrator\Views\manrute',
        ];
        
        return parent::_authViewPage($data);
    }
}
