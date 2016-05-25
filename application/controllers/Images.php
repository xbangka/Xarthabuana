<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Images extends CI_Controller {






	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->model('mgallery');
		$this->load->library('form_validation');
		$this->load->model('mgeneral');
		$this->load->helper('dedi_helper');
		$sesi = $this->session->userdata('ok_deh');
		if( !isset($sesi) ){ redirect(base_url()); }

		$menu_class = explode('/',$_SERVER['PHP_SELF']);
		$this->session->set_flashdata('menu_class', $menu_class[2]);
	}









	public function index()
	{
		$data['in_messages'] = $this->mgeneral->itemmesgs();
		$this->load->view('admin/imagessrc',$data);
	}

	public function gallery($nomer='1')
	{
		if (!is_numeric($nomer)) {
			redirect('images/gallery');
		}
		$data['nomer'] = $nomer;
		$data['in_messages'] = $this->mgeneral->itemmesgs();

		$this->load->view('admin/pajinasi');
		$p = new Paging();
		$batas=10;
		$posisi = $p->cariPosisi($nomer,$batas);

		$data['n'] = ($nomer-1) * $batas ;

		$data['sql'] = $this->mgallery->folderfoto($posisi,$batas);
		
		$jmlrecord = $this->mgallery->jmlHalaman();

		$jmlhalaman = $p->jumlahHalaman($jmlrecord,$batas);

		$data['linkHalaman'] = $p->navHalaman($nomer,$jmlhalaman,base_url('images'),'/gallery/');

		$data['posisi'] = $posisi;

		$this->load->view('admin/gallery',$data);
	}


	public function thumbnail($idx='')
	{
		if ($idx=='') {
			redirect( $_SERVER['HTTP_REFERER'] );
		}
		$data['cover'] = '';
		$data['idfolder'] = $idx;

		$cover = $this->mgallery->cari_cover_folder($idx);

		foreach ($cover->result_array() as $row)
		{
			$data['cover'] = $row['cover'];
		}

		$data['sql'] = $this->mgallery->tampil_gallery_foto($idx);

		$this->load->view('admin/thumbnail', $data);
	}

	public function select_thumbnail($namafolder='', $namafile='')
	{
		$objek = array('cover'=>$namafile);
		$this->mgallery->ganti_thumbnail($namafolder, $objek);
	}











	public function detailfoto($idfolder='', $page='1')
	{	if (!is_numeric($idfolder)) {
			redirect('images/gallery');
		}

		if (!is_numeric($page)) {
			$page='1';
		}

		$data['id'] = $idfolder;

		$data['in_messages'] = $this->mgeneral->itemmesgs();

		$data['sqlfolder'] = $this->mgallery->judul_album($idfolder);

		$this->load->view('admin/pajinasi');
		$p = new Paging();
		$batas=10;
		$posisi = $p->cariPosisi($page,$batas);

		$data['sql'] = $this->mgallery->detailfoto($posisi,$batas,$idfolder);
		
		$jmlrecord = $this->mgallery->jmlHalaman2($idfolder);

		$jmlhalaman = $p->jumlahHalaman($jmlrecord,$batas);

		$data['linkHalaman'] = $p->navHalaman($page,$jmlhalaman,base_url('images'),'/detailfoto/'.$idfolder.'/');

		$data['posisi'] = $posisi;

		$data['sql2'] = $this->mgallery->dialog_folder();

		$this->load->view('admin/detailfoto',$data);
	}

	public function uploadfoto()
	{
		if($this->input->post('id')!='' && $this->input->post('judul')!=''){
			$id 	= $this->input->post('id');
			$judul 	= $this->input->post('judul');
			$tgl 	= $this->input->post('tgl');
			$k 		= explode('/',substr($tgl,0,10));
			$tgl 	= $k[2].'-'.$k[1].'-'.$k[0].' '.substr($tgl,11,8);
			
			if(!empty($_FILES['foto1']['name'])){
				$foto1 = imagecreatefromjpeg($_FILES['foto1']['tmp_name']);
			}else{ $foto1 = ''; }
			if(!empty($_FILES['foto2']['name'])){
				$foto2 = imagecreatefromjpeg($_FILES['foto2']['tmp_name']);
			}else{ $foto2 = ''; }
			if(!empty($_FILES['foto3']['name'])){
				$foto3 = imagecreatefromjpeg($_FILES['foto3']['tmp_name']);
			}else{ $foto3 = ''; }
			if(!empty($_FILES['foto4']['name'])){
				$foto4 = imagecreatefromjpeg($_FILES['foto4']['tmp_name']);
			}else{ $foto4 = ''; }
			if(!empty($_FILES['foto5']['name'])){
				$foto5 = imagecreatefromjpeg($_FILES['foto5']['tmp_name']);
			}else{ $foto5 = ''; }
			
			$dir = '_images/gallery/';
			$a = substr(date('D'),1,1).date('YmHis');
			
			$filename1 = $dir.'90x55/'.$a;
			$filename2 = $dir.'120x80/'.$a;
			$filename3 = $dir.'172x97/'.$a;
			$filename4 = $dir.'272x153/'.$a;
			$filename5 = $dir.'300x169/'.$a;
			$filename6 = $dir.'373x210/'.$a;
			$filename7 = $dir.'627x352/'.$a;
			$filename8 = $dir.'760x486/'.$a;
			
			$width1 =  90; $height1 = 55;
			$width2 = 120; $height2 = 80;
			$width3 = 172; $height3 = 97;
			$width4 = 272; $height4 = 153;
			$width5 = 300; $height5 = 169;
			$width6 = 373; $height6 = 210;
			$width7 = 627; $height7 = 352;
			$width8 = 760; $height8 = 486;
			
			
			for( $i= 1 ; $i <= 5 ; $i++ ){
				$temp_foto = ${'foto'.$i} ;
				if($temp_foto!=''){
					for( $n= 1 ; $n <= 8 ; $n++ ){
						$thumb_width = ${'width'.$n};
						$thumb_height = ${'height'.$n};  
						
						$width = imagesx($temp_foto);
						$height = imagesy($temp_foto);
						
						$original_aspect = $width / $height;
						$thumb_aspect = $thumb_width / $thumb_height;
						
						if ( $original_aspect >= $thumb_aspect ){
						   // If image is wider than thumbnail (in aspect ratio sense)
						   $new_height = $thumb_height;
						   $new_width = $width / ($height / $thumb_height);
						}else{
						   // If the thumbnail is wider than the image
						   $new_width = $thumb_width;
						   $new_height = $height / ($width / $thumb_width);
						}
						
						$thumb = imagecreatetruecolor( $thumb_width, $thumb_height );
						
						// Resize and crop
						imagecopyresampled($thumb,
										   $temp_foto,
										   0 - ($new_width - $thumb_width) / 2, // Center the image horizontally
										   0 - ($new_height - $thumb_height) / 2, // Center the image vertically
										   0, 0,
										   $new_width, $new_height,
										   $width, $height);
						$filename = ${'filename'.$n}.$i.'.jpg';
						imagejpeg($thumb, $filename, 80);
					}
					
					$nmfile = $a.$i;
					$judul2 = $judul.' - '.$nmfile;

					$objek = array(
						'n'=>'',
						'idfolder'=>$id,
						'tgl'=>$tgl,
						'nmfile'=>$nmfile,
						'judul'=>$nmfile,
						'ket'=>$judul2
						);
					$this->mgallery->simpan_foto_gallery($objek);

					$ada = $this->mgallery->cek_cover_folder($id,$nmfile);
				}
			}
		}
		redirect( $_SERVER['HTTP_REFERER'] );
	}
	
	public function deletefilefoto()
	{

		if($this->input->post('nmfile') !='' && $this->input->post('nm') !=''){
			$x = $this->input->post('nm');
			$o = $this->input->post('nmfile');

			$this->mgallery->delete_foto_gallery($x);

			unlink('_images/gallery/90x55/'.$o.'.jpg');
			unlink('_images/gallery/120x80/'.$o.'.jpg');
			unlink('_images/gallery/172x97/'.$o.'.jpg');
			unlink('_images/gallery/272x153/'.$o.'.jpg');
			unlink('_images/gallery/300x169/'.$o.'.jpg');
			unlink('_images/gallery/373x210/'.$o.'.jpg');
			unlink('_images/gallery/627x352/'.$o.'.jpg');
			unlink('_images/gallery/760x486/'.$o.'.jpg');
		}
		redirect( $_SERVER['HTTP_REFERER'] );
	}


	public function editfilefoto()
	{
		if($this->input->post('nm')!='' && $this->input->post('folder')!='' && $this->input->post('nmtgl')!=''){
			$n = $this->input->post('nm');
			$folder = $this->input->post('folder');
			$tgl=$this->input->post('nmtgl');
			$nama=$this->input->post('nmnama');
			$ket = $this->input->post('ket');
			$k = explode('/',substr($tgl,0,10));
			$tgl= $k[2].'-'.$k[1].'-'.$k[0].' '.substr($tgl,11,8);
			if($nama==''){$nama=='No Name';}
			$objek = array(
						'idfolder'=>$folder,
						'judul'=>$nama,
						'tgl'=>$tgl,
						'ket'=>$ket
						);
			$this->mgallery->edit_foto_gallery($n, $objek);
		}
		redirect( $_SERVER['HTTP_REFERER'] );
	}














	public function rename()
	{

		if($this->input->post('nmold') !='' && $this->input->post('nmfile') !=''){
			$old = $this->input->post('nmold');
			$new = strtolower($this->input->post('nmfile'));
			$filename = $this->input->post('nmfolder').'/'.$old;
			$newfilename = $this->input->post('nmfolder').'/'.$new;
			if (file_exists($filename)) {
				rename($filename,$newfilename); 
			}
		}
		redirect( $_SERVER['HTTP_REFERER'] );
	}





	public function deletefile()
	{

		if($this->input->post('dir') !='' && $this->input->post('nama') !=''){
			
			if($this->input->post('tipe')=='dir'){
				$new = strtolower( $this->input->post('nama') );
				$folder = $this->input->post('dir') .'/'.$new.'/';
				
				if (file_exists($folder)) {
					rmdir($folder); 
				}

			}else{
				$filename = $this->input->post('dir').'/'.$this->input->post('nama');
				if (file_exists($filename)) {
					unlink ($filename); 
				}
			}
		}
		redirect( $_SERVER['HTTP_REFERER'] );
	}







	public function uploadfile()
	{

		if($this->input->post('dir') && $_FILES['foto']['name']!=''){
			
			$dir = $this->input->post('dir') ;
			$uploadfile = basename($_FILES['foto']['name']);
			if(substr($uploadfile,-4)!='.php'){
				move_uploaded_file($_FILES['foto']['tmp_name'], $dir .'/'.$uploadfile);
			}

		}
		redirect( $_SERVER['HTTP_REFERER'] );
	}








	public function newfolder()
	{
		if( $this->input->post('nm') !='' ){
			$newfolder = strtolower($this->input->post('nm'));
			$folder = $this->input->post('dir').'/'.$newfolder ;  //nama direktori 
			if (!file_exists($folder)) {
				mkdir ($folder); 
			}
		}
		redirect( $_SERVER['HTTP_REFERER'] );
	}






	public function newfoldergallery()
	{
		if($this->input->post('xyz')!=''){
			$x1=$this->input->post('xyz');
			$tgl = $this->input->post('tgl');
			$k = explode('/',$tgl);
			$tgl = $k[2].'-'.$k[1].'-'.$k[0];
			$alias = judul_seo($x1);
			$objek = array(
					'n'=>'',
					'tgl'=>$tgl,
					'folder'=>$x1,
					'alias'=>$alias,
					'cover'=>''
					);
			$this->mgallery->simpan_data($objek);
		}
		redirect( $_SERVER['HTTP_REFERER'] );
	}




	public function editfoldergallery()
	{
		if($this->input->post('nmfolder')!=''){
			
			$x1=$this->input->post('nmfolder');
			$id=$this->input->post('nm');
			$tgl = $this->input->post('tgl');
			$k = explode('/',$tgl);
			$tgl = $k[2].'-'.$k[1].'-'.$k[0];
			$alias = judul_seo($x1);

			$objek = array(
					'folder'=>$x1,
					'tgl'=>$tgl,
					'alias'=>$alias
					);

			$this->mgallery->data_post_edit($id, $objek);
		}
		redirect( $_SERVER['HTTP_REFERER'] );
	}





	public function deletegallery()
	{

		if($this->input->post('nm')!=''){
			
			$x=$this->input->post('nm');
			$b = $this->input->post('pass');
			$b = md5(  md5($b) . '45' . md5($b) );

			$sesi = $this->session->userdata('ok_deh');

			if( $b==$sesi['pass'] )
			{
				$this->mgallery->delete_data_folder($x);
				
				$sql = $this->mgallery->select_file_delete($x);

				foreach ($sql->result_array() as $o)
				{
					unlink('_images/gallery/90x55/'.$o['nmfile'].'.jpg');
					unlink('_images/gallery/120x80/'.$o['nmfile'].'.jpg');
					unlink('_images/gallery/172x97/'.$o['nmfile'].'.jpg');
					unlink('_images/gallery/272x153/'.$o['nmfile'].'.jpg');
					unlink('_images/gallery/300x169/'.$o['nmfile'].'.jpg');
					unlink('_images/gallery/373x210/'.$o['nmfile'].'.jpg');
					unlink('_images/gallery/627x352/'.$o['nmfile'].'.jpg');
					unlink('_images/gallery/760x486/'.$o['nmfile'].'.jpg');
				}
				$this->mgallery->delete_data_foto($x);
			}	
		}
		redirect( $_SERVER['HTTP_REFERER'] );
	}


}
