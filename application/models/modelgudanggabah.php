<?php 
class Modelgudanggabah extends CI_Model {
	public function login($table, $username, $password) {
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		return $this->db->get($table);
	}
	
	public function getData($table, $key, $value) {
		$this->db->order_by($key, $value);
		return $this->db->get($table);
	}
	
	public function insertData($table, $data) {
		return $this->db->insert($table, $data);
	}
	
	public function editData($table, $key, $value, $data) {
		$this->db->where($key, $value);
		return $this->db->update($table, $data);
	}
	
	public function getDataWhere($table, $key, $value) {
		$this->db->where($key, $value);
		return $this->db->get($table);		
	}
	
	public function deleteData($table, $key, $value) {
		$this->db->where($key, $value);
		return $this->db->delete($table);
	}
	
	public function getSaldoAwal() {
		$query = "SELECT tbl_saldo_awal.id, tbl_saldo_awal.kode, tbl_rekening.nama, 
				  tbl_saldo_awal.saldo FROM tbl_saldo_awal, tbl_rekening 
				  where tbl_saldo_awal.kode = tbl_rekening.kode";
		return $this->db->query($query);
	}

	public function getSaldoAwalWhere($periode) {
		$query = "SELECT tbl_saldo_awal.id, tbl_saldo_awal.kode, tbl_rekening.nama, 
				  tbl_saldo_awal.saldo FROM tbl_saldo_awal, tbl_rekening 
				  where tbl_saldo_awal.kode = tbl_rekening.kode and tbl_saldo_awal.periode = '$periode'";
		return $this->db->query($query);
	}
	
	public function getJurnal() {
		$query = "SELECT tbl_jurnal.id, tbl_jurnal.tanggal, 
				  tbl_jurnal.nomor_bukti, tbl_jurnal.kode,
				  tbl_rekening.nama, tbl_jurnal.bertambah, tbl_jurnal.berkurang
				  FROM tbl_jurnal, tbl_rekening
				  WHERE tbl_jurnal.kode = tbl_rekening.kode";
		return $this->db->query($query);
	}
	
	public function getJurnalFilter($tgl1, $tgl2) {
		$query = "SELECT tbl_jurnal.id, tbl_jurnal.tanggal, 
				  tbl_jurnal.nomor_bukti, tbl_jurnal.kode,
				  tbl_rekening.nama, tbl_jurnal.bertambah, tbl_jurnal.berkurang
				  FROM tbl_jurnal, tbl_rekening
				  WHERE tbl_jurnal.kode = tbl_rekening.kode
				  AND tbl_jurnal.tanggal >= '$tgl1' AND tbl_jurnal.tanggal <= '$tgl2'";
		return $this->db->query($query);
	}
	
	public function getBukuBesar($kode, $bln) {
		$query = "SELECT * FROM tbl_jurnal JOIN tbl_rekening 
				  ON tbl_jurnal.kode = tbl_rekening.kode 
				  WHERE tbl_jurnal.kode = $kode 
				  AND DATE_FORMAT(tbl_jurnal.tanggal,'%m')=$bln";
		return $this->db->query($query);		
	}
	
	public function getSaldo($thn, $kode) {
		$query = "SELECT * FROM tbl_saldo_awal
				  WHERE periode = $thn and kode = $kode";
		return $this->db->query($query);
	}
}

?>