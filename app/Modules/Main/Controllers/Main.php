<?php

namespace App\Modules\Main\Controllers;

use App\Modules\Main\Models\MainModel;
use App\Modules\Main\Models\ObjekpajakModel;
use App\Core\BaseController;

class Main extends BaseController
{
    private $mainModel;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->mainModel = new MainModel();
    }

    public function index()
    {
        $session = \Config\Services::session();
        if ($session->get('bptd_id') == 'all') {
            if ($session->get('role_code') == 'sad' || $session->get('role_code') == 'daj') {
                $data = [
                    'title_meta' => view('App\Modules\Main\Views\partials\title-meta', ['title' => 'Dashboard  FMS']),
                    'page_title' => view('App\Modules\Main\Views\partials\page-title', ['title' => 'Dashboard', 'li_1' => '', 'li_2' => 'Dashboard'])
                ];
                return view('App\Modules\Main\Views\layoutpage', $data);
            } else {
                $data = [
                    'title_meta' => view('App\Modules\Main\Views\partials\title-meta', ['title' => 'Dashboard  FMS']),
                    'page_title' => view('App\Modules\Main\Views\partials\page-title', ['title' => 'Dashboard', 'li_1' => '', 'li_2' => 'Dashboard'])
                ];
                return view('App\Modules\Main\Views\layout', $data);
            }
        } else {
            $data = [
                'title_meta' => view('App\Modules\Main\Views\partials\title-meta', ['title' => 'Dashboard  FMS']),
                'page_title' => view('App\Modules\Main\Views\partials\page-title', ['title' => 'Dashboard', 'li_1' => '', 'li_2' => 'Dashboard'])
            ];
            return view('App\Modules\Main\Views\layoutpage', $data);
        }
    }

    public function userprofile()
    {
        $data = [
            'title_meta' => view('App\Modules\Main\Views\partials\title-meta', ['title' => 'User Profile']),
            'page_titles' => view('App\Modules\Main\Views\partials\page-title', ['title' => '', 'li_1' => 'User Profile', 'li_2' => 'Update']),
            'load_view' => 'App\Modules\Main\Views\userprofile',
        ];

        //return $data;
        return view('App\Modules\Main\Views\layout', $data);
    }

    public function manualbook()
    {
        $data = [
            'title_meta' => view('App\Modules\Main\Views\partials\title-meta', ['title' => 'Manual Book']),
            'page_titles' => view('App\Modules\Main\Views\partials\page-title', ['title' => '', 'li_1' => 'Dashboard', 'li_2' => 'Manual Book']),
            'load_view' => 'App\Modules\Main\Views\manualbook',
        ];

        //return $data;
        return view('App\Modules\Main\Views\layoutpage', $data);
    }

    public function dashboard_angkutan()
    {
        $data = [
            'title_meta' => view('App\Modules\Main\Views\partials\title-meta', ['title' => 'Dashboard Control Center']),
            'page_titles' => view('App\Modules\Main\Views\partials\page-title', ['title' => '', 'li_1' => 'Dashboard', 'li_2' => 'Control Center']),
            'load_view' => 'App\Modules\Main\Views\dashboard',
        ];

        //return $data;
        return view('App\Modules\Main\Views\layout', $data);
    }

    public function editbusstop()
    {
        return view('App\Modules\Main\Views\editbusstop');
    }

    public function datapetugas()
    {
        $data['rspetugas'] = $this->mainModel->loadDataPetugas();
        return view('App\Modules\Main\Views\datapetugas', $data);
    }

    public function dev()
    {
        $data = [
            'title_meta' => view('App\Modules\Main\Views\partials\title-meta', ['title' => 'Dashboard  FMS']),
            'page_titles' => view('App\Modules\Main\Views\partials\page-title', ['title' => 'Dashboard', 'li_1' => '', 'li_2' => 'Dashboard']),
            'load_view' => 'App\Modules\Main\Views\dashboard_dev'
        ];
        return view('App\Modules\Main\Views\layout', $data);
    }

    public function temanbus()
    {
        $data = [
            'title_meta' => view('App\Modules\Main\Views\partials\title-meta', ['title' => 'Dashboard Teman Bus']),
            'page_titles' => view('App\Modules\Main\Views\partials\page-title', ['title' => 'Dashboard', 'li_1' => '', 'li_2' => 'Dashboard']),
            'load_view' => 'App\Modules\Main\Views\dashboard_temanbus'
        ];
        return view('App\Modules\Main\Views\layout', $data);
    }

    public function test()
    {
        return view('App\Modules\Main\Views\test');
    }
}
