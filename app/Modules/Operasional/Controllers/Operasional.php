<?php namespace App\Modules\Operasional\Controllers;

use App\Modules\Operasional\Models\OperasionalModel;
use App\Core\BaseController;

class Operasional extends BaseController
{
    private $operasionalModel;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->operasionalModel = new OperasionalModel();
        date_default_timezone_set('Asia/Jakarta');
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

    public function spda()
    {
        $data = [
			'title_meta' => view('App\Modules\Main\Views\partials\title-meta', ['title' => 'FMS | SPDA']),
			'page_titles' => view('App\Modules\Main\Views\partials\page-title', ['title' => '', 'li_1' => 'Operasional','li_2'=>'spda']),
            'load_view' => 'App\Modules\Operasional\Views\spda',
            'role_code' => $this->session->get('role_code')
		];
        return parent::_authViewPage($data);
    }

    public function armada()
    {
        $data = [
            'title_meta' => view('App\Modules\Main\Views\partials\title-meta', ['title' => 'FMS | Armada']),
            'page_titles' => view('App\Modules\Main\Views\partials\page-title', ['title' => '', 'li_1' => 'Operasional','li_2'=>'Armada']),
            'load_view' => 'App\Modules\Operasional\Views\armada',
        ];
        return parent::_authViewPage($data);
    }

    public function pengemudi()
    {
        $data = [
            'title_meta' => view('App\Modules\Main\Views\partials\title-meta', ['title' => 'FMS | Pengemudi']),
            'page_titles' => view('App\Modules\Main\Views\partials\page-title', ['title' => '', 'li_1' => 'Operasional','li_2'=>'Pengemudi']),
            'load_view' => 'App\Modules\Operasional\Views\pengemudi',
        ];
        return parent::_authViewPage($data);
    }

    public function datapo()
    {
        $data = [
            'title_meta' => view('App\Modules\Main\Views\partials\title-meta', ['title' => 'FMS | Data PO']),
            'page_titles' => view('App\Modules\Main\Views\partials\page-title', ['title' => '', 'li_1' => 'Operasional', 'li_2' => 'Perusahaan Operator']),
            // 'modules' => $this->administratorModel->getModules(),
            // 'jenisusers' => $this->administratorModel->getUserRoles(),
            'load_view' => 'App\Modules\Operasional\Views\datapo',
        ];
        return parent::_authViewPage($data);
    }

    public function timetablesarmada()
    {
        $data = [
            'title_meta' => view('App\Modules\Main\Views\partials\title-meta', ['title' => 'FMS | Timetables Armada']),
            'page_titles' => view('App\Modules\Main\Views\partials\page-title', ['title' => '', 'li_1' => 'Operasional', 'li_2' => 'Timetables Armada']),

            'load_view' => 'App\Modules\Operasional\Views\timetablesarmada',
        ];
        return parent::_authViewPage($data);
    }

    public function timetablesbptd()
    {
        $data = [
            'title_meta' => view('App\Modules\Main\Views\partials\title-meta', ['title' => 'FMS | Timetables BPTD']),
            'page_titles' => view('App\Modules\Main\Views\partials\page-title', ['title' => '', 'li_1' => 'Operasional', 'li_2' => 'Timetables BPTD']),

            'load_view' => 'App\Modules\Operasional\Views\timetablesbptd',
        ];
        return parent::_authViewPage($data);
    }
}
