<h4><a href="<?php echo $url_back?>"><span class="btn btn-default"><i class='fa fa-arrow-left'></i></span></a> Application @ <?php echo $row->vmodule ?> - Group - User [<?php echo $res->vgroup ?>] </h4>
<hr>

<div class="row">
    <div class="col-md-6"> 
      <a href="#" class="btn btn-default">Total Data <span class="total_data"></span></a>
    </div>
    <div class="col-md-6 text-right"> 
      <div class="input-group">
          <input type="text" class="form-control searchdata" name="q" value="">
          <span class="input-group-btn"> 
            <input type="submit" onClick="search()" class="btn btn-success" value="Search"> 
          </span>
      </div>
    </div>
</div>
<br>
<div class="table-responsive">                                 
    <table id="dataload_ok" class="table table-bordered table-striped" width="90%">  
       <thead>  
            <tr> 
                 <th width="2%" style="text-align: center;vertical-align: middle;">No</th>   
                 <th width="20%" style="text-align: center;vertical-align: middle;">Kode</th>    
                 <th width="45%" style="text-align: center;vertical-align: middle;">Nama</th>     
                 <th width="5%" style="text-align: center;vertical-align: middle;">Delete</th> 
            </tr>  
       </thead>  
       <tbody> 
       </tbody>
    </table>  
    
</div>  
<div class="row">
    <div class="col-md-6"> 
     <span class="btn btn-primary" onclick="adddata()">Add Data</span> 
    </div>
    <div class="col-md-6 text-right"> 
      <div style='margin-top: 10px;' id='pagination'></div>
    </div>
</div>

<div class="adddata"></div>

 <script type="text/javascript">
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

     //Load pagination

     //Aja CLiked
     var iapp_erpmodule = <?php echo $iapp_erpmodule ?>;
     var iiapp_erpgroup = <?php echo $iiapp_erpgroup ?>

     function loadPagination(pagno){ 
       var q = $('.searchdata').val(); 
       var g = <?php echo $iiapp_erpgroup ?>;
       var m = <?php echo $iapp_erpmodule ?>;
       $.ajax({
         url: '<?php echo base_url()?>m_application/loadRecord_usergroup/'+pagno,
         type: 'post',
         data: {grop: g, modul: m}, 
         dataType: 'json',
         success: function(response){
            $('#pagination').html(response.pagination);
            $('.total_data').html(response.total_data); 
            createTable(response.result,response.row);
         }
       });
     }
 
     function createTable(result,sno){
       sno = Number(sno);
       $('#dataload_ok tbody').empty();
       for(index in result){    
          sno+=1;
          var tr = "<tr>"; 
          tr += "<td>"+ sno +"</td>";
          tr += "<td>"+ result[index].capp_employee +"</td>"; 
          tr += "<td>"+ result[index].cnama +"</td>"; 
          tr += "<td style='text-align:center;vertical-align:middle'><span onclick='deletegroup("+ result[index].iapp_erpgroup_user +")' class='btn btn-danger'><i class='fa fa-trash'></i></span></td>"; 
          tr += "</tr>";
          $('#dataload_ok tbody').append(tr); 
        }
    }  

    function adddata(){
      if($('.adddata').html()!=""){
        $('.adddata').html("");  
      }else{
        var k = <?php echo $iapp_erpmodule ?>;
        var q = <?php echo $iiapp_erpgroup ?>;
        $.ajax({
         url: '<?php echo base_url()?>m_application/adddatauser',
         type: 'post', 
         data: {iapp_erpmodule: k, 
                iiapp_erpgroup: q
               }, 
         success: function(response){ 
            $('.adddata').html(response);  
         }
       });
      } 
     }
 
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
         url: '<?php echo base_url()?>m_application/savedatauser',
         type: 'post', 
         data: datas,
         success: function(response){ 
           loadPagination(0);
            _costume_alert('Info', 'Data berhasil disimpan');
         }
        });
      }
     }
     
     function deletegroup(i){ 
        $.ajax({
         url: '<?php echo base_url()?>m_application/deleteuser',
         type: 'post', 
         data: "k="+i,
         success: function(response){ 
            loadPagination(0);
            _costume_alert('Info', 'Data berhasil dihapus');s
         }
       });
     }

</script>