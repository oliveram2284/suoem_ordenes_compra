<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Model {

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
                'constraint' => 2,
                'DEFAULT' =>0
            ),
            
            'code' => array(
                'type' => 'VARCHAR',
                'constraint' => '150',
                'DEFAULT' =>''
            ),
            'key' => array(
                'type' => 'VARCHAR',
                'constraint' => '150',
                'DEFAULT' =>''
            ),
            'value' => array(
                'type' => 'VARCHAR',
                'constraint' => '10',
                'DEFAULT' =>''
            ),
            'serialized' => array(
                'type' => 'INT',
                'constraint' => '1',
                'DEFAULT' =>0
            )
        ));
        
        $this->dbforge->create_table('settings',true);  

        if($this->db->count_all_results('settings')==0){
            $rows=array(
                array('adherents','cuotas_nro',6),
                array('adherents','monto',floatval(1000)),
                array('asistencia','interes_porcentaje',floatval('0.2')),
                //array('asistencia','',floatval('0.2')),
            );
            foreach($rows as $key=>$item){                
                $this->db->insert('settings',array('code'=>$item[0],'key'=>utf8_encode( $item[1]),'value'=>$item[2]));
            }
        }
        /*if (!$this->db->field_exists('nro_cuotas', 'adherents')){
            $fields = array(
                'nro_cuotas' => array('type' => 'int','constraint' => 3,'DEFAULT' =>6),
                'monto_cuota' => array('type' => 'DECIMAL','constraint' => '15,4','DEFAULT' =>0),
                'renovacion' => array('type' => 'int','constraint' => '1','DEFAULT' =>0),
            );
            $this->dbforge->add_column('adherents', $fields);            
        }*/
        
    }

    public function getTotalSettings($data = null){
       
        $response = array();
        $this->db->select('*');
        $this->db->order_by('id','desc');
        //$this->db->where(array('oEsMayorista'=>1,'oEsPlanReserva'=>0));
        if($data['search']['value']!=''){

            $this->db->where('nro',$data['search']['value']); 
            $this->db->or_where('code',$data['search']['value']); 
            $this->db->or_where('key',$data['search']['value']);  
            $this->db->or_where('value',$data['search']['value']);  
            $this->db->or_where('serialized',$data['search']['value']);  
            $this->db->limit($data['length'],$data['start']);       
        }       
        $query = $this->db->get('settings');
        return $query->num_rows();
    }

    public function getFiltered( $data = null){

        $this->db->select('*');
        $this->db->order_by('id','desc');
        if($data['search']['value']!=''){
            $this->db->where('nro',$data['search']['value']); 
            $this->db->or_where('code',$data['search']['value']); 
            $this->db->or_where('key',$data['search']['value']);  
            $this->db->or_where('value',$data['search']['value']);  
            $this->db->or_where('serialized',$data['search']['value']);   
        }
        $this->db->limit($data['length'],$data['start']);
        $query = $this->db->get('settings');   
        return $query->result_array();
    }

    public function insert()
    {   
        $data = array(
            'nro'      => $this->input->post('nro'),
            'code'     => $this->input->post('code'),
            'key'      => $this->input->post('value'),
            'value'      => md5($this->input->post('key')),
            'serialized' => $this->input->post('serialized'),
        );        
        return $this->db->insert('settings', $data);
    }

    public function getById($id=null){
        if(!$id){
            return false;
        }

        $query = $this->db->get_where('settings',array('id'=>$id));
        $result = $query->row_array();
        
        return $result;
    }


    public function update($id , $params = false)
    {               
        if($params){
            
            $data = array(
                'nro' => $params('nro'),
                'code' => $params('code'),
                'key' => $params('key'),
                'value' => $params('value'),   
                'serialized' => $params('serialized')
            );  

        }else{            
           
            
            $data = array(
                'nro' => $this->input->post('nro'),
                'code' => $this->input->post('code'),
                'key' => $this->input->post('key'),
                'value' => $this->input->post('value'), 
                'serialized' => $this->input->post('serialized')
            );

        }

        return $this->db->update('settings', $data, array('id' => $id));
    }

    public function delete($id=false){
        return $this->db->delete('settings',array('id'=>$id));
    }
}