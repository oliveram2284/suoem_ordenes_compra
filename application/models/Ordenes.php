<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ordenes extends CI_Model {

    public function __construct(){
        
        $this->create_tables();       
        
    }

    public function create_tables(){

        $this->load->dbforge();    
        //$this->dbforge->create_table('users', TRUE);
        $this->dbforge->add_field('id');
        $this->dbforge->add_field(array(

            'nro' => array(
                'type' => 'INT',
                'constraint' => 11,
                'DEFAULT' =>0
            ),   
            'afiliado_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'DEFAULT' =>0
            ),  
            'comercio_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'DEFAULT' =>0
            ),           
            'monto' => array(  /// Monto SOlicitado
                'type' => 'DECIMAL',
                'constraint' => '15,4',
                'DEFAULT' =>0
            ),
            'cuotas' => array( //Nro de Cuotas a pagar
                'type' => 'INT',
                'constraint' => '5',
                'DEFAULT' =>0
            ),
            'interes' => array( // Interes o Tasa mensual
                'type' => 'DECIMAL',
                'constraint' => '15,4',
                'DEFAULT' =>0
            ),
            'porcentual' => array( // nro constante por el que se calcula valor a total a devolver:  1 + ( interes * cuotas) 
                'type' => 'DECIMAL',
                'constraint' => '15,4',
                'DEFAULT' =>0
            ),
            'monto_compensacion' => array(// Monto total - monto 
                'type' => 'DECIMAL',
                'constraint' => '15,4',
                'DEFAULT' =>0
            ),
            'monto_total' => array(// Monto total a devolver: monto * porcentual
                'type' => 'DECIMAL',
                'constraint' => '15,4',
                'DEFAULT' =>0
            ),
            'monto_parcial_cuota' => array( // Monto / cuotas: Monto cuota sin interes
                'type' => 'DECIMAL',
                'constraint' => '15,4',
                'DEFAULT' =>0
            ),
            'monto_total_cuota' => array( // Monto_total / cuotas:  Importe cuota con interes
                'type' => 'DECIMAL',
                'constraint' => '15,4',
                'DEFAULT' =>0
            ),   
            'compensacion_cuota' => array( // monto_total_cuota -  monto_parcial_cuota:  Diferencia entre monto cuota con interes y monto cuota sin interes
                'type' => 'DECIMAL',
                'constraint' => '15,4',
                'DEFAULT' =>0
            ),    
            'fecha_liquidacion' => array(
                'type' => 'DATETIME',
                'null' => true,
            ),                 
            'estado' => array(
                'type' => 'INT',
                'constraint' => '1',
                'DEFAULT' =>1
            ),
            'user_id' => array(
                'type' => 'INT',
                'constraint' => '4',
                'DEFAULT' =>0
            ),
                
            'date_added' => array(
                'type' => 'TIMESTAMP',
                
            ),
            'visto' => array(
                'type' => 'INT',
                'constraint' => '1',
                'DEFAULT' =>0
            ), 
            'fecha_visto' => array(
                'type' => 'DATETIME',
                'null' => true,
            ),      
        ));        
        $this->dbforge->create_table('ordenes',true);
        /*
        $this->dbforge->add_field('id');
        $this->dbforge->add_field(array(
            'asistencia_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'DEFAULT' =>0
            ),            
            'monto' => array(   //500
                'type' => 'DECIMAL',
                'constraint' => '15,4',
                'DEFAULT' =>0
            ),
            'compensacion' => array(  //100
                'type' => 'DECIMAL',
                'constraint' => '15,4',
                'DEFAULT' =>0
            ),
            'total' => array(  //600
                'type' => 'DECIMAL',
                'constraint' => '15,4',
                'DEFAULT' =>0
            ),    
            'status' => array(
                'type' => 'INT',
                'constraint' => '1',
                'DEFAULT' =>0
            ),
            'date_aded' => array(
                'type' => 'DATE',
            ),
        ));        
        $this->dbforge->create_table('asistencias_cuotas',true);     

        if (!$this->db->field_exists('date_pay', 'asistencias_cuotas')){
            $this->dbforge->add_field("COLUMN date_pay timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP AFTER date_added");
            $fields = array(
                'user_id'  => array('type' => 'int','DEFAULT' =>NULL)
            );
            $this->dbforge->add_column('asistencias_cuotas', $fields); 
        }

        */

        
        $this->dbforge->add_field('id');
        $this->dbforge->add_field(array(
            'orden_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'DEFAULT' =>0
            ),   
            'user_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'DEFAULT' =>0
            ),            
            'descripcion' => array(   //500
                'type' => 'TEXT',
                'DEFAULT' =>null
            ),
            
            'status' => array(
                'type' => 'INT',
                'constraint' => '1',
                'DEFAULT' =>0
            ),
            'date_added' => array(
                'type' => 'DATETIME',
            ),
        ));        
        $this->dbforge->create_table('orden_logs',true);     


        
        
        
    }
    public function totals(){
        
        $this->db->where('status !=',2);
        $query = $this->db->get('asistencias');
        
		return $query->num_rows();
    }

    public function getTotalFiltered($data = null){
       
		$response = array();
		$this->db->select("*,CONCAT(a.lastname,' ',a.firstname) as afiliado_nombre,c.nombre as comercio_nombre");
        $this->db->from('ordenes as o');
        $this->db->join('afiliados as a ','o.afiliado_id=a.id');
        $this->db->join('comercios as c ','o.comercio_id=c.id');
        
		//$this->db->where('m.status!= ',2);	
		if($data['search']['value']!=''){
            $this->db->or_where('o.nro ',$data['search']['value']);	
			$this->db->or_like('a.firstname ',$data['search']['value']);	
			$this->db->or_like('a.lastname ',$data['search']['value']);
            //$this->db->or_like('DATE_FORMAT(a.date_added, "%d-%m-%Y %H:%i")',$data['search']['value']);

			//$this->db->limit($data['length'],$data['start']);
		}		
        $query = $this->db->get();
        
		return $query->num_rows();
    }
    
    public function getFiltered( $data = null){

       
        //$this->db->select("CONCAT(a.lastname,' ',a.firstname) as fullname, a.id as adherent_id,m.*, DATE_FORMAT(m.date_added, '%d-%m-%Y')as fecha, (select count(*) from asistencias_cuotas as ac where ac.asistencia_id = m.id and ac.status = 1) as pagas");
        $this->db->select("*,CONCAT(a.lastname,' ',a.firstname) as afiliado_nombre,c.nombre as comercio_nombre,DATE_FORMAT(o.fecha_liquidacion, '%d-%m-%Y')as fecha_liquidacion, DATE_FORMAT(o.date_added, '%d-%m-%Y')as fecha");
        $this->db->from('ordenes as o');
        $this->db->join('afiliados as a ','o.afiliado_id=a.id');
        $this->db->join('comercios as c ','o.comercio_id=c.id');

        //var_dump($data['order']);
        
        switch($data['order'][0]['column']){
            case 0:{
                $this->db->order_by('o.id',$data['order'][0]['dir']);                
                break;
            }
            case 1:{
                $this->db->order_by('a.lastname',$data['order'][0]['dir']);                
                $this->db->order_by('a.firstname',$data['order'][0]['dir']);                
                break;
            }
            case 2:{
                $this->db->order_by('o.monto',$data['order'][0]['dir']);               
                break;
            }
            case 3:{
                $this->db->order_by('o.interes',$data['order'][0]['dir']);               
                break;
            }
            case 4:{
                $this->db->order_by('o.monto_total',$data['order'][0]['dir']);               
                break;
            }
            case 5:{
                $this->db->order_by('o.cuotas',$data['order'][0]['dir']);               
                break;
            }
            case 6:{
                $this->db->order_by('o.monto_parcial_cuota',$data['order'][0]['dir']);               
                break;
            }
            case 7:{
                $this->db->order_by('fecha',$data['order'][0]['dir']);               
                break;
            }
            default:{
                $this->db->order_by('m.id',$data['order'][0]['dir']);
            }
        }
       
		if($data['search']['value']!=''){
            $this->db->or_where('o.nro ',$data['search']['value']);	
			$this->db->or_like('a.firstname ',$data['search']['value']);	
			$this->db->or_like('a.lastname ',$data['search']['value']);			
            //$this->db->or_like('DATE_FORMAT(m.date_added, "%d-%m-%Y %H:%i")',$data['search']['value']);

        }
        $this->db->where('o.estado!= ',2);	    
		$this->db->limit($data['length'],$data['start']);
        $query = $this->db->get();
        //die($this->db->last_query());
		return $query->result_array();
	}

    /* Por comercio */
    public function getTotalByComercioFiltered($data = null){
       
		$response = array();
		$this->db->select("*,CONCAT(a.lastname,' ',a.firstname) as afiliado_nombre");
        $this->db->from('ordenes as o');
        $this->db->join('afiliados as a ','o.afiliado_id=a.id');
        $this->db->join('comercios as c ','o.comercio_id=c.id');
        
		//$this->db->where('m.status!= ',2);	
		if($data['search']['value']!=''){
            $this->db->or_where('o.nro ',$data['search']['value']);	
			$this->db->or_like('a.firstname ',$data['search']['value']);	
			$this->db->or_like('a.lastname ',$data['search']['value']);
            //$this->db->or_like('DATE_FORMAT(a.date_added, "%d-%m-%Y %H:%i")',$data['search']['value']);

			//$this->db->limit($data['length'],$data['start']);
        }	
        $this->db->where(array('o.estado!= '=>2, 'o.comercio_id' => $this->session->get_userdata('comercio_id')['comercio_id']));	    	
        $query = $this->db->get();
        
		return $query->num_rows();
    }

    public function getByComercioFiltered( $data = null){
        $this->db->select("*,CONCAT(a.lastname,' ',a.firstname) as afiliado_nombre,DATE_FORMAT(o.fecha_liquidacion, '%d-%m-%Y')as fecha_liquidacion, DATE_FORMAT(o.date_added, '%d-%m-%Y')as fecha, DATE_FORMAT(o.fecha_visto, '%d-%m-%Y %H:%i')as fecha_visto, o.visto");
        $this->db->from('ordenes as o');
        $this->db->join('afiliados as a ','o.afiliado_id=a.id');
        $this->db->join('comercios as c ','o.comercio_id=c.id');

        //var_dump($data['order']);
        
        switch($data['order'][0]['column']){
            case 0:{
                $this->db->order_by('o.id',$data['order'][0]['dir']);                
                break;
            }
            case 1:{
                $this->db->order_by('a.lastname',$data['order'][0]['dir']);                
                $this->db->order_by('a.firstname',$data['order'][0]['dir']);                
                break;
            }
            case 2:{
                $this->db->order_by('o.monto',$data['order'][0]['dir']);               
                break;
            }
            case 3:{
                $this->db->order_by('o.interes',$data['order'][0]['dir']);               
                break;
            }
            case 4:{
                $this->db->order_by('o.monto_total',$data['order'][0]['dir']);               
                break;
            }
            case 5:{
                $this->db->order_by('o.cuotas',$data['order'][0]['dir']);               
                break;
            }
            case 6:{
                $this->db->order_by('o.monto_parcial_cuota',$data['order'][0]['dir']);               
                break;
            }
            case 7:{
                $this->db->order_by('fecha',$data['order'][0]['dir']);               
                break;
            }
            default:{
                $this->db->order_by('m.id',$data['order'][0]['dir']);
            }
        }
       
		if($data['search']['value']!=''){
            $this->db->or_where('o.nro ',$data['search']['value']);	
			$this->db->or_like('a.firstname ',$data['search']['value']);	
			$this->db->or_like('a.lastname ',$data['search']['value']);			
            //$this->db->or_like('DATE_FORMAT(m.date_added, "%d-%m-%Y %H:%i")',$data['search']['value']);

        }
        $this->db->where(array('o.estado!= '=>2, 'o.comercio_id' => $this->session->get_userdata('comercio_id')['comercio_id']));	    
		$this->db->limit($data['length'],$data['start']);
        $query = $this->db->get();
        //die($this->db->last_query());
		return $query->result_array();
	}

    public function add($data){
        
        if(empty($data)){
            return false;
        }
        if(!isset($this->session->userdata['id'])){
            return false;
        }
       
        $this->db->trans_off();
        $this->db->trans_start(false);
        $this->db->trans_strict(FALSE);
        //$data['interes']= str_replace(',', '.', $data['interes']);
        
        $params['nro']=$data['nro'];
        $params['afiliado_id']=$data['afiliado_id'];
        $params['comercio_id']=$data['comercio_id'];
        $params['interes']=0;//$data['interes'];
        $params['porcentual']=0;//1+( floatval($data['interes']) * (int)$data['cuotas'] );
        $params['monto']=floatval($data['monto']);
        $params['cuotas']=(int)$data['cuotas'];
        $params['monto_total']=floatval($data['monto_total_cuota']);
        $params['monto_compensacion']=floatval($data['monto_total_cuota']) - floatval($data['monto']);
        $params['monto_parcial_cuota']=$params['monto'] / (int)$data['cuotas'];
        $params['monto_total_cuota']=floatval($data['monto_total_cuota']);
        $params['compensacion_cuota']=$params['monto_compensacion'] / (int)$data['cuotas'];
        $params['estado'] = 1;
        $params['user_id'] =$this->session->userdata['id'];
        $params['fecha_liquidacion'] = $data['fecha_liquidacion'];
        $params['date_added'] = date('Y-m-d');        
        $this->db->insert('ordenes',$params);
        $orden_id=$this->db->insert_id(); 
        
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            log_message('error', 'Error INSERT ORDEN.');
            // generate an error... or use the log_message() function to log your error
        } 
        return $orden_id;
        /*
        if($this->db->insert('ordenes',$params)){

            $asistencia_id=$this->db->insert_id(); 
            
            $cuota_data=array();
            $cuota_data['asistencia_id']=$asistencia_id;
            $cuota_data['monto']=$params['monto_parcial_cuota'];
            $cuota_data['compensacion']=$params['compensacion_cuota'];
            $cuota_data['total']=$params['monto_total_cuota'];
            $cuota_data['status']=0;
            $cuotas_bash=array();
            for($i=0; $i < (int)$params['cuotas'];$i++){  

                $date_temp=$date_temp=strtotime($data['date_pago']);               
                $date_added = date("Y-m-d", strtotime("+".$i." month", $date_temp));                
                $cuota_data['date_added']=$date_added;
                $cuotas_bash[]=$cuota_data;        

            }
            //var_dump($cuotas_bash);
            if($this->db->insert_batch('asistencias_cuotas',$cuotas_bash)){

                $this->db->trans_complete();
                //die();
                return $asistencia_id;
            }

            /**if ($this->db->trans_status() === FALSE){
                    // generate an error... or use the log_message() function to log your error
            } 
            
    }*/
      
    }

    public function edit($order_id,$data){
        
        if(empty($data)){
            return false;
        }

        
        
        // $this->db->trans_off();
        $this->db->trans_start(false);
        $this->db->trans_strict(FALSE);
        $params['nro']=$data['nro'];        
        $params['monto']=floatval($data['monto']);
        $params['cuotas']=(int)$data['cuotas'];
        $params['monto_total']=floatval($data['monto_total_cuota']);
        $params['monto_compensacion']=floatval($data['monto_total_cuota']) - floatval($data['monto']);
        $params['monto_parcial_cuota']=$params['monto'] / (int)$data['cuotas'];
        $params['monto_total_cuota']=floatval($data['monto_total_cuota']);
        $params['compensacion_cuota']=$params['monto_compensacion'] / (int)$data['cuotas'];       
        //var_dump($params);
        $this->db->update('ordenes',$params, array('id'=>$order_id));
        
        return true;
        /*    
        if($this->db->update('ordenes',$params, array('id'=>$order_id))){

            $asistencia_id=$data['asistencia_id']; 
            
            if($this->db->delete('asistencias_cuotas',array('asistencia_id' => $asistencia_id )) == false){
                return false;
            }

            $cuota_data=array();
            $cuota_data['asistencia_id']=$asistencia_id;
            $cuota_data['monto']=$params['monto_parcial_cuota'];
            $cuota_data['compensacion']=$params['compensacion_cuota'];
            $cuota_data['total']=$params['monto_total_cuota'];
            $cuota_data['status']=0;
            $cuotas_bash=array();
            for($i=0; $i < (int)$params['cuotas'];$i++){  

                $date_temp=$date_temp=strtotime($data['date_pago']);               
                $date_added = date("Y-m-d", strtotime("+".$i." month", $date_temp));                
                $cuota_data['date_added']=$date_added;
                $cuotas_bash[]=$cuota_data;        

            }
            //var_dump($cuotas_bash);
            if($this->db->insert_batch('asistencias_cuotas',$cuotas_bash)){

                $this->db->trans_complete();
                //die();
                return $asistencia_id;
            }

            if ($this->db->trans_status() === FALSE){
                    // generate an error... or use the log_message() function to log your error
            }
            
        }*/
      
    }

    public function getById($id){
        $result=array();
        $query=$this->db->get_where('ordenes',array('id'=>$id));
        //echo $this->db->last_query();
        $result['orden']=$query->row_array();       
        $query=$this->db->get_where('afiliados',array('id'=>$result['orden']['afiliado_id']));        
        $result['afiliado']=$query->row_array();
        $query=$this->db->get_where('comercios',array('id'=>$result['orden']['comercio_id']));        
        $result['comercio']=$query->row_array();
       
        return $result;
    }

    public function balance(){
        $this->db->select("as.id, CONCAT(ad.firstname,' ',ad.lastname) as fullname,as.adherent_nro, as.monto,as.date_added");
        $this->db->from('adherents ad');
        $this->db->join('asistencias as as','as.adherent_nro=ad.nro');
        $query=$this->db->get();
        //echo $this->db->last_query();

        $query= $this->db->select('date_added,DATE_FORMAT(date_added, "%M-%Y") as fecha')
        ->group_by('YEAR(date_added),MONTH(date_added)')
        ->order_by('date_added', 'asc')
        ->get('asistencias_cuotas');  
        echo $this->db->last_query();  
        $months=$query->result_array();

        $result['months']=$months;
        


        die("fin");
    }


    public function delete($id=false,$log=null){


        if($this->db->update('ordenes',array('estado'=>2),array('id' => $id))){
            //$this->db->update('asistencias_cuotas',array('status'=>2),array('asistencia_id' => $id));
            $params=array(
                'orden_id'=>$id,
                'user_id'=>$this->session->userdata('id'),
                'descripcion'=>$log,
                'date_added'=>date('Y-m-d H:i:s'),
                'status'=>1
            );
            $this->db->insert('orden_logs',$params);
        }
        
       return true;
        
    }

    public function print_contrato_asistencia($data = null, $html){
        require_once("assets/plugin/HTMLtoPDF/dompdf/dompdf_config.inc.php");
        $dompdf = new DOMPDF();

      
        $dompdf->load_html(utf8_decode($html));
        //aumentamos memoria del servidor si es necesario
        ini_set("memory_limit","300M");
        //Tamaño de la página y orientación
        $dompdf->set_paper('a4','portrait');
        //lanzamos a render
        $dompdf->render();
        //guardamos a PDF
        $dompdf->stream("AsistenciaEconomica.pdf");
        //$dompdf->output();
        /*
        $output = $dompdf->output();
        file_put_contents('assets/reports/'.rand(1,10).'.pdf', $output);*/

        
    }

    public function buscarOrden($data = null){
        $nroOrden = $data['nro'];

        $this->db->select('o.id, o.nro, o.monto, DATE_FORMAT(o.date_added, "%d-%m-%Y") as date_added, DATE_FORMAT(o.fecha_liquidacion, "%d-%m-%Y") as fecha_liquidacion, a.firstname, a.lastname, a.legajo, m.nombre, m.code, c.razon_social, c.codigo, DATE_FORMAT(o.fecha_visto, "%d-%m-%Y %H:%i") as fecha_visto, u.firstname as userfn, u.lastname as userln');
        $this->db->from('ordenes as o');
        $this->db->where('nro',$nroOrden);
        $this->db->join('afiliados as a','a.id=o.afiliado_id');
        $this->db->join('municipios as m', 'm.id=a.municipio_id');
        $this->db->join('comercios as c', 'c.id=o.comercio_id');
        $this->db->join('users as u', 'u.id=o.user_id');
        $query=$this->db->get();
        
        if($query->num_rows() > 0){
            //Hay resultados
            $o = $query->result_array();
            if($o[0]['fecha_visto'] == null){
                $data = array(
                    'fecha_visto' => date('Y-m-d H:i:s'),
                    'visto' 	  => 1
                 );

                if($this->db->update('ordenes', $data, array('id'=>$o[0]['id'])) == false) {
                    return false;
                }
                $o[0]['fecha_visto'] = date('d-m-Y H:i');
            }
            return $o[0];
        }
        else{
            return false;
        }
    }
}