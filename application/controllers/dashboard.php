<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 1/16/15
 * Time: 3:03 PM
 */
Class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('form');

    }
    function index(){
        $session_data = $this->session->all_userdata();
        $login_token = (isset($session_data['login_token']['token'])?$session_data['login_token']['token']:false);

        $this->load->model('User_Accounts');
        $getLoginStatus = ($login_token!=false?$this->User_Accounts->getLoginStatus($login_token):false);

        if($getLoginStatus==FALSE)
        {
            # HANDLE ERROR
            # ============
            #
            redirect('/','refresh');
        }
        else
        {
            # LOAD CORRESPONDING USER's DASHBOARD
            # ===================================
            #
            //$getTemplates = $this->User_Accounts->getTemplates($login_token);
            $getTempTemplate = '';
            $getSelectedTemplate = '';

            $data['Temp_template'] = $getTempTemplate;
            $data['Saved_templates'] = "";
            $data['Selected_template'] = $getSelectedTemplate;

            /** CHECK LOGIN STATUS */
            $session_data = $this->session->all_userdata();
            $login_token = (isset($session_data['login_token']['token'])?$session_data['login_token']['token']:false);

            $this->load->model('User_Accounts');
            $getLoginStatus  = ($login_token!=false?$this->User_Accounts->getLoginStatus($login_token):false);
            $getUsername     = ($login_token!=false?$this->User_Accounts->getUsernameByToken($login_token):false);
            $getAllTemplates = $this->User_Accounts->getAllTemplates($getUsername);
            $getCurrentPage  = "dashboard";

            $data["login_status"]   = ($getLoginStatus==true?true:false);
            $data["username"]       = $getUsername;
            $data["currentPage"]    = $getCurrentPage;

            $data["currentTemplateName"] = (isset($session_data['current_template'])?$session_data['current_template']:"");
            $data["unsavedTemplateName"] = (isset($session_data["temp_template"]["description"][0]["title"])?$session_data["temp_template"]["description"][0]["title"]:"");
            $data["savedTemplates"]      = $getAllTemplates;
            $data["templateNames"]       = ($getAllTemplates==false?array():array_keys($getAllTemplates));

            /** LOAD TEMPLATE  HTML **/
            function file_get_contents_curl($url) {
                $ch = curl_init();

                curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

                $data = curl_exec($ch);
                curl_close($ch);

                return $data;
            }
            $session = $this->session->all_userdata('');
            $unique_id = $session["session_id"];

            $templateRaw = file_get_contents_curl('http://ebayHTMLgenerator/download/getTemplate/'.$unique_id);

            $data["template"] = preg_replace('/(\s\s+|\t|\n)/', ' ', $templateRaw);


            $this->load->view('doctype_default');
            $this->load->view('header_login', $data);
            $this->load->view('content_dashboard');
                $this->load->view('content_dashboard_section0', $data);
                $this->load->view('content_dashboard_section1', $data);
                $this->load->view('content_dashboard_section2', $data);
            $this->load->view('footer');
        }
    }
    function saveTemplate()
    {
        $this->form_validation->set_rules('template_name', 'title', 'trim|required|xss_clean');
        $this->form_validation->set_message('required', 'Whoops, looks like you forgot to give your template a %s!');

        if ($this->form_validation->run() == FALSE)
        {
            echo form_error('template_name');
        }
        else
        {
            $template_name = htmlspecialchars($this->input->post('template_name'));
            $session_data = $this->session->all_userdata();
            $login_token = $session_data['login_token']['token'];

            if(isset($session_data['temp_template'])==true)
            {
                $this->load->model('User_Accounts');
                $username = $this->User_Accounts->getUsernameByToken($login_token);

                $current_template = array
                (
                    'current_template' =>  $template_name
                );

                $this->session->set_userdata($current_template);

                echo ($this->User_Accounts->saveTemplate($username, $template_name, $session_data['temp_template']));
            }
            else
            {
                echo "Whoops, looks like you had no template for us to save!";
            }
        }
    }
    function loadTemplate()
    {
        $this->form_validation->set_rules('templateSelection_id', 'Template ID', 'trim|required|xss_clean');
        $this->form_validation->set_message('required', 'Whoops, looks like you forgot to select a listing!');

        $session_data = $this->session->all_userdata();
        $login_token = $session_data['login_token']['token'];

        $this->load->model('User_Accounts');

        if ($this->form_validation->run() == FALSE)
        {
            // FAILURE

            $getLoginStatus  = ($login_token!=false?$this->User_Accounts->getLoginStatus($login_token):false);
            $getUsername     = ($login_token!=false?$this->User_Accounts->getUsernameByToken($login_token):false);
            $getAllTemplates = $this->User_Accounts->getAllTemplates($getUsername);
            $getCurrentPage  = "dashboard";

            $data["login_status"]   = ($getLoginStatus==true?true:false);
            $data["username"]       = $getUsername;
            $data["currentPage"]    = $getCurrentPage;

            $data["currentTemplateName"] = (isset($session_data['temp_template']['description'][0]['title'])?$session_data['temp_template']['description'][0]['title']:"No Template Selected");
            $data["savedTemplates"]      = $getAllTemplates;
            $data["templateNames"]       = ($getAllTemplates==false?array():array_keys($getAllTemplates));

            $this->load->view('doctype_default');
            $this->load->view('header_login', $data);
            $this->load->view('content_dashboard');
                $this->load->view('content_dashboard_section0', $data);
                $this->load->view('content_dashboard_section1', $data);
                $this->load->view('content_dashboard_section2', $data);
            $this->load->view('footer');
        }
        else
        {
            // SUCCESS
            $load_templateID   = $this->input->post('templateSelection_id');

            $this->load->model('User_Accounts');
            $username = $this->User_Accounts->getUsernameByToken($login_token);

            $this->session->unset_userdata('temp_template');

            $load_savedTemplate = $this->User_Accounts->getTemplate($username,$load_templateID);
            $temp_template = array
            (
                'temp_template' => $load_savedTemplate
            );
            $current_template = array
            (
                'current_template' =>  $load_templateID
            );

            $this->session->set_userdata($temp_template);
            $this->session->set_userdata($current_template);

            redirect('dashboard/', 'refresh');
        }
    }
    function startNewTemplate()
    {
        $this->session->unset_userdata('temp_template');
        $this->session->unset_userdata('current_template');
        redirect('dashboard/', 'refresh');
    }
}
