<?php $this->load->view('admin/include/head'); ?>

    <div id="wrapper">

        <?php $this->load->view('admin/include/nav'); ?>



        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Detail Visitor</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                        	<div align="right">
		                        <form action="" method="post">
		                            Dari &nbsp;
		                            <input name="tgl1" class="narrow text input" type="text" value="<?php echo $tgl_1 ;?>" />
		                            &nbsp; s/d &nbsp;
		                            <input name="tgl2" class="narrow text input" type="text" value="<?php echo $tgl_2 ;?>" /> 
		                            &nbsp;
		                            <input type="submit" class="btn btn-primary btn-sm" value=" &nbsp; > &nbsp; " />
		                        </form>
	                        </div>
                            <table class="table table-striped">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>Tanggal</th>
                                  <th>IP</th>
                                  <th>Nama_Komputer</th>
                                  <th>Browser</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php
                                $n=0;
                                foreach ($visitor->result_array() as $row)
                                { $n+=1;
                              ?>
                                <tr>
                                  <td><?php echo $n; ?></td>
                                  <td><?php echo waktu_lalu($row['tgl']); ?></td>
                                  <td><?php echo $row['ip'] ?></td>
                                  <td><?php echo $row['nama_komputer'] ?></td>
                                  <td><?php echo $row['browser']; ?></td>
                                </tr>
                              <?php } ?>
                              </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->



            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                          Jumlah Pengunjung : <button type="button" class="btn btn-danger btn-xs"><?= $jmlvisitor ?></button>
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->



<?php $this->load->view('admin/include/foot'); ?>