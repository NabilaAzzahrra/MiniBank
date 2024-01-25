<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public     function __construct()
    {
        parent::__construct();
        $this->load->model('Models', 'm');
        // $this->load->library('form_validation');
    }

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
    public function index()
    {
        // if ($this->session->userdata('username') == 'admin') {
        //     redirect('Admin');
        // }

        // $this->form_validation->set_rules('username', 'Username', 'trim|required');
        // $this->form_validation->set_rules('password', 'Password', 'trim|required');

        // if ($this->form_validation->run() == false) {
        //     $data['title'] = 'Halaman Login';
        //     $this->load->view('templates_auth/header', $data);
        //     $this->load->view('auth/login');
        //     $this->load->view('templates_auth/footer');
        // } else {
        //     $this->_login();
        // }
        $this->session->sess_destroy();
        $this->load->view('auth/index');
    }

    public function login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $namepass = $this->input->post('username', 'password');
        $cek              = $this->m->Masuk($username, $password, $namepass);
        if ($cek == 'usernotfound') {
            // $this->session->set_flashdata('usernotfound', true);
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-size: 12px; align:center;">
            <strong>Username atau Password Salah</strong>
        </div>');
            redirect('Auth');
        } elseif ($cek == 'passnotfound') {
            // $this->session->set_flashdata('passnotfound', true);
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-size: 12px; align:center;">
            <strong>Username atau Password Salah</strong>
        </div>');
            redirect('Auth');
        } else {
            foreach ($cek as $d) {
                $username = $d->username;
                $name = $d->name;
                $akses = $d->akses;
                $id_user = $d->id_user;
                $foto = $d->foto;
                $no_rekening = $d->no_rekening;
                $status_login = TRUE;
            }
            $data = array(
                'username' => $username,
                'name' => $name,
                'akses' => $akses,
                'id_user' => $id_user,
                'foto' => $foto,
                'no_rekening' => $no_rekening,
                'status_login' => $status_login,
            );
            $this->session->set_userdata($data);
            if ($akses == 'administrator') {
                redirect('Admin/index');
            } else if ($akses == 'nasabah') {
                redirect('Nasabah/index');
            }
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('status_login');
        $this->session->set_flashdata('logout', TRUE);
        redirect('Auth');
    }

    public function resetpass()
    {
        $table = 'tbl_user';
        $where = array(
            'username'        =>    $this->input->post('username')
        );
        //first validate then insert in db
        $data = array(
            'password'        =>  $this->input->post('password')
        );

        $this->m->Update($where, $data, $table);

        $this->session->set_flashdata('pesan2', 'Password berhasil diubah!!');
        redirect('Auth');
    }
}
