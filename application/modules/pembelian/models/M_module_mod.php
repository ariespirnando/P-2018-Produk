<?php

class M_module_mod extends CI_Model {    

    // get all
    public $table = 'erplaning.app_erpmoduldetail';
    public $id = 'iapp_erpmoduldetail';
    public $fk = 'iapp_erpmodule';
    public $order = 'DESC';

    function get_all($fk)
    {   
        $this->db->where($this->fk,$fk);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id,$fk)
    {
        $this->db->where($this->id, $id);
        $this->db->where($this->fk,$fk);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL, $fk) {  
        $this->db->where($this->fk,$fk);
        $this->db->group_start();
        $this->db->like('tnamedetail', $q);  
        $this->db->group_end();
        $this->db->order_by($this->id, $this->order);
	    $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL, $fk) {  
        $this->db->where($this->fk,$fk);
        $this->db->group_start();
        $this->db->like('tnamedetail', $q); 
        $this->db->group_end();
        $this->db->order_by($this->id, $this->order);
	    $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    function delete($id ){ 
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }
}