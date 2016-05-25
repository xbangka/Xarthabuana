<?php $this->load->view('admin/include/head'); ?>

    <div id="wrapper">

        <?php 

        $this->load->view('admin/include/nav');

        foreach ($sql->result_array() as $row_post)
        {
            $tgl = substr($row_post['tgl'],0,10);
            $jam = substr($row_post['tgl'],11,5);
            $k = explode('-',$tgl);
            $tgl = $k[2].' '.nama_bulan($k[1]).' '.$k[0].' '.$jam;
            $nama = strip_tags($row_post['nama']) ;
            $surel = strip_tags($row_post['surel']) ;
            $isi = strip_tags($row_post['isi']);
            $ipadd = $row_post['ip'] ;
            $browser = $row_post['browser'] ;
        }

        ?>


        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
            <!-- /.row --><br/>
                <ol class="breadcrumb">
                    <li>Pesan Masuk</li>
                </ol>
                <a href="<?php echo $kembali; ?>">&lt;&lt; Kembali</a>
                <p>&nbsp;</p>
                <div class="row">
                    <div class="col-lg-12">




                        <div class="panel-group" id="accordion">
                                  <div class="panel panel-default">
                                    <div class="panel-heading">
                                      <h4 class="panel-title">
                                        <?php echo '<b>'.$nama.'</b> &nbsp; <i>'.$surel.'</i>'; ?>
                                      </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse in">
                                      <div class="panel-body">
                                        <i class="fa fa-clock-o "></i> <?php echo $tgl; ?><br />

                                        <blockquote>
                                            <p><b><?php echo $isi; ?></b></p>
                                        </blockquote>
                                        <i>
                                          IP Addres: <?php echo $ipadd; ?><br />
                                          Browser: <?php echo $browser; ?>
                                        </i>

                                        </div>
                                    </div>
                                  </div>
                                </div>




                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->




      <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
           
            <?php echo form_open('inbox/deleteinbox', 'name="deletefile"'); ?>

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">
              <span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title" id="myModalLabel">
              Yakin ingin dihapus pesan </h4>
              <input name="id" type="hidden" value="">
              <input name="nama" type="text" class="form-control" value="" disabled>
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