<?php

class M_group_user extends CI_Model {    

    // get all
    public $table = 'erplaning.app_erpgroup_user';
    public $id = 'iapp_erpgroup_user'; 
    public $order = 'DESC';
 
    // get total rows
    function total_rows($q = NULL, $grop, $modul) {   
        $this->db->join('erplaning.app_employee','app_employee.capp_employee = app_erpgroup_user.capp_employee','inner'); 
        $this->db->where('app_erpgroup_user.iiapp_erpgroup',$grop);
        $this->db->where('app_erpgroup_user.iapp_erpmodule',$modul);   
        $this->db->group_start();
        $this->db->like('app_employee.capp_employee', $q); 
        $this->db->like('app_employee.cnama', $q); 
        $this->db->group_end();
        $this->db->order_by($this->id, $this->order);
        $this->db->from($this->table);
        return $this->db->count_all_results(); 
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL, $grop, $modul) {  
        $this->db->select('app_employee.capp_employee,
                            app_employee.cnama,
                            app_erpgroup_user.iapp_erpgroup_user');
        $this->db->join('erplaning.app_employee','app_employee.capp_employee = app_erpgroup_user.capp_employee','inner'); 
        $this->db->where('app_erpgroup_user.iiapp_erpgroup',$grop);
        $this->db->where('app_erpgroup_user.iapp_erpmodule',$modul);   
        $this->db->group_start();
        $this->db->like('app_employee.capp_employee', $q); 
        $this->db->like('app_employee.cnama', $q); 
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