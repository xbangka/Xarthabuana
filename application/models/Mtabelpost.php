<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Mtabelpost extends CI_Model {

	public function data_postingan($x,$y)
	{
		return $q = $this->db->query("SELECT _posting_.*,  _kategori_.nama FROM _posting_, _kategori_ WHERE _kategori_.cat_id = _posting_.cat_id ORDER BY _posting_.tgl DESC LIMIT $x, $y");
	}

	public function jmlHalaman()
	{
		$q = $this->db->query("SELECT n FROM _posting_");
		$jml = $q->num_rows();
		return $jml;
	}

	public function data_kategori()
	{
		return $this->db->query("SELECT * FROM _kategori_");
	}

	public function data_post_edit($data)
	{
		return $this->db->query("SELECT * FROM _posting_ WHERE n = '$data'");
	}

	public function simpan_data($data)
	{
		return $this->db->insert('_posting_', $data);
	}

	public function update_data($x, $data)
	{
		$this->db->where('n', $x);

		$this->db->update('_posting_', $data);

		if( $this->db->affected_rows() )
		{
			return $q = 'berhasil';
		}
		else
		{
			return $q = 'gagal';
		}
	}



	public function update_showhide($x)
	{
		$q3 = $this->db->query("SELECT tampil FROM _posting_ WHERE n = '$x'");
		$data = $q3->row();
		$ro = $data->tampil;

		if($ro=='Y'){
			$s = 'N';
		}else{
			$s = 'Y';
		}

		$objek = array('tampil'=>$s);

		$this->db->where('n', $x);

		$this->db->update('_posting_', $objek);

		if( $this->db->affected_rows() )
		{
			return $q = 'berhasil';
		}
		else
		{
			return $q = 'gagal';
		}
	}

	public function delete_data($x)
	{
		$this->db->where('n', $x);
  		$this->db->delete('_posting_');
	}



	public function data_sidebar($x)
	{
		return $this->db->query("SELECT * FROM _sidebar_ WHERE ket = '$x'");
	}
	
	public function data_sidebar_onhome()
	{
		return $this->db->query("SELECT * FROM _sidebar3_");
	}


	public function update_data_sidebarid($ket, $text)
	{
		$objek = array('text'=>$text);

		$this->db->where('n', $ket);

		$this->db->update('_sidebar_', $objek);

		if( $this->db->affected_rows() )
		{
			return $q = 'berhasil';
		}
		else
		{
			return $q = 'gagal';
		}
	}


	public function loadsidebaronhome($x)
	{
		return $this->db->query("SELECT * FROM _sidebar3_ WHERE n = '$x'");
	}

	public function savesidebaronhome($x, $objek)
	{
		$this->db->where('n', $x);

		$this->db->update('_sidebar3_', $objek);
	}

}