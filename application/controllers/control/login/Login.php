<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Login extends CI_Controller {
        public function __construct() {
            parent::__construct(); 
            $this->load->database();
            $this->load->model('Function_Model');
            $this->load->library('session');
            $this->load->helper('url');
        }
        public function login(){
                // echo"<pre>";
                // print_r($_SESSION);
                // die();
            // $data = array(
            //     'login_error'=> $this->session->flashdata('login_error')
            // );

            if($this->session->userdata('userId') != ''){
                redirect("home");
            }else{
            //     $this->load->view("control/includes/login_header.php");
                $this->load->view("control/login/login");
            //     $this->load->view("control/includes/login_footer.php");
            }
        }
        public function login_action(){
            $phone = $this->input->post("phone_no");
            $pass = $this->input->post("password");
            $remember = $this->input->post("remember");
            
            $loginAPIResponse = $this->Function_Model->getAllDataWithMultipleWhere("users",array("phone_no"=>$phone,"password"=>md5($pass)));

           
            
            if($loginAPIResponse["numRows"] == 0){
                
                echo '2';

            }else{ 
                if($remember == 1){
                    echo 'hello';
                    setcookie("bett_phone", $phone, time() + 24 * 3600);
                    setcookie("bett_pass", $pass, time() + 24 * 3600);
                }
                
                $this->session->set_userdata(array(
                    'userId'  => $loginAPIResponse["result"][0]->id,
                    'userPhone'  => $loginAPIResponse["result"][0]->phone_no
                ));
                
                if(!empty($_SESSION['userId'])){
                    echo '1';
                }else{
                    echo '0';
                }
            
            }
        }
        public function home(){
            $user_id = $this->session->userdata("userId");
            
            if(!empty($user_id)){
                $current_date = date("Y-m-d");
                $currentDateTime = new DateTime("now", new DateTimeZone('Asia/Calcutta'));

                $userReturnData = $this->Function_Model->getAllDataWithMultipleWhere('users',array('id'=>$user_id));
                $userData = $userReturnData['result'][0];

                $data = array(
                'id' => $user_id,
                'user_data' => $userData
                );
                

            
            
            //     $this->load->view('control/includes/header');
            //     $this->load->view('control/includes/left_sidebar');
            //     $this->load->view('control/includes/topbar');
                    $this->load->view('control/login/profile', $data);
            //     $this->load->view('control/includes/footer');
            }else{
                redirect("login");
            }
            
        }
        public function logout(){
            $this->session->unset_userdata('userId');
            $this->session->unset_userdata('userName');
            $_SESSION['userId'] = "";
            $_SESSION['userName'] = "";
            session_destroy();
            redirect("login");
        }
        public function registration(){
           

            // if($this->session->userdata('userId') != ''){
                // redirect("home");
            // }else{
            //     $this->load->view("control/includes/login_header.php");
                $this->load->view("control/login/registration");
            //     $this->load->view("control/includes/login_footer.php");
            // }
        }
    }
?>