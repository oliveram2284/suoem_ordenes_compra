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



	public function grupos(){

		$data['grupos'] =$this->Users->getGroups();
		$this->load->view('layout/header');
        $this->load->view('user/grupos_index',$data);      
        $js['scripts'][]='js_library/user/index.js';
		$this->load->view('layout/footer',$js);
	}

	public function grupos_add(){

		
		$this->form_validation->set_rules('name', 'Nombre de Grupo',
        'required',
        array(
            'required'      => 'User no ha completado "Nombre de Grupo".'
        ));
		
		if ($this->form_validation->run()){			
			$this->Users->group_insert($this->input->post());			
			$this->session->set_flashdata('msg', 'Nuevo Grupo Agregado');
			redirect('user/grupos');
		}else{

			$this->load->view('layout/header');
			$permissions=$this->permisos();			
			$data['permissions'] = $permissions;		
			$data['grupo'] =null;
			$data['action'] = "user/grupos_add";			
			$this->load->view('user/grupos_form',$data);
			$data['scripts'][]='user/add.js';
			$this->load->view('layout/footer',$data);
		}
		
	}

	public function grupos_edit($user_group_id){
		$this->form_validation->set_rules('name', 'Nombre de Grupo',
        'required',
        array(
            'required'      => 'User no ha completado "Nombre de Grupo".'
        ));
		
		if ($this->form_validation->run()){			
			$this->Users->group_update($user_group_id,$this->input->post());			
			$this->session->set_flashdata('msg', 'Grupo Editado');
			redirect('user/grupos');
		}else{

			$this->load->view('layout/header');
			
			$data['grupo'] =$this->Users->getGroupId($user_group_id);
			$permissions=$this->permisos($data['grupo']);
			
			$data['permissions'] = $permissions;		
			$data['action'] = "user/grupos_edit/".$user_group_id;			
				
			$this->load->view('user/grupos_form',$data);
			$data['scripts'][]='user/add.js';
			$this->load->view('layout/footer',$data);
		}
	}

	public function grupos_delete($user_group_id){
		$this->Users->group_remove($user_group_id);
		$this->session->set_flashdata('msg', 'Grupo Eliminado');
		redirect('user/grupos');
	}

	public function permisos($user_group_info=null){

		$ignore = array(
			'Asistencia',
			'Investment',
			'Vencimiento',
			'Aporte',
			'Welcome',
			'Menu',
			'index',
			'Export',
			'Adherent',
			'Afiliados',
			'Setting'
		);

		$data=array();
		$data['permissions'] = array();
		$files = array();
		$path = array(APPPATH . 'controllers/*');
		//var_dump($path);

		while (count($path) != 0) {
			$next = array_shift($path);

			foreach (glob($next) as $file) {
				// If directory add to path array
				if (is_dir($file)) {
					$path[] = $file . '/*';
				}
				
				// Add the file to the files to be deleted array
				if (is_file($file)) {
					$files[] = $file;
				}
			}
		}

		// Sort the file array
		sort($files);

		foreach ($files as $file) {
			$controller = substr($file, strlen(APPPATH . 'controllers/'));

			$permission = substr($controller, 0, strrpos($controller, '.'));

			if (!in_array($permission, $ignore)) {
				$data['permissions'][] = $permission;
			}
		}

		if (isset($this->request->post['permission']['access'])) {
			$data['access'] = $this->request->post['permission']['access'];
		} elseif (isset($user_group_info['permission']['access'])) {
			$data['access'] = $user_group_info['permission']['access'];
		} else {
			$data['access'] = array();
		}

		if (isset($this->request->post['permission']['modify'])) {
			$data['modify'] = $this->request->post['permission']['modify'];
		} elseif (isset($user_group_info['permission']['modify'])) {
			$data['modify'] = $user_group_info['permission']['modify'];
		} else {
			$data['modify'] = array();
		}
		
		return $data;
	}
}
