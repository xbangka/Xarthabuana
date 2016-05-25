<?php $this->load->view('admin/include/head'); ?>
<script type="text/javascript">
function modaledit(nilai,nilai2,nilai3){
  document.nmform.nm.value = nilai;
  document.nmform.menu.value = nilai2;
  document.nmform.url.value = nilai3;
}
function modalshowhide(nilai){
  document.showhide.nm.value = nilai;
}
</script>
    <div id="wrapper">

        <?php $this->load->view('admin/include/nav'); ?>


        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
            <!-- /.row --><br/>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Menu Utama
                            </div>
                            <div class="panel-body">
                                












                                <div style="float:right;">
                                    <a style="float:right;" href="javascript:;" data-toggle="modal" data-target="#new" type="button" class="btn btn-default">+ New Menu</a>
                                </div>
                              <div style="height:50px">&nbsp;</div>
                                <?php 
                                $n=0;
                                foreach ($sql->result_array() as $row)
                                {   $n+=1;
                                    $x = floattostr($row['n']); 
                                    if($n%2==0){
                                        $color='alert-danger';
                                    }else{
                                        $color='alert-info';
                                    } 
                                    if($row['tampil']=='Y'){
                                        $eye='-slash';
                                        $hide='Hide';
                                        $coret1 = '';
                                        $coret2 = '';
                                    }else{
                                        $eye='';
                                        $hide='Show';
                                        $coret1 = '<s>';
                                        $coret2 = '</s>';
                                    } ?>
                            
                            <div class="alert <?php echo $color; ?>" style="height:30px;padding:2px 0 2px 10px;margin:5px 0 5px 0;">
                                <a title="<?php echo $row['url']; ?>"><?php echo $coret1.$row['title'].$coret2; ?></a> - - - - - - - - - - <?php echo base_url($row['url']); ?>
                                 <span style="float:right;margin-right:5px;">
                                    
                                    <a href="javascript:;" name="<?php echo $row['title']; ?>" id="<?php echo $row['n']; ?>" lang="<?php echo $row['url']; ?>"
                                     onclick="modaledit(this.id,this.name,this.lang);"
                                     data-toggle="modal" data-target="#edit"><i class="fa fa-edit"></i> Edit </a> &nbsp; | &nbsp; 
                                     
                                    <a href="javascript:;" name="<?php echo $row['n']; ?>" onclick="modalshowhide(this.name);"
                                     data-toggle="modal" data-target="#showhide"><i class="fa fa-eye<?php echo $eye; ?>"></i> <?php echo $hide; ?></a>
                                    
                                 </span>
                            </div>
                            <?php   
                                $sql2 = $this->mmainmenu->tabel_menu_anakan($x);
                                    foreach ($sql2->result_array() as $row2)
                                    { $n+=1;
                                        if($n%2==0){
                                            $color='alert-danger';
                                        }else{
                                            $color='alert-info';
                                        } 
                                        if($row2['tampil']=='Y'){
                                            $eye='-slash';
                                            $hide='Hide';
                                            $coret1 = '';
                                            $coret2 = '';
                                        }else{
                                            $eye='';
                                            $hide='Show';
                                            $coret1 = '<s>';
                                            $coret2 = '</s>';
                                        }?>
                                        <div class="alert <?php echo $color; ?>" 
                                        style="height:30px;padding:2px 0 2px 10px;margin:5px 0 5px 0;margin-left:50px">
                                            
                                            <a title="<?php echo $row2['url']; ?>"><?php echo $coret1.$row2['title'].$coret2; ?></a> - - - - - - - - - - <?php echo base_url($row2['url']); ?>
                                            <span style="float:right;margin-right:5px;">
                                            <a href="javascript:;" name="<?php echo $row2['title']; ?>" id="<?php echo $row2['n']; ?>"
                                            lang="<?php echo $row2['url']; ?>" onclick="modaledit(this.id,this.name,this.lang);"
                                            data-toggle="modal" data-target="#edit"><i class="fa fa-edit"></i> Edit </a>
                                             &nbsp; | &nbsp; 
                                            <a href="javascript:;" name="<?php echo $row2['n']; ?>"onclick="modalshowhide(this.name);"
                                            data-toggle="modal" data-target="#showhide">
                                            <i class="fa fa-eye<?php echo $eye; ?>"></i> <?php echo $hide; ?>
                                            </a>
                                            
                                             </span>
                                        </div>
                                <?php }
                                } ?>
                          <!---->









                                
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
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




      <!-- Modal -->
      <div class="modal fade" id="new" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
           
           <?php echo form_open('mainmenu/newmenu'); ?>

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">
              <span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title" id="myModalLabel">Menu Baru !</h4>
              <h4>Parent </h4>
              <select class="form-control margin-bottom-15" name="parent">
                <option value="0">[TOP MENU]</option>
                <?php
                foreach ($sql3->result_array() as $ro)
                { ?>
                    <option value="<?php echo $ro['n']; ?>"><?php echo $ro['title']; ?></option>
                <?php } ?>
              </select>
              <h4>Nama Menu </h4>
              <input name="nama" type="text" class="form-control">
              <h4>URL </h4>
              <input name="url" type="text" class="form-control">
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Create</button>
            </div>
           <?php echo form_close(); ?>
          </div>
        </div>
      </div>
      
      <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
           
           <?php echo form_open('mainmenu/editmenu', 'name="nmform"'); ?>

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">
              <span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title" id="myModalLabel">Edit menu terpilih !</h4>
              <input name="nm" type="hidden" value="">
              <input name="menu" type="text" class="form-control" value=""><h4>URL</h4>
              <input name="url" type="text" class="form-control" value="" width="200px">
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Edit</button>
            </div>
           <?php echo form_close(); ?>
          </div>
        </div>
      </div>
      
      <div class="modal fade" id="showhide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width:300px;top:130px">
          <div class="modal-content">
           
           <?php echo form_open('mainmenu/showhide', 'name="showhide"'); ?>

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">
              <span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title" id="myModalLabel">
              Yakin ?</h4>
              <input name="nm" type="hidden" value="">
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-default">Yes</button>
              <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
            </div>
           <?php echo form_close(); ?>
          </div>
        </div>
      </div>




      <div class="modal fade" id="showhide2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width:350px">
            
                <div class="col-lg-12" align="left">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Primary Panel
                        </div>
                        <div class="panel-body">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>
                        </div>
                        <div class="panel-footer">
                            Panel Footer
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-4 -->
            


        </div>
      </div>
<?php $this->load->view('admin/include/foot'); ?>