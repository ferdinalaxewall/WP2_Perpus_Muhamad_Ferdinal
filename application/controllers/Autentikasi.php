<?php

class Autentikasi extends CI_Controller
{
    public function index()
    {
        if ($this->session->userdata('email')) {
            redirect(base_url('user'));
        }

        $this->form_validation->set_rules('email', 'Alamat Email',
            'required|trim|valid_email', [
            'required' => 'Email Harus diisi!!',
            'valid_email' => 'Email Tidak Benar!!'
        ]);

        $this->form_validation->set_rules('password', 'Password',
            'required|trim', [
            'required' => 'Password Harus diisi'
        ]);

        if ($this->form_validation->run() == false) {
            $data['judul'] = 'Login';
            $data['user'] = '';
            
            $this->load->view('templates/auth_header', $data);
            $this->load->view('autentikasi/login');
            $this->load->view('templates/auth_footer');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $email = htmlspecialchars($this->input->post('email'));
        $password = $this->input->post('password', true);
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
                    ];

                    $this->session->set_userdata($data);

                    if ($user['role_id'] == 1) {
                        redirect(base_url('admin'));
                    } else {
                        if ($user['image'] == 'default.jpg') {
                            $this->session->set_flashdata(
                                'pesan',
                                '<div class="alert alert-info alert-message" role="alert">Silahkan Ubah Profile Anda untuk Ubah Photo Profil</div>'
                            );
                        }

                        redirect(base_url('user'));
                    }
                } else {
                    $this->session->set_flashdata(
                        'pesan',
                        '<div class="alert alert-danger alert-message" role="alert">Password salah!!</div>'
                    );
                    
                    redirect(base_url('autentikasi'));
                }
            } else {
                $this->session->set_flashdata(
                    'pesan',
                    '<div class="alert alert-danger alert-message" role="alert">User belum diaktifasi!!</div>'
                );

                redirect(base_url('autentikasi'));
            }
        } else {
            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-danger alert-message" role="alert">Email tidak terdaftar!!</div>'
            );

            redirect(base_url('autentikasi'));
        }
    }

    public function blok()
    {
        $this->load->view('autentikasi/blok');
    }

    public function gagal()
    {
        $this->load->view('autentikasi/gagal');
    }

    public function logout()
    {
        $data = array(
            'email' => '',
            'role_id' => '',
        );

        $this->session->unset_userdata($data);
        $this->session->sess_destroy();

        redirect(base_url('autentikasi'));
    }
}