<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Daftar extends CI_Controller
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
        $data['title'] = "Pendaftaran";
        $this->load->view('umum/index', $data);
    }

    public function add_daftar()
    {
        $config['upload_path']          = './user/';
        $config['allowed_types']        = 'jpg|png|jpeg';
        $config['max_size']             = 10000; //set max size allowed in Kilobyte

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('foto')) //upload and validate
        {
            echo "Gagal Tambah";
        } else {
            $foto                  = $this->upload->data();
            $foto                  = $foto['file_name'];
            $name = $this->input->post('name', TRUE);
            $username = $this->input->post('username', TRUE);
            $password = $this->input->post('password', TRUE);
            $akses = 'nasabah';
            $no_rekening = $this->input->post('no_rek');

            $data = array(
                'name'      => $name,
                'username'           => $username,
                'password'           => $password,
                'foto'          => $foto,
                'akses'          => $akses,
                'no_rekening' => $no_rekening,
            );
            $this->m->Save($data, 't_user');


            $input = array(
                'no_rekening' => $this->input->post('no_rek'),
                'nama_nasabah' => $this->input->post('name'),
                'no_wa' => '62' . $this->input->post('no_wa'),
                'email' => $this->input->post('email'),
                'jenis_tabungan' => $this->input->post('jenis_tabungan'),
                'status' => 'Aktif',
            );
            $this->m->Save($input, 't_nasabah');

            redirect('Auth');
        }

        redirect('Auth');
    }
}
