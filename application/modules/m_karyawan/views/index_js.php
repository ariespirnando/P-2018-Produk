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
         url: '<?php echo base_url()?>m_karyawan/loadRecord/'+pagno,
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
  

     // Create table list
     function createTable(result,sno){
       sno = Number(sno);
       $('#dataload_ok tbody').empty();
       for(index in result){  
          var tr = "<tr>";  
          var tipe = "KRYW TETAP";
          if(result[index].tipe==0){
            tipe = "KRYW LEPAS";
          }

          var akt = "Aktif";
          if(result[index].iactivied==1){
            akt = "Tidak Aktif";
          }

          sno+=1;
          tr += "<td>"+ sno +"</td>";
          tr += "<td>"+ result[index].capp_employee +"</td>";
          tr += "<td>"+ result[index].cnama +"</td>";
          tr += "<td>"+ result[index].din +"</td>";
          tr += "<td>"+ tipe +"</td>";
          tr += "<td>"+ akt +"</td>";
          tr += "<td style='text-align:center;vertical-align:middle'><a href='<?php echo $url_edit?>/"+result[index].iapp_employee+"'><span class='btn btn-primary'><i class='fa fa-edit'></i></span></a></td>";
          tr += "<td style='text-align:center;vertical-align:middle'> <a href='<?php echo $url_delete?>/"+result[index].iapp_employee+"'><span class='btn btn-danger'><i class='fa fa-trash'></i></span></a></td>";
          tr += "</tr>";
          $('#dataload_ok tbody').append(tr); 
        }
      } 
 
        
</script>