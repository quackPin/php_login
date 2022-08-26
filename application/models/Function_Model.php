<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Function_Model extends CI_Model{
        function __construct(){
			parent::__construct();
			$this->load->database();
            // require CONTROLBASEURL.'smtpmail/PHPMailerAutoload.php';
        }
        
        protected $upperLimit = 10;

        // ============================== insert data ==========================//
		function insertData($table,$data){
			$insert = $this->db->insert($table,$data);
			if($insert){
				return $this->db->insert_id();
			}else{
				return 0;
			}
		}
        // ============================== insert data ==========================//

        // ====== get all data with having multiple where clause from table =====//
		function getAllDataWithMultipleWhere($table,$whereArray=array(),$orderBy="id",$orderType='DESC',$limit='',$start=0,$likeArray=array()){
            $this->db->distinct();
            if(!empty($whereArray)){
                $this->db->where($whereArray);
            }
			$this->db->order_by($orderBy,$orderType);
			if($limit!='' && $start!=''){
				$this->db->limit($limit, $start);
			}
			if(!empty($likeArray)){
				$this->db->like($likeArray);
			}

			$query = $this->db->get($table);
			$result['numRows'] = $query->num_rows();
			$result['result'] = $query->result();
			return $result;
		}
        // ====== get all data with having multiple where clause from table =====//


        // ===================== update function Start =======================//
		function updateDetailsWithMultipleWhere($table,$whereArray,$data){
			$this->db->where($whereArray);
			$query = $this->db->update($table,$data);
			if($query){
				return true;
			}
		}
        //====================== update function End ========================//
        

        //====================== delete function start ========================//
        
		function deleteWhere($table,$whereArray){
			$this->db->where($whereArray);
			$del=$this->db->delete($table);   
			return $del;
        }
        
        //====================== delete function end ==========================//
        

        // ======================== send mail function SMTP =================== //
		function sendSMTPmail($sub,$to,$msg){
			$mail = new PHPMailer;
			$mail->isSMTP();                                            // Set mailer to use SMTP
			//$mail->SMTPDebug = true;
			//$mail->Host = "ssl://smtp.gmail.com";
			$mail->Host = 'smtp.gmail.com';                            // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                                   // Enable SMTP authentication
		
			$mail->Username = '';              // SMTP username
			$mail->Password = '';                               // SMTP password (new and active pass)
			

			$mail->SMTPSecure = 'ssl';                                       // Enable encryption, 'ssl' also accepted
			//$mail->Port = 465;     
			$mail->Port = 465;
			$mail->From = 'no-reply@mco.in';
			$mail->FromName = '<CO';
			$mail->addAddress($to);  
			$mail->addReplyTo('no-reply@mco.in');                                      // Set word wrap to 50 characters
			
			$mail->isHTML(true);                                                    // Set email format to HTML
			
			$mail->Subject = $sub;
			$mail->Body    = $msg;
			//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
			
			if(!$mail->send()) {
			//    echo 'Message could not be sent.';
				//echo 'Mailer Error: ' . $mail->ErrorInfo;die();
				return '0';
			} else {
				//echo 'Message has been sent';
				//return true;
				return '1';
			}
		}
		// ======================== send mail function SMTP =================== //

        //=====================common pagination function start==========================//
    
   public function myPagination($total=0,$per_page=10,$page=1,$url='?',$section_old='')
	{
		$section='"'.$section_old.'"';
		
		 $total = $total;
		 $adjacents = "2"; 
		   
		// $prevlabel = "&lsaquo; Prev";
		 $prevlabel = "&lsaquo;";
		 //$nextlabel = "Next &rsaquo;";
		 $nextlabel = " &rsaquo;";
		// $lastlabel = "Last &rsaquo;&rsaquo;";
		 $lastlabel = " &rsaquo;&rsaquo;";
		   
		 $page = ($page == 0 ? 1 : $page);  
		 $start = ($page - 1) * $per_page;
		 
		 $prev = $page - 1;                          
		 $next = $page + 1;
		   
		 $lastpage = ceil($total/$per_page);
	 
		 if($lastpage < 2){
			 return '';
		 }
		 $lpm1 = $lastpage - 1; // //last page minus 1
		   
		 $pagination = "";
		 if($lastpage > 1){   
			 $pagination .= "<ul class='pagination'>";
			 //$pagination .= "<li class='page_info'><span>Page {$page} of {$lastpage}</span></li>";
				   
				 if ($page > 1) $pagination.= "<li class='paginate_button page-item'><a href='javascript:void(0);' id='GoSearchPagi' onclick='fetchDataPaginationWise($prev);' page='{$prev}'>{$prevlabel}</a></li>";
				   
			 if ($lastpage < 7 + ($adjacents * 2)){   
				 for ($counter = 1; $counter <= $lastpage; $counter++){
					 if ($counter == $page)
						 $pagination.= "<li class='paginate_button page-item active'><a class='current'>{$counter}</a></li>";
					 else
						 $pagination.= "<li class='paginate_button page-item'><a href='javascript:void(0);' id='GoSearchPagi' onclick='fetchDataPaginationWise($counter);' page='{$counter}'>{$counter}</a></li>";                    
				 }
			   
			 } elseif($lastpage > 5 + ($adjacents * 2)){
				   
				 if($page < 1 + ($adjacents * 2)) {
					   
					 for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++){
						 if ($counter == $page)
							 $pagination.= "<li class='paginate_button page-item active'><a class='current'>{$counter}</a></li>";
						 else
							 $pagination.= "<li class='paginate_button page-item'><a href='javascript:void(0);' id='GoSearchPagi' onclick='fetchDataPaginationWise($counter);' page='{$counter}'>{$counter}</a></li>";                    
					 }
					 $pagination.= "<li class='paginate_button page-item dot'>...</li>";
					 $pagination.= "<li class='paginate_button page-item'><a href='javascript:void(0);' id='GoSearchPagi' onclick='fetchDataPaginationWise($lpm1);' page='{$lpm1}'>{$lpm1}</a></li>";
					 $pagination.= "<li class='paginate_button page-item'><a href='javascript:void(0);' id='GoSearchPagi' onclick='fetchDataPaginationWise($lastpage);' page='{$lastpage}'>{$lastpage}</a></li>";  
						   
				 } elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
					   
					 $pagination.= "<li class='paginate_button page-item'><a href='javascript:void(0);' id='GoSearchPagi'  onclick='fetchDataPaginationWise(1);' page='1'>1</a></li>";
					 $pagination.= "<li class='paginate_button page-item'><a href='javascript:void(0);' id='GoSearchPagi'  onclick='fetchDataPaginationWise(2);' page='2'>2</a></li>";
					 $pagination.= "<li class='paginate_button page-item dot'>...</li>";
					 for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
						 if ($counter == $page)
							 $pagination.= "<li class='paginate_button page-item active'><a class='current'>{$counter}</a></li>";
						 else
							 $pagination.= "<li class='paginate_button page-item'><a href='javascript:void(0);' id='GoSearchPagi'  onclick='fetchDataPaginationWise($counter);' page='{$counter}'>{$counter}</a></li>";                    
					 }
					 $pagination.= "<li class='paginate_button page-item dot'>..</li>";
					 $pagination.= "<li class='paginate_button page-item'><a href='javascript:void(0);' id='GoSearchPagi'  onclick='fetchDataPaginationWise($lpm1);' page='{$lpm1}'>{$lpm1}</a></li>";
					 $pagination.= "<li class='paginate_button page-item'><a href='javascript:void(0);' id='GoSearchPagi'  onclick='fetchDataPaginationWise($lastpage);' page='{$lastpage}'>{$lastpage}</a></li>";      
					   
				 } else {
					   
					 $pagination.= "<li class='paginate_button page-item'><a href='javascript:void(0);' id='GoSearchPagi'  onclick='fetchDataPaginationWise(1);' page='1'>1</a></li>";
					 $pagination.= "<li class='paginate_button page-item'><a href='javascript:void(0);' id='GoSearchPagi'  onclick='fetchDataPaginationWise(2);' page='2'>2</a></li>";
					 $pagination.= "<li class='paginate_button page-item dot'>..</li>";
					 for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
						 if ($counter == $page)
							 $pagination.= "<li class='paginate_button page-item active'><a class='current'>{$counter}</a></li>";
						 else
							 $pagination.= "<li class='paginate_button page-item'><a href='javascript:void(0);' id='GoSearchPagi'  onclick='fetchDataPaginationWise($counter);' page='{$counter}'>{$counter}</a></li>";                    
					 }
				 }
			 }
			   
				 if ($page < $counter - 1) {
					 $pagination.= "<li class='paginate_button page-item'><a href='javascript:void(0);' id='GoSearchPagi'  onclick='fetchDataPaginationWise($next);' page='{$next}'>{$nextlabel}</a></li>";
					// $pagination.= "<li><a href='javascript:void(0);' id='GoSearchPagi'  onclick='findPageVal($lastpage);' page='{$lastpage}'>{$lastlabel}</a></li>";
					 //$pagination.= "<li><a href='javascript:void(0);' id='GoSearchPagi'  onclick='findPageVal($lastpage);' page='{$lastpage}'>{$lastlabel}</a></li>";
				 }
			   
			 $pagination.= "</ul>";        
		 }
		 return $pagination;
	}


		// ======================== call api start ======================== //
		public function fireAPI($apiEndpoint,$apiData){


			
			$apiUrl = APIBASEPOINT.$apiEndpoint;
			$curlHeaderData = array();
			$curlHeaderData[] = 'Content-type: application/json';
			$curlHeaderData[] = 'Authorization: admin';
			$curl = curl_init($apiUrl);
			curl_setopt($curl, CURLOPT_HTTPHEADER, $curlHeaderData);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($apiData));
			
			// curl_setopt($curl, CURLOPT_SSLVERSION,3);
			$curl_response = curl_exec($curl);
			curl_close($curl);

			return json_decode($curl_response);
		}
		// ========================= call api end ========================= //


		// ======================== call api start ======================== //
		public function firegetAPI($apiEndpoint,$apiData,$mode='live'){


			
			$apiUrl = APIBASEPOINT.$apiEndpoint;
			// $curlHeaderData = array(
			// 	'Authorization: admin'
			// );
			$headr = array();
			$headr[] = 'Content-type: application/json';
			$headr[] = 'Authorization: admin';

			
			// $curlHeaderData = array(
			// 	'Authorization'=> 'admin'
			// );
          $query = http_build_query($apiData); 
		  $ch    = curl_init($apiUrl.'?'.$query);
		  curl_setopt($ch, CURLOPT_HEADER, false);
		  curl_setopt($ch, CURLOPT_HTTPHEADER,$headr);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		 
		  $curl_response = curl_exec($ch);
          curl_close($ch);
		if($mode == 'test')
		{
			return $curl_response;
		}else{
		  return json_decode($curl_response);
		}

		}
		// ========================= call api end ========================= //
        //============ insert activity ===========//
		public function insertActivity($activity=array()){
			if(!empty($activity) && isset($activity['activity_message']) && $activity['activity_message'] != '' && isset($activity['sender']) && $activity['sender'] != '' )
			{
				if($activity['receiver'] != ''){
					$receiver = explode(',',$activity['receiver']);
				}else{
					$receiver = array();
				}
				if(!empty($receiver)){
					foreach($receiver as $row){
						if($row != '' && $row != 0){
							$activity['receiver'] = $row;
							$this->db->insert('site_activity_track',$activity);
						}
					}
				}
				//============= entry for system admin ================//
				$system_act = $activity;
				$system_act['receiver'] = 0;
				$system_act['system_admin'] = 1;
				$this->db->insert('site_activity_track',$system_act);
			}
			return true;
		}
		//=================== update activity =============//
		public function update_activity($user_id,$activity_type = '0'){
			$where = array('receiver'=> $user_id);
			if($activity_type != '0'){
				$where['activity_type'] = $activity_type;
			}
			return $this->db->update('site_activity_track', array('notification_open'=>'1'), $where);
		}
    }

?>