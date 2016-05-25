<?php $this->load->view('admin/include/head'); ?>

<script type="text/javascript">
function modalshowhide(nilai){
  document.nmshowhide.nm.value = nilai;
}
function modaldelete(nilai,nilai2){
  document.deletet.nm.value = nilai;
  document.deletet.nmt.value = nilai2;
}
</script>


    <div id="wrapper">

        <?php $this->load->view('admin/include/nav'); ?>


        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
            <!-- /.row -->
            <br/>
                <div class="row">
                <div class="col-lg-12">


                    	<h3>Pages
                        	<div style="float:right;">
                            	<a href="<?php echo base_url('pages/newpage'); ?>" type="button" class="btn btn-default">+ Add Page</a>
                            </div>
                        </h3>
                        <br/>
                        <!-- /.panel-heading -->
                        
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th width="5px">ID</th>
                                            <th>Title</th>
                                            <th width="90px">Status</th>
                                            <th width="110px"> </th>
                                        </tr>
                                    </thead>
                                    <tbody>

										<?php
										

										foreach ($sql->result_array() as $row)
										{ $k = explode('-',substr($row['tgl'],0,10));
										  $tgl = $k[2].'/'.$k[1].'/'.$k[0].' '.substr($row['tgl'],11,8);
										  if($row['tampil']=='Y'){
										  	   $status='Yes';
											   $coret1='';
											   $coret2='';
											   $tablecolor = '';
											   $strtampil = 'Sembunyikan';
										  }else{
										  		$status='No';
												$coret1='<s>';
												$coret2='</s>';
												$tablecolor = ' class="danger"';
												$strtampil = 'Tampilkan';
										  }
										?>
										<tr<?php echo $tablecolor; ?>>
										  <td><?php echo $row['n'] ; ?></td>
										  <td>
										  <?php 
												 echo 
												 '<a href="'.base_url('page/'.$row['alias']).'" title="page/'.$row['alias'].'" target="_blank">'
												 .$coret1.'<b>'.$row['judul'].'</b>'.$coret2.'</a>';
												 echo '<br />';
												 echo 'Tanggal: '.$tgl;
										  ?>
										  </td>
										  <td>
										  <?php 
												 echo 'Tampil: '.$status;
												 echo '<br />';
												 echo 'Hits: '.$row['hit'];
										  ?>
										  </td>           
										  <td>
											<!-- Split button -->
											<div class="btn-group">
											  <button type="button" class="btn btn-info">Action</button>
											  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
												<span class="caret"></span>
												<span class="sr-only">Toggle Dropdown</span>
											  </button>
											  <ul class="dropdown-menu" role="menu">
												
												<li><a href="javascript:;" id="<?php echo $row['n']; ?>"
												onclick="modalshowhide(this.id);" data-toggle="modal"
												data-target="#showhide"><?php echo $strtampil ?></a></li>
												
												<li><a href="<?php echo base_url('pages/editpage/'.$row['n']); ?>">Edit</a></li>
												
												<li><a href="javascript:;" name="<?php echo $row['judul']; ?>"
												id="<?php echo $row['n']; ?>" onclick="modaldelete(this.id,this.name);"
												data-toggle="modal" data-target="#delete">Delete</a></li>

											  </ul>
											</div>
										  </td>
										</tr>
										<?php } ?>

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                            
                            <ul class="pagination pull-right">
								<?php
									echo $linkHalaman;
								?>
							</ul> 

	                </div>
	                    <!-- /.panel -->
	                <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->



      <!-- Modal -->
	  <div class="modal fade" id="showhide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width:300px;top:130px">
          <div class="modal-content">
           <?php echo form_open('pages/showhideme', 'name="nmshowhide"'); ?>
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">
			  <span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title" id="myModalLabel">Apakah Anda yakin?</h4>
			  <input name="nm" type="hidden" value="">
            </div>
            <div class="modal-footer">
			  <button type="submit" class="btn btn-default">Yes</button>
			  <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
            </div>
		   <?php echo form_close(); ?>
          </div>
        </div>
      </div>
	  
	  <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="top:100px">
          <div class="modal-content">

           <?php echo form_open('pages/deletepage', 'name="deletet"'); ?>

			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">
			  <span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title" id="myModalLabel">
			   Apakah Anda yakin ingin menghapus halaman dibawah ini?</h4>
			  <input name="nm" type="hidden" value="">
			  <input name="nmt" type="text" class="form-control" value="" disabled>
			  <h4>Masukan kata sandi </h4>
			  <input name="pass" type="password" class="form-control">
            </div>
            <div class="modal-footer">
			  <button type="submit" class="btn btn-default">Yes</button>
			  <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
            </div>
		   <?php echo form_close(); ?>

          </div>
        </div>
      </div>



<?php $this->load->view('admin/include/foot'); ?>