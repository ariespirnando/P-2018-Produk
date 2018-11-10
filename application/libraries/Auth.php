<?php
class Auth { 	
	  private $_ci;
    private $sess_auth;
    function __construct() {
        $this->_ci=&get_instance();
        $sess_auth = $this->_ci->session->userdata();

    }
 

    function Akses($controller,$user){ 
      $sql = 'SELECT ac.iview, ac.iedit, ac.idelete, ac.iadd FROM erplaning.app_erpgroup_config ac
              JOIN erplaning.app_erpgroup_user au on ac.iiapp_erpgroup = au.iiapp_erpgroup 
                AND ac.iapp_erpmodule AND au.iapp_erpmodule 
              JOIN erplaning.app_erpmoduldetail ap on ap.iapp_erpmodule = ac.iapp_erpmodule 
                AND ap.iapp_erpmoduldetail = ac.iapp_erpmoduldetail
              WHERE au.capp_employee = "'.$user.'" and ap.turl="'.strtolower($controller).'"';
      return $this->_ci->db->query($sql)->row_array();  
    }
  
	
}
