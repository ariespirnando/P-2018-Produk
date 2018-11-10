<h4>Application</h4>
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
	               <th width="40%" style="text-align: center;vertical-align: middle;">Nama Aplikasi</th>  
	               <th width="15%" style="text-align: center;vertical-align: middle;">Tanggal Dibuat</th> 
                 <th width="10%" style="text-align: center;vertical-align: middle;">Keterangan</th>  
	               <th width="5%" style="text-align: center;vertical-align: middle;">Module</th>
                 <th width="5%" style="text-align: center;vertical-align: middle;">Group</th> 
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
     <span class="btn btn-primary" onclick="adddata()">Add Data</span> 
    </div>
    <div class="col-md-6 text-right"> 
      <div style='margin-top: 10px;' id='pagination'></div>
    </div>
</div>

<div class="adddata"></div>

<?php $this->load->view('index_js',true); ?>

 