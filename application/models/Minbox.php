<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Minbox extends CI_Model {

	public function data_box($x,$y)
	{
		return $q = $this->db->query("SELECT * FROM _inbox_ ORDER BY tgl DESC LIMIT $x,$y");
	}

	public function detail($x)
	{
		$objek = array('dibaca'=>'1');

		$this->db->where('n', $x);

		$this->db->update('_inbox_', $objek);

		return $q = $this->db->query("SELECT * FROM _inbox_ WHERE n='$x'");
	}


	public function jmlHalaman()
	{
		$q = $this->db->query("SELECT n FROM _inbox_");
		$jml = $q->num_rows();
		return $jml;
	}


	public function delete_inbox($x)
	{
		$this->db->where('n', $x);
  		$this->db->delete('_inbox_');
	}

}