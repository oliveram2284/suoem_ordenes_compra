<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    function __construct(){
		parent::__construct();
		//$this->load->model('Adherents');
		//$this->load->model('Aportes');
		//$this->load->model('Asistencias');
		
		
    }
	public function index()
	{
		if(!$this->auth->is_logged()){
			redirect('login', 'refresh');
		}
		$permisos=$this->auth->permisos();

		$data['totals']=array(
			'adherents'=>0,
			'aporte'=>0,
			'asistencias'=>0,
		);
		$data['adherentes_ultimos']= array();
		$data['recent_activities']= array();
		
		

		$this->load->view('layout/header',array('permisos'=>$permisos));
		$this->load->view('dashboard',$data);
		$this->load->view('layout/footer');
	}

	public function login(){
		
		if($this->input->post('username')!=null){
			$this->auth->login($this->input->post());
			redirect('/', 'refresh');
		}
		
		$this->load->view('login');
	}

	public function logout(){
		$this->auth->logout();
		redirect('/', 'refresh');
	}

	public function error(){
		
	}

	public function consulta()
	{
		$this->load->view('layout/headerCliente');
		$this->load->view('layout/footer');
	}

}
