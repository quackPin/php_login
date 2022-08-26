<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    require APPPATH . 'third_party/REST_Controller.php';
    require APPPATH . 'third_party/Format.php';
    use Restserver\Libraries\REST_Controller;
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");


    class MY_Controller extends REST_Controller {
        public function __construct() {
            parent::__construct();
        }
        public function success_response($data = array(),$message = 'success!',$pagination = array()){
            $statusCode = parent::HTTP_OK;
            if(empty($pagination)){
                $response = array(
                    'status' => true,
                    'statusCode' => $statusCode,
                    'message' => $message,
                    'data' => $data,
                );
            }else{

                $response = array(
                    'status' => true,
                    'statusCode' => $statusCode,
                    'message' => $message,
                    'data' => $data,
                    'pagination'=>$pagination
                );
            }
            
            $this->response($response, $statusCode);
        }

        public function success_response_ok($data = array(),$message = 'success!'){
            $statusCode = parent::HTTP_OK;
            $response = array(
                'status' => true,
                'statusCode' => $statusCode,
                'message' => $message,
                'data' => $data,
            );
            $this->response($response, $statusCode);
        }

        public function success_response_nocontent($data = array(),$message = 'success!'){
            $statusCode = parent::HTTP_NO_CONTENT;
            $response = array(
                'status' => true,
                'statusCode' => $statusCode,
                'message' => $message,
                'data' => $data,
            );
            $this->response($response, $statusCode);
        }

        public function error_response($message = 'error!'){
            $statusCode = parent::HTTP_OK;
            $response = array(
                'status' => false,
                'statusCode' => $statusCode,
                'message' => $message
            );
            $this->response($response, $statusCode);
        } 

        public function error_response_bad_request($message = 'error!'){
            $statusCode = parent::HTTP_BAD_REQUEST;
            $response = array(
                'status' => false,
                'statusCode' => $statusCode,
                'message' => $message
            );
            $this->response($response, $statusCode);
        }
    }

    class MY_Control_Controller extends CI_Controller {
        public function __construct() {
            parent::__construct();
            $controller = $this->router->fetch_class();
            if( ($controller != 'Login') ){
                if((strlen($this->session->userdata('bboss_user_id')) == '') || (empty($this->session->userdata('bboss_user_id'))) ){
                    redirect("login");
                }
            }
        }
        public function load_view($pages=array(),$data=array(),$type="afterLogin"){
            if(empty($pages)){
                return false;
            }else{
                if($type == "beforeLogin"){
                    $this->load->view('control/includes/login_header');
                    foreach($pages as $pagesRow){
                        $this->load->view($pagesRow,$data);
                    }
                    $this->load->view('control/includes/login_footer');
                }else if($type == "afterLogin"){
                    $this->load->view("control/includes/header");
                    $this->load->view("control/includes/left_sidebar");
                    $this->load->view("control/includes/topbar");
                    foreach($pages as $pagesRow){
                        $this->load->view($pagesRow,$data);
                    }
                    $this->load->view("control/includes/footer");
                }
            }
        }
    }
?>