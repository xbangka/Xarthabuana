<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Dasbon extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->model('mdasbon');
		$this->load->library('form_validation');
		$this->load->helper('dedi_helper');
		$this->load->model('mgeneral');
		
		$menu_class = explode('/',$_SERVER['PHP_SELF']);
	}

	public function index()
	{
		$sesi = $this->session->userdata('ok_deh');
		if( !isset($sesi) ){ redirect(base_url()); }

		$this->session->set_flashdata('pesan', '');

		$data['pages'] = $this->mdasbon->itempages();
		$data['posts'] = $this->mdasbon->itemposts();
		$data['visit'] = $this->mdasbon->itemvisit();
		$data['mesgs'] = $this->mdasbon->itemmesgs();
		$data['in_messages'] = $this->mgeneral->itemmesgs();
		$this->load->view('admin/depan',$data);
	}


}