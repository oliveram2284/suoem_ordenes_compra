<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Vencimientos extends CI_Model {

    public function __construct(){        
    }

    public function totals(){
        
        $this->db->where('status !=',2);
        $query = $this->db->get('asistencias');
        
		return $query->num_rows();
    }

    public function getTotalFiltered($data = null){
       
		$response = array();
		$this->db->select("a.id");
        $this->db->from('adherents as a');
        $this->db->join('asistencias as m ','a.nro=m.adherent_nro');
        $this->db->join('asistencias_cuotas as c ','m.id=c.asistencia_id');
        
		$this->db->where('c.status = 0 and DATE_FORMAT(c.date_added,\'%m-%Y\') <= DATE_FORMAT(now(),\'%m-%Y\') and DATE_FORMAT(c.date_added,\'%Y\') <= DATE_FORMAT(now(),\'%Y\')');	
		if($data['search']['value']!=''){
            $this->db->or_where('a.nro ',$data['search']['value']);	
			$this->db->or_like('a.firstname ',$data['search']['value']);	
			$this->db->or_like('a.lastname ',$data['search']['value']);
			$this->db->or_like('a.legajo ',$data['search']['value']);
			$this->db->or_like('a.dni ',$data['search']['value']);
            $this->db->or_like('DATE_FORMAT(c.date_added, "%d-%m-%Y %H:%i")',$data['search']['value']);

			//$this->db->limit($data['length'],$data['start']);
		}		
        $query = $this->db->get();
        
		return $query->num_rows();
    }
    
    public function getFiltered( $data = null){

       
        $this->db->select("CONCAT(a.lastname,' ',a.firstname) as fullname, c.id, m.id as asistencia, DATE_FORMAT(c.date_added, '%d-%m-%Y')as fecha, c.total, case when c.date_added < now() then 1 else 0 end as vencida");
        $this->db->from('adherents as a');
        $this->db->join('asistencias as m ','a.nro=m.adherent_nro');
        $this->db->join('asistencias_cuotas as c ','m.id=c.asistencia_id');

        //var_dump($data['order']);
        
        switch($data['order'][0]['column']){
            case 0:{
                $this->db->order_by('c.id',$data['order'][0]['dir']);                
                break;
            }
            case 1:{
                $this->db->order_by('a.lastname',$data['order'][0]['dir']);                
                $this->db->order_by('a.firstname',$data['order'][0]['dir']);                
                break;
            }
            case 2:{
                $this->db->order_by('m.id',$data['order'][0]['dir']);               
                break;
            }
            case 3:{
                $this->db->order_by('c.total',$data['order'][0]['dir']);               
                break;
            }
            case 4:{
                $this->db->order_by('fecha',$data['order'][0]['dir']);               
                break;
            }
            case 5:{
                $this->db->order_by('vencida',$data['order'][0]['dir']);               
                break;
            }
            default:{
                $this->db->order_by('fecha',$data['order'][0]['dir']);
            }
        }
        $this->db->where('c.status = 0 and DATE_FORMAT(c.date_added,\'%m-%Y\') <= DATE_FORMAT(now(),\'%m-%Y\') and DATE_FORMAT(c.date_added,\'%Y\') <= DATE_FORMAT(now(),\'%Y\')'); 
		if($data['search']['value']!=''){
            $this->db->or_where('a.nro ',$data['search']['value']); 
            $this->db->or_like('a.firstname ',$data['search']['value']);    
            $this->db->or_like('a.lastname ',$data['search']['value']);
            $this->db->or_like('a.legajo ',$data['search']['value']);
            $this->db->or_like('a.dni ',$data['search']['value']);
            $this->db->or_like('DATE_FORMAT(c.date_added, "%d-%m-%Y %H:%i")',$data['search']['value']);
        }
		$this->db->limit($data['length'],$data['start']);
        $query = $this->db->get();
        //die($this->db->last_query());
		return $query->result_array();
	}


    public function setById($id){
        return $this->db->update('asistencias_cuotas',array('status'=>1, 'user_id' => $this->session->userdata['id']),array('id' => $id));   //, 
    }
}