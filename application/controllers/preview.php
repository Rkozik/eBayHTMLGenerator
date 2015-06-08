<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Preview extends CI_Controller
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

        /** Template Options **/
        $this->form_validation->set_rules('templateOptions-backgroundColorLeft-input', 'Background Color (Left)', 'xss_clean');
        $this->form_validation->set_rules('templateOptions-fontColorLeft-input', 'Font Color (Left)', 'xss_clean');
        $this->form_validation->set_rules('templateOptions-backgroundColorRight-input', 'Background Color (Right)', 'xss_clean');
        $this->form_validation->set_rules('templateOptions-fontColorRight-input', 'Font Color (Right)', 'xss_clean');
        $this->form_validation->set_rules('templateOptions-fontFamily', 'Font-family', 'xss_clean');
        /** Title Bar **/

        /** Specifications Table **/
        $sessionData = $this->session->all_userdata('user_data');
        $sessionID = $sessionData['session_id'];

        $this->load->model('Preview_Model');
        //$sessionStatus = $this->Preview_Model->get_sessionStatus($sessionID);
        $sessionStatus = (isset($sessionData["temp_template"]) == TRUE?TRUE:FALSE);

        if($sessionStatus==FALSE)
        {
            redirect('/', 'refresh');
        }
        else
        {
            if ($this->form_validation->run() == TRUE)
            {
                function validateHexCode($hexcode){
                    if(is_string($hexcode)==TRUE)
                    {
                        if(strpos("#",$hexcode) >=0)
                        {
                            $splitHexCode = explode('#',$hexcode);
                            if(ctype_xdigit($splitHexCode[1]) == TRUE){
                                return "#".$splitHexCode[1];
                            }
                        }
                        else
                        {
                            return "#ffffff";
                        }

                    }
                    else
                    {
                        return "#ffffff";
                    }
                }
                /** TEMPLATE OPTIONS **/
                $templateOptions_backgroundColorLeft = validateHexCode($this->input->post('templateOptions-backgroundColorLeft-input'));
                $templateOptions_fontColorLeft = validateHexCode($this->input->post('templateOptions-fontColorLeft-input'));
                $templateOptions_backgroundColorRight = validateHexCode($this->input->post('templateOptions-backgroundColorRight-input'));
                $templateOptions_fontColorRight = validateHexCode($this->input->post('templateOptions-fontColorRight-input'));

                $splitFontFamily = explode(":", $this->input->post('templateOptions-fontFamily'));
                $templateOptions_fontFamily = (isset($splitFontFamily[1])==TRUE?$splitFontFamily[1]:$this->input->post('templateOptions-fontFamily'));

                $sessionData["temp_template"]["THEME"]["options"]["templateOptions"]["BackgroundColorLeft"] = $templateOptions_backgroundColorLeft;
                $sessionData["temp_template"]["THEME"]["options"]["templateOptions"]["FontColorLeft"] = $templateOptions_fontColorLeft;
                $sessionData["temp_template"]["THEME"]["options"]["templateOptions"]["BackgroundColorRight"] = $templateOptions_backgroundColorRight;
                $sessionData["temp_template"]["THEME"]["options"]["templateOptions"]["FontColorRight"] = $templateOptions_fontColorRight;

                $sessionData["temp_template"]["THEME"]["options"]["templateOptions"]["FontFamily"] = $templateOptions_fontFamily;

                /** TITLE BAR **/
                $titleBar_backgroundColor = validateHexCode($this->input->post('titleBar-backgroundColor-input'));
                $titleBar_fontColor = validateHexCode($this->input->post('titleBar-fontColor-input'));

                $sessionData["temp_template"]["THEME"]["options"]["titleBar"]["BackgroundColor"] = $titleBar_backgroundColor;
                $sessionData["temp_template"]["THEME"]["options"]["titleBar"]["FontColor"] = $titleBar_fontColor;

                /** SPECIFICATIONS TABLE  **/
                $specificationsTable_backgroundColorLeft = validateHexCode($this->input->post('specificationsTable-backgroundColorLeft-input'));
                $specificationsTable_fontColorLeft = validateHexCode($this->input->post('specificationsTable-fontColorLeft-input'));
                $specificationsTable_backgroundColorRight = validateHexCode($this->input->post('specificationsTable-backgroundColorRight-input'));
                $specificationsTable_fontColorRight = validateHexCode($this->input->post('specificationsTable-fontColorRight-input'));

                $sessionData["temp_template"]["THEME"]["options"]["specificationsTable"]["BackgroundColorLeft"] = $specificationsTable_backgroundColorLeft;
                $sessionData["temp_template"]["THEME"]["options"]["specificationsTable"]["FontColorLeft"] = $specificationsTable_fontColorLeft;
                $sessionData["temp_template"]["THEME"]["options"]["specificationsTable"]["BackgroundColorRight"] = $specificationsTable_backgroundColorRight;
                $sessionData["temp_template"]["THEME"]["options"]["specificationsTable"]["FontColorRight"] = $specificationsTable_fontColorRight;

                $this->session->set_userdata($sessionData);
            }

            $data["session_id"] = $sessionID;
            $data["session_data"] = $sessionData;


            $data["theme"] = $this->Preview_Model->get_themeName();
            $data["themeOptions"] = $this->Preview_Model->get_themeOptions();

            /** LOAD HEAD **/
            $this->load->view('doctype_live');
            /** LOAD HEADER /w LOGIN FORM */
            $this->load->view('header_liveDemo');
            /** LOAD CONTENT **/
            $this->load->view('footer_live', $data);

        }
    }
    function ebayContainer()
    {
        $this->form_validation->set_rules('themeSelection','Theme','trim|xss_clean');

        if ($this->form_validation->run() == FALSE)
        {
            # Default eBayContainer iFrame
            $data['themeSelection'] = 'sleekModern';
            $this->load->view('ebayContainer', $data);
        }
        else
        {
            # Update eBayContainer iFrame
            $templateSelection = $this->input->post('themeSelection');

            $sessionData = $this->session->all_userdata('user_data');
            $temp_template = $sessionData["temp_template"];
            $temp_template["theme"][0]["name"] = $templateSelection;
            $this->session->set_userdata($temp_template);

            $data['themeSelection'] = $templateSelection;
            $this->load->view('ebayContainer', $data);
        }
    }
    function template($theme_name)
    {
        $sessionData = $this->session->all_userdata('user_data');
        $sessionID = $sessionData['session_id'];

        $this->load->model('Preview_Model');
        $sessionStatus = $this->Preview_Model->get_sessionStatus($sessionID);

        if($sessionStatus==TRUE)
        {
            /** NO TEMPLATE FOUND **/
        }
        else
        {
            $data["session_id"] = $sessionData["session_id"];
            $data["description"] = $this->Preview_Model->get_description();
            $data["features"] = $this->Preview_Model->get_features();
            $data["photos"] = $this->Preview_Model->get_photos();
            $data["specifications"] = $this->Preview_Model->get_specifications();
            $data["FAQ"] = $this->Preview_Model->get_FAQ();
            $data["theme"] = $this->Preview_Model->get_themeName();
            $data["themeOptions"] = $this->Preview_Model->get_themeOptions();

            /** LOAD CONTENT **/
            $this->load->view('template_'.$theme_name,$data);
        }
    }
    function resetTemplateOptions()
    {
        $sessionData = $this->session->all_userdata('user_data');
        $sessionID = $sessionData['session_id'];

        $this->load->model('Preview_Model');
        $sessionStatus = $this->Preview_Model->get_sessionStatus($sessionID);

        if($sessionStatus!=TRUE)
        {
            $sessionData["temp_template"]["THEME"]["options"]["templateOptions"]["BackgroundColorLeft"] = "";
            $sessionData["temp_template"]["THEME"]["options"]["templateOptions"]["FontColorLeft"] = "";
            $sessionData["temp_template"]["THEME"]["options"]["templateOptions"]["BackgroundColorRight"] = "";
            $sessionData["temp_template"]["THEME"]["options"]["templateOptions"]["FontColorRight"] = "";
            $sessionData["temp_template"]["THEME"]["options"]["templateOptions"]["FontFamily"] = "";

            $sessionData["temp_template"]["THEME"]["options"]["titleBar"]["BackgroundColor"] = "";
            $sessionData["temp_template"]["THEME"]["options"]["titleBar"]["FontColor"] = "";

            $sessionData["temp_template"]["THEME"]["options"]["specificationsTable"]["BackgroundColorLeft"] = "";
            $sessionData["temp_template"]["THEME"]["options"]["specificationsTable"]["FontColorLeft"] = "";
            $sessionData["temp_template"]["THEME"]["options"]["specificationsTable"]["BackgroundColorRight"] = "";
            $sessionData["temp_template"]["THEME"]["options"]["specificationsTable"]["FontColorRight"] = "";

            $this->session->set_userdata($sessionData);
        }
        redirect('preview/', 'refresh');
    }
}