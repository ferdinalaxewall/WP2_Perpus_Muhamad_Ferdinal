<?php

defined('BASEPATH') or exit('No Direct Script Access Allowed');
date_default_timezone_set('Asia/Jakarta');


class Booking extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
    }

    public function index()
    {
        $id = ['bo.id_user' => $this->uri->segment(3)];
        $id_user = $this->session->userdata('id');
        $data['booking'] = $this->ModelBooking->joinOrder($id)->result();

        $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        foreach ($user as $a) {
            $data = [
                'image' => $user['image'],
                'user' => $user['nama'],
                'email' => $user['email'],
                'tanggal_input' => $user['tanggal_input']
            ];
        }
        
        $dtb = $this->ModelBooking->showtemp(['id_user' => $id_user])->num_rows();
        if ($dtb < 1) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-massege alert-danger" role="alert">Tidak Ada Buku dikeranjang</div>');
            redirect(base_url());
        } else {
            $data['temp'] = $this->db->query("select image, judul_buku, penulis, penerbit, tahun_terbit,id_buku from temp where id_user='$id_user'")->result_array();
        }

        $data['judul'] = 'Data Booking';

        $this->load->view('landing-page/templates/header', $data);
        $this->load->view('landing-page/booking/data-booking', $data);
        $this->load->view('landing-page/templates/footer', $data);
    }

    public function tambahBooking()
    {
        $id_buku = $this->uri->segment(3);
        $d = $this->db->query("SELECT * FROM buku WHERE id = '{$id_buku}'")->row();

        $isi = [
            'id_buku' => $id_buku,
            'judul_buku' => $d->judul_buku,
            'id_user' => $this->session->userdata('id'),
            'email_user' => $this->session->userdata('email'),
            'tgl_booking' => date('Y-m-d H:i:s'),
            'image' => $d->image,
            'penulis' => $d->pengarang,
            'penerbit' => $d->penerbit,
            'tahun_terbit' => $d->tahun_terbit,
        ];

        $temp = $this->ModelBooking->getDataWhere('temp', ['id_buku' => $id_buku])->num_rows();
        $userId = $this->session->userdata('id');

        $tempUser = $this->db->query("SELECT * FROM temp WHERE id_user = '{$userId}' ")->num_rows();
        $dataBooking = $this->db->query("SELECT * FROM booking WHERE id_user = '{$userId}' ")->num_rows();

        if ($dataBooking > 0 ) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Masih Ada booking buku sebelumnya yang belum diambil.<br> Ambil Buku yang dibooking atau tunggu 1x24 Jam untuk bisa booking kembali </div>');
            redirect(base_url());
        }

        if ($temp > 0) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Buku ini Sudah anda booking </div>');
            redirect(base_url());
        }

        if ($temp == 3) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Booking Buku Tidak Boleh Lebih dari 3</div>');
            redirect(base_url());
        }

        $this->ModelBooking->createTemp();
        $this->ModelBooking->insertData('temp', $isi);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Buku berhasil ditambahkan ke keranjang </div>');
        redirect(base_url());
    }

    public function hapusBooking()
    {
        $id_buku = $this->uri->segment(3);
        $id_user = $this->session->userdata('id');

        $this->ModelBooking->deleteData(['id_buku' => $id_buku], 'temp');
        $kosong = $this->db->query("SELECT * FROM temp WHERE id_user='$id_user'")->num_rows();

        if ($kosong < 1) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-massege alert-danger" role="alert">Tidak Ada Buku dikeranjang</div>');
            redirect(base_url());
        } else {
            redirect(base_url('booking'));
        }
    }

    public function bookingSelesai($where)
    {
        $this->db->query("UPDATE buku, temp SET buku.dibooking= buku.dibooking+1, buku.stok=buku.stok-1 WHERE buku.id=temp.id_buku");
        $this->db->reset_query();

        $tglsekarang = date('Y-m-d');
        $isibooking = [
            'id' => $this->ModelBooking->kodeOtomatis('booking', 'id'),
            'tgl_booking' => $tglsekarang,
            'batas_ambil' => date('Y-m-d', strtotime($tglsekarang . ' + 2 days')),
            'id_user' => $where
        ];

        $this->ModelBooking->insertData('booking', $isibooking);
        $this->ModelBooking->simpanDetail($where);
        $this->ModelBooking->kosongkanData('temp');
        
        redirect(base_url('booking/info'));
    }

    public function info()
    {
        $where = $this->session->userdata('id');

        $data['user'] = $this->session->userdata('nama');
        $data['judul'] = "Selesai Booking";
        $data['useraktif'] = $this->ModelUser->cekData(['id' => $this->session->userdata('id')])->row();
        $data['items'] = $this->db->query("SELECT * FROM booking bo, booking_detail d, buku bu WHERE d.id_booking=bo.id AND d.id_buku=bu.id AND bo.id_user='$where'")->result_array();

        $this->load->view('landing-page/templates/header', $data);
        $this->load->view('landing-page/booking/info-booking', $data);
        $this->load->view('landing-page/templates/footer');
    }

    public function exportToPdf()
    {
        $id_user = $this->session->userdata('id');
        $data['user'] = $this->session->userdata('nama');
        $data['judul'] = "Cetak Bukti Booking";
        $data['useraktif'] = $this->ModelUser->cekData(['id' => $this->session->userdata('id')])->row();
        $data['items'] = $this->db->query("SELECT * FROM booking bo, booking_detail d, buku bu where d.id_booking=bo.id AND d.id_buku=bu.id AND bo.id_user='$id_user'")->result_array();

        $root = $_SERVER['DOCUMENT_ROOT'];
        include "{$root}/vendor/autoload.php";

        $dompdf = new Dompdf\Dompdf();
        $this->load->view('landing-page/booking/bukti-pdf', $data);

        $paper_size = 'A4'; // ukuran kertas
        $orientation = 'landscape'; //tipe format kertas potrait atau landscape
        $html = $this->output->get_output();
        $dompdf->set_paper($paper_size, $orientation);

        //Convert to PDF
        $dompdf->load_html($html);
        $dompdf->render();
        $dompdf->stream("bukti-booking-$id_user.pdf", array('Attachment' => 0));
    }
}