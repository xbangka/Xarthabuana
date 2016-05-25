<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('dedi_helper');
		$this->load->model('mgeneral');

		$sesi = $this->session->userdata('ok_deh');
		if( !isset($sesi) ){ redirect(base_url()); }

		$menu_class = explode('/',$_SERVER['PHP_SELF']);
		$this->session->set_flashdata('menu_class', $menu_class[2]);
	}



	public function index()
	{
		$data['in_messages'] = $this->mgeneral->itemmesgs();
		$data['visitor'] = $this->mgeneral->itemvisitor();
		$data['logadmin'] = $this->mgeneral->itemlogadmin();
		$data['tbluser'] = $this->mgeneral->itemtbluser();
		$this->load->view('admin/settings',$data);
		$this->session->set_flashdata('pesan', '');
	}



	public function visitor()
	{	
		$data['in_messages'] = $this->mgeneral->itemmesgs();

		$tgl1 = date('Y-m-d 00:00:00');
		$tgl2 = date('Y-m-d H:i:s');
		$data['tgl_1'] = date('d/m/Y 00:00:00');
		$data['tgl_2'] = date('d/m/Y H:i:s');

		if( $this->input->post('tgl1') && $this->input->post('tgl2') ){
			$tanggal = $this->input->post('tgl1') ;
			$k = explode('/',substr($tanggal,0,10));
			$l = substr($tanggal,10,9);
			$tgl1 = $k[2] . '-' . $k[1] . '-' . $k[0] . ' ' . $l ;
			$data['tgl_1'] = $tanggal ;
			
			$tanggal2 = $this->input->post('tgl2') ;
			$k = explode('/',substr($tanggal2,0,10));
			$l = substr($tanggal2,10,9);
			$tgl2 = $k[2] . '-' . $k[1] . '-' . $k[0] . ' ' . $l ;
			$data['tgl_2'] = $tanggal2 ;
		}
		$data['visitor'] = $this->mgeneral->detailvisitor( $tgl1, $tgl2 );
		$data['jmlvisitor'] = $this->mgeneral->jmlvisitor( $tgl1, $tgl2 );
		
		$this->load->view('admin/visitor',$data);
	}



	public function logadmin()
	{
		$data['in_messages'] = $this->mgeneral->itemmesgs();
		$data['logadmin'] = $this->mgeneral->detaillogadmin();
		$this->load->view('admin/logadmin',$data);
	}


	public function cleardatalogadmin()
	{
		if( $this->input->post('pass') )
		{
			$b = $this->input->post('pass');
			$b = md5(  md5($b) . '45' . md5($b) );

			$sesi = $this->session->userdata('ok_deh');

			if( $b==$sesi['pass'] )
			{
				$this->mgeneral->cleardatalogadmin();
			}
		}
		
		redirect( $_SERVER['HTTP_REFERER'] );
	}


	public function ubahuser()
	{
		if( $this->input->post('pass1') ){
			$x=$this->input->post('id');
			$pass1 = $this->input->post('pass1') ;
			$a=$this->input->post('user');
			$b=$this->input->post('nama');
			$k=$this->input->post('surel');

			$m=$this->input->post('pass2');
			$n=$this->input->post('pass3');

			$sesi = $this->session->userdata('ok_deh');

			$z= md5(  md5($pass1) . '45' . md5($pass1) );
			if($sesi['pass']==$z){
				if(!filter_var($k, FILTER_VALIDATE_EMAIL)){
					$this->session->set_flashdata('pesan', '<br/><div class="alert alert-danger alert-dismissable">
		            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

		            Maaf, format surat elektronik Anda salah.

		        	</div>');
					
				}elseif(!empty($m) && $m!=$n){
					$this->session->set_flashdata('pesan', '<br/><div class="alert alert-danger alert-dismissable">
		            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

		            Maaf, Anda mengulangi kata sandi baru yang tidak sama.

		        	</div>');
					  
				}elseif($m!='' && $m==$n){
					$z= md5(  md5($m) . '45' . md5($m) );
					$objek = array('user'=>$a, 'sandi'=>$z, 'nama'=>$b, 'surel'=>$k);
					$this->mgeneral->ubahuser($x, $objek);
					
					$this->session->set_flashdata('pesan', '<br/><div class="alert alert-success alert-dismissable">
		            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

		            <strong>SUCCESS</strong>, perubahan data user telah Anda lakukan dan Anda menggunakan sandi baru.

		        	</div>');

					$usersesi = array('user'=>$a, 'pass'=>$z);
					$this->session->set_userdata('ok_deh',$usersesi);
					
				}else{
					$objek = array('user'=>$a, 'nama'=>$b, 'surel'=>$k);
					$this->mgeneral->ubahuser($x, $objek);

					$this->session->set_flashdata('pesan', '<br/><div class="alert alert-success alert-dismissable">
		            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

		            <strong>SUCCESS</strong>, perubahan data user telah Anda lakukan.

		        	</div>');					
				}
				
			}else{
				$this->session->set_flashdata('pesan', '<br/><div class="alert alert-danger alert-dismissable">
	            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

	            Maaf, kata sandi Anda untuk validasi salah.

	        	</div>');
			}
		}
		
		redirect( $_SERVER['HTTP_REFERER'] );
	}
}