<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->model('mpages');
		$this->load->library('form_validation');

		$this->load->model('mgeneral');
		$this->load->helper('dedi_helper');
		
		$sesi = $this->session->userdata('ok_deh');
		if( !isset($sesi) ){ redirect(base_url()); }

		$menu_class = explode('/',$_SERVER['PHP_SELF']);
		$this->session->set_flashdata('menu_class', $menu_class[2]);
	}

	

	public function index($nomer='1')
	{
		$data['in_messages'] = $this->mgeneral->itemmesgs();
		$data['nomer'] = $nomer;
		$this->session->set_flashdata('pesan', '');

		$this->load->view('admin/pajinasi');
		$p = new Paging();
		$batas=5;
		$posisi = $p->cariPosisi($nomer,$batas);

		$data['sql'] = $this->mpages->data_pages($posisi,$batas);
		
		$jmlrecord = $this->mpages->jmlHalaman();

		$jmlhalaman = $p->jumlahHalaman($jmlrecord,$batas);

		$data['linkHalaman'] = $p->navHalaman($nomer,$jmlhalaman,base_url('pages'),'/page/');

		$data['posisi'] = $posisi;

		$this->load->view('admin/tabelpage',$data);
	}

	public function page($nomer='1')
	{
		if (!is_numeric($nomer)) {
			redirect('pages');
		}
		$data2['nomer'] = $nomer;
		$data2['in_messages'] = $this->mgeneral->itemmesgs();
		
		$this->load->view('admin/pajinasi');

		$p = new Paging();
		$batas=5;
		$posisi = $p->cariPosisi($nomer,$batas);

		
		$data2['sql'] = $this->mpages->data_pages($posisi,$batas);

		$jmlrecord = $this->mpages->jmlHalaman();

		$jmlhalaman = $p->jumlahHalaman($jmlrecord,$batas);

		$data2['linkHalaman'] = $p->navHalaman($nomer,$jmlhalaman,base_url('pages'),'/page/');

		$data2['posisi'] = $posisi;

		$this->load->view('admin/tabelpage',$data2);
	}

	public function newpage()
	{
		$data['in_messages'] = $this->mgeneral->itemmesgs();
		$data['titlepanel'] = 'New Page';
		$data['id'] = 'New';
		$data['tgl'] = date('d/m/Y');
		$data['jam'] = '';
		$data['judul'] = '';
		$data['alias'] = '';
		$data['isi'] = '';
		$data['tampil'] = '';

		$this->load->view('admin/tiny_mce');
		$this->load->view('admin/newpage',$data);
	}


	public function editpage($idx='')
	{
		
		if($idx=='')
		{
			redirect(base_url('pages'));
		}

		$jalan = '';
		$q = $this->mpages->data_page_edit($idx);
		foreach ($q->result_array() as $row2){

			$jalan = '1';
			$data['titlepanel'] = 'Edit Page : ' . $row2['judul'];
			$data['id'] = $idx;
			$k = explode( '-', $row2['tgl'] );
			$tgl = $k[2].'/'.$k[1].'/'.$k[0];
			$data['tgl'] = $tgl;
			$data['judul'] = $row2['judul'];
			$data['alias'] = $row2['alias'];
			$data['isi'] = $row2['isi'];
			$data['tampil'] = $row2['tampil'];
			$data['in_messages'] = $this->mgeneral->itemmesgs();

			$this->load->view('admin/tiny_mce');
			$this->load->view('admin/newpage',$data);
		}
		if($jalan==''){ redirect(base_url('pages')); }
	}

	public function simpan()
	{
		
		if($this->input->post('judul')!='' && $this->input->post('tgl')!=''){
						
			$a = $this->input->post('judul');
			$b = $this->input->post('alias');
			if($b==''){
				$b = judul_seo($a);
			}else{ $b = judul_seo($b); }
			$c = $this->input->post('status');
			$k = explode('/',$this->input->post('tgl'));
			$tgl = $k[2].'-'.$k[1].'-'.$k[0];
			
			$g = $this->input->post('isi');
			$x = $this->input->post('id');
			
			if($x=='New'){
				
				$objek = array(
					'n'=>'',
					'tgl'=>$tgl,
					'judul'=>$a,
					'alias'=>$b,
					'isi'=>$g,
					'hit'=>'0',
					'tampil'=>$c
					);
				$this->mpages->simpan_data($objek);
					
			}else{
				
				$objek = array(
					'tgl'=>$tgl,
					'judul'=>$a,
					'alias'=>$b,
					'isi'=>$g,
					'tampil'=>$c
					);

				$hasil = $this->mpages->update_data($x, $objek);

				if($hasil!='berhasil')
				{
					redirect(base_url('pages/editpage/' . $x));
				}
			}
		}

		redirect(base_url('pages'));
	}

	public function showhideme()
	{

		if($this->input->post('nm'))
		{
			$a = $this->input->post('nm');
			$hasil = $this->mpages->update_showhide($a);
		}
		
		redirect( $_SERVER['HTTP_REFERER'] );
	}

	public function deletepage()
	{
		if( $this->input->post('nm') )
		{
			$a = $this->input->post('nm');
			$b = $this->input->post('pass');
			$b = md5(  md5($b) . '45' . md5($b) );

			$sesi = $this->session->userdata('ok_deh');

			if( $b==$sesi['pass'] )
			{
				$this->mpages->delete_data($a);
			}
		}
		
		redirect( $_SERVER['HTTP_REFERER'] );
	}

}