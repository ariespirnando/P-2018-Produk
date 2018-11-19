<?php

class Pembelian_mod extends CI_Model {    

    // get all
    public $table = 'erp_produk.pembelian';
    public $id = 'ipembelian';
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
        $this->db->join('erp_produk.master_suplier','master_suplier.imaster_suplier = pembelian.imaster_suplier','inner');  
        $this->db->where_not_in('pembelian.istatus_hapus', 1); 
        $this->db->group_start();
        $this->db->like('master_suplier.nama_suplier', $q); 
        $this->db->like('pembelian.total_all', $q); 
        $this->db->like('pembelian.cNomor_pembelian', $q); 
        $this->db->group_end();
        $this->db->order_by($this->id, $this->order);
        $this->db->from($this->table);
        return $this->db->count_all_results(); 
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {   
        $this->db->join('erp_produk.master_suplier','master_suplier.imaster_suplier = pembelian.imaster_suplier','inner');  
        $this->db->where_not_in('pembelian.istatus_hapus', 1); 
        $this->db->group_start();
        $this->db->like('master_suplier.nama_suplier', $q); 
        $this->db->like('pembelian.total_all', $q); 
        $this->db->like('pembelian.cNomor_pembelian', $q);  
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