<script type="text/javascript">

     //Search SUpplier
     $('.nama_suplier').keyup(function(e) {  
      var config = {
          source: function(request, response) {
              $.getJSON("<?php echo base_url() ?>/pembelian/supplier", { term: $('.nama_suplier').val()}, 
                        response);
          },                     
          select: function(event, ui){
              $('.imaster_suplier').val(ui.item.id);
              $('.nama_suplier').val(ui.item.value);  
              return false;                           
          },
          minLength: 2,
          autoFocus: true,
          };  
          $('.nama_suplier').autocomplete(config);   
    });

     //Search Click
     function search(){
      loadPagination(0);
     }

     $('#pagination').on('click','a',function(e){
        e.preventDefault(); 
        var pageno = $(this).attr('data-ci-pagination-page');
        loadPagination(pageno);
     }); 
     
     loadPagination(0);

     // Load pagination
     function loadPagination(pagno){ 
       var q = $('.searchdata').val();
       $.ajax({
         url: '<?php echo base_url()?>pembelian/loadRecord/'+pagno,
         type: 'post',
         data: "q="+q,
         dataType: 'json',
         success: function(response){
            $('#pagination').html(response.pagination);
            $('.total_data').html(response.total_data); 
            createTable(response.result,response.row);
         }
       });
     }

     function loaddetail(){ 
       $.ajax({
         url: '<?php echo base_url()?>pembelian/loaddetailform',
         type: 'post', 
         success: function(response){
            $('.reload_detail').html(response); 
         }
       });
     }

     function createTable(result,sno){
     sno = Number(sno);
     $('#dataload_ok tbody').empty();
     for(index in result){  
        var tr = "<tr>"; 

        var tipe = "Menu";
        if(result[index].itipe==2){
          tipe = "Module";
        }

        sno+=1;
        tr += "<td>"+ sno +"</td>";
        tr += "<td>"+ result[index].cNomor_pembelian +"</td>"; 
        tr += "<td>"+ result[index].nama_suplier +"</td>"; 
        tr += "<td>"+ convert(result[index].total_all) +"</td>";  
        tr += "<td>"+ result[index].tanggal_pembelian +"</td>"; 
        
        tr += "<td style='text-align:center;vertical-align:middle'><a href='<?php echo $detail?>"+result[index].ipembelian+"'><span class='btn btn-default'><i class='fa fa-folder-open'></i></span></a></td>";  
        tr += "<td style='text-align:center;vertical-align:middle'><span onclick='deletedata("+ result[index].ipembelian +")' class='btn btn-danger'><i class='fa fa-trash'></i></span></td>"; 
        tr += "</tr>";
        $('#dataload_ok tbody').append(tr); 
      }
    } 
 
     // Create table list
    
     function simpanapp(){
      var o = 0;
      var p = 0;


      $( ".required_" ).each(function() {
        if($(this).val()==""){
          o++;
        }
      });
      $( ".required_angka" ).each(function() {
        if($(this).val()=="" || $(this).val()=="0"){
          p++;
        }
      }); 
       
      if(o>0){
          _costume_alert('Peringatan !', 'Data masih Kosong');
      }else if(p>0){
          _costume_alert('Peringatan !', 'Data masih Kosong');
      }else{
        var datas = $('#frm').serialize();
        $.ajax({
         url: '<?php echo base_url()?>pembelian/savedata',
         type: 'post', 
         data: datas,
         success: function(response){  
            _costume_alert('Info', 'Data berhasil diprosess');
            clear();
         }
        });
      }
     }

     function clear(){
      $('.required_angka').val('0');
      $('.required_').val(''); 
      loadPagination(0);
      loaddetail();
     }
       
     function add_row2(table_id) {   
      $("span."+table_id+"_numasd:first").text('1');
      var n = $("span."+table_id+"_numasd:last").text(); 
      var no = parseInt(n);
      var c = no + 1; 
  
      var row_content = ''; 
        row_content  += '<tr>';
        row_content  += '    <td style="width:5%;text-align: center;"><span class="tablepembelian_numasd">'+c+'</span></td>';
        row_content  += '    <td style="width:15%;">'; 
        row_content  += '        <input type="text" class="form-control required_ nama_jenis_'+c+'" id="nama_jenis" name="nama_jenis[]" required="required" placeholder="Jenis Barang">';
        row_content  += '        <input type="hidden" class="form-control required_ imaster_jenis_'+c+'" id="imaster_jenis" name="imaster_jenis[]" required="required" placeholder="Jenis Barang">'; 
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
    function deletedata(i){ 
      var url = '<?php echo base_url()?>pembelian/deleteid';
      _costume_delete(i,'Hapus Data','Keterangan','Keterangan','Data Berhasil dihapus !!',url); 
    }

</script>