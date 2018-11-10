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

     // Load pagination
     function loadPagination(pagno){ 
       var q = $('.searchdata').val();
       $.ajax({
         url: '<?php echo base_url()?>m_application/loadRecord/'+pagno,
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

     function simpanapp(pagno){ 
       var q = $('#vmodule').val();
       if(q==""){
          _costume_alert('Peringatan !', 'Nama Module Kosong');
       }else{
          $.ajax({
             url: '<?php echo base_url()?>m_application/simpanapp/',
             type: 'post',
             data: "vmodule="+q, 
             success: function(response){  
              loadPagination(0);
               _costume_alert('Info', 'Data berhasil disimpan');
             }
           });
       } 
     }

     function updateapp(pagno){ 
       var q = $('#vmodule').val();
       var k = $('#iapp_erpmodule').val();
       if(q==""){
          _costume_alert('Peringatan !', 'Nama Module Kosong');
       }else{
          $.ajax({
             url: '<?php echo base_url()?>m_application/updateapp/',
             type: 'post',
             data: "vmodule="+q, 
              data: {vmodule: q, iapp_erpmodule: k},
             success: function(response){  
              loadPagination(0);
               _costume_alert('Info', 'Data berhasil diupdate');
             }
           });
       } 
     }


     function adddata(){
      if($('.adddata').html()!=""){
        $('.adddata').html("");  
      }else{
        $.ajax({
         url: '<?php echo base_url()?>m_application/adddata',
         type: 'post', 
         success: function(response){ 
            $('.adddata').html(response);  
         }
       });
      }      
     }

     // Create table list
     function createTable(result,sno){
       sno = Number(sno);
       $('#dataload_ok tbody').empty();
       for(index in result){  
          var tr = "<tr>"; 

          var tipe = "Tidak Aktif";
          if(result[index].iactivied==0){
            tipe = "Aktif";
          }

          sno+=1;
          tr += "<td>"+ sno +"</td>";
          tr += "<td>"+ result[index].vmodule +"</td>";
          tr += "<td>"+ result[index].dcreate +"</td>"; 
          tr += "<td>"+ tipe +"</td>";
          tr += "<td style='text-align:center;vertical-align:middle'><a href='<?php echo $addmodule?>/"+result[index].iapp_erpmodule+"'><span class='btn btn-default'><i class='fa fa-plus'></i></span></a></td>";
          tr += "<td style='text-align:center;vertical-align:middle'><a href='<?php echo $addgroup?>/"+result[index].iapp_erpmodule+"'><span class='btn btn-default'><i class='fa fa-plus'></i></span></a></td>"; 
          tr += "<td style='text-align:center;vertical-align:middle'><span onclick='editdata("+ result[index].iapp_erpmodule +")' class='btn btn-primary'><i class='fa fa-edit'></i></span></td>"; 
          tr += "<td style='text-align:center;vertical-align:middle'><a href='<?php echo $delete?>/"+result[index].iapp_erpmodule+"'><span class='btn btn-danger'><i class='fa fa-trash'></i></span></a></td>"; 
          tr += "</tr>";
          $('#dataload_ok tbody').append(tr); 
        }
      } 

      function editdata(i){
        $.ajax({
         url: '<?php echo base_url()?>m_application/editdata',
         type: 'post',
         data: "q="+i, 
         success: function(response){
            $('.adddata').html(response); 
         }
       });
      }

       

</script>