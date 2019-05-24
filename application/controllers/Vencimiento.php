<?php
defined('BASEPATH') OR exit('No direct script access allowed');



class Vencimiento extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model('Vencimientos');
        if(!$this->auth->is_logged()){
			redirect('login', 'refresh');
		}
    }

    public function index(){

        $this->load->view('layout/header');
        $data['action'] = "vencimiento/add"; 
        $this->load->view('vencimiento/index',$data);   

        $data['scripts'][]='js_library/vencimiento/index.js';
		$this->load->view('layout/footer',$data);
    }

    public function datatable_list($data = null){
       
        $recordsTotal=$this->Vencimientos->getTotalFiltered($_REQUEST);
        $data= $this->Vencimientos->getFiltered($_REQUEST);
        
		$response=array(
			'draw' => $_REQUEST['draw'],
			'recordsTotal' => $recordsTotal,
			'recordsFiltered' => $recordsTotal,
			'data' => $data
		);

		echo json_encode($response);
	}


    public function set($id){
        echo json_encode($this->Vencimientos->setById($id));
    }
}