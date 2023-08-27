<?php namespace App\Modules\Laporan\Controllers;

use App\Modules\Laporan\Models\LaporanModel;
use App\Core\BaseController;

class Laporan extends BaseController
{
    private $laporanModel;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->laporanModel = new LaporanModel();
    }

    public function index()
	{
		return redirect()->to(base_url()); 
	}

    public function test()
    {
        return view('App\Modules\Laporan\Views\test'); 
    }

    public function lapharianspda() {
        $data = [
			'title_meta' => view('App\Modules\Main\Views\partials\title-meta', ['title' => 'Laporan Harian SPDA']),
			'page_titles' => view('App\Modules\Main\Views\partials\page-title', ['title' => '', 'li_1' => 'Laporan','li_2'=>'Laporan Harian SPDA']),
            'load_view' => 'App\Modules\Operasional\Views\lapharianspda',
            'role_code' => $this->session->get('role_code')
		];
        return parent::_authViewPage($data);
    }

    public function lapritase() {
        $data = [
			'title_meta' => view('App\Modules\Main\Views\partials\title-meta', ['title' => 'Laporan Ritase']),
			'page_titles' => view('App\Modules\Main\Views\partials\page-title', ['title' => '', 'li_1' => 'Laporan','li_2'=>'Laporan Ritase']),
            'load_view' => 'App\Modules\Operasional\Views\lapritase',
            'role_code' => $this->session->get('role_code')
		];
        return parent::_authViewPage($data);
    }

}
