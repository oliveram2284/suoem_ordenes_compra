<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Aportes extends CI_Model {

    public function __construct(){
        
        $this->create_tables();        
        
    }

    public function create_tables(){
        $this->load->dbforge();
    
        //$this->dbforge->create_table('users', TRUE);
        $this->dbforge->add_field('id');
        $this->dbforge->add_field(array(
            'adherent_nro' => array(
                'type' => 'INT',
                'constraint' => 11,
                'DEFAULT' =>NULL
            ),
            
            'monto' => array(
                'type' => 'DECIMAL',
                'constraint' => '15,4',
                'DEFAULT' =>0
            ),
            'cuotas' => array(
                'type' => 'INT',
                'constraint' => '5',
                'DEFAULT' =>0
            ),
            'monto_abonado' => array(
                'type' => 'DECIMAL',
                'constraint' => '15,4',
                'DEFAULT' =>0
            ),
            'cuotas_pagas' => array(
                'type' => 'INT',
                'constraint' => '5',
                'DEFAULT' =>0
            ),
            'observation' => array(
                'type' => 'TEXT',
                'DEFAULT' =>''
            ),
            'date_added' => array(
                'type' => 'DATETIME',
            ),
            'date_cancelation' => array(
                'type' => 'DATETIME',
                'DEFAULT' =>NULL
            ),
            'status' => array(
                'type' => 'INT',
                'constraint' => 2,
                'DEFAULT' =>1
            ),
        ));

        $this->dbforge->create_table('aportes',true);

        if (!$this->db->field_exists('monto_contado', 'aportes')){
            $fields = array(
                'monto_contado'   => array('type' => 'DECIMAL','constraint' => '15,2', 'AFTER' => 'monto_abonado', 'DEFAULT' =>0),
            );
            $this->dbforge->add_column('aportes', $fields);            
        }


        $this->dbforge->add_field('id');
        $this->dbforge->add_field(array(
            'aporte_id' => array(
                'type' => 'INT',
                'constraint' =>11,
                'DEFAULT' =>NULL
            ),
            'monto' => array(
                'type' => 'DECIMAL',
                'constraint' => '15,4',
                'DEFAULT' =>0
            ),
            'date_added' => array(
                'type' => 'DATETIME',
            ),
        ));
        $this->dbforge->create_table('aporte_cuotas',true);
    }

    public function totals(){
        
        //$this->db->where('status !=',2);
        $query = $this->db->get('aportes');
        
		return $query->num_rows();
    }

    public function getTotalFiltered($data = null){
       
		$response = array();
		$this->db->select('a.*,CONCAT(ad.lastname," ",ad.firstname) as fullname');//' a.* , m.name as muni_code,DATE_FORMAT(a.date_added, "%d-%m-%Y") as added,DATE_FORMAT(a.date_activation, "%d-%m-%Y") as actived');
        $this->db->from('aportes as a');
        $this->db->join('adherents as ad','a.adherent_nro=ad.nro');
        
        switch($data['order'][0]['column']){
            case 0:{
                $this->db->order_by('a.adherent_nro',$data['order'][0]['dir']);                
                break;
            }
            case 1:{
                $this->db->order_by('m.firstname',$data['order'][0]['dir']);               
                $this->db->order_by('m.lastname',$data['order'][0]['dir']);               
                break;
               
            }
            case 2:{
                $this->db->order_by('a.monto_abonado',$data['order'][0]['dir']);            
                break;
            }
            case 3:{
                $this->db->order_by('a.cuotas_pagas',$data['order'][0]['dir']);            
                break;
            }
            case 4:{
                $this->db->order_by('a.date_added',$data['order'][0]['dir']);               
                break;
            }
            case 4:{
                $this->db->order_by('a.date_cancelation',$data['order'][0]['dir']);               
                break;
            }
            default:{
                $this->db->order_by('a.adherent_nro',$data['order'][0]['dir']);
            }
        }

		if($data['search']['value']!=''){
            $this->db->or_where('ad.nro',$data['search']['value']);	
            $this->db->or_where('a.monto',$data['search']['value']);	
            $this->db->or_where('a.cuotas',$data['search']['value']);	
            $this->db->or_where('a.cuotas_pagas',$data['search']['value']);	
            $this->db->or_where('a.monto_abonado',$data['search']['value']);	
            $this->db->or_where('a.status',$data['search']['value']);	
			$this->db->or_like('ad.firstname ',$data['search']['value']);	
			$this->db->or_like('ad.lastname ',$data['search']['value']);
            $this->db->or_like('DATE_FORMAT(a.date_added, "%d-%m-%Y %H:%i")',$data['search']['value']);
            $this->db->or_like('DATE_FORMAT(a.date_added, "%d-%m-%Y %H:%i")',$data['search']['value']);

			$this->db->limit($data['length'],$data['start']);
		}		
        $query = $this->db->get();
        
		return $query->num_rows();
    }
    
    public function getFiltered( $data = null){

		$this->db->select('a.*,ad.firstname,ad.lastname, CONCAT(ad.lastname," ",ad.firstname) as fullname, DATE_FORMAT(a.date_added, "%d-%m-%Y") as added, DATE_FORMAT(a.date_cancelation, "%d-%m-%Y") as canceled');//' a.* , m.name as muni_code,DATE_FORMAT(a.date_added, "%d-%m-%Y") as added,DATE_FORMAT(a.date_cancelation, "%d-%m-%Y") as canceled');
        $this->db->from('aportes as a');
        $this->db->join('adherents as ad','a.adherent_nro=ad.nro');

        //var_dump($data['order']);
        switch($data['order'][0]['column']){
            case 0:{
                $this->db->order_by('a.adherent_nro',$data['order'][0]['dir'], 'des');                
                break;
            }
            case 1:{
                $this->db->order_by('m.firstname',$data['order'][0]['dir']);               
                $this->db->order_by('m.lastname',$data['order'][0]['dir']);               
                break;
               
            }
            case 2:{
                $this->db->order_by('a.monto_abonado',$data['order'][0]['dir']);            
                break;
            }
            case 3:{
                $this->db->order_by('a.cuotas_pagas',$data['order'][0]['dir']);            
                break;
            }
            case 4:{
                $this->db->order_by('a.date_added',$data['order'][0]['dir']);               
                break;
            }
            case 4:{
                $this->db->order_by('a.date_cancelation',$data['order'][0]['dir']);               
                break;
            }
            default:{
                $this->db->order_by('a.adherent_nro',$data['order'][0]['dir'], 'des');
            }
        }

        
        //$this->db->where('a.status!= ',2);	
		if($data['search']['value']!=''){
            $this->db->or_where('ad.nro',$data['search']['value']);	
            $this->db->or_where('a.monto',$data['search']['value']);	
            $this->db->or_where('a.cuotas',$data['search']['value']);	
            $this->db->or_where('a.cuotas_pagas',$data['search']['value']);	
            $this->db->or_where('a.monto_abonado',$data['search']['value']);	
            $this->db->or_where('a.status',$data['search']['value']);	
			$this->db->or_like('ad.firstname ',$data['search']['value']);	
			$this->db->or_like('ad.lastname ',$data['search']['value']);
            $this->db->or_like('DATE_FORMAT(a.date_added, "%d-%m-%Y %H:%i")',$data['search']['value']);
            $this->db->or_like('DATE_FORMAT(a.date_added, "%d-%m-%Y %H:%i")',$data['search']['value']);

        }
        $this->db->where('ad.status!=2');
		$this->db->limit($data['length'],$data['start']);
        $query = $this->db->get();        
        //echo $this->db->last_query();
		return $query->result_array();
	}

    public function getMunicipalidad(){
        $this->db->select('id,code,name');
        $this->db->order_by('id','asc');
        $query = $this->db->get('municipality');	
		return $query->result_array();
    }

    public function getNext(){
        $this->db->select('(nro+1) as next_nro');
        $this->db->order_by('nro','desc');
        $this->db->limit('1');
        $query = $this->db->get('adherents');	        
        return ($query->num_rows()!=0)? $query->row_array()['next_nro']:1;
    }

    public function getById($id=null,$detail=false){
        if(!$id){
            return false;
        }
        $this->db->select("ap.*, CONCAT(ad.firstname,' ',ad.lastname) as fullname,ad.legajo as legajo, (cuotas_pagas + 1) as cuota_sig, DATE_FORMAT(date_cancelation, '%d/%m/%Y') as fecha_cancelacion");
        $this->db->from('adherents ad');
        $this->db->join('aportes as ap','ap.adherent_nro=ad.nro');
        $this->db->where('ap.id',$id);
        $query = $this->db->get();

        $result = $query->row_array();

        if($detail){            
            $this->db->select('id,monto,DATE_FORMAT(date_added, "%d-%m-%Y") as fecha');
            $this->db->where('aporte_id',$id);
            $query=$this->db->get('aporte_cuotas');
            $result['aporte_cuotas'] = $query->result_array();
        }
        
       
        return $result;
    }
    function add($data=null){
        if($this->input->post()==null && $data==null){
            return false;
        }
        $params=$this->input->post();
        //unset($params['nro']);
        $params['adherent_nro'] = $params['adherent_name'];
        $params['monto_abonado'] = 0;
        $params['cuotas_pagas'] = 0;
        $params['date_added'] = date('Y-m-d H:i:s');
        $params['status']     = 0;
        //var_dump($params);
        unset($params['nro']);
        unset($params['adherent_name']);
        if($this->db->insert('aportes',$params)){
            return $this->db->insert_id();
        }else{
            return false;
        }

    }
    function update($id , $params = false)
    {       
        if($params){
            return $this->db->update('adherents', $params, array('id' => $id));
        }else{
            return false;
        }
    }

    public function delete($id=false){
        return $this->db->update('adherents',array('status'=>2),array('id' => $id));
        
    }


    public function addPago($data=null){
        if($this->input->post()==null && $data==null){
            return false;
        }
        $params=$this->input->post();
        $params['date_added'] = date('Y-m-d H:i:s');

        if($this->db->insert('aporte_cuotas',$params)){

            $cuota= $this->db->insert_id();
            $query = $this->db->get_where('aportes',array('id'=>$params['aporte_id']));

            if($query->num_rows()){

                $aporte =$query->row_array();
                $aporte['monto_abonado']= floatval($aporte['monto_abonado'])+$params['monto'];
                $aporte['cuotas_pagas']= (int)$aporte['cuotas_pagas']+ 1;

                if($aporte['monto_abonado']==floatval($aporte['monto'])){
                    $aporte['cuotas']=$aporte['cuotas_pagas'];
                }

                if((int)$aporte['cuotas_pagas']==(int)$aporte['cuotas']){
                    $aporte['date_cancelation'] = $params['date_added'];
                }
                $aporte['status']= ($aporte['status']==0)? 1:$aporte['status'];
                unset($aporte['id']);
                $this->db->update('aportes',$aporte,array('id' =>$params['aporte_id']));     

            }              
            return $cuota;
        }else{
            return false;
        }
    }

    public function balance($data=null){
        $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $result=array();     
        
        $this->db->select("ap.id, CONCAT(ad.firstname,' ',ad.lastname) as fullname,ap.adherent_nro");
        $this->db->from('adherents ad');
        $this->db->join('aportes as ap','ap.adherent_nro=ad.nro');
        $this->db->where('ad.status!=2');
        $query=$this->db->get();

        $aportes=$query->result_array();
        foreach( $aportes as $key=>$item){            

            $this->db->select('id,YEAR(date_added),MONTH(date_added), monto,DATE_FORMAT(date_added, "%m-%Y") as fecha');
            $cuotas_query=$this->db->where('aporte_id',$item['id'])->get('aporte_cuotas');
            //echo $this->db->last_query()."<br>";
            log_message('info', $this->db->last_query());
            if($cuotas_query->num_rows()){
                $aportes[$key]['cuotas']=$cuotas_query->result_array();
            }else{
                $aportes[$key]['cuotas']=null;
            }
            
        }
        
        $result['aportes']=$aportes;
        $query= $this->db->select('date_added,DATE_FORMAT(date_added, "%m-%Y") as fecha')
        ->group_by('YEAR(date_added),MONTH(date_added)')
        ->order_by('date_added', 'asc')
        ->get('aporte_cuotas');    
        $months=$query->result_array();

        $result['months']=$months;

        foreach($query->result_array() as $item){
            /*
            $this->db->select('sum(monto) mensual');
            $this->db->where("YEAR(date_added) = YEAR('".$item['date_added']."')");
            $this->db->where("MONTH(date_added) = MONTH('".$item['date_added']."')");
            $this->db->order_by('date_added','asc');*/
            $sql="SELECT  SUM(apc.monto) mensual 
            FROM aporte_cuotas AS apc 
            INNER JOIN aportes AS ap ON apc.aporte_id=ap.id 
            INNER JOIN adherents ad ON ap.adherent_nro=ad.nro 
            WHERE YEAR(apc.date_added) = YEAR('".$item['date_added']."') AND MONTH(apc.date_added) = MONTH('".$item['date_added']."') AND ad.`status`!=2 ;";
            //$totales_query = $this->db->get('aporte_cuotas');   
            $totales_query = $this->db->query($sql);   
            //echo $this->db->last_query();echo "<br>";   
            log_message('info', $this->db->last_query());       
            $result['totales'][$item['fecha']]=$totales_query->row_array()['mensual'];
        }
       /*echo $this->db->last_query();
       die();*/
       //die();
        return $result;
    }

   


    public function renew(){
        $this->db->trans_off();
        $this->db->trans_start(TRUE);
        $this->db->trans_strict(TRUE);
        $query=$this->db->where("adherent_nro",$this->input->post('adherent_nro'))->get('aportes');
        $aporte= $query->row_array();
        
        $temp=$aporte;
        $aporte_id=$temp['id'];

        $temp['cuotas']=(int)$aporte['cuotas']+(int)$this->input->post('nro_cuotas');
        $temp['monto']=floatval($aporte['monto'])+( floatval($this->input->post('monto_cuota') )*(int)$this->input->post('nro_cuotas') );
        $temp['monto_abonado']=$temp['monto'];
        $temp['cuotas_pagas']=$temp['cuotas'];
        $temp['date_cancelation']=$aporte['date_cancelation'];

        for($i=0;$i<(int)$this->input->post('nro_cuotas');$i++){     
            $date_temp=strtotime($this->input->post('date_renew'));                
            $date_added = date("Y-m-d", strtotime("+".$i." month", $date_temp));   
            $cuotas_data=array(
                'aporte_id'=>$aporte_id,
                'monto'=>floatval($this->input->post('monto_cuota') ),
                'date_added'=>$date_added
            );
            
            $this->db->insert('aporte_cuotas',$cuotas_data); 
            //echo $this->db->last_query()."<br>"; 
            $temp['date_cancelation']  =$date_added;        
        }

        
        $this->db->update('aportes',$temp,array('id' => $aporte_id));
        //echo $this->db->last_query()."<br>"; 
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE){
            return json_encode( array('result'=>false,'error'=>'insert: '.$this->db->last_query().''));
        }
       
        return json_encode( array('result'=>true,'error'=>null));
        
    }

}

