<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mgeneral extends CI_Model {

	
	public function itemmesgs()
	{
		$q = $this->db->query("SELECT n FROM _inbox_ WHERE dibaca = '0'");
		$in_messages['jml'] = $q->num_rows();
		$in_messages['sql'] = $this->db->query("SELECT nama, LEFT(isi,75) as isi, tgl,n FROM _inbox_ WHERE dibaca = '0' ORDER BY tgl DESC LIMIT 0,4"); 
		return $in_messages ;
	}

	public function itemvisitor()
	{
		return $this->db->query("SELECT * FROM _pengunjung_ ORDER BY tgl DESC LIMIT 0,6"); 
	}

	public function detailvisitor( $tgl1 , $tgl2 )
	{
		return $this->db->query("SELECT * FROM _pengunjung_ WHERE tgl >= '$tgl1' AND tgl <= '$tgl2' ORDER BY tgl DESC"); 
	}

	public function jmlvisitor( $tgl1 , $tgl2 )
	{
		$tgl1 = substr($tgl1,0,10);
		$tgl2 = substr($tgl2,0,10);
		$q3 = $this->db->query("SELECT SUM(hits) AS hit FROM _pengunjung_hits_ WHERE tgl >= '$tgl1' AND tgl <= '$tgl2'");
		$data = $q3->row();
		return $data->hit;
	}

	public function itemlogadmin()
	{
		return $this->db->query("SELECT * FROM _logadministrator_ ORDER BY tgl DESC LIMIT 0,6"); 
	}

	public function detaillogadmin()
	{
		return $this->db->query("SELECT * FROM _logadministrator_ ORDER BY tgl DESC"); 
	}

	public function cleardatalogadmin()
	{
		$this->db->where('n !=', 'NULL');
  		$this->db->delete('_logadministrator_');
  		$this->db->truncate('_logadministrator_');

	}

	public function itemtbluser()
	{
		$sesi = $this->session->userdata('ok_deh');
		$sql = $this->db->query("SELECT nama,surel FROM _user_ WHERE user='$sesi[user]'");
		$row = $sql->row();
		$data['username'] = $sesi['user'];
		$data['nama']  = $row->nama;
		$data['surel'] = $row->surel;
		return $data; 
	}

	public function ubahuser($x, $data)
	{
		$this->db->where('n', $x);
		$this->db->update('_user_', $data);
		
	}

}