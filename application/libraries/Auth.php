<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth{
    protected $ci;

    public function __construct(){
        $this->ci =& get_instance();
        $this->ci->load->model('Users');
        $this->ci->load->model('Comercios');
        
    }
    public function is_logged()
    {   
        return ( $this->ci->session->userdata('username') != null);
    }

    public function login($user_data){
        $result=$this->ci->Users->getByUsername($user_data['username']);
        $temp_password=md5($user_data['password']);        
        if(!empty($result) && $result['password']==$temp_password){

            unset($result['password']);
            $result['user_type']='user';
            $this->ci->session->set_userdata($result);
            return true;
            
        }
        
        return false;
    }

    public function login_comercio($user_data){
        $result=$this->ci->Comercios->getByUsername($user_data['username']);
        
        $temp_password=md5($user_data['password']);        
        if(!empty($result) && $result['password']==$temp_password){

            unset($result['password']);
            $result['user_type']='comercio';
            $this->ci->session->set_userdata($result);
            return true;
            
        }
        
        return false;
    }

    public function logout(){
        $array_items = array('username');
        $this->ci->session->unset_userdata($array_items);
        return true;
    }

    public function permisos(){
        $result=$this->ci->Users->getGroupId($this->ci->session->userdata['user_group_id']);        
        return (isset($result['permission']))?$result['permission']:null;
    }

    public function comercio_permisos(){
        $result=array('permission'=>'comercio_panel');      
        return (isset($result['permission']))?$result['permission']:null;
    }
    public function allow($accion){
        $result=$this->ci->Users->getGroupId($this->ci->session->userdata['user_group_id']);   
        
        if(in_array(ucfirst($accion),$result['permission']['access'])){
            return true;
        }else{
            return false;
        }
    }

}