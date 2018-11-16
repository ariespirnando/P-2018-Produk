<?php

class Sortir_mod extends CI_Model {    

    // get all
    public $table = 'erp_produk.sortir';
    public $id = 'isortir';
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
        $this->db->join('erplaning.app_employee','app_employee.capp_employee = sortir.capp_employee','inner');  
        $this->db->where_not_in('sortir.istatus_hapus', 1); 
        $this->db->group_start();
        $this->db->like('app_employee.cnama', $q); 
        $this->db->like('sortir.total_all', $q); 
        $this->db->like('sortir.cNomor_sortir', $q); 
        $this->db->group_end();
        $this->db->order_by($this->id, $this->order);
        $this->db->from($this->table);
        return $this->db->count_all_results(); 
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {   
        $this->db->join('erplaning.app_employee','app_employee.capp_employee = sortir.capp_employee','inner');  
        $this->db->where_not_in('sortir.istatus_hapus', 1); 
        $this->db->group_start();
        $this->db->like('app_employee.cnama', $q); 
        $this->db->like('sortir.total_all', $q); 
        $this->db->like('sortir.cNomor_sortir', $q);  
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