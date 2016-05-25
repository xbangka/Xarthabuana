    <div class="single"> 
      
        

        <div class="col-md-8 single_right" align="justify">
          <h3><?= $judul_laman ?></h3>
          <p><?= $isi_laman ?></p>
        </div>


        <?php 

        if($sidebar=='tampil')
        {
          $this->load->view('include/sidebar'); 
        }

        ?>

      <div class="clearfix"> </div>
    </div> &nbsp;