<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 11/11/14
 * Time: 6:40 PM
 */
class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('form');
    }
    public function index()
    {
        redirect('/','refresh');
    }
    public function create_new_account()
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

        $this->load->view('doctype_default');
        $this->load->view('header_login', $data);

        $this->load->helper(array('form', 'url'));
        $this->load->helper('string');
        $this->load->database();

        /** REPLACE BEFORE PRODUCTION  **/
        /** IS_UNIQUE: username AND email **/
        $this->form_validation->set_rules('username','username','trim|required|min_length[8]|max_length[30]|alpha_numeric|xss_clean|is_unique[ehg_accounts.username]');
        /********************************/
        $this->form_validation->set_rules('email', 'e-mail address','trim|required|valid_email|xss_clean|is_unique[ehg_accounts.email]|matches[emailconf]');
        $this->form_validation->set_rules('emailconf', 'e-mail confirmation','trim|required]|valid_email|xss_clean');
        $this->form_validation->set_rules('password', 'password(s)', 'trim|required|min_length[8]|max_length[255]|alpha_dash|xss_clean|matches[passconf]');
        $this->form_validation->set_rules('passconf', 'password confirmation', 'trim|required|min_length[8]|max_length[255]|xss_clean|alpha_dash');
        $this->form_validation->set_rules('hidden_password','hidden','trim|required|xss_clean|max_length[4]');

        $this->form_validation->set_message('is_unique', "We're sorry, the %s you have enter was already taken.");
        $this->form_validation->set_message('required', 'You must enter a %s.');
        $this->form_validation->set_message('min_length', 'Your %s must be at least %s characters long.');
        $this->form_validation->set_message('max_length', 'Your %s cannot exceed %s characters.');
        $this->form_validation->set_message('matches', 'The %s you entered did not match!');
        $this->form_validation->set_message('alpha_dash', 'Your %s can only contain: letters, numbers, underscores(_), and dashes(-).');


        if ($this->form_validation->run() == FALSE)
        {

            /** FAILURE **/
            $data["updateForm"] = ($this->input->post('hidden_password')!=null?"true":"false");
            $this->load->view('content_newAccount',$data);
        }
        else
        {
            /** SUCCESS **/
            $input_data = array(
                "username" => $this->input->post('username'),
                "password" => $this->input->post('password'),
                "email" => $this->input->post('email')
            );
            $data["updateForm"] = ($this->input->post('hidden_password')!=null?"true":"false");

            $this->load->model('User_Accounts');
            $this->User_Accounts->insert_account($input_data);

            $login_token = array('token' => random_string('alnum', 9));
            $session_data["login_token"] = $login_token;

            $this->session->set_userdata($session_data);
            $this->User_Accounts->setLoginToken($input_data["username"], $login_token['token']);

            redirect('dashboard/', 'refresh');
        }
        $this->load->view('footer');
    }
    public function resetPassword()
    {
        $session_data = $this->session->all_userdata();
        $login_token = (isset($session_data['login_token']['token'])?$session_data['login_token']['token']:false);

        $this->form_validation->set_rules('username_forgot','username','trim|required|min_length[8]|max_length[12]|alpha_numeric|xss_clean');
        $this->form_validation->set_rules('email_forgot','e-mail address','trim|required|valid_email|xss_clean|max_length[255]');
        $this->form_validation->set_rules('newPassword', 'password(s)', 'trim|required|min_length[8]|max_length[255]|alpha_dash|xss_clean|matches[newPasswordConf]');
        $this->form_validation->set_rules('newPasswordConf', 'password confirmation', 'trim|required|min_length[8]|max_length[255]|xss_clean|alpha_dash');

        $this->form_validation->set_message('required', 'You must enter your %s.');
        $this->form_validation->set_message('min_length', 'Your %s must be at least %s characters long.');
        $this->form_validation->set_message('max_length', 'Your %s cannot exceed %s characters.');
        $this->form_validation->set_message('alpha_numeric', 'Your %s can only contain: letters and numbers.');

        if($login_token!=false)
        {
            redirect('/','refresh');
        }
        if ($this->form_validation->run() == FALSE)
        {
            // If form validation fails
            $this->load->view('doctype_default');
            $this->load->view('header_login');
            $this->load->view('content_resetPassword');
            $this->load->view('footer');
        }
        else
        {
            $this->load->model('User_Accounts');

            $inputUsername = $this->input->post('username_forgot');
            $inputEmail    = $this->input->post('email_forgot');

            $getUsername = $this->User_Accounts->getUsername($inputUsername);
            $getEmail    = $this->User_Accounts->getEmail($inputEmail);

            if($getUsername == FALSE || $getEmail == FALSE)
            {
                // Fail if either the 'username' or 'email' isn't in the database
                $data["fail_username"] = ($getUsername==false?"Nobody has registered that username yet.":"");
                $data["fail_email"]    = ($getEmail==false?"We don't have that e-mail address on-file.":"");

                $this->load->view('doctype_default');
                $this->load->view('header_login');
                $this->load->view('content_resetPassword',$data);
                $this->load->view('footer');
            }
            else
            {
                $this->load->library('encrypt');
                $inputPassword = $this->input->post('newPasswordConf');

                $getMatchResults = $this->User_Accounts->resetPassword($inputUsername,$inputEmail,$inputPassword);
                if($getMatchResults == FALSE)
                {
                    $data["fail_match"] = "That username wasn't registered with the e-mail you entered.";

                    $this->load->view('doctype_default');
                    $this->load->view('header_login');
                    $this->load->view('content_resetPassword',$data);
                    $this->load->view('footer');
                }
                else
                {
                    $login_token = array('token' => random_string('alnum', 9));
                    $session_data["login_token"] = $login_token;

                    $this->session->set_userdata($session_data);
                    $this->User_Accounts->setLoginToken($inputUsername, $login_token['token']);

                    redirect('dashboard/', 'refresh');
                }
            }
        }
    }
    function login()
    {
        $session_data = $this->session->all_userdata();
        $login_token = (isset($session_data['login_token']['token'])?$session_data['login_token']['token']:false);

        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[8]|max_length[12]|alpha_numeric|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|max_length[255]|xss_clean|alpha_dash');

        if ($this->form_validation->run() == FALSE)
        {
            $data["login_token"] = $login_token;

            $this->load->view('doctype_default');
            $this->load->view('content_login',$data);
            $this->load->view('footer');
        }
        else
        {
            $this->load->library('encrypt');

            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $this->load->model('User_Accounts');
            $login_status = $this->User_Accounts->setLoginStatus($username, $password);

            if($login_status==FALSE)
            {
                $getUsername = $this->User_Accounts->getUsername($username);
                $data["login_error"] = ($getUsername==TRUE?"Sorry, that password isn't correct.":"Username does not exist.");

                $this->load->view('doctype_default');
                $this->load->view('content_login',$data);
                $this->load->view('footer');
            }
            else
            {
                $this->load->library('encrypt');

                $userdata = $this->session->all_userdata();
                $login_token = array('token' => random_string('alnum', 9));
                $userdata["login_token"] = $login_token;

                $this->session->set_userdata($userdata);
                $this->User_Accounts->setLoginToken($username, $login_token['token']);

                redirect('dashboard/', 'refresh');
            }
        }
    }
    function logout()
    {
        $session_data = $this->session->all_userdata();
        $login_token = (isset($session_data['login_token']['token'])?$session_data['login_token']['token']:false);

        $this->load->model('User_Accounts');
        $getLoginStatus = ($login_token==true?$this->User_Accounts->getLoginStatus($login_token):false);

        if($getLoginStatus == true)
        {
            $this->User_Accounts->logoutUser($login_token);
            $this->session->sess_destroy();
            redirect('home/', 'refresh');
        }
    }
}