<?php namespace App\Modules\Rampcheck\Controllers;

use App\Modules\Rampcheck\Models\RampcheckModel;
use App\Core\BaseController;

class Rampcheck extends BaseController
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

    public function test()
    {
        $data['page_title'] = 'Rampcheck Data';
        $data['load_view'] = "App\Modules\Rampcheck\Views\\rampcheck";
        return view('App\Modules\Main\Views\layout', $data); 
    }

    public function rampcheck()
    {
        $data['terminalData'] = $this->rampcheckModel->getTerminal();
        $data['jenisAngkutanData'] = $this->rampcheckModel->getJenisAngkutan();
        $data['jenisLokasiData'] = $this->rampcheckModel->getJenisLokasi();
        $data['provData'] = $this->rampcheckModel->getProv();
        // $data['kabKota'] = $this->rampcheckModel->getKabKota();
        // $data['kec'] = $this->rampcheckModel->getKec();
        

        return parent::_authView($data);
    }
}
