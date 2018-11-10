 
<hr>
 
<form method="post" id="frm" name="frm" action="<?php echo $url_action?>">  
  <div class="form-group">
      <label>Nama Module</label>
      <input type="text" class="form-control reqreq" id="tnamedetail" name="tnamedetail" placeholder="Nama Module" value="">
       <input type="hidden" class="form-control reqreq" id="iapp_erpmodule" name="iapp_erpmodule"  value="<?php echo $iapp_erpmodule ?>">
  </div> 
  <div class="form-group">
      <label>URL</label>
      <input type="text" class="form-control reqreq" id="turl" name="turl" placeholder="URL" value="">
  </div> 
  <div class="form-group">
      <label>Tipe</label>
      <select class="form-control" id="itipe" name="itipe">
          <option value="1">Menu </option>
          <option value="2">Module </option> 
      </select> 
  </div> 
  <div class="form-group">
      <label>Parent (Only Module)</label> 
      <select class="form-control" id="iparent" name="iparent">
          <option value="">--- SELECT ---</option>
          <?php 
          	foreach ($row as $r) {
          		echo ' <option value="'.$r['iapp_erpmoduldetail'].'">'.$r['tnamedetail'].'</option> ';
          	}
          ?> 
      </select>  

  </div> 
</form>

<div class="col-md-6">   
</div>
<div class="col-md-6 text-right">   
  <div class="form-group">
      <button id="tbutton" type="submit" onclick="simpanapp() "class="btn btn-primary">Simpan</button>  
  </div>  
</div>
 
 
 

 
 

 