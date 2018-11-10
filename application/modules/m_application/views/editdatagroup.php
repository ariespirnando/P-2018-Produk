 
<hr>
 
<form method="post" id="frm" name="frm" action="<?php echo $url_action?>">  
  <div class="form-group">
      <label>Nama Group</label>
      <input type="text" class="form-control reqreq" id="vgroup" name="vgroup" placeholder="Nama Group" value="<?php echo $result->vgroup?>">
       <input type="hidden" class="form-control reqreq" id="iapp_erpmodule" name="iapp_erpmodule"  value="<?php echo $iapp_erpmodule ?>"> 
       <input type="hidden" class="form-control reqreq" id="iiapp_erpgroup" name="iiapp_erpgroup"  value="<?php echo $iiapp_erpgroup ?>">
  </div>  
</form>

<div class="col-md-6">   
</div>
<div class="col-md-6 text-right">   
  <div class="form-group">
      <button id="tbutton" type="submit" onclick="editdata() "class="btn btn-primary">Update</button>  
  </div>  
</div>
 
 
 

 
 

 