<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cabang extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mwebpage');
		$this->load->helper('dedi_helper');

		$sidebar1 = $this->mwebpage->ambilsidebar1();
		$sidebar2 = $this->mwebpage->ambilsidebar2();
		$this->session->set_flashdata('sidebar1', $sidebar1);
		$this->session->set_flashdata('sidebar2', $sidebar2);
	}

	public function index($nomer='1')
	{
		$this->page($nomer);
	}


	public function page($nomer='1')
	{
		if (!is_numeric($nomer)) {
			redirect('cabang');
		}

		$sql		= $this->mwebpage->menu0();
		$menu_dedi 	= '';
		foreach ($sql->result_array() as $row)
		{
			$ada = $this->mwebpage->menu1($row['n']);

			if($ada>=1){
				$menu_dedi 	= $menu_dedi . '
	            <li class="dropdown">
	                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">'.$row['title'].'<b class="caret"></b></a>
	                <ul class="dropdown-menu">
				';

				$sql2		= $this->mwebpage->menu2($row['n']);
				foreach ($sql2->result_array() as $row2)
				{
					$menu_dedi 	= $menu_dedi . '<li><a href="'.base_url($row2['url']).'">'.$row2['title'].'</a></li>';
				}

				$menu_dedi 	= $menu_dedi . '
	                </ul>
	            </li>
				';
			}
			else
			{
				$menu_dedi = $menu_dedi . '<li><a href="'.base_url($row['url']).'">'.$row['title'].'</a></li>';
			}

		}

		$data['menu_dedi'] 	= $menu_dedi;

		$this->load->view('admin/pajinasi');
		$p = new Paging();
		$batas=5;
		$posisi = $p->cariPosisi($nomer,$batas);

		$data['sql'] = $this->mwebpage->kantor_cabang($posisi,$batas);
		
		$jmlrecord = $this->mwebpage->jmlHalaman();

		$jmlhalaman = $p->jumlahHalaman($jmlrecord,$batas);

		$data['linkHalaman'] = $p->navHalaman($nomer,$jmlhalaman,base_url('cabang'),'/page/');

		$data['posisi'] = $posisi;

		
		$titlepage 	=  'Cabang PT. Arthabuana Margausaha Finance';

		$metadesc = '';
		$metakeys = '';

		////////////////////////////////
		$data['banner'] 	= 'tidak' ;
		$data['sidebar'] 	= 'tidak' ;
		$data['mybody'] 	= 'cabang' ;
		///////////////////////////////
		$data['attrpage']	= array('judul'=>$titlepage, 'metadesc'=>$metadesc, 'metakeys'=>$metakeys);
		

		$this->load->view('webpage',$data);
	}

	public function peta()
	{
		$data['mapx'] 	= $this->input->post('ko_x');
		$data['mapy'] 	= $this->input->post('ko_y');
		$this->load->view('load_map',$data);
	}



	public function detailcabang($detail)
	{
		$sql		= $this->mwebpage->menu0();
		$menu_dedi 	= '';
		foreach ($sql->result_array() as $row)
		{
			$ada = $this->mwebpage->menu1($row['n']);

			if($ada>=1){
				$menu_dedi 	= $menu_dedi . '
	            <li class="dropdown">
	                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">'.$row['title'].'<b class="caret"></b></a>
	                <ul class="dropdown-menu">
				';

				$sql2 = $this->mwebpage->menu2($row['n']);
				foreach ($sql2->result_array() as $row2)
				{
					$menu_dedi 	= $menu_dedi . '<li><a href="'.base_url($row2['url']).'">'.$row2['title'].'</a></li>';
				}

				$menu_dedi 	= $menu_dedi . '
	                </ul>
	            </li>
				';
			}
			else
			{
				$menu_dedi = $menu_dedi . '<li><a href="'.base_url($row['url']).'">'.$row['title'].'</a></li>';
			}

		}

		$data['menu_dedi'] 	= $menu_dedi;

		$sql = $this->mwebpage->kantor_cabang_detail($detail);

		foreach ($sql->result_array() as $row)
		{
			$data['gambar'] = $detail;
			$data['namacabang'] = $row['namacabang'];
			$data['alamat'] = $row['alamat'];
			$data['notlp1'] = $row['notlp1'];
			$data['notlp2'] = $row['notlp2'];
			$data['fax1'] = $row['fax1'];
			$data['fax2'] = $row['fax2'];
			$data['mapx'] = $row['mapx'];
			$data['mapy']= $row['mapy'];
		}
		
		$titlepage 	=  'Cabang PT. Arthabuana Margausaha Finance';

		$metadesc = '';
		$metakeys = '';

		////////////////////////////////
		$data['banner'] 	= 'tidak' ;
		$data['sidebar'] 	= 'tidak' ;
		$data['mybody'] 	= 'cabangdetail' ;
		///////////////////////////////
		$data['attrpage']	= array('judul'=>$titlepage, 'metadesc'=>$metadesc, 'metakeys'=>$metakeys);

		$this->load->view('webpage',$data);
	}

}