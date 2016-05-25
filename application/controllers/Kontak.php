<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kontak extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mwebpage');
		$this->load->helper('dedi_helper');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('email');

		$sidebar1 = $this->mwebpage->ambilsidebar1();
		$sidebar2 = $this->mwebpage->ambilsidebar2();
		$this->session->set_flashdata('sidebar1', $sidebar1);
		$this->session->set_flashdata('sidebar2', $sidebar2);
	}

	public function index()
	{
		$sesi = $this->session->userdata('kontak');
		if( isset($sesi) ){
			$this->session->unset_userdata('kontak');
		}
		$fieldname = 'c' . md5(date('sdi')) ;
		$fieldvalue = md5(date('sHYdmi')) ;

		$usersesi = array('fieldname'=>$fieldname, 'fieldvalue'=>$fieldvalue);
		$this->session->set_userdata('kontak',$usersesi);

		$data['fieldname'] 	= $fieldname;
		$data['fieldvalue'] = $fieldvalue;

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
		
		$titlepage 	=  'Kontak | PT. Arthabuana Margausaha Finance';

		$metadesc = 'Kontak';
		$metakeys = 'Kontak';

		////////////////////////////////
		$data['banner'] 	= 'tidak' ;
		$data['sidebar'] 	= 'tidak' ;
		$data['mybody'] 	= 'kontak' ;
		///////////////////////////////
		$data['attrpage']	= array('judul'=>$titlepage, 'metadesc'=>$metadesc, 'metakeys'=>$metakeys);
		

		$this->load->view('webpage',$data);
	}


	public function simpanpesan()
	{
		if($this->input->post('submit')){
			$this->form_validation->set_rules('nama', 	'Nama', 	'trim|required|min_length[3]');
			$this->form_validation->set_rules('email', 	'Email', 	'trim|required|valid_email');
			$this->form_validation->set_rules('pesan', 	'Pesan', 	'required|min_length[5]');

			if($this->form_validation->run() === FALSE) {
				$this->session->set_flashdata('pesan', '<div class="alert alert-warning alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                        Maaf, tidak boleh kosong. 

                    	</div>');
				
				redirect('kontak') ;

			} else {
				
				$a = $this->input->post('nama');
				$a = addslashes($a);
				$b = $this->input->post('email');
				$b = addslashes($b);
				$d = $this->input->post('pesan');
				$d = addslashes($d);
				
				$sesi = $this->session->userdata('kontak');

				$w = $this->input->post( $sesi['fieldname'] );

				if( $w==$sesi['fieldvalue'] )
				{
					$tgl = date('Y-m-d H:i:s');
					$browsr = $this->input->user_agent();
					$ip = $this->input->ip_address();

					$objek = array(
						'n'=>'',
						'tgl'=>$tgl,
						'nama'=>$a,
						'surel'=>$b,
						'isi'=>$d,
						'ip'=>$ip,
						'browser'=>$browsr,
						'dibaca'=>'0'
						);
					$this->mwebpage->simpan_kontak($objek);

					$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                        SUCCESS, pesan Anda Terkirim. 

                    	</div>');

					$this->email->from($b, $a);
					$this->email->to('webmaster@arthabuana.co.id'); 
					$this->email->cc('it@arthabuana.co.id'); 
					$this->email->bcc('dyodedi@ymail.com'); 

					$this->email->subject($a . ' memberikan komentar di Arthabuana.co.id');
					$this->email->message( $d );	

					$this->email->send();
					
					redirect('kontak') ;
				}
				else
				{
					$this->session->set_flashdata('pesan', '<div class="alert alert-warning alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                        Maaf, gagal. 

                    	</div>');
					
					redirect('kontak') ;
				}
			}
		}
		else
		{	
			redirect('kontak') ;
		}
	}

}