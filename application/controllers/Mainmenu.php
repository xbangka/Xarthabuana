<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mainmenu extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->model('mmainmenu');

		$this->load->model('mgeneral');
		$this->load->helper('dedi_helper');

		$sesi = $this->session->userdata('ok_deh');
		if( !isset($sesi) ){ redirect(base_url()); }

		$menu_class = explode('/',$_SERVER['PHP_SELF']);
		$this->session->set_flashdata('menu_class', $menu_class[2]);
	}


	public function index()
	{
		$data['in_messages'] = $this->mgeneral->itemmesgs();
		
		$data['sql'] = $this->mmainmenu->tabel_menu();

		$data['sql3'] = $this->mmainmenu->select_induk();

		$this->load->view('admin/mainmenu',$data);
	}

	public function showhide()
	{
		if($this->input->post('nm')){
			$x=$this->input->post('nm');
			$hasil = $this->mmainmenu->update_showhide($x);
		}
		redirect( $_SERVER['HTTP_REFERER'] );
	}

	public function editmenu()
	{
		if($this->input->post('nm')!='' && $this->input->post('menu')!=''){
			$x=$this->input->post('nm');
			$x1=$this->input->post('menu');
			$url = $this->input->post('url');
			if($url==''){$url = '#';}
			
			$objek = array(
				'title'=>$x1,
				'url'=>$url
				);
			$this->mmainmenu->update_menu($x,$objek);
		}
		redirect( $_SERVER['HTTP_REFERER'] );
	}


	public function newmenu()
	{
		if($this->input->post('nama')!=''){
			$x1=$this->input->post('parent');
			$x2=$this->input->post('nama');
			$url = $this->input->post('url');
			if($url==''){$url = '#';}
			$objek = array(
				'n'=>'',
				'parent_id'=>$x1,
				'title'=>$x2,
				'url'=>$url,
				'tampil'=>'N',
				'fix'=>'N'
				);
			$this->mmainmenu->newmenu($objek);
		}
		redirect( $_SERVER['HTTP_REFERER'] );
	}


}