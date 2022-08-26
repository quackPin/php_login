<?php

    defined('BASEPATH') OR exit('No direct script access allowed');
    class Users_action extends CI_Controller {
        public function __construct() {
            parent::__construct(); 
            $this->load->database();
            $this->load->model('Function_Model');

        }
        public function add_user(){

            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $phone_no = $this->input->post('phone_no');
            $password = $this->input->post('password');

            $add_data = array(
                'name'=> $name,
                'email' => $email,
                'phone_no' => $phone_no,
                'password' => md5($password),
                'address' => 0,
                'status' => 1,
            );
            $addUser = $this->Function_Model->insertData('users',$add_data);
            if($addUser){
                echo '1';
            }else{
                echo '0';
            }
        }
    }
?>