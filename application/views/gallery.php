 <div class="single">  

        <div class="col-sm-9 follow_left">
			<h3>Gallery Foto</h3>
            
			<?php 
            foreach ($sql->result_array() as $row)
            { $k = explode('-',$row['tgl']);
            ?>
            <div class="jobs_follow jobs-single-item">
				<div class="thumb"><img src="<?= base_url('_images/gallery/300x169/' . $row['cover'] . '.jpg' ) ?>" class="img-responsive" alt="<?= $row['folder'] ?>"/></div>
				<div class="thumb_right">
				<div class="date"><?= floattostr($k[2]) ?><span><?= substr(nama_bulan($k[1]),0,3) ?></span></div>
				<h6 class="title"><a href="<?= base_url('gallery/' . $row['alias']) ?>"><?= $row['folder'] ?></a></h6>
				<span class="meta"><?= base_url('gallery/' . $row['alias']) ?></span>
                <hr>
                <a href="<?= base_url('gallery/' . $row['alias']) ?>" class="btn btn-default pull-left">More Detail >></a>

	            <ul class="social-icons pull-right">
					<li><span>Share : </span></li>
					<li><a href="javascript: void(0);" onClick="popUp=window.open('http://www.facebook.com/sharer/sharer.php?u=<?= base_url('gallery/' . $row['alias']) ?>', 'sharer', 'toolbar=0,status=0,width=550,height=550');popUp.focus();return false" target="_parent" class="fa fa-facebook"></a></li>
					<li><a href="javascript: void(0);" onClick="popUp=window.open('http://twitter.com/intent/tweet?source=sharethiscom&text=<?= $row['folder'] ?>&url=<?= base_url('gallery/' . $row['alias']) ?>&via=', 'popupwindow', 'toolbar=0,status=0,width=550,height=550');popUp.focus();return false" class="fa fa-twitter"></a></li>
					<li><a href="javascript:void(0);" onclick="popUp=window.open('https://plus.google.com/share?url=<?= base_url('gallery/' . $row['alias']) ?>','popupwindow','scrollbars=yes,width=800,height=400');popUp.focus();return false" class="fa fa-google-plus"></a></li>
				</ul>
				<div class="clearfix"> </div>
		    </div>
		    <div class="clearfix"> </div>
		   </div>

		   <?php 
            }
           ?>

		   <ul class="pagination">
            <?php
                echo $linkHalaman;
            ?>
           </ul>

	    </div>


	    <?php $this->load->view('sidebarpost'); ?>
 
     <div class="clearfix"> </div>
 </div>