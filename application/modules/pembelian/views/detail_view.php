<h4>Produk - Detail Transaksi Pembelian</h4>
<hr>

  <div class="form-group">
      <label>No Transaksi</label>
      <input type="text" class="form-control" disabled placeholder="" value="<?php echo $row->cNomor_pembelian ?>">
  </div>
  <div class="form-group">
      <label>Tanggal Transaksi</label>
      <input type="text" class="form-control" disabled placeholder="" value="<?php echo $row->tanggal_pembelian ?>">
  </div>
   <div class="form-group">
      <label>Supplier</label>
      <?php 
        $sql = "select m.nama_suplier from erp_produk.master_suplier m where m.imaster_suplier='".$row->imaster_suplier."'";
        $dt  = $this->db->query($sql)->row();
      ?>
      <input type="text" class="form-control" disabled placeholder="" value="<?php echo $dt->nama_suplier ?>">
  </div>

  <table id="tablepembelian" class="table table-striped table-bordered tablepembelian" width="100%" cellspacing="0">
   <thead>
      <tr> 
          <td style="width:5%">No</td> 
          <th style="width:20%;">Jenis Barang</th> 
          <th style="width:20%;">Harga (Rp/Kg)</th>  
          <th style="width:20%;">Total (Kg)</th>   
          <th style="width:20%;">Total Harga</th>   
      </tr> 
  </thead>
  <tbody>

     <?php 
      $int = 1;
      foreach ($res as $val) {
        ?>
          <tr> 
              <td style="width:5%;text-align: center;"><?php echo $int++?></span></td> 
              <td style="width:15%;">  
                  <input readonly type="text" class="form-control nama_jenis required_" id="nama_jenis" name="nama_jenis[]" required="required" placeholder="Jenis Barang" value="<?php echo $val['nama_jenis']?>"> 
              </td> 
              <td style="width:15%;">  
                <input type="text" readonly maxlength="12" class="form-control harga_beli angka required_angka" id="harga_beli" name="harga_beli[]" required="required" placeholder="Harga Beli" value="<?php echo number_format($val['beli_harga']) ?>">
              </td> 
              <td style="width:5%;"> 
                  <input type="text" readonly maxlength="5" class="form-control total_kg angka required_angka" id="total_kg" name="total_kg[]" required="required" placeholder="Total Berat" value="<?php echo number_format($val['total_kg']) ?>">
              </td> 
              <td style="width:15%;"> 
                  <input type="text" class="form-control total_harga harga_seluruh angka required_angka" readonly id="total_harga" name="total_harga[]" required="required" placeholder="Total Harga" value="<?php echo number_format($val['total_harga']) ?>">
              </td>  
          </tr> 
        <?php 
      }
     ?> 
  </tbody>
  <tfoot>
  <tr>
    <td colspan="4" align="left">   
    </td>
    <td>   
      <input type="text" class="form-control total_all angka required_angka" readonly id="total_all" name="total_all" required="required" placeholder="Total Seluruh" value="<?php echo number_format($row->total_all) ?>">
    </td> 
   </tr>
   <tr>
     <td colspan="6" align="left"> 
        <a class="btn btn-default" href="<?php echo $url_back ?>"><span class="glyphicon glyphicon-backward" aria-hidden="false"> Kembali</span></a> 
     </td>
    </tr>
 </tfoot>
 </table>
  
 
 
<div class="row">
    <div class="col-md-6 text-left">  
      <div style='margin-top: 10px;' id='pagination'></div>
    </div>
    <div class="col-md-6 text-right">  
    </div>
</div>
<script type="text/javascript">
  $(".angka").css('text-align','right');  
</script>
 

 