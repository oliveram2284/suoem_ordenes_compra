<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adherent extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model('Adherents');
        //$this->Users->updateSession(true);
        if(!$this->auth->is_logged()){
			redirect('login', 'refresh');
		}
    }
	public function index()
	{   

        $this->Adherents->checkActivation();

		$this->load->view('layout/header');
        $this->load->view('adherent/index');      
        $data['scripts'][]='js_library/adherent/index.js';
		$this->load->view('layout/footer',$data);
    }
    
    public function datatable_list(){
       
        $recordsTotal= $this->Adherents->getTotalFiltered($_REQUEST);
        $data= $this->Adherents->getFiltered($_REQUEST);
       
		$response=array(
			'draw' => $_REQUEST['draw'],
			'recordsTotal' => $recordsTotal,
			'recordsFiltered' => $recordsTotal,
			'data' => $data
		);

		echo json_encode($response);
    }

    public function add(){

        $this->form_validation->set_rules('nro', 'Nro Adherente','required|numeric|min_length[1]|max_length[12]|is_unique[adherents.nro]'
            /*'required|is_unique[adherents.nro]'*/,
            array(
                'required'      => 'Nro Adherente es obligatorio.',
                'numeric'       => 'El Nro Adherente No puede.',
                'is_unique'     => 'El Nro Adherente ya existe.'
            )
        );
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
        

        $this->form_validation->set_rules('monto_aporte_inicial', 'Monto Aporte Incial',
            'required|numeric|min_length[1]',
            array(
                'required'   => 'Monto Aporte Incial es obligatorio.'
            )
        );

        $this->form_validation->set_rules('nro_cuotas', 'Nro Cuotas',
            'required|numeric|min_length[1]',
            array(
                'required'      => 'Nro Cuotas es obligatorio.'
            )
        );

        $this->form_validation->set_rules('monto_cuota', 'Monto por Cuota',
            'required|numeric|min_length[3]',
            array(
                'required'      => 'Monto por Cuota es obligatorio.'
            )
        );
        
        $this->form_validation->set_rules('date_activation', 'Fecha de Activación',
            'required',
            array(
                'required'      => 'Fecha de Activación es obligatorio.'
            )
        );

        $this->form_validation->set_rules('municipality_code', 'Procedencia',
            'required',
            array(
                'required'      => 'Procedencia es obligatorio.'
            )
        );
        if ($this->form_validation->run())
		{      

            
            if( $this->Adherents->add() ){
                $this->session->set_flashdata('msg', 'Nuevo Adherente Agregado');                
                redirect('adherent');
            }
		}
		else
		{
            $this->load->view('layout/header');
            $data['action'] = "adherent/add";
            $data['municipios'] = $this->Adherents->getMunicipalidad();
            $data['item']=$this->Adherents->getNext();

            $data['adherent'] = null;
            $this->load->view('adherent/form',$data);    
            
            $data['scripts'][]='js_library/adherent/add.js';
            $this->load->view('layout/footer',$data);
        }
    }

    public function edit($id){
        
        $this->form_validation->set_rules('nro', 'Nro Adherente','required|numeric|min_length[1]|max_length[12]'
            /*'required|is_unique[adherents.nro]'*/,
            array(
                'required'      => 'Nro Adherente es obligatorio.',
                'numeric'       => 'El Nro Adherente No puede.',                
            )
        );
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

        $this->form_validation->set_rules('municipality_code', 'Procedencia',
            'required',
            array(
                'required'      => 'Procedencia es obligatorio.'
            )
        );
        if ($this->form_validation->run())
		{      
            if( $this->Adherents->update($id,$this->input->post()) ){
                $this->session->set_flashdata('msg', 'Adherente Actualizado');                
                redirect('adherent');
            }
		}
		else
		{
            $this->load->view('layout/header');
            $data['action'] = current_url();
            $data['municipios'] = $this->Adherents->getMunicipalidad();
            $data['item']=$this->Adherents->getNext();
            $adherent =$this->Adherents->getById($id);
           // die("asd");
            //var_dump($adherent);
            $data['adherent']=$adherent;
            $this->load->view('adherent/form',$data);    
            $data['scripts'][]='js_library/adherent/add.js';
            $this->load->view('layout/footer',$data);
        }
    }

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
            $message.="<p> Adherentes Nuevos ".$result_import['inserted']."<br>"  ; 
            $message.="<p> Adherentes Actualizados ".$result_import['updated']."<br>"  ; 
            $this->session->set_flashdata('msg', $message);
            

        }else{
            $error = array('error' => $this->upload->display_errors());
            //var_dump($error);
           // $this->session->set_flashdata('msg', $error['error']);            
        }

        $this->load->view('layout/header');
        $data['action'] = "adherent/import";
        $this->load->view('adherent/import',$data);   
           
        $data['scripts'][]=array();
		$this->load->view('layout/footer',$data);
        

    }

    public function delete($id)
	{	
		if($this->Adherents->delete($id)){
			$this->session->set_flashdata('msg', '<b>Adherente Eliminado</b>');		
		}else{
			$this->session->set_flashdata('msg', 'No se pudo Eliminar a este Adherente');		
		}
		redirect('adherent');
    }
    
    public function search($key=null,$id=null){
        switch($key){
            case 'nro':{
                $adherent =$this->Adherents->getById($id);
                echo json_encode(array('status'=>'true','adherent'=>$adherent));
                break;
            }
            case 'name':{
                $adherent =$this->Adherents->getByName($id);
                echo json_encode(array('status'=>'true','results'=>$adherent));
                break;
            }
            default:{
                echo json_encode(array('status'=>'false','adherent'=>array()));
                break;
            }
        }       
        
    }


    public function info($id)
    {   

        //this->Adherents->checkActivation();
        $info['data'] = $this->Adherents->getInfo($id);

        $this->load->view('layout/header');
        $this->load->view('adherent/info', $info);      
        $data['scripts'][]=null;
        $this->load->view('layout/footer',$data);
    }

    public function imprimirinfo(){
        //echo json_encode('1.pdf');
        $data = $this->input->post();
        $info = array();
        $info['data'] = $this->Adherents->getInfo($data['id']);
        $html = $this->load->view('adherent/infoPrint', $info, true);

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
        $html = $this->load->view('adherent/contrato', $params, true);
        //die($html);
        //return true;
        echo json_encode($this->Adherents->print_contrato($params, $html));
    }
}
