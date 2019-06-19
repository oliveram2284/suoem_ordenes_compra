<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente extends CI_Controller {

    function __construct(){
		parent::__construct();
		//$this->load->model('Adherents');
		//$this->load->model('Aportes');
		//$this->load->model('Asistencias');
		
		
    }
	public function index()
	{

		$this->load->view('layout/headerCliente');
		//$this->load->view('dashboard');
		$this->load->view('layout/footer');
	}

}
