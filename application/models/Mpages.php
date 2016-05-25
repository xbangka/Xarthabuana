<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Mpages extends CI_Model {


	public function data_pages($x,$y)
	{
		return $q = $this->db->query("SELECT * FROM _laman_ ORDER BY tgl DESC LIMIT $x, $y");
	}



	public function jmlHalaman()
	{
		$q = $this->db->query("SELECT n FROM _laman_");
		$jml = $q->num_rows();
		return $jml;
	}



	public function data_page_edit($data)
	{
		return $this->db->query("SELECT * FROM _laman_ WHERE n = '$data'");
	}



	public function simpan_data($data)
	{
		return $this->db->insert('_laman_', $data);
	}



	public function update_data($x, $data)
	{
		$this->db->where('n', $x);

		$this->db->update('_laman_', $data);

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
		$q3 = $this->db->query("SELECT tampil FROM _laman_ WHERE n = '$x'");
		$data = $q3->row();
		$ro = $data->tampil;

		if($ro=='Y'){
			$s = 'N';
		}else{
			$s = 'Y';
		}

		$objek = array('tampil'=>$s);

		$this->db->where('n', $x);

		$this->db->update('_laman_', $objek);

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
  		$this->db->delete('_laman_');
	}



}