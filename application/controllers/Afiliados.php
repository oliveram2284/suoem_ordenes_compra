<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Afiliados extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model('Afiliadoss');
        //$this->Users->updateSession(true);
        if(!$this->auth->is_logged()){
			redirect('login', 'refresh');
		}
    }
	public function index()
	{   

        $this->Afiliadoss->checkActivation();

		$this->load->view('layout/header');
        $this->load->view('Afiliados/index');      
        $data['scripts'][]='js_library/Afiliados/index.js';
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

        $this->form_validation->set_rules('nro', 'Nro Afiliadose','required|numeric|min_length[1]|max_length[12]|is_unique[Afiliadoss.nro]'
            /*'required|is_unique[Afiliadoss.nro]'*/,
            array(
                'required'      => 'Nro Afiliadose es obligatorio.',
                'numeric'       => 'El Nro Afiliadose No puede.',
                'is_unique'     => 'El Nro Afiliadose ya existe.'
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

            
            if( $this->Afiliadoss->add() ){
                $this->session->set_flashdata('msg', 'Nuevo Afiliadose Agregado');                
                redirect('Afiliados');
            }
		}
		else
		{
            $this->load->view('layout/header');
            $data['action'] = "Afiliados/add";
            $data['municipios'] = $this->Afiliadoss->getMunicipalidad();
            $data['item']=$this->Afiliadoss->getNext();

            $data['Afiliados'] = null;
            $this->load->view('Afiliados/form',$data);    
            
            $data['scripts'][]='js_library/Afiliados/add.js';
            $this->load->view('layout/footer',$data);
        }
    }

    public function edit($id){
        
        $this->form_validation->set_rules('nro', 'Nro Afiliadose','required|numeric|min_length[1]|max_length[12]'
            /*'required|is_unique[Afiliadoss.nro]'*/,
            array(
                'required'      => 'Nro Afiliadose es obligatorio.',
                'numeric'       => 'El Nro Afiliadose No puede.',                
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
            if( $this->Afiliadoss->update($id,$this->input->post()) ){
                $this->session->set_flashdata('msg', 'Afiliadose Actualizado');                
                redirect('Afiliados');
            }
		}
		else
		{
            $this->load->view('layout/header');
            $data['action'] = current_url();
            $data['municipios'] = $this->Afiliadoss->getMunicipalidad();
            $data['item']=$this->Afiliadoss->getNext();
            $Afiliados =$this->Afiliadoss->getById($id);
           // die("asd");
            //var_dump($Afiliados);
            $data['Afiliados']=$Afiliados;
            $this->load->view('Afiliados/form',$data);    
            $data['scripts'][]='js_library/Afiliados/add.js';
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
            $message.="<p> Afiliadoses Nuevos ".$result_import['inserted']."<br>"  ; 
            $message.="<p> Afiliadoses Actualizados ".$result_import['updated']."<br>"  ; 
            $this->session->set_flashdata('msg', $message);
            

        }else{
            $error = array('error' => $this->upload->display_errors());
            //var_dump($error);
           // $this->session->set_flashdata('msg', $error['error']);            
        }

        $this->load->view('layout/header');
        $data['action'] = "Afiliados/import";
        $this->load->view('Afiliados/import',$data);   
           
        $data['scripts'][]=array();
		$this->load->view('layout/footer',$data);
        

    }

    public function delete($id)
	{	
		if($this->Afiliadoss->delete($id)){
			$this->session->set_flashdata('msg', '<b>Afiliadose Eliminado</b>');		
		}else{
			$this->session->set_flashdata('msg', 'No se pudo Eliminar a este Afiliadose');		
		}
		redirect('Afiliados');
    }
    
    public function search($key=null,$id=null){
        switch($key){
            case 'nro':{
                $Afiliados =$this->Afiliadoss->getById($id);
                echo json_encode(array('status'=>'true','Afiliados'=>$Afiliados));
                break;
            }
            case 'name':{
                $Afiliados =$this->Afiliadoss->getByName($id);
                echo json_encode(array('status'=>'true','results'=>$Afiliados));
                break;
            }
            default:{
                echo json_encode(array('status'=>'false','Afiliados'=>array()));
                break;
            }
        }       
        
    }


    public function info($id)
    {   

        //this->Afiliadoss->checkActivation();
        $info['data'] = $this->Afiliadoss->getInfo($id);

        $this->load->view('layout/header');
        $this->load->view('Afiliados/info', $info);      
        $data['scripts'][]=null;
        $this->load->view('layout/footer',$data);
    }

    public function imprimirinfo(){
        //echo json_encode('1.pdf');
        $data = $this->input->post();
        $info = array();
        $info['data'] = $this->Afiliadoss->getInfo($data['id']);
        $html = $this->load->view('Afiliados/infoPrint', $info, true);

        //var_dump($html);

        echo json_encode($this->Afiliadoss->imprimirInfo($data, $html));
    }



    public function imprimirContrato($Afiliados_id=0){
        if($Afiliados_id==0){
            return false;
        }
        $data = $this->input->post();
        $info = array();
        $data = $this->Afiliadoss->getById($Afiliados_id);
        $data_muni = $this->Afiliadoss->getInfo($Afiliados_id);
       
       
        $Afiliadose_name=$data['firstname']." ".$data['lastname'];
        $data_line1=str_pad($Afiliadose_name, (64-strlen($Afiliadose_name)), "_");
        $Afiliadose_dni="_".$data['dni']."_";
        $data_line2_1=str_pad($Afiliadose_dni, (20-strlen($Afiliadose_dni)), "_");
        $Afiliadose_estado=($data['municipality_code']!='15')?  "ACTIVO":"JUBILADO" ;
        $data_line2_2=str_pad($Afiliadose_estado, (20-strlen($Afiliadose_estado)), "_");        
        $Afiliadose_legajo=$data['legajo'];
        $data_line2_3=str_pad($Afiliadose_legajo, (20-strlen($Afiliadose_legajo)), "_");
        $Afiliadose_muni=$data_muni['Afiliadose']['name'];
        $data_line3=str_pad($Afiliadose_muni, (64-strlen($Afiliadose_muni)), "_");
        $Afiliadose_direc=$data_muni['Afiliadose']['address'];
        $data_line4=str_pad($Afiliadose_direc, (40-strlen($Afiliadose_direc)), "_");
        $Afiliadose_telefono=$data_muni['Afiliadose']['phone'];
        $data_line4_1=str_pad($Afiliadose_telefono, (10-strlen($Afiliadose_telefono)), "_");
        $Afiliadose_email=$data_muni['Afiliadose']['email'];
        $data_line5=str_pad($Afiliadose_email, (70-strlen($Afiliadose_email)), "_");


        //var_dump(strlen('______________'));
        //echo $html;
        $params=array(
            'Afiliados_id'=>$data['nro'],
            'Afiliadose_name'=>$Afiliadose_name,
            'data_line1'=>$data_line1,
            'data_line2_1'=>$data_line2_1,
            'data_line2_2'=>$data_line2_2,
            'data_line2_3'=>$data_line2_3,
            'data_line3'=>$data_line3,
            'data_line4'=>$data_line4,
            'data_line4_1'=>$data_line4_1,
            'data_line5'=>$data_line5,
        );
        $html = $this->load->view('Afiliados/contrato', $params, true);
        //die($html);
        //return true;
        echo json_encode($this->Afiliadoss->print_contrato($params, $html));
    }
}
