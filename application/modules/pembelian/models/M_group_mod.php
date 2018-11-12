<?php

class M_group_mod extends CI_Model {    

    // get all
    public $table = 'erplaning.app_erpgroup';
    public $id = 'iiapp_erpgroup';
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

    function get_by_id2($id)
    {
        $this->db->where($this->id, $id); 
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL, $fk) {  
        $this->db->where($this->fk,$fk);
        $this->db->group_start();
        $this->db->like('vgroup', $q);  
        $this->db->group_end();
        $this->db->order_by($this->id, $this->order);
	    $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL, $fk) {  
        $this->db->where($this->fk,$fk);
        $this->db->group_start();
        $this->db->like('vgroup', $q); 
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