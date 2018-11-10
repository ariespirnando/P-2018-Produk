<?php

class M_karyawan_mod extends CI_Model {    

    // get all
    public $table = 'erplaning.app_employee';
    public $id = 'iapp_employee';
    public $id2 = 'capp_employee';
    public $order = 'DESC';

    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    // get data by id
    function get_by_id2($id)
    {
        $this->db->where($this->id2, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {  
        $this->db->group_start();
        $this->db->like('capp_employee', $q);
    	$this->db->or_like('cnama', $q);  
        $this->db->group_end();
        $this->db->order_by($this->id, $this->order);
	    $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {  
        $this->db->group_start();
        $this->db->like('capp_employee', $q);
    	$this->db->or_like('cnama', $q);  
        $this->db->group_end();
        $this->db->order_by($this->id, $this->order);
	    $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    function delete($id){
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    function cek_user($username,$password){ 
        $this->db->where('vusername', $username);
        $this->db->where('vpassword', $password);  
        $this->db->where('(iactivied', 0, FALSE);
        $this->db->or_where("iactivied IS NULL)", NULL, FALSE); 
        return $this->db->get($this->table);
    }
}