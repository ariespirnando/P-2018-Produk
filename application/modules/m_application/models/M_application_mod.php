<?php

class M_application_mod extends CI_Model {    

    // get all
    public $table = 'erplaning.app_erpmodule';
    public $id = 'iapp_erpmodule';
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
    
    // get total rows
    function total_rows($q = NULL) {  
        $this->db->group_start();
        $this->db->like('vmodule', $q);  
        $this->db->group_end();
        $this->db->order_by($this->id, $this->order);
	    $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {  
        $this->db->group_start();
        $this->db->like('vmodule', $q); 
        $this->db->group_end();
        $this->db->order_by($this->id, $this->order);
	    $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }
    
    function delete($id){
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }
}