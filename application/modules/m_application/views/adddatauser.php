 
<hr>
 
<form method="post" id="frm" name="frm" action="<?php echo $url_action?>">  
  <div class="form-group">
      <label>Nama Karyawan</label>
      <input type="text" class="form-control cnama" id="cnama" name="cnama" placeholder="Nama Karyawan" value="">
      <input type="hidden" class="form-control capp_employee" id="capp_employee" name="capp_employee" value="">
      <input type="hidden" class="form-control" id="iapp_erpmodule" name="iapp_erpmodule"  value="<?php echo $iapp_erpmodule ?>">
      <input type="hidden" class="form-control" id="iiapp_erpgroup" name="iiapp_erpgroup"  value="<?php echo $iiapp_erpgroup ?>">
  </div>  
</form>

<div class="col-md-6">   
</div>
<div class="col-md-6 text-right">   
  <div class="form-group">
      <button id="tbutton" type="submit" onclick="simpanapp() "class="btn btn-primary">Simpan</button>  
  </div>  
</div>

<script type="text/javascript">
	$('.cnama').keyup(function(e) { 
	      var config = {
	      	  source: function(request, response) {
	              $.getJSON("<?php echo base_url() ?>/m_karyawan/employeesearch", { term: $('.cnama').val(), iapp_erpmodule: <?php echo $iapp_erpmodule ?> , iiapp_erpgroup: <?php echo $iiapp_erpgroup ?>}, 
	                        response);
	          },                     
	          select: function(event, ui){
	              $('.capp_employee').val(ui.item.id);
	              $('.cnama').val(ui.item.value); 
	              return false;                           
	          },
	          minLength: 2,
	          autoFocus: true,
	          }; 
	      $('.cnama').autocomplete(config);   
	      $(this).keypress(function(e){
	          if(e.which != 13 ) {
	              if(e.which != 9 ) {
	               $('.capp_employee').val('');
	              }
	          }           
	      });
	      $(this).blur(function(){
	          if($('.capp_employee').val() == '') {
	              $(this).val('');
	          }           
	      }); 
	  });
</script>
 
 
 

 
 

 