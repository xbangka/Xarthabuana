<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web_page extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->model('mwebpage');
		$this->load->helper('dedi_helper');

		$sidebar1 = $this->mwebpage->ambilsidebar1();
		$sidebar2 = $this->mwebpage->ambilsidebar2();
		$this->session->set_flashdata('sidebar1', $sidebar1);
		$this->session->set_flashdata('sidebar2', $sidebar2);
	}


	public function index()
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

		$sql2= $this->mwebpage->view_cabang(); 
		$mcabang = '';
		$n = 0 ;
		foreach ($sql2->result_array() as $row)
		{	$n+=1;

			if($n==1){
				$mcabang 	= $mcabang . '<ul class="blue">';
			}

			$mcabang 	= $mcabang . '<li><a href="'.$row['url'].'">'.$row['namacabang'].'</a></li>';

			if($n==7){
				$mcabang 	= $mcabang . '</ul>';
				$n=0;
			}


		}

		$titlepage 	= 'PT.Arthabuana Margausaha Finance';
		$metadesc 	= 'PT.Arthabuana Margausaha Finance';
		$metakeys 	= 'keyword keyword keyword keyword';


		$data['attrpage']	= array('judul'=>$titlepage, 'metadesc'=>$metadesc, 'metakeys'=>$metakeys);
		$data['menu_dedi'] 	= $menu_dedi;
		$data['cabang'] 	= $mcabang;

		$data['sqlsidebar'] = $this->mwebpage->sidebaronhome();

		////////////////////////////////
		$data['banner'] 	= 'tampil' ;
		$data['sidebar'] 	= 'tidak' ;
		$data['mybody'] 	= 'a_home' ;
		///////////////////////////////

		$this->load->view('webpage',$data);
	}


}