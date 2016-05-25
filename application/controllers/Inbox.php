<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Inbox extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->model('minbox');
		$this->load->helper('dedi_helper');
		$this->load->model('mgeneral');

		$sesi = $this->session->userdata('ok_deh');
		if( !isset($sesi) ){ redirect(base_url()); }

		$menu_class = explode('/',$_SERVER['PHP_SELF']);
		$this->session->set_flashdata('menu_class', $menu_class[2]);
	}



	public function index($nomer='1')
	{
		
		$data['in_messages'] = $this->mgeneral->itemmesgs();
		$data['nomer'] = $nomer;

		$this->load->view('admin/pajinasi');
		$p = new Paging();
		$batas=10;
		$posisi = $p->cariPosisi($nomer,$batas);

		$data['sql'] = $this->minbox->data_box($posisi,$batas);
		
		$jmlrecord = $this->minbox->jmlHalaman();

		$jmlhalaman = $p->jumlahHalaman($jmlrecord,$batas);

		$data['linkHalaman'] = $p->navHalaman($nomer,$jmlhalaman,base_url('inbox'),'/page/');

		$data['posisi'] = $posisi;

		$this->load->view('admin/inbox',$data);
	}


	public function page($nomer='1')
	{
		if (!is_numeric($nomer)) {
			redirect('inbox');
		}
		$data['nomer'] = $nomer;
		$data['in_messages'] = $this->mgeneral->itemmesgs();

		$this->load->view('admin/pajinasi');
		$p = new Paging();
		$batas=10;
		$posisi = $p->cariPosisi($nomer,$batas);

		$data['sql'] = $this->minbox->data_box($posisi,$batas);
		
		$jmlrecord = $this->minbox->jmlHalaman();

		$jmlhalaman = $p->jumlahHalaman($jmlrecord,$batas);

		$data['linkHalaman'] = $p->navHalaman($nomer,$jmlhalaman,base_url('inbox'),'/page/');

		$data['posisi'] = $posisi;

		$this->load->view('admin/inbox',$data);
	}


	public function detail($nomer='1')
	{
		if (!is_numeric($nomer)) {
			redirect('inbox');
		}
		$data['nomer'] = $nomer;

		$data['kembali'] = $_SERVER['HTTP_REFERER'];

		$data['sql'] = $this->minbox->detail($nomer);

		$data['in_messages'] = $this->mgeneral->itemmesgs();

		$this->load->view('admin/inboxdetail',$data);
	}



	public function deleteinbox()
	{
		if($this->input->post('id')){
			$x=$this->input->post('id');
			$this->minbox->delete_inbox($x);
		}
		redirect( $_SERVER['HTTP_REFERER'] );
	}

}