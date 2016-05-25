<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mbranchs extends CI_Model {

	public function data_cabang($x,$y)
	{
		return $q = $this->db->query("SELECT * FROM _cabang_amf_ ORDER BY kode ASC LIMIT $x,$y");
	}

	public function ambil_cabang($x)
	{
		return $this->db->query("SELECT * FROM _cabang_amf_ WHERE n='$x'");
	}


	public function jmlHalaman()
	{
		$q = $this->db->query("SELECT n FROM _cabang_amf_");
		$jml = $q->num_rows();
		return $jml;
	}

	public function update_cabang($x,$objek)
	{
		$this->db->where('n', $x);
		$this->db->update('_cabang_amf_', $objek);
	}

	public function delete_cabang($x)
	{
		$this->db->where('n', $x);
  		$this->db->delete('_cabang_amf_');
	}

	public function save_cabang($data)
	{
		return $this->db->insert('_cabang_amf_', $data);
	}

}