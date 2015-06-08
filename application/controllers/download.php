<?php

Class Download extends CI_Controller
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
        $sessionData = $this->session->all_userdata();
        if(!isset($sessionData["temp_template"]))
        {
            # Template isn't set
            # ==================
            #
            redirect('/', 'refresh');
        }
        else
        {
            # Template is set
            # ===============
            #
            $session_data = $this->session->all_userdata();
            $login_token = (isset($session_data['token'])?$session_data['token']:false);

            $this->load->model('User_Accounts');
            $getLoginStatus = ($login_token!=false?$this->User_Accounts->getLoginStatus($login_token):false);

            /** User isn't logged in **/
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
            $session = $this->session->all_userdata();
            $unique_id = $session["session_id"];

            $templateRaw = file_get_contents_curl('http://ebayHTMLgenerator/download/getTemplate/'.$unique_id);

            $data["template"] = preg_replace('/(\s\s+|\t|\n)/', ' ', $templateRaw);
            $data["login_status"] = ($getLoginStatus==FALSE?"FALSE":"TRUE");
            $data["currentTemplateName"] = (isset($session_data['temp_template']['description'][0]['title'])?$session_data['temp_template']['description'][0]['title']:"No Template Selected");

            $this->load->view('doctype_live');
            $this->load->view('header_downloadTemplate');
            $this->load->view('content_download');
            # Wait 60 seconds or sign-up for newsletter
            #
            $this->load->view('content_download_section_notLoggedIn', $data);
            $this->load->view('footer');
        }
    }
    function newsletter()
    {
        //$sessionData = $this->session->all_userdata('user_data');

        $validationError_start = '<div class="validationError-container"><div class="tab-input-border dark-grey"></div><div class="validationError-icon-container"><div class="validationError-icon"></div></div><div class="fullWidth-validationError"><p>';
        $validationError_end = '</p></div><div class="validationError-closeBtn-container"><input type="button" class="validationError-removeBtn"/></div><div class="tab-input-border dark-grey"></div></div>';

        $this->form_validation->set_error_delimiters($validationError_start, $validationError_end);
        $this->form_validation->set_rules('email','email','trim|required|valid_email|matches[userEmail_conf]|xss_clean');
        $this->form_validation->set_rules('email_confirmation','Email Confirmation','trim|required|valid_email|xss_clean');

        # NEW ERROR MESSAGES
        # ==================
        #
        $this->form_validation->set_message('is_unique', "We're sorry, the %s you have enter was already taken.");
        $this->form_validation->set_message('required', 'You must enter a %s.');
        $this->form_validation->set_message('matches', "The %s's you entered do not match!");


        if($this->form_validation->run()==FALSE)
        {
            $this->load->view('doctype_live');
            $this->load->view('header_downloadTemplate');
            $this->load->view('content_download');
            # Wait 60 seconds or sign-up for newsletter
            #
            $this->load->view('content_download_section_notLoggedIn');
            $this->load->view('footer');
        }
        else
        {
            $this->load->model('Newsletter_model');
            $email = $this->input->post('email');
            $getEmail = $this->Newsletter_model->getEmail($email);

            if($getEmail==FALSE)
            {
                $data['page_title'] = "EbayHTMLgenerator - Whoops, that email is in use!";
                $data['error_download'] = "Whoops, looks like that email is already being used!";

                $this->load->view('doctype_live');
                $this->load->view('header_downloadTemplate', $data);
                $this->load->view('content_download');
                # Wait 60 seconds or sign-up for newsletter
                #
                $this->load->view('content_download_section_notLoggedIn', $data);
                $this->load->view('footer');
            }
            else
            {
                $this->load->helper('string');
                $this->load->model('Newsletter_model');
                $userEmail = $this->input->post('email');
                # UPDATE DATABASE
                # ===============
                #
                $userInfo = array(
                    'user_email' => $userEmail,
                    'verify_email' => '',
                    'download_hash' => random_string('unique'),
                    'timestamp' => date("Y-m-d H:i:s")
                );
                $this->Newsletter_model->setEmail($userInfo);
                # SEND VERIFICATION EMAIL
                # =======================
                #
                #$getUniqueHash = $userInfo['download_hash'];

                $ci = get_instance();
                $ci->load->library('email');
                $config['protocol'] = "smtp";
                $config['smtp_host'] = "ssl://smtp.gmail.com";
                $config['smtp_port'] = "465";
                $config['smtp_user'] = "your.account@gmail.com";
                $config['smtp_pass'] = "password";
                $config['charset'] = "utf-8";
                $config['mailtype'] = "html";
                $config['newline'] = "\r\n";
                $ci->email->initialize($config);

                $ci->email->from('your.account@gmail.com', 'Your name');
                $ci->email->to($userEmail);
                $ci->email->subject("");
                $ci->email->message("");
                $ci->email->send();

                # SUCCESS
                # =======
                #
                $data['page_title'] = "EbayHTMLgenerator - Your download link has been sent!";
                $data['error_download'] = "Check your email, your download link has been sent!";

                $this->load->view('doctype_live');
                $this->load->view('header_downloadTemplate', $data);
                $this->load->view('content_download');
                # Wait 60 seconds or sign-up for newsletter
                #
                $this->load->view('content_download_section_notLoggedIn', $data);
                $this->load->view('footer');
            }
        }
    }
    function newsletterDownload($downloadHash)
    {
        if(!isset($downloadHash)){
            redirect(base_url()."home/");
        }
        function isMD5($downloadHash){
            return (bool) strlen($downloadHash) == 32 && ctype_xdigit($downloadHash);
        }
        $this->load->model('Download_model');
        $validDownloadHash = (isMD5($downloadHash)==true?true:false);
        if($validDownloadHash==false ||$this->Download_model->lookupDownloadHash($downloadHash)==false)
        {
            $data['page_title'] = "EbayHTMLgenerator - Something went a miss, we couldn't verify your email.";
            $data['error_download'] = "Something went a miss, we couldn't verify your email.";

            $this->load->view('doctype_live');
            $this->load->view('header_downloadTemplate', $data);
            $this->load->view('content_download');
            # Wait 60 seconds or sign-up for newsletter
            #
            $this->load->view('content_download_section_notLoggedIn', $data);
            $this->load->view('footer');
        }
        else
        {
            # GET DOWNLOAD VIEW
            # =================
            #
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

            $data["template"] = file_get_contents_curl('http://localhost/ebayHTMLgenerator/index.php/download/getTemplate/'.$unique_id);
            $data['page_title'] = "EbayHTMLgenerator - Your download link has been sent!";
            $data['error_download'] = "Check your email, your download link has been sent!";

            $this->load->view('doctype_live');
            $this->load->view('header_downloadTemplate', $data);
            $this->load->view('content_download');
            # Wait 60 seconds or sign-up for newsletter
            #
            $this->load->view('content_download_section_success', $data);
            $this->load->view('footer');

        }
    }
    function getTemplate($session_id)
    {

        $this->load->model('Download_model');
        //$this->load->model('Preview_Model');

        $sessionStatus = $this->Download_model->get_sessionStatus($session_id);

        if($sessionStatus==TRUE)
        {
            /** NO TEMPLATE FOUND **/
        }
        else
        {
            $temp_template = $this->Download_model->getTemplate($session_id);

            $data["description"] =      $temp_template["description"][0];
            $data["features"] =         $temp_template["features"][0];
            $data["photos"] =           $temp_template["photos"][0];
            $data["specifications"] =   $temp_template["specification"][0];
            $data["FAQ"] =              $temp_template["FAQ"][0];

            $themeName = $temp_template["THEME"][0]["name"];
            $data["theme"] =  $temp_template["THEME"][0];
            $data["themeOptions"] = $temp_template["THEME"]["options"];

            /** LOAD CONTENT **/
            $this->load->view('template_'.$themeName, $data);
        }
    }
    function getTemplateHTML()
    {
        $file = file_get_contents('http://localhost/ebayHTMLgenerator/index.php/preview/template/sleekModern');
        var_dump($file);
    }
}