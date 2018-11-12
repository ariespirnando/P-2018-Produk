<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembelian extends MY_Controller {  
    function __construct() {
        parent::__construct();
        if(!$this->session->userdata('loggedin')){   
            redirect('auth');
        } 
        $this->load->library('pagination');
    }

	public function index(){ 
        $data = array();
        $this->template->load('core_template','index',$data);
    }
 
    public function loadRecord($rowno=0){  
        $q = $this->input->post('q'); 
        $rowperpage = 8; 
        if($rowno != 0){
          $rowno = ($rowno-1) * $rowperpage;
        } 
        $allcount = $this->Pembelian_mod->total_rows($q); 
        $users_record = $this->Pembelian_mod->get_limit_data($rowperpage, $rowno, $q); 
        $config['base_url'] = base_url().'Pembelian/loadRecord';
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $allcount;
        $config['per_page'] = $rowperpage; 
        $this->pagination->initialize($config); 
        $data['pagination'] = $this->pagination->create_links();
        $data['result'] = $users_record;
        $data['total_data']=$allcount;
        $data['row'] = $rowno; 
        echo json_encode($data); 
    }
    function supplier(){
        $key = $this->input->get("term");     
        $data = array();
        $sql = "SELECT m.imaster_suplier, m.nama_suplier FROM erp_produk.master_suplier m where m.nama_suplier LIKE '%".$key."%'";   
        $que = $this->db->query($sql)->result_array();
        if(!empty($que)){
            foreach ($que as $line) {  
                $row['id']        = trim($line['imaster_suplier']);
                $row['value']     = trim($line['nama_suplier']); 
                array_push($data, $row);
            }
        } 
                    
        echo json_encode($data);
        exit;  
    }

    function jenis(){
        $key = $this->input->get("term");     
        $data = array();
        $sql = "SELECT m.nama_jenis,m.harga_beli, m.imaster_jenis from erp_produk.master_jenis m where m.nama_jenis LIKE '%".$key."%'";   
        $que = $this->db->query($sql)->result_array();
        if(!empty($que)){
            foreach ($que as $line) {  
                $row['id']        = trim($line['imaster_jenis']);
                $row['value']     = trim($line['nama_jenis']); 
                $row['harga']     = number_format(trim($line['harga_beli'])); 
                array_push($data, $row);
            }
        } 
                    
        echo json_encode($data);
        exit;  
    }
 
    



}
