<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth{
    protected $ci;

    public function __construct(){
        $this->ci =& get_instance();
        $this->ci->load->model('Users');
        
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

}