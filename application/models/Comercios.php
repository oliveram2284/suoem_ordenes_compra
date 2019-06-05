<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Comercios extends CI_Model {

    public function __construct(){
        
        $this->create_tables(); 
    }
    public function create_tables(){

        $this->load->dbforge();    
        $this->dbforge->add_field('id');
        $this->dbforge->add_field(array(
            'codigo' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'DEFAULT' =>''
            ),        
            'nombre' => array(
                'type' => 'VARCHAR',
                'constraint' => '250',
                'DEFAULT' =>''
            ),
            'razon_social' => array(
                'type' => 'VARCHAR',
                'constraint' => '250',
                'DEFAULT' =>''
            ),
            'cuit' => array(
                'type' => 'VARCHAR',
                'constraint' => '15',
                'DEFAULT' =>''
            ),
            'domicilio' => array(
                'type' => 'VARCHAR',
                'constraint' => '250',
                'DEFAULT' =>''
            ),
            'telefono' => array(
                'type' => 'VARCHAR',
                'constraint' => '250',
                'DEFAULT' =>''
            ),
            'observacion' => array(
                'type' => 'TEXT',
                'DEFAULT' =>NULL
            ),    
            'estado' => array(
                'type' => 'INT',
                'constraint' => 2,
                'DEFAULT' =>1
            ),
            'date_added' => array(
                'type' => 'DATETIME',
            )
            
        ));        
        $this->dbforge->create_table('comercios',true);

        $this->dbforge->add_field('id');
        $this->dbforge->add_field(array(
            'comercio_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'DEFAULT' =>NULL
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '200',
                'DEFAULT' =>''
            ),
            'description' => array(
                'type' => 'TEXT',
                'DEFAULT' =>NULL
            ),            
            'status' => array(
                'type' => 'INT',
                'constraint' => 1,
                'DEFAULT' =>0
            )
        ));
        $this->dbforge->create_table('sucursales',true);
    }

    public function getById($id=null){
        if(!$id){
            return false;
        }

        $query = $this->db->get_where('comercios',array('id'=>$id));
        $result = $query->row_array();
        
        return $result;
    }
    public function getAll(){
        $query = $this->db->get('comercios');
        return $query->result();
    }


    public function add($data=false){
        
        $params=$data;
        $params['date_added']=date('Y-m-d H:i:s');
        $params['estado']='1';
        return $this->db->insert('comercios', $params);
    }

    public function update($id , $params = false)
    {       
        $user=$this->getById($id);       

        return $this->db->update('comercios', $params, array('id' => $id));
    }


    public function delete($id=false){
        return $this->db->delete('comercios',array('id'=>$id));
    }




}