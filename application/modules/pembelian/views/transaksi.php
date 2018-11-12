<form method="post" id="frm" name="frm" action=""> 
  <div class="form-group">
      <label>No Transaksi</label>
      <input type="text" class="form-control" disabled placeholder="Auto Generate !!" value="">
  </div>
  <div class="form-group">
      <label>Supplier</label>
      <input type="text" class="form-control nama_suplier" id="nama_suplier" name="nama_suplier" required="required" placeholder="Supplier" value="">
      <input type="hidden" class="form-control imaster_suplier" id="imaster_suplier" name="imaster_suplier" required="required" placeholder="Supplier" value="">
  </div>
  <div class="form-group">
        <div class="form-group">
          <label>Detail Pembelian</label>
          <?php $this->load->view('detail') ?>
      </div>
  </div> 
</form>