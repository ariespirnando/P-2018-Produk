<table id="tablepembelian" class="table table-striped table-bordered tablepembelian" width="100%" cellspacing="0">
   <thead>
      <tr> 
          <td style="width:5%">No</td> 
          <th style="width:20%;">Jenis Barang</th> 
          <th style="width:20%;">Harga (Rp/Kg)</th>  
          <th style="width:20%;">Total (Kg)</th>   
          <th style="width:20%;">Total Harga</th>  
          <th style="width:10%;text-align: center;">Action</th>
      </tr> 
  </thead>
  <tbody>
    <tr> 
        <td style="width:5%;text-align: center;"><span class="tablepembelian_numasd">1</span></td> 
        <td style="width:15%;">  
            <input type="text" class="form-control nama_jenis required_" id="nama_jenis" name="nama_jenis[]" required="required" placeholder="Jenis Barang">
            <input type="hidden" class="form-control imaster_jenis" id="imaster_jenis" name="imaster_jenis[]" required="required" placeholder="Jenis Barang">
        </td> 
        <td style="width:15%;">  
          <input type="text" maxlength="12" class="form-control harga_beli angka required_angka" id="harga_beli" name="harga_beli[]" required="required" placeholder="Harga Beli">
        </td> 
        <td style="width:5%;"> 
            <input type="text" maxlength="5" class="form-control total_kg angka required_angka" id="total_kg" name="total_kg[]" required="required" placeholder="Total Berat" value="0">
        </td> 
        <td style="width:15%;"> 
            <input type="text" class="form-control total_harga harga_seluruh angka required_angka" readonly id="total_harga" name="total_harga[]" required="required" placeholder="Total Harga">
        </td> 
        <td style="width:10%;text-align: center;"><span onClick="del_row(this,'tablepembelian')" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="false"></span></span></td>
    </tr> 
  </tbody>
  <tfoot>
   <tr>
    <td colspan="4" align="left">   
    </td>
    <td>   
      <input type="text" class="form-control total_all angka required_angka" readonly id="total_all" name="total_all[]" required="required" placeholder="Total Seluruh">
    </td>
    <td>   
    </td>
   </tr>
   <tr>
     <td colspan="6" align="left"> 
        <span onClick="add_row2('tablepembelian')" class="btn btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="false"> Detail</span> </span> 
        <span onClick="add_row2('tablepembelian')" class="btn btn-warning"><span class="glyphicon glyphicon-edit" aria-hidden="false"> Prosess</span> </span>
       </div>
     </td>
    </tr>
 </tfoot>
 </table>

<script type="text/javascript"> 
    function add_row2(table_id) {   
      $("span."+table_id+"_numasd:first").text('1');
      var n = $("span."+table_id+"_numasd:last").text(); 
      var no = parseInt(n);
      var c = no + 1; 
  
      var row_content = ''; 
        row_content  += '<tr>';
        row_content  += '    <td style="width:5%;text-align: center;"><span class="tablepembelian_numasd">'+c+'</span></td>';
        row_content  += '    <td style="width:15%;">'; 
        row_content  += '        <input type="text" class="form-control required nama_jenis_'+c+'" id="nama_jenis" name="nama_jenis[]" required="required" placeholder="Jenis Barang">';
        row_content  += '        <input type="hidden" class="form-control imaster_jenis_'+c+'" id="imaster_jenis" name="imaster_jenis[]" required="required" placeholder="Jenis Barang">'; 
        row_content  += '    </td>';  
        row_content  += '    <td style="width:15%;">'; 
        row_content  += '        <input type="text" maxlength="12" class="form-control required_angka harga_beli_'+c+' angka_'+c+' " id="harga_beli" name="harga_beli[]" required="required" placeholder="Harga Beli">';
        row_content  += '    </td>';  
        row_content  += '    <td style="width:5%;">'; 
        row_content  += '        <input type="text" maxlength="5" class="form-control required_angka total_kg_'+c+' angka_'+c+' " id="total_kg" name="total_kg[]" required="required" placeholder="Total Berat">';
        row_content  += '    </td>';  
        row_content  += '    <td style="width:15%;">'; 
        row_content  += '        <input type="text" readonly class="form-control required_angka total_harga_'+c+' angka_'+c+' harga_seluruh" id="total_harga" name="total_harga[]" required="required" placeholder="Total Harga">';
        row_content  += '    </td>';   
        row_content  += '    <td style="width:10%;text-align: center;"><span onClick="del_row(this, \'tablepembelian\')" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="false"></span></span></td>';
        row_content  += '</tr>'; 

        $('table#'+table_id+' tbody tr:last').after(row_content);
        $('table#'+table_id+' tbody tr:last input').val("");
        $('table#'+table_id+' tbody tr:last div').text("");
        $("span."+table_id+"_num:last").text(c); 
        $(".total_kg_"+c).val(0);

      $(".angka_"+c).css('text-align','right'); 
      $('.harga_beli_'+c).keyup(function(e) {   
        var numbers = /^[0-9,.]+$/;
        if(this.value.match(numbers)){
          var harga = join($(this).val());
          var kg    = join($(".total_kg_"+c).val()); 
          var hitung= harga * kg;
          $('.total_harga_'+c).val(convert(hitung));    
          $(this).val(convert(harga)); 
        }else{
          _costume_alert('Info', 'Hanya Huruf');
           $(this).val(convert(0));
           $('.total_harga_'+c).val(0);
        }
        hitungseluruh()
       });
       $('.total_kg_'+c).keyup(function(e) {   
         var numbers = /^[0-9,.]+$/;
         if(this.value.match(numbers)){
           var harga = join($(".harga_beli_"+c).val());
           var kg    = join($(this).val());  
           var hitung= harga * kg;
           $('.total_harga_'+c).val(convert(hitung));  
           $(this).val(convert(kg));
         }else{
          _costume_alert('Info', 'Hanya Huruf');
           $(this).val(convert(0));
           $('.total_harga_'+c).val(0); 
         }
         hitungseluruh() 
       });


       $('.nama_jenis_'+c).keyup(function(e) {  
          var config = {
              source: function(request, response) {
                  $.getJSON("<?php echo base_url() ?>/pembelian/jenis", { term: $('.nama_jenis_'+c).val()}, 
                            response);
              },                     
              select: function(event, ui){
                  $('.imaster_jenis_'+c).val(ui.item.id);
                  $('.nama_jenis_'+c).val(ui.item.value);  
                  $('.harga_beli_'+c).val(ui.item.harga); 
                  return false;                           
              },
              minLength: 2,
              autoFocus: true,
          };  
          $('.nama_jenis_'+c).autocomplete(config);   
          $(this).keypress(function(e){
          if(e.which != 13 ) {
                  if(e.which != 9 ) {
                   $('.imaster_jenis_'+c).val('');
                  }
              }           
          });
          $(this).blur(function(){
              if($('.imaster_jenis_'+c).val() == '') {
                  $(this).val('');
              }           
          });  
        }); 
      }

      function del_row(dis, conname) {
         if($('.'+conname+' tr').length > 4) {
           $(dis).parent().parent().remove(); 
           hitungseluruh()
         }
         else {
            _costume_alert('Info', 'Tidak Bisa di Hapus');
         }
      }  
 
     $('.harga_beli').keyup(function(event) {  
       var numbers = /^[0-9,.]+$/;
        if(this.value.match(numbers)){
           var harga = join($(this).val());
           var kg    = join($(".total_kg").val()); 
           var hitung= harga * kg;
           $('.total_harga').val(convert(hitung));    
           $(this).val(convert(harga)); 
        }else{
           _costume_alert('Info', 'Hanya Huruf');
           $(this).val(convert(0)); 
           $('.total_harga').val(0);    
        }
        hitungseluruh() 
     });
     $('.total_kg').keyup(function(e) {  
        var numbers = /^[0-9,.]+$/;
        if(this.value.match(numbers)){
         var harga = join($(".harga_beli").val());
         var kg    = join($(this).val());  
         var hitung= harga * kg;
         $('.total_harga').val(convert(hitung));  
         $(this).val(convert(kg));
        }else{
          _costume_alert('Info', 'Hanya Huruf');
          $(this).val(convert(0)); 
          $('.total_harga').val(0);  
        }
        hitungseluruh() 
     });

     function convert(angka){ 
       return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","); 
     }
     function join(str){  
       const tokens = str.toString().split(',').join(''); 
       return tokens;
     }
     function hitungseluruh(){   
      var total = 0;
      $(".harga_seluruh").each(function() {
          var str    = this.value;  
          var values = join(str);
          if(values !=0 || values !=''){ 
            total = math.add(total, values);
          }
      }); 
      $('.total_all').val(convert(total));
     } 
     $(".angka").css('text-align','right');  

     $('.nama_jenis').keyup(function(e) {  
      var config = {
          source: function(request, response) {
              $.getJSON("<?php echo base_url() ?>/pembelian/jenis", { term: $('.nama_jenis').val()}, 
                        response);
          },                     
          select: function(event, ui){
              $('.imaster_jenis').val(ui.item.id);
              $('.nama_jenis').val(ui.item.value);  
              $('.harga_beli').val(ui.item.harga);   
              return false;                           
          },
          minLength: 2,
          autoFocus: true,
      };  
      $('.nama_jenis').autocomplete(config);   
      $(this).keypress(function(e){
        if(e.which != 13 ) {
            if(e.which != 9 ) {
             $('.imaster_jenis').val('');
            }
        }           
      });
      $(this).blur(function(){
          if($('.imaster_jenis').val() == '') {
              $(this).val('');
          }           
      });  
    });

</script>