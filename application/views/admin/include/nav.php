        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url('dasbon') ;?>">Administrator - AMF</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <?php 
                        if($in_messages['jml']!=0) { 
                        ?>
                        <button type="button" class="btn btn-danger btn-xs">
                        <?php echo $in_messages['jml']; ?>
                        <i class="fa fa-envelope-o fa-fw"></i> <i class="fa fa-caret-down"></i>
                        </button>
                        <?php 
                        }else{
                        ?>

                        <i class="fa fa-envelope-o fa-fw"></i> <i class="fa fa-caret-down"></i>

                        <?php 
                        }
                        ?>
                    </a>

                    
                    <ul class="dropdown-menu dropdown-messages">
                        <?php 
                        if($in_messages['jml']!=0) { 

                            foreach ($in_messages['sql']->result_array() as $rows)
                            { 
                                
                        ?>
                        <li>
                            <a href="<?= base_url('inbox/detail/'.$rows['n']) ?>">
                                <div>
                                    <strong><?= $rows['nama'] ?></strong>
                                    <span class="pull-right text-muted">
                                        <em><?= waktu_lalu($rows['tgl']) ?></em>
                                    </span>
                                </div>
                                <div><?= $rows['isi'] ?>...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        

                        <?php }
                        }
                        ?>

                        <li>
                            <a class="text-center" href="<?= base_url('inbox') ?>">
                                <strong>Read All Messages</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    
                    <!-- /.dropdown-messages -->
                </li>


                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?php echo base_url('settings') ?>"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url('lojin/logout') ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->




            <?php 

            $menu_class = $this->session->flashdata('menu_class');
            $aktif = 'class="active"';

            ?>




            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a <?php if($menu_class=='dasbon'){echo $aktif;} ?> href="<?php echo base_url('dasbon');?>"><i class="fa fa-home fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a <?php if($menu_class=='tabelpost'){echo $aktif;} ?> href="#"><i class="fa fa-pencil-square-o fa-fw"></i> Posts<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url('tabelpost/newpost');?>">New Post</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('tabelpost');?>">Post Manager</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('tabelpost/sidebar/1');?>">Sidebar 1</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('tabelpost/sidebar/2');?>">Sidebar 2</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('tabelpost/sidebar/onhome');?>">Sidebar 3</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a <?php if($menu_class=='pages'){echo $aktif;} ?> href="<?php echo base_url('pages');?>"><i class="fa fa-bookmark fa-fw"></i> Pages</a>
                        </li>
                        <li>
                            <a <?php if($menu_class=='images'){echo $aktif;} ?> href="javascript:;"><i class="fa fa-photo fa-fw"></i> Images<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url('images');?>">Upload Images</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('images/gallery');?>">Gallery Photos</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        
                        <li>
                            <a <?php if($menu_class=='mainmenu'){echo $aktif;} ?> href="<?php echo base_url('mainmenu');?>"><i class="fa fa-navicon fa-fw"></i> Menu</a>
                        </li>

                        <li>
                            <a <?php if($menu_class=='inbox'){echo $aktif;} ?> href="<?php echo base_url('inbox');?>">
                                <i class="fa fa-envelope-o fa-fw"></i> Inbox 
                                <?php 
                                if($in_messages['jml']!=0) { 
                                echo '<div style="float:right"> <button type="button" class="btn btn-danger btn-xs">'.$in_messages['jml'].'</button></div>';
                                }
                                ?>
                            </a>
                        </li>

                        <li>
                            <a <?php if($menu_class=='branchs'){echo $aktif;} ?> href="<?php echo base_url('branchs');?>"><i class="fa fa-flag fa-fw"></i> Branchs</a>
                        </li>

                        <li>
                            <a <?php if($menu_class=='settings'){echo $aktif;} ?> href="<?php echo base_url('settings');?>"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>

                        <li>
                            <a href="<?php echo base_url('lojin/logout'); ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>