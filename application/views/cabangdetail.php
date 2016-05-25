<script src="http://maps.googleapis.com/maps/api/js"></script>
<script>
var myCenter=new google.maps.LatLng('<?= $mapx."','".$mapy ?>');
var marker;

function initialize()
{
	var mapProp = {
	  center:myCenter,
	  zoom:16,
	  mapTypeId:google.maps.MapTypeId.ROADMAP
	  };

	var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

	var marker=new google.maps.Marker({
	  position:myCenter,
	  animation:google.maps.Animation.BOUNCE
	  });

	marker.setMap(map);

	
}

google.maps.event.addDomListener(window, 'load', initialize);

</script>


 <div class="single">  
	    
	    <div class="col-md-5">
        	<img src="<?= base_url('_images/cabang/' . $gambar . '.jpg') ?>" class="img-responsive" alt=""/>
        </div>

        <div class="col-md-7 service_box1">
        	
        	<h3>Cabang <?= $namacabang ?></h3>
        	<p>
        		<?= $alamat ?> <br />
        		<?php 

	            echo '<i class="fa fa-phone"></i> '.$notlp1;
	            if($notlp2!='')
	            {
	                echo '<br/><i class="fa fa-phone"></i> '.$notlp2;
	            }
	            echo '<br/><i class="fa fa-print"></i> '.$fax1;
	            if($fax2!='')
	            {
	                echo '<br/><i class="fa fa-print"></i> '.$fax2;
	            }

	            ?>
        	</p>
        	<div id="googleMap" style="width:568px;height:380px;" class="img-responsive"></div>
        </div>

     <div class="clearfix"> </div>
 </div>