<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Nasabah extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Models', 'm');
		if (!$this->session->userdata('status_login')) {
			redirect('Auth');
		}
	}
	public function logout()
	{
		$this->session->unset_userdata('status_login');
		$this->session->set_flashdata('logout', TRUE);
		redirect('Auth');
	}
	public function sidebar()
	{
		$data = array(
			'page' => "",
			'dashboard_status' => "",
			'saldo_status' => "",
			'keluar_status' => "",
			'masuk_status' => "",
			'nasabah_status' => "",
			'pembayaran_status' => "",
			'transfer_status' => "",
			'tabungan_status' => "",
			'pembayaran_tabungan_status' => "",
			'topup_status' => "",
		);

		$this->session->set_userdata($data);
	}
	public function index()
	{
		$this->sidebar();
		$data = array(
			'dashboard_status' => " active",
		);
		$this->session->set_userdata($data);
		$data['title'] = 'Dashboard';

		$select = $this->db->select('*, Sum(jumlah) as jumlah');
        $select = $this->db->where('jenis_tabungan', 'umum');
		$select = $this->db->where('no_rekening', $this->session->userdata('no_rekening'));
        $data['umum'] = $this->m->Get_All('t_transfer', $select);
        
        $select = $this->db->select('*');
        $select = $this->db->where('no_rekening', $this->session->userdata('no_rekening'));
        $data['saldo'] = $this->m->Get_All('v_saldo_tersedia', $select);
        
        $select = $this->db->select('Sum(jumlah_bayar) as jumlah');
        $select = $this->db->join('t_peminjaman','t_peminjaman.id_peminjaman=t_pembayaran.id_peminjaman');
        $select = $this->db->where('tanggal_pembayaran', date('Y-m-d'));
        $select = $this->db->where('no_rekening', $this->session->userdata('no_rekening'));
        $data['pembayaran'] = $this->m->Get_All('t_pembayaran', $select);

        $select = $this->db->select('Sum(jumlah) as jumlah');
        $select = $this->db->where('tanggal', date('Y-m-d'));
        $select = $this->db->where('no_rekening', $this->session->userdata('no_rekening'));
        $data['transfer'] = $this->m->Get_All('t_transfer', $select);

		$this->load->view('include/head', $data);
		$this->load->view('include/sidebar', $data);
		$this->load->view('include/navbar', $data);
		$this->load->view('user/index');
		$this->load->view('include/footers');
	}

	public function tabungan()
	{
		$this->sidebar();
		$data = array(
			'page' => "seagreen",
			'tabungan_status' => " active",
		);
		$this->session->set_userdata($data);
		$data['title'] = 'Tabungan';

		$this->load->view('include/head', $data);
		$this->load->view('include/sidebar', $data);
		$this->load->view('include/navbar', $data);
		$this->load->view('user/tabungan');
		$this->load->view('include/footers');
	}

	public function cm_umum()
	{
		$this->sidebar();
		$data = array(
			'page' => "seagreen",
			'tabungan_status' => " active",
		);
		$this->session->set_userdata($data);
		$data['title'] = 'Tabungan Umum Cash Masuk';

		$this->load->view('include/head', $data);
		$this->load->view('include/sidebar', $data);
		$this->load->view('include/navbar', $data);
		$this->load->view('user/cm_umum');
		$this->load->view('include/footers');
	}


	public function ck_umum()
	{
		$this->sidebar();
		$data = array(
			'page' => "seagreen",
			'tabungan_status' => " active",
		);
		$this->session->set_userdata($data);
		$data['title'] = 'Tabungan Umum Cash Keluar';

		$this->load->view('include/head', $data);
		$this->load->view('include/sidebar', $data);
		$this->load->view('include/navbar', $data);
		$this->load->view('user/ck_umum');
		$this->load->view('include/footers');
	}

	public function s_umum()
	{
		$this->sidebar();
		$data = array(
			'page' => "seagreen",
			'tabungan_status' => " active",
		);
		$this->session->set_userdata($data);
		$data['title'] = 'Saldo Tabungan Umum';

		$this->load->view('include/head', $data);
		$this->load->view('include/sidebar', $data);
		$this->load->view('include/navbar', $data);
		$this->load->view('user/s_umum');
		$this->load->view('include/footers');
	}

	public function pembayaran_tabungan()
	{
		$this->sidebar();
		$data = array(
			'page' => "seagreen",
			'pembayaran_tabungan_status' => " active",
		);
		$this->session->set_userdata($data);
		$data['title'] = 'Pembayaran Tabungan';
		
		$select = $this->db->select('*');
        $select = $this->db->join('t_nasabah', 't_nasabah.no_rekening=t_menabung.no_rekening');
        $select = $this->db->where('t_menabung.no_rekening',$this->session->userdata('no_rekening'));
        $data['read'] = $this->m->Get_All('t_menabung', $select);

		$this->load->view('include/head', $data);
		$this->load->view('include/sidebar', $data);
		$this->load->view('include/navbar', $data);
		$this->load->view('user/pembayaran_tabungan');
		$this->load->view('include/footers');
	}

	public function pembayaran()
	{
		$this->sidebar();
		$data = array(
			'page' => "seagreen",
			'pembayaran_status' => " active",
		);
		$this->session->set_userdata($data);
		$data['title'] = 'Peminjaman';
		
		$select = $this->db->select('*');
        $select = $this->db->join('t_nasabah', 't_nasabah.no_rekening=t_peminjaman.no_rekening');
        $select = $this->db->where('t_peminjaman.no_rekening',$this->session->userdata('no_rekening'));
        $data['read'] = $this->m->Get_All('t_peminjaman', $select);

		$this->load->view('include/head', $data);
		$this->load->view('include/sidebar', $data);
		$this->load->view('include/navbar', $data);
		$this->load->view('user/pembayaran');
		$this->load->view('include/footers');
	}

	public function transfer()
	{
		$this->sidebar();
		$data = array(
			'page' => "seagreen",
			'transfer_status' => " active",
		);
		$this->session->set_userdata($data);
		$data['title'] = 'Transfer';
		
		$select = $this->db->select('*');
        $select = $this->db->join('t_nasabah', 't_nasabah.no_rekening=t_transfer.no_rekening');
        $select = $this->db->where('t_transfer.no_rekening',$this->session->userdata('no_rekening'));
        $data['read'] = $this->m->Get_All('t_transfer', $select);

		$this->load->view('include/head', $data);
		$this->load->view('include/sidebar', $data);
		$this->load->view('include/navbar', $data);
		$this->load->view('user/transfer');
		$this->load->view('include/footers');
	}

	public function keluar()
    {
        $this->sidebar();
        $data = array(
            'page' => "seagreen",
            'keluar_status' => " active",
        );
        $this->session->set_userdata($data);
        $data['title'] = 'Transaksi';
        
        $select = $this->db->select('*');
        $select = $this->db->where('v_debit_kredit_seluruh.no_rekening',$this->session->userdata('no_rekening'));
        $data['read'] = $this->m->Get_All('v_debit_kredit_seluruh', $select);

        $this->load->view('include/head', $data);
        $this->load->view('include/sidebar', $data);
        $this->load->view('include/navbar', $data);
        $this->load->view('user/keluar');
        $this->load->view('include/footers');
    }
}
