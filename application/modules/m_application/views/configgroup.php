<h4><a href="<?php echo $url_back?>"><span class="btn btn-default"><i class='fa fa-arrow-left'></i></span></a> Application :: <?php echo $row->vmodule ?> - Group - Config [<?php echo $res->vgroup ?>] </h4>
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
	               <th width="30%" style="text-align: center;vertical-align: middle;">Nama Module</th>    
	               <th width="5%" style="text-align: center;vertical-align: middle;">View</th> 
	               <th width="5%" style="text-align: center;vertical-align: middle;">Create</th> 
                   <th width="5%" style="text-align: center;vertical-align: middle;">Update</th> 
                   <th width="5%" style="text-align: center;vertical-align: middle;">Delete</th> 
	          </tr>  
	     </thead>  
       <tbody> 
       </tbody>
    </table>  
    
</div>  
<div class="row">
    <div class="col-md-6">  
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
     function loadPagination(pagno){ 
       var q = $('.searchdata').val(); 
       var k = <?php echo $iapp_erpmodule ?>;
       $.ajax({
         url: '<?php echo base_url()?>m_application/loadRecord_module/'+pagno,
         type: 'post',
         data: {q: q, k: k}, 
         dataType: 'json',
         success: function(response){
            $('#pagination').html(response.pagination);
            $('.total_data').html(response.total_data); 
            createTable(response.result,response.row);
         }
       });
     }

     //Aja CLiked
     var iapp_erpmodule = <?php echo $iapp_erpmodule ?>;
     var iiapp_erpgroup = <?php echo $iiapp_erpgroup ?>

     function createTable(result,sno){
     sno = Number(sno);
     $('#dataload_ok tbody').empty();
     for(index in result){  
        var tr = "<tr>"; 
     		var view 	="-";
     		var edit 	="-";
     		var delets  ="-";
     		var add 	="-";

        var v="";e="";d="";a="";
        $.ajax({
           url: '<?php echo base_url()?>m_application/Check',
           type: 'post',
           async: false, 
           data: {iapp_erpmodule: iapp_erpmodule, 
                  iiapp_erpgroup: iiapp_erpgroup,
                  iapp_erpmoduldetail: result[index].iapp_erpmoduldetail, 
                  },  
           success: function(response){   
            var o = $.parseJSON(response); 
            if(o.iview==1){
              v = ' checked ';
            }

            if(o.iedit==1){
              e = ' checked ';
            }

            if(o.idelete==1){
              d = ' checked ';
            }

            if(o.iadd){
              a = ' checked ';
            }
           }
         });

        

        if(result[index].itipe==2){
          view 		= "<input type='checkbox' id='checkbox' "+v+" class='checkbox' onClick='Checked(this,"+result[index].iapp_erpmoduldetail+",1)'>";
          add 		= "<input type='checkbox' id='checkbox' "+a+" class='checkbox' onClick='Checked(this,"+result[index].iapp_erpmoduldetail+",2)'>";
          edit 	= "<input type='checkbox' id='checkbox' "+e+" class='checkbox' onClick='Checked(this,"+result[index].iapp_erpmoduldetail+",3)'>";
          delets 		= "<input type='checkbox' id='checkbox' "+d+" class='checkbox' onClick='Checked(this,"+result[index].iapp_erpmoduldetail+",4)'>";
        }else{
          view 		= "<input type='checkbox' id='checkbox' "+v+" class='checkbox' onClick='Checked(this,"+result[index].iapp_erpmoduldetail+",1)'>";
        }

        sno+=1;
        tr += "<td>"+ sno +"</td>";
        tr += "<td>"+ result[index].tnamedetail +"</td>";
        tr += "<td style='text-align:center;vertical-align:middle'>"+view+"</td>"; 
        tr += "<td style='text-align:center;vertical-align:middle'>"+add+"</td>";  
        tr += "<td style='text-align:center;vertical-align:middle'>"+edit+"</td>"; 
        tr += "<td style='text-align:center;vertical-align:middle'>"+delets+"</td>"; 
        tr += "</tr>";
        $('#dataload_ok tbody').append(tr); 
      }
    }  
    function Checked(iiii,id,func){
      var iapp_erpmoduldetail = id;
      var pro = 1;
      if(iiii.checked != true){
        pro = 0;
      }  

        $.ajax({
           url: '<?php echo base_url()?>m_application/Checked',
           type: 'post',
           data: {iapp_erpmodule: iapp_erpmodule, 
                  iiapp_erpgroup: iiapp_erpgroup,
                  iapp_erpmoduldetail: iapp_erpmoduldetail,
                  pro: pro,
                  func:func
                  },  
           success: function(response){ 
           }
         });
    } 

</script>