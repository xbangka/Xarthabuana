<?php $this->load->view('admin/include/head'); ?>

    <div id="wrapper">

		<?php $this->load->view('admin/include/nav'); ?>  


<?php 

	foreach ($sqlfolder->result_array() as $row)
	{
		$k = explode('-',$row['tgl']);
		$tanggal = $k[2].'/'.$k[1].'/'.$k[0];
		$judul = $row['folder'];
	}

?>
<script type="text/javascript">
function modaledit(nilai,nilai2,nilai3,nilai4){
  document.nmform.nm.value = nilai;
  document.nmform.nmtgl.value = nilai2;
  document.nmform.nmnama.value = nilai3;
  document.nmform.ket.value = nilai4;
}
function modaldelete(nilai,nilai2){
  document.deletefile.nm.value = nilai;
  document.deletefile.nmfile.value = nilai2;
  document.deletefile.img.src = "<?php echo base_url(); ?>_images/gallery/172x97/" + nilai2 + ".jpg";

}
</script>
<div id="page-wrapper">
	<div class="container-fluid">
		<br />
		<ol class="breadcrumb">
			<li><?php echo $judul; ?></li>
		</ol>

		<div style="float:right;">
	         <a href="javascript:;" data-toggle="modal" data-target="#upload" class="btn btn-default"><i class="fa fa-folder"></i> Upload </a>
	    </div>

		<div class="row">
			<div class="col-md-12">
				
				<!----><br />
				<?php 
				
				foreach ($sql->result_array() as $row)
				{ 
				
				$k = explode('-',substr($row['tgl'],0,10));
				$tgl= $k[2].'/'.$k[1].'/'.$k[0].' '.substr($row['tgl'],11,8);
				?>
				  <div class="alert alert-info" role="alert">
                      <table width="100%" border="0">
						  <tr>
							<td width="180px" style="text-align:center">
								<img src="<?php echo base_url('_images/gallery/172x97/'.$row['nmfile'].'.jpg'); ?>" width="172px" height="97px" /><br />
								<span style="text-align:center"><?php echo $row['nmfile']; ?></span>
							</td>
							<td valign="top">
								<b><?php echo $row['judul']; ?></b><br />
								<i><?php echo $row['ket']; ?><br />
								<?php echo $tgl; ?></i>
							</td>
							<td align="right" width="93px" valign="top">
							<div class="btn-group">
							  <button type="button" class="btn btn-info">Action</button>
							  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
								<span class="caret"></span>
								<span class="sr-only">Toggle Dropdown</span>
							  </button>
							  <ul class="dropdown-menu" role="menu">
								
								<li><a href="javascript:;" name="<?php echo $row['judul']; ?>" id="<?php echo $row['n']; ?>"
								shape="<?php echo $tgl; ?>" lang="<?php echo $row['ket']; ?>"
								onclick="modaledit(this.id,this.shape,this.name,this.lang);" data-toggle="modal" data-target="#edit">Edit</a></li>
								
								<li><a href="javascript:;" name="<?php echo $row['nmfile']; ?>" id="<?php echo $row['n']; ?>"
								onclick="modaldelete(this.id,this.name);" data-toggle="modal" data-target="#delete">Delete</a></li>
							  </ul>
							</div>
							</td>
						  </tr>
						</table>
                  </div>
				<?php } ?>
				<ul class="pagination pull-right">
					<?php
						echo $linkHalaman;
					?>
				  </ul> 
				<!---->
				
				
			</div>
		</div>
	</div>
</div>

</div>

      <!-- Modal -->
      <div class="modal fade" id="upload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width:500px">
          <div class="modal-content">
           
           <?php echo form_open_multipart('images/uploadfoto'); ?>

			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">
			  <span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title" id="myModalLabel">Upload Foto !</h4>
			  <input name="id" type="hidden" value="<?php echo $id; ?>">
			  <input name="judul" type="hidden" value="<?php echo $judul; ?>">
			  <h4>Tanggal dd/mm/yyyy hh:mm:ss</h4>
			  <input name="tgl" type="text" class="form-control" value="<?php echo $tanggal.date(' H:i:s') ?>">
			  <h4>File</h4>
			  <input type="file" name="foto1">
			  <input type="file" name="foto2">
			  <input type="file" name="foto3">
			  <input type="file" name="foto4">
			  <input type="file" name="foto5">
            </div>
            <div class="modal-footer">
			  <button type="submit" class="btn btn-primary">Upload</button>
			  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
		   <?php echo form_close(); ?>
          </div>
        </div>
      </div>
	  
	  <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
           
           <?php echo form_open('images/editfilefoto', 'name="nmform"'); ?>

			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">
			  <span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title" id="myModalLabel">Update foto terpilih !</h4>
			  <input name="nm" type="hidden" value="">
			  <h4>Folder:</h4>
			  <select class="form-control margin-bottom-15" name="folder">
				<?php
				foreach ($sql2->result_array() as $ro)
				{ 
					if($id==$ro['n']){ ?>
					<option value="<?php echo $ro['n']; ?>" selected="selected"><?php echo $ro['folder']; ?></option>

				<?php }else{ ?>

					<option value="<?php echo $ro['n']; ?>"><?php echo $ro['folder']; ?></option>

				<?php } } ?>
			  </select>
			  <h4>Tanggal :</h4>
			  <input name="nmtgl" type="text" class="form-control" value="">
			  <h4>Nama foto :</h4>
			  <input name="nmnama" type="text" class="form-control" value="">
			  <h4>Keterangan :</h4>
			  <input name="ket" type="text" class="form-control" value="">
            </div>
            <div class="modal-footer">
			  
			  <button type="submit" class="btn btn-primary">Edit</button>
            </div>
		   <?php echo form_close(); ?>
          </div>
        </div>
      </div>
	  
	  <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width:350px">
          <div class="modal-content">
           
           <?php echo form_open('images/deletefilefoto', 'name="deletefile"'); ?>

			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">
			  <span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title" id="myModalLabel">
			  Yakin ingin menghapus foto ini?</h4>
			  <input name="nm" type="hidden" value="">
			  <input name="nmfile" type="hidden" value="">
			  <img name="img" src="" width="172px" height="97px" />
            </div>
            <div class="modal-footer">
			  <button type="submit" class="btn btn-primary">Yes</button>
			  <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            </div>
		   <?php echo form_close(); ?>
          </div>
        </div>
      </div>



<?php $this->load->view('admin/include/foot'); ?>