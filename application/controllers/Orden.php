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
       
        $recordsTotal=$this->Ordenes->getTotalFiltered($_REQUEST);
        $data= $this->Ordenes->getFiltered($_REQUEST);
        
		$response=array(
			'draw' => $_REQUEST['draw'],
			'recordsTotal' => $recordsTotal,
			'recordsFiltered' => $recordsTotal,
			'data' => $data
		);

		echo json_encode($response);
	}


    function add(){
       
        $this->form_validation->set_rules('monto', 'Monto','required|numeric|min_length[1]',
            array(
                'required'      => 'Monto es obligatorio.',
                'numeric'       => 'Monto No puede contener Letras.',
                'min_length'    => 'Monto debe ser mayor a 1.',
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
                

        if ($this->form_validation->run()){
         
            $id = $this->Ordenes->add($this->input->post());           
            if( $id) {               
                $this->session->set_flashdata('msg', 'Nueva Orden de Compra se ha creado');                
                redirect('orden');
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
        

        if ($this->form_validation->run()){
            if( $this->Ordenes->edit($id,$this->input->post()) ){               
                $this->session->set_flashdata('msg', 'Orden N° '.$this->input->post('nro').' se ha editado correctamente');                
                redirect('orden');
            }

        }else{

            $this->load->view('layout/header');
            $data['action'] = "orden/edit/".$id; 
            $data['data'] = $this->Ordenes->getById($id);
            $this->load->view('ordenes/form_edit',$data);    
            $data['scripts'][]='js_library/ordenes/edit.js';
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

    public function buscarOrden(){
        echo json_encode($this->Ordenes->buscarOrden($this->input->post()));
    }

}