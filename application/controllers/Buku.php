<?php

class Buku extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
    }

    public function index()
    {
        $data['judul'] = 'Data Buku';
        $data['user'] = $this->ModelUser->cekData([
            'email' => $this->session->userdata('email')
        ])->row_array();
        $data['books'] = $this->ModelBuku->getBuku()->result_array();

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/templates/topbar', $data);
        $this->load->view('buku/index', $data);
        $this->load->view('admin/templates/footer');
    }
    
    public function kategori()
    {
        $data['judul'] = 'Data Kategori Buku';
        $data['user'] = $this->ModelUser->cekData([
            'email' => $this->session->userdata('email')
        ])->row_array();
        $data['categories'] = $this->ModelBuku->getKategori()->result_array();
        $data['category_types'] = [
            'Sains', 'Hobby', 'Komputer', 'Komunikasi', 'Hukum',
            'Agama', 'Populer', 'Bahasa', 'Komik'
        ];

        $this->form_validation->set_rules(
            'kategori',
            'Jenis Kategori',
            'required', [
                'required' => '%s Tidak Boleh Kosong'
        ]);

        if (! $this->form_validation->run()) {
            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/templates/sidebar', $data);
            $this->load->view('admin/templates/topbar', $data);
            $this->load->view('buku/kategori', $data);
            $this->load->view('admin/templates/footer');
        } else {
            $data = [
                'nama_kategori' => $this->input->post('kategori', true)
            ];

            $this->ModelBuku->simpanKategori($data);
            $this->session->set_flashdata(
                'pesan',
                "<div class='alert alert-success alert-message' role='alert'>Kategori Buku Berhasil Ditambahkan</div>"
            );
            
            redirect(base_url('buku/kategori'));
        }
    
    }

    public function ubahKategori()
    {
        $data['judul'] = 'Ubah Kategori';
        $id_kategori = $this->uri->segment(3);

        $data['user'] = $this->ModelUser->cekData([
            'email' => $this->session->userdata('email')
        ])->row_array();
        $data['category'] = $this->ModelBuku->kategoriWhere([
                'id_kategori' => $id_kategori
            ])->row_array();
        $data['category_types'] = [
            'Sains', 'Hobby', 'Komputer', 'Komunikasi', 'Hukum',
            'Agama', 'Populer', 'Bahasa', 'Komik'
        ];

        $this->form_validation->set_rules(
            'kategori',
            'Jenis Kategori',
            'required', [
                'required' => '%s Tidak Boleh Kosong'
        ]);

        if (! $this->form_validation->run()) {
            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/templates/sidebar', $data);
            $this->load->view('admin/templates/topbar', $data);
            $this->load->view('buku/ubah-kategori', $data);
            $this->load->view('admin/templates/footer');
        } else {
            $data = [
                'nama_kategori' => $this->input->post('kategori', true)
            ];

            $this->ModelBuku->updateKategori([
                'id_kategori' => $id_kategori
            ], $data);

            $this->session->set_flashdata(
                'pesan',
                "<div class='alert alert-success alert-message' role='alert'>Kategori Buku Berhasil Diperbarui</div>"
            );
            
            redirect(base_url('buku/kategori'));
        }

    }

    public function hapusKategori()
    {
        $this->ModelBuku->hapusKategori([
            'id_kategori' => $this->uri->segment(3)
        ]);

        $this->session->set_flashdata(
            'pesan',
            "<div class='alert alert-success alert-message' role='alert'>Kategori Buku Berhasil Dihapus</div>"
        );
        
        redirect(base_url('buku/kategori'));
    }
}
