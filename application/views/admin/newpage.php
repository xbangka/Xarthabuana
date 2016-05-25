<?php $this->load->view('admin/include/head'); ?>

    <div id="wrapper">

        <?php $this->load->view('admin/include/nav'); ?>



		<script>
		function cekFile() {
		   var cekjudul = document.forms['f']['judul'].value;
		   var cektgl = document.forms['f']['tgl'].value;

		     if(cekjudul==null || cekjudul=="")
		     {
		       alert("Form title harus di isi !!!");
		       return false;
		     }
			 if(cektgl==null || cektgl=="")
		     {
		       alert("Form tanggal atau jam harus di isi !!!");
		       return false;
		     }
		}
		</script>


<link rel="stylesheet" href="<?php echo base_url('_css/datepicker.css'); ?>">

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
            	<!-- /.row -->
            	<br/>
                <div class="row">
                	<div class="col-lg-12">
                    	<h3><?php echo $titlepanel; ?></h3>
                        <br/>

                        <div class="table-responsive">

                        	<?php echo form_open('pages/simpan', 'name="f" onSubmit="return cekFile()"'); ?>

							<input name="id" type="hidden" value="<?php echo $id; ?>"> 

                            <table class="table table-striped">
							  <tbody>
								<tr>
								  <td width="10px">Title</td>
								  <td colspan="3"><input name="judul" type="text" class="form-control" value="<?php echo $judul; ?>"></td>
								  </tr>
								<tr>
								  <td>Alias</td>
								  <td colspan="3"><input name="alias" type="text" class="form-control" value="<?php echo $alias; ?>"></td>
								</tr>
								<tr>
								  <td>DateTime</td>
								  <td>
								  	<input type="text" class="form-control" name="tgl" id="datepicker" style="text-align:center;width:200px" autocomplete="off" value="<?php echo $tgl; ?>"/>
								  </td>
								  <td style="width:20px">Status</td>
								  <td style="width:200px"><select class="form-control" name="status">
										<?php if($tampil=='N'){ ?>
										<option value="<?php echo 'Y'; ?>"><?php echo 'Tampil'; ?></option>
										<option value="<?php echo 'N'; ?>" selected><?php echo 'Tidak Tampil'; ?></option>
										<?php }else{ ?>
										<option value="<?php echo 'Y'; ?>" selected><?php echo 'Tampil'; ?></option>
										<option value="<?php echo 'N'; ?>"><?php echo 'Tidak Tampil'; ?></option>
										<?php } ?>
									  </select>
								  </td>
								</tr>
								<tr>
								  <td>Content</td>
								  <td colspan="3"><textarea name="isi" style="width:100%" rows="29" ><?php echo $isi; ?></textarea></td>
								  </tr>
								<tr>
								  <td>&nbsp;</td>
								  <td><button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save </button></td>
								  <td>&nbsp;</td>
								  <td>&nbsp;</td>
								</tr>
							  </tbody>
                            </table>
                            
                            <?php echo form_close(); ?>
                            
                        </div>

	                </div>
	                <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->




<?php $this->load->view('admin/include/foot'); ?>
<script src="<?php echo base_url('_js/jquery-ui.js'); ?>"></script>
<script src="<?php echo base_url('_js/datepicker.js'); ?>"></script>