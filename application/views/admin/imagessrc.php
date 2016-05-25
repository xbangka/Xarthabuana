<?php $this->load->view('admin/include/head'); ?>

    <div id="wrapper">

        <?php $this->load->view('admin/include/nav'); ?>


<script type="text/javascript">
function modalre(nilai,nilai2){
  document.renameform.nmfolder.value = nilai;
  document.renameform.nmfile.value = nilai2;
  document.renameform.nmold.value = nilai2;
}
function modaldelete(nilai,nilai2,nilai3){
  document.deletefile.nama.value = nilai;
  document.deletefile.dir.value = nilai2;
  document.deletefile.tipe.value = nilai3;
  document.deletefile.nama2.value = nilai;
}
function modalview(nilai,nilai2){
  document.preview.img.src = nilai + "/" + nilai2;
}
function modallink(nilai){
  document.linkk.linkkk.value = "<?php echo base_url(); ?>" + nilai ;
}
</script>




        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
            





            <!-- /.row --><br/>
                <ol class="breadcrumb">
                    <li>Image Manager</li>
                </ol>
                <div class="row">
                    <div class="col-md-12">
                        
                    <!---->
                    
        <pre>
        <?php

        function sortRows($data)
        {
            $size = count($data);

            for ($i = 0; $i < $size; ++$i) {
                $row_num = findSmallest($i, $size, $data);
                $tmp = $data[$row_num];
                $data[$row_num] = $data[$i];
                $data[$i] = $tmp;
            }

            return ( $data );
        }

        function findSmallest($i, $end, $data)
        {
            $min['pos'] = $i;
            $min['value'] = $data[$i]['data'];
            $min['dir'] = $data[$i]['dir'];
            for (; $i < $end; ++$i) {
                if ($data[$i]['dir']) {
                    if ($min['dir']) {
                        if ($data[$i]['data'] < $min['value']) {
                            $min['value'] = $data[$i]['data'];
                            $min['dir'] = $data[$i]['dir'];
                            $min['pos'] = $i;
                        }
                    } else {
                        $min['value'] = $data[$i]['data'];
                        $min['dir'] = $data[$i]['dir'];
                        $min['pos'] = $i;
                    }
                } else {
                    if (!$min['dir'] && $data[$i]['data'] < $min['value']) {
                        $min['value'] = $data[$i]['data'];
                        $min['dir'] = $data[$i]['dir'];
                        $min['pos'] = $i;
                    }
                }
            }
            return ( $min['pos'] );
        }

            $self = base_url('images');
            if (isset($_REQUEST['dir']) && $_REQUEST['dir']!='') {
                $dir = $_REQUEST['dir'];
                $size = strlen($dir);
                while ($dir[$size - 1] == '/') {
                    $dir = substr($dir, 0, $size - 1);
                    $size = strlen($dir);
                }
            } else {
                $dir = '_images/';///$_SERVER["SCRIPT_FILENAME"];
                $size = strlen($dir);
                while ($dir[$size - 1] != '/') {
                    $dir = substr($dir, 0, $size - 1);
                    $size = strlen($dir);
                }
                $dir = substr($dir, 0, $size - 1);
            }
            

            if($dir=='_images'){
                echo '<input name="nmnama" type="text" class="form-control" disable value="DIR : " disabled>', '';
            }else{
                echo '<input name="nmnama" type="text" class="form-control" value="DIR : '.substr($dir,8).'" disabled>';
            }

            
            if (is_dir($dir)) {
                if ($handle = opendir($dir)) {
                    $size_document_root = strlen($_SERVER['DOCUMENT_ROOT']);
                    $pos = strrpos($dir, "/");
                    $topdir = substr($dir, 0, $pos + 1);
                    $rows[0]['data']='';
                    $rows[0]['dir']='';
                    $i = 0;
                    while (false !== ($file = readdir($handle))) {
                        if ($file != "." && $file != "..") {
                            $rows[$i]['data'] = $file;
                            $rows[$i]['dir'] = is_dir($dir . "/" . $file);
                            $i++;
                        }
                    }
                    closedir($handle);
                }

                $size = count($rows);
                $rows = sortRows($rows);
                echo "<div class=\"table-responsive\">";
                echo "<table style=\"white-space:pre;\" class=\"table table-striped table-hover table-bordered\">";
                echo "<tr>";
                if($dir=='_images'){
                    echo "<td width=\"30px\">[M]";
                    echo "</td>";
                    echo "<td>    ";
                    echo "IMAGES\n";
                    echo "</td>";
                }else{
                    echo "<td width=\"30px\">[UP]";
                    echo "</td>";
                    echo "<td>    ";
                    echo "<span class=\"btn btn-primary\"><a href='", $self, "?l=upload&dir=", $topdir, "' style=\"color:#FFFFFF\"><i class=\"fa fa-level-up\"></i><i class=\"fa fa-level-up\"></i></a></span>\n";
                    echo "</td>";
                }
                echo "<td align=\"right\">size (bytes)";
                echo "</td>";
                echo "<td width=\"50px\">";
                echo '<span class="btn btn-primary"><a href="javascript:;" data-toggle="modal" data-target="#upload" style="color:#FFFFFF"><i class="fa fa-upload"></i> Upload</a></span>&nbsp;';
                echo '<span class="btn btn-primary"><a href="javascript:;" data-toggle="modal" data-target="#newfolder" style="color:#FFFFFF"><i class="fa fa-folder"></i> New Folder</a></span></td>';
                echo "</tr>";
                for ($i = 0; $i < $size; ++$i) {
                    $topdir = $dir . "/" . $rows[$i]['data'];
                    echo "<tr>";
                    echo "<td>";
                    if ($rows[$i]['dir']) {
                        echo "[DIR]";
                        $file_type = "dir";
                    } elseif ($rows[$i]['data']) {
                        echo "[FILE]";
                        $file_type = "file";
                    }else{
                        echo "";
                        $file_type = "Tidak Ada Type";
                    }
                    echo "</td>";
                    echo "<td>    ";
                    if($file_type=="dir"){
                        echo "<i class=\"fa fa-folder-open\" style=\"color:#FF6600\"></i>&nbsp;<a href='", $self, "?l=upload&dir=", $topdir, "'>", substr($rows[$i]['data'],0,300), "</a>\n";
                    }else{ 
                        echo '<i class="fa fa-file-photo-o" style="color:#990066"></i>&nbsp;<a href="javascript:;" name="'.base_url(''.$dir).'" id="'.$rows[$i]['data'].'" onclick="modalview(this.name,this.id);" data-toggle="modal" data-target="#preview">'.substr($rows[$i]['data'],0,50).'</a>';
                    //echo "<i class=\"fa fa-file-photo-o\" style=\"color:#990066\"></i>&nbsp;<a href='", $self, "?l=upload&dir=", $topdir, "'>", $rows[$i]['data'], "</a>\n";  
                    }
                    echo "</td>";
                    echo "<td align=\"right\">";
                    echo number_format(filesize($topdir),0,',','.');;
                    echo "</td>";
                    echo "<td>";
                    if($file_type!="Tidak Ada Type"){
                        echo '<a href="javascript:;" name="'.$topdir.'" onclick="modallink(this.name);" data-toggle="modal" data-target="#linkid"><i class="fa fa-link"></i> Link</a> | <a href="javascript:;" name="'.$dir.'" id="'.$rows[$i]['data'].'" onclick="modalre(this.name,this.id);" data-toggle="modal" data-target="#rename"><i class="fa fa-edit"></i> Rename</a> | <a href="javascript:;" name="'.$dir.'" id="'.$rows[$i]['data'].'" lang="'.$file_type.'" onclick="modaldelete(this.id,this.name,this.lang);" data-toggle="modal" data-target="#delete"><i class="fa fa-trash-o"></i> Delete</a>';
                    }else{ echo ""; }
                    echo "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else if (is_file($dir)) {
                $pos = strrpos($dir, "/");
                $topdir = substr($dir, 0, $pos);
                echo "<p>&nbsp;</p><a href='", $self, "?l=upload&dir=", $topdir, "'>", 'Kembali', "</a>\n\n";
                
                echo '<img src="'.$dir.'" />';
                
            } else {
                echo "<p>&nbsp;</p>bad file or unable to open";
            }

        ?>
        </pre>

                    
                    
                    <!---->
                        
                        
                    </div>
                </div>




            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->






      <!-- Modal -->
      <div class="modal fade" id="upload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
           
           <?php echo form_open_multipart('images/uploadfile'); ?>

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">
              <span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title" id="myModalLabel">Upload Gambar !</h4>
              <input name="dir" type="hidden" value="<?php echo $dir ?>">
              <input type="file" name="foto">
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary"><i class="fa fa-upload"></i> Upload</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
           
           <?php echo form_close(); ?>

          </div>
        </div>
      </div>
      
      <div class="modal fade" id="newfolder" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
           
           <?php echo form_open('images/newfolder'); ?>

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">
              <span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title" id="myModalLabel">Create New Folder</h4>
              <input name="dir" type="hidden" value="<?php echo $dir ?>">
              <input id="newf" name="nm" type="text" class="form-control" value="">
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary"><i class="fa fa-folder"></i> OK</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>

            <?php echo form_close(); ?>
           
          </div>
        </div>
      </div>
      
      <div class="modal fade" id="rename" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">

           <?php echo form_open('images/rename', 'name="renameform"'); ?>

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">
              <span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title" id="myModalLabel">Rename !</h4>
              <input name="nmold" type="hidden" value="">
              <input name="nmfolder" type="hidden" value="">
              <input name="nmfile" type="text" class="form-control" value="">
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">OK</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            </div>
           
            <?php echo form_close(); ?>

          </div>
        </div>
      </div>
      
      <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
           
           <?php echo form_open('images/deletefile', 'name="deletefile"'); ?>

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">
              <span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title" id="myModalLabel">
              Yakin ingin dihapus ?</h4>
              <input name="dir" type="hidden" value="">
              <input name="nama2" type="text" class="form-control" value="" disabled>
              <input name="nama" type="hidden" value="">
              <input name="tipe" type="hidden" value="">
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Yes</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            </div>
           

           <?php echo form_close(); ?>


          </div>
        </div>
      </div>
      




      <div class="modal fade" id="preview" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width:950px" align="center">
          <form name="preview">
            <div align="center">
                <img name="img" src="" />
            </div>
          </form>
        </div>
      </div>




      
      <div class="modal fade" id="linkid" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">
              <span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4>Link</h4>
              <form name="linkk">
              <input name="linkkk" type="text" class="form-control" value="" onClick="this.select();">
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
            </div>
           </form>
          </div>
        </div>
      </div> 






<?php $this->load->view('admin/include/foot'); ?>