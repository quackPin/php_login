<?php

    defined('BASEPATH') OR exit('No direct script access allowed');
    class BankData extends CI_Controller {
        public function __construct() {
            parent::__construct(); 
            $this->load->database();
            $this->load->model('Function_Model');

        }
        public function bank(){
            // $oldSql = "SELECT * FROM `bank_ifsc_code` ";
            // $oldBankResult  = $this->db->query($oldSql);
            // $allOldBankData[] = $oldBankResult->result_array();

            $newSql = "SELECT * FROM `bank_ifsc_code_new` WHERE `district` LIKE `address` ";
            $newBankResult  = $this->db->query($newSql);
            $allNewBankData = $newBankResult->result_array();

            // echo"<pre>";print_r($allNewBankData);die();

            foreach($allNewBankData as $allNewBankDataRow){

                $newAddress = $allNewBankDataRow['address'];
                $newIFSC = $allNewBankDataRow['ifsc'];
                // $oldAddress = $allOldBankData->address;
                $oldSql = "SELECT * FROM `bank_ifsc_code` WHERE `ifsc` = '$newIFSC' ";
                $oldBankResult  = $this->db->query($oldSql);
                $allOldBankData = $oldBankResult->result_array();
                if(!empty($allOldBankData)){
                    $oldDistrict = $allOldBankData[0]['district'];
                    // echo"<pre>";print_r($allOldBankData);die();

                    $updateSql = "UPDATE `bank_ifsc_code_new` SET `district`= '$oldDistrict' WHERE `ifsc` = '$newIFSC' ";
                    $updateBank  = $this->db->query($updateSql);
                }
                
            }
            echo"<pre>";print_r($updateBank);die();
        }
    }
?>