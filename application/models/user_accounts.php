<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 11/12/14
 * Time: 1:17 PM
 */
Class User_Accounts extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    function insert_account($input_data)
    {
        $this->load->library('encrypt');
        $hash_password = MD5($input_data["password"]);
        $templates = array();

        $userData = array(
            'username' => $input_data["username"],
            'password' => $hash_password,
            'email' => $input_data["email"],
            'is_verified' => random_string('alnum', 9),
            'templates' => serialize($templates)
        );

        $this->db->insert('ehg_accounts', $userData);
    }
    function resetPassword($username,$userEmail,$password)
    {
        $this->db->select('username', 'email');
        $this->db->from('ehg_accounts');
        $this->db->where('username',$username);
        $this->db->where('email',$userEmail);
        $this->db->limit(1);

        $query = $this->db->get();
        $result = ($query->num_rows()==1?TRUE:FALSE);
        if($result == TRUE)
        {
            $this->load->library('encrypt');
            $hash_password = MD5($password);
            $data = array('password' => $hash_password);
            $this->db->where('username', $username);
            $this->db->update('ehg_accounts',$data);
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    function getUsername($username){
        $sql = "SELECT username FROM ehg_accounts WHERE username='".$username."'";
        $query = $this->db->query($sql);
        return ($query->num_rows(0)==0?FALSE:TRUE);
    }
    function getEmail($userEmail){
        $sql = "SELECT email FROM ehg_accounts WHERE email='".$userEmail."'";
        $query = $this->db->query($sql);
        return ($query->num_rows(0)==0?FALSE:TRUE);
    }
    function getUsernameEmailMatch($username,$userEmail)
    {
        $this->db->select('username', 'email');
        $this->db->from('ehg_accounts');
        $this->db->where('username',$username);
        $this->db->where('email',$userEmail);
        $this->db->limit(1);

        $query = $this->db->get();
        return ($query->num_rows()==1?TRUE:FALSE);
    }
    function getLoginStatus($login_token)
    {
        /*$sql = "SELECT login_token FROM ehg_accounts WHERE login_token='".$login_token."'";
        $query = $this->db->query($sql);
        return ($query->num_rows(0)==0?FALSE:TRUE);*/
        $this->db->select('login_token');
        $this->db->from('ehg_accounts');
        $this->db->where('login_token',$login_token);
        $this->db->limit(1);
        $query = $this->db->get();
        return ($query->num_rows()==1?TRUE:FALSE);
    }
    function setLoginStatus($username, $password){
        $this->load->library('session');
        $this->load->library('encrypt');

        $this->db->select('username','password');
        $this->db->from('ehg_accounts');
        $this->db->where('username',$username);
        $this->db->where('password', MD5($password));
        $this->db->limit(1);

        $query = $this->db->get();

        return ($query->num_rows()==1?TRUE:FALSE);
    }
    function setLoginToken($username, $token){
        $sql = "UPDATE ehg_accounts SET login_token='".$token."' WHERE username='".$username."'";
        $this->db->query($sql);
    }
    function getUsernameByToken($token)
    {
        $this->db->select('username');
        $this->db->from('ehg_accounts');
        $this->db->where('login_token',$token);
        $this->db->limit(1);

        $query = $this->db->get();
        if($query->num_rows()==1)
        {
            $result = $query->result_array("username");
            return $result[0]["username"];
        }
        else
        {
            // LOOKUP FAILED
            return false;
        }
    }
    function isTemplateNameUnique($username, $template_name)
    {
        $this->db->select('templates');
        $this->db->from('ehg_accounts');
        $this->db->where('username',$username);
        $this->db->limit(1);

        $query = $this->db->get();
        if($query->num_rows()==1)
        {
            $savedTemplates = $query->result_array('templates');
            return ((isset($savedTemplates[0]["templates"][$template_name])==true)?false:true);
        }
        else
        {
            return true;
        }
    }
    function saveTemplate($username, $template_name, $temp_template)
    {
        $this->db->select('templates');
        $this->db->from('ehg_accounts');
        $this->db->where('username',$username);
        $this->db->limit(1);

        $query = $this->db->get();
        if($query->num_rows()==1)
        {
            $savedTemplates = $query->result_array('templates');
            $currentTemplates = unserialize($savedTemplates[0]['templates']);

            $newTemplate = array
            (
                $template_name => $temp_template
            );
            $updatedTemplates = ($currentTemplates==0?$newTemplate:array_merge($currentTemplates,$newTemplate));
            $updateString = serialize($updatedTemplates);

            //$this->db->where('username',$username);
            //$this->db->update('templates',$updateString);

            //$sql = "UPDATE ehg_accounts SET templates='".$updateString."' WHERE username='".$username."'";
            $sql = "UPDATE ehg_accounts SET templates='".$this->db->escape_str($updateString)."' WHERE username='".$username."'";
            $this->db->query($sql);

            return "<p>Your template has been saved!</p>";
        }
        else
        {
            return "You must fill out a template before you can save it!";
        }
    }
    function getTemplate($username, $template_name)
    {
        $this->db->select('templates');
        $this->db->from('ehg_accounts');
        $this->db->where('username',$username);
        $this->db->limit(1);

        $query = $this->db->get();
        if($query->num_rows()==1)
        {
            $savedTemplates = $query->result_array('templates');
            $currentTemplates = unserialize($savedTemplates[0]['templates']);

            return ((isset($currentTemplates[$template_name])==true)?
                           $currentTemplates[$template_name]:
                           "Whoops, the template you specified wasn't found!"
                    );
        }
        else
        {
            return "We're sorry, it doesn't look like you have any templates saved!";
        }
    }
    function getAllTemplates($username)
    {
        $this->db->select('templates');
        $this->db->from('ehg_accounts');
        $this->db->where('username',$username);
        $this->db->limit(1);

        $query = $this->db->get();
        if($query->num_rows()==1)
        {
            $savedTemplates = $query->result_array('templates');
            return unserialize($savedTemplates[0]['templates']);
        }
        else
        {
            return false;
        }
    }
    function logoutUser($token)
    {
        $this->db->select('login_token');
        $this->db->from('ehg_accounts');
        $this->db->where('login_token',$token);
        $this->db->limit(1);

        $query = $this->db->get();
        if($query->num_rows()==1)
        {
            $sql = "UPDATE ehg_accounts SET login_token='' WHERE login_token='".$token."'";
            $this->db->query($sql);

            return true;
        }
        else
        {
            // LOOKUP FAILED
            return false;
        }
    }
}