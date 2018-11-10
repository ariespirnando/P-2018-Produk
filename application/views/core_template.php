<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ERP Systems</title>
    <link rel="icon" href="<?php echo base_url()?>/assets/logo.png">
    <!-- Bootstrap Styles-->
    <link href="<?php echo base_url() ?>assets/css/bootstrap.css" rel="stylesheet" /> 
    <link href="<?php echo base_url() ?>assets/css/custom-styles.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>assets/css/jquery-ui.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>assets/css/jquery-confirm.min.css" rel="stylesheet" />

    <style type="text/css">  
    </style> 

     <link href="<?php echo base_url('assets/jquery-ui-1.12.1.custom/jquery-ui.min.css');?>" rel="stylesheet">
     <link href="<?php echo base_url('assets/jquery-ui-1.12.1.custom/jquery-ui.structure.min.css');?>" rel="stylesheet">
     <link href="<?php echo base_url('assets/jquery-ui-1.12.1.custom/jquery-ui.theme.min.css');?>" rel="stylesheet"> 
     <link href="<?php echo base_url('assets/fontawesome/css/fontawesome-all.min.css');?>" rel="stylesheet">
    
       
    <script src="<?php echo base_url() ?>assets/js/jquery.js"></script>
    <script src="<?php echo base_url() ?>assets/js/jquery-confirm.min.js"></script>
    <script src="<?php echo base_url('assets/jquery-ui-1.12.1.custom/jquery-ui.min.js');?>"></script> 

    <script type="text/javascript" src="<?php echo base_url() ?>assets/js/bootstrap-datepicker.js"></script>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap-datepicker3.css"/>

    <script src="<?php echo base_url() ?>assets/js/alert.js"></script>
     
     
    
     <!-- Google Fonts--> 
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
               <a class="navbar-brand" href="#"><strong>ERP Systems</strong></a>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                 
                <!-- /.dropdown --> 
                
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user"> 
                        <li><a href="<?php echo base_url()?>/m_karyawan/updateprofile/<?php echo $this->session->userdata('capp_employee')?>"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url()?>/auth/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
        </nav>
        <!--/. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">

                    <li>
                        <a class="active-menu" href="<?php echo base_url()?>"><i class="fa fa-dashboard"></i> Dashboard</a>
                    </li> 

                    <?php 
                        $data = $this->db->query("select a.iapp_erpmodule, a.vmodule from erplaning.app_erpmodule a where a.iactivied = 0")->result_array();
                        foreach ($data as $d) {
                            $sql = "select * from erplaning.app_erpmoduldetail a where a.iactived=0 and a.iapp_erpmodule =".$d['iapp_erpmodule']." and a.itipe=1";

                            //Cek Module Teratas 
                            $cek1 = "select * from erplaning.app_erpgroup_user a 
                                        where a.iapp_erpmodule = '".$d['iapp_erpmodule']."' 
                                              and a.capp_employee= '".$this->session->userdata('capp_employee')."'"; 
                            if($this->db->query($cek1)->num_rows()>0){



                                if($this->db->query($sql)->num_rows()>0){
                                    ?>
                                    <li>
                                        <a href="#"><i class="fa fa-edit"></i> <?php echo $d['vmodule'] ?><span class="fa arrow"></span></a>
                                        <ul class="nav nav-second-level">
                                    <?php
                                    $kata = $this->db->query($sql)->result_array();
                                    foreach ($kata as $k) {
                                        //Cek Bagian Bawah
                                        $cek2 = 'SELECT ac.iview FROM erplaning.app_erpgroup_config ac
                                                    JOIN erplaning.app_erpgroup_user au on ac.iiapp_erpgroup = au.iiapp_erpgroup 
                                                        and ac.iapp_erpmodule and au.iapp_erpmodule 
                                                    WHERE au.capp_employee = "'.$this->session->userdata('capp_employee').'" and ac.iapp_erpmodule="'.$d['iapp_erpmodule'].'" and ac.iapp_erpmoduldetail="'.$k['iapp_erpmoduldetail'].'" 
                                                     ';
                                        $cekcek = $this->db->query($cek2)->row_array();
                                        if(!empty($cekcek['iview']) && $cekcek['iview']==1){



                                            $sql2 = "select * from erplaning.app_erpmoduldetail a where a.iactived=0 and a.iapp_erpmodule =".$d['iapp_erpmodule']." and a.itipe=2 and a.iparent=".$k['iapp_erpmoduldetail'];
                                            if($this->db->query($sql2)->num_rows()>0){
                                                ?>
                                                    <li>
                                                        <a href="#"><?php echo $k['tnamedetail'] ?><span class="fa arrow"></span></a>
                                                        <ul class="nav nav-third-level">
                                                            <?php 
                                                                $kaka = $this->db->query($sql2)->result_array();
                                                                foreach ($kaka as $ka) {

                                                                    //Cek Bagian Paling Bawah
                                                                    $cek2 = 'SELECT ac.iview FROM erplaning.app_erpgroup_config ac
                                                                                JOIN erplaning.app_erpgroup_user au on ac.iiapp_erpgroup = au.iiapp_erpgroup 
                                                                                    and ac.iapp_erpmodule and au.iapp_erpmodule 
                                                                                WHERE au.capp_employee = "'.$this->session->userdata('capp_employee').'" and ac.iapp_erpmodule="'.$d['iapp_erpmodule'].'" and ac.iapp_erpmoduldetail="'.$ka['iapp_erpmoduldetail'].'" 
                                                                                 ';
                                                                    $cekcek = $this->db->query($cek2)->row_array();
                                                                    if(!empty($cekcek['iview']) && $cekcek['iview']==1){ 


                                                                        ?>
                                                                            <li>
                                                                                <a href="<?php echo base_url().$ka['turl'] ?>"><?php echo $ka['tnamedetail'] ?></a>
                                                                            </li>
                                                                        <?php


                                                                        
                                                                    }
                                                                }
                                                            ?> 
                                                        </ul>
                                                    </li> 
                                                <?php
                                            }else{
                                            ?>
                                                <li>
                                                    <a href="<?php echo base_url().$k['turl'] ?>"><?php echo $k['tnamedetail'] ?></a>
                                                </li>
                                            <?php
                                            }
                                        }
                                    }
                                    ?>
                                        </ul>
                                    </li>
                                    <?php
                                }else{
                                    ?>
                                        <li>
                                            <a href="#"><i class="fa fa-edit"></i> <?php echo $d['vmodule'] ?></a>
                                        </li> 
                                    <?php
                                }
                            }
                        }
                    ?>
                </ul>

            </div>

        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner"> 
              <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default"> 
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">  
                                    <?php echo $body ?>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div> 
            </div> 
            </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    
      <!-- Bootstrap Js -->
    <script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="<?php echo base_url() ?>assets/js/jquery.metisMenu.js"></script> 
      <!-- Custom Js -->
    <script src="<?php echo base_url() ?>assets/js/custom-scripts.js"></script>
    
   
</body>
</html>
