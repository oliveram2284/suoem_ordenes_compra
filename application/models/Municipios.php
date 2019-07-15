<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Municipios extends CI_Model {

    public function __construct(){
        
        $this->create_tables();       
        
    }

    public function create_tables(){
        $this->load->dbforge();
    
        //$this->dbforge->create_table('users', TRUE);
        $this->dbforge->add_field('id');
        $this->dbforge->add_field(array(
            'code' => array(
                'type' => 'VARCHAR',
                'constraint' => '150',
                'DEFAULT' =>''
            ),
            'nombre' => array(
                'type' => 'VARCHAR',
                'constraint' => '150',
                'DEFAULT' =>''
            )
        ));
        
        $this->dbforge->create_table('municipios',true);         
    }

    public function getTotalMunicipios($data = null){
       
        $response = array();
        $this->db->select('*');
        $this->db->order_by('id','desc');
        if($data['search']['value']!=''){

            $this->db->where('codigo',$data['search']['value']); 
            $this->db->or_where('nombre',$data['search']['value']);     
        }       
        $query = $this->db->get('municipios');
        return $query->num_rows();
    }

    public function getFiltered( $data = null){

        $this->db->select('*');
        $this->db->order_by('id','desc');
        if($data['search']['value']!=''){
            $this->db->where('codigo',$data['search']['value']); 
            $this->db->or_where('nombre',$data['search']['value']); 
        }
        $this->db->limit($data['length'],$data['start']);
        $query = $this->db->get('municipios');   
        return $query->result_array();
    }

    public function insert()
    {   
        $data = array(
            'code'     => $this->input->post('code'),
            'nombre'   => $this->input->post('nombre')
        );        
        return $this->db->insert('municipios', $data);
    }

    public function getById($id=null){
        if(!$id){
            return false;
        }

        $query = $this->db->get_where('municipios',array('id'=>$id));
        $result = $query->row_array();
        
        return $result;
    }

    public function getByName($nombre=null){
        if(!$nombre){
            return false;
        }

        $query = $this->db->get_where('municipios',array('LOWER(nombre)'=>strtolower($nombre)));
        //echo $this->db->last_query();
        $result = $query->row_array();
        
        return $result;
    }


    public function update($id , $params = false)
    {               
        if($params){
            
            $data = array(
                'code' => $params('code'),
                'nombre' => $params('nombre')
            );  

        }else{            
           
            
            $data = array(
                'code' => $this->input->post('code'),
                'nombre' => $this->input->post('nombre')
            );

        }

        return $this->db->update('municipios', $data, array('id' => $id));
    }

    public function delete($id=false){
        return $this->db->delete('municipios',array('id'=>$id));
    }

    public function getMunicipalidad(){
        $this->db->select('id,code,nombre');
        $this->db->order_by('id','asc');
        $query = $this->db->get('municipios');	
		return $query->result_array();
    }
}