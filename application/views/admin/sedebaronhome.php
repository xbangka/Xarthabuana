<?php $this->load->view('admin/include/head'); ?>


<script type="text/javascript">

  function ajaxedit(idx) {
    $("#idx").val(idx);
    $.ajax({
      type: "POST",
      url: "<?= base_url('tabelpost/loadsidebaronhome') ?>",
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
            	<!-- /.row -->
            	<br/>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <h3>Sidebar</h3>
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Deskripsi</th>
                                            <th>icon</th>
                                        </tr>
                                    </thead>
                                  <tbody>
                                  <?php
                                    $n=0;
                                    foreach ($sql->result_array() as $row)
                                    { $n+=1;
                                  ?>
                                    <tr>
                                      <td><a href="javascript:;" data-toggle="modal" data-target="#ubahdata" onclick="ajaxedit('<?php echo $row['n']; ?>')">
                                        <?php echo $n; ?></a>
                                      </td>
                                      <td><a href="javascript:;" data-toggle="modal" data-target="#ubahdata" onclick="ajaxedit('<?php echo $row['n']; ?>')">
                                        <?php echo $row['judul']; ?></a>
                                      </td>
                                      <td><a href="javascript:;" data-toggle="modal" data-target="#ubahdata" onclick="ajaxedit('<?php echo $row['n']; ?>')">
                                        <?php echo $row['deskripsi'] ?></a>
                                      </td>
                                      <td><a href="javascript:;" data-toggle="modal" data-target="#ubahdata" onclick="ajaxedit('<?php echo $row['n']; ?>')">
                                        <?php echo $row['icon'] ?></a>
                                      </td>
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
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->


      <div class="modal fade" id="ubahdata" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
           
            <?php echo form_open('tabelpost/savesidebaronhome'); ?>

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">
              <span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <input name="id" id="idx" type="hidden">
              <br />

              <div id="loaded_contents"></div>

            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" id="btn_update">Update</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>

           <?php echo form_close(); ?>
          </div>
        </div>
      </div>


<?php $this->load->view('admin/include/foot'); ?>