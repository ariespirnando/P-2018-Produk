<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class generate extends MY_Controller {

	 
	public function index(){	
		if(!$this->session->userdata('loggedin')){   
            redirect('auth');
        }else{
        	$data['hari'] = $this->cek_hari(date('Y-m-d'));
        	$sortir = "SELECT DISTINCT(a.capp_employee), a.cnama, 
				(SELECT sum(d.total_kg * (SELECT m.harga_sortir FROM erp_produk.master_jenis m 
													where m.imaster_jenis=d.imaster_jenis)) 
					FROM erp_produk.sortir_detail d 
					JOIN erp_produk.sortir s2 on d.isortir = s2.isortir
					WHERE s2.capp_employee = a.capp_employee AND s2.isortir = s.isortir)
				 As Rupiah
				FROM erp_produk.sortir s
				JOIN erplaning.app_employee a ON a.capp_employee = s.capp_employee
				WHERE s.istatus_hapus <> 1 AND s.iclose <> 1";
			$data['sortir'] = $this->db->query($sortir)->result_array();

			$timbang = "SELECT DISTINCT(a.capp_employee), a.cnama, 
				(SELECT sum(d.total_kg * (SELECT m.harga_giling FROM erp_produk.master_jenis m 
													where m.imaster_jenis=d.imaster_jenis)) 
					FROM erp_produk.timbang_detail d 
					JOIN erp_produk.timbang s2 on d.itimbang = s2.itimbang
					WHERE s2.capp_employee = a.capp_employee AND s2.itimbang = s.itimbang)
				 As Rupiah
				FROM erp_produk.timbang s
				JOIN erplaning.app_employee a ON a.capp_employee = s.capp_employee
				WHERE s.istatus_hapus <> 1 AND  s.iclose <> 1";
			$data['timbang'] = $this->db->query($timbang)->result_array();
			$this->template->load('core_template','index',$data);
		}
	}
	function cek_hari($tanggal){
		$tgl=substr($tanggal,8,2);
	    $bln=substr($tanggal,5,2);
	    $thn=substr($tanggal,0,4);

	    $info=date('w', mktime(0,0,0,$bln,$tgl,$thn)); 
	    switch($info){
	        case '0': return "Minggu"; break;
	        case '1': return "Senin"; break;
	        case '2': return "Selasa"; break;
	        case '3': return "Rabu"; break;
	        case '4': return "Kamis"; break;
	        case '5': return "Jumat"; break;
	        case '6': return "Sabtu"; break;
	    };
	}
}
