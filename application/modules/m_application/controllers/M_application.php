<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_application extends MY_Controller {  
    function __construct() {
        parent::__construct();
        if(!$this->session->userdata('loggedin')){   
            redirect('auth');
        }
        $this->load->model(array('M_application_mod','M_module_mod','M_group_mod','M_group_user'));
        $this->load->library('pagination');
    }

	public function index(){ 
        $data['addmodule'] = base_url().'m_application/addmodule';
        $data['addgroup'] = base_url().'m_application/addgroup'; 
        $data['delete'] = base_url().'m_application/delete'; 
        $this->template->load('core_template','index',$data);
    }

    //Add Application
    public function loadRecord($rowno=0){  
        $q = $this->input->post('q');
        // Row per page
        $rowperpage = 8;

        // Row position
        if($rowno != 0){
          $rowno = ($rowno-1) * $rowperpage;
        }
     
        // All records count
        $allcount = $this->M_application_mod->total_rows($q);

        // Get records
        $users_record = $this->M_application_mod->get_limit_data($rowperpage, $rowno, $q);  
     
        // Pagination Configuration
        $config['base_url'] = base_url().'m_application/loadRecord';
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
        $this->load->view('addapp', $data);
    }

    function editdata(){
        $iapp_erpmodule = $this->input->post('q');
        $data['res'] = $this->M_application_mod->get_by_id($iapp_erpmodule);
        $data['iapp_erpmodule'] = $iapp_erpmodule;
        $data['url_action'] = base_url().'m_karyawan/updatedata';  
        $this->load->view('editapp', $data);   
    } 
    

    function simpanapp(){
        $data['vmodule'] = $this->input->post('vmodule');
        $data['dcreate'] = date('Y-m-d');
        $this->db->set($data);
        $this->db->insert('erplaning.app_erpmodule'); 
    }
    function updateapp(){
        $iapp_erpmodule = $this->input->post('iapp_erpmodule');
        $data['vmodule'] = $this->input->post('vmodule');
        $data['dcreate'] = date('Y-m-d');

        $this->db->where('iapp_erpmodule', $iapp_erpmodule);
        $this->db->update('erplaning.app_erpmodule', $data);  
    }
    
    function delete($id){
        $this->M_application_mod->delete($id);  
        redirect(site_url('m_application'));
    }
    // End Application


    //Add Module
    function addmodule($id){ 
        $data['iapp_erpmodule'] = $id;
        $data['row'] = $this->M_application_mod->get_by_id($id);
        $data['url_back'] = base_url().'m_application';
        $data['delete'] = base_url().'m_application/deletemodule'; 
        $this->template->load('core_template','addmodule',$data); 
    }

    public function loadRecord_module($rowno=0){  
        $q = $this->input->post('q');
        $k = $this->input->post('k');
        // Row per page
        $rowperpage = 8;

        // Row position
        if($rowno != 0){
          $rowno = ($rowno-1) * $rowperpage;
        }
     
        // All records count
        $allcount = $this->M_module_mod->total_rows($q,$k);

        // Get records
        $users_record = $this->M_module_mod->get_limit_data($rowperpage, $rowno, $q,$k);  
     
        // Pagination Configuration
        $config['base_url'] = base_url().'m_application/loadRecord_module';
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

    function deletemodule(){
        $this->M_module_mod->delete($this->input->post('k'));   
    }
      
    function editdatamodule(){
        $iapp_erpmodule = $this->input->post('k');
        $iapp_erpmoduldetail = $this->input->post('q');
        $data['iapp_erpmodule'] = $iapp_erpmodule;
        $data['iapp_erpmoduldetail'] = $iapp_erpmoduldetail;
        $data['result'] = $this->M_module_mod->get_by_id($iapp_erpmoduldetail,$iapp_erpmodule);   
        $data['row'] = $this->db->query('select a.iapp_erpmoduldetail, a.tnamedetail from erplaning.app_erpmoduldetail a where a.itipe = 1 and a.iapp_erpmodule="'.$this->input->post('k').'"')->result_array();
        $data['url_action'] = base_url().'m_karyawan/savedatamodule';  
        $this->load->view('editdatamodule', $data);
    }

    function adddatamodule(){
        $data['iapp_erpmodule'] = $this->input->post('k');
        $data['row'] = $this->db->query('select a.iapp_erpmoduldetail, a.tnamedetail from erplaning.app_erpmoduldetail a where a.itipe = 1 and a.iapp_erpmodule="'.$this->input->post('k').'"')->result_array();
        $data['url_action'] = base_url().'m_karyawan/savedatamodule';  
        $this->load->view('adddatamodule', $data);
    }

    function savedatamodule(){
        $iapp_erpmodule = $this->input->post('iapp_erpmodule');
        $tnamedetail    = $this->input->post('tnamedetail');
        $turl           = $this->input->post('turl');
        $itipe          = $this->input->post('itipe');
        $iparent        = $this->input->post('iparent'); 

        if($itipe==1){
            $iparent = 0;
        }else{
            $sql = "SELECT a.turl FROM erplaning.app_erpmoduldetail a where a.iapp_erpmoduldetail = '".$iparent."'";
            $dt = $this->db->query($sql)->row_array();
            if(empty($dt['turl'])){
                $dt['turl'] = "";
            }
            $data['tparenturl'] = $dt['turl'];
        }

        $data['iapp_erpmodule'] = $iapp_erpmodule;
        $data['tnamedetail']    = $tnamedetail;
        $data['turl']           = $turl;
        $data['itipe']          = $itipe;
        $data['iparent']        = $iparent;

        $this->db->set($data);
        $this->db->insert('erplaning.app_erpmoduldetail'); 

    }

    function updatedatamodule(){
        $iapp_erpmodule = $this->input->post('iapp_erpmodule');
        $iapp_erpmoduldetail = $this->input->post('iapp_erpmoduldetail');
        $tnamedetail    = $this->input->post('tnamedetail');
        $turl           = $this->input->post('turl');
        $itipe          = $this->input->post('itipe');
        $iparent        = $this->input->post('iparent'); 

        if($itipe==1){
            $iparent = 0;
        }else{
            $sql = "SELECT a.turl FROM erplaning.app_erpmoduldetail a where a.iapp_erpmoduldetail = '".$iparent."'";
            $dt = $this->db->query($sql)->row_array();
            if(empty($dt['turl'])){
                $dt['turl'] = "";
            }
            $data['tparenturl'] = $dt['turl'];
        }
 
        $data['tnamedetail']    = $tnamedetail;
        $data['turl']           = $turl;
        $data['itipe']          = $itipe;
        $data['iparent']        = $iparent;

        $this->db->where('iapp_erpmodule', $iapp_erpmodule);
        $this->db->where('iapp_erpmoduldetail', $iapp_erpmoduldetail);
        $this->db->update('erplaning.app_erpmoduldetail', $data);  
    } 

    //End Module

    //Add Group
    function configgroup($id){ 
        $data['iiapp_erpgroup'] = $id; 
        $row = $this->M_group_mod->get_by_id2($id); 
        $data['row'] = $this->M_application_mod->get_by_id($row->iapp_erpmodule);
        $data['res'] = $row; 
        $data['iapp_erpmodule'] = $row->iapp_erpmodule;
        $data['url_back'] = base_url().'m_application/addgroup/'.$row->iapp_erpmodule;
        $this->template->load('core_template','configgroup',$data); 
    } 
    function addgroup($id){ 
        $data['iapp_erpmodule'] = $id;
        $data['row'] = $this->M_application_mod->get_by_id($id);
        $data['url_back'] = base_url().'m_application';
        $data['adduser'] = base_url().'m_application/adduser';
        $data['configgroup'] = base_url().'m_application/configgroup';
        $this->template->load('core_template','addgroup',$data); 
    }

    function adddatagroup(){
        $data['iapp_erpmodule'] = $this->input->post('k'); 
        $data['url_action'] = base_url().'m_karyawan/savedatagroup';  
        $this->load->view('adddatagroup', $data);
    }
        
    function deletegroup(){
        $this->M_group_mod->delete($this->input->post('k'));   
    }

    function editdatagroup(){
        $iapp_erpmodule = $this->input->post('k');
        $iiapp_erpgroup = $this->input->post('q');
        $data['iapp_erpmodule'] = $iapp_erpmodule;
        $data['iiapp_erpgroup'] = $iiapp_erpgroup;  
        $data['result'] = $this->M_group_mod->get_by_id($iiapp_erpgroup,$iapp_erpmodule); 

        $data['url_action'] = base_url().'m_karyawan/savedatamodule';  
        $this->load->view('editdatagroup', $data); 
    } 
    
    function savedatagroup(){
        $iapp_erpmodule = $this->input->post('iapp_erpmodule');
        $vgroup         = $this->input->post('vgroup'); 
        $dcreate        = date('Y-m-d');

        $data['iapp_erpmodule'] = $iapp_erpmodule;
        $data['vgroup']         = $vgroup;
        $data['dcreate']        = $dcreate;

        $this->db->set($data);
        $this->db->insert('erplaning.app_erpgroup'); 

    }

    function updatedatagroup(){
        $iapp_erpmodule = $this->input->post('iapp_erpmodule');
        $iiapp_erpgroup = $this->input->post('iiapp_erpgroup');
        $vgroup         = $this->input->post('vgroup');  
 
        $data['vgroup']         = $vgroup;
        $data['dcreate']        = $dcreate;

        $this->db->where('iapp_erpmodule', $iapp_erpmodule);
        $this->db->where('iiapp_erpgroup', $iiapp_erpgroup);
        $this->db->update('erplaning.app_erpgroup', $data);  

    }

     public function loadRecord_group($rowno=0){  
        $q = $this->input->post('q');
        $k = $this->input->post('k');
        // Row per page
        $rowperpage = 8;

        // Row position
        if($rowno != 0){
          $rowno = ($rowno-1) * $rowperpage;
        }
     
        // All records count
        $allcount = $this->M_group_mod->total_rows($q,$k);

        // Get records
        $users_record = $this->M_group_mod->get_limit_data($rowperpage, $rowno, $q,$k);  
     
        // Pagination Configuration
        $config['base_url'] = base_url().'m_application/loadRecord_group';
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

    function Checked(){
        $iapp_erpmoduldetail = $this->input->post('iapp_erpmoduldetail');
        $iapp_erpmodule      = $this->input->post('iapp_erpmodule');
        $iiapp_erpgroup      = $this->input->post('iiapp_erpgroup');
        $pro                 = $this->input->post('pro'); 
        $func                = $this->input->post('func'); 
        $uu['dcreate']       = date('Y-m-d');
        if($pro==1){ 

            //Add & Update 
            //Cek Sudah Ada Atau belum;
            $sql = 'select ap.iview, ap.iedit, ap.idelete, ap.iadd from erplaning.app_erpgroup_config ap 
                where ap.iiapp_erpgroup = "'.$iiapp_erpgroup.'" 
                and ap.iapp_erpmodule= "'.$iapp_erpmodule.'" 
                and ap.iapp_erpmoduldetail="'.$iapp_erpmoduldetail.'"';
            $dt = $this->db->query($sql);
            if($dt->num_rows()>0){
                if($func==1){
                    $uu['iview'] = 1; 
                }elseif ($func==2) {
                    $uu['iadd'] = 1; 
                }elseif ($func==3) {
                    $uu['iedit'] = 1; 
                }else{
                    $uu['idelete'] = 1; 
                } 

                $this->db->where('iiapp_erpgroup', $iiapp_erpgroup);
                $this->db->where('iapp_erpmodule', $iapp_erpmodule);
                $this->db->where('iapp_erpmoduldetail', $iapp_erpmoduldetail);
                $this->db->update('erplaning.app_erpgroup_config', $uu);   
            }else{
                if($func==1){
                    $uu['iview'] = 1; 
                }elseif ($func==2) {
                    $uu['iadd'] = 1; 
                }elseif ($func==3) {
                    $uu['iedit'] = 1; 
                }else{
                    $uu['idelete'] = 1; 
                } 

                $uu['iiapp_erpgroup'] = $iiapp_erpgroup; 
                $uu['iapp_erpmodule'] = $iapp_erpmodule; 
                $uu['iapp_erpmoduldetail'] = $iapp_erpmoduldetail;  
                $this->db->set($uu);
                $this->db->insert('erplaning.app_erpgroup_config');  
            }
        }else{

            if($func==1){
                $uu['iview'] = 0; 
            }elseif ($func==2) {
                $uu['iadd'] = 0; 
            }elseif ($func==3) {
                $uu['iedit'] = 0; 
            }else{
                $uu['idelete'] = 0; 
            } 
            $this->db->where('iiapp_erpgroup', $iiapp_erpgroup);
            $this->db->where('iapp_erpmodule', $iapp_erpmodule);
            $this->db->where('iapp_erpmoduldetail', $iapp_erpmoduldetail);
            $this->db->update('erplaning.app_erpgroup_config', $uu);

            //Delete
        }

        echo json_encode($uu);

    }

    function Check(){
        $iapp_erpmoduldetail = $this->input->post('iapp_erpmoduldetail');
        $iapp_erpmodule      = $this->input->post('iapp_erpmodule');
        $iiapp_erpgroup      = $this->input->post('iiapp_erpgroup');
        $sql = 'select ap.iview, ap.iedit, ap.idelete, ap.iadd from erplaning.app_erpgroup_config ap 
                where ap.iiapp_erpgroup = "'.$iiapp_erpgroup.'" 
                and ap.iapp_erpmodule= "'.$iapp_erpmodule.'" 
                and ap.iapp_erpmoduldetail="'.$iapp_erpmoduldetail.'"';
        echo json_encode($this->db->query($sql)->row_array());
    }

    //End Group
        
    //Add User

    function adduser($id){  
        $data['iiapp_erpgroup'] = $id; 
        $row = $this->M_group_mod->get_by_id2($id); 
        $data['row'] = $this->M_application_mod->get_by_id($row->iapp_erpmodule);
        $data['res'] = $row; 
        $data['iapp_erpmodule'] = $row->iapp_erpmodule;
        $data['url_back'] = base_url().'m_application/addgroup/'.$row->iapp_erpmodule;
        $this->template->load('core_template','adduser',$data); 
    }

    function adddatauser(){
        $data['iapp_erpmodule'] = $this->input->post('iapp_erpmodule'); 
        $data['iiapp_erpgroup'] = $this->input->post('iiapp_erpgroup'); 
        $data['url_action'] = base_url().'m_karyawan/savedatuser';  
        $this->load->view('adddatauser', $data);
    }

    function savedatauser(){
        $capp_employee  = $this->input->post('capp_employee');
        $iapp_erpmodule = $this->input->post('iapp_erpmodule'); 
        $iiapp_erpgroup = $this->input->post('iiapp_erpgroup'); 
        $dcreate        = date('Y-m-d'); 
        $data['capp_employee'] = $capp_employee;
        $data['iapp_erpmodule']= $iapp_erpmodule;
        $data['iiapp_erpgroup']= $iiapp_erpgroup;
        $data['dcreate']        = $dcreate; 
        $this->db->set($data);
        $this->db->insert('erplaning.app_erpgroup_user');  
    }

    public function loadRecord_usergroup($rowno=0){  
        $q = $this->input->post('q');
        $grop = $this->input->post('grop');
        $modul = $this->input->post('modul');
        // Row per page
        $rowperpage = 8; 
        // Row position
        if($rowno != 0){
          $rowno = ($rowno-1) * $rowperpage;
        } 
        // All records count
        $allcount = $this->M_group_user->total_rows($q,$grop, $modul);

        // Get records
        $users_record = $this->M_group_user->get_limit_data($rowperpage, $rowno, $q, $grop, $modul);  
     
        // Pagination Configuration
        $config['base_url'] = base_url().'m_application/loadRecord_usergroup';
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

    function deleteuser(){
        $this->M_group_user->delete($this->input->post('k'));  
    }


    //End User



}
