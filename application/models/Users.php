<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Model {

    public $username;
    public $password;
    public $firstname;
    public $lastname;
    //public $email;
    public $status;
    public $group_id;


    public function __construct(){
        $this->load->dbforge();
    
        //$this->dbforge->create_table('users', TRUE);
        $this->dbforge->add_field('id');
        $this->dbforge->add_field(array(
            'username' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'DEFAULT' =>''
            ),
            'firstname' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'DEFAULT' =>''
            ),
            'lastname' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'DEFAULT' =>''
            ),
            'password' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'DEFAULT' =>''
            ),
            'user_group_id' => array(
                'type' => 'INT',
                'constraint' => 2,
                'DEFAULT' =>0
            ),
            'status' => array(
                'type' => 'INT',
                'constraint' => 2,
                'DEFAULT' =>0
            ),
            'created' => array(
                'type' => 'DATETIME',
            ),
        ));

        $this->dbforge->create_table('users',true);

        $this->dbforge->add_field('id');
        $this->dbforge->add_field(array(
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'DEFAULT' =>''
            ),  
            'permission' => array(
                'type' => 'TEXT',
                'DEFAULT' =>''
            ),             
            'status' => array(
                'type' => 'INT',
                'constraint' => 2,
                'DEFAULT' =>0
            )
        ));
        $this->dbforge->create_table('user_groups',true);      

        if (!$this->db->field_exists('permission', 'user_groups')){
            $fields = array(
                'permission' => array('type' => 'TEXT','AFTER' => 'name', 'DEFAULT' =>''),
            );
            $this->dbforge->add_column('user_groups', $fields);       
        }
       
        
    }



    public function getAll()
    {
        $query = $this->db->get('users', 10);
        return $query->result();
    }


    public function getTotalUsers($data = null){
       
		$response = array();
		$this->db->select('*');
		$this->db->order_by('id','desc');
		//$this->db->where(array('oEsMayorista'=>1,'oEsPlanReserva'=>0));
		if($data['search']['value']!=''){

			$this->db->where('username ',$data['search']['value']);	
			$this->db->or_where('firstname ',$data['search']['value']);	
			$this->db->or_where('lastname ',$data['search']['value']);	
			$this->db->limit($data['length'],$data['start']);		
		}		
		$query = $this->db->get('users');
		return $query->num_rows();
    }
    
    public function getFiltered( $data = null){

		$this->db->select('*');
		$this->db->order_by('id','desc');
		if($data['search']['value']!=''){
			$this->db->where('username ',$data['search']['value']);	
			$this->db->or_where('firstname ',$data['search']['value']);	
			$this->db->or_where('lastname ',$data['search']['value']);	
		}
		$this->db->limit($data['length'],$data['start']);
		$query = $this->db->get('users');	
		return $query->result_array();
	}

    public function insert()
    {   
        $data = array(
            'username'      => $this->input->post('username'),
            'firstname'     => $this->input->post('firstname'),
            'lastname'      => $this->input->post('lastname'),
            'password'      => md5($this->input->post('password')),
            'user_group_id' => $this->input->post('user_group_id'),
            'created'       => date('Y-m-d H:i:s'),
        );        
        return $this->db->insert('users', $data);
    }

    public function update($id , $params = false)
    {       
        $user=$this->getById($id);

       
        
        if($params){
            
            $data = array(
                'username' => $params('username'),
                'firstname' => $params('firstname'),
                'lastname' => $params('lastname'),
                'user_group_id' => $params('user_group_id'),           
            );  

            if($params('password')!='' && $user['password'] != md5($params('password'))){
                $data['password'] = md5($params('password'));
            }

        }else{            
           
            
            $data = array(
                'username' => $this->input->post('username'),
                'firstname' => $this->input->post('firstname'),
                'lastname' => $this->input->post('lastname'),
                'user_group_id' => $this->input->post('user_group_id'),           
            );

            if($this->input->post('password')!='' && $user['password']!=md5($this->input->post('password'))){
                $data['password'] = md5($this->input->post('password'));
            }

        }

        return $this->db->update('users', $data, array('id' => $id));
    }

    public function delete($id=false){
        return $this->db->delete('users',array('id'=>$id));
    }

    public function getById($id=null){
        if(!$id){
            return false;
        }

        $query = $this->db->get_where('users',array('id'=>$id));
        $result = $query->row_array();
        
        return $result;
    }
    public function getByUsername($username=false){
        if(!$username){
            return null;
        }

        $query = $this->db->get_where('users',array('username'=>$username));
        $result = $query->row_array();
        
        return $result;
    }
    


    public function getGroups(){
        $this->db->order_by('id');
        $query = $this->db->get('user_groups');	
		return $query->result_array();
    }

    public function getGroupId($user_group_id){
        $query = $this->db->get_where('user_groups',array('id'=>$user_group_id));
        $result =$query->row_array();
        $result['permission']=json_decode($result['permission'],true);        
		return $result;
    }

    public function group_insert($data){
        $data = array(
            'name'      => $this->input->post('name'),
            'permission'    => json_encode($this->input->post('permission'),true),
            'status'        => '1',
        );     
        $this->db->insert('user_groups', $data);
        $user_group_id=$this->db->insert_id();
        return $user_group_id;
    }

    public function group_update($user_group_id,$data){
        $data = array(
            'name'      => $this->input->post('name'),
            'permission'    => json_encode($this->input->post('permission'),true),
            'status'        => '1',
        );     
        return $this->db->update('user_groups', $data, array('id' => $user_group_id));
    }

    public function grupos_delete($id){
        return $this->db->delete('user_groups',array('id'=>$id));
    }
}