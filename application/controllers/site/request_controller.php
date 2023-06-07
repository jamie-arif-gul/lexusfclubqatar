<?php
require FCPATH.'vendor/autoload.php';
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;
define("AUTHORIZENET_LOG_FILE", "phplog");

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Request_controller extends CI_Controller {
  
    private $_data;
  
    public function __construct() {
        parent::__construct();
        login_persists();
        if (!$this->session->userdata('logged_in')){
          $this->session->set_userdata('after_login_redirect',$_SERVER['HTTP_REFERER']);
          redirect('login');
        }
        $this->load->model('request_model');
        $this->load->model('comman_model');
        $this->load->helper('email_helper');
        $this->load->model('messages_model');
        date_default_timezone_set('US/Eastern');
    }

    private function __loadView() {
        if ($this->session->flashdata('success')!="")
            $this->_data['success'] = $this->session->flashdata ('success');
        if ($this->session->flashdata('errors')!="")
            $this->_data['errors'] = $this->session->flashdata ('errors');
        $this->load->view('frontend/home_template', $this->_data);
    }

    function index(){
        /*$start_from = $this->uri->segment(2);
        if (!is_numeric($start_from))
            $start_from = 0;
        $where = array('status' => 1);
        $total = $this->property_model->get_total($where);
        $per_page = 10;
        $num_links = 4;
        $uri_segment = 2;
        $this->data['pagination'] = paginate(base_url() . 'properties/', $total, $per_page, $num_links, $uri_segment);
        
        $this->_data['results'] = $this->property_model->get_all_properties($per_page, $start_from,$where);*/
        //echo "<pre>"; print_r($this->data['results']); die();
        $this->_data['main_content'] = 'frontend/requests/index';
        $this->__loadView();       
    }

    function request_step_one(){
       if($this->session->userdata('user_role') == 2){
          date_default_timezone_set('US/Eastern');
          //$this->session->unset_userdata('request_data');
          $user_id = decode_uri($this->uri->segment(4));
          $property_id = decode_uri($this->uri->segment(3));
          //$is_rented = $this->comman_model->get('request_property', array('property_id' => $property_id,'check_out_date > '=> time()));

          $property_data = $this->comman_model->get('properties',array('property_id' => $property_id), 'price, date_from, date_to');
          $this->_data['date_from']  =  $property_data[0]['date_from'];
          $this->_data['date_to']  =  $property_data[0]['date_to'];
          if ($this->input->server('REQUEST_METHOD') === 'POST') {
            //echo $this->input->post('check_in_date').'<br>'; 
            //echo date('m/d/Y H:i:s',$property_data[0]['date_from']);
            //die();
              if(strtotime($this->input->post('check_in_date')) > strtotime($this->input->post('check_out_date'))){
                $this->session->set_flashdata('errors', 'Your Check In Date must be before your Check Out Date.');
                 redirect('requests/request_step_one/'.$this->uri->segment(3).'/'.$this->uri->segment(4));
               /* $this->_data['main_content'] = 'frontend/requests/request_step_one';
                $this->__loadView();*/
              }
              if(strtotime($this->input->post('check_in_date')) < $property_data[0]['date_from']){
                $this->session->set_flashdata('errors', 'chek in date is not valid.');
                 redirect('requests/request_step_one/'.$this->uri->segment(3).'/'.$this->uri->segment(4));
               /* $this->_data['main_content'] = 'frontend/requests/request_step_one';
                $this->__loadView();*/
              }
              if(strtotime($this->input->post('check_out_date')) > $property_data[0]['date_to']){
                $this->session->set_flashdata('errors', 'chek out date is not valid.');
                 redirect('requests/request_step_one/'.$this->uri->segment(3).'/'.$this->uri->segment(4));
                /*$this->_data['main_content'] = 'frontend/requests/request_step_one';
                $this->__loadView();*/
              }
              
              $this->session->set_userdata('request_data',$_POST);
              redirect('requests/request_step_two/'.$this->uri->segment(3).'/'.$this->uri->segment(4));
              
              
          }else{
              $this->_data['main_content'] = 'frontend/requests/request_step_one';
              $this->__loadView();  
          }
       }
    }
    
    function request_step_two(){
        if($this->session->userdata('user_role') == 2){
        $user_id = decode_uri($this->uri->segment(4));
        $property_id = decode_uri($this->uri->segment(3));
        $host = $this->comman_model->get('users',array('user_id' => $user_id),'name, email');
        $property_data = $this->comman_model->get('properties',array('property_id' => $property_id), 'name,price, date_from, date_to');
        //$this->_data['date_from']  =  $property_data[0]['date_from'];
        //$this->_data['date_to']  =  $property_data[0]['date_to'];
        
        if ($this->input->server('REQUEST_METHOD') === 'POST'){
              
              $request_payments_data = $this->session->userdata('request_payments_data');
              //echo '<pre>'; print_r($request_payments_data); die();
              $this->form_validation->set_rules('card_type', 'Card Type', 'trim|required|xss_clean');
              $this->form_validation->set_rules('credit_card', 'Credit Card', 'trim|integer|min_length[16]|max_length[16]|required|xss_clean');
              $this->form_validation->set_rules('expiry_month', 'expiration month', 'trim|integer|min_length[2]|max_length[2]|required|xss_clean');
              $this->form_validation->set_rules('expiry_year', 'expiration year', 'trim|integer|min_length[4]|max_length[4]|required|xss_clean');
              $this->form_validation->set_rules('terms_of_service', 'Terms of Service', 'trim|required|xss_clean');
              //$this->form_validation->set_rules('billing_address', 'Billing Address', 'trim|required|xss_clean');
              $this->form_validation->set_rules('card_first_name', 'First Name', 'trim|required|xss_clean');
              $this->form_validation->set_rules('card_last_name', 'Last Name', 'trim|required|xss_clean');
              $this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
              $this->form_validation->set_rules('city', 'City', 'trim|required|xss_clean');
              $this->form_validation->set_rules('state', 'State', 'trim|required|xss_clean');
              $this->form_validation->set_rules('country', 'Country', 'trim|required|xss_clean');
              $this->form_validation->set_rules('zip_code', 'Zip Code', 'trim|required|integer|xss_clean');
              if ($this->form_validation->run() == FALSE) {
                  $this->_data['errors'] = validation_errors();
                  //redirect('requests/request_step_two/'.$this->uri->segment(3).'/'.$this->uri->segment(4));
                }else{
                      //$property_data = $this->comman_model->get('properties',array('property_id' => $property_id), 'name, user_id');
                      //$owner_data = $this->comman_model->get('users',array('user_id' => $property_data[0]['user_id']), 'name, last_name');
                      //$description = "property ".$property_data[0]['name'] ." owend by ".$owner_data[0]['name'] ." ". $owner_data[0]['last_name']." has been ranted by ".$this->session->userdata('name').' '.$this->session->userdata('last_name');
                      //echo $description; die();
                      // Common setup for API credentials
                      $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
                      $merchantAuthentication->setName("5S3Bfx577");
                      $merchantAuthentication->setTransactionKey("32PkHGYK594e9zgj");
                      $refId = 'ref' . time();

                      // Create the payment data for a credit card
                      $creditCard = new AnetAPI\CreditCardType();
                      $creditCard->setCardNumber( "4007000000027" );
                      $creditCard->setExpirationDate( "2038-12");
                      //$creditCard->setCardNumber($this->input->post('credit_card'));
                      //$creditCard->setExpirationDate( $this->input->post('expiry_year')."-".$this->input->post('expiry_month'));
                      $paymentCreditCard = new AnetAPI\PaymentType();
                      $paymentCreditCard->setCreditCard($creditCard);

                      // Create the Bill To info
                      $billto = new AnetAPI\CustomerAddressType();
                      //$billto->setFirstName("Ellen");
                      $billto->setFirstName($this->session->userdata('name'));
                      $billto->setLastName($this->session->userdata('last_name'));
                      $billto->setCompany("Souveniropolis");
                      $billto->setAddress("14 Main Street");
                      $billto->setCity("Pecan Springs");
                      $billto->setState("TX");
                      $billto->setZip("44628");
                      $billto->setCountry("USA");
                      
                     // Create a Customer Profile Request
                     //  1. create a Payment Profile
                     //  2. create a Customer Profile   
                     //  3. Submit a CreateCustomerProfile Request
                     //  4. Validate Profiiel ID returned

                      $paymentprofile = new AnetAPI\CustomerPaymentProfileType();

                      $paymentprofile->setCustomerType('individual');
                      $paymentprofile->setBillTo($billto);
                      $paymentprofile->setPayment($paymentCreditCard);
                      $paymentprofiles[] = $paymentprofile;
                      $customerprofile = new AnetAPI\CustomerProfileType();
                      $customerprofile->setDescription("property ".$property_data[0]['price']." owend by ".$host[0]['name']."  has been ranted by ".$this->session->userdata('name'));
                      $merchantCustomerId = time().rand(1,150);
                      $customerprofile->setMerchantCustomerId($merchantCustomerId);
                      $customerprofile->setEmail($this->session->userdata('email'));
                      $customerprofile->setPaymentProfiles($paymentprofiles);

                      $request = new AnetAPI\CreateCustomerProfileRequest();
                      $request->setMerchantAuthentication($merchantAuthentication);
                      $request->setRefId( $refId);
                      $request->setProfile($customerprofile);
                      $controller = new AnetController\CreateCustomerProfileController($request);
                      $response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);
                      if (($response != null) && ($response->getMessages()->getResultCode() == "Ok") ){
                          $profile_id = $response->getCustomerProfileId();
                          $CustomerPaymentProfileIdList = $response->getCustomerPaymentProfileIdList();
                          $payment_profile_id = $CustomerPaymentProfileIdList[0];
                       }else{
                        //$error = $response->getMessages()->getMessage()[0]->getCode() . "  " .$response->getMessages()->getMessage()[0]->getText();
                        $error = $response->getMessages()->getMessage();
                        $error = $error[0];
                        $this->session->set_flashdata('errors', $error->getText());
                        redirect('requests/request_step_two/'.$this->uri->segment(3).'/'.$this->uri->segment(4)); 
                      }           
                      //die();
                    date_default_timezone_set('US/Eastern');
                    $data = $this->session->userdata('request_data');
                    //$time = strtotime($data['check_in_date']);
                    //echo $time; die();
                    $data['check_in_date'] = strtotime($data['check_in_date']);
                    $data['check_out_date'] = strtotime($data['check_out_date']);
                    $data['property_id'] = $property_id;
                    $data['sender_id'] = $this->session->userdata('user_id');
                    $data['receiver_id'] = $user_id;
                    $data['profile_id'] = $profile_id;
                    $data['payment_profile_id'] =$payment_profile_id;
                    $data['phone_number'] = $this->input->post('phone_number');
                    $data['deposit'] = $this->session->userdata('deposit');
                    $data['paid_amount'] = $this->session->userdata('paid_amount');
                    $data['total_amount'] = $this->session->userdata('total_amount');
                    $data['total_months'] = $this->input->post('total_months');

                    $data['card_first_name'] = $this->input->post('card_first_name');
                    $data['card_last_name'] = $this->input->post('card_last_name');
                    $data['address'] = $this->input->post('address');
                    $data['city'] = $this->input->post('city');
                    $data['state'] = $this->input->post('state');
                    $data['country'] = $this->input->post('country');
                    $data['zip_code'] = $this->input->post('zip_code');
                    $data['created'] = date('Y-m-d H:i:s');

                   //echo '<pre>'; print_r($data); die();
                    $saved = $this->comman_model->save('request_property',$data);
                    if($saved){
                        foreach ($request_payments_data as $payments_data) {
                          $this->comman_model->save('request_payments', array(
                              'request_id' => $saved,
                              'amount_due' => $payments_data['amount_due'],
                              'due_date' => $payments_data['due_date']
                            
                            ));
                        }

                        
                                $subject = 'TheBindel.com- Congratulations! You Received a Request to Rent Your Space';
                                $message = '<html>
                                  <body bgcolor="#EDEDEE">
                                  <p><strong>Hello '.$host[0]['name'].'!</strong></p>
                                  <p style="margin-top:20px;">The body of the email should say: Please log into your TheBindel.com account.</p>
                                  <p style="margin-top:20px;">After choosing Received Requests,please click the link“Pending” to view the Transaction Details.</p>
                                  </body>
                                  </html>';
                        do_email($host[0]['email'], $this->session->userdata('email'), $subject, $message);                
                        $this->session->unset_userdata('request_data');
                        $this->session->set_flashdata('success','Your request has been sent successfully.');
                        redirect('requests/send_requests');
                    }else{
                        $this->session->set_flashdata('errors','Your requests not sended, Please try later.');
                        redirect('properties/property_detail/'.$this->uri->segment(3));
                    }
            }

        }
           
            //$property_data = $this->comman_model->get('properties',array('property_id' => $property_id), 'price, date_from, date_to');
            $this->_data['deposit']  = $deposit = $property_data[0]['price'];
            $request_data = $this->session->userdata('request_data');
            //echo '<pre>'; print_r($request_data['check_out_date']); echo '</pre>'; die();
            $this->session->set_userdata('deposit',$deposit);

            if($request_data['check_in_date'] != ''){
              $property_data[0]['date_from'] = strtotime($request_data['check_in_date']);
            }
            if($request_data['check_out_date'] != ''){
              $property_data[0]['date_to'] = strtotime($request_data['check_out_date']) - 86400;
            }
            //echo date('Y-m-d',$property_data[0]['date_to']); die;
            $months_rent = array();
            $request_payments_data = array();
            
            if( date('Y-m',$property_data[0]['date_from']) == date('Y-m',$property_data[0]['date_to']) ){
                $days_of_start_month = cal_days_in_month(CAL_GREGORIAN,date('m', $property_data[0]['date_from']),date('Y', $property_data[0]['date_from']));
                $remaining_days_of_start_month = ($property_data[0]['date_to'] - $property_data[0]['date_from'])/(60*60*24);
                $remaining_days_of_start_month++;
                $months_rent['1st'] = round(($deposit/$days_of_start_month)*$remaining_days_of_start_month, 2);
                
                $due_date = $property_data[0]['date_from'];

                $request_payments_data[] = array('amount_due' => $months_rent['1st']+$deposit,'due_date' => $due_date);
                $this->session->set_userdata('request_payments_data', $request_payments_data);
                $this->session->set_userdata('paid_amount', $months_rent['1st']);
                $this->session->set_userdata('total_amount', $months_rent['1st']);
            } 
            else{
                $days_of_start_month = cal_days_in_month(CAL_GREGORIAN,date('m', $property_data[0]['date_from']),date('Y', $property_data[0]['date_from']));
                
                $remaining_days_of_start_month = $days_of_start_month - date('d', $property_data[0]['date_from']);
                $remaining_days_of_start_month++;

                $days_of_end_month = cal_days_in_month(CAL_GREGORIAN,date('m', ($property_data[0]['date_to'])),date('Y', $property_data[0]['date_to']));
                
                $remaining_days_of_end_month = date('d', $property_data[0]['date_to']);
                
                $months_rent['1st'] = round(($deposit/$days_of_start_month)*$remaining_days_of_start_month, 2);
                
                $due_date = $property_data[0]['date_from'];
                $request_payments_data[] = array('amount_due' => $months_rent['1st']+$deposit,'due_date' => $due_date);
                $due_date = $due_date+(($remaining_days_of_start_month)*24*60*60);
                
                $paid_amount = $months_rent['1st'];
                $total_amount = $months_rent['1st'];

                $d1 = new DateTime(date('Y-m-d', $property_data[0]['date_from']));
                $d2 = new DateTime(date('Y-m-d', $property_data[0]['date_to']) );
                //print_r($d1); 
                //print_r($d2); 
                //die();
                $difference = $d1->diff($d2);
                $months_between = $difference->m;
                //echo $difference->m;
                //echo $months_between; die();
                //var_dump($d1->diff($d2)->m + ($d1->diff($d2)->y*12)); // int(8)
                for ($i=2; $i <= $months_between; $i++) {
                    if( $i == 2){
                        //$due_date = $due_date+(($remaining_days_of_start_month)*24*60*60);
                        $request_payments_data[] = array('amount_due' => $deposit,'due_date' => $due_date);
                        $d=cal_days_in_month(CAL_GREGORIAN,date('m',$due_date),date('Y',$due_date));
                        $due_date = $due_date+($d*24*60*60);
                        $months_rent[$i.'nd'] = $deposit;
                        $total_amount += $deposit;
                    }
                    if( $i == 3){
                        $request_payments_data[] = array('amount_due' => $deposit,'due_date' => $due_date);
                        $d=cal_days_in_month(CAL_GREGORIAN,date('m',$due_date),date('Y',$due_date));
                        $due_date = $due_date+($d*24*60*60);
                        $months_rent[$i.'rd'] = $deposit;
                        $total_amount += $deposit;
                    }
                    if( $i > 3){
                      $request_payments_data[] = array('amount_due' => $deposit,'due_date' => $due_date);
                      $d=cal_days_in_month(CAL_GREGORIAN,date('m',$due_date),date('Y',$due_date));
                      $due_date = $due_date+($d*24*60*60);
                      $months_rent[$i.'th'] = $deposit;
                      $total_amount += $deposit; 
                    }
                }
                
                $months_rent[$i.'th'] = round(($deposit/$days_of_end_month)*$remaining_days_of_end_month, 2);
                $total_amount += $months_rent[$i.'th'];
                $d=cal_days_in_month(CAL_GREGORIAN,date('m',$due_date),date('Y',$due_date));
                //$due_date = $due_date+($d*24*60*60);
                $request_payments_data[] = array('amount_due' => $months_rent[$i.'th'],'due_date' => $due_date);

                $this->session->set_userdata('request_payments_data', $request_payments_data);
                $this->session->set_userdata('paid_amount', $paid_amount);
                $this->session->set_userdata('total_amount', $total_amount );
            }
            //echo '<pre>'; print_r($this->session->userdata('request_payments_data')); die();
             
       
        $this->_data['months_rent']  = $months_rent;
        $this->_data['main_content'] = 'frontend/requests/request_step_two';
        $this->__loadView(); 
      }  
    }

    function received_requests(){
        $start_from = $this->uri->segment(3);
        if (!is_numeric($start_from))
            $start_from = 0;
        $where = array('receiver_id' => $this->session->userdata('user_id'),'receiver_delete' => 0);
        $total = $this->request_model->get_total($where);
        $per_page = 10;
        $num_links = 4;
        $uri_segment = 3;
        $this->_data['pagination'] = paginate(base_url() . 'requests/received_requests/', $total, $per_page, $num_links, $uri_segment);
        
        $this->_data['results'] = $this->request_model->get_send_requests($per_page, $start_from,$where);
        $this->comman_model->update('request_property',$where,array('is_viewed' => 1));
        //echo "<pre>"; print_r($this->data['results']); die();
        $this->_data['main_content'] = 'frontend/requests/received_requests';
        $this->__loadView();
    }

    function send_requests(){
        $start_from = $this->uri->segment(3);
        if (!is_numeric($start_from))
            $start_from = 0;
        $where = array('sender_id' => $this->session->userdata('user_id'),'sender_delete' => 0);
        $total = $this->request_model->get_total($where);
        $per_page = 10;
        $num_links = 4;
        $uri_segment = 3;
        $this->_data['pagination'] = paginate(base_url() . 'requests/send_requests/', $total, $per_page, $num_links, $uri_segment);
        
        $this->_data['results'] = $this->request_model->get_send_requests($per_page, $start_from,$where);
        //echo "<pre>"; print_r($this->_data['results']); die();
        $this->_data['main_content'] = 'frontend/requests/send_requests';
        $this->__loadView();
    }

    function delete(){
        $id = decode_uri($this->uri->segment(4));
        $where = array('request_id' => $id);
        $deleted = $this->comman_model->delete('request_property',$where);
        if($deleted){
            $this->session->set_flashdata('success','Request Deleted Successfully.');
            redirect($_SERVER['HTTP_REFERER']);
        }
        $this->session->set_flashdata('errors','Requeste not deleted,please try later.');
        redirect($_SERVER['HTTP_REFERER']); 
    }
    
    function cancelRequest(){
       $id = decode_uri($this->uri->segment(4));
        $where = array('request_id' => $id);
        date_default_timezone_set('US/Eastern');
        $cancel_time = date('Y-m-d H:i:s');
        $updated = $this->comman_model->update('request_property',$where,array('cancel_on' => $cancel_time));
        if($updated){
            $this->session->set_flashdata('success','Your Request to Rent has been canceled.');
            redirect($_SERVER['HTTP_REFERER']); 
        }
        $this->session->set_flashdata('errors','Requeste not deleted,please try later.');
        redirect($_SERVER['HTTP_REFERER']); 
    }
    /*function delete(){
        $id = decode_uri($this->uri->segment(4));
        $deleted_by = $this->uri->segment(5);
        $where = array('request_id' => $id);
        $updated = false;
        if($deleted_by == 'r'){
            $updated = $this->comman_model->update('request_property',$where,array('receiver_delete' => 1));        }
        if($deleted_by == 's'){
             $updated = $this->comman_model->update('request_property',$where,array('sender_delete' => 1));
        }
        //$deleted = $this->comman_model->delete('request_property',$where);
        if($updated){
            $this->session->set_flashdata('success','Request Deleted Successfully.');
            redirect($_SERVER['HTTP_REFERER']);
        }
        $this->session->set_flashdata('errors','Requeste not deleted,please try later.');
        redirect($_SERVER['HTTP_REFERER']);
 
    }*/

    function accept(){
        $id = decode_uri($this->uri->segment(4));
        $where = array('request_id' => $id);
        
        $payment_profile_data = $this->comman_model->get('request_property',$where,'profile_id,payment_profile_id,paid_amount,sender_id,property_id');
        $is_rented = $this->comman_model->get('request_property', array('property_id' => $payment_profile_data[0]['property_id'],'check_out_date > '=> time(),'request_status'=> 1,'cancel_on'=> 0));
        if($is_rented){
          $this->session->set_flashdata('errors','Requeste not accepted,property is already on rent.');
          redirect('requests/received_requests/'.$this->uri->segment(3));
        }
       // print_r($payment_profile_data); 
       // die();
/*
  $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
  $merchantAuthentication->setName("5S3Bfx577");
  $merchantAuthentication->setTransactionKey("32PkHGYK594e9zgj");
  $refId = 'ref' . time();

  $profileToCharge = new AnetAPI\CustomerProfilePaymentType();
  $profileToCharge->setCustomerProfileId($payment_profile_data[0]['profile_id']);
  $paymentProfile = new AnetAPI\PaymentProfileType();
  $paymentProfile->setPaymentProfileId($payment_profile_data[0]['payment_profile_id']);
  $profileToCharge->setPaymentProfile($paymentProfile);


  $transactionRequestType = new AnetAPI\TransactionRequestType();
  $transactionRequestType->setTransactionType( "authCaptureTransaction"); 
  $transactionRequestType->setAmount($payment_profile_data[0]['paid_amount']);
  $transactionRequestType->setProfile($profileToCharge);

  $request = new AnetAPI\CreateTransactionRequest();
  $request->setMerchantAuthentication($merchantAuthentication);
  $request->setRefId( $refId);
  $request->setTransactionRequest( $transactionRequestType);
  $controller = new AnetController\CreateTransactionController($request);
  $response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);
  if ($response != null)
  {
    $tresponse = $response->getTransactionResponse();
    if (($tresponse != null) && ($tresponse->getResponseCode()=="1") )   
    {
      $Profile_auth_code = $tresponse->getAuthCode();
      $teansection_id =  $tresponse->getTransId();
    }
    elseif (($tresponse != null) && ($tresponse->getResponseCode()=="2") )
    {
      $error =  "ERROR" . "\n";
    }
    elseif (($tresponse != null) && ($tresponse->getResponseCode()=="4") )
    {
        $error .= "ERROR: HELD FOR REVIEW:"  . "\n";
        redirect('requests/received_requests/'.$this->uri->segment(3));
    }
  }
  else
  {
    $error = "no response returned";
    redirect('requests/received_requests/'.$this->uri->segment(3));
  }
//echo $teansection_id; die();
 */
        date_default_timezone_set('US/Eastern');
        $accepted_time = date('Y-m-d H:i:s');
        $updated = $this->comman_model->update('request_property',$where,array('request_status' => 1,'modified' => $accepted_time));
        
        if($updated){
            $message = 'Congratulations! Please use our messaging feature to coordinate entry.';
            $receiver_id = $payment_profile_data[0]['sender_id'];
            $property_id = $payment_profile_data[0]['property_id'];
            $thread_id = $this->messages_model->get_thread_id($this->session->userdata('user_id'),$receiver_id,$property_id,$message);
            if($thread_id){
              $message_data = array(
                  'thread_id' => $thread_id,
                  'sender_id' => $this->session->userdata('user_id'),
                  'receiver_id' => $receiver_id,
                  'message'    => $message,
                  'property_id'    => $property_id,
                  'updated_on'    => date('Y-m-d H:i:s')
              );
            }
            $saved = $this->comman_model->save('messages',$message_data);
            $this->session->set_flashdata('success','Congratulations! Your Request to Rent has been accepted.  Please use our messaging feature to coordinate entry.  If you need any assistance, please do not hesitate to Contact Us, as we are here to help!');
            redirect('requests/received_requests/'.$this->uri->segment(3));
        }
        $this->session->set_flashdata('errors','Requeste not accepted,please try later.');
        redirect('requests/received_requests/'.$this->uri->segment(3));
    }

    function reject(){        
        $id = decode_uri($this->uri->segment(4));
        $where = array('request_id' => $id);
        date_default_timezone_set('US/Eastern');
        $rejected_time = date('Y-m-d H:i:s');
        $updated = $this->comman_model->update('request_property',$where,array('request_status' => 2,'modified' => $rejected_time));
        if($updated){
            $this->session->set_flashdata('success','Request Rejected Successfully.');
            redirect('requests/received_requests/'.$this->uri->segment(3));
        }
        $this->session->set_flashdata('errors','Requeste not accepted,please try later.');
        redirect('requests/received_requests/'.$this->uri->segment(3));
    }

    function request_detail_1(){
        $request_id = decode_uri($this->uri->segment(3));
        $result = $this->request_model->received_request_detail($request_id);
        $this->_data['result'] = $result[0];
        $this->_data['main_content'] = 'frontend/requests/request_detail';
        $this->__loadView();
    }

    function request_detail(){
        $request_id = decode_uri($this->uri->segment(3));
        //echo $request_id; die();
        switch ($this->uri->segment(4)){
            case "1":
                $result = $this->request_model->received_request_detail($request_id);
                //echo '<pre>'; print_r($result); die();
                $this->_data['result'] = $result[0];
                $this->_data['main_content'] = 'frontend/requests/request_detail';
                break;
            case "2":
                $result = $this->request_model->sended_request_detail($request_id);
               //echo '<pre>'; print_r(date('m/d/Y',$result[0]['check_in_date'])); die();
                $this->_data['result'] = $result[0];
                $this->_data['main_content'] = 'frontend/requests/request_detail';
                break;
            default:
                $this->session->set_flashdata('errors','Bad requeste!');
                redirect('requests/received_requests');
        }
        $this->__loadView();
    }

    function notification_alerts(){
       $unviewed_requests = $this->request_model->get_notifications();
       echo  $unviewed_requests;
    }

}