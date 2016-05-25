<?php $this->load->view('admin/include/head'); ?>

    <div id="wrapper">

		<?php $this->load->view('admin/include/nav'); ?>    

<script type="text/javascript">
function modaledit(nilai,nilai2,nilai3){
  document.nmform.nm.value = nilai;
  document.nmform.nmfolder.value = nilai2;
  document.nmform.tgl.value = nilai3;
}
function modaldelete(nilai,nilai2){
  document.deletefolder.nm.value = nilai;
  document.deletefolder.nmfolder.value = nilai2;
}
</script>





<div id="page-wrapper">
	<div class="container-fluid">
		<br/>
		<ol class="breadcrumb">
			<li>Folder Gallery Foto</li>
		</ol>

		<div style="float:right;">
	         <a href="javascript:;" data-toggle="modal" data-target="#newfolder" class="btn btn-default"><i class="fa fa-folder"></i> New Folder </a>
	    </div>

		<div class="row">

			<div class="col-md-12">
				
				<!---->
				  <br/>

				  <div class="dataTable_wrapper">
					<table class="table table-striped table-bordered table-hover">
					  <thead>
						<tr>
						  <th width="5px">#</th>
						  <th width="100px">Cover</th>
						  <th>Folder</th>
						  <th width="110px"></th>
						</tr>
					  </thead>
					  <tbody>
						<?php 
						
						
						foreach ($sql->result_array() as $row)
						{ $n +=1 ;
							if($row['cover']==''){
								$cover='<a href="javascript:;" onClick="cari_thumbnail('.$row['n'].');" id="'.$row['n'].'" title="Where the thumbnail?" data-toggle="modal" data-target="#thumbnail">No Thumbnail</a>'; 
							}else{
								$cover='<a href="javascript:;" onClick="cari_thumbnail('.$row['n'].');" id="'.$row['n'].'" title="Change thumbnail?" data-toggle="modal" data-target="#thumbnail">
								<img src="'.base_url('_images/gallery/90x55/'.$row['cover'].'.jpg').'" width="90px" height="55px" /></a>'; 
							}
						  $k = explode('-',$row['tgl']);
						  $tgl = $k[2].'/'.$k[1].'/'.$k[0];
						?>
						<tr>
						  <td><?php echo $n; ?></td>
						  <td><?php echo $cover; ?></td>  
						  <td>
						  	  <a href="<?php echo base_url('images/detailfoto/'.$row['n']); ?>"><?php echo $row['folder']; ?></a>
							  <br /><?php echo $tgl; ?>
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
								<li><a href="javascript:;" name="<?php echo $row['folder']; ?>"
								id="<?php echo $row['n']; ?>" lang="<?php echo $tgl; ?>"
								onclick="modaledit(this.id,this.name,this.lang);" data-toggle="modal"
								data-target="#edit">Edit</a></li>
								
								<li><a href="javascript:;" name="<?php echo $row['folder']; ?>" id="<?php echo $row['n']; ?>"
								onclick="modaldelete(this.id,this.name);" data-toggle="modal" data-target="#delete">Delete</a></li>
							  </ul>
							</div>
						  </td>
						</tr>
						<?php } ?>
					  </tbody>
					</table>
				  </div>
				  <ul class="pagination pull-right">
					<?php
						echo $linkHalaman;
					?>
				  </ul>  
				</div>
				<!---->
				
				
			</div>
		</div>
	</div>


      <!-- Modal -->
      <div class="modal fade" id="newfolder" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">

           <?php echo form_open('images/newfoldergallery'); ?>

			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">
			  <span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title" id="myModalLabel">Tulis nama folder yang akan Anda ciptakan !</h4>
			  <input name="xyz" type="text" class="form-control"><h4>Tanggal Format dd/mm/yyyy : </h4>
			  <input name="tgl" type="text" class="form-control" value="<?php echo date('d/m/Y') ?>" width="200px">
            </div>
            <div class="modal-footer">
			  <button type="submit" class="btn btn-primary">Create</button>
            </div>
		   <?php echo form_close(); ?>
          </div>
        </div>
      </div>
	  
	  <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
           
           <?php echo form_open('images/editfoldergallery','name="nmform"'); ?>

			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">
			  <span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title" id="myModalLabel">Edit folder terpilih !</h4>
			  <input name="nm" type="hidden" value="">
			  <input name="nmfolder" type="text" class="form-control" value=""><h4>Tanggal Format dd/mm/yyyy : </h4>
			  <input name="tgl" type="text" class="form-control" value="" width="200px">
            </div>
            <div class="modal-footer">
			  <button type="submit" class="btn btn-primary">Edit</button>
            </div>
		   <?php echo form_close(); ?>
          </div>
        </div>
      </div>
	  
	  <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
           
           <?php echo form_open('images/deletegallery','name="deletefolder"'); ?>

			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">
			  <span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title" id="myModalLabel">Perhatikan!<br />
			  Jika menghapus folder ini, maka isi di dalamnya ikut terhapus.</h4>
			  <input name="nm" type="hidden" value="">
			  <input name="nmfolder" type="text" class="form-control" value="" disabled>
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


 

	  <div class="modal fade" id="thumbnail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width:850px">
          <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">
			  <span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              	<div id="muntah_disini"></div>
            </div>
            <div class="modal-footer">
			  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>



<script type="text/javascript">

	function cari_thumbnail(idx) {
		mpic = "<?php echo base_url('images/thumbnail'); ?>";
		$.ajax({
			type: "POST",
			url: mpic + '/' + idx,
			data: '',
			cache: false,
			beforeSend: function()
			{
				$("#muntah_disini").html('<br/>load...');
			},
			success: function(response)
			{
				$("#muntah_disini").html('<h4>&nbsp; &nbsp;Select Thumbnail</h4>'+response);
			}
		});
	};

	function thumbnail_terpilih(idx) {

		jmlfile = $('#jmlfile').val();
		idfolder = $('#idfolder').val();

		for (i = 1; i <= jmlfile; i++) {
			xfile = $('#id_'+i).val();
			$("#"+xfile).attr("style","width:182px;height:130px;padding:5px 5px 5px 5px;margin:5px 10px 5px 10px;float:left;");
		};

		$("#f_"+idx).attr("style","width:182px;height:130px;padding:5px 5px 5px 5px;margin:5px 10px 5px 10px;float:left;background-color:#66FF66");
		
		mpic = "<?php echo base_url('images/select_thumbnail'); ?>";
		$.ajax({
			type: "POST",
			url: mpic + '/' + idfolder + '/' + idx,
			data: '',
			cache: false,
			beforeSend: function()
			{
				
			},
			success: function()
			{
				window.location= "<?php echo base_url('images/gallery/'.$nomer); ?>";
			}
		});
	};

</script>



<?php $this->load->view('admin/include/foot'); ?>