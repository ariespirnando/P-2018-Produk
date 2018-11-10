<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

	 
	public function index()
	{	if(!$this->session->userdata('loggedin')){   
            redirect('auth');
        }else{
			$this->template->load('core_template','welcome_message');
		}
	}
}
