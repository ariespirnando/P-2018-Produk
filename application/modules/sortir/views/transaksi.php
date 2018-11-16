<form method="post" id="frm" name="frm" action=""> 
  <div class="form-group">
      <label>No Transaksi</label>
      <input type="text" class="form-control" disabled placeholder="Auto Generate !!" value="">
  </div>
  <div class="form-group">
      <label>Pekerja Lepas</label>
      <input type="text" class="form-control nama_karyawan required_" id="nama_karyawan" name="nama_karyawan" required="required" placeholder="Pekerja Lepas" value="">
      <input type="hidden" class="form-control capp_employee" id="capp_employee" name="capp_employee" required="required" placeholder="Pekerja Lepas" value="">
  </div>
  <div class="form-group">
        <div class="form-group">
          <label>Detail Sortir</label>
          <div class="reload_detail">
            <?php $this->load->view('detail') ?>
          </div>
      </div>
  </div> 
</form>