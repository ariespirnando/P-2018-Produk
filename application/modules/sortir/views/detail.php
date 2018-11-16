<table id="tablesortir" class="table table-striped table-bordered tablesortir" width="100%" cellspacing="0">
   <thead>
      <tr> 
          <td style="width:5%">No</td> 
          <th style="width:20%;">Jenis Barang</th>  
          <th style="width:20%;">Total (Kg)</th>    
          <th style="width:10%;text-align: center;">Action</th>
      </tr> 
  </thead>
  <tbody>
    <tr> 
        <td style="width:5%;text-align: center;"><span class="tablesortir_numasd">1</span></td> 
        <td style="width:15%;">  
            <input type="text" class="form-control nama_jenis required_" id="nama_jenis" name="nama_jenis[]" required="required" placeholder="Jenis Barang">
            <input type="hidden" class="form-control required_ imaster_jenis" id="imaster_jenis" name="imaster_jenis[]" required="required" placeholder="Jenis Barang">
        </td> 
       
        <td style="width:5%;"> 
            <input type="text" maxlength="5" style="text-align:right" class="form-control total_seluruh total_kg angka required_angka" id="total_kg" name="total_kg[]" required="required" placeholder="Total Berat" value="0">
        </td> 
         
        <td style="width:10%;text-align: center;"><span onClick="del_row(this,'tablesortir')" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="false"></span></span></td>
    </tr> 
  </tbody>
  <tfoot>
   <tr>
    <td colspan="2" align="left">   
    </td>
    <td>   
      <input type="text" style="text-align:right" class="form-control total_all angka required_angka" readonly id="total_all" name="total_all" required="required" placeholder="Total Seluruh">
    </td>
    <td>   
    </td>
   </tr>
   <tr>
     <td colspan="6" align="left"> 
        <span onClick="add_row2('tablesortir')" class="btn btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="false"> Detail</span> </span> 
        <span onClick="simpanapp()" class="btn btn-warning"><span class="glyphicon glyphicon-edit" aria-hidden="false"> Prosess</span> </span>
       </div>
     </td>
    </tr>
 </tfoot>
 </table>

 