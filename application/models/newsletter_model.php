<?php

Class Newsletter_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }
    function getEmail($validEmail)
    {
        $sql = "SELECT user_email FROM email_list WHERE user_email='".$validEmail."'";
        $query = $this->db->query($sql);
        return ($query->num_rows(0)==0?FALSE:TRUE);
    }
    function setEmail($userInfo)
    {
        $this->db->insert('ehg_emailList',$userInfo);
    }
    function lookupDownloadHash($downloadHash)
    {
        $sql = "SELECT download_hash FROM email_list WHERE download_hash='".$downloadHash.'"';
        $query =$this->db->query($sql);
        if($query->num_rows(0)==0)
        {
            return FALSE;
        }
        else
        {
            $sql_update = "UPDATE email_list SET verify_email='true' WHERE download_hash='".$downloadHash.'"';
            $this->db->query($sql_update);
            return TRUE;
        }
    }
    function unsubscribe($validEmail)
    {
        $sql = "SELECT user_email FROM email_list WHERE user_email='".$validEmail."'";
        $query = $this->db->query($sql);
        $result = ($query->num_rows(0)==0?FALSE:TRUE);
        if($result==FALSE)
        {
            return FALSE;
        }
        else
        {
            $deleteRow = "DELETE FROM email_list WHERE email='".$validEmail."'";
            $this->db->query($deleteRow);
            return TRUE;
        }
    }
}