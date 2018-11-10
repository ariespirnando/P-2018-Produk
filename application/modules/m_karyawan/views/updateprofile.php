<h4>Master Karyawan - Update Usename & Password</h4>
<hr>

<form method="post" id="frm" name="frm" action="<?php echo $url_action?>"> 
  <div class="form-group">
      <label>Kode Karyawan</label>
      <input type="text" class="form-control" id="cnama" name="cnama" disabled placeholder="Auto Generate !!" value="<?php echo $row->capp_employee.' - '.$row->cnama ?>">
      <input type="hidden" class="form-control" id="iapp_employee" name="iapp_employee" value="<?php echo $id ?>">
  </div>
  <div class="form-group">
      <label>Username Lama</label>
      <input type="text" class="form-control userlama" id="userlama" name="userlama" readonly placeholder="" value="<?php echo $row->vusername ?>"> 
  </div>
  <div class="form-group">
      <label>Username Baru</label>
      <input type="text" class="form-control reqreq" id="userbaru" name="userbaru" placeholder="Username Baru" value="">
  </div>
  <div class="form-group">
      <label>Password Lama</label>
      <input type="password" class="form-control reqreq" id="passlama" name="passlama" placeholder="Password Lama" value="">
  </div>
  <div class="form-group">
      <label>Password Baru</label>
      <input type="password" class="form-control reqreq" id="passbaru" name="passbaru" placeholder="Password Baru" value="">
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
  function simpanapp(){
      var o = 0;
      $( ".reqreq" ).each(function() {
        if($(this).val()==""){
          o++;
        }
      }); 
      if(o>0){
          _costume_alert('Peringatan !', 'Data masih Kosong');
      }else{
        var datas = $('#frm').serialize();
        $.ajax({
         url: '<?php echo base_url()?>m_karyawan/updateprofildata',
         type: 'post', 
         data: datas,
         async: false, 
         success: function(response){  
          var o = $.parseJSON(response); 
          if(o.hsl==1){
            _costume_alert('Info', 'Username & Password berhasil diubah');
            $('.reqreq').val("");
            $('.userlama').val(o.userlama);
          }else if(o.hsl==2){
            _costume_alert('Info', 'Password berhasil diubah');
            $('.reqreq').val("");
          }else{
            _costume_alert('Info', 'Username & Password tidak sesuai');
          } 
         }
        });
      }
     }
</script>
 
 
