	<div class="single">  
	   <div class="col-md-9 single_right">
	      <div class="but_list">
	       <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
			<ul id="myTab" class="nav nav-tabs" role="tablist"></ul>

 
			<?php 
			foreach ($sql2->result_array() as $row)
			{ 
				if($row['cover']!=''){
					if(substr($row['cover'],0,4)=='http'){
						$imgpost = ''.$row['cover'];
					}else{
						$imgpost = base_url('_images/gallery/627x352/'.$row['cover'].'.jpg');
					}
					
					if (!file_exists($imgpost)) {
						# $imgpost = base_url('_images/default-post.jpg');
					}
					
				}else{
					
					$isi = $row['isi'];
					if(strpos($isi, '<img ')!==false){
						$awal = strpos($isi, '<img ');
						$awal = strpos($isi, 'src="', $awal) + 5;
						$akhir = strpos($isi, '"', $awal);
						$akhir = substr_replace($isi, '',$akhir);
						$imgpost = substr_replace($akhir, '',0 ,$awal);
					}else{
						$imgpost = base_url('_images/default-post.jpg');
					}
					
				}

			?>
			<div class="tab_grid">
			    <div class="jobs-item with-thumb">
				    <div class="thumb">
					    <a href="<?= base_url($alias_post.'/'.$row['alias']) ?>">
					    	<img src="<?= $imgpost ?>" class="img-responsive" alt="<?= $row['judul'] ?>"/>
					    </a>
				    </div>
				    <div class="jobs_right">
						<?php 
						$tgl = substr($row['tgl'],0,10);
						$jam = substr($row['tgl'],11,5);
						$k = explode('-',$tgl);
						$tgl = floattostr($k[2]).' '.nama_bulan($k[1]).' '.$k[0].' '.$jam;
						?>
						<div class="date"><?= floattostr($k[2]) ?><span><?= substr(nama_bulan($k[1]),0,3) ?></span></div>
						<div class="date_desc">
							<h6 class="title">
								<a href="<?= base_url($alias_post.'/'.$row['alias']) ?>"><?= $row['judul'] ?></a>
							</h6>
						  <div class="col-md-6">
						  		<span class="meta" style="margin-left:-15px"><?= $tgl.' &nbsp; &bull; &nbsp; hit : '.$row['hit'] ?></span>
						  </div>
						  <div class="col-md-6">
							  <div class="social" align="right">	
									<a class="btn_1" href="javascript: void(0);" onClick="popUp=window.open('http://www.facebook.com/sharer/sharer.php?u=<?= base_url($alias_post.'/'.$row['alias']) ?>', 'sharer', 'toolbar=0,status=0,width=550,height=550');popUp.focus();return false" target="_parent">
										<i class="fa fa-facebook fb"></i>
										<span class="share1 fb">Share</span>								
									</a>
									<a class="btn_1" href="javascript: void(0);" onClick="popUp=window.open('http://twitter.com/intent/tweet?source=sharethiscom&text=<?= $row['judul'] ?>&url=<?= base_url($alias_post.'/'.$row['alias']) ?>&via=', 'popupwindow', 'toolbar=0,status=0,width=550,height=550');popUp.focus();return false">
										<i class="fa fa-twitter tw"></i>
										<span class="share1">Tweet</span>								
									</a>
									<a class="btn_1" href="javascript:void(0);" onclick="popUp=window.open('https://plus.google.com/share?url=<?= base_url($alias_post.'/'.$row['alias']) ?>','popupwindow','scrollbars=yes,width=800,height=400');popUp.focus();return false">
										<i class="fa fa-google-plus google"></i>
										<span class="share1 google">Share</span>
									</a>
							   </div>
						   </div>

						</div>
						<div class="clearfix"> </div>
	                        
						<p class="description">
							<?php
							if(strip_tags($row['isi'])!=''){
								$X = strip_tags($row['isi']);
								if(strlen($X)>=300){
									$y = strpos($X, ' ', 285);
									$view = substr_replace($X, '',$y);
								}else{
									$view = $X;
								}
								
								echo $view;
								
							}else{
								echo strip_tags($row['judul']);
							}
							?> <a href="<?= $alias_post.'/'.$row['alias']; ?>" class="read-more">Read More</a>
						</p>
                    </div>
					<div class="clearfix"> </div>
				</div>
			 </div>

			 <?php } ?>


			 

     </div>
    </div>

    <ul class="pagination">
        <?php
            echo $linkHalaman;
        ?>
    </ul>

   </div>


   		<?php $this->load->view('sidebarpost'); ?>


  <div class="clearfix"> </div>
 </div>