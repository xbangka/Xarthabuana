    <div class="single">  
        <div class="col-md-9">
			<h3>KANTOR CABANG</h3> 
            <div class="follow_jobs">
			    
 
                <?php 
                foreach ($sql->result_array() as $row)
                { 

                ?>
				<a href="javascript:;">
					<img src="<?= base_url('_images/home-icon.png') ?>" alt="" class="img-circle" onClick="tampil_peta('<?= $row['namacabang'] . '\',\'' . $row['mapx'].'\',\''.$row['mapy'] ?>');" data-toggle="modal" data-target="#linkid" id="idx<?= $row['n'] ?>">
					
                    <div class="data">
                        <span class="sallary" onclick="click_cabang('<?= base_url($row['url']) ?>');">
                            <?php 

                            echo '<i class="fa fa-phone"></i>'.$row['notlp1'];
                            if($row['notlp2']!='')
                            {
                                echo '<br/><i class="fa fa-phone"></i>'.$row['notlp2'];
                            }
                            echo '<br/><i class="fa fa-print"></i>'.$row['fax1'];
                            if($row['fax2']!='')
                            {
                                echo '<br/><i class="fa fa-print"></i>'.$row['fax2'];
                            }

                            ?>
                        </span>                 
                    </div>

                    <div class="title">
                        <h5 onclick="click_cabang('<?= base_url($row['url']) ?>');"><?= $row['namacabang'] ?></h5>
						<p onClick="tampil_peta('<?= $row['namacabang'] . '\',\'' . $row['mapx'].'\',\''.$row['mapy'] ?>');" class="hidden-job" data-toggle="modal" data-target="#linkid" id="idx<?= $row['n'] ?>">
                            <i class="fa fa-map-marker" style="color:#E52A00"></i><?= $row['alamat'] ?>
                        </p>
					</div>

				</a>

                <?php 
                }
                ?>
			 
                <ul class="pagination">
                    <?php
                        echo $linkHalaman;
                    ?>
                </ul> 
            </div>
		</div>

	    <?php $this->load->view('sidebarpost'); ?>

		<div class="clearfix"> </div>
	</div>





      <div class="modal fade" id="linkid" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">
              <span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 id="header_peta"></h4>
              <div id="muntah_disini"></div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
            </div>
          </div>
        </div>
      </div>


<script type="text/javascript">

    function tampil_peta(nama,ko_x,ko_y) {
        
        $.ajax({
            type: "POST",
            url: "<?= base_url('cabang/peta') ?>",
            data: 'ko_x=' + ko_x + '&ko_y=' + ko_y,
            cache: false,
            beforeSend: function()
            {
                $("#muntah_disini").html('<br/>load...');
            },
            success: function(response)
            {
                $("#muntah_disini").html(response);
                var mapDiv = document.getElementById('header_peta');
                google.maps.event.addDomListener(mapDiv, 'click', initialize);
                $("#header_peta").html("Cabang " + nama);

                $('#linkid').on('shown.bs.modal', function () {
                    $("#header_peta").click();
                });
            }
        });
    };

    

    function click_cabang(inurl) {
        window.location.href = inurl;
    };

</script>
<script src="http://maps.googleapis.com/maps/api/js"></script>