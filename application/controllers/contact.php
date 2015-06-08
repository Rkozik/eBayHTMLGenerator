<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 1/16/15
 * Time: 3:03 PM
 * Notes: This controller is incomplete.
 *
 */
Class Contact extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('form');
    }

    function index()
    {
        /** CHECK LOGIN STATUS */
        $session_data = $this->session->all_userdata();
        $login_token = (isset($session_data['login_token']['token'])?$session_data['login_token']['token']:false);

        $this->load->model('User_Accounts');
        $getLoginStatus = ($login_token!=false?$this->User_Accounts->getLoginStatus($login_token):false);
        $getUsername    = ($login_token!=false?$this->User_Accounts->getUsernameByToken($login_token):false);
        $getCurrentPage = "home";

        $data["login_status"] = ($getLoginStatus==true?true:false);
        $data["username"]     = $getUsername;
        $data["currentPage"]  = $getCurrentPage;

        $this->form_validation->set_rules('contactName','your name','trim|required|xss_clean');
        $this->form_validation->set_rules('contactEmail','email address','trim|required|valid_email|xss_clean');
        $this->form_validation->set_rules('contactSubject','the subject', 'trim|required|xss_clean');
        $this->form_validation->set_rules('contactMessage','a message', 'trim|required|xss_clean');

        $this->form_validation->set_message('required', 'You must enter a %s.');
        $this->form_validation->set_message('valid_email', "Please double check the %s you entered.");

        if ($this->form_validation->run() == FALSE)
        {
            // Form submission failed validation
            $data["validation_failure"] = "Whoa, something went wrong. Please refresh the page and try again.";
        }
        else
        {
            // Form submission passed validation
            $user_name    = $this->input->post('contactName');
            $user_email   = $this->input->post('contactEmail');
            $user_subject = $this->input->post('contactSubject');
            $user_message = $this->input->post('contactMessage');

            $email_status = "";


            $data["email_response"] = $email_status;
        }

        $this->load->view('doctype_default');
        $this->load->view('header_login', $data);
        $this->load->view('content_contact');
        $this->load->view('content_contact_section0',$data);
        $this->load->view('footer');
    }
}