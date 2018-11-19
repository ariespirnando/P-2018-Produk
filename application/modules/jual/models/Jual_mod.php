<?php

class Jual_mod extends CI_Model {    

    // get all
    public $table = 'erp_produk.jual';
    public $id = 'ijual';
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
    
    function total_rows($q = NULL) {   
        $this->db->join('erp_produk.master_buyer','master_buyer.imaster_buyer = jual.imaster_buyer','inner');  
        $this->db->where_not_in('jual.istatus_hapus', 1); 
        $this->db->group_start();
        $this->db->like('master_buyer.nama_buyer', $q); 
        $this->db->like('jual.total_all', $q); 
        $this->db->like('jual.cNomor_jual', $q); 
        $this->db->group_end();
        $this->db->order_by($this->id, $this->order);
        $this->db->from($this->table);
        return $this->db->count_all_results(); 
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {   
        $this->db->join('erp_produk.master_buyer','master_buyer.imaster_buyer = jual.imaster_buyer','inner');  
        $this->db->where_not_in('jual.istatus_hapus', 1); 
        $this->db->group_start();
        $this->db->like('master_buyer.nama_buyer', $q); 
        $this->db->like('jual.total_all', $q); 
        $this->db->like('jual.cNomor_jual', $q);  
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