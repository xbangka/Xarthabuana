<?php 

#$mapx = '-6.2102607';
#$mapy = '106.83551';

?>

<script>
var myCenter=new google.maps.LatLng(<?= $mapx.",".$mapy ?>);
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


</script>

<div id="googleMap" style="width:568px;height:380px;"></div>