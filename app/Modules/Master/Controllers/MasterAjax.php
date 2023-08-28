<?php namespace App\Modules\Master\Controllers;

use App\Modules\Master\Models\MasterModel;
use App\Core\BaseController;

class MasterAjax extends BaseController
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
}
