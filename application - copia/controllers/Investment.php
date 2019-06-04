<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Investment extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model('Investments');
        if(!$this->auth->is_logged()){
			redirect('login', 'refresh');
		}
    }
	public function index()
	{
		$this->load->view('layout/header');

		$data=array();
		$data['investment']=$this->Investments->getAll();
		$data['earnings']=$this->Investments->getEarningsAll();
		$this->load->view('investment/index',$data);      
		
        $data['scripts'][]='js_library/investment/index.js';
		$this->load->view('layout/footer',$data);
	}

	public function add(){
		$this->form_validation->set_rules('fecha_emision', 'Fecha de Emisión ','required',
            array(
                'required'      => 'Fecha de Emisión es obligatorio.',
            )
		);
		$this->form_validation->set_rules('fecha_vencimiento', 'Fecha de Vencimiento ','required',
            array(
                'required'      => 'Fecha de Vencimiento es obligatorio.',
            )
		);
		
        $this->form_validation->set_rules('import', 'Importe','required|numeric|min_length[1]',
            array(
                'required'      => 'Importe es un valor obligatorio.',
                'numeric'       => 'Importe solo debe contener Numeros.'
            )
		);
		$this->form_validation->set_rules('interes', 'Interes','required|numeric|min_length[1]',
            array(
                'required'      => 'Interes es un valor obligatorio.',
                'numeric'       => 'Interes solo debe contener Numeros.'
            )
		);
		
		$this->form_validation->set_rules('tasa', 'Tasa','required|numeric|min_length[1]',
            array(
                'required'      => 'Tasa es un valor obligatorio.',
                'numeric'       => 'Tasa solo debe contener Numeros.'
            )
        );

        if ($this->form_validation->run())
		{      

			
			

            if( $this->Investments->add() ){
                $this->session->set_flashdata('msg', 'Nuevo Plazo Fijo se ha creado');                
                redirect('investment');
            }
		}
		else
		{
            $this->load->view('layout/header');
            $data['action'] = "investment/add";            
            $data['invesment_data'] = null;           
            //$data['adherents'] = array();
            $this->load->view('investment/form',$data);    
            $data['scripts'][]='js_library/investment/add.js';            
            $this->load->view('layout/footer',$data);
        }
    }
    
    public function edit($id){

        $this->form_validation->set_rules('fecha_emision', 'Fecha de Emisión ','required',
            array(
                'required'      => 'Fecha de Emisión es obligatorio.',
            )
		);
		$this->form_validation->set_rules('fecha_vencimiento', 'Fecha de Vencimiento ','required',
            array(
                'required'      => 'Fecha de Vencimiento es obligatorio.',
            )
		);
		
        $this->form_validation->set_rules('import', 'Importe','required|numeric|min_length[1]',
            array(
                'required'      => 'Importe es un valor obligatorio.',
                'numeric'       => 'Importe solo debe contener Numeros.'
            )
		);
		$this->form_validation->set_rules('interes', 'Interes','required|numeric|min_length[1]',
            array(
                'required'      => 'Interes es un valor obligatorio.',
                'numeric'       => 'Interes solo debe contener Numeros.'
            )
		);
		
		$this->form_validation->set_rules('tasa', 'Tasa','required|numeric|min_length[1]',
            array(
                'required'      => 'Tasa es un valor obligatorio.',
                'numeric'       => 'Tasa solo debe contener Numeros.'
            )
        );

        if ($this->form_validation->run())
		{      
		    if( $this->Investments->edit($id,$this->input->post()) ){
                $this->session->set_flashdata('msg', ' Plazo Fijo se ha Editado');                
                redirect('investment');
            }
		}
		else
		{
            $this->load->view('layout/header');
            $data['action'] = "investment/edit/".$id;  
            $data['invesment_data'] = $this->Investments->getById($id);            
            $this->load->view('investment/form',$data);    
            $data['scripts'][]='js_library/investment/add.js';            
            $this->load->view('layout/footer',$data);
        }
    }

    public function delete($id)
	{	
		if($this->Investments->delete($id)){
			$this->session->set_flashdata('msg', '<b>Inversión  Eliminada</b>');		
		}else{
			$this->session->set_flashdata('msg', 'No se pudo Eliminar a esta Inversión');		
		}
		redirect('investment');
    }
    
    public function imputar($id){
        return false;
    }


    /*public function earnings(){

    }*/

    public function add_earnings(){
		$this->form_validation->set_rules('date_imputation', 'Fecha de Imputación ','required',
            array(
                'required'      => 'Fecha de Imputación es obligatorio.',
            )
		);
		
        $this->form_validation->set_rules('import', 'Importe','required|numeric|min_length[1]',
            array(
                'required'      => 'Importe es un valor obligatorio.',
                'numeric'       => 'Importe solo debe contener Numeros.'
            )
		);

        if ($this->form_validation->run())
		{      			
			
           
           
            if( $this->Investments->add_earnings() ){
                $this->session->set_flashdata('msg2', 'Nuevo Plazo Fijo se ha creado');                
                redirect('investment');
            }
		}
		else
		{
            $this->load->view('layout/header');
            $data['action'] = "investment/add_earnings";            
            $data['earning_data'] = null;           
            //$data['adherents'] = array();
            $this->load->view('investment/form_earnings',$data);    
            $data['scripts'][]='js_library/investment/add.js';            
            $this->load->view('layout/footer',$data);
        }
    }

    public function edit_earnings($id){

        $this->form_validation->set_rules('date_imputation', 'Fecha de Imputación ','required',
            array(
                'required'      => 'Fecha de Imputación es obligatorio.',
            )
		);
		
        $this->form_validation->set_rules('import', 'Importe','required|numeric|min_length[1]',
            array(
                'required'      => 'Importe es un valor obligatorio.',
                'numeric'       => 'Importe solo debe contener Numeros.'
            )
		);

        if ($this->form_validation->run())
		{      
		    if( $this->Investments->update_earnings($id,$this->input->post()) ){
                $this->session->set_flashdata('msg2', ' Ganancia se ha Editado');                
                redirect('investment');
            }
		}
		else
		{
            $this->load->view('layout/header');
            $data['action'] = "investment/edit_earnings/".$id;  
            $data['earning_data'] = $this->Investments->getEarningById($id);            
            $this->load->view('investment/form_earnings',$data);    
            $data['scripts'][]='js_library/investment/add.js';            
            $this->load->view('layout/footer',$data);
        }
    }


    public function delete_earnings($id)
	{	
		if($this->Investments->delete_earnings($id)){
			$this->session->set_flashdata('msg2', '<b>Ganancia  Eliminada</b>');		
		}else{
			$this->session->set_flashdata('msg2', 'No se pudo Eliminar a esta Ganancia');		
		}
		redirect('investment');
    }

}
