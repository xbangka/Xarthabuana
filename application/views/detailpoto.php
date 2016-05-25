<link type="text/css" rel="stylesheet" href="<?php echo base_url('_css/featherlight.css'); ?>" title="Featherlight Styles" />
<link type="text/css" rel="stylesheet" href="<?php echo base_url('_css/featherlight.gallery.css'); ?>" title="Featherlight Styles" />


 <div class="single">  

		<h2><?= $judul ?></h2>
		<div class="recruit_box">
		
		<?php 
        foreach ($sql->result_array() as $row)
        { 
        ?>
		
		<div class="col-md-3 recruit"><a class="thumbnail gallery" href="<?= base_url('_images/gallery/760x486/' . $row['nmfile'] . '.jpg') ?>">
			  <img src="<?= base_url('_images/gallery/300x169/' . $row['nmfile'] . '.jpg') ?>" class="img-responsive" alt="<?= $row['judul'] ?>"/>
			  <h4><?= $row['ket'] ?></h4>
		</a></div>

		<?php } ?>

     <div class="clearfix"> </div>
 </div>

<script src="<?php echo base_url('_js/featherlight.js'); ?>" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url('_js/featherlight.gallery.js'); ?>" type="text/javascript" charset="utf-8"></script>

<script>
	$(document).ready(function(){
		$('.gallery').featherlightGallery({
			gallery: {
				fadeIn: 300,
				fadeOut: 300
			},
			openSpeed:    300,
			closeSpeed:   300
		});
		$('.gallery2').featherlightGallery({
			gallery: {
				next: 'next »',
				previous: '« previous'
			},
			variant: 'featherlight-gallery2'
		});
	});

	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//stats.g.doubleclick.net/dc.js','ga');

	ga('create', 'UA-5342062-6', 'noelboss.github.io');
	ga('send', 'pageview');
</script>