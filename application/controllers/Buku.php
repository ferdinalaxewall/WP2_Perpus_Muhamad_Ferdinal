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
        $data['categories'] = $this->ModelBuku->getKategori()->result_array();

        $this->form_validation->set_rules(self::defineDefaultRules('judul_buku', 'Judul Buku'));
        $this->form_validation->set_rules(self::defineDefaultRules('pengarang', 'Nama Pengarang'));
        $this->form_validation->set_rules(self::defineDefaultRules('penerbit', 'Nama Penerbit'));
        $this->form_validation->set_rules(self::defineDefaultRules('tahun', 'Tahun Terbit'));
        $this->form_validation->set_rules(self::defineDefaultRules('isbn', 'Nomor ISBN'));

        $this->form_validation->set_rules(
            'id_kategori',
            'Kategori',
            'required', [
                'required' => '%s harus diisi!',
        ]);

        $this->form_validation->set_rules(
            'stok',
            'Stok',
            'required|numeric', [
                'required' => '%s harus diisi!',
                'numeric' => '%s hanya boleh berisikan angka!',
        ]);
        if (! $this->form_validation->run()) {
            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/templates/sidebar', $data);
            $this->load->view('admin/templates/topbar', $data);
            $this->load->view('buku/index', $data);
            $this->load->view('admin/templates/footer');
        } else {
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {

                // Upload File Configuration
                $config['upload_path'] = './assets/img/buku/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '3000';
                $config['file_name'] = 'pro' . time();
    
                $this->load->library('upload');
                $this->upload->initialize($config);
                
                if ($this->upload->do_upload('image')) {
                    $gambar = $this->upload->data('file_name');
    
                    $data = [
                        'judul_buku' => $this->input->post('judul_buku', true),
                        'id_kategori' => $this->input->post('id_kategori', true),
                        'pengarang' => $this->input->post('pengarang', true),
                        'penerbit' => $this->input->post('penerbit', true),
                        'tahun_terbit' => $this->input->post('tahun_terbit', true),
                        'isbn' => $this->input->post('isbn', true),
                        'stok' => $this->input->post('stok', true),
                        'dipinjam' => 0,
                        'dibooking' => 0,
                        'image' => $gambar,
                    ];
        
                    $this->ModelBuku->simpanBuku($data);
                    $this->session->set_flashdata(
                        'pesan',
                        "<div class='alert alert-success alert-message' role='alert'>Buku Berhasil Ditambahkan</div>"
                    );
                    
                    redirect(base_url('buku'));
                } else {
                    $this->session->set_flashdata(
                        'pesan',
                        "<div class='alert alert-danger alert-message' role='alert'>{$this->upload->display_errors()}</div>"
                    );

                    redirect(base_url('buku'));
                }
            } else {
                $this->session->set_flashdata(
                    'pesan',
                    "<div class='alert alert-danger alert-message' role='alert'>Gambar Buku Tidak Berhasil di Upload</div>"
                );
                
                redirect(base_url('buku'));
            }
        }
    }

    public function ubahBuku() {
        $data['judul'] = 'Ubah Data Buku';
        $data['user'] = $this->ModelUser->cekData([
            'email' => $this->session->userdata('email')
        ])->row_array();
        $data['book'] = $this->ModelBuku->bukuWhere([
            'id' => $this->uri->segment(3)
        ])->row_array();
        $kategori = $this->ModelBuku->joinKategoriBuku([
            'buku.id' => $this->uri->segment(3)
        ])->result_array();
        
        foreach ($kategori as $k) {
            $data['id'] = $k['id_kategori'];
            $data['k'] = $k['nama_kategori'];
        }

        $data['categories'] = $this->ModelBuku->getKategori()->result_array();

        $this->form_validation->set_rules(self::defineDefaultRules('judul_buku', 'Judul Buku'));
        $this->form_validation->set_rules(self::defineDefaultRules('pengarang', 'Nama Pengarang'));
        $this->form_validation->set_rules(self::defineDefaultRules('penerbit', 'Nama Penerbit'));
        $this->form_validation->set_rules(self::defineDefaultRules('tahun', 'Tahun Terbit'));
        $this->form_validation->set_rules(self::defineDefaultRules('isbn', 'Nomor ISBN'));

        $this->form_validation->set_rules(
            'id_kategori',
            'Kategori',
            'required', [
                'required' => '%s harus diisi!',
        ]);

        $this->form_validation->set_rules(
            'stok',
            'Stok',
            'required|numeric', [
                'required' => '%s harus diisi!',
                'numeric' => '%s hanya boleh berisikan angka!',
        ]);

        // Upload File Configuration
        $config['upload_path'] = './assets/img/buku/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '3000';
        $config['file_name'] = 'pro' . time();

        $this->load->library('upload');
        $this->upload->initialize($config);

        if(! $this->form_validation->run()) {
            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/templates/sidebar', $data);
            $this->load->view('admin/templates/topbar', $data);
            $this->load->view('buku/ubah-buku', $data);
            $this->load->view('admin/templates/footer');
        } else {
            if ($this->upload->do_upload('image')) {
                $image = $this->upload->data();
                unlink('assets/img/upload/' . $this->input->post('old_pict', TRUE));

                $gambar = $image['file_name'];
            } else {
                $gambar = $this->input->post('old_pict', TRUE);
            }

            $data = [
                'judul_buku' => $this->input->post('judul_buku', true),
                'id_kategori' => $this->input->post('id_kategori', true),
                'pengarang' => $this->input->post('pengarang', true),
                'penerbit' => $this->input->post('penerbit', true),
                'tahun_terbit' => $this->input->post('tahun_terbit', true),
                'isbn' => $this->input->post('isbn', true),
                'stok' => $this->input->post('stok', true),
                'dipinjam' => 0,
                'dibooking' => 0,
                'image' => $gambar,
            ];

            $this->ModelBuku->updateBuku([
                $data, [
                    'id' => $this->input->post('id')
                ]
            ]);
            
            $this->session->set_flashdata(
                'pesan',
                "<div class='alert alert-success alert-message' role='alert'>Buku Berhasil Diperbarui</div>"
            );

            redirect(base_url('buku'));
        }


    }
    
    private static function defineDefaultRules(string $key, string $name)
    {
        return [
            $key,
            $name,
            'required|min_length[3]', [
                'required' => '%s harus diisi!',
                'min_length' => '%s terlalu pendek'
            ]
        ];
    }

    private static function defineDefaultRulesWithNumeric(string $key, string $name)
    {
        return [
            $key,
            $name,
            'required|min_length[3]|max_length[4]|numeric', [
                'required' => '%s harus diisi!',
                'min_length' => '%s terlalu pendek',
                'max_length' => '%s terlalu panjang',
                'numeric' => '%s hanya boleh berisikan angka'
            ]
        ];
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
