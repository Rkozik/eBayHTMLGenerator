<?php

Class Download_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }
    function get_sessionStatus($session_id)
    {
        # Is the session set?
        # If so, is the 'temp_template' filled out?
        $sessionData = $this->session->userdata($session_id);
        return ($sessionData["temp_template"]!=NULL?TRUE:FALSE);
    }
    function getTemplate($session_id)
    {
        $sql = "SELECT user_data FROM ci_sessions WHERE session_id='".$session_id."'";
        $query = $this->db->query($sql);
        $user_data = $query->result_array();
        $temp_template = unserialize($user_data[0]["user_data"]);
        if(!isset($temp_template["temp_template"]))
        {
            return FALSE;
        }
        else
        {
            return $temp_template["temp_template"];
        }
    }
    function lookupDownloadHash($downloadHash)
    {
        $sql = "SELECT download_hash FROM email_list WHERE download_hash='".$downloadHash."'";
        $query = $this->db->query($sql);
        if($query->num_rows(0)==0)
        {
            # INVALID HASH
            # ============
            #
            return false;
        }
        else
        {
            # UPDATE VERIFIED STATUS
            # ======================
            #
            $sql = "UPDATE email_list SET verify_email='true' WHERE download_hash='".$downloadHash."'";
            $this->db->query($sql);
            return true;
        }
    }
}