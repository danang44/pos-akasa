<?php namespace App\Modules\Rampcheck\Controllers;

use App\Modules\Rampcheck\Models\RampcheckModel;
use App\Core\BaseController;

class RampcheckAjax extends BaseController
{
    private $rampcheckModel;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->rampcheckModel = new RampcheckModel();
    }

    public function index()
    {
        return redirect()->to(base_url()); 
    }

    // public function module_select_get(){
    //     $module = $this->administratorModel->getModules();

    //     $option = array_map(function($data){
    //         return "<option value='".$data->id."'>".$data->module_name."</option>";
    //     }, $module);

    //     return "<select class='idmodule' name='idmodule[]' required>
    //             <option value=''>Pilih Modul</option>" .
    //             implode("", $option) . "<select>";
    // }
}
