<?php $this->load->view('admin/include/head'); ?>

    <div id="wrapper">

        <?php $this->load->view('admin/include/nav'); ?>



        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Log Administrator</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            
                            <table class="table table-striped">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>Tanggal</th>
                                  <th>IP</th>
                                  <th>Nama_Komputer</th>
                                  <th>Browser<span style="float:right;"><a href="javascript:;" data-toggle="modal" data-target="#cleardata">Clear</a></span></th>
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




      <div class="modal fade" id="cleardata" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
           
            <?php echo form_open('settings/cleardatalogadmin'); ?>

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">
              <span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title">
              	Yakin hapus semua log masuk ?
              </h4>
              <h4>Masukan kata sandi </h4>
              <input name="pass" type="password" class="form-control">
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