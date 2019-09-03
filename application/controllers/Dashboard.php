<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    function __construct(){
		parent::__construct();
		//$this->load->model('Adherents');
		//$this->load->model('Aportes');
		//$this->load->model('Asistencias');
		$this->load->model('Ordenes');
		
    }
	public function index(){
		if(!$this->auth->is_logged()){
			//redirect('login', 'refresh');
			redirect('inicio', 'refresh');
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




	public function inicio(){
		$this->load->view('inicio');
	}


	public function comercio_dashboard(){
		
		/*var_dump($this->session->get_userdata());
		var_dump($this->session->get_userdata('comercio_id'));
		*/
		if(!$this->auth->is_logged()){
			//redirect('login', 'refresh');
			redirect('inicio', 'refresh');
		}

		$permisos=$this->auth->comercio_permisos();

		$this->load->view('comercio_panel/header',array('permisos'=>$permisos));
		$this->load->view('comercio_panel/dashboard',array());
		$this->load->view('comercio_panel/footer');
	}
	public function login(){
		
		if($this->input->post('username')!=null){
			$this->auth->login($this->input->post());
			redirect('/', 'refresh');
		}
		
		$this->load->view('login');
	}

	public function comercio_login(){
		
		if($this->input->post('username')!=null){

			
			
			$this->auth->login_comercio($this->input->post());
			//var_dump($this->session->get_userdata());
			//die("fin");
			redirect('/comercios/panel', 'refresh');
		}
		
		$this->load->view('login2');
	}


	public function logout(){
		$this->auth->logout();
		redirect('/', 'refresh');
	}

	public function error(){
		
	}

	public function consulta(){
		$this->load->view('layout/headerCliente');
		$this->load->view('comercios/dash');
		$data['scripts'][]='js_library/comercio/dash.js';
        $this->load->view('layout/footer',$data);
		//$this->load->view('layout/footer');
	}

	public function buscarOrden($orden_nro){
		 $this->load->model('Ordenes');
        echo json_encode($this->Ordenes->buscarOrden(array('nro'=>$orden_nro)));
    }

}
