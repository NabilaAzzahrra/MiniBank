<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Models extends CI_Model
{

	public function Get_All($table, $select)
	{
		$select;
		$query = $this->db->get($table);
		return $query->result();
	}
	public function	 view($table)
	{
		return	$this->db->get($table);
	}

	function Save($data, $table)
	{
		$result = $this->db->insert($table, $data);
		return $result;
	}
	public function Get_Where($where, $table)
	{
		$query = $this->db->get_where($table, $where);
		return $query->result();
	}
	function Get_Page($limit, $start, $table)
	{
		$query = $this->db->get($table, $limit, $start);
		return $query;
	}
	function Update($where, $data, $table)
	{
		$this->db->update($table, $data, $where);
		return $this->db->affected_rows();
	}

	function update_multiple()
	{
		$updates = $this->input->post('nim');

		foreach ($updates as $update) {
			$data = array(
				'id_kelas' => $this->input->post('kelas'),
			);
			$this->db->where('nim', $update);
			$this->db->update('tbl_peserta_didik', $data);
		}
	}

	function update_multiple_nilai()
	{
		$updates = $this->input->post('id_nilai');

		foreach ($updates as $update) {
			$data = array(
				'formatif' => $this->input->post('formatif'),
				'tugas' => $this->input->post('tugas'),
				'uts' => $this->input->post('uts'),
				'uas' => $this->input->post('uas'),
			);
			$this->db->where('id_nilai', $update);
			$this->db->update('tbl_nilai', $data);
		}
	}

	// public function update_multiple_nilai($data)
	// {
	// $data adalah array asosiatif berisi data yang akan diperbarui
	// $data harus memiliki kolom yang berfungsi sebagai kunci utama (primary key)
	// Kolom yang akan diperbarui juga harus ada dalam array $data

	// Memperbarui multiple rows menggunakan update_batch()
	// 'users' adalah nama tabel yang akan diperbarui
	// 	$this->db->update_batch('tbl_nilai', $data, 'id_jadwal_kbm');
	// }

	function update_multiple_kehadiran()
	{
		$updates = $this->input->post('id_presensi');
		$updatess = $this->input->post('nim');

		foreach ($updates as $update) {
			$data = array(
				'keterangan' => $this->input->post('keterangan'),
			);
			$this->db->where('id_presensi', $update);
			$this->db->where('nim', $updatess);
			$this->db->update('tbl_detail_presensi', $data);
		}
	}

	function update_multiple_user()
	{
		$updates = $this->input->post('nim');

		foreach ($updates as $update) {
			$data = array(
				'id_kelas' => $this->input->post('kelas'),
			);
			$this->db->where('username', $update);
			$this->db->update('tbl_user', $data);
		}
	}

	public function insert_multiple_det_matkul($data)
	{
		// Menyisipkan multiple data ke dalam tabel
		$this->db->insert_batch('tbl_det_kurikulum', $data);
	}

	public function insert_multiple_data($data)
	{
		// Menyisipkan multiple data ke dalam tabel
		$this->db->insert_batch('tbl_detail_presensi', $data);
	}

	public function insert_multiple_kehadiran($data)
	{
		// Menyisipkan multiple data kehadiran ke dalam tabel
		$this->db->insert_batch('tbl_detail_presensi', $data);
	}

	public function insert_multiple_nilai($data)
	{
		// Menyisipkan multiple data kehadiran ke dalam tabel
		$this->db->insert_batch('tbl_nilai', $data);
	}

	public function insert_multiple_nilai_mhs($data)
	{
		// Menyisipkan multiple data kehadiran ke dalam tabel
		$this->db->insert_batch('tbl_detail_nilai', $data);
	}

	function update_multiple_akses()
	{
		$updates = $this->input->post('nim');

		foreach ($updates as $update) {
			$data = array(
				'akses_ujian' => $this->input->post('akses'),
			);
			$this->db->where('nim', $update);
			$this->db->update('tbl_peserta_didik', $data);
		}
	}

	function update_jenjang()
	{
		$updates = $this->input->post('nim');

		foreach ($updates as $update) {
			$data = array(
				'tingkat' => $this->input->post('tingkat'),
			);
			$this->db->where('nim', $update);
			$this->db->update('tbl_peserta_didik', $data);
		}
	}

	public function up($table, $data, $where)
	{
		$this->db->update($table, $data, $where);
		return $this->db->affected_rows();
	}

	function Update_All($data, $table)
	{
		$this->db->update($table, $data);
		return $this->db->affected_rows();
	}
	function Delete($where, $table)
	{
		$result = $this->db->delete($table, $where);
		return $result;
	}
	function Delete_All($table)
	{
		$result = $this->db->delete($table);
		return $result;
	}
	public function get($username)
	{
		$this->db->where('username', $username); // Untuk menambahkan Where Clause : username='$username'
		$result = $this->db->get('user')->row(); // Untuk mengeksekusi dan mengambil data hasil query
		return $result;
	}
	public function downloadfile($id)
	{
		$this->db->where('id_formulir', $id); // Untuk menambahkan Where Clause : username='$username'
		$result = $this->db->get('file')->row(); // Untuk mengeksekusi dan mengambil data hasil query
		return $result;
	}
	function hariini()
	{
		$tgl = date('Y-m-d');
		$this->db->like('tgl_pengajuan', $tgl);
		return $this->db->get('pengajuan')->result_array();
	}

	public function ambil_id_soal($id)
	{
		$this->db->from('tbl_soal_temporary');
		$this->db->where('id_soal_temporary', $id);
		$result = $this->db->get('');
		// periksa apakah datanya ada
		if ($result->num_rows() > 0) {
			return $result->row(); //ambil data berdasarkan row id
		}
	}

	public function ambil_id_materi($id)
	{
		$this->db->from('tbl_materi');
		$this->db->where('id_materi', $id);
		$result = $this->db->get('');
		// periksa apakah datanya ada
		if ($result->num_rows() > 0) {
			return $result->row(); //ambil data berdasarkan row id
		}
	}

	public function ambil_id_tugas($id)
	{
		$this->db->from('tbl_tugas');
		$this->db->where('id_tugas', $id);
		$result = $this->db->get('');
		// periksa apakah datanya ada
		if ($result->num_rows() > 0) {
			return $result->row(); //ambil data berdasarkan row id
		}
	}

	public function delete_soal($id)
	{
		$this->db->where('id_soal_temporary', $id);
		$this->db->delete('tbl_soal_temporary');
		return TRUE;
	}

	public function delete_materi($id)
	{
		$this->db->where('id_materi', $id);
		$this->db->delete('tbl_materi');
		return TRUE;
	}

	public function delete_tugas($id)
	{
		$this->db->where('id_tugas', $id);
		$this->db->delete('tbl_tugas');
		return TRUE;
	}

	public function Masuk($username, $password)
	{
		$this->db->select('*');
		$this->db->from('t_user');
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		$query = $this->db->get();
		$cekuser = $this->db->select('*')->from('t_user')->where('username', $username)->get();
		$cekpass = $this->db->select('*')->from('t_user')->where('password', $password)->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		} elseif ($cekuser->num_rows() == null) {
			return 'usernotfound';
		} elseif ($cekpass->num_rows() == null) {
			return 'passnotfound';
		} else {
			return false;
		}
	}

	public function download($id)
	{
		$query = $this->db->get_where('tbl_soal_temporary', array('id_soal_temporary' => $id));
		return $query->row_array();
	}

	public function download_history_uts($id)
	{
		$query = $this->db->get_where('tbl_jawaban_soal', array('id_jawaban' => $id));
		return $query->row_array();
	}

	public function download_materi($id)
	{
		$query = $this->db->get_where('tbl_materi', array('id_materi' => $id));
		return $query->row_array();
	}

	public function download_tugas($id)
	{
		$query = $this->db->get_where('tbl_tugas', array('id_tugas' => $id));
		return $query->row_array();
	}

	public function download_jawaban_tugas($id)
	{
		$query = $this->db->get_where('tbl_jawaban_tugas', array('id_jawaban_tugas' => $id));
		return $query->row_array();
	}

	public function CreateCode()
	{
		$this->db->select('no_rekening', FALSE);
		$this->db->order_by('no_rekening', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('t_nasabah');
		if ($query->num_rows() <> 0) {
			$data = $query->row();
			$kode = intval($data->no_rekening) + 1;
		} else {
			$kode = 1;
		}
		$batas = str_pad($kode, 5, "0", STR_PAD_LEFT);
		// $bts = 0265025;
		$kodetampil = "0". str_pad($kode, 5, "0", STR_PAD_LEFT);
		return $kodetampil;
	}

	public function CreateCodekhs()
	{
		$this->db->select('*', FALSE);
		$this->db->order_by('no', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('tbl_khs');
		if ($query->num_rows() <> 0) {
			$data = $query->row();
			$kode = intval($data->no) + 1;
		} else {
			$kode = 1;
		}
		// $batas = $kode;
		$batas = str_pad($kode, 3, "0", STR_PAD_LEFT);
		$kodetampil = $batas;
		return $kodetampil;
	}

	public function getSelectedItem($selectedItems)
	{
		// Lakukan query untuk mengambil data berdasarkan item yang dipilih
		$this->db->select('*');
		$this->db->from('tbl_peserta_didik');
		$this->db->where_in('nim', $selectedItems);
		$query = $this->db->get();

		return $query->result();
	}

	// public function CreateCode()
	// {
	// 	$this->db->select('RIGHT(tbl_nilai.id_nilai,5) as id_nilai', FALSE);
	// 	$this->db->order_by('id_nilai', 'DESC');
	// 	$this->db->limit(1);
	// 	$query = $this->db->get('tbl_nilai');
	// 	if ($query->num_rows() <> 0) {
	// 		$data = $query->row();
	// 		$kode = intval($data->id_nilai) + 1;
	// 	} else {
	// 		$kode = 1;
	// 	}
	// 	$batas = str_pad($kode, 5, "0", STR_PAD_LEFT);
	// 	$kodetampil = "NL" . $batas;
	// 	return $kodetampil;
	// }
}
