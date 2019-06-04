<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Aporte extends CI_Controller {

    function __construct(){
		parent::__construct();
		$this->load->model('Aportes');
		$this->load->model('Settings');

		if(!$this->auth->is_logged()){
			redirect('login', 'refresh');
		}
    }
	public function index()
	{
		
        $this->load->view('layout/header');
        $data['action'] = "aporte/pay_feed"; 
        $this->load->view('aporte/index',$data);   

        $data['scripts'][]='js_library/aporte/index.js';
		$this->load->view('layout/footer',$data);
	}


	public function datatable_list(){
       
        $recordsTotal=$this->Aportes->getTotalFiltered($_REQUEST);
        $data= $this->Aportes->getFiltered($_REQUEST);
        
		$response=array(
			'draw' => $_REQUEST['draw'],
			'recordsTotal' => $recordsTotal,
			'recordsFiltered' => $recordsTotal,
			'data' => $data
		);

		echo json_encode($response);
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
        if ($this->upload->do_upload('import_file') )
        {

            $data = array('upload_data' => $this->upload->data());
			$result_import= $this->excelci->import_aportes($data['upload_data']['full_path']);
			unlink( $data['upload_data']['full_path']);
			
            $message ="<p> Total de Filas Procesadas ".($result_import['aportes_totales']*$result_import['totals_feeds'])."<br>"  ; 
            $message.="<p> Aportes Iniciales Agregados ".$result_import['aportes_totales']."<br>"  ; 
            $message.="<p> Cuotas Aportes Iniciales Agregados ".$result_import['totals_feeds']."<br>"  ; 
            $this->session->set_flashdata('msg', $message);
            

        }else{
            $error = array('error' => $this->upload->display_errors());
            //var_dump($error);
           // $this->session->set_flashdata('msg', $error['error']);            
        }

        $this->load->view('layout/header');
        $data['action'] = "aporte/import";
        $this->load->view('aporte/import',$data);   
           
        $data['scripts'][]=array();
		$this->load->view('layout/footer',$data);
        

    }

    public function get($id,$detail=false){
        $aporte=$this->Aportes->getById($id,$detail);
        echo json_encode(array('result'=>$aporte));
    }

    public function add(){

        $this->form_validation->set_rules('nro', 'Nro Adherente','required|numeric|min_length[1]|max_length[12]|is_unique[aportes.adherent_nro]',
            array(
                'required'      => 'Nro Adherente es obligatorio.',
                'numeric'       => 'El Nro Adherente No puede.',
                'is_unique'     => 'El Nro Adherente Ya Realizo Su Alta de Aporte Inicial.'
            )
        );
        $this->form_validation->set_rules('monto', 'Nro Adherente','required|numeric|min_length[1]|max_length[12]',
            array(
                'required'      => 'Monto es un valor obligatorio.',
                'numeric'       => 'Monto solo debe contener Numeros.'
            )
        );
        $this->form_validation->set_rules('cuotas', 'Cuotas','required|numeric|min_length[1]',
            array(
                'required'      => 'Cuotas es un valor obligatorio.',
                'numeric'       => 'Cuotas solo debe contener Numeros.'
            )
        );

        if ($this->form_validation->run())
		{      
            if( $this->Aportes->add() ){
                $this->session->set_flashdata('msg', 'Nuevo Aporte se ha creado');                
                redirect('aporte');
            }
		}
		else
		{
            $this->load->view('layout/header');
            $data['action'] = "aporte/add";            

            //$data['adherents'] = array();
            $this->load->view('aporte/form',$data);    
            $data['scripts'][]='js_library/aporte/add.js';
            $data['scripts'][]='Typeahead/bootstrap3-typeahead.js';       
            $this->load->view('layout/footer',$data);
        }

    }

    public function pay_feed(){
        if( $this->Aportes->addPago() ){
            $this->session->set_flashdata('msg', 'Cuota de Aporte Incial Fue Registrado Con exito');                
            redirect('aporte');
        }
    }

    public function renew(){
        echo $this->Aportes->renew();
    }
    public function reports($type=null)
	{
		
        $this->load->view('layout/header');
        $data=array();
        $data['table']=$this->Aportes->balance();
        //$data['action'] = "aporte/pay_feed"; 
        $this->load->view('aporte/reports',$data);   
        $data['scripts'][]='lib/data-tables/dataTables.buttons.min.js';
        $data['scripts'][]='lib/data-tables/buttons.flash.min.js';
        $data['scripts'][]='lib/data-tables/jszip.min.js';        
        $data['scripts'][]='lib/data-tables/pdfmake.min.js';
        $data['scripts'][]='lib/data-tables/vfs_fonts.js';
        $data['scripts'][]='lib/data-tables/buttons.html5.min.js';
        $data['scripts'][]='lib/data-tables/buttons.print.min.js';
        $data['scripts'][]='js_library/aporte/reports.js';
        
		$this->load->view('layout/footer',$data);
    }
    
    public function grafico(){
        $this->load->view('layout/header');
        $data=array();
        $data['table']=array();//$this->Aportes->balance();
        //$data['action'] = "aporte/pay_feed"; 
        $this->load->view('aporte/grafico',$data);   

        $data['scripts'][]='aporte/reports.js';
       
        //$data['scripts'][]='aporte/reports.js';
        
		$this->load->view('layout/footer',$data);
    }



}
