<?php
require FCPATH.'vendor/autoload.php';
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;
define("AUTHORIZENET_LOG_FILE", "phplog");

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Request_management extends CI_Controller {
  
  	private $data;
  
  	public function __construct() {
        parent::__construct();
        $this->load->model('request_model');
        $this->load->model('comman_model');
        $this->load->helper('upload_helper');
        $this->check_login_again();
    }

    public function check_login_again() {
        if ($this->session->userdata('admin_user_role') != 1 || $this->session->userdata('admin_user_id') == '') {
            redirect('administrator', 'refresh');
        }
    }

   
    function manage_requests(){
       $start_from = $this->uri->segment(3);
        if (!is_numeric($start_from))
            $start_from = 0;
        $where = array('request_id !=' => 0,'request_status' => 1);
        $total = $this->comman_model->get_total('request_property',$where);
        $per_page = 10;
        $num_links = 4;
        $uri_segment = 3;
        $this->data['pagination'] = paginate(base_url() . 'administrator/manage_requests/', $total, $per_page, $num_links, $uri_segment);

        $this->data['results'] = $this->request_model->get_all_requests($per_page, $start_from,$where);
        //echo '<pre>'; print_r($this->data['results']); '</pre>'; die();
        $this->data['view_path'] = "admin/requests/manage_requests";
        $this->data['page'] = "manage_requests";
        
        if ($this->session->flashdata('success') != "")
            $this->data['success'] = $this->session->flashdata('success');
        if ($this->session->flashdata('errors') != "")
            $this->data['errors'] = $this->session->flashdata('errors');
        
        $this->load->view('admin_template', $this->data);
    }

    function deleteRequest(){
        $id = decode_uri($this->uri->segment(4));
        $where = array('request_id' => $id);
        $deleted = $this->comman_model->delete('request_property',$where);
        if($deleted){
            $this->session->set_flashdata('success','Request Deleted Successfully.');
            redirect('administrator/manage_requests/'.$this->uri->segment(3));
        }
        $this->session->set_flashdata('errors','Request not deleted,please try later.');
        redirect('administrator/manage_requests/'.$this->uri->segment(3));
    }

    function accept(){        
        $id = decode_uri($this->uri->segment(4));
        $where = array('request_id' => $id);
        $updated = $this->comman_model->update('request_property',$where,array('request_status' => 1,'modified' => date('Y-m-d H:i:s')));
        if($updated){
            $this->session->set_flashdata('success','Request Accepeted Successfully.');
            redirect('administrator/manage_requests/'.$this->uri->segment(3));
        }
        $this->session->set_flashdata('errors','Requeste not accepted,please try later.');
        redirect('administrator/manage_requests/'.$this->uri->segment(3));
    }

    function reject(){       
        $id = decode_uri($this->uri->segment(4));
        $where = array('request_id' => $id,'request_status' => 0);
        $updated = $this->comman_model->update('request_property',$where,array('request_status' => 2));
        if($updated){
            $this->session->set_flashdata('success','Request Rejected Successfully.');
            redirect('administrator/manage_requests/'.$this->uri->segment(3));
        }
        $this->session->set_flashdata('errors','Requeste not reject, please try later.');
        redirect('administrator/manage_requests/'.$this->uri->segment(3));
    }

    function acceptPayment(){
        $redirect_url = $_SERVER['HTTP_REFERER'];
        $payment_id = decode_uri($this->uri->segment(4));
        $where = array('payment_id' => $payment_id);
        $payment_data = $this->request_model->get_payment_data($payment_id);
        //print_r($payment_data[0]['profile_id']); die();
        if($payment_data[0]['request_status'] == 0){
            $this->session->set_flashdata('errors','Request not accepted by host.');
            redirect($redirect_url);
        }

        if($payment_data[0]['request_status'] == 2){
            $this->session->set_flashdata('errors','Request rejected by host.');
            redirect($redirect_url);
        }

        if($payment_data[0]['due_date'] > time()){
            $this->session->set_flashdata('errors','Transection cannot proceed before due date.');
            redirect($redirect_url);
        }
        if($payment_data[0]['teansection_id'] != ''){
            $this->session->set_flashdata('errors','Teansection already excuted.');
            redirect($redirect_url);
        }
        
       //$payment_profile_data = $this->comman_model->get('request_property',$where,'profile_id,payment_profile_id,paid_amount');
       // print_r($payment_profile_data); 
        //die();

      $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
      $merchantAuthentication->setName("5S3Bfx577");
      $merchantAuthentication->setTransactionKey("32PkHGYK594e9zgj");
      $refId = 'ref' . time();

      $profileToCharge = new AnetAPI\CustomerProfilePaymentType();
      $profileToCharge->setCustomerProfileId($payment_data[0]['profile_id']);
      $paymentProfile = new AnetAPI\PaymentProfileType();
      $paymentProfile->setPaymentProfileId($payment_data[0]['payment_profile_id']);
      $profileToCharge->setPaymentProfile($paymentProfile);


      $transactionRequestType = new AnetAPI\TransactionRequestType();
      $transactionRequestType->setTransactionType("authCaptureTransaction"); 
      $transactionRequestType->setAmount($payment_data[0]['amount_due']);
      $transactionRequestType->setProfile($profileToCharge);

      $request = new AnetAPI\CreateTransactionRequest();
      $request->setMerchantAuthentication($merchantAuthentication);
      $request->setRefId( $refId);
      $request->setTransactionRequest( $transactionRequestType);
      $controller = new AnetController\CreateTransactionController($request);
      $response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);
      if ($response != null){

        $tresponse = $response->getTransactionResponse();
        if (($tresponse != null) && ($tresponse->getResponseCode()=="1") )   
        {
          $Profile_auth_code = $tresponse->getAuthCode();
          $teansection_id =  $tresponse->getTransId();
            //die('$response != null');
            $updated = $this->comman_model->update('request_payments',$where,array('payment_status' => 'paid','teansection_id' => $teansection_id,'modified_on' => date('Y-m-d H:i:s')));
            if($updated){
                $this->session->set_flashdata('success','Payment Accepeted Successfully.');
                redirect($redirect_url);
            }

        }
        elseif (($tresponse != null) && ($tresponse->getResponseCode()=="2") )
        {
          $error =  "ERROR" . "\n";
          $this->session->set_flashdata('errors',$error);
          redirect($redirect_url);
        }
        elseif (($tresponse != null) && ($tresponse->getResponseCode()=="4") )
        {
            $error .= "ERROR: HELD FOR REVIEW:"  . "\n";
            $this->session->set_flashdata('errors',$error);
            redirect($redirect_url);
        }
      }
      else
      { 
        $error = "no response returned";
        $this->session->set_flashdata('errors',$error);
        redirect($redirect_url);
      }
    //echo $teansection_id; die();
            
  }

  function request_detail(){
    if ($this->session->flashdata('success') != "")
      $this->data['success'] = $this->session->flashdata('success');
    if ($this->session->flashdata('errors') != "")
      $this->data['errors'] = $this->session->flashdata('errors');
    
    $request_id = decode_uri($this->uri->segment(4));
    $where = array('request_id' => $request_id,'request_status' => 1);
    $this->data['results'] = $this->request_model->get_all_requests(1, 0,$where);
    //echo '<pre>'; print_r($this->data['results']); die();
    $this->data['view_path'] = "admin/requests/request_detail";
    $this->data['page'] = "manage_requests";
    $this->load->view('admin_template', $this->data);
  }


}