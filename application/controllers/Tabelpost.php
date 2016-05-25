<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Tabelpost extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->model('mtabelpost');
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

		$data['sql'] = $this->mtabelpost->data_postingan($posisi,$batas);
		
		$jmlrecord = $this->mtabelpost->jmlHalaman();

		$jmlhalaman = $p->jumlahHalaman($jmlrecord,$batas);

		$data['linkHalaman'] = $p->navHalaman($nomer,$jmlhalaman,base_url('tabelpost'),'/page/');

		$data['posisi'] = $posisi;

		$this->load->view('admin/tabelpost',$data);
	}

	public function page($nomer='1')
	{
		if (!is_numeric($nomer)) {
			redirect('tabelpost');
		}
		$data2['nomer'] = $nomer;

		$data2['in_messages'] = $this->mgeneral->itemmesgs();
		
		$this->load->view('admin/pajinasi');

		$p = new Paging();
		$batas=5;
		$posisi = $p->cariPosisi($nomer,$batas);

		
		$data2['sql'] = $this->mtabelpost->data_postingan($posisi,$batas);

		$jmlrecord = $this->mtabelpost->jmlHalaman();

		$jmlhalaman = $p->jumlahHalaman($jmlrecord,$batas);

		$data2['linkHalaman'] = $p->navHalaman($nomer,$jmlhalaman,base_url('tabelpost'),'/page/');

		$data2['posisi'] = $posisi;

		$this->load->view('admin/tabelpost',$data2);
	}

	public function newpost()
	{
		$data['in_messages'] = $this->mgeneral->itemmesgs();
		$data['titlepanel'] = 'New Post';
		$data['id'] = 'New';
		$data['tgl'] = date('d/m/Y');
		$data['jam'] = '';
		$data['judul'] = '';
		$data['alias'] = '';
		$data['isi'] = '';
		$data['tampil'] = '';
		$data['kategori'] = '';

		$data['sql'] = $this->mtabelpost->data_kategori();

		$this->load->view('admin/tiny_mce');
		$this->load->view('admin/newpost',$data);
	}


	public function editpost($idx='')
	{
		
		if($idx=='')
		{
			redirect(base_url('tabelpost'));
		}

		$jalan = '';
		$q = $this->mtabelpost->data_post_edit($idx);
		foreach ($q->result_array() as $row2)
		{
			$jalan = '1';
			$data['titlepanel'] = 'Edit Post : ' . $row2['judul'];
			$data['id'] = $idx;
			$k = explode('-',substr($row2['tgl'],0,10) );
			$tgl = $k[2].'/'.$k[1].'/'.$k[0];
			$data['tgl'] = $tgl;
			$data['jam'] = substr($row2['tgl'],11,8);
			$data['judul'] = $row2['judul'];
			$data['alias'] = $row2['alias'];
			$data['isi'] = $row2['isi'];
			$data['tampil'] = $row2['tampil'];
			$data['kategori'] = $row2['cat_id'];

			$data['sql'] = $this->mtabelpost->data_kategori();

			$data['in_messages'] = $this->mgeneral->itemmesgs();

			$this->load->view('admin/tiny_mce');
			$this->load->view('admin/newpost',$data);
		}
		if($jalan==''){ redirect(base_url('tabelpost')); }
	}

	public function simpan()
	{
		
		if($this->input->post('judul')!='' && $this->input->post('tgl')!='' && $this->input->post('jam')!=''){
						
			$a = $this->input->post('judul');
			$b = $this->input->post('alias');
			if($b==''){
				$b = judul_seo($a);
			}else{ $b = judul_seo($b); }
			$c = $this->input->post('kate');
			$d = $this->input->post('status');
			$k = explode('/',$this->input->post('tgl'));
			$tgl = $k[2].'-'.$k[1].'-'.$k[0].' '.$this->input->post('jam');
			
			$g = $this->input->post('isi');
			$x = $this->input->post('id');
			
			if($x=='New'){
				
				$objek = array(
					'n'=>'',
					'user'=>'1',
					'cat_id'=>$c,
					'tgl'=>$tgl,
					'judul'=>$a,
					'alias'=>$b,
					'isi'=>$g,
					'cover'=>'',
					'hit'=>'0',
					'tampil'=>$d
					);
				$this->mtabelpost->simpan_data($objek);
					
			
			}else{
				
				$objek = array(
					'user'=>'1',
					'cat_id'=>$c,
					'tgl'=>$tgl,
					'judul'=>$a,
					'alias'=>$b,
					'isi'=>$g,
					'cover'=>'',
					'tampil'=>$d
					);

				$hasil = $this->mtabelpost->update_data($x, $objek);

				if($hasil=='berhasil')
				{
					redirect(base_url('tabelpost'));
				}
				else
				{
					redirect(base_url('tabelpost/editpost/' . $x));
				}

			}
		}

		redirect(base_url('tabelpost'));
	}

	public function showhideme()
	{

		if($this->input->post('nm'))
		{
			$a = $this->input->post('nm');
			$hasil = $this->mtabelpost->update_showhide($a);
		}
		
		redirect( $_SERVER['HTTP_REFERER'] );
	}

	public function deletepost()
	{
		if( $this->input->post('nm') )
		{
			$a = $this->input->post('nm');
			$b = $this->input->post('pass');
			$b = md5(  md5($b) . '45' . md5($b) );

			$sesi = $this->session->userdata('ok_deh');

			if( $b==$sesi['pass'] )
			{
				$this->mtabelpost->delete_data($a);
			}
		}
		
		redirect( $_SERVER['HTTP_REFERER'] );
	}




	////////////// sidebar /////////////////

	public function sidebar($idx='')
	{
		$maxwidth = '';
		if($idx=='onhome')
		{
			$maxwidth = 'xxx';
			$data['sql'] = $this->mtabelpost->data_sidebar_onhome();
			$data['in_messages'] = $this->mgeneral->itemmesgs();
			$this->load->view('admin/sedebaronhome',$data);
		}
		else
		{
			$q = $this->mtabelpost->data_sidebar($idx);
			foreach ($q->result_array() as $row2)
			{
				if($idx==1)
				{
					$maxwidth = 'Max Width 300px';
					$backgroun= 'style="background:#FCE3E3;"' ;
				}
				else
				{
					$maxwidth = 'Max Width 200px';
					$backgroun= 'style="background:#F1F8AA;"' ;
				}
				$data['maxwidth'] = $maxwidth ;
				$data['background'] = $backgroun ;
				$data['titlepanel'] = 'Edit Sidebar ' . $idx;
				$data['id'] = $idx;
				$data['isi'] = $row2['text'];
				$data['in_messages'] = $this->mgeneral->itemmesgs();
				$this->load->view('admin/tiny_mce');
				$this->load->view('admin/editsidebar',$data);
			}
			
		}

		if($maxwidth==''){ redirect(base_url('tabelpost')); }
			
	}




	public function simpansidebar()
	{
		if($this->input->post('sidebarid')!=''){
			$a = $this->input->post('sidebarid');
			$b = $this->input->post('isi');
			$hasil = $this->mtabelpost->update_data_sidebarid($a, $b);
			
			if($hasil=='berhasil')
			{
				$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissable">
	            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

	            SUCCESS, text sidebar berhasil di update.

	        	</div>');
			}
			else
			{
				$this->session->set_flashdata('pesan', '<div class="alert alert-warning alert-dismissable">
	            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

	            Maaf, gagal melakukan perubahan.

	        	</div>');
			}

		}

		redirect(base_url('tabelpost/sidebar/' . $a));
	}


	public function loadsidebaronhome()
	{
		if($this->input->post('idx'))
		{
			$x = $this->input->post('idx') ;
			$sql = $this->mtabelpost->loadsidebaronhome($x);
	        $n=0;
	        foreach ($sql->result_array() as $row)
	        { 
	        echo '
              <table class="table table-striped">
                <tbody>
                  <tr>
                    <td>Title</td>
                    <td width="1px">:</td>
                    <td><input name="judul" type="text" class="form-control" value="'.$row['judul'].'"></td>
                  </tr>
                  
                  <tr>
                    <td>Deskripsi</td>
                    <td width="1px">:</td>
                    <td><textarea name="deskripsi" class="form-control" rows="3">'.$row['deskripsi'].'</textarea></td>
                  </tr>

                  <tr>
                    <td>Icon font-awesome</td>
                    <td width="1px">:</td>
                    <td><input name="ikon" type="text" class="form-control" value="'.$row['icon'].'"></td>
                  </tr>
                </tbody>
              </table>
	          ';
	          exit();
	        }
		}
	
	}


	public function savesidebaronhome()
	{
		if($this->input->post('id')!=''){
			$x = $this->input->post('id');
			$a = $this->input->post('judul');
			$b = $this->input->post('deskripsi');
			$c = $this->input->post('ikon');
			$objek = array('judul'=>$a, 'deskripsi'=>$b, 'icon'=>$c,);
			$hasil = $this->mtabelpost->savesidebaronhome($x, $objek);
		}

		redirect( $_SERVER['HTTP_REFERER'] );
	}

}