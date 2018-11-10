<h4>Master Karyawan - Add Data Karyawan</h4>
<hr>
 
<form method="post" id="frm" name="frm" action="<?php echo $url_action?>"> 
  <div class="form-group">
      <label>Kode Karyawan</label>
      <input type="text" class="form-control" id="cnama" name="cnama" disabled placeholder="Auto Generate !!" value="">
  </div>
  <div class="form-group">
      <label>Nama Karyawan</label>
      <input type="text" class="form-control" id="cnama" name="cnama" required="required" placeholder="Nama Karyawan" value="">
  </div>
  <div class="form-group">
      <label>Tanggal Bergabung</label>
      <input type="text" class="form-control" id="date" name="din" readonly required="required" placeholder="Tanggal Bergabung" value="<?php echo date('Y-m-d') ?>">
  </div>

  <div class="form-group">
      <label>Tipe Karyawan</label>
       <select class="form-control" id="tipe" name="tipe">
          <option value="0">KRYW LEPAS </option>
          <option value="1">KRYW TETAP</option> 
      </select> 
  </div> 
  
  <div class="col-md-6">   
  </div>
  <div class="col-md-6 text-right">   
  <div class="form-group">
      <button id="tbutton" type="submit" class="btn btn-primary">Simpan</button> 
      <a href="<?php echo $url_back ?>"><span class="btn btn-warning">Kembali</span></a>
  </div>  
  </div>
</form>
 
 <script>
  $(document).ready(function(){
    var date_input=$('input[id="date"]');  
    date_input.datepicker({
      format: 'yyyy-mm-dd', 
      todayHighlight: true,
      autoclose: true,
    })
  })
</script>
 

 
 

 