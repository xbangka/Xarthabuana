<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mgallery extends CI_Model {

 


	public function folderfoto($x,$y)
	{
		return $q = $this->db->query("SELECT * FROM _gallery_folder_ ORDER BY tgl DESC LIMIT $x, $y");
	}




	public function jmlHalaman()
	{
		$q = $this->db->query("SELECT n FROM _gallery_folder_");
		$jml = $q->num_rows();
		return $jml;
	}




	public function simpan_data($data)
	{
		return $this->db->insert('_gallery_folder_', $data);
	}
	public function simpan_foto_gallery($data)
	{
		$this->db->insert('_gallery_foto_', $data);
	}



	public function update_data($x, $data)
	{
		$this->db->where('n', $x);

		$this->db->update('_gallery_folder_', $data);

		if( $this->db->affected_rows() )
		{
			return $q = 'berhasil';
		}
		else
		{
			return $q = 'gagal';
		}
	}





	public function delete_data_folder($x)
	{
		$this->db->where('n', $x);
  		$this->db->delete('_gallery_folder_');
	}

	public function delete_data_foto($x)
	{
		$this->db->where('idfolder', $x);
  		$this->db->delete('_gallery_foto_');
	}

	public function select_file_delete($x)
	{
		return $q = $this->db->query("SELECT nmfile FROM _gallery_foto_ WHERE idfolder='$x'");
	}

	public function data_post_edit($id, $objek)
	{
		$this->db->where('n', $id);

		$this->db->update('_gallery_folder_', $objek);

		if( $this->db->affected_rows() )
		{
			return $q = 'berhasil';
		}
		else
		{
			return $q = 'gagal';
		}
	}










	public function cari_cover_folder($id)
	{
		return $this->db->query("SELECT cover FROM _gallery_folder_ WHERE n=$id");
	}

	public function tampil_gallery_foto($id)
	{
		return $q = $this->db->query("SELECT nmfile FROM _gallery_foto_ WHERE idfolder='$id'");
	}

	public function ganti_thumbnail($id,$objek)
	{
		$this->db->where('n', $id);
		$this->db->update('_gallery_folder_', $objek);
	}






	public function judul_album($id)
	{
		return $this->db->query("SELECT tgl, folder FROM _gallery_folder_ WHERE n='$id'");
	}

	public function detailfoto($x,$y,$id)
	{
		return $q = $this->db->query("SELECT *	FROM _gallery_foto_ WHERE idfolder='$id' ORDER BY tgl ASC LIMIT $x,$y");
	}

	public function jmlHalaman2($id)
	{
		$q = $this->db->query("SELECT n FROM _gallery_foto_ WHERE idfolder='$id'");
		$jml = $q->num_rows();
		return $jml;
	}

	public function dialog_folder()
	{
		return $q = $this->db->query("SELECT n, folder FROM _gallery_folder_ ORDER BY folder ASC");
	}

	public function cek_cover_folder($id,$nmfile)
	{
		$q = $this->db->query("SELECT n	FROM _gallery_folder_ WHERE n='$id' AND cover=''");
		$ada = $q->num_rows();
		if ($ada==1) {
			$objek = array('cover'=>$nmfile );
			$this->db->where('n', $id);
			$this->db->update('_gallery_folder_', $objek);
		}
	}


	public function delete_foto_gallery($x)
	{
		$this->db->where('n', $x);
  		$this->db->delete('_gallery_foto_');
	}

	public function edit_foto_gallery($n, $objek)
	{
		$this->db->where('n', $n);
  		$this->db->update('_gallery_foto_', $objek);
	}


}