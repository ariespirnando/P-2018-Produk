<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jual extends MY_Controller {  
    function __construct() {
        parent::__construct();
        if(!$this->session->userdata('loggedin')){   
            redirect('auth');
        } 
        $this->load->model(array('Jual_mod'));
        $this->load->library('pagination');
    }

	public function index(){ 
        $data = array();
        $data['detail'] = base_url().'jual/detail/';
        $this->template->load('core_template','index',$data);
    }
    function loaddetailform(){
        echo $this->load->view('detail',true);
    }
    public function loadRecord($rowno=0){  
        $q = $this->input->post('q'); 
        $rowperpage = 5; 
        if($rowno != 0){
          $rowno = ($rowno-1) * $rowperpage;
        } 
        $allcount = $this->Jual_mod->total_rows($q); 
        $users_record = $this->Jual_mod->get_limit_data($rowperpage, $rowno, $q); 
        $config['base_url'] = base_url().'Jual/loadRecord';
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
    function buyer(){
        $key = $this->input->get("term");     
        $data = array();
        $sql = "SELECT m.imaster_buyer, m.nama_buyer FROM erp_produk.master_buyer m where m.nama_buyer LIKE '%".$key."%'";   
        $que = $this->db->query($sql)->result_array();
        if(!empty($que)){
            foreach ($que as $line) {  
                $row['id']        = trim($line['imaster_buyer']);
                $row['value']     = trim($line['nama_buyer']); 
                array_push($data, $row);
            }
        } 
                    
        echo json_encode($data);
        exit;  
    }

    function jenis(){
        $key = $this->input->get("term");     
        $data = array();
        $sql = "SELECT m.nama_jenis,m.harga_jual, m.imaster_jenis from erp_produk.master_jenis m where m.nama_jenis LIKE '%".$key."%'";   // Tambahain Cek Dari Hasil Giling, Untuk Ngurangin Stok Giling   
        $que = $this->db->query($sql)->result_array();
        if(!empty($que)){
            foreach ($que as $line) {  
                $row['id']        = trim($line['imaster_jenis']);
                $row['value']     = trim($line['nama_jenis']); 
                $row['harga']     = number_format(trim($line['harga_jual'])); 
                array_push($data, $row);
            }
        } 
                    
        echo json_encode($data);
        exit;  
    }
    
    function savedata(){ 
        $imaster_buyer = $this->input->post('imaster_buyer');
        $nama_buyer    = $this->input->post('nama_buyer');
        $total_all       = $this->input->post('total_all');

        if($imaster_buyer=="" || $imaster_buyer==0){
            //Insert Suplier Dulu
            $sup['nama_buyer'] = strtoupper($nama_buyer);
            $this->db->insert('erp_produk.master_buyer',$sup);
            $imaster_buyer = $this->db->insert_id();
        }

        //Save Headernya dulu;
        $pemb['tanggal_jual'] = date('Y-m-d H:i:s');
        $pemb['pic_jual']     = $this->session->userdata('capp_employee');
        $pemb['total_all']         = str_replace(',', '', $total_all);
        $pemb['imaster_buyer']   = $imaster_buyer;
        $this->db->insert('erp_produk.jual',$pemb);
        $ijual = $this->db->insert_id();

        //Update Kodenya
        $nomor = 'SEL'.str_pad($ijual, 5, "0", STR_PAD_LEFT); 
        $updt['cNomor_jual']= $nomor;   
        $this->db->where('ijual', $ijual);
        $this->db->update('erp_produk.jual', $updt);

        //Simpan Detailnya
        $arr_pem = array();
        foreach($this->input->post('total_harga') as $k=>$v){ 
            $arr_pem['total_harga'][$k] = str_replace(',', '',$v);
        } 
        foreach($this->input->post('harga_jual') as $k=>$v){ 
            $arr_pem['harga_jual'][$k] = str_replace(',', '',$v);
        } 
        foreach($this->input->post('total_kg') as $k=>$v){ 
            $arr_pem['total_kg'][$k] = str_replace(',', '',$v);
        } 
        foreach($this->input->post('imaster_jenis') as $k=>$v){ 
            $pemdet = array();
            $pemdet['ijual'] = $ijual;  
            $pemdet['imaster_jenis'] = $v;  
            $pemdet['total_harga'] = $arr_pem['total_harga'][$k];
            $pemdet['total_kg']    = $arr_pem['total_kg'][$k];
            $pemdet['harga_jual']  = $arr_pem['harga_jual'][$k];
            $this->db->insert('erp_produk.jual_detail', $pemdet);  
        }    
        exit;
    }

    function deleteid(){
        $ijual = $this->input->post('id');
        $keterangan_hapus = $this->input->post('name'); 

        $updt['keterangan_hapus'] = $keterangan_hapus;
        $updt['istatus_hapus']    = 1;
        $updt['pic_hapus']        = $this->session->userdata('capp_employee');

        $this->db->where('ijual', $ijual);
        $this->db->update('erp_produk.jual', $updt);
    }
    
    function detail($id){
        $ijual = $id;
        $data['ijual'] = $id;
        $data['url_back'] = base_url().'jual';
        $data['row'] = $this->Jual_mod->get_by_id($id);
        $data['res'] = $this->db->query('select *,pd.harga_jual as jual_harga from erp_produk.jual_detail pd 
                                            JOIN erp_produk.master_jenis j on 
                                            pd.imaster_jenis = j.imaster_jenis where 
                                            pd.ijual="'.$id.'"')->result_array();
        $this->template->load('core_template','detail_view',$data); 
    }



}
