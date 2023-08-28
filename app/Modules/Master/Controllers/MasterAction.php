<?php namespace App\Modules\Master\Controllers;

use App\Modules\Master\Models\MasterModel;
use App\Core\BaseController;

class MasterAction extends BaseController
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

    function maskategori_load()
    {
        parent::_authLoad(function () {
            $query = "SELECT a.id, a.kategori FROM mas_kategori a where a.is_deleted = 0";
            $where = ["a.kategori"];

            parent::_loadDatatable($query, $where, $this->request->getPost());
        });
    }

    function maskategori_save(){
        parent::_authInsert(function(){
            parent::_insert('mas_kategori', $this->request->getPost());
        });
    }

    function maskategori_edit(){
        parent::_authEdit(function(){
            $data = $this->request->getPost();
            $query = "SELECT a.id, a.kategori FROM mas_kategori a where a.is_deleted = 0 and a.id = '" . $this->request->getPost('id') . "'";
            parent::_edit('mas_kategori', $data, null, $query);
        });
    }

    function maskategori_delete(){
        parent::_authDelete(function(){
            parent::_delete('mas_kategori', $this->request->getPost());
        });
    }
    function masbrand_load()
    {
        parent::_authLoad(function () {
            $query = "SELECT a.id, a.brand FROM mas_brand a where a.is_deleted = 0";
            $where = ["a.brand"];

            parent::_loadDatatable($query, $where, $this->request->getPost());
        });
    }

    function masbrand_save(){
        parent::_authInsert(function(){
            parent::_insert('mas_brand', $this->request->getPost());
        });
    }

    function masbrand_edit(){
        parent::_authEdit(function(){
            $data = $this->request->getPost();
            $query = "SELECT a.id, a.brand FROM mas_brand a where a.is_deleted = 0 and a.id = '" . $this->request->getPost('id') . "'";
            parent::_edit('mas_brand', $data, null, $query);
        });
    }

    function masbrand_delete(){
        parent::_authDelete(function(){
            parent::_delete('mas_brand', $this->request->getPost());
        });
    }
}
