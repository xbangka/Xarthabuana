 <div class="single">  
	 <div class="col-md-9 single_right">
	    <h3><a href="<?= $alias_post ?> "><?= $judul_post ?></a></h3>
	    <div align="justify">
	    	<p><?= $isi_post ?></p>
	    </div>
     

		  <div class="col-md-12">
			  <div class="social" align="right">	
					<a class="btn_1" href="javascript: void(0);" onClick="popUp=window.open('http://www.facebook.com/sharer/sharer.php?u=<?= base_url($categori.'/'.$alias_post) ?>', 'sharer', 'toolbar=0,status=0,width=550,height=550');popUp.focus();return false" target="_parent">
						<i class="fa fa-facebook fb"></i>
						<span class="share1 fb">Share</span>								
					</a>
					<a class="btn_1" href="javascript: void(0);" onClick="popUp=window.open('http://twitter.com/intent/tweet?source=sharethiscom&text=<?= $judul_post ?>&url=<?= base_url($categori.'/'.$alias_post) ?>&via=', 'popupwindow', 'toolbar=0,status=0,width=550,height=550');popUp.focus();return false">
						<i class="fa fa-twitter tw"></i>
						<span class="share1">Tweet</span>								
					</a>
					<a class="btn_1" href="javascript:void(0);" onclick="popUp=window.open('https://plus.google.com/share?url=<?= base_url($categori.'/'.$alias_post) ?>','popupwindow','scrollbars=yes,width=800,height=400');popUp.focus();return false">
						<i class="fa fa-google-plus google"></i>
						<span class="share1 google">Share</span>
					</a>
			   </div>
		   </div>



	 </div>


     <?php $this->load->view('sidebarpost'); ?>

 
     <div class="clearfix"> </div>
 </div>