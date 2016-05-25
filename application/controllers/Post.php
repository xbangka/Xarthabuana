<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends CI_Controller {

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



	public function index()
	{	
		$sqli = $this->mwebpage->laman_terbaru();
		foreach ($sqli->result_array() as $row)
		{
			$hhh = $row['alias'];
		}
		$this->s($hhh);
	}


	public function s($categori='', $url_page='', $nomer='1')
	{	
		
		if($categori=='' || $categori==null)
		{
			redirect(base_url());
		}

		$url_page = addslashes($url_page);
		$categori = addslashes($categori);

		$ada2 = $this->mwebpage->cek_kategori($categori);
		if($ada2==0)
		{
			redirect(base_url());
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

		if($url_page=='' || $url_page==null || $url_page=='xpage')
		{
			$data['alias_post']	= $categori;

			$this->load->view('admin/pajinasi');
			$p = new Paging();
			$batas=5;
			$posisi = $p->cariPosisi($nomer,$batas);

			$data['sql2'] = $this->mwebpage->postingan($categori,'',$posisi,$batas);
			
			$jmlrecord = $this->mwebpage->jmlHalaman_post($categori);

			$jmlhalaman = $p->jumlahHalaman($jmlrecord,$batas);

			$data['linkHalaman'] = $p->navHalaman($nomer,$jmlhalaman,base_url('news'),'/page/');

			$data['posisi'] = $posisi;
			
			$titlepage 	=  ucwords($categori).' | PT. Arthabuana Margausaha Finance';

			$metadesc = '';
			$metakeys = '';

			////////////////////////////////
			$data['banner'] 	= 'tidak' ;
			$data['sidebar'] 	= 'tidak' ;
			$data['mybody'] 	= 'post' ;
			///////////////////////////////
			

		}
		else
		{
		
			$sql2 = $this->mwebpage->postingan($categori, $url_page,'','');
			$data['judul_post'] = '';
			$data['isi_post']   = '';
			$data['alias_post']	= '';
			$data['categori']	= '';
			

			foreach ($sql2->result_array() as $row)
			{
				$data['judul_post'] = $row['judul'];
				$data['isi_post'] 	= $row['isi'];
				$data['alias_post']	= $row['alias'];
				$data['categori']	= $categori;
				$titlepage 	=  ucwords($row['judul']).' | PT. Arthabuana Margausaha Finance';

				$metadesc = strip_tags($row['isi']);
				$metadesc = str_replace('"', '', $metadesc);
				$d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','| ','`','~','!','@','%','$','^','&','*','=','?','+');
				$string = str_replace($d, '', $metadesc);
				$string = strtolower(str_replace(' ', ', ', $string));
				$metakeys = $string;

				////////////////////////////////
				$data['banner'] 	= 'tidak' ;
				$data['sidebar'] 	= 'tidak' ;
				$data['mybody'] 	= 'postdetail' ;
				///////////////////////////////
			}

			

			if($data['judul_post']=='' || $data['judul_post'] == null)
			{
				$titlepage 	= 'Error 404';
				$metadesc 	= '404';
				$metakeys 	= '404';
				
				////////////////////////////////
				$data['banner'] 	= 'tidak' ;
				$data['sidebar'] 	= 'tidak' ;
				$data['mybody'] 	= 'er404' ;
				////////////////////////////////
			} 
			
		}
		
		$data['attrpage']	= array('judul'=>$titlepage, 'metadesc'=>$metadesc, 'metakeys'=>$metakeys);
		$this->load->view('webpage',$data);
			
	}

}