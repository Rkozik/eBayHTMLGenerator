<?php
Class Preview_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }
    function get_sessionStatus($session_id)
    {
        # Is the session set?
        # If so, is the 'temp_template' filled out?
        $sessionData = $this->session->userdata($session_id);
        return (isset($sessionData["temp_template"])==TRUE?TRUE:FALSE);
    }
    function get_description()
    {
        # ========
        # Children
        # ========
        # _title,_sellerNotes,_paymentOptions,_toggle
        #
        $temp_template = $this->session->all_userdata();
        return $temp_template["temp_template"]["description"][0];
    }
    function get_features()
    {
        # _features,_toggle
        #
        $temp_template = $this->session->all_userdata();
        return $temp_template["temp_template"]["features"][0];
    }
    function get_photos()
    {
        # _photos,_toggle
        #
        $temp_template = $this->session->all_userdata();
        return $temp_template["temp_template"]["photos"][0];
    }
    function get_specifications()
    {
        # _title,_label,_toggle
        #
        $temp_template = $this->session->all_userdata();
        return $temp_template["temp_template"]["specification"][0];
    }
    function get_FAQ()
    {
        # _question,_answer,_toggle
        #
        $temp_template = $this->session->all_userdata();
        return $temp_template["temp_template"]["FAQ"][0];
    }
    function get_themeName()
    {
        # name
        #
        $temp_template = $this->session->all_userdata();
        return $temp_template["temp_template"]["THEME"][0];
    }
    function get_themeOptions()
    {
        # _options
        #
        $temp_template = $this->session->all_userdata();
        return $temp_template["temp_template"]["THEME"]["options"];
    }
}