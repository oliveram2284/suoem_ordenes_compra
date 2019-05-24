<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('Settings');
        //$this->Users->updateSession(true);
    }
	public function index()
	{
		$this->load->view('layout/header');
        $this->load->view('setting/index');      
        $data['scripts'][]='js_library/setting/index.js';
		$this->load->view('layout/footer',$data);
    }

    public function datatable_list(){
       
        $recordsTotal= $this->Settings->getTotalSettings($_REQUEST);
        $data= $this->Settings->getFiltered($_REQUEST);
        
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
		
		$this->form_validation->set_rules('nro', 'Número',
        'required',
        array(
                'required'      => 'No ha completado "Número".'
        ));

		$this->form_validation->set_rules('code', 'Código', 'required',
		array(
				'required'      => 'No ha completado %s.'
		));

		$this->form_validation->set_rules('key', 'Clave', 'required',
		array(
				'required'      => 'No ha completado %s.'
		));		

		$this->form_validation->set_rules('value', 'Valor', 'required',
		array(
				'required'      => 'No ha completado %s.'
		));		


		if ($this->form_validation->run())
		{
			$this->Settings->insert();
			$this->session->set_flashdata('msg', 'Nueva Configuración Agregada');
			redirect('setting');
		}
		else
		{
			$this->load->view('layout/header');
			
			$data['setting'] =null;
			$data['action'] = "setting/add";
			$this->load->view('setting/form',$data);
			$this->load->view('layout/footer',$data);
		}
		
		
    }
    
    public function edit($id)
	{
		$this->form_validation->set_rules('nro', 'Número',
        'required',
        array(
                'required'      => 'No ha completado "Número".'
        ));

		$this->form_validation->set_rules('code', 'Código', 'required',
		array(
				'required'      => 'No ha completado %s.'
		));

		$this->form_validation->set_rules('key', 'Clave', 'required',
		array(
				'required'      => 'No ha completado %s.'
		));		

		$this->form_validation->set_rules('value', 'Valor', 'required',
		array(
				'required'      => 'No ha completado %s.'
		));		


		if ($this->form_validation->run())
		{
			$this->Settings->update($id);	
			$this->session->set_flashdata('msg', 'Configuración Editada');		
			redirect('setting');
		}
		else
		{	
			$this->load->view('layout/header');
			$setting =$this->Settings->getById($id);
			$data['setting']=$setting;
			$data['action'] = current_url();
			$this->load->view('setting/form',$data);
			$this->load->view('layout/footer',$data);
		}
    }
    
    public function delete($id)
	{	
		if($this->Settings->delete($id)){
			$this->session->set_flashdata('msg', '<b>Configuració Eliminada</b>');		
		}else{
			$this->session->set_flashdata('msg', 'No se pudo Eliminar esta configuración');		
		}
		redirect('setting');
	}

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
}
