 
<hr>
 
<form method="post" id="frm" name="frm" action="<?php echo $url_action?>">  
  <div class="form-group">
      <label>Nama Module</label>
      <input type="text" class="form-control reqreq" id="tnamedetail" name="tnamedetail" placeholder="Nama Module" value="<?php echo $result->tnamedetail ?>">
      <input type="hidden" class="form-control reqreq" id="iapp_erpmodule" name="iapp_erpmodule"  value="<?php echo $iapp_erpmodule ?>">
      <input type="hidden" class="form-control reqreq" id="iapp_erpmoduldetail" name="iapp_erpmoduldetail"  value="<?php echo $result->iapp_erpmoduldetail ?>">
  </div> 
  <div class="form-group">
      <label>URL</label>
      <input type="text" class="form-control reqreq" id="turl" name="turl" placeholder="URL" value="<?php echo $result->turl ?>">
  </div> 
  <div class="form-group">
      <label>Tipe</label>
      <select class="form-control" id="itipe" name="itipe">
         <?php 
            if($result->itipe==1){
              echo '<option value="1" selected>Menu</option> ';
            }else{
              echo '<option value="1">Menu</option> ';
            }

            if($result->itipe==2){
              echo '<option value="2" selected>Module</option> ';
            }else{
              echo '<option value="2">Module</option> ';
            }
          ?>  
      </select> 
  </div> 
  <div class="form-group">
      <label>Parent (Only Module)</label> 
      <select class="form-control" id="iparent" name="iparent">
          <option value="">--- SELECT ---</option>
          <?php 
            foreach ($row as $r) {
              $sel = "";
              if($result->iparent == $r['iapp_erpmoduldetail']){
                $sel = " selected ";
              }
              echo ' <option '.$sel.' value="'.$r['iapp_erpmoduldetail'].'">'.$r['tnamedetail'].'</option> ';
            }
          ?> 
      </select>  

  </div> 
</form>

<div class="col-md-6">   
</div>
<div class="col-md-6 text-right">   
  <div class="form-group">
      <button id="tbutton" type="submit" onclick="editdata() "class="btn btn-primary">Update</button>  
  </div>  
</div>
 
 
 

 
 

 