<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
# ===============
# Home Controller
# ===============
#
class Home extends CI_Controller
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
        /** RULES FOR SECTION-0 **/
        $this->form_validation->set_rules('description_title', 'listing title', 'trim|required|xss_clean');
        $this->form_validation->set_rules('description_sellerNotes', 'seller notes', 'trim|xss_clean');
        $this->form_validation->set_rules('description_paymentOptions[]', 'payment options', 'trim|xss_clean');
        $this->form_validation->set_rules('description_toggle', 'toggle seller notes on/off', 'trim|required|xss_clean|alpha_numeric');

        /** RULES FOR SECTION-1 **/
        $this->form_validation->set_rules('features[]', 'features', 'trim|xss_clean');
        $this->form_validation->set_rules('features_toggle', 'toggle features on/off', 'trim|required');

        /** RULES FOR SECTION-2 **/
        $this->form_validation->set_rules('photos[]', 'photos', 'trim|xss_clean|valid_imgResource');
        $this->form_validation->set_rules('photos_toggle', 'toggle photo carousel on/off', 'trim|required|alpha_numeric');

        /** RULES FOR SECTION-3 **/
        $this->form_validation->set_rules('specification_title[]', 'specification title', 'trim|xss_clean');
        $this->form_validation->set_rules('specification_label[]', 'specification label', 'trim|xss_clean');
        $this->form_validation->set_rules('specification_toggle', 'specification toggle on/off', 'trim|required|xss_clean');

        /** RULES FOR SECTION-4 **/
        $this->form_validation->set_rules('FAQ_shipping', 'FAQ shipping', 'trim|xss_clean');
        $this->form_validation->set_rules('FAQ_question[]', 'FAQ question', 'trim|xss_clean');
        $this->form_validation->set_rules('FAQ_answer[]', 'FAQ answer', 'trim|xss_clean');
        $this->form_validation->set_rules('FAQ_toggle', 'FAQ toggle on/off', 'trim|required|xss_clean');

        /** OVERRIDE ERROR MESSAGES **/
        $this->form_validation->set_message('required', 'You must enter your %s.');
        $this->form_validation->set_message('min_length', 'Your %s must be at least %s characters long.');
        $this->form_validation->set_message('max_length', 'Your %s cannot exceed %s characters.');
        $this->form_validation->set_message('alpha_numeric', 'Your %s can only contain: letters and numbers.');
        $this->form_validation->set_message('valid_imgResource', 'The URL(s) you enter must link directly to an image.');

        if ($this->form_validation->run() == FALSE) {
            /** Check if the sessions is set **/
            $sessionData = $this->session->all_userdata();
            $sessionSet = (isset($sessionData["temp_template"]) == TRUE ? TRUE : FALSE);
            if ($sessionSet == TRUE) {
                //$this->load->model('Home_Session');
                $temp_template = $sessionData["temp_template"];
                $data["temp_template"] = $sessionData;

                /** DESCRIPTION **/
                $data["description_title"] = $temp_template["description"][0]["title"];
                $data["description_sellerNotes"] = $temp_template["description"][0]["sellerNotes"];
                $data["description_paymentOptions"] = $temp_template["description"][0]["paymentOptions"];
                $data["description_sellerNotes_toggle"] = $temp_template["description"][0]["toggle"];
                /** FEATURES **/
                $data["features"] = $temp_template["features"][0]["features"];
                $data["features_toggle"] = $temp_template["features"][0]["toggle"];
                /** PHOTOS **/
                $data["photos"] = $temp_template["photos"][0]["photos"];
                $data["photos_toggle"] = $temp_template["photos"][0]["toggle"];
                /** SPECIFICATION **/
                $data["specification_title"] = $temp_template["specification"][0]["title"];
                $data["specification_label"] = $temp_template["specification"][0]["label"];
                $data["specification_toggle"] = $temp_template["specification"][0]["toggle"];
                /** FAQ **/
                $data["FAQ_shipping"] = $temp_template["FAQ"][0]["shipping"];
                $data["FAQ_question"] = $temp_template["FAQ"][0]["question"];
                $data["FAQ_answer"] = $temp_template["FAQ"][0]["answer"];
                $data["FAQ_toggle"] = $temp_template["FAQ"][0]["toggle"];

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

                /** LOAD HEAD **/
                $this->load->view('doctype_default');
                /** LOAD HEADER /w LOGIN FORM */
                $this->load->view('header_login', $data);
                /** LOAD CONTENT **/
                $this->load->view('content_home', $data);
                /** SECTION UI **/
                $this->load->view('content_home_section0', $data);
                $this->load->view('content_home_section1', $data);
                $this->load->view('content_home_section2', $data);
                $this->load->view('content_home_section3', $data);
                $this->load->view('content_home_section4', $data);
                /** FOOTER **/
                $this->load->view('footer');

            } elseif ($this->input->post('description_title') !== FALSE) {
                /** DESCRIPTION **/
                $data["description_title"] = $this->input->post('description_title');
                $data["description_sellerNotes"] = $this->input->post('description_sellerNotes');
                $data["description_paymentOptions"] = $this->input->post('description_paymentOptions');
                $data["description_sellerNotes_toggle"] = $this->input->post('description_toggle');
                /** FEATURES **/
                $data["features"] = $this->input->post('features');
                $data["features_toggle"] = $this->input->post('features_toggle');
                /** PHOTOS **/
                $data["photos"] = $this->input->post('photos');
                $data["photos_toggle"] = $this->input->post('photos_toggle');
                /** SPECIFICATION **/
                $data["specification_title"] = $this->input->post('specification_title');
                $data["specification_label"] = $this->input->post('specification_label');
                $data["specification_toggle"] = $this->input->post('specification_toggle');
                /** FAQ **/
                $data["FAQ_shipping"] = $this->input->post('FAQ_shipping');
                $data["FAQ_question"] = $this->input->post('FAQ_question');
                $data["FAQ_answer"] = $this->input->post('FAQ_answer');
                $data["FAQ_toggle"] = $this->input->post('FAQ_toggle');

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

                /** LOAD HEAD **/
                $this->load->view('doctype_default');
                /** LOAD HEADER /w LOGIN FORM */
                $this->load->view('header_login', $data);
                /** LOAD CONTENT **/
                $this->load->view('content_home', $data);
                /** SECTION UI **/
                $this->load->view('content_home_section0', $data);
                $this->load->view('content_home_section1', $data);
                $this->load->view('content_home_section2', $data);
                $this->load->view('content_home_section3', $data);
                $this->load->view('content_home_section4', $data);
                /** FOOTER **/
                $this->load->view('footer');
            } else {
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

                /** LOAD HEAD **/
                $this->load->view('doctype_default');
                /** LOAD HEADER /w LOGIN FORM */
                $this->load->view('header_login', $data);
                /** LOAD CONTENT **/
                $this->load->view('content_home');
                /** SECTION UI **/
                $this->load->view('content_home_section0');
                $this->load->view('content_home_section1');
                $this->load->view('content_home_section2');
                $this->load->view('content_home_section3');
                $this->load->view('content_home_section4');
                /** FOOTER **/
                $this->load->view('footer');
            }
        } else {
            /** =========
             *   SUCCESS
             *  =========
             *
             **/
            function setDate(){
                $month = date("F");
                $dayYear = date("j, Y");

                return substr($month, 0, 3)." ".$dayYear;
            }

            function keepOptions($sessionData, $optionCat, $optionName)
            {
                if(isset($sessionData["temp_template"]["THEME"]["options"])==TRUE)
                {
                    return $sessionData["temp_template"]["THEME"]["options"][$optionCat][$optionName];
                }
                else
                {
                    return '';
                }
            }
            function inputIsArray($inputValue)
            {
                return (is_array($inputValue)==TRUE?array_map("htmlspecialchars",$inputValue):htmlspecialchars($inputValue));
            }

            $sessionData = $this->session->all_userdata('user_data');

            $temp_template = array
            ('temp_template' => array
                (
                    'description' => array
                    (array
                        (
                            'title' => $this->input->post('description_title'),
                            'sellerNotes' => $this->input->post('description_sellerNotes'),
                            'paymentOptions' => $this->input->post('description_paymentOptions'),
                            'toggle' => $this->input->post('description_toggle')
                        )
                    ),
                    'features' => array
                    (array
                        (
                            'features' => inputIsArray($this->input->post('features')),
                            'toggle' => $this->input->post('features_toggle')
                        )
                    ),
                    'photos' => array
                    (array
                        (
                            'photos' => $this->input->post('photos'),
                            'toggle' => $this->input->post('photos_toggle')
                        )
                    ),
                    'specification' => array
                    (array
                        (
                            'title' => inputIsArray($this->input->post('specification_title')),
                            'label' => inputIsArray($this->input->post('specification_label')),
                            'toggle' => $this->input->post('specification_toggle')
                        )
                    ),
                    'FAQ' => array
                    (array
                        (
                            'shipping' => htmlspecialchars($this->input->post('FAQ_shipping')),
                            'question' => inputIsArray($this->input->post('FAQ_question')),
                            'answer' => inputIsArray($this->input->post('FAQ_answer')),
                            'toggle' => $this->input->post('FAQ_toggle')
                        )
                    ),
                    'THEME' => array
                    (array
                        (
                            'name' => "sleekModern",
                            'default' => array
                            (
                                'titleBar' => array
                                (
                                    'BackgroundColor' => '#3f3f3f',
                                    'FontColor' => '#ffffff'
                                ),
                                'specificationsTable' => array
                                (
                                    'BackgroundColorLeft' => '#dddddd',
                                    'FontColorLeft' => '#ffffff',
                                    'BackgroundColorRight' => '#ffffff',
                                    'FontColorRight' => '#3f3f3f'
                                ),
                                'templateOptions' => array
                                (
                                    'BackgroundColorRight' => '#f8f8f8',
                                    'FontColorRight' => '#3f3f3f',
                                    'BackgroundColorLeft' => '#5ab6b9',
                                    'FontColorLeft' => '#f8f8f8',
                                    'FontFamily' => 'Helvetica'
                                )
                            )
                        ),
                            'options' => array
                            (
                                'titleBar' => array
                                (
                                    'BackgroundColor' => keepOptions($sessionData,"titleBar","BackgroundColor"),
                                    'FontColor' => keepOptions($sessionData,"titleBar","FontColor")
                                ),
                                'specificationsTable' => array
                                (
                                    'BackgroundColorLeft' => keepOptions($sessionData,"specificationsTable","BackgroundColorLeft"),
                                    'FontColorLeft' => keepOptions($sessionData,"specificationsTable","FontColorLeft"),
                                    'BackgroundColorRight' => keepOptions($sessionData,"specificationsTable","BackgroundColorRight"),
                                    'FontColorRight' => keepOptions($sessionData,"specificationsTable","FontColorRight")
                                ),
                                'templateOptions' => array
                                (
                                    'BackgroundColorRight' => keepOptions($sessionData,"templateOptions","BackgroundColorRight"),
                                    'FontColorRight' => keepOptions($sessionData,"templateOptions","FontColorRight"),
                                    'BackgroundColorLeft' => keepOptions($sessionData,"templateOptions","BackgroundColorLeft"),
                                    'FontColorLeft' => keepOptions($sessionData,"templateOptions","FontColorLeft"),
                                    'FontFamily' => keepOptions($sessionData,"templateOptions","FontFamily")
                                )
                            )
                    ),
                    'notes' => array
                    (array
                        (
                            'time' => setDate()
                        )
                    )
                ));

            /** SET SESSION **/
            $this->session->set_userdata($temp_template);

            $this->load->helper('string');
            $session_uniqueId = array
            ('unique_id' => array
                (
                    "id" => random_string('unique')
                )
            );
            $this->session->set_userdata($session_uniqueId);

            /** GET SESSION ID */
            $sessionData = $this->session->all_userdata('user_data');
            $temp_template = $sessionData["temp_template"];
            if ($temp_template !== null) {
                redirect('preview/', 'refresh');
            }

        }
    }
    function loadExampleTemplate()
    {
        $temp_template = array
        ('temp_template' => array (
                'description' =>
                    array (
                        0 =>
                            array (
                                'title' => 'Like-New Behringer 802 XENXY 8-Channel Audio Mixer in EXCELLENT condition!',
                                'sellerNotes' => 'Only used like once or twice, and aside from a minor cosmetic blemish the unit is like-new. Also, I went ahead included a couple of 1/4 inch to 8mm cables that are perfect for getting audio to(and from) your computer.',
                                'paymentOptions' =>
                                    array (
                                        0 => 'paypal',
                                    ),
                                'toggle' => 'true',
                            ),
                    ),
                'features' =>
                    array (
                        0 =>
                            array (
                                'features' =>
                                    array (
                                        0 => 'Premium ultra-low noise, high headroom analog mixer',
                                        1 => '2 state-of-the-art XENYX Mic Preamps',
                                        2 => 'Neo-class "British" 3-band EQs',
                                        3 => '1 post fader FX send per channel for external FX devices',
                                        4 => '1 stereo aux return FX applications or as separate stereo input',
                                        5 => 'Main mix outputs separate control room, phones, and stereo CD/Tape outputs',
                                        6 => 'CD/tape inputs assignable to main mix or control room/phone outputs',
                                        7 => 'High-quality components and exceptionally rugged constructed ensure long life',
                                        8 => 'Conceived and designed by BEHRINGER Germany',
                                    ),
                                'toggle' => 'true',
                            ),
                    ),
                'photos' =>
                    array (
                        0 =>
                            array (
                                'photos' =>
                                    array (
                                        0 => 'http://i.imgur.com/klt407v.jpg',
                                        1 => 'http://i.imgur.com/R6BGQ3b.jpg',
                                        2 => 'http://i.imgur.com/3xHuIVH.jpg',
                                    ),
                                'toggle' => 'true',
                            ),
                    ),
                'specification' =>
                    array (
                        0 =>
                            array (
                                'title' =>
                                    array (
                                        0 => 'Number of Inputs',
                                        1 => 'Type',
                                        2 => 'Phantom Power',
                                        3 => 'Product Dimensions',
                                        4 => '(metric)',
                                        5 => 'Power Supply',
                                        6 => 'Product Weight',
                                        7 => '(metric)',
                                    ),
                                'label' =>
                                    array (
                                        0 => '8 Inputs',
                                        1 => 'XLR Connector',
                                        2 => '+48 Phantom',
                                        3 => '10.3 x 4.2 x 13.3 inches',
                                        4 => '47 x 189 x 220 millimeters',
                                        5 => '120V~60hz',
                                        6 => '3.5 pounds',
                                        7 => '1.58 kilograms',
                                    ),
                                'toggle' => 'true',
                            ),
                    ),
                'FAQ' =>
                    array (
                        0 =>
                            array (
                                'shipping' => '',
                                'question' =>
                                    array (
                                        0 => 'After I buy this item how long will it take to ship?',
                                        1 => 'How are my items packaged?',
                                    ),
                                'answer' =>
                                    array (
                                        0 => 'Prior to even listing an item I put together all packing materials aside for the product, so once your payment goes through I can have it shipped within 24 hours. Typically speaking the item gets posted that same day.',
                                        1 => 'With great care I ensure each item is shipped using appropriate materials to avoid damaged cause by transit. For example, products sensitive to static electroshock such as computer components and electronics are packed up using anti-static bags, bubble wrap, etc.',
                                    ),
                                'toggle' => 'true',
                            ),
                    ),
                'THEME' =>
                    array (
                        0 =>
                            array (
                                'name' => 'sleekModern',
                                'default' =>
                                    array (
                                        'titleBar' =>
                                            array (
                                                'BackgroundColor' => '#3f3f3f',
                                                'FontColor' => '#ffffff',
                                            ),
                                        'specificationsTable' =>
                                            array (
                                                'BackgroundColorLeft' => '#dddddd',
                                                'FontColorLeft' => '#ffffff',
                                                'BackgroundColorRight' => '#ffffff',
                                                'FontColorRight' => '#3f3f3f',
                                            ),
                                        'templateOptions' =>
                                            array (
                                                'BackgroundColorRight' => '#f8f8f8',
                                                'FontColorRight' => '#3f3f3f',
                                                'BackgroundColorLeft' => '#5ab6b9',
                                                'FontColorLeft' => '#f8f8f8',
                                                'FontFamily' => 'Helvetica',
                                            ),
                                    ),
                            ),
                        'options' =>
                            array (
                                'titleBar' =>
                                    array (
                                        'BackgroundColor' => '#3f3f3f',
                                        'FontColor' => '#ffffff',
                                    ),
                                'specificationsTable' =>
                                    array (
                                        'BackgroundColorLeft' => '#dddddd',
                                        'FontColorLeft' => '#ffffff',
                                        'BackgroundColorRight' => '#ffffff',
                                        'FontColorRight' => '#3f3f3f',
                                    ),
                                'templateOptions' =>
                                    array (
                                        'BackgroundColorRight' => '#f8f8f8',
                                        'FontColorRight' => '#3f3f3f',
                                        'BackgroundColorLeft' => '#4f71a4',
                                        'FontColorLeft' => '#f8f8f8',
                                        'FontFamily' => 'Helvetica',
                                    ),
                            ),
                    ),
                'notes' =>
                    array (
                        0 =>
                            array (
                                'time' => 'Apr 16, 2015',
                            ),
                    ),
            ));

        $this->session->set_userdata($temp_template);
        redirect('/', 'refresh');
    }
    function startNewTemplate()
    {
        $this->session->unset_userdata('temp_template');
        redirect('/', 'refresh');
    }
}