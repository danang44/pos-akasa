<?php namespace App\Modules\Akap\Controllers;

use App\Modules\Akap\Models\AkapModel;
use App\Core\BaseController;

class Akap extends BaseController
{
    private $akapModel;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->akapModel = new AkapModel();
    }

    public function index()
	{
		return redirect()->to(base_url()); 
	}

    public function test()
    {
        return view('App\Modules\Akap\Views\test'); 
    }

    public function mantripakap()
    {
        $data = [
            'title_meta' => view('App\Modules\Main\Views\partials\title-meta', ['title' => 'Manajemen Rute Trip Akap']),
            'page_titles' => view('App\Modules\Main\Views\partials\page-title', ['title' => '', 'li_1' => 'Akap','li_2'=>'Manajemen Rute Trip Akap']),
            'load_view' => 'App\Modules\Administrator\Views\mantripakap',
        ];
        
        return parent::_authViewPage($data);
    }

    public function manrute()
    {
        $data = [
            'title_meta' => view('App\Modules\Main\Views\partials\title-meta', ['title' => 'Manajemen Trayek Akap']),
            'page_titles' => view('App\Modules\Main\Views\partials\page-title', ['title' => '', 'li_1' => 'Akap','li_2'=>'Manajemen Trayek Akap']),
            'load_view' => 'App\Modules\Administrator\Views\manrute',
        ];
        
        return parent::_authViewPage($data);
    }
}
