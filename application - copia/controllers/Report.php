<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('Reports');
    }
	public function assistance($desde = null, $hasta = null)
	{
        $info = array();
        if(!isset($desde)){
            $actual = strtotime(date("Y-m-d",time()));
            $desde = date("Y-m-d", strtotime("-12 month", $actual));
        }
        if(!isset($hasta)){
            $actual = strtotime(date("Y-m-d",time()));
            $hasta = date("Y-m-d", strtotime("+0 month", $actual));
        }
        $info['desde'] = $desde;
        $info['hasta'] = $hasta;
        $info['data'] = $this->Reports->Assistence($desde, $hasta);
		$this->load->view('layout/header');
        $this->load->view('report/assistence', $info);      
        
        $data['scripts'][]='lib/data-tables/dataTables.buttons.min.js';
        $data['scripts'][]='lib/data-tables/buttons.flash.min.js';
        $data['scripts'][]='lib/data-tables/jszip.min.js';        
        $data['scripts'][]='lib/data-tables/pdfmake.min.js';
        $data['scripts'][]='lib/data-tables/vfs_fonts.js';
        $data['scripts'][]='lib/data-tables/buttons.html5.min.js';
        $data['scripts'][]='lib/data-tables/buttons.print.min.js';
        $data['scripts'][]='js_library/report/assistence.js';
		$this->load->view('layout/footer',$data);
    }

    public function devolution($desde = null, $hasta = null)
    {
        $info = array();
        if(!isset($desde)){
            $actual = strtotime(date("Y-m-d",time()));
            $desde = date("Y-m-d", strtotime("-12 month", $actual));
        }
        if(!isset($hasta)){
            $actual = strtotime(date("Y-m-d",time()));
            $hasta = date("Y-m-d", strtotime("+0 month", $actual));
        }
        $info = array();
        $info['desde'] = $desde;
        $info['hasta'] = $hasta;
        $info['data'] = $this->Reports->Devolution($desde, $hasta);
        $this->load->view('layout/header');
        $this->load->view('report/devolution', $info);  
        $data['scripts'][]='lib/data-tables/dataTables.buttons.min.js';
        $data['scripts'][]='lib/data-tables/buttons.flash.min.js';
        $data['scripts'][]='lib/data-tables/jszip.min.js';        
        $data['scripts'][]='lib/data-tables/pdfmake.min.js';
        $data['scripts'][]='lib/data-tables/vfs_fonts.js';
        $data['scripts'][]='lib/data-tables/buttons.html5.min.js';
        $data['scripts'][]='lib/data-tables/buttons.print.min.js';
        $data['scripts'][]='js_library/report/devolution.js';    
        
        $this->load->view('layout/footer',$data);
    }
    
    public function compensation($desde = null, $hasta = null)
    {
        $info = array();
        if(!isset($desde)){
            $actual = strtotime(date("Y-m-d",time()));
            $desde = date("Y-m-d", strtotime("-12 month", $actual));
        }
        if(!isset($hasta)){
            $actual = strtotime(date("Y-m-d",time()));
            $hasta = date("Y-m-d", strtotime("+0 month", $actual));
        }
        $info['desde'] = $desde;
        $info['hasta'] = $hasta;
        $info['data'] = $this->Reports->Compensation($desde, $hasta);
        $this->load->view('layout/header');
        $this->load->view('report/compensation', $info); 
        
        $data['scripts'][]='lib/data-tables/dataTables.buttons.min.js';
        $data['scripts'][]='lib/data-tables/buttons.flash.min.js';
        $data['scripts'][]='lib/data-tables/jszip.min.js';        
        $data['scripts'][]='lib/data-tables/pdfmake.min.js';
        $data['scripts'][]='lib/data-tables/vfs_fonts.js';
        $data['scripts'][]='lib/data-tables/buttons.html5.min.js';
        $data['scripts'][]='lib/data-tables/buttons.print.min.js';
        $data['scripts'][]='js_library/report/compensation.js';  
        $this->load->view('layout/footer',$data);
    }

    public function balances(){
        $info = array();
        $info['balance'] = $this->Reports->Balances();       
        $this->load->view('layout/header');
        $this->load->view('report/balance', $info);    
        
        $data['scripts'][]='lib/data-tables/dataTables.buttons.min.js';
        $data['scripts'][]='lib/data-tables/buttons.flash.min.js';
        $data['scripts'][]='lib/data-tables/jszip.min.js';        
        $data['scripts'][]='lib/data-tables/pdfmake.min.js';
        $data['scripts'][]='lib/data-tables/vfs_fonts.js';
        $data['scripts'][]='lib/data-tables/buttons.html5.min.js';
        $data['scripts'][]='lib/data-tables/buttons.print.min.js';
        $data['scripts'][]='js_library/report/compensation.js';  
        $this->load->view('layout/footer',$data);
    }
}
