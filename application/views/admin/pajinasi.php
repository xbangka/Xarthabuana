<?php 

class Paging{
	
	// Fungsi untuk mencek halaman dan posisi data
	function cariPosisi($nomer,$batas){

		if(empty($nomer) || !is_numeric($nomer)){
			$posisi=0;
			$nomer=1;
		}else{
			$posisi = abs(($nomer-1)) * $batas;
		}

		return $posisi;
	}

	// Fungsi untuk menghitung total halaman
	function jumlahHalaman($jmldata, $batas){
		$jmlhalaman = ceil($jmldata/$batas);
		return $jmlhalaman;
	}

	// Fungsi untuk link halaman 1,2,3 ... Next, Prev, First, Last
	function navHalaman($halaman_aktif, $jmlhalaman, $tujuan, $strfdr){
		$link_halaman = "";

		// Link First dan Previous
	/*	if ($halaman_aktif > 1){
			$link_halaman .= '<li><a href="?l=gallery&folder='.$strfdr.'">&laquo;</a></li>';
		}*/

		if (($halaman_aktif-1) > 0){
			$previous = $halaman_aktif-1;
			$link_halaman .= '<li><a href="'.$tujuan.$strfdr.$previous.'">&laquo;</a></li>';
		}

		// Link halaman 1,2,3, ...
		for ($i=1; $i<=$jmlhalaman; $i++){
			if ($i == $halaman_aktif){
				$link_halaman .= '<li class="active"><a href="javascript:;">'.$i.'<span class="sr-only">(current)</span></a></li>';
			}else{
				$link_halaman .= '<li><a href="'.$tujuan.$strfdr.$i.'">'.$i.'<span class="sr-only">(current)</span></a></li>';
			}
			$link_halaman .= "";
		}

		// Link Next dan Last
		if ($halaman_aktif < $jmlhalaman){
			$next=$halaman_aktif+1;
			$link_halaman .= '<li><a href="'.$tujuan.$strfdr.$next.'">&raquo;</a></li>';
		}

		/*if (($halaman_aktif != $jmlhalaman) && ($jmlhalaman != 0)){
			$link_halaman .= '<li><a href="?l=gallery&folder='.$strfdr.'&page='.$jmlhalaman.'">&raquo;</a></li>';
		}*/
		
		return $link_halaman;
	}
}
?>