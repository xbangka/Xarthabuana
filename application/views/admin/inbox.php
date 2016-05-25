<?php $this->load->view('admin/include/head'); ?>



<script type="text/javascript">
function modaldelete(nilai,nilai2,nilai3){
  document.deletefile.id.value = nilai;
  document.deletefile.nama.value = nilai2+" pada tanggal "+nilai3;
}
</script>



    <div id="wrapper">

        <?php $this->load->view('admin/include/nav'); ?>


        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
            <!-- /.row --><br/>
                <ol class="breadcrumb">
                    <li>Pesan Masuk</li>
                </ol>
                <div class="row">
                    <div class="col-lg-12">


                        <?php 

                        foreach ($sql->result_array() as $row)
                        { $tgl = substr($row['tgl'],0,10);
                            $jam = substr($row['tgl'],11,5);
                            $k = explode('-',$tgl);
                            $tgl = $k[2].' '.nama_bulan($k[1]).' '.$k[0].' '.$jam;
                            
                                
                            if($row['dibaca']=='1'){
                                $bg=''; 
                            }else{
                                $bg='style="background-color:#E4FFE8"'; 
                            }
                            
                            if(strlen(strip_tags($row['isi']))<=100){
                                $komen = strip_tags($row['isi']);
                            }else{
                                $komen = substr(strip_tags($row['isi']),0,100).'...';
                            }

                        ?>
                        <div class="panel-group" id="accordion">
                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <h4 class="panel-title">
                                <a data-parent="#accordion" href="<?php echo base_url('inbox/detail/' . $row['n']) ; ?>">
                                  <?php echo '<b>'.strip_tags($row['nama']).'</b> &nbsp; <i>'.strip_tags($row['surel']).'</i>'; ?>
                                </a>
                                <span style="float:right">
                                      <a href="javascript:;" name="<?php echo strip_tags($row['nama']); ?>" id="<?php echo $row['n']; ?>" 
                                    lang="<?php echo $tgl; ?>" 
                                    onclick="modaldelete(this.id,this.name,this.lang);" data-toggle="modal" data-target="#delete">
                                        <i class="fa fa-trash-o"></i> Delete
                                    </a>
                                </span>
                              </h4>
                            </div>
                            
                            <div id="collapseOne" class="panel-collapse collapse in">
                              <a href="<?php echo base_url('inbox/detail/' . $row['n']) ; ?>" style="display:block;text-decoration:none">
                              <div class="panel-body" <?php echo $bg; ?>>
                                <?php echo $tgl; ?><br />
                                <b><?php echo $komen; ?></b><br />
                              </div>
                              </a>
                            </div>
                            
                          </div>
                        </div>
                        <?php } ?>
                      </div> 
                    <ul class="pagination pull-right">
                        <?php
                            echo $linkHalaman;
                        ?>
                    </ul> 


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