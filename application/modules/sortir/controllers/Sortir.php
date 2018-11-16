<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sortir extends MY_Controller {  
    function __construct() {
        parent::__construct();
        if(!$this->session->userdata('loggedin')){   
            redirect('auth');
        } 
        $this->load->model(array('Sortir_mod'));
        $this->load->library('pagination');
    }

	public function index(){ 
        $data = array();
        $data['detail'] = base_url().'sortir/detail/';
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
        $allcount = $this->Sortir_mod->total_rows($q); 
        $users_record = $this->Sortir_mod->get_limit_data($rowperpage, $rowno, $q); 
        $config['base_url'] = base_url().'Sortir/loadRecord';
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
    function karyawan(){
        $key = $this->input->get("term");     
        $data = array();
        $sql = "SELECT ae.capp_employee, ae.cnama FROM erplaning.app_employee ae where ae.capp_employee LIKE '%".$key."%' OR ae.cnama LIKE '%".$key."%'"; 
        $que = $this->db->query($sql)->result_array();

        if(!empty($que)){
            foreach ($que as $line) {  
                $row['id']        = trim($line['capp_employee']);
                $row['value']     = trim($line['capp_employee']).' - '.trim($line['cnama']); 
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
    
    function savedata(){ 
        $capp_employee = $this->input->post('capp_employee'); 
        $total_all       = $this->input->post('total_all');
 
        //Save Headernya dulu;
        $pemb['tanggal_sortir'] = date('Y-m-d H:i:s');
        $pemb['pic_sortir']     = $this->session->userdata('capp_employee');
        $pemb['total_all']         = str_replace(',', '', $total_all);
        $pemb['capp_employee']   = $capp_employee;
        $this->db->insert('erp_produk.sortir',$pemb);
        $isortir = $this->db->insert_id();

        //Update Kodenya
        $nomor = 'SRT'.str_pad($isortir, 5, "0", STR_PAD_LEFT); 
        $updt['cNomor_sortir']= $nomor;   
        $this->db->where('isortir', $isortir);
        $this->db->update('erp_produk.sortir', $updt);

        //Simpan Detailnya
        $arr_pem = array();
        
        foreach($this->input->post('total_kg') as $k=>$v){ 
            $arr_pem['total_kg'][$k] = str_replace(',', '',$v);
        } 
        foreach($this->input->post('imaster_jenis') as $k=>$v){ 
            $pemdet = array();
            $pemdet['isortir'] = $isortir;  
            $pemdet['imaster_jenis'] = $v;   
            $pemdet['total_kg']    = $arr_pem['total_kg'][$k]; 
            $this->db->insert('erp_produk.sortir_detail', $pemdet);  
        }    
        exit;
    }

    function deleteid(){
        $isortir = $this->input->post('id');
        $keterangan_hapus = $this->input->post('name'); 

        $updt['keterangan_hapus'] = $keterangan_hapus;
        $updt['istatus_hapus']    = 1;
        $updt['pic_hapus']        = $this->session->userdata('capp_employee');

        $this->db->where('isortir', $isortir);
        $this->db->update('erp_produk.sortir', $updt);
    }
    
    function detail($id){
        $isortir = $id;
        $data['isortir'] = $id;
        $data['url_back'] = base_url().'sortir';
        $data['row'] = $this->Sortir_mod->get_by_id($id);
        $data['res'] = $this->db->query('select * from erp_produk.sortir_detail pd 
                                            JOIN erp_produk.master_jenis j on 
                                            pd.imaster_jenis = j.imaster_jenis where 
                                            pd.isortir="'.$id.'"')->result_array();
        $this->template->load('core_template','detail_view',$data); 
    }



}
