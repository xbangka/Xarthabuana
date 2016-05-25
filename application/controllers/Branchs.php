<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Branchs extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->model('mbranchs');
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
		$batas=5;
		$posisi = $p->cariPosisi($nomer,$batas);

		$data['sql'] = $this->mbranchs->data_cabang($posisi,$batas);
		
		$jmlrecord = $this->mbranchs->jmlHalaman();

		$jmlhalaman = $p->jumlahHalaman($jmlrecord,$batas);

		$data['linkHalaman'] = $p->navHalaman($nomer,$jmlhalaman,base_url('branchs'),'/page/');

		$data['posisi'] = $posisi;

		$this->load->view('admin/branchs',$data);
	}


	public function page($nomer='1')
	{
		if (!is_numeric($nomer)) {
			redirect('branchs');
		}
		$data['nomer'] = $nomer;
		$data['in_messages'] = $this->mgeneral->itemmesgs();

		$this->load->view('admin/pajinasi');
		$p = new Paging();
		$batas=5;
		$posisi = $p->cariPosisi($nomer,$batas);

		$data['sql'] = $this->mbranchs->data_cabang($posisi,$batas);
		
		$jmlrecord = $this->mbranchs->jmlHalaman();

		$jmlhalaman = $p->jumlahHalaman($jmlrecord,$batas);

		$data['linkHalaman'] = $p->navHalaman($nomer,$jmlhalaman,base_url('branchs'),'/page/');

		$data['posisi'] = $posisi;

		$this->load->view('admin/branchs',$data);
	}


	public function load_data_cabang()
	{	
		if($this->input->post('idx')){
			$x=$this->input->post('idx');
			$sql = $this->mbranchs->ambil_cabang($x);
			
			$rowa = $sql->row();
			//foreach($sql->result_array() as $rowa)
            //{ 
            	echo '


<input name="id" type="hidden" value="'.$rowa->n.'">

<table class="table table-striped">
  <tbody>
    
    <tr>
      <td width="110px">Kode Cabang</td>
      <td>
        <div style="width:70px">
          <input name="kodecab" type="text" class="form-control" value="'.$rowa->kode.'" onKeypress="return isNumber(event)">
        </div>
      </td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>

    <tr>
      <td>Nama Cabang</td>
      <td colspan="3">
        <input name="namacab" type="text" class="form-control" value="'.$rowa->namacabang.'">
      </td>
    </tr>

    <tr>
      <td>Alamat</td>
      <td colspan="3"><input name="alamat" type="text" class="form-control" value="'.$rowa->alamat.'"></td>
    </tr>

    <tr>
      <td>Tlp1</td>
      <td><input name="tlp1" type="text" class="form-control" value="'.$rowa->notlp1.'"></td>
      <td>Fax1</td>
      <td><input name="fax1" type="text" class="form-control" value="'.$rowa->fax1.'"></td>
    </tr>

    <tr>
      <td>Tlp2</td>
      <td><input name="tlp2" type="text" class="form-control" value="'.$rowa->notlp2.'"></td>
      <td>Fax2</td>
      <td><input name="fax2" type="text" class="form-control" value="'.$rowa->fax2.'"></td>
    </tr>

    <tr>
      <td>URL</td>
      <td colspan="3"><input name="urlcab" type="text" class="form-control" value="'.$rowa->url.'"></td>
    </tr>

    <tr>
      <td>Latitude</td>
      <td><input name="mapx" type="text" class="form-control" value="'.$rowa->mapx.'"></td>
      <td>Longitude</td>
      <td><input name="mapy" type="text" class="form-control" value="'.$rowa->mapy.'"></td>
    </tr>

  </tbody>
</table>


            	';
            //}
		}
		exit();
	}



	public function editcabang()
	{
		if($this->input->post('id')){
			$x 		=$this->input->post('id');
			$kodecab=$this->input->post('kodecab');
			$namacab=$this->input->post('namacab');
			$alamat =$this->input->post('alamat');
			$tlp1 	=$this->input->post('tlp1');
			$tlp2 	=$this->input->post('tlp2');
			$fax1 	=$this->input->post('fax1');
			$fax2 	=$this->input->post('fax2');
			$urlcab	=$this->input->post('urlcab');
			$mapx 	=$this->input->post('mapx');
			$mapy 	=$this->input->post('mapy');

			$objek = array(
				'kode'=>$kodecab,
				'namacabang'=>$namacab,
				'alamat'=>$alamat,
				'notlp1'=>$tlp1,
				'notlp2'=>$tlp2,
				'fax1'=>$fax1,
				'fax2'=>$fax2,
				'url'=>$urlcab,
				'mapx'=>$mapx,
				'mapy'=>$mapy
				);
			$this->mbranchs->update_cabang($x,$objek);
		}
		redirect( $_SERVER['HTTP_REFERER'] );
	}




	public function addcabang()
	{
		if($this->input->post('kodecab')){
			$kodecab=$this->input->post('kodecab');
			$namacab=$this->input->post('namacab');
			$alamat =$this->input->post('alamat');
			$tlp1 	=$this->input->post('tlp1');
			$tlp2 	=$this->input->post('tlp2');
			$fax1 	=$this->input->post('fax1');
			$fax2 	=$this->input->post('fax2');
			$urlcab	=$this->input->post('urlcab');
			$mapx 	=$this->input->post('mapx');
			$mapy 	=$this->input->post('mapy');

			$objek = array(
				'n'=>'',
				'kode'=>$kodecab,
				'namacabang'=>$namacab,
				'alamat'=>$alamat,
				'notlp1'=>$tlp1,
				'notlp2'=>$tlp2,
				'fax1'=>$fax1,
				'fax2'=>$fax2,
				'url'=>$urlcab,
				'mapx'=>$mapx,
				'mapy'=>$mapy
				);
			$this->mbranchs->save_cabang($objek);
		}
		redirect( $_SERVER['HTTP_REFERER'] );
	}




	public function deletecabang()
	{
		if($this->input->post('id')){
			$x=$this->input->post('id');
			$this->mbranchs->delete_cabang($x);
		}
		redirect( $_SERVER['HTTP_REFERER'] );
	}

}