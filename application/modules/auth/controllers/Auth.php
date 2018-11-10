<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {  
    function __construct() {
        parent::__construct();  
    }

	public function index(){   
		if(!$this->session->userdata('loggedin')){    
        }else{
            redirect('welcome');
        }

        $this->form_validation->CI =& $this;
        $this->form_validation->set_error_delimiters('<p class="text-danger text-center">*', '</p>');
        $this->form_validation->set_rules('username', 'username', 'required|xss_clean|trim|htmlspecialchars');
        $this->form_validation->set_rules('password', 'password', 'required|xss_clean|trim|htmlspecialchars'); 
        if ($this->form_validation->run() == FALSE){ 
            $this->load->view('index');
	    }
        else{   
        
            if($this->check_login() == TRUE){ 
                redirect('welcome');
            }
            else{
              $this->session->set_flashdata('login_error','error message');
              redirect('auth');
            }
        } 
    } 

    public function proses(){ 
        if($this->check_login() == TRUE){ 
            redirect('welcome');
        }
        else{
          $this->session->set_flashdata('login_error','error message');
          redirect('auth');
        } 
    }

    public function check_login(){	
    	$this->load->model('Auth_model');
		$username    = $this->input->post('username');
        $password 	 = $this->input->post('password'); 
        $password    = md5(trim($password)); 
        $query = $this->Auth_model->cekpw($username,$password);
        if( $query->num_rows() > 0 ){
		    $row = $query->row();
		    $data = array(
		      'capp_employee'=> $row->capp_employee,
		      'cnama'        => $row->cnama, 
		      'loggedin'     => 1,
		    );
            $this->session->set_userdata($data); 
            redirect('welcome');
        }
        else{
            $this->session->set_flashdata('login_error','error message');
          	redirect('auth');
        } 
    }

    public function logout(){
		$this->session->sess_destroy();
	    redirect('auth');
    }
}
