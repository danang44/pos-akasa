<?php namespace App\Modules\Rampcheck\Controllers;

use App\Modules\Administrator\Models\RampcheckModel;
use App\Core\BaseController;

class RampcheckAction extends BaseController
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

    // function manmodul_load()
    // {
    //     parent::_authLoad(function(){
    //         $query = "select a.* from s_module a where a.is_deleted = 0";
    //         $where = ["a.module_url", "a.module_name"];
        
    //         parent::_loadDatatable($query, $where, $this->request->getPost());
    //     });
    // }

    // function manmodul_save()
    // {
    //     parent::_authInsert(function(){
    //         parent::_insert('s_module', $this->request->getPost());
    //     });
    // }

    // function manmodul_edit()
    // {
    //     parent::_authEdit(function(){
    //         parent::_edit('s_module', $this->request->getPost());
    //     });
    // }

    // function manmodul_delete()
    // {   
    //     parent::_authDelete(function(){
    //         parent::_delete('s_module', $this->request->getPost());
    //     });
    // }

    // function manmenu_load()
    // {
    //     parent::_authLoad(function(){
    //         $query = "select a.*, b.module_name, c.menu_name as menu_parent from s_menu a 
    //         left join s_module b on a.module_id = b.id
    //         left join s_menu c on a.menu_id = c.id
    //         where a.is_deleted = 0";
    //         $where = ["a.menu_url", "a.menu_name", "b.module_name", "c.menu_name"];
            
    //         parent::_loadDatatable($query, $where, $this->request->getPost());
    //     });
    // }

    // function manmenu_save()
    // {
    //     parent::_authInsert(function(){
    //         $data = $this->request->getPost();
    //         $data['menu_id'] = $this->request->getPost('menu_id') == "" ? null : $this->request->getPost('menu_id');
    //         parent::_insert('s_menu', $data);
    //     });
    // }

    // function manmenu_edit()
    // {
    //     parent::_authEdit(function(){
    //         parent::_edit('s_menu', $this->request->getPost());
    //     });
    // }

    // function manmenu_delete()
    // {
    //     parent::_authDelete(function(){
    //         parent::_delete('s_menu', $this->request->getPost());
    //     });
    // }
}
