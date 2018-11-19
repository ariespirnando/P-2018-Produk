<h4>Payroll : Generate Gaji</h4>
<hr> 
  
<div class="table-responsive">                                 
    <table id="dataload_ok" class="table table-bordered table-striped" width="90%">  
	     <thead>  
	     	  <tr> 
                 <th colspan="2" style="text-align: left;vertical-align: middle;">Timbang [Sortir]</th>      
	             <th colspan="2" style="text-align: right;vertical-align: middle;"><span onClick="sortir('<?php echo $hari ?>')"  class="btn btn-warning">Bayar [SORTIR]</span></th> 
	          </tr> 
	          <tr> 
                 <th width="2%" style="text-align: center;vertical-align: middle;">No</th>    
	             <th width="25%" style="text-align: center;vertical-align: middle;">Pekerja</th> 
                 <th width="20%" style="text-align: center;vertical-align: middle;">Total (Rp.)</th>   
	             <th width="5%" style="text-align: center;vertical-align: middle;">Detail</th> 
	          </tr>  
	     </thead>  
         <tbody>
         	<?php 
         		$i = 1;
         		$total = 0;
         		foreach ($sortir as $s) {
         			echo '<tr>';
         				echo '<td style="text-align: center;vertical-align: middle;" >'.$i++.'</td>';
         				echo '<td>'.$s['cnama'].'</td>';
         				echo '<td style="text-align: right;vertical-align: middle;">'.number_format($s['Rupiah']).'</td>';
         				echo '<td></td>';
         			echo "</tr>";
         			$total += $s['Rupiah'];
         		}
         	?> 
         </tbody>
         <tfoot>
         	<tr>
         		<td colspan="2" style="text-align: right;vertical-align: middle;"><b>Total</b></td>
         		<td style="text-align: right;vertical-align: middle;"><b><?php echo number_format($total) ?></b></td><td></td>
         	</tr>
         </tfoot>
    </table>   
</div>   

<hr>
<div class="table-responsive">                                 
    <table id="dataload_ok" class="table table-bordered table-striped" width="90%">  
	     <thead>  
	     	  <tr> 
                 <th colspan="2" style="text-align: left;vertical-align: middle;">Timbang [Giling]</th>      
	             <th colspan="2" style="text-align: right;vertical-align: middle;"><span onClick="timbang('<?php echo $hari ?>')" class="btn btn-warning">Bayar [GILING]</span></th> 
	          </tr> 
	          <tr> 
                 <th width="2%" style="text-align: center;vertical-align: middle;">No</th>    
	             <th width="25%" style="text-align: center;vertical-align: middle;">Pekerja</th> 
                 <th width="20%" style="text-align: center;vertical-align: middle;">Total (Rp.)</th>   
	             <th width="5%" style="text-align: center;vertical-align: middle;">Detail</th> 
	          </tr>  
	     </thead>  
         <tbody> 
         	<?php 
         		$i = 1;
         		$total = 0;
         		foreach ($timbang as $t) {
         			echo '<tr>';
         				echo '<td style="text-align: center;vertical-align: middle;" >'.$i++.'</td>';
         				echo '<td>'.$t['cnama'].'</td>';
         				echo '<td style="text-align: right;vertical-align: middle;">'.number_format($t['Rupiah']).'</td>';
         				echo '<td></td>';
         			echo "</tr>";
         			$total += $t['Rupiah'];
         		}
         	?> 
         </tbody>
         <tfoot>
         	<tr>
         		<td colspan="2" style="text-align: right;vertical-align: middle;"><b>Total</b></td>
         		<td style="text-align: right;vertical-align: middle;"><b><?php echo number_format($total) ?></b></td><td></td>
         	</tr>
         </tfoot>
    </table>   
</div>   

<script type="text/javascript">
    function timbang(hari){
        if(hari=='Sabtu'){
            //Prosess Disini
        }else{ 
            $.confirm({
                title: 'Peringatan !',
                content: 'Hari ini adalah hari <b>'+hari+'</b> dan bukan hari <b>Sabtu</b><br>Ingin Melanjutkan Prosses ?',
                type: 'blue',
                icon: 'fa fa-info-circle',
                animation: 'scale',
                closeAnimation: 'scale',
                typeAnimated: true,
                buttons: {
                    formSubmit: {
                        text: 'Ya',
                        btnClass: 'btn-blue',
                        action: function () {
                             ajaxsimpan('t');
                        }
                    },
                    cancel: function () {
                         
                    },
                }, 
            });
        }
        
    }
    function sortir(hari){
        if(hari=='Sabtu'){
            //Prosess Disini
        }else{
            $.confirm({
                title: 'Peringatan !',
                content: 'Hari ini adalah hari <b>'+hari+'</b> dan bukan hari <b>Sabtu</b><br>Ingin Melanjutkan Prosses ?',
                type: 'blue',
                typeAnimated: true,
                icon: 'fa fa-info-circle',
                animation: 'scale',
                closeAnimation: 'scale',
                buttons: {
                    formSubmit: {
                        text: 'Ya',
                        btnClass: 'btn-blue',
                        action: function () {
                             ajaxsimpan('s');
                        }
                    },
                    cancel: function () {
                         
                    },
                }, 
            });
        }
    }

    function ajaxsimpan(tipe){

    }
</script>