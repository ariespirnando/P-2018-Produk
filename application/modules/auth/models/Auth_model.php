<?php

class Auth_model extends CI_Model {    

    // get all
    public $table = 'erplaning.app_employee';
    public $id = 'iapp_employee';
    public $order = 'DESC';
 
    function cekpw($username,$password){ 
        $this->db->where('vusername', $username);
        $this->db->where('vpassword', $password);  
        $this->db->where('(iactivied', 0, FALSE);
	    $this->db->or_where("iactivied IS NULL)", NULL, FALSE); 
        return $this->db->get($this->table);
    }
     
}