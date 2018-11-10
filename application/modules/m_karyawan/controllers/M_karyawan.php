<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_karyawan extends MY_Controller {  
    function __construct() {
        parent::__construct();
        if(!$this->session->userdata('loggedin')){   
            redirect('auth');
        }
        $this->load->model('M_karyawan_mod');
        $this->load->library('pagination');
    }

	public function index(){  
        $data['url_add'] = base_url().'m_karyawan/adddata';
        $data['url_edit'] = base_url().'m_karyawan/editdata';
        $data['url_delete'] = base_url().'m_karyawan/deletedata'; 
        $this->template->load('core_template','index',$data);
    }

    function employeesearch(){
        $key = $this->input->get("term");    
        $iapp_erpmodule = $this->input->get('iapp_erpmodule');
        $iiapp_erpgroup = $this->input->get('iiapp_erpgroup'); 
        $data = array();
        $sql = "SELECT e.capp_employee, e.cnama FROM erplaning.app_employee e where (e.capp_employee 
                    LIKE '%".$key."%' OR e.cnama LIKE '%".$key."%') AND 
                    (e.iactivied = 1 or e.iactivied is null) AND e.capp_employee 
                    NOT IN(SELECT u.capp_employee FROM erplaning.app_erpgroup_user u 
                        JOIN erplaning.app_employee ae on u.capp_employee = ae.capp_employee
                            where u.iapp_erpmodule = ".$iapp_erpmodule."
                                and (u.capp_employee LIKE '%".$key."%'
                                     or ae.cnama LIKE '%".$key."%'))
                    LIMIT 50"; 
        $que = $this->db->query($sql)->result_array();
        if(!empty($que)){
            foreach ($que as $line) { 
                $row['id']        = trim($line['capp_employee']);
                $row['value']     = trim($line['cnama']); 
                array_push($data, $row);
            }
        } 
                    
        echo json_encode($data);
        exit;   
    }

    public function loadRecord($rowno=0){  
        $q = $this->input->post('q');
        // Row per page
        $rowperpage = 8;

        // Row position
        if($rowno != 0){
          $rowno = ($rowno-1) * $rowperpage;
        }
     
        // All records count
        $allcount = $this->M_karyawan_mod->total_rows($q);

        // Get records
        $users_record = $this->M_karyawan_mod->get_limit_data($rowperpage, $rowno, $q);  
     
        // Pagination Configuration
        $config['base_url'] = base_url().'m_karyawan/loadRecord';
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $allcount;
        $config['per_page'] = $rowperpage;

        // Initialize
        $this->pagination->initialize($config);

        // Initialize $data Array
        $data['pagination'] = $this->pagination->create_links();
        $data['result'] = $users_record;
        $data['total_data']=$allcount;
        $data['row'] = $rowno;

        echo json_encode($data); 
    }

    function adddata(){
        $data['url_action'] = base_url().'m_karyawan/savedata'; 
        $data['url_back'] = base_url().'m_karyawan'; 
        $this->template->load('core_template','add',$data);
    } 

    function savedata(){ 
        $cnama = $this->input->post('cnama');
        $din = $this->input->post('din');
        $tipe = $this->input->post('tipe'); 

        $data['cnama']  = strtoupper($cnama);
        $data['din']    = $din;
        $data['tipe']   = $tipe;

        $this->db->set($data);
        $this->db->insert('erplaning.app_employee'); 

        //Add to Table 
        $nomor = 'KRY'.str_pad($this->db->insert_id(), 5, "0", STR_PAD_LEFT); 
        $datas['capp_employee']= $nomor; 
        $datas['vusername']= $nomor;  
        $datas['vpassword']    = md5($nomor);

        $this->db->where('iapp_employee', $this->db->insert_id());
        $this->db->update('erplaning.app_employee', $datas);
 
        $this->session->set_flashdata('message', '  Save Record Success');
        redirect(site_url('m_karyawan'));
    }

    function updatedata(){
        $cnama = $this->input->post('cnama');
        $din = $this->input->post('din');
        $tipe = $this->input->post('tipe'); 
        $iapp_employee = $this->input->post('iapp_employee'); 
        $dout = $this->input->post('dout');

        $data['cnama']  = strtoupper($cnama);
        $data['din']    = $din;
        $data['tipe']   = $tipe;
        $data['dout']   = $dout; 

        if(!empty($dout) or $dout!="0000-00-00"){
            $data['iactivied'] = 1;
        } 

        $this->db->where('iapp_employee', $iapp_employee);
        $this->db->update('erplaning.app_employee', $data); 

        $this->session->set_flashdata('message', '  Update Record Success');
        redirect(site_url('m_karyawan'));
    }

    function deletedata($id){
        $this->M_karyawan_mod->delete($id); 
        $this->session->set_flashdata('message', '  Delete Record Success');
        redirect(site_url('m_karyawan'));
    }
 
    function editdata($id){
        $this->load->model('M_karyawan_mod');
        $data['row'] = $this->M_karyawan_mod->get_by_id($id);
        $data['url_action'] = base_url().'m_karyawan/updatedata'; 
        $data['url_back'] = base_url().'m_karyawan'; 
        $data['id']  = $id;
        $this->template->load('core_template','update',$data);
    }

    function updateprofile($id){
        $this->load->model('M_karyawan_mod');
        $data['row'] = $this->M_karyawan_mod->get_by_id2($id);
        $data['url_action'] = base_url().'m_karyawan/updateprofildata'; 
        $data['url_back'] = base_url().'m_karyawan'; 
        $data['id']  = $id;
        $this->template->load('core_template','updateprofile',$data);
    }
    function updateprofildata(){
        $passbaru = $this->input->post('passbaru');
        $userbaru = $this->input->post('userbaru');

        $passlama = $this->input->post('passlama');
        $userlama = $this->input->post('userlama'); 

        $query = $this->M_karyawan_mod->cek_user($userlama,md5(trim($passlama)));
        if( $query->num_rows() > 0 ){ 
            $ret['userlama'] =$userbaru; 
            $capp_employee = $this->input->post('iapp_employee');    
            $sql = "select * from erplaning.app_employee a where a.vusername ='".strip_tags(trim($userbaru))."'";
            if($this->db->query($sql)->num_rows()>0){
                $data['vpassword']  = md5(strip_tags(trim($passbaru)));
                $ret['hsl'] =2; 
            }else{
                $ret['hsl'] =1; 
                $data['vpassword']  = md5(strip_tags(trim($passbaru)));
                $data['vusername']  = strip_tags(trim($userbaru));
            }
            $this->db->where('capp_employee', $capp_employee);
            $this->db->update('erplaning.app_employee', $data); 

        }
        else{
             $ret['hsl'] =0;
             $ret['userlama'] =$userlama;
        } 
        echo json_encode($ret);
    }

    
}
