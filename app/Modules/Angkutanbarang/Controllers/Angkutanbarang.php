<?php namespace App\Modules\Angkutanbarang\Controllers;

use App\Modules\Angkutanbarang\Models\AngkutanbarangModel;
use App\Core\BaseController;

class Angkutanbarang extends BaseController
{
    private $angkutanbarangModel;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->angkutanbarangModel = new AngkutanbarangModel();
    }

    public function index()
	{
		return redirect()->to(base_url()); 
	}

    public function test()
    {
        return view('App\Modules\Angkutanbarang\Views\test'); 
    }

    public function mantrayek()
    {
        $data = [
            'title_meta' => view('App\Modules\Main\Views\partials\title-meta', ['title' => 'Manajemen Rute Trip Angkutan Barang']),
            'page_titles' => view('App\Modules\Main\Views\partials\page-title', ['title' => '', 'li_1' => 'Angkutan Barang','li_2'=>'Manajemen Rute Trip Angkutan Barang']),
            'load_view' => 'App\Modules\Administrator\Views\mantrayek',
        ];
        
        return parent::_authViewPage($data);
    }

    public function manrute()
    {
        $data = [
            'title_meta' => view('App\Modules\Main\Views\partials\title-meta', ['title' => 'Manajemen Trayek Angkutan Barang']),
            'page_titles' => view('App\Modules\Main\Views\partials\page-title', ['title' => '', 'li_1' => 'Angkutan Barang','li_2'=>'Manajemen Trayek Angkutan Barang']),
            'load_view' => 'App\Modules\Administrator\Views\manrute',
        ];
        
        return parent::_authViewPage($data);
    }
}
