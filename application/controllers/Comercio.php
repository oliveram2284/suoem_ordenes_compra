<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comercio extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model('Comercios');
        //$this->Users->updateSession(true);
        if(!$this->auth->is_logged()){
			redirect('login', 'refresh');
		}
    }
	public function index()
	{   

        

        $this->load->view('layout/header');
        $data['comercios']=$this->Comercios->getAll();       
        $this->load->view('Comercios/index',$data);      
        $data['scripts'][]='js_library/Comercio/index.js';
		$this->load->view('layout/footer',$data);
    }
    
    public function datatable_list(){
       
        $recordsTotal= $this->Afiliadoss->getTotalFiltered($_REQUEST);
        $data= $this->Afiliadoss->getFiltered($_REQUEST);
       
		$response=array(
			'draw' => $_REQUEST['draw'],
			'recordsTotal' => $recordsTotal,
			'recordsFiltered' => $recordsTotal,
			'data' => $data
		);

		echo json_encode($response);
    }

    public function add(){

        $this->form_validation->set_rules('codigo', 'Código de Comercio ','required|numeric|min_length[1]|max_length[12]|is_unique[Comercios.codigo]',
           
            array(
                'required'      => 'Código de Comercio es obligatorio.',
                'numeric'       => 'El Código de Comercio No puede.',
                'is_unique'     => 'El Código de Comercio ya existe.'
            )
        );
        $this->form_validation->set_rules('nombre', 'Nombre',
            'required|min_length[3]',
            array(
                'required'      => 'Nombre es obligatorio.'
            )
        );
        $this->form_validation->set_rules('razon_social', 'Razón Social',
            'required|min_length[3]',
            array(
                'required'      => 'Razón Social es obligatorio.'
            )
        );
        $this->form_validation->set_rules('cuit', 'CUIT',
            'required|numeric|min_length[6]',
            array(
                'required'      => 'CUIT es obligatorio.'
            )
        );       

        
        if ($this->form_validation->run())
		{      
           
            
            if( $this->Comercios->add($this->input->post()) ){

                $this->session->set_flashdata('msg', 'Nuevo Comercio se ha Creado');                
                redirect('Comercio');
            }
		}
		else
		{
            $this->load->view('layout/header');
            $data['action'] = "comercio/add";
           
            

            $data['comercio'] = null;
            $this->load->view('Comercios/form',$data);    
            
            $data['scripts'][]='';//'js_library/Afiliados/add.js';
            $this->load->view('layout/footer',$data);
        }
    }

    public function edit($id){
        
        $this->form_validation->set_rules('codigo', 'Código de Comercio ','required|numeric|min_length[1]|max_length[12]',
           
            array(
                'required'      => 'Código de Comercio es obligatorio.',
                'numeric'       => 'El Código de Comercio No puede.',
            )
        );
        $this->form_validation->set_rules('nombre', 'Nombre',
            'required|min_length[3]',
            array(
                'required'      => 'Nombre es obligatorio.'
            )
        );
        $this->form_validation->set_rules('razon_social', 'Razón Social',
            'required|min_length[3]',
            array(
                'required'      => 'Razón Social es obligatorio.'
            )
        );
        $this->form_validation->set_rules('cuit', 'CUIT',
            'required|numeric|min_length[6]',
            array(
                'required'      => 'CUIT es obligatorio.'
            )
        );     

        if ($this->form_validation->run())
		{      
           
            if( $this->Comercios->update($id,$this->input->post()) ){
                $this->session->set_flashdata('msg', 'Comercio Actualizado');                
                redirect('Comercio');
            }
		}
		else
		{
            $this->load->view('layout/header');
            $data['action'] = current_url();
            
            $comercio =$this->Comercios->getById($id);
            $data['comercio']=$comercio;
            $this->load->view('Comercios/form',$data);    
            $data['scripts'][]='js_library/Afiliados/add.js';
            $this->load->view('layout/footer',$data);
        }
    }
    /*
    public function import(){        

        
        $this->load->library('ExcelCi');
        $upload_path='./assets/uploads/';        
        if(!file_exists($upload_path)){
            mkdir($upload_path);
        }
            
        $config['upload_path']          = './assets/uploads/';
        $config['allowed_types']        = 'xls|xlsx';

        $this->load->library('upload', $config);
        $data = array('upload_data' => $this->upload->data());

        if ($this->upload->do_upload('import_file') )
        {

            $data = array('upload_data' => $this->upload->data());
            $result_import= $this->excelci->import($data['upload_data']['full_path']);
            $message ="<p> Total de Filas Procesadas ".$result_import['total_rows']."<br>"  ; 
            $message.="<p> Afiliadoses Nuevos ".$result_import['inserted']."<br>"  ; 
            $message.="<p> Afiliadoses Actualizados ".$result_import['updated']."<br>"  ; 
            $this->session->set_flashdata('msg', $message);
            

        }else{
            $error = array('error' => $this->upload->display_errors());      
        }

        $this->load->view('layout/header');
        $data['action'] = "Afiliados/import";
        $this->load->view('Afiliados/import',$data);   
           
        $data['scripts'][]=array();
		$this->load->view('layout/footer',$data);
        

    } */

    public function delete($id)
	{	
		if($this->Comercios->delete($id)){
			$this->session->set_flashdata('msg', '<b>Comercio Eliminado</b>');		
		}else{
			$this->session->set_flashdata('msg', 'No se pudo Eliminar a este Comercio');		
		}
		redirect('Comercio');
    }

    public function info($id)
    {   

        $info['data'] = $this->Afiliadoss->getInfo($id);
        $this->load->view('layout/header');
        $this->load->view('Afiliados/info', $info);      
        $data['scripts'][]=null;
        $this->load->view('layout/footer',$data);
    }

    public function imprimirinfo(){

        $data = $this->input->post();
        $info = array();
        $info['data'] = $this->Afiliadoss->getInfo($data['id']);
        $html = $this->load->view('Afiliados/infoPrint', $info, true);
        echo json_encode($this->Afiliadoss->imprimirInfo($data, $html));
    }
    
}
