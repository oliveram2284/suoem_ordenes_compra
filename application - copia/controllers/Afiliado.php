<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Afiliado extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model('Afiliados');
        $this->load->model('Municipios');
        //$this->Users->updateSession(true);
        if(!$this->auth->is_logged()){
			redirect('login', 'refresh');
		}
    }
	public function index()
	{   

        //$this->Afiliados->checkActivation();

		$this->load->view('layout/header');
        $this->load->view('afiliado/index');      
        $data['scripts'][]='js_library/afiliado/index.js';
		$this->load->view('layout/footer',$data);
    }
    
    public function datatable_list(){
       
        $recordsTotal= $this->Afiliados->getTotalFiltered($_REQUEST);
        $data= $this->Afiliados->getFiltered($_REQUEST);
       
		$response=array(
			'draw' => $_REQUEST['draw'],
			'recordsTotal' => $recordsTotal,
			'recordsFiltered' => $recordsTotal,
			'data' => $data
		);

		echo json_encode($response);
    }

    public function add(){

        $this->form_validation->set_rules('firstname', 'Nombre',
            'required|min_length[3]',
            array(
                'required'      => 'Nombre es obligatorio.'
            )
        );
        $this->form_validation->set_rules('lastname', 'Apellido',
            'required|min_length[3]',
            array(
                'required'      => 'Apellido es obligatorio.'
            )
        );
        $this->form_validation->set_rules('legajo', 'Legajo',
            'required|min_length[2]',
            array(
                'required'      => 'Legajo es obligatorio.'
            )
        );
        $this->form_validation->set_rules('dni', 'DNI',
            'required|numeric|min_length[6]',
            array(
                'required'      => 'DNI es obligatorio.'
            )
        );
                

        $this->form_validation->set_rules('municipio_id', 'Municipio',
            'required',
            array(
                'required'      => 'Municipio es obligatorio.'
            )
        );
        if ($this->form_validation->run())
		{      

            
            if( $this->Afiliados->add() ){
                $this->session->set_flashdata('msg', 'Nuevo Afiliado Agregado');                
                redirect('afiliado');
            }
		}
		else
		{
            $this->load->view('layout/header');
            $data['action'] = "afiliado/add";
            $data['municipios'] = $this->Municipios->getMunicipalidad();
            //$data['item']=$this->Afiliados->getNext();

            $data['afiliado'] = null;
            $this->load->view('afiliado/form',$data);    
            
            $data['scripts'][]='js_library/afiliado/add.js';
            $this->load->view('layout/footer',$data);
        }
    }

    public function edit($id){
        
        $this->form_validation->set_rules('firstname', 'Nombre',
            'required|min_length[3]',
            array(
                'required'      => 'Nombre es obligatorio.'
            )
        );
        $this->form_validation->set_rules('lastname', 'Apellido',
            'required|min_length[3]',
            array(
                'required'      => 'Apellido es obligatorio.'
            )
        );
        $this->form_validation->set_rules('legajo', 'Legajo',
            'required|min_length[2]',
            array(
                'required'      => 'Legajo es obligatorio.'
            )
        );
        $this->form_validation->set_rules('dni', 'DNI',
            'required|numeric|min_length[6]',
            array(
                'required'      => 'DNI es obligatorio.'
            )
        );

        $this->form_validation->set_rules('municipio_id', 'Municipio',
            'required',
            array(
                'required'      => 'Municipio es obligatorio.'
            )
        );
        if ($this->form_validation->run())
		{      
            if( $this->Afiliados->update($id,$this->input->post()) ){
                $this->session->set_flashdata('msg', 'Afiliado Actualizado');                
                redirect('afiliado');
            }
		}
		else
		{
            $this->load->view('layout/header');
            $data['action'] = current_url();
            $data['municipios'] = $this->Municipios->getMunicipalidad();
            //$data['item']=$this->Afiliados->getNext();
            $afiliado =$this->Afiliados->getById($id);
           // die("asd");
            //var_dump($afiliado);
            $data['afiliado']=$afiliado;
            $this->load->view('afiliado/form',$data);    
            $data['scripts'][]='js_library/afiliado/add.js';
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
        //var_dump($data['upload_data']);
        if ($this->upload->do_upload('import_file') )
        {

            $data = array('upload_data' => $this->upload->data());
            $result_import= $this->excelci->import($data['upload_data']['full_path']);
            $message ="<p> Total de Filas Procesadas ".$result_import['total_rows']."<br>"  ; 
            $message.="<p> Afiliados Nuevos ".$result_import['inserted']."<br>"  ; 
            $message.="<p> Afiliados Actualizados ".$result_import['updated']."<br>"  ; 
            $this->session->set_flashdata('msg', $message);
            

        }else{
            $error = array('error' => $this->upload->display_errors());
            //var_dump($error);
           // $this->session->set_flashdata('msg', $error['error']);            
        }

        $this->load->view('layout/header');
        $data['action'] = "afiliado/import";
        $this->load->view('afiliado/import',$data);   
           
        $data['scripts'][]=array();
		$this->load->view('layout/footer',$data);
        

    }
    */
    public function delete($id)
	{	
		if($this->Afiliados->delete($id)){
			$this->session->set_flashdata('msg', '<b>Afiliado Eliminado</b>');		
		}else{
			$this->session->set_flashdata('msg', 'No se pudo Eliminar a este Afiliado');		
		}
		redirect('afiliado');
    }
    
    public function search($key=null,$id=null){
        switch($key){
            case 'nro':{
                $afiliado =$this->Adherents->getById($id);
                echo json_encode(array('status'=>'true','afiliado'=>$afiliado));
                break;
            }
            case 'name':{
                $afiliado =$this->Adherents->getByName($id);
                echo json_encode(array('status'=>'true','results'=>$afiliado));
                break;
            }
            default:{
                echo json_encode(array('status'=>'false','afiliado'=>array()));
                break;
            }
        }       
        
    }

/*
    public function info($id)
    {   

        //this->Adherents->checkActivation();
        $info['data'] = $this->Adherents->getInfo($id);

        $this->load->view('layout/header');
        $this->load->view('afiliado/info', $info);      
        $data['scripts'][]=null;
        $this->load->view('layout/footer',$data);
    }

    public function imprimirinfo(){
        //echo json_encode('1.pdf');
        $data = $this->input->post();
        $info = array();
        $info['data'] = $this->Adherents->getInfo($data['id']);
        $html = $this->load->view('afiliado/infoPrint', $info, true);

        //var_dump($html);

        echo json_encode($this->Adherents->imprimirInfo($data, $html));
    }



    public function imprimirContrato($adherent_id=0){
        if($adherent_id==0){
            return false;
        }
        $data = $this->input->post();
        $info = array();
        $data = $this->Adherents->getById($adherent_id);
        $data_muni = $this->Adherents->getInfo($adherent_id);
       
       
        $adherente_name=$data['firstname']." ".$data['lastname'];
        $data_line1=str_pad($adherente_name, (64-strlen($adherente_name)), "_");
        $adherente_dni="_".$data['dni']."_";
        $data_line2_1=str_pad($adherente_dni, (20-strlen($adherente_dni)), "_");
        $adherente_estado=($data['municipality_code']!='15')?  "ACTIVO":"JUBILADO" ;
        $data_line2_2=str_pad($adherente_estado, (20-strlen($adherente_estado)), "_");        
        $adherente_legajo=$data['legajo'];
        $data_line2_3=str_pad($adherente_legajo, (20-strlen($adherente_legajo)), "_");
        $adherente_muni=$data_muni['adherente']['name'];
        $data_line3=str_pad($adherente_muni, (64-strlen($adherente_muni)), "_");
        $adherente_direc=$data_muni['adherente']['address'];
        $data_line4=str_pad($adherente_direc, (40-strlen($adherente_direc)), "_");
        $adherente_telefono=$data_muni['adherente']['phone'];
        $data_line4_1=str_pad($adherente_telefono, (10-strlen($adherente_telefono)), "_");
        $adherente_email=$data_muni['adherente']['email'];
        $data_line5=str_pad($adherente_email, (70-strlen($adherente_email)), "_");


        //var_dump(strlen('______________'));
        //echo $html;
        $params=array(
            'adherent_id'=>$data['nro'],
            'adherente_name'=>$adherente_name,
            'data_line1'=>$data_line1,
            'data_line2_1'=>$data_line2_1,
            'data_line2_2'=>$data_line2_2,
            'data_line2_3'=>$data_line2_3,
            'data_line3'=>$data_line3,
            'data_line4'=>$data_line4,
            'data_line4_1'=>$data_line4_1,
            'data_line5'=>$data_line5,
        );
        $html = $this->load->view('afiliado/contrato', $params, true);
        //die($html);
        //return true;
        echo json_encode($this->Afiliados->print_contrato($params, $html));
    }
    */
}
