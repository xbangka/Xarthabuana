<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery extends CI_Controller {

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

		$data['sql'] = $this->mwebpage->galleryalbum($posisi,$batas);
		
		$jmlrecord = $this->mwebpage->jmlHalamangallery();

		$jmlhalaman = $p->jumlahHalaman($jmlrecord,$batas);

		$data['linkHalaman'] = $p->navHalaman($nomer,$jmlhalaman,base_url('gallery'),'/page/');

		$data['posisi'] = $posisi ;
		
		$titlepage 	=  'gallery ' . $nomer . ' | PT. Arthabuana Margausaha Finance';

		$metadesc = '';
		$metakeys = 'gallery';

		////////////////////////////////
		$data['banner'] 	= 'tidak' ;
		$data['sidebar'] 	= 'tidak' ;
		$data['mybody'] 	= 'gallery' ;
		///////////////////////////////
		$data['attrpage']	= array('judul'=>$titlepage, 'metadesc'=>$metadesc, 'metakeys'=>$metakeys);
		

		$this->load->view('webpage',$data);
	}


	public function detailfoto($url_folder='')
	{
		if($url_folder==''){
			redirect(base_url('gallery')) ; 
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

		$fotogallery = $this->mwebpage->fotogallery($url_folder);
		
		$titlepage 	=  $fotogallery['judul'] . ' | PT. Arthabuana Margausaha Finance';
		
			$data['sql'] = $fotogallery['sql'];
			$data['judul'] = $fotogallery['judul'];
			$metadesc = strip_tags($fotogallery['judul']);
			$metadesc = str_replace('"', '', $metadesc);
			$d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','| ','`','~','!','@','%','$','^','&','*','=','?','+');
			$string = str_replace($d, '', $metadesc);
			$string = strtolower(str_replace(' ', ', ', $string));
			$metakeys = $string;
		
			

		////////////////////////////////
		$data['banner'] 	= 'tidak' ;
		$data['sidebar'] 	= 'tidak' ;
		$data['mybody'] 	= 'detailpoto' ;
		///////////////////////////////
		$data['attrpage']	= array('judul'=>$titlepage, 'metadesc'=>$metadesc, 'metakeys'=>$metakeys);
		

		$this->load->view('webpage',$data);
	}

}