<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mlojin extends CI_Model {

	public function cek_user($u)
	{
		$q = $this->db->query("SELECT n FROM _user_ WHERE kesempatan <> 0 AND user = '$u';");
		$ada = $q->num_rows();
		return $ada;
	}

	public function cek_md5($u,$x)
	{
		$q2 = $this->db->query("SELECT n FROM _user_ WHERE sandi = '$x' AND user = '$u';");
		$ada2 = $q2->num_rows();
		return $ada2;
	}

	public function cek_kesempatan()
	{
		$q3 = $this->db->query("SELECT kesempatan FROM _user_ WHERE n = '1'");
		$data = $q3->row();
		return $data->kesempatan;
	}

	public function kesempatan_berkurang_satu($kesempatan)
	{
		$this->db->query("UPDATE _user_ SET kesempatan = '$kesempatan' WHERE n = '1'");
	}

	public function save_log($data)
	{
		return $this->db->insert('_logadministrator_', $data);
	}

}