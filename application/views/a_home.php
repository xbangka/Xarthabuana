<div class="container">



  <br />
  <div class="box_2">

    <?php 
    foreach ($sqlsidebar->result_array() as $row)
    {
    ?>
      <div class="col-md-4 icon-service">
        <div class="icon">
          <i class="fa fa-<?= $row['icon'] ?>"></i>
        </div>
        <div class="icon-box-body">
          <h4><?= $row['judul'] ?></h4>
          <p><?= $row['deskripsi'] ?></p>
        </div>
      </div>
    <?php } ?>

  </div>
  </div>







  <div class="grid_1">
   <h3>Mitra Asuransi</h3>
      <ul id="flexiselDemo3">
        <li><img src="<?php echo base_url('_images/c1.gif'); ?>" class="img-responsive" /></li>
        <li><img src="<?php echo base_url('_images/c2.gif'); ?>" class="img-responsive" /></li>
        <li><img src="<?php echo base_url('_images/c3.gif'); ?>" class="img-responsive" /></li>
        <li><img src="<?php echo base_url('_images/c4.gif'); ?>" class="img-responsive" /></li>
        <li><img src="<?php echo base_url('_images/c5.gif'); ?>" class="img-responsive" /></li>
      </ul>
      <script type="text/javascript">
      $(window).load(function() {
        $("#flexiselDemo3").flexisel({
          visibleItems: 6,
          animationSpeed: 1000,
          autoPlay:true,
          autoPlaySpeed: 3000,        
          pauseOnHover: true,
          enableResponsiveBreakpoints: true,
            responsiveBreakpoints: { 
              portrait: { 
                changePoint:480,
                visibleItems: 1
              }, 
              landscape: { 
                changePoint:640,
                visibleItems: 2
              },
              tablet: { 
                changePoint:768,
                visibleItems: 3
              }
            }
          });
      });
      </script>
      <script type="text/javascript" src="<?php echo base_url('_js/jquery.flexisel.js'); ?>"></script>
  </div>
</div>