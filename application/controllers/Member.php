<?php

class Member extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->_login();
    }

    private function _login()
    {
        $email = htmlspecialchars($this->input->post('email', true));
        $password = $this->input->post('password');

        $user = $this->ModelUser->cekData([
            'email' => $email
        ]);
        
        if ($user->num_rows() > 0) {
            $user = $user->row_array();
            
            if ($user['is_active'] == 1) {
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id'],
                        'id' => $user['id']
                    ];

                    $this->session->set_userdata($data);
                    redirect(base_url('home'));
                } else {
                    $this->session->set_flashdata(
                        'pesan',
                        '<div class="alert alert-danger alert-message" role="alert">Password salah!!</div>'
                    );
                    
                    redirect(base_url('home'));
                }
            } else {
                $this->session->set_flashdata(
                    'pesan',
                    '<div class="alert alert-danger alert-message" role="alert">User belum diaktifasi!!</div>'
                );

                redirect(base_url('home'));
            }
        } else {
            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-danger alert-message" role="alert">Email tidak terdaftar!!</div>'
            );

            redirect(base_url('home'));
        }
    }

    public function logout()
    {
        $data = [
            'id' => '',
            'email' => '',
            'role_id' => '',
        ];

        $this->session->unset_userdata($data);
        $this->session->sess_destroy();

        redirect(base_url());
    }

    public function daftar()
    {
        
        $this->form_validation->set_rules('nama', 'Nama Lengkap',
            'required', [
            'required' => 'Email Harus diisi!!',
        ]);
        $this->form_validation->set_rules('alamat', 'Alamat',
            'required', [
            'required' => 'Email Harus diisi!!',
        ]);
        $this->form_validation->set_rules('email', 'Alamat Email',
            'required|trim|valid_email|is_unique[user.email]', [
            'required' => 'Email Harus diisi!!',
            'valid_email' => 'Email Tidak Benar!!',
            'is_unique' => 'Email sudah terdaftar!'
        ]);

        $this->form_validation->set_rules('password', 'Password',
            'required|trim|min_length[3]|matches[password_confirmation]', [
            'required' => 'Password Harus diisi',
            'matches' => 'Password tidak sama',
            'min_length' => 'Password terlalu pendek    '
        ]);

        $email = $this->input->post('email', true);
        $data = [
            'nama' => htmlspecialchars($this->input->post('nama', true)),
            'alamat' => $this->input->post('alamat', true),
            'email' => htmlspecialchars($email),
            'image' => 'default.jpg',
            'password' => password_hash(
                $this->input->post('password', true),
                PASSWORD_BCRYPT
            ),
            'role_id' => 2,
            'is_active' => 1,
            'tanggal_input' => date(),
        ];

        $this->ModelUser->simpanData($data);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Selamat!! akun anggota anda sudah dibuat.</div>');

        redirect(base_url());
    }

    public function profil()
    {
        $user = $this->ModelUser->cekData([
            'email' => $this->session->userdata('email')
        ])->row();

        $data = [
            'judul' => 'Profil Saya',
            'user' => $user->nama,
            'data' => $user
        ];

        $this->load->view('landing-page/templates/header', $data);
        $this->load->view('landing-page/member/index', $data);
        $this->load->view('landing-page/templates/footer', $data);

    }

    public function ubahProfil()
    {
        $user = $this->ModelUser->cekData([
            'email' => $this->session->userdata('email')
        ])->row_array();

        $data = [
            'judul' => 'Ubah Profil',
            'user' => $user['nama'],
            'data' => $user
        ];

        $this->form_validation->set_rules(
            'nama',
            'Nama Lengkap',
            'required|trim', [
                'required' => '%s Tidak Boleh Kosong'
        ]);

        if (! $this->form_validation->run()) {
            $this->load->view('landing-page/templates/header', $data);
            $this->load->view('landing-page/member/ubah-profile', $data);
            $this->load->view('landing-page/templates/footer', $data);
        } else {
            $dto['nama'] = $this->input->post('nama', true);
            $dto['email'] = $this->input->post('email', true);
            $dto['alamat'] = $this->input->post('alamat', true);
            $upload_image = $_FILES['image']['name'];
            
            if ($upload_image) {
                $config['upload_path'] = './assets/img/profile/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '3000';
                $config['file_name'] = 'pro' . time();
                
                $this->load->library('upload');
                $this->upload->initialize($config);
                
                if ($this->upload->do_upload('image')) {
                    $gambar_lama = $data['data']['image'];

                    if ($gambar_lama != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $gambar_lama);
                    }

                    $dto['image'] = $this->upload->data('file_name');
                } else {
                    $this->session->set_flashdata(
                        'pesan',
                        "<div class='alert alert-danger alert-message' role='alert'>{$this->upload->display_errors()}</div>"
                    );

                    redirect(base_url('member/profil'));
                }
            }

            // Update User Data
            $this->db->where([
                'email' => $this->session->userdata('email')
            ]);
            $this->db->update('user', $dto);

            // Update Session
            $this->session->set_userdata('email', $dto['email']);
            $this->session->set_userdata('name', $dto['name']);

            // Return The Notification Message
            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-success alert-message" role="alert">Profil
                Berhasil diubah </div>'
            );

            redirect(base_url('member/profil'));
        }
    }
}