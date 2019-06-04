<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Municipio extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('Municipios');
        //$this->Users->updateSession(true);
    }
	public function index()
	{
		$this->load->view('layout/header');
        $this->load->view('municipio/index');      
        $data['scripts'][]='js_library/municipio/index.js';
		$this->load->view('layout/footer',$data);
    }

    public function datatable_list(){
       
        $recordsTotal= $this->Municipios->getTotalMunicipios($_REQUEST);
        $data= $this->Municipios->getFiltered($_REQUEST);
        
		$response=array(
			'draw' => $_REQUEST['draw'],
			'recordsTotal' => $recordsTotal,
			'recordsFiltered' => count($data),
			'data' => $data
		);

		echo json_encode($response);
    }
    
    public function add()
	{	 
	
		$this->form_validation->set_rules('code', 'Código', 'required',
		array(
				'required'      => 'No ha completado %s.'
		));

		$this->form_validation->set_rules('nombre', 'Nombre', 'required',
		array(
				'required'      => 'No ha completado %s.'
		));		


		if ($this->form_validation->run())
		{
			$this->Municipios->insert();
			$this->session->set_flashdata('msg', 'Nuevo Municipio Agregado');
			redirect('municipio');
		}
		else
		{
			$this->load->view('layout/header');
			
			$data['municipio'] =null;
			$data['action'] = "municipio/add";
			$this->load->view('municipio/form',$data);
			$this->load->view('layout/footer',$data);
		}
		
		
    }
    
    public function edit($id)
	{

		$this->form_validation->set_rules('code', 'Código', 'required',
		array(
				'required'      => 'No ha completado %s.'
		));
	

		$this->form_validation->set_rules('nombre', 'Nombre', 'required',
		array(
				'required'      => 'No ha completado %s.'
		));		


		if ($this->form_validation->run())
		{
			$this->Municipios->update($id);	
			$this->session->set_flashdata('msg', 'Municipio Editado');		
			redirect('municipio');
		}
		else
		{	
			$this->load->view('layout/header');
			$municipio =$this->Municipios->getById($id);
			$data['municipio']=$municipio;
			$data['action'] = current_url();
			$this->load->view('municipio/form',$data);
			$this->load->view('layout/footer',$data);
		}
    }
    
    public function delete($id)
	{	
		if($this->Municipios->delete($id)){
			$this->session->set_flashdata('msg', '<b>Municipio Eliminado</b>');		
		}else{
			$this->session->set_flashdata('msg', 'No se pudo Eliminar este Municipio');		
		}
		redirect('municipio');
	}
	/*
	public function export(){
		$this->load->view('layout/header');
		
		$data=array();
		$data['action'] = current_url();
		$this->load->view('setting/export_index',$data);
		$this->load->view('layout/footer',$data);
	}

	public function backup(){
		$this->load->dbutil();

		$prefs = array(     
			'format'      => 'zip',             
			'filename'    => 'fastram_full_backup_'.date('YmdHis').'.sql'
			);


		$backup =& $this->dbutil->backup($prefs); 

		$db_name = 'fastram_full_backup_'. date("Y-m-d-H-i-s") .'.zip';
		$save = 'pathtobkfolder/'.$db_name;

		$this->load->helper('file');
		write_file($save, $backup); 


		$this->load->helper('download');
		force_download($db_name, $backup);
	}
	*/
}
