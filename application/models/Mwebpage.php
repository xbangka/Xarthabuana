<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mwebpage extends CI_Model {

 
	///  index

	public function menu0()
	{
		// ========================  Set Visitor  =============================
		$sesi = $this->session->userdata('tamu');
		if( !isset($sesi) ){
		  $tgl = date('Y-m-d H:i:s');
		  $ip = $this->input->ip_address();
		  $tamu = gethostbyaddr($_SERVER['REMOTE_ADDR']);
		  $browser = $this->input->user_agent();

		  $sql = $this->db->query("SELECT n FROM _pengunjung_ WHERE ip='$ip'");
		  $ada = $sql->num_rows();
		  if($ada>=1){
		    $this->db->query("UPDATE _pengunjung_ SET tgl='$tgl', nama_komputer='$tamu', browser='$browser' WHERE ip='$ip'");
		  }else{
		    $objek = array(
					'n'=>'',
					'tgl'=>$tgl,
					'ip'=>$ip,
					'nama_komputer'=>$tamu,
					'browser'=>$browser
					);
		    $this->db->insert('_pengunjung_', $objek);
		  }
		  
		  $tgl = substr($tgl,0,10);
		  $sql = $this->db->query("SELECT hits FROM _pengunjung_hits_ WHERE tgl='$tgl'");
		  $ada = $sql->num_rows();
		  if($ada>=1){
		    $data = $sql->row();
			$hit = $data->hits;
		    $hits = $hit + 1 ;
		    $this->db->query("UPDATE _pengunjung_hits_ SET hits='$hits' WHERE tgl='$tgl'");
		  }else{
		    $objek = array(
					'n'=>'',
					'tgl'=>$tgl,
					'hits'=>'1'
					);
		    $this->db->insert('_pengunjung_hits_', $objek);
		  }
		  $_SESSION['tamu'] = $ip;
		}

		return $this->db->query("SELECT * FROM _menu_ WHERE parent_id = '0' AND tampil = 'Y'");
	}

	public function menu1($x)
	{
		$q = $this->db->query("SELECT n FROM _menu_ WHERE parent_id = '$x' AND tampil = 'Y'");
		$ada = $q->num_rows();
		return $ada;
	}

	public function menu2($x)
	{
		return $this->db->query("SELECT * FROM _menu_ WHERE parent_id = '$x' AND tampil = 'Y'");
	}

	public function view_cabang()
	{
		return $this->db->query("SELECT * FROM _cabang_amf_ ORDER BY kode ASC");
	}




	/// Url Page

	public function laman($x)
	{
		#$q = $this->db->query("SELECT n FROM _laman_ WHERE alias = '$x' AND tampil = 'Y'");
		#$ada = $q->num_rows();
		#if($ada==1)
		#{
			return $this->db->query("SELECT * FROM _laman_ WHERE alias = '$x' AND tampil = 'Y'");
		#}
		#else
		#{
			#return $q = '';
		#}
	}

	public function laman_terbaru()
	{
		return $this->db->query("SELECT alias FROM _laman_ WHERE tampil = 'Y' ORDER BY tgl DESC LIMIT 0,1");
	}





	/// Url post

	public function postingan($categori, $alias='', $x, $y)
	{
		$q3 = $this->db->query("SELECT cat_id FROM _kategori_ WHERE nama = '$categori'");
		$data = $q3->row();
		$cat_id = $data->cat_id;

		if ($alias=='') {
			return $this->db->query("SELECT tgl, judul, alias, LEFT(isi,900) as isi, cover, hit, n  FROM _posting_ WHERE tampil = 'Y' AND cat_id = '$cat_id' ORDER BY tgl DESC LIMIT $x, $y");
		}
		else
		{
			return $this->db->query("SELECT * FROM _posting_ WHERE alias = '$alias' AND tampil = 'Y' AND cat_id = '$cat_id'");
		}

	}

	public function cek_kategori($categori)
	{
		$q = $this->db->query("SELECT n FROM _kategori_ WHERE nama = '$categori'");
		$ada = $q->num_rows();
		return $ada;
	}

	public function jmlHalaman_post($categori)
	{
		$q3 = $this->db->query("SELECT cat_id FROM _kategori_ WHERE nama = '$categori'");
		$data = $q3->row();
		$cat_id = $data->cat_id;

		$q = $this->db->query("SELECT n FROM _posting_ WHERE cat_id = '$cat_id'");
		$jml = $q->num_rows();
		return $jml;
	}






	/// Url Cabang

	public function kantor_cabang($x,$y)
	{
		return $this->db->query("SELECT * FROM _cabang_amf_ ORDER BY n ASC LIMIT $x, $y");
	}

	public function kantor_cabang_detail($detail)
	{
		$detail = 'cabang/' . $detail ;
		return $this->db->query("SELECT * FROM _cabang_amf_ WHERE url = '$detail'");
	}

	public function jmlHalaman()
	{
		$q = $this->db->query("SELECT n FROM _cabang_amf_");
		$jml = $q->num_rows();
		return $jml;
	}
	
	public function simpan_kontak($data)
	{
		return $this->db->insert('_inbox_', $data);
	}




	/// Url Gallery

	public function galleryalbum($x,$y)
	{
		return $this->db->query("SELECT * FROM _gallery_folder_ ORDER BY n ASC LIMIT $x, $y");
	}

	public function jmlHalamangallery()
	{
		$q = $this->db->query("SELECT n FROM _gallery_folder_");
		$jml = $q->num_rows();
		return $jml;
	}

	public function fotogallery($url_folder)
	{
		$gallery = $this->db->query("SELECT n, folder FROM _gallery_folder_ WHERE alias = '$url_folder'");
		
		$data['judul'] = '';

		$sql = $gallery->row();

		$data['judul'] = $sql->folder;

		$id = $sql->n;

		$data['sql'] = $this->db->query("SELECT * FROM _gallery_foto_ WHERE idfolder = '$id' ORDER BY n ASC");

		return $data ;
	}



	/// Sidebar

	public function ambilsidebar1()
	{
		$q3 = $this->db->query("SELECT text FROM _sidebar_ WHERE ket = '1'");
		$data = $q3->row();
		return $data->text;
	}

	public function ambilsidebar2()
	{
		$q3 = $this->db->query("SELECT text FROM _sidebar_ WHERE ket = '2'");
		$data = $q3->row();
		return $data->text;
	}

	public function sidebaronhome()
	{
		return $this->db->query("SELECT * FROM _sidebar3_");
	}


}