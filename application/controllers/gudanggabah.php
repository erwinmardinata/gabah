<?php
class Gudanggabah extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('modelgudanggabah');
	}
	
	public function cek_privileges() {
		$cek = $this->session->userdata('ada');
		if($cek == '') redirect('gudanggabah/login');
	}

	public function cek_privileges_superadmin() {
		$cek1 = $this->session->userdata('ada');
		$cek2 = $this->session->userdata('status');
		if($cek1 == 'yes' && $cek2 != 1) redirect('gudanggabah/index');
	}

	
	public function login() {
		$cek = $this->session->userdata('ada');
		if(!empty($cek)){
			redirect('gudanggabah/index');
		}	
		
		if($this->uri->segment(3) == 1)
			$data['info'] = "<div class='alert alert-danger alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<p align='center'>username atau password anda salah !<br> silakan coba lagi</p>
							</div>";
		else
		$data['info'] = '';
		
		$data['title'] = 'Login Admin';
		$this->load->view('header', $data);
		$this->load->view('content_login', $data);
		$this->load->view('footer');		
	}

	public function prosesLogin() {
		$user = $this->input->post('username');
		$pass = $this->input->post('password');
		$cek = $this->modelgudanggabah->login('tbl_admin', $user, $pass)->row();
		
		if(count($cek) > 0) {
			$data['ada'] = 'yes';
			$data['id'] = $cek->id;
			$data['nama'] = $cek->nama;
			$data['username'] = $cek->username;
			$data['status'] = $cek->status;
			$this->session->set_userdata($data);
			redirect('gudanggabah/index');
		} else {
			redirect('gudanggabah/login/1');
		}		
	}

	public function logout() {
		$data['ada'] = '';
		$data['id'] = '';
		$data['nama'] = '';
		$data['username'] = '';
		$data['status'] = '';
		$this->session->unset_userdata($data);
		redirect('gudanggabah/login');
	}
	
	
	public function index() {
		$this->cek_privileges();
		
		$data['menu'] = 'a';
		
		$this->load->view('header');
		$this->load->view('menu', $data);
		$this->load->view('content');
		$this->load->view('footer');
	}

	public function dataRekening() {
		$this->cek_privileges_superadmin();
		
		if($this->uri->segment(3) == 1) {
			$data['info'] = "<div class='alert alert-info alert-dismissable'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
					<p align='center'>Berhasil Update Data</p>
					</div>";
		} else if($this->uri->segment(3) == 2) {
			$data['info'] = "<div class='alert alert-danger alert-dismissable'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
					<p align='center'>Gagal Update Data</p>
					</div>";

		} else {
			$data['info'] = '';
		}

		$data['query'] = $this->modelgudanggabah->getData('tbl_rekening', 'id', 'DESC')->result();
		$data['menu'] = 'b';
		
		$this->load->view('header');
		$this->load->view('menu', $data);
		$this->load->view('content_operasional', $data);
		$this->load->view('footer');

	}

	public function tambahRekening() {
		$cek = $this->modelgudanggabah->getData('tbl_rekening', 'id', 'DESC')->row();

		if(empty($cek)) {
			$noNew = '00001';
		} else {
			$noOld = (int) $cek->kode;
			$noOld++;
			$noNew = sprintf('%05s', $noOld);
		}

		$data = array(
			'aksi' => 'tambah',
			'induk' => $this->modelgudanggabah->getData('tbl_rekening_induk', 'id', 'ASC')->result(),
			'kode' => $noNew,
			'nama' => ''
		);

		$this->load->view('content_update_operasional', $data);
	}

	public function editRekening() {
		$kode = $this->input->post('kode');
		$cek = $this->modelgudanggabah->getDataWhere('tbl_rekening', 'kode', $kode)->row();

		$data = array(
			'aksi' => 'edit',
			'induk' => $this->modelgudanggabah->getData('tbl_rekening_induk', 'id', 'ASC')->result(),
			'kode' => $kode,
			'nama' => $cek->nama
		);
		$this->load->view('content_update_operasional', $data);
	}

	public function prosesUpdateRekening() {
		$aksi = $this->input->post('aksi');
		$kode = $this->input->post('kode');
		$status = $this->input->post('lr');

		$data = array(
			'id_rek_induk' => $this->input->post('induk'),
			'kode' => $this->input->post('kode'),
			'nama' => $this->input->post('nama'),
			'status' => $status
		);
		
		if($status == 5 || $status == 4) {
			$type = array(
				'status' => $status,
				'kode' => $kode,
				'nama' => $this->input->post('nama')
			);
		} else if($status == 3 || $status == 2 || $status == 1){
			$type = array(
				'status' => $status,
				'kode' => $kode,
				'nama' => $this->input->post('nama')
			);
		}


		if($aksi == 'tambah') {		
			if($status == 5 || $status == 4) {
				$this->modelgudanggabah->insertData('tbl_neraca', $type);
			} else if($status == 3 || $status == 2 || $status == 1){
				$this->modelgudanggabah->insertData('tbl_laba_rugi', $type);
			}

			$query = $this->modelgudanggabah->insertData('tbl_rekening', $data);
		} else if($aksi == 'edit') {
			if($status == 5 || $status == 4) {
				$this->modelgudanggabah->EditData('tbl_neraca', 'kode', $kode, $type);
			} else if($status == 3 || $status == 2 || $status == 1){
				$this->modelgudanggabah->EditData('tbl_laba_rugi', 'kode', $kode, $type);
			}

			$query = $this->modelgudanggabah->EditData('tbl_rekening', 'kode', $kode, $data);
		}
		
		if($query) {
			redirect('gudanggabah/dataRekening/1');
		} else {
			redirect('gudanggabah/dataRekening/2');
		}
	}

	public function deleteRekening($kode) {
		$query = $this->modelgudanggabah->deleteData('tbl_rekening', 'kode', $kode);

		if($query) {
			$this->modelgudanggabah->deleteData('tbl_neraca', 'kode', $kode);
			$this->modelgudanggabah->deleteData('tbl_laba_rugi', 'kode', $kode);
			redirect('gudanggabah/dataRekening/1');
		} else {
			redirect('gudanggabah/dataRekening/2');
		}
	}

	public function saldoAwal() {
		$this->cek_privileges_superadmin();

		$periode = $this->uri->segment(4);
		
		if($periode == null) {
			$data['query'] = $this->modelgudanggabah->getSaldoAwal()->result();
		} else {
			$data['query'] = $this->modelgudanggabah->getSaldoAwalWhere($periode)->result();			
		}
		$data['menu'] = 'c';
		
		$this->load->view('header');
		$this->load->view('menu', $data);
	 	$this->load->view('content_saldo_awal', $data);
		$this->load->view('footer');		
	}
	
	public function inputSaldoAwal() {
		$data = array(
			'menu' => 'c',
			'aksi' => 'tambah',
			'id' => '',
			'periode' => '',
			'nama' => '',
			'kode' => '',
			'nomor' => $this->modelgudanggabah->getData('tbl_rekening', 'id', 'ASC')->result()
		);
		
		$this->load->view('header');
		$this->load->view('menu', $data);
		$this->load->view('content_input_data', $data);
		$this->load->view('footer');
	}

		public function updateSaldoAwal($id) {
		$cek = $this->modelgudanggabah->getDataWhere('tbl_saldo_awal', 'id', $id)->row();
		
		$data = array(
			'menu' => 'c',
			'aksi' => 'edit',
			'id' => $cek->id,
			'periode' => $cek->periode,
			'nama' => $cek->kode,
			'kode' => $cek->kode,
			'nomor' => $this->modelgudanggabah->getData('tbl_rekening', 'id', 'ASC')->result()
		);
		
		$this->load->view('header');
		$this->load->view('menu', $data);
		$this->load->view('content_input_data', $data);
		$this->load->view('footer');
	}

	
	public function getKodeRekening() {
		$kode = $this->input->post('kode');
		
		$data = $this->modelgudanggabah->getDataWhere('tbl_rekening', 'kode', $kode)->row();
		echo "<option value=".$data->kode.">".$data->kode."</option>";
	}

	public function prosesSaldoAwal() {
		//mengubah string ke numeric
		$a = str_replace(',', '', $this->input->post('nominal')) ;
		$b = str_replace('.00', '', $a) ;
		
		$aksi = $this->input->post('submit');
		$submit = $this->input->post('aksi');
		$id = $this->input->post('id');

		if($aksi == 'tambah') {
			$tambah = $b;
			$kurang = 0;
			$saldo = $tambah;
		} else if($aksi == 'kurang') {
			$tambah = 0;
			$kurang = $b;		
			$saldo = '-'.$kurang;
		} else {
			redirect('gudanggabah/index');
		}

		$data = array(
				'periode' => $this->input->post('periode'),
				'kode' => $this->input->post('kode'),
				'bertambah' => $tambah,
				'berkurang' => $kurang,
				'saldo' => $saldo
			);
		
		if($submit == 'tambah') {
			$query  = $this->modelgudanggabah->insertData('tbl_saldo_awal', $data);	
		} else if($submit == 'edit') {
			$query  = $this->modelgudanggabah->editData('tbl_saldo_awal', 'id', $id, $data);	
		}
		
		if($query) {
			redirect('gudanggabah/saldoAwal/1');
		} else {
			redirect('gudanggabah/saldoAwal/2');
		}
	}
	
	public function hapusSaldoAwal($id) {
		$query = $this->modelgudanggabah->deleteData('tbl_saldo_awal', 'id', $id);

		if($query) {
			redirect('gudanggabah/saldoAwal/1');
		} else {
			redirect('gudanggabah/saldoAwal/2');
		}
	}
	
	public function jurnal() {
		$this->cek_privileges();
		$data['menu'] = 'd';
		
		$tgl1 = $this->uri->segment(3);
		$tgl2 = $this->uri->segment(4);
		
		if($tgl1 == null && $tgl2 == null) {
			$data['query'] = $this->modelgudanggabah->getJurnal()->result();
		} else {
			$data['query'] = $this->modelgudanggabah->getJurnalFilter($tgl1, $tgl2)->result();
		}
		
		$this->load->view('header');
		$this->load->view('menu', $data);
		$this->load->view('content_data_jurnal', $data);
		$this->load->view('footer');		

	}
	
	public function inputJurnal() {
		$this->cek_privileges();
		$data = array(
			'nomor' => $this->modelgudanggabah->getData('tbl_rekening', 'id', 'ASC')->result(),
			'menu' => 'd',
			'id' => '',
			'aksi' => 'tambah',
			'tgl' => '',
			'bln' => '',
			'thn' => '',
			'nomor_bukti' => '',
			'keterangan' => '',
			'nama' => '',
			'kode' => '',
			'nominal' => ''
		);
				
		$this->load->view('header');
		$this->load->view('menu', $data);
		$this->load->view('content_jurnal', $data);
		$this->load->view('footer');
	}
	
	public function updateJurnal($id) {
		$this->cek_privileges();
		$cek = $this->modelgudanggabah->getDataWhere('tbl_jurnal', 'id', $id)->row();
		$date = $cek->tanggal;
		
		$thn = substr($date, 0, 4);
		$bln = substr($date, 5, 7);
		$tgl = substr($date, 8, 10);
		
		$data = array(
			'nomor' => $this->modelgudanggabah->getData('tbl_rekening', 'id', 'ASC')->result(),
			'menu' => 'd',
			'id' => $cek->id,
			'aksi' => 'edit',
			'tgl' => $tgl,
			'bln' => $bln,
			'thn' => $thn,
			'nomor_bukti' => $cek->nomor_bukti,
			'keterangan' => $cek->keterangan,
			'nama' => $cek->kode,
			'kode' => $cek->kode,
			'nominal' => ''
		);
				
		$this->load->view('header');
		$this->load->view('menu', $data);
		$this->load->view('content_jurnal', $data);
		$this->load->view('footer');
	}

	
	public function prosesInputJurnal() {
		//mengubah string ke numeric
		$a = str_replace(',', '', $this->input->post('nominal')) ;
		$b = str_replace('.00', '', $a) ;

		$aksi = $this->input->post('submit');
		$id = $this->input->post('id');
		$proses = $this->input->post('aksi');
		$cek1 = $this->modelgudanggabah->getDataWhere('tbl_rekening', 'kode', $this->input->post('kode'))->row();
		$cek2 = $this->modelgudanggabah->getDataWhere('tbl_neraca', 'kode', $this->input->post('kode'))->row();
		$cek3 = $this->modelgudanggabah->getDataWhere('tbl_laba_rugi', 'kode', $this->input->post('kode'))->row();

		if($aksi == 'tambah') {
			$tambah = $b;
			$kurang = 0;
			$saldo = $tambah;
		} else if($aksi == 'kurang') {
			$tambah = 0;
			$kurang = $b;	
			$saldo = '-'.$kurang;
		} else {
			redirect('gudanggabah/index');
		}
		
		if($proses == 'tambah') {
			if($cek1->id_rek_induk == 1) {
				$tabel = 'tbl_neraca';
				if($cek2->status ==  5) {
					$total = $cek2->saldo_aset;
					$total = $total + $saldo;
					$total2 = 0;
				} else if($cek2->status == 4) {
					$total2 = $cek2->saldo_aset;
					$total2 = $total + $saldo;
					$total = 0;
				}
				$nilai = array(
					'saldo_aset' => $total,
					'saldo_kewajiban' => $total2,
					'berubah' => $tambah 
				);
			} else if($cek1->id_rek_induk == 2) {
				$tabel = 'tbl_laba_rugi';
				if($cek3->status ==  3) {
					$total1 = $cek3->penjualan;
					$total1 = $total + $saldo;
					$total2 = 0;
					$total3 = 0;
				} else if($cek3->status == 2) {
					$total2 = $cek3->hpp;
					$total2 = $total + $saldo;
					$total1 = 0;
					$tota3 = 0;
				} else if($cek3->status == 1) {
					$total3 = $cek3->biaya;
					$total3 = $total + $saldo;
					$total1 = 0;
					$total2 = 0;
				}
				$nilai = array(
					'penjualan' => $total1,
					'hpp' => $total2,
					'biaya' => $total3,
					'berubah' => $tambah
				);
			}			
		} else if($proses == 'edit') {
			if($cek1->id_rek_induk == 1) {
				$tabel = 'tbl_neraca';
				if($cek2->status ==  5) {
					$total = $cek2->saldo_aset - $cek2->berubah;
					$total = $total + $saldo;
					$total2 = 0;
				} else if($cek2->status == 4) {
					$total2 = $cek2->saldo_aset - $cek2->berubah;
					$total2 = $total + $saldo;
					$total = 0;
				}
				$nilai = array(
					'saldo_aset' => $total,
					'saldo_kewajiban' => $total2, 
					'berubah' => $tambah 
				);
			} else if($cek1->id_rek_induk == 2) {
				$tabel = 'tbl_laba_rugi';
				if($cek3->status ==  3) {
					$total1 = $cek3->penjualan - $cek3->berubah;
					$total1 = $total + $saldo;
					$total2 = 0;
					$total3 = 0;
				} else if($cek3->status == 2) {
					$total2 = $$cek3->hpp - $cek3->berubah;
					$total2 = $total + $saldo;
					$total1 = 0;
					$tota3 = 0;
				} else if($cek3->status == 1) {
					$total3 = $$cek3->biaya - $cek3->berubah;
					$total3 = $total + $saldo;
					$total1 = 0;
					$total2 = 0;
				}
				$nilai = array(
					'penjualan' => $total1,
					'hpp' => $total2,
					'biaya' => $total3,
					'berubah' => $tambah
				);
			}			
		}
		
		$data = array(
			'periode' => 2016,
			'kode' => $this->input->post('kode'),
			'tanggal' => date($this->input->post('thn').'-'.$this->input->post('bln').'-'.$this->input->post('tgl')),
			'nomor_bukti' => $this->input->post('nomor_bukti'),
			'keterangan' => $this->input->post('keterangan'),
			'bertambah' => $tambah,
			'berkurang' => $kurang
		);
				
		if($proses == 'tambah') {
			$query  = $this->modelgudanggabah->insertData('tbl_jurnal', $data);
		} else if($proses == 'edit') {
			$query  = $this->modelgudanggabah->editData('tbl_jurnal', 'kode', $this->input->post('kode'), $data);			
		}
						
		
		if($query) {
			$this->modelgudanggabah->EditData($tabel, 'kode', $this->input->post('kode'), $nilai);	
			redirect('gudanggabah/jurnal/1');
		} else {
			redirect('gudanggabah/jurnal/2');
		}		
	}
	
	public function hapusJurnal($kode) {
		$cek = $this->modelgudanggabah->getDataWhere('tbl_neraca', 'kode', $kode)->row();
		if(empty($cek->status)) {
			$tabel = 'tbl_laba_rugi';
			$data = array(
				'penjualan' => 0,
				'hpp' => 0,
				'biaya' => 0,
				'berubah' => 0
			);
		} else {
			$tabel = 'tbl_neraca';
			$data = array(
				'saldo_aset' => 0,
				'saldo_kewajiban' => 0,
				'berubah' => 0
			);
		}
		$this->modelgudanggabah->editData($tabel, 'kode', $kode, $data);		
		$query = $this->modelgudanggabah->deleteData('tbl_jurnal', 'kode', $kode);
		
		if($query) {
			redirect('gudanggabah/jurnal/1');			
		} else {
			redirect('gudanggabah/jurnal/2');
		}
	}
	
	public function bukuBesar() {
		$this->cek_privileges();
		$url3 = $this->uri->segment(3);
		$url4 = $this->uri->segment(4);
		$url5 = $this->uri->segment(5);
		$data['rekening'] = $this->modelgudanggabah->getData('tbl_rekening', 'id', 'ASC')->result();
		$data['menu'] = 'e';

		$this->load->view('header');
		$this->load->view('menu', $data);
		$this->load->view('content_buku_besar', $data);
		
		if(!empty($url3)){
			$data['saldo'] = $this->modelgudanggabah->getSaldo($url3, $url5)->row();
			$data['query'] = $this->modelgudanggabah->getBukuBesar($url5, $url4)->result();

			$this->load->view('content_get_buku_besar', $data);
			
		}
		
		$this->load->view('footer');		

	}


	public function neraca() {
		$this->cek_privileges();
		$data['title'] = 'Neraca';
		$data['menu'] = 'f';

		$data['query'] = $this->modelgudanggabah->getData('tbl_neraca', 'id', 'ASC')->result();			
		$data['labarugi'] = $this->modelgudanggabah->getData('tbl_laba_rugi', 'id', 'ASC')->result();		
		
		$this->load->view('header');
		$this->load->view('menu', $data);
		$this->load->view('content_neraca', $data);
		$this->load->view('footer');

	}
	
	public function labaRugi() {		
		$this->cek_privileges();
		$data['title'] = 'Laba Rugi';
		$data['menu'] = 'g';

		$data['query'] = $this->modelgudanggabah->getData('tbl_laba_rugi', 'id', 'ASC')->result();			
		
		$this->load->view('header');
		$this->load->view('menu', $data);
		$this->load->view('content_laba_rugi', $data);
		$this->load->view('footer');
	}
	
	public function setting() {
		$this->cek_privileges();
		if($this->uri->segment(3) == 1) {
			$data['info'] = "<div class='alert alert-info alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<p align='center'>berhasil ganti Password !</p>
							</div>";
		} else if($this->uri->segment(3) == 2) {
			$data['info'] = "<div class='alert alert-danger alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<p align='center'>gagal ganti Password !<br> silakan coba lagi</p>
							</div>";
		} else {
			$data['info'] = "";
		}
		$data['menu'] = '';
		
		$this->load->view('header');
		$this->load->view('menu', $data);
		$this->load->view('content_setting');
		$this->load->view('footer');		
	}
	
	public function prosesGantiPassword() {
		$p = $this->input->post('password');
		$p1 = $this->input->post('password1');
		$p2 = $this->input->post('password2');
		
		$cek = $this->modelgudanggabah->getDataWhere('tbl_admin', 'id', $this->session->userdata('id'))->row();
		
		if($cek->password != $p || $p1 != $p2) {
			redirect('gudanggabah/setting/2');
		}
		$data = array(
			'password' => $p1
		);
		$query = $this->modelgudanggabah->editData('tbl_admin', 'id', $this->session->userdata('id'), $data);
		if($query) {
			redirect('gudanggabah/setting/1');
		} else {
			redirect('gudanggabah/setting/2');
		}
	}

	public function export() {
		$this->load->library('fpdf');
		$pdf = new PDF(‘P’,’cm’,’A4′);
		$pdf->Open();
		$pdf->AddPage();

		//Ln() = untuk pindah baris
		$pdf->Ln();
		$pdf->SetFont(‘Times’,’B’,12);

		$pdf->Cell(1,1,’No’,’LRTB’,0,’C’);
		$pdf->Cell(3,1,’Nama’,’LRTB’,0,’C’);
		$pdf->Cell(4,1,’Alamat’,’LRTB’,0,’C’);
		$pdf->Cell(5,1,’Telepon’,’LRTB’,0,’C’);
		$pdf->Cell(6,1,’Jabatan’,’LRTB’,0,’C’);
		$pdf->Ln();

		$pdf->SetFont(‘Times’,”,10);
		for($j=0;$j<$i;$j++)
		{
		//menampilkan data dari hasil query database
		$pdf->Cell(1,1,$j+1,’LBTR’,0,’C’);
		$pdf->Cell(3,1,$cell[$j][0],’LBTR’,0,’C’);
		$pdf->Cell(4,1,$cell[$j][1],’LBTR’,0,’C’);
		$pdf->Cell(5,1,$cell[$j][2],’LBTR’,0,’C’);
		$pdf->Cell(6,1,$cell[$j][3],’LBTR’,0,’C’);
		$pdf->Ln();
		}

		//menampilkan output berupa halaman PDF
		$pdf->Output();
	}

}
?>
