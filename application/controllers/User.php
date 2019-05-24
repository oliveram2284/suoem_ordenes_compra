<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('Users');
        //$this->Users->updateSession(true);
    }
	public function index()
	{
		$this->load->view('layout/header');
        $this->load->view('user/index');      
        $data['scripts'][]='js_library/user/index.js';
		$this->load->view('layout/footer',$data);
    }

    public function datatable_list(){
       
        $recordsTotal= $this->Users->getTotalUsers($_REQUEST);
        $data= $this->Users->getFiltered($_REQUEST);
        
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
		
		$this->form_validation->set_rules('username', 'Nombre de Usuario',
        'required|is_unique[users.username]',
        array(
                'required'      => 'User no ha completado "Nombre de Usuario".',
                'is_unique'     => 'El Nombre de Usuario ya existe.'
        ));
		$this->form_validation->set_rules('password', 'Contraseña', 'required',
		array(
				'required'      => 'User no ha completado %s.'
		));

		$this->form_validation->set_rules('user_group_id', 'Grupo', 'required',
		array(
				'required'      => 'Debe seleccionar un %s.'
		));		


		if ($this->form_validation->run())
		{
			$this->Users->insert();
			$this->session->set_flashdata('msg', 'Nuevo Usuario Agregado');
			redirect('user');
		}
		else
		{
			$this->load->view('layout/header');
			
			$data['user_groups'] =$this->Users->getGroups();
			$data['user'] =null;
			$data['action'] = "user/add";
			$this->load->view('user/form',$data);
			
			
			$data['scripts'][]='user/add.js';
			$this->load->view('layout/footer',$data);
		}
		
		
    }
    
    public function edit($id)
	{
		$this->form_validation->set_rules('username', 'Nombre de Usuario',
        'required|is_unique[users.username]',
        array(
                'required'      => 'User no ha completado "Nombre de Usuario".',
                //'is_unique'     => 'El Nombre de Usuario ya existe.'
        ));

		$this->form_validation->set_rules('user_group_id', 'Grupo', 'required',
		array(
				'required'      => 'Debe seleccionar un %s.'
		));		


		if ($this->form_validation->run())
		{
			$this->Users->update($id);	
			$this->session->set_flashdata('msg', 'Usuario Editado');		
			redirect('user');
		}
		else
		{	
			$this->load->view('layout/header');
			$user =$this->Users->getById($id);
			$data['user']=$user;
			
			$data['user_groups'] =$this->Users->getGroups();
			$data['action'] = current_url();
			$this->load->view('user/form',$data);
			
			
			$data['scripts'][]='user/add.js';
			$this->load->view('layout/footer',$data);
		}
    }
    
    public function delete($id)
	{	
		if($this->Users->delete($id)){
			$this->session->set_flashdata('msg', '<b>Usuario Eliminado</b>');		
		}else{
			$this->session->set_flashdata('msg', 'No se pudo Eliminar a este Usuario');		
		}
		redirect('user');
	}
}
