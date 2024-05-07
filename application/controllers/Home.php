<?php

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = [
            'judul' => 'Katalog Buku',
            'buku' => $this->ModelBuku->getBuku()->result(),
            'user' => 'Pengunjung'
        ];

        if ($this->session->userdata('email')) {
            $user = $this->ModelUser->cekData([
                'email' => $this->session->userdata('email')
            ])->row_array();

            $data['user'] = $user['nama'];
        }

        $this->load->view('landing-page/templates/header', $data);
        $this->load->view('landing-page/buku/daftarbuku', $data);
        $this->load->view('landing-page/templates/footer', $data);
    }

    public function detailBuku()
    {
        $id = $this->uri->segment(3);
        $buku = $this->ModelBuku->joinKategoriBuku([
            'buku.id' => $id
        ])->row();

        $data = [
            'user' => 'Pengunjung',
            'judul' => 'Detail Buku',
            'buku' => $buku
        ];

        $this->load->view('landing-page/templates/header', $data);
        $this->load->view('landing-page/buku/detail', $data);
        $this->load->view('landing-page/templates/footer', $data);
    }
}