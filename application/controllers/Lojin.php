<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Lojin extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->model('mlojin');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$sesi = $this->session->userdata('ok_deh');
		if( !isset($sesi) ){
			
			$kesempatan = $this->mlojin->cek_kesempatan();
			if ($kesempatan<>'0') {
				
				if($this->input->post('submit')){
					$this->form_validation->set_rules('username', 'Username', 'trim|required');
					$this->form_validation->set_rules('password', 'Password', 'trim|required');

					if($this->form_validation->run() === FALSE) {
						$this->session->set_flashdata('pesan', '<div class="alert alert-warning alert-dismissable">
		                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

		                        Maaf, tidak boleh kosong. 

		                    	</div>');
						$kesempatan = $kesempatan - 1 ;
						$this->mlojin->kesempatan_berkurang_satu($kesempatan);

					} else {
						
						$u = $this->input->post('username');
						$u = addslashes($u);
						$p = $this->input->post('password');
						$x = md5(  md5($p) . '45' . md5($p) );

						$tgl = date('Y-m-d H:i:s');
						$ip = $this->input->ip_address();
						$tamu = gethostbyaddr($_SERVER['REMOTE_ADDR']);
						$browser = $this->input->user_agent();

						$ada_user = $this->mlojin->cek_user($u);

						if($ada_user==1){
							$cekmd5 = $this->mlojin->cek_md5($u,$x);
							if($cekmd5==1){
								
								$kesempatan = 3 ;
		                    	$this->mlojin->kesempatan_berkurang_satu($kesempatan);

		                    	$usersesi = array('user'=>$u, 'pass'=>$x);
								$this->session->set_userdata('ok_deh',$usersesi);

								$objek = array(
									'n'=>'',
									'tgl'=>$tgl,
									'ip'=>$ip,
									'nama_komputer'=>$tamu,
									'browser'=>$browser
									);
								$this->mlojin->save_log($objek);

								redirect(base_url('dasbon'));

							}else{
								$this->session->set_flashdata('pesan', '<div class="alert alert-warning alert-dismissable">
		                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

		                        Maaf, Akses masuk ditolak.

		                    	</div>');
		                    	$kesempatan = $kesempatan - 1 ;
		                    	$this->mlojin->kesempatan_berkurang_satu($kesempatan);
							}
						}else{
							$this->session->set_flashdata('pesan', '<div class="alert alert-warning alert-dismissable">
		                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

		                        Username Anda tidak dikenali.

		                    	</div>');
							$kesempatan = $kesempatan - 1 ;
							$this->mlojin->kesempatan_berkurang_satu($kesempatan);
						}
					}
				}
			}else{
				redirect(base_url());
			}
			
			$this->load->view('lojin');
			$this->session->set_flashdata('pesan', '');

			if ($kesempatan=='0') {
				redirect(base_url());
			}

		}else{
			redirect(base_url('dasbon'));
		}
	}


	public function logout()
	{
		#$this->session->unset_userdata('ok_deh',$u);
		$this->session->sess_destroy();

		$this->session->set_flashdata('pesan', '');
		redirect(base_url('lojin'));
	}

}