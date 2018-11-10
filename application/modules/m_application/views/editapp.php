 
<hr>
 
<form method="post" id="frm" name="frm" action="<?php echo $url_action?>">  
  <div class="form-group">
      <label>Nama Aplikasi</label>
      <input type="text" class="form-control" id="vmodule" name="vmodule" required="required" placeholder="Nama Aplikasi" value="<?php echo $res->vmodule ?>">
      <input type="hidden" class="form-control" id="iapp_erpmodule" name="iapp_erpmodule" required="required" placeholder="Nama Aplikasi" value="<?php echo $iapp_erpmodule ?>"
  </div> 
</form>
<br>

<div class="col-md-6">   
</div>
<div class="col-md-6 text-right">   
  <div class="form-group">
      <span onclick="updateapp() "class="btn btn-primary">update</span>  
  </div>  
</div>
 
 
 

 
 

 