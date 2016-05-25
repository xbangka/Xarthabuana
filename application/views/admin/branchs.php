<?php $this->load->view('admin/include/head'); ?>



<script type="text/javascript">
  function modaldelete(nilai,nilai2){
    document.deletefile.id.value = nilai;
    $("#idcab").html('<b><i>' + nilai2 + '</i></b>');
  } ;

  function isNumber(evt) {
      evt = (evt) ? evt : window.event;
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      if (charCode > 31 && (charCode < 48 || charCode > 57)) {
          return false;
      }
      return true;
  }

  function ajaxedit(idx) {
    $.ajax({
      type: "POST",
      url: "<?= base_url('branchs/load_data_cabang') ?>",
      data: 'idx=' + idx,
      cache: false,
      beforeSend: function()
      {
        $("#loaded_contents").html('<br/><div style="text-align:center">Mengambil data...<div><br/>');
        $("#btn_update").attr('class', 'btn btn-primary disabled');
      },
      success: function(response)
      {
        $("#loaded_contents").html(response);
        $("#btn_update").attr('class', 'btn btn-primary');
      }
    });
  };

</script>



    <div id="wrapper">

        <?php $this->load->view('admin/include/nav'); ?>


        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
            <!-- /.row --><br/>
                <div class="row">
                    <div class="col-lg-12">


                        <h3>Cabang
                          <div style="float:right;">
                              <a href="javascript:;" data-toggle="modal" data-target="#adddata" type="button" class="btn btn-default">+ Add </a>
                          </div>
                        </h3>
                        <br />


                        <?php 

                        foreach ($sql->result_array() as $row)
                        { 
                          if($row['notlp1']==''){ $row['notlp1']='<i class="fa fa-question"></i>'; }
                          if($row['notlp2']==''){ $row['notlp2']='<i class="fa fa-question"></i>'; }
                          if($row['fax1']==''){ $row['fax1']='<i class="fa fa-question"></i>'; }
                          if($row['fax2']==''){ $row['fax2']='<i class="fa fa-question"></i>'; }
                        ?>
                        <div class="well well-sm">
                            <h4>
                              <div class="col-lg-9">
                              <?= $row['kode'] . ' ' . $row['namacabang'] ?>
                              </div>
                              <div class="col-lg-3">
                                <div style="float:right;">
                                  <button type="button" class="btn btn-outline btn-primary" data-toggle="modal" data-target="#editcab" onclick="ajaxedit('<?= $row['n']?>');"><i class="fa fa-edit"></i> Edit</button>
                                  <button type="button" class="btn btn-outline btn-danger" onclick="modaldelete('<?= $row['n'].'\',\''.$row['kode'] . ' ' . $row['namacabang'] ?>');" data-toggle="modal" data-target="#delete"><i class="fa fa-trash-o"></i> Delete</button>
                                </div>
                              </div>
                            </h4>
                            <p>
                              <div class="col-lg-12">
                                <?= $row['alamat'] ?>
                              </div><br/>
                              <div class="col-lg-3">
                                <i class="fa fa-phone-square"></i> <?= $row['notlp1'] ?>
                              </div>
                              <div class="col-lg-9">
                                <i class="fa fa-print"></i> <?= $row['fax1'] ?>
                              </div>
                              <br/>
                              <div class="col-lg-3">
                                <i class="fa fa-phone-square"></i> <?= $row['notlp2'] ?>
                              </div>
                              <div class="col-lg-9">
                                <i class="fa fa-print"></i> <?= $row['fax2'] ?>
                              </div>
                              <br/>
                              <div class="col-lg-12">
                                <i class="fa fa-map-marker"></i> Koordinat pada Google maps: latitude <b><?= $row['mapx'] ?></b> N & longitude <b><?= $row['mapy'] ?></b> W
                              </div><br/><br/>
                            </p>
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
           
            <?php echo form_open('branchs/deletecabang', 'name="deletefile"'); ?>

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">
              <span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title" id="myModalLabel">
              Yakin ingin hapus Cabang <span id="idcab"></span></h4>
              <input name="id" type="hidden" value="">
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Yes</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            </div>

           <?php echo form_close(); ?>
          </div>
        </div>
      </div>

      <div class="modal fade" id="editcab" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
           
            <?php echo form_open('branchs/editcabang', 'name="editfile"'); ?>

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">
              <span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              
              <h4 class="modal-title" id="myModalLabel">
                Edit Data
              </h4>
              <br/>
              <div id="loaded_contents"></div>

            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary disabled" id="btn_update">Update</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>

           <?php echo form_close(); ?>
          </div>
        </div>
      </div>



      <div class="modal fade" id="adddata" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
           
            <?php echo form_open('branchs/addcabang'); ?>

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">
              <span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              
              <h4 class="modal-title" id="myModalLabel">
                Add Data
              </h4>
              <br/>

              <table class="table table-striped">
                <tbody>
                  
                  <tr>
                    <td width="110px">Kode Cabang</td>
                    <td>
                      <div style="width:70px">
                        <input name="kodecab" type="text" class="form-control" onKeypress="return isNumber(event)">
                      </div>
                    </td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>

                  <tr>
                    <td>Nama Cabang</td>
                    <td colspan="3">
                      <input name="namacab" type="text" class="form-control">
                    </td>
                  </tr>

                  <tr>
                    <td>Alamat</td>
                    <td colspan="3"><input name="alamat" type="text" class="form-control"></td>
                  </tr>

                  <tr>
                    <td>Tlp1</td>
                    <td><input name="tlp1" type="text" class="form-control"></td>
                    <td>Fax1</td>
                    <td><input name="fax1" type="text" class="form-control"></td>
                  </tr>

                  <tr>
                    <td>Tlp2</td>
                    <td><input name="tlp2" type="text" class="form-control"></td>
                    <td>Fax2</td>
                    <td><input name="fax2" type="text" class="form-control"></td>
                  </tr>

                  <tr>
                    <td>URL</td>
                    <td colspan="3"><input name="urlcab" type="text" class="form-control"></td>
                  </tr>

                  <tr>
                    <td>Latitude</td>
                    <td><input name="mapx" type="text" class="form-control"></td>
                    <td>Longitude</td>
                    <td><input name="mapy" type="text" class="form-control"></td>
                  </tr>

                </tbody>
              </table>

            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" id="btn_Add">Save</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>

           <?php echo form_close(); ?>
          </div>
        </div>
      </div>
<?php $this->load->view('admin/include/foot'); ?>