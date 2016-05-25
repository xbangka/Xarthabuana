<?php $this->load->view('admin/include/head'); ?>

    <div id="wrapper">

        <?php $this->load->view('admin/include/nav'); ?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
            	<!-- /.row -->
            	<br/>
                <div class="row">
                	<div class="col-lg-12">
                    	<h3><?php echo $titlepanel; ?></h3>
                        <br/>
                        <div align="center">
                        	<?php echo $this->session->flashdata('pesan'); ?>
			 			  <!---->
						  <pre <?= $background ?>>
						  <?php echo form_open('tabelpost/simpansidebar'); ?>
							<?= $maxwidth ?>
							<input type="hidden" value="<?= $id ?>" name="sidebarid">
							<textarea name="isi" style="width:200px" rows="29">
								<?=$isi?>
							</textarea>
							<br />
							<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update </button>
							<?php echo form_close(); ?>
							</pre>
						  <!---->

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