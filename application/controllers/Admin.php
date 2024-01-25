<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
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
            'tnasabah_status' => "",
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

        $select = $this->db->select('*');
        $data['saldo_bank'] = $this->m->Get_All('v_saldo_bank', $select);
        $data['nasabah'] = $this->m->Get_All('v_saldo_tersedia', $select);

        $select = $this->db->select('Sum(jumlah_bayar) as jumlah');
        $select = $this->db->where('tanggal_pembayaran', date('Y-m-d'));
        $data['pembayaran'] = $this->m->Get_All('t_pembayaran', $select);

        $select = $this->db->select('Sum(jumlah) as jumlah');
        $select = $this->db->where('tanggal', date('Y-m-d'));
        $data['transfer'] = $this->m->Get_All('t_transfer', $select);

        $select = $this->db->select('Sum(jumlah) as jumlah');
        $select = $this->db->where('jenis_tabungan', 'ujikom');
        $data['ujikom'] = $this->m->Get_All('t_transfer', $select);

        $select = $this->db->select('Sum(jumlah) as jumlah');
        $select = $this->db->where('jenis_tabungan', 'kurban');
        $data['kurban'] = $this->m->Get_All('t_transfer', $select);

        $select = $this->db->select('Sum(jumlah) as jumlah');
        $select = $this->db->where('jenis_tabungan', 'umum');
        $data['umum'] = $this->m->Get_All('t_transfer', $select);

        $this->load->view('include/head', $data);
        $this->load->view('include/sidebar', $data);
        $this->load->view('include/navbar', $data);
        $this->load->view('admin/index');
        $this->load->view('include/footers');
    }

    public function nasabah()
    {
        $this->sidebar();
        $data = array(
            'page' => "seagreen",
            'nasabah_status' => " active",
        );
        $this->session->set_userdata($data);
        $data['title'] = 'Nasabah';

        $select = $this->db->select('*');
        $select = $this->db->join('t_nasabah', 't_nasabah.no_rekening=v_saldo_tersedia.no_rekening');
        $data['read'] = $this->m->Get_All('v_saldo_tersedia', $select);

        $this->load->view('include/head', $data);
        $this->load->view('include/sidebar', $data);
        $this->load->view('include/navbar', $data);
        $this->load->view('admin/nasabah');
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
        $data['read'] = $this->m->Get_All('t_peminjaman', $select);

        $this->load->view('include/head', $data);
        $this->load->view('include/sidebar', $data);
        $this->load->view('include/navbar', $data);
        $this->load->view('admin/pembayaran');
        $this->load->view('include/footers');
    }

    public function bayar()
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
        $select = $this->db->where('id_peminjaman', $_GET['id_peminjaman']);
        $data['read'] = $this->m->Get_All('t_peminjaman', $select);

        $this->load->view('include/head', $data);
        $this->load->view('include/sidebar', $data);
        $this->load->view('include/navbar', $data);
        $this->load->view('admin/bayar');
        $this->load->view('include/footers');
    }

    public function menabung()
    {
        $this->sidebar();
        $data = array(
            'page' => "seagreen",
            'pembayaran_status' => " active",
        );
        $this->session->set_userdata($data);
        $data['title'] = 'Peminjaman';

        $select = $this->input->post('*');
        $data['nasabah'] = $this->m->Get_All('t_nasabah', $select);

        $this->load->view('include/head', $data);
        $this->load->view('include/sidebar', $data);
        $this->load->view('include/navbar', $data);
        $this->load->view('admin/tambah_menabung');
        $this->load->view('include/footers');
    }

    public function getNasabah($id)
    {
        $select = $this->db->select('*');
        // $select = $this->db->join('merek', 'merek.kd_merek=m_barang.kd_merek');
        // $select = $this->db->join('kategori', 'kategori.kd_kat=m_barang.kd_kat');
        // $select = $this->db->join('ruang', 'ruang.id_ruang=m_barang.id_ruang');
        // $select = $this->db->join('divisi', 'divisi.kd_divisi=m_barang.kd_divisi');
        $select = $this->db->where('no_rekening', $id);
        $nasabah = $this->m->Get_All('t_nasabah', $select);
        // function Rupiah($angka)
        // {
        //     $hasil = "Rp " . number_format($angka, 0, ',', '.');
        //     return $hasil;
        // }
        foreach ($nasabah as $m) {
            echo '
                <div class="form-group">
                    <label for="merek">Nasabah</label>
                    <input type="text" class="form-control" name="nama_nasabah" value="' . $m->nama_nasabah . '" readonly>
                </div>
            ';
            echo '
                <div class="form-group">
                    <label for="id_merek">No Wa</label>
                    <input type="text" class="form-control" name="no_wa" value="' . $m->no_wa . '" readonly>
                </div>
            ';
            echo '
                <div class="form-group">
                    <label for="kategori">Email</label>
                    <input type="text" class="form-control" name="email" value="' . $m->email . '" readonly>
                </div>
            ';
            echo '
                <div class="form-group">
                    <label for="kd_kat">Jenis Tabungan</label>
                    <input type="text" class="form-control" name="jenis_tabungan" value="' . $m->jenis_tabungan . '" readonly>
                </div>
            ';
            echo '
                <div class="form-group">
                    <label for="ruang">Status</label>
                    <input type="text" class="form-control" name="status" value="' . $m->status . '" readonly>
                </div>
            ';
        }
    }

    public function act_menabung()
    {
        $data = array(
            'no_rekening' => $this->input->post('no_rek'),
            'tanggal' => date('Y-m-d'),
            'jumlah' => $this->input->post('jumlah_menabung'),
            'jenis_tabungan' => $this->input->post('jenis_tabungan'),
        );

        $this->m->Save($data, 't_menabung');
        redirect('Admin/pembayaran_tabungan');
    }

    public function act_bayar()
    {
        $terbayar = $this->input->post('pembayaran');
        $belum_terbayar = $this->input->post('belum_terbayar');
        $jumlah_bayar = $this->input->post('pembayaran');

        $data = array(
            'id_peminjaman' => $this->input->post('id_peminjaman'),
            'tanggal_pembayaran' => date('Y-m-d'),
            'jumlah_bayar' => $this->input->post('pembayaran'),
        );

        $where = array(
            'id_peminjaman' => $this->input->post('id_peminjaman'),
        );
        $pinjam = array(
            'terbayar' => $terbayar,
            'belum_terbayar' => $belum_terbayar - $jumlah_bayar,
        );

        $this->m->Save($data, 't_pembayaran');

        $this->m->Update($where, $pinjam, 't_peminjaman');
        redirect('Admin/pembayaran');
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
        $data['read'] = $this->m->Get_All('t_transfer', $select);

        $this->load->view('include/head', $data);
        $this->load->view('include/sidebar', $data);
        $this->load->view('include/navbar', $data);
        $this->load->view('admin/transfer');
        $this->load->view('include/footers');
    }

    public function t_transfer()
    {
        $this->sidebar();
        $data = array(
            'page' => "seagreen",
            'pembayaran_status' => " active",
        );
        $this->session->set_userdata($data);
        $data['title'] = 'Peminjaman';

        $select = $this->input->post('*');
        $data['nasabah'] = $this->m->Get_All('t_nasabah', $select);

        $this->load->view('include/head', $data);
        $this->load->view('include/sidebar', $data);
        $this->load->view('include/navbar', $data);
        $this->load->view('admin/t_transfer');
        $this->load->view('include/footers');
    }

    public function getNasabahDituju($id)
    {
        $select = $this->db->select('*');
        $select = $this->db->where('no_rekening', $id);
        $nasabah = $this->m->Get_All('t_nasabah', $select);
        foreach ($nasabah as $m) {
            echo '
                <div class="form-group">
                    <label for="merek">Nasabah</label>
                    <input type="text" class="form-control" name="nasabah_dituju" value="' . $m->nama_nasabah . '" readonly>
                </div>
            ';
            echo '
                <div class="form-group">
                    <label for="id_merek">No Wa</label>
                    <input type="text" class="form-control" name="no_wa_dituju" value="' . $m->no_wa . '" readonly>
                </div>
            ';
            echo '
                <div class="form-group">
                    <label for="kategori">Email</label>
                    <input type="text" class="form-control" name="email_dituju" value="' . $m->email . '" readonly>
                </div>
            ';
            echo '
                <div class="form-group">
                    <label for="kd_kat">Jenis Tabungan</label>
                    <input type="text" class="form-control" name="jenis_tabungan_dituju" value="' . $m->jenis_tabungan . '" readonly>
                </div>
            ';
            echo '
                <div class="form-group">
                    <label for="ruang">Status</label>
                    <input type="text" class="form-control" name="status_dituju" value="' . $m->status . '" readonly>
                </div>
            ';
        }
    }

    public function act_tf()
    {
        $data = array(
            'no_rekening' => $this->input->post('no_rek_dituju'),
            'tanggal' => date('Y-m-d'),
            'jumlah' => $this->input->post('jumlah_tf'),
            'jenis_tabungan' => $this->input->post('jenis_tabungan_dituju'),
            'ket' => 'tf',
        );

        $tf = array(
            'no_rekening' => $this->input->post('no_rek'),
            'no_rek_dituju' => $this->input->post('no_rek_dituju'),
            'tanggal' => date('Y-m-d'),
            'jumlah' => $this->input->post('jumlah_tf'),
            'jenis_tabungan_dituju' => $this->input->post('jenis_tabungan_dituju'),
        );

        $this->m->Save($data, 't_menabung');
        $this->m->Save($tf, 't_transfer');
        redirect('Admin/transfer');
    }

    public function t_peminjaman()
    {
        $this->sidebar();
        $data = array(
            'page' => "seagreen",
            'pembayaran_status' => " active",
        );
        $this->session->set_userdata($data);
        $data['title'] = 'Peminjaman';

        $select = $this->input->post('*');
        $data['nasabah'] = $this->m->Get_All('t_nasabah', $select);

        $this->load->view('include/head', $data);
        $this->load->view('include/sidebar', $data);
        $this->load->view('include/navbar', $data);
        $this->load->view('admin/t_peminjaman');
        $this->load->view('include/footers');
    }

    public function t_nasabah()
    {
        $this->sidebar();
        $data = array(
            'page' => "seagreen",
            'tnasabah_status' => " active",
        );
        $this->session->set_userdata($data);
        $data['title'] = 'Transaksi Nasabah';

        $select = $this->db->select('*');
        $data['read'] = $this->m->Get_All('v_debit_kredit', $select);
        $data['nasabah'] = $this->m->Get_All('t_nasabah', $select);

        $this->load->view('include/head', $data);
        $this->load->view('include/sidebar', $data);
        $this->load->view('include/navbar', $data);
        $this->load->view('admin/t_nasabah');
        $this->load->view('include/footers');
    }

    public function cari_t_nasabah()
    {
        $this->sidebar();
        $data = array(
            'page' => "seagreen",
            'tnasabah_status' => " active",
        );
        $this->session->set_userdata($data);
        $data['title'] = 'Transaksi Nasabah';

        $select = $this->db->select('*');
        $select = $this->db->where('no_rekening', $_GET['no_rek']);
        $select = $this->db->where('tanggal >=', $_GET['dari']);
        $select = $this->db->where('tanggal <=', $_GET['sampai']);
        $data['read'] = $this->m->Get_All('v_debit_kredit', $select);

        $data['nasabah'] = $this->m->Get_All('t_nasabah', $select);

        $this->load->view('include/head', $data);
        $this->load->view('include/sidebar', $data);
        $this->load->view('include/navbar', $data);
        $this->load->view('admin/cari_t_nasabah');
        $this->load->view('include/footers');
    }

    public function act_pinjam()
    {
        $data = array(
            'no_rekening' => $this->input->post('no_rek'),
            'tanggal_pinjam' => date('Y-m-d'),
            'jumlah_pinjam' => $this->input->post('jumlah_pinjam'),
            'jenis_tabungan' => $this->input->post('jenis_tabungan'),
            'terbayar' => 0,
            'belum_terbayar' => $this->input->post('jumlah_pinjam'),
            // 'status' => 'Belum'
        );

        $this->m->Save($data, 't_peminjaman');
        redirect('Admin/pembayaran');
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
        $this->load->view('admin/tabungan');
        $this->load->view('include/footers');
    }

    public function ujikom()
    {
        $this->sidebar();
        $data = array(
            'page' => "seagreen",
            'tabungan_status' => " active",
        );
        $this->session->set_userdata($data);
        $data['title'] = 'Tabungan Ujikom';

        $select = $this->db->select('*');
        $select = $this->db->join('t_nasabah', 't_nasabah.no_rekening=v_saldo_tersedia.no_rekening');
        $select = $this->db->where('t_nasabah.jenis_tabungan', 'ujikom');
        $data['read'] = $this->m->Get_All('v_saldo_tersedia', $select);

        $this->load->view('include/head', $data);
        $this->load->view('include/sidebar', $data);
        $this->load->view('include/navbar', $data);
        $this->load->view('admin/ujikom');
        $this->load->view('include/footers');
    }

    public function kurban()
    {
        $this->sidebar();
        $data = array(
            'page' => "seagreen",
            'tabungan_status' => " active",
        );
        $this->session->set_userdata($data);
        $data['title'] = 'Tabungan Kurban';

        $select = $this->db->select('*');
        $select = $this->db->join('t_nasabah', 't_nasabah.no_rekening=v_saldo_tersedia.no_rekening');
        $select = $this->db->where('t_nasabah.jenis_tabungan', 'kurban');
        $data['read'] = $this->m->Get_All('v_saldo_tersedia', $select);

        $this->load->view('include/head', $data);
        $this->load->view('include/sidebar', $data);
        $this->load->view('include/navbar', $data);
        $this->load->view('admin/kurban');
        $this->load->view('include/footers');
    }

    public function umum()
    {
        $this->sidebar();
        $data = array(
            'page' => "seagreen",
            'tabungan_status' => " active",
        );
        $this->session->set_userdata($data);
        $data['title'] = 'Tabungan Umum';

        $select = $this->db->select('*');
        $select = $this->db->join('t_nasabah', 't_nasabah.no_rekening=v_saldo_tersedia.no_rekening');
        $select = $this->db->where('t_nasabah.jenis_tabungan', 'umum');
        $data['read'] = $this->m->Get_All('v_saldo_tersedia', $select);

        $this->load->view('include/head', $data);
        $this->load->view('include/sidebar', $data);
        $this->load->view('include/navbar', $data);
        $this->load->view('admin/umum');
        $this->load->view('include/footers');
    }

    public function cm_ujikom()
    {
        $this->sidebar();
        $data = array(
            'page' => "seagreen",
            'tabungan_status' => " active",
        );
        $this->session->set_userdata($data);
        $data['title'] = 'Tabungan Ujikom Cash Masuk';

        $this->load->view('include/head', $data);
        $this->load->view('include/sidebar', $data);
        $this->load->view('include/navbar', $data);
        $this->load->view('admin/cm_ujikom');
        $this->load->view('include/footers');
    }

    public function cm_kurban()
    {
        $this->sidebar();
        $data = array(
            'page' => "seagreen",
            'tabungan_status' => " active",
        );
        $this->session->set_userdata($data);
        $data['title'] = 'Tabungan Kurban Cash Masuk';

        $this->load->view('include/head', $data);
        $this->load->view('include/sidebar', $data);
        $this->load->view('include/navbar', $data);
        $this->load->view('admin/cm_kurban');
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
        $this->load->view('admin/cm_umum');
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
        $this->load->view('admin/ck_umum');
        $this->load->view('include/footers');
    }

    public function ck_kurban()
    {
        $this->sidebar();
        $data = array(
            'page' => "seagreen",
            'tabungan_status' => " active",
        );
        $this->session->set_userdata($data);
        $data['title'] = 'Tabungan Kurban Cash Keluar';

        $this->load->view('include/head', $data);
        $this->load->view('include/sidebar', $data);
        $this->load->view('include/navbar', $data);
        $this->load->view('admin/ck_kurban');
        $this->load->view('include/footers');
    }

    public function ck_ujikom()
    {
        $this->sidebar();
        $data = array(
            'page' => "seagreen",
            'tabungan_status' => " active",
        );
        $this->session->set_userdata($data);
        $data['title'] = 'Tabungan Uji Kompetensi Cash Keluar';

        $this->load->view('include/head', $data);
        $this->load->view('include/sidebar', $data);
        $this->load->view('include/navbar', $data);
        $this->load->view('admin/ck_ujikom');
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
        $this->load->view('admin/s_umum');
        $this->load->view('include/footers');
    }

    public function s_kurban()
    {
        $this->sidebar();
        $data = array(
            'page' => "seagreen",
            'tabungan_status' => " active",
        );
        $this->session->set_userdata($data);
        $data['title'] = 'Saldo Tabungan Kurban';

        $this->load->view('include/head', $data);
        $this->load->view('include/sidebar', $data);
        $this->load->view('include/navbar', $data);
        $this->load->view('admin/s_kurban');
        $this->load->view('include/footers');
    }

    public function s_ujikom()
    {
        $this->sidebar();
        $data = array(
            'page' => "seagreen",
            'tabungan_status' => " active",
        );
        $this->session->set_userdata($data);
        $data['title'] = 'Saldo Tabungan Uji Kompetensi';

        $this->load->view('include/head', $data);
        $this->load->view('include/sidebar', $data);
        $this->load->view('include/navbar', $data);
        $this->load->view('admin/s_ujikom');
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
        $data['read'] = $this->m->Get_All('t_menabung', $select);

        $this->load->view('include/head', $data);
        $this->load->view('include/sidebar', $data);
        $this->load->view('include/navbar', $data);
        $this->load->view('admin/pembayaran_tabungan');
        $this->load->view('include/footers');
    }

    public function print_pembayaran()
    {
        $this->sidebar();
        $data = array(
            'page' => "seagreen",
            'pembayaran_tabungan_status' => " active",
        );
        $this->session->set_userdata($data);
        $data['title'] = 'Print';

        $this->load->view('include/head', $data);
        $this->load->view('include/sidebar', $data);
        $this->load->view('include/navbar', $data);
        $this->load->view('admin/lpembayaran_tabungan');
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
        $data['read'] = $this->m->Get_All('v_debit_kredit_seluruh', $select);

        $this->load->view('include/head', $data);
        $this->load->view('include/sidebar', $data);
        $this->load->view('include/navbar', $data);
        $this->load->view('admin/keluar');
        $this->load->view('include/footers');
    }

    public function topup()
    {
        $this->sidebar();
        $data = array(
            'page' => "seagreen",
            'topup_status' => " active",
        );
        $this->session->set_userdata($data);
        $data['title'] = 'Top Up';

        $this->load->view('include/head', $data);
        $this->load->view('include/sidebar', $data);
        $this->load->view('include/navbar', $data);
        $this->load->view('admin/topup');
        $this->load->view('include/footers');
    }

    public function perbaikan()
    {
        $this->sidebar();
        $data = array(
            'page' => "seagreen",
            'topup_status' => " active",
        );
        $this->session->set_userdata($data);
        $data['title'] = 'Top Up';

        $this->load->view('include/head', $data);
        $this->load->view('include/sidebar', $data);
        $this->load->view('include/navbar', $data);
        $this->load->view('admin/perbaikan');
        $this->load->view('include/footers');
    }

    public function print_t_nasabah()
    {
        // $this->sidebar();
        // $data = array(
        //     'page' => "seagreen",
        //     'topup_status' => " active",
        // );
        // $this->session->set_userdata($data);
        // $data['title'] = 'Top Up';

        // $this->load->view('include/head', $data);
        // $this->load->view('include/sidebar', $data);
        // $this->load->view('include/navbar', $data);

        $no_rek = $this->input->post('no_rekening');
        $darip = $this->input->post('darip');
        $sampaip = $this->input->post('sampaip');

        $select = $this->db->select('*');
        $select = $this->db->where('no_rekening', $no_rek);
        $select = $this->db->where('tanggal >=', $darip);
        $select = $this->db->where('tanggal <=', $sampaip);
        $data['read'] = $this->m->Get_All('v_debit_kredit', $select);

        $this->load->view('admin/print_t_nasabah', $data);
        // $this->load->view('include/footers');
    }
}
