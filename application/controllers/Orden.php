<?php
defined('BASEPATH') OR exit('No direct script access allowed');



class Orden extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model('Ordenes');
        //$this->load->model('Adherents');
        if(!$this->auth->is_logged()){
			redirect('login', 'refresh');
		}
    }

    public function index(){

        $this->load->view('layout/header');
        $data['action'] = "ordenes/add"; 
        $this->load->view('ordenes/index',$data);   

        $data['scripts'][]='js_library/ordenes/index.js';
		$this->load->view('layout/footer',$data);
    }

    public function datatable_list(){
       
        $recordsTotal=$this->Asistencias->getTotalFiltered($_REQUEST);
        $data= $this->Asistencias->getFiltered($_REQUEST);
        
		$response=array(
			'draw' => $_REQUEST['draw'],
			'recordsTotal' => $recordsTotal,
			'recordsFiltered' => $recordsTotal,
			'data' => $data
		);

		echo json_encode($response);
	}


    function add(){
        //if ($this->form_validation->run())
        $this->form_validation->set_rules('adherent_nro', 'Nro Adherente','required|numeric',
            array(
                'required'      => 'Nro Adherente es obligatorio.',
                'numeric'       => 'El Nro Adherente No puede.',
            )
        );
        $this->form_validation->set_rules('monto', 'Monto','required|numeric|min_length[1]',
            array(
                'required'      => 'Monto es obligatorio.',
                'numeric'       => 'Monto No puede contener Letras.',
                'min_length'    => 'Monto debe ser mayor a 1.',
            )
        );
        $this->form_validation->set_rules('interes', 'Importe Compensacion','required|min_length[1]',
            array(
                'required'      => 'Importe Compensacion es obligatorio.',
                //'numeric'       => 'Importe Compensacion No puede contener Letras.',
                'min_length'    => 'Importe Compensacion debe ser mayor a 1.',
            )
        );
        $this->form_validation->set_rules('cuotas', 'Cantidad de Cuotas ','required|numeric|min_length[1]',
            array(
                'required'      => 'Cantidad de Cuotas es obligatorio.',
                'numeric'       => 'Cantidad de Cuotas No puede contener Letras.',
                'min_length'    => 'Cantidad de Cuotas debe ser mayor a 1.',
            )
        );
        $this->form_validation->set_rules('monto_total_cuota', 'Monto de Cuotas','required|numeric|min_length[1]',
            array(
                'required'      => 'Monto de Cuotas es obligatorio.',
                'numeric'       => 'Monto de Cuotas No puede contener Letras.',
                'min_length'    => 'Monto de Cuotas debe ser mayor a 1.',
            )
        );
        $this->form_validation->set_rules('monto_total', 'Monto Total','required|numeric|min_length[1]',
            array(
                'required'      => 'Monto Total es obligatorio.',
                'numeric'       => 'Monto Total No puede contener Letras.',
                'min_length'    => 'Monto Total debe ser mayor a 1.',
            )
        );

        $this->form_validation->set_rules('date_added', 'Fecha','required',//|regex_match[(0[1-9]|1[0-9]|2[0-9]|3(0|1))-(0[1-9]|1[0-2])-\d{4}]',
            array(
                'required'      => 'Fecha es obligatorio.'
            )
        );
        $this->form_validation->set_rules('date_pago', 'Fecha P','required',//|regex_match[(0[1-9]|1[0-9]|2[0-9]|3(0|1))-(0[1-9]|1[0-2])-\d{4}]',
            array(
                'required'      => 'Fecha comienzo de pago es obligatorio.'
            )
        );

        

        if ($this->form_validation->run()){
            $id = $this->Asistencias->add($this->input->post());
            if( $id) {
               
                $this->session->set_flashdata('msg', 'Nueva Asistencia Financiera se ha creado <a href="'.base_url('Asistencia/imprimirAsistencia/'.$id).'" class="bt-add btn btn-dark float-lg-right mr-1 mb-2">
                        <i class="icon-Add-File"></i>Imprimir
                    </a>');                
                redirect('asistencia');
            }

		}else{

            $this->load->view('layout/header');
            $data['action'] = "orden/add"; 
            //$data['adherents'] = array();
            $this->load->view('ordenes/form',$data);    
            $data['scripts'][]='js_library/ordenes/add.js';
            $data['scripts'][]='Typeahead/bootstrap3-typeahead.js';       
            $this->load->view('layout/footer',$data);

        }
    }

    function edit($id){
        //if ($this->form_validation->run())
        $this->form_validation->set_rules('monto', 'Monto','required|numeric|min_length[1]',
            array(
                'required'      => 'Monto es obligatorio.',
                'numeric'       => 'Monto No puede contener Letras.',
                'min_length'    => 'Monto debe ser mayor a 1.',
            )
        );
        $this->form_validation->set_rules('interes', 'Importe Compensacion','required|min_length[1]',
            array(
                'required'      => 'Importe Compensacion es obligatorio.',
                //'numeric'       => 'Importe Compensacion No puede contener Letras.',
                'min_length'    => 'Importe Compensacion debe ser mayor a 1.',
            )
        );
        $this->form_validation->set_rules('cuotas', 'Cantidad de Cuotas ','required|numeric|min_length[1]',
            array(
                'required'      => 'Cantidad de Cuotas es obligatorio.',
                'numeric'       => 'Cantidad de Cuotas No puede contener Letras.',
                'min_length'    => 'Cantidad de Cuotas debe ser mayor a 1.',
            )
        );
        $this->form_validation->set_rules('monto_total_cuota', 'Monto de Cuotas','required|numeric|min_length[1]',
            array(
                'required'      => 'Monto de Cuotas es obligatorio.',
                'numeric'       => 'Monto de Cuotas No puede contener Letras.',
                'min_length'    => 'Monto de Cuotas debe ser mayor a 1.',
            )
        );
        $this->form_validation->set_rules('monto_total', 'Monto Total','required|numeric|min_length[1]',
            array(
                'required'      => 'Monto Total es obligatorio.',
                'numeric'       => 'Monto Total No puede contener Letras.',
                'min_length'    => 'Monto Total debe ser mayor a 1.',
            )
        );

        $this->form_validation->set_rules('date_added', 'Fecha','required',//|regex_match[(0[1-9]|1[0-9]|2[0-9]|3(0|1))-(0[1-9]|1[0-2])-\d{4}]',
            array(
                'required'      => 'Fecha es obligatorio.'
            )
        );

        $this->form_validation->set_rules('date_pago', 'Fecha P','required',//|regex_match[(0[1-9]|1[0-9]|2[0-9]|3(0|1))-(0[1-9]|1[0-2])-\d{4}]',
            array(
                'required'      => 'Fecha comienzo de pago es obligatorio.'
            )
        );

        

        if ($this->form_validation->run()){

            if( $this->Asistencias->edit($this->input->post()) ){
               
                $this->session->set_flashdata('msg', 'Asistencia Financiera N° '.$id.' se ha editado correctamente');                
                redirect('asistencia');
            }

        }else{

            $this->load->view('layout/header');
            $data['action'] = "asistencia/edit/".$id; 
            $data['asistencie'] = $this->getArray($id);
            $this->load->view('asistencia/formedit',$data);    
            $data['scripts'][]='js_library/asistencia/edit.js';
            $data['scripts'][]='Typeahead/bootstrap3-typeahead.js';       
            $this->load->view('layout/footer',$data);

        }
    }
    public function get($id,$detail=false){
        $result=$this->Asistencias->getById($id,$detail);
        echo json_encode(array('result'=>$result));
    }

    public function delete($id,$log=null){	

        
		if($this->Asistencias->delete($id,$log)){
            echo json_encode(array('result'=>true, 'msg'=>'<b>Asistencia Eliminada</b>'));	
            //return true;
		}else{	
            echo json_encode(array('result'=>false, 'msg'=>'<b>No se pudo Eliminar a este Asistencia</b>'));
            //return false;	
		}
		//redirect('asistencia');
    }

    public function getArray($id,$detail=false){
        $result=$this->Asistencias->getById($id,$detail);
        return $result;
    }

    public function reporte_asistencias(){
        $this->load->view('layout/header');
        $data=array();
        $data['table']=$this->Asistencias->balance();
        $this->load->view('aporte/reports',$data);   

        $data['scripts'][]='js_library/aporte/reports.js';
		$this->load->view('layout/footer',$data);
    }


    public function imprimirAsistencia($id){
        $data = $this->input->post();
        $info = array();
        $asistencia = $this->Asistencias->getById($id, null);
        $data = $this->Adherents->getById($asistencia['adherente']['id']);
        $data_muni = $this->Adherents->getInfo($asistencia['adherente']['id']);
       

        $adherente_name=$data['firstname']."_".$data['lastname'];
        $data_line1=str_pad($adherente_name, (64-strlen($adherente_name)), "_");
        $numero = $data['nro'];
        $adherente_dni="_".$data['dni']."_";
        $data_line2_1=str_pad($adherente_dni, (20-strlen($adherente_dni)), "_");      
        $adherente_legajo=$data['legajo'];
        $data_line2_3=str_pad($adherente_legajo, (20-strlen($adherente_legajo)), "_");
        $adherente_muni=$data_muni['adherente']['name'];
        $data_line3=str_pad($adherente_muni, (20-strlen($adherente_muni)), "_");

        $params=array(
            'data_line1'=>$data_line1,
            'data_line2_1'=>$data_line2_1,
            'data_line2_3'=>$data_line2_3,
            'data_line3'=>$data_line3,
            'numero' => $numero,
            'asistencia' => $asistencia['asistencia'],
            'nombre' => $data['firstname']." ".$data['lastname']
        );
        $html = $this->load->view('adherent/contratoasistencia', $params, true);
        //die($html);
        echo json_encode($this->Asistencias->print_contrato_asistencia($params, $html));
    }

}