<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Investments extends CI_Model {

    public function __construct(){
        
        $this->create_tables();       
        
    }

    public function create_tables(){
        $this->load->dbforge();

        //$this->dbforge->create_table('users', TRUE);
        $this->dbforge->add_field('id');
        $this->dbforge->add_field(array(
            'fecha_emision' => array(
                'type' => 'DATE',
                'DEFAULT' =>NULL
            ),
            'import' => array(
                'type' => 'DECIMAL',
                'constraint' => '15,4',
                'DEFAULT' =>0
            ),
            'tasa' => array(
                'type' => 'DECIMAL',
                'constraint' => '15,4',
                'DEFAULT' =>0
            ),            
            'interes' => array(
                'type' => 'DECIMAL',
                'constraint' => '15,4',
                'DEFAULT' =>0
            ),

            'impuesto' => array(
                'type' => 'DECIMAL',
                'constraint' => '15,4',
                'DEFAULT' =>0
            ),

            'cobrar' => array(
                'type' => 'DECIMAL',
                'constraint' => '15,4',
                'DEFAULT' =>0
            ),
            'observation' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'DEFAULT' =>NULL
            ),
            'fecha_vencimiento' => array(
                'type' => 'DATE',
                'DEFAULT' =>NULL
            ),

            'fecha_imputacion' => array(
                'type' => 'DATE',
                'DEFAULT' =>NULL
            ),
            'status' => array(
                'type' => 'INT',
                'constraint' => 1,
                'DEFAULT' =>1
            ),
        ));
        
        $this->dbforge->create_table('investments',true);  



        $this->dbforge->add_field('id');
        $this->dbforge->add_field(array(            
            'import' => array(
                'type' => 'DECIMAL',
                'constraint' => '15,2',
                'DEFAULT' =>0
            ),            
            'observation' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'DEFAULT' =>NULL
            ),
            'date_imputation' => array(
                'type' => 'DATE',
                'DEFAULT' =>NULL
            ),

            'date_added' => array(
                'type' => 'DATE',
                'DEFAULT' =>NULL
            ),
            'status' => array(
                'type' => 'INT',
                'constraint' => 1,
                'DEFAULT' =>1
            ),
        ));
        
        $this->dbforge->create_table('earnings',true);  
    }


    public function getAll(){
        $this->db->order_by('fecha_emision');
        $query=$this->db->get('investments');
        return $query->result_array();
    }

    public function add(){
        if($this->input->post()==null && $data==null){
            return false;
        }
        $params=$this->input->post();
        
        if($this->db->insert('investments',$params)){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }


    public function edit($id=0,$params=null){
        if($id==0){
            return false;
        }

        if($params){

            $result=$this->db->update('investments', $params, array('id' => $id));
            log_message('info', "===> UPDATE INVESMETNS");	
            log_message('info', __CLASS__."_".__METHOD__."_".__LINE__."". $this->db->last_query());	
            return $result;
            
        }else{
            return false;
        }

    }

    public function delete($id=0){
        if($id==0){
            return false;
        }
        
        $result=$this->db->delete('investments',array('id' => $id));
        log_message('info', "===> DELETE INVESMETNS");	
        log_message('info', __CLASS__."_".__METHOD__."_".__LINE__."". $this->db->last_query());	
        return $result;
      

    }

    public function getById($id=0){
        if($id==0){
            return false;
        }
        $query=$this->db->where('id',$id)->get("investments");
        return $query->row_array();
    }


    public function getEarningsAll(){
        $this->db->order_by('date_imputation');
        $query=$this->db->get('earnings');
        return $query->result_array();
    }

    public function getEarningById($id=0){
        if($id==0){
            return false;
        }
        $query=$this->db->where('id',$id)->get("earnings");
        return $query->row_array();
    }

    public function add_earnings(){
        if($this->input->post()==null && $data==null){
            return false;
        }

        $params=$this->input->post();
        $params['date_added']=date('Y-m-d');
        if($this->db->insert('earnings',$params)){
            return $this->db->insert_id();
        }else{
            return false;
        }
        return false;        
    }

    public function delete_earnings($id=0){
        if($id==0){
            return false;
        }
        
        $result=$this->db->delete('earnings',array('id' => $id));
        log_message('info', "===> DELETE earnings");	
        log_message('info', __CLASS__."_".__METHOD__."_".__LINE__."". $this->db->last_query());	
        return $result;
    }

    public function update_earnings($id=0,$params=null){
        if($id==0){
            return false;
        }

        if($params){

            $result=$this->db->update('earnings', $params, array('id' => $id));
            log_message('info', "===> UPDATE earnings");	
            log_message('info', __CLASS__."_".__METHOD__."_".__LINE__."". $this->db->last_query());	
            return $result;
            
        }else{
            return false;
        }
    }
}