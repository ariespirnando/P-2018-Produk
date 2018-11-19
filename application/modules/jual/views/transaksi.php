<form method="post" id="frm" name="frm" action=""> 
  <div class="form-group">
      <label>No Transaksi</label>
      <input type="text" class="form-control" disabled placeholder="Auto Generate !!" value="">
  </div>
  <div class="form-group">
      <label>Pembeli</label>
      <input type="text" class="form-control nama_buyer required_" id="nama_buyer" name="nama_buyer" required="required" placeholder="Pembeli" value="">
      <input type="hidden" class="form-control imaster_buyer" id="imaster_buyer" name="imaster_buyer" required="required" placeholder="Pembeli" value="">
  </div>
  <div class="form-group">
        <div class="form-group">
          <label>Detail Penjualan</label>
          <div class="reload_detail">
            <?php $this->load->view('detail') ?>
          </div>
      </div>
  </div> 
</form>