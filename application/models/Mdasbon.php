<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdasbon extends CI_Model {

	public function itempages()
	{
		$q = $this->db->query("SELECT n FROM _laman_");
		$jml = $q->num_rows();
		return $jml;
	}

	public function itemposts()
	{
		$q = $this->db->query("SELECT n FROM _posting_");
		$jml = $q->num_rows();
		return $jml;
	}

	public function itemvisit()
	{
		$tgl = date('Y-m-d') ;
		$q = $this->db->query("SELECT n FROM _pengunjung_ WHERE LEFT(tgl,10) = '$tgl'");
		$jml = $q->num_rows();
		return $jml;
	}

	public function itemmesgs()
	{
		$q = $this->db->query("SELECT n FROM _inbox_ WHERE dibaca = '0'");
		$jml = $q->num_rows();
		return $jml;
	}

}