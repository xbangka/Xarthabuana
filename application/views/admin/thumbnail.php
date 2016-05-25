<div class="row">
	<div class="col-md-12">
		
		<!---->
		<div align="center">
			<?php 
			$n = 0 ;
			foreach ($sql->result_array() as $row)
			{	
				$n+=1;
				if($cover==$row['nmfile']){ 
					$backcolor='background-color:#66FF66'; 
				}
				else
				{
				 	$backcolor=''; 
				}
				echo '<input id="id_'.$n.'" type="hidden" value="f_'.$row['nmfile'].'" />';
				?>
				<div style="width:182px;height:130px;padding:5px 5px 5px 5px;margin:5px 10px 5px 10px;float:left;<?php echo $backcolor; ?>" id="<?php echo 'f_'.$row['nmfile']; ?>">
					<img src="<?php echo base_url('_images/gallery/172x97/'.$row['nmfile'].'.jpg'); ?>" 
					width="172px" height="97px" onClick="thumbnail_terpilih('<?php echo $row['nmfile']; ?>');"><br>
					<?php echo $row['nmfile']; ?>
				</div>
			
			<?php 
			} 

			echo '<input id="jmlfile" type="hidden" value="'.$n.'" />';
			echo '<input id="idfolder" type="hidden" value="'.$idfolder.'" />';
			

			?>
			<div style="width:100%;height:10px;float:left;margin-top:20px">

			</div>

		</div>
		<!---->

	</div>
</div>