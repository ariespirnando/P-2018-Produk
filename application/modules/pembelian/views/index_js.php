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
 
     // Create table list
    

       

       

</script>