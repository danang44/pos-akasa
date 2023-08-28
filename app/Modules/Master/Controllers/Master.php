<?php namespace App\Modules\Master\Controllers;

use App\Modules\Master\Models\MasterModel;
use App\Core\BaseController;

class Master extends BaseController
{
    private $masterModel;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->masterModel = new MasterModel();
    }

    public function index()
	{
		return redirect()->to(base_url()); 
	}

    public function test()
    {
        return view('App\Modules\Master\Views\test'); 
    }

    public function maskategori()
    {
        $data = [
            'title_meta' => view('App\Modules\Main\Views\partials\title-meta', ['title' => 'Master Kategori']),
            'page_titles' => view('App\Modules\Main\Views\partials\page-title', ['title' => '', 'li_1' => 'Master','li_2'=>'Master Kategori']),
            'load_view' => 'App\Modules\Master\Views\maskategori',
        ];

        return parent::_authViewPage($data);
    }

    public function masmenu()
    {
        $data = [
            'title_meta' => view('App\Modules\Main\Views\partials\title-meta', ['title' => 'Master Menu']),
            'page_titles' => view('App\Modules\Main\Views\partials\page-title', ['title' => '', 'li_1' => 'Master','li_2'=>'Master Menu']),
            'load_view' => 'App\Modules\Master\Views\masmenu',
        ];

        return parent::_authViewPage($data);
    }

    public function masbrand()
    {
        $data = [
            'title_meta' => view('App\Modules\Main\Views\partials\title-meta', ['title' => 'Master Brand']),
            'page_titles' => view('App\Modules\Main\Views\partials\page-title', ['title' => '', 'li_1' => 'Master','li_2'=>'Master Brand']),
            'load_view' => 'App\Modules\Master\Views\masbrand',
        ];

        return parent::_authViewPage($data);
    }

}
