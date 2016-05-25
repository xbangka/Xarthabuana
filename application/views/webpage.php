<?php $this->load->view('include/head'); ?>


<?php $this->load->view('include/nav'); ?>


<?php 

  if($banner=='tampil')
  {
    $this->load->view('include/banner'); 
  }

?>


<div class="container">

  <?php 
    
    $this->load->view( $mybody );
    
  ?>

</div>

<?php $this->load->view('include/foot'); ?>