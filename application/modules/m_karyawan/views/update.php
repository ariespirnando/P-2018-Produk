<h4>Master Karyawan - Update Data Karyawan</h4>
<hr>

<form method="post" id="frm" name="frm" action="<?php echo $url_action?>"> 
  <div class="form-group">
      <label>Kode Karyawan</label>
      <input type="text" class="form-control" id="cnama" name="cnama" disabled placeholder="Auto Generate !!" value="<?php echo $row->capp_employee ?>">
      <input type="hidden" class="form-control" id="iapp_employee" name="iapp_employee" value="<?php echo $id ?>">
  </div>
  <div class="form-group">
      <label>Nama Karyawan</label>
      <input type="text" class="form-control" id="cnama" name="cnama" required="required" placeholder="Nama Karyawan" value="<?php echo $row->cnama ?>">
  </div>
  <div class="form-group">
      <label>Tanggal Bergabung</label>
      <input readonly type="text" class="form-control" id="date" name="din" required="required" placeholder="Tanggal Bergabung" value="<?php echo $row->din ?>">
  </div>

  <div class="form-group">
      <label>Tipe Karyawan</label>
       <select class="form-control" id="tipe" name="tipe">
         <?php 
            if($row->tipe==0){
              echo '<option value="0" selected>KRYW LEPAS</option> ';
            }else{
              echo '<option value="0">KRYW LEPAS</option> ';
            }

            if($row->tipe==1){
              echo '<option value="1" selected>KRYW TETAP</option> ';
            }else{
              echo '<option value="1">KRYW TETAP</option> ';
            }
          ?> 
      </select> 
  </div> 

  <div class="form-group">
      <label>Tanggal Berhenti</label>
      <input type="text" readonly class="form-control" id="date2" name="dout" required="required" placeholder="Tanggal Berhenti" value="<?php echo $row->dout ?>">
  </div>
  
  <div class="col-md-6">   
  </div>
  <div class="col-md-6 text-right">   
  <div class="form-group">
      <button id="tbutton" type="submit" class="btn btn-primary">Update</button> 
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

    var date_input2=$('input[id="date2"]');  
    date_input2.datepicker({
      format: 'yyyy-mm-dd', 
      todayHighlight: true,
      autoclose: true,
    })

  })
</script>
 
