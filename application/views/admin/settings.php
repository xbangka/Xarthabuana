<?php $this->load->view('admin/include/head'); ?>

    <div id="wrapper">

        <?php $this->load->view('admin/include/nav'); ?>



        <div id="page-wrapper">
            <?php echo $this->session->flashdata('pesan'); ?>
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Settings</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h3>IP Address Visitor <span style="float:right;"><a href="<?= base_url('settings/visitor') ?>" class="btn btn-default">More <i class="fa fa-angle-double-right"></i></a></span></h3>
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

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h3>Log Administrator <span style="float:right;"><a href="<?= base_url('settings/logadmin') ?>" class="btn btn-default">More <i class="fa fa-angle-double-right"></i></a></span></h3>
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
                                foreach ($logadmin->result_array() as $row)
                                { $n+=1;
                              ?>
                                <tr>
                                  <td><?php echo $n; ?></td>
                                  <td><?php echo waktu_lalu($row['tgl']); ?></td>
                                  <td><?php echo $row['ip']; ?></td>
                                  <td><?php echo $row['nama_komputer']; ?></td>
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

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h3>User Table</h3>
                            
                            <table class="table table-striped">
                              <tbody>
                                <tr>
                                  <td>User</td>
                                  <td>: <?php echo $tbluser['username']; ?></td>
                                </tr>
                                <tr>
                                  <td>Sandi</td>
                                  <td>: ****************</td>
                                </tr>
                                <tr>
                                  <td>Nama</td>
                                  <td>: <?php echo $tbluser['nama']; ?></td>
                                </tr>
                                <tr>
                                  <td>Surel</td>
                                  <td>: <?php echo $tbluser['surel']; ?></td>
                                </tr>
                              </tbody>
                            </table>
                          <a href="javascript:;" data-toggle="modal" data-target="#ubahuser" class="btn btn-default"> Ubah </a>
                        
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

        </div>
        <!-- /#page-wrapper -->







      <div class="modal fade" id="ubahuser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
           
            <?php echo form_open('settings/ubahuser'); ?>

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">
              <span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
             
              <input name="id" type="hidden" value="1">
              <br />

              <table class="table table-striped">
                <tbody>
                  <tr>
                    <td>User</td>
                    <td>:</td>
                    <td><input name="user" type="text" class="form-control" value="<?php echo $tbluser['username']; ?>"></td>
                  </tr>
                  
                  <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td><input name="nama" type="text" class="form-control" value="<?php echo $tbluser['nama']; ?>"></td>
                  </tr>
                  <tr>
                    <td>Surel</td>
                    <td>:</td>
                    <td><input name="surel" type="text" class="form-control" value="<?php echo $tbluser['surel']; ?>"></td>
                  </tr>

                  <tr>
                    <td>Validasikan dengan Sandi lama</td>
                    <td>:</td>
                    <td><input name="pass1" type="password" class="form-control"></td>
                  </tr>

                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>

                  <tr>
                    <td>Sandi Baru</td>
                    <td>:</td>
                    <td><input name="pass2" type="password" class="form-control"></td>
                  </tr>
                  <tr>
                    <td>Ulangi Sandi Baru</td>
                    <td>:</td>
                    <td><input name="pass3" type="password" class="form-control"></td>
                  </tr>
                </tbody>
              </table>

            </div>
            <div class="modal-footer">
              *) Kosongkan Sandi Baru jika ingin login dengan sandi lama &nbsp; &nbsp; 
              <button type="submit" class="btn btn-primary">Update</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>

           <?php echo form_close(); ?>
          </div>
        </div>
      </div>



<?php $this->load->view('admin/include/foot'); ?>