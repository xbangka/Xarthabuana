<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mmainmenu extends CI_Model {

	public function tabel_menu()
	{
		return $this->db->query("SELECT * FROM _menu_ WHERE parent_id = 0 ORDER BY n ASC");
	}

	public function tabel_menu_anakan($x)
	{
		return $this->db->query("SELECT * FROM _menu_  WHERE parent_id = $x ORDER BY n ASC");
	}

	public function select_induk()
	{
		return $this->db->query("SELECT n, title FROM _menu_ WHERE parent_id=0 ORDER BY n ASC");
	}


	public function update_showhide($x)
	{
		$q3 = $this->db->query("SELECT tampil FROM _menu_ WHERE n = $x");
		$data = $q3->row();
		$ro = $data->tampil;

		if($ro=='Y'){
			$s = 'N';
		}else{
			$s = 'Y';
		}

		$objek = array('tampil'=>$s);

		$this->db->where('n', $x);

		$this->db->update('_menu_', $objek);

		if( $this->db->affected_rows() )
		{
			return $q = 'berhasil';
		}
		else
		{
			return $q = 'gagal';
		}
	}


	public function update_menu($x,$objek)
	{
		$this->db->where('n', $x);
		$this->db->update('_menu_', $objek);
	}

	public function newmenu($data)
	{
		return $this->db->insert('_menu_', $data);
	}

}