<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pustaka Booking - <?= $judul ?></title>

    <link rel="icon" type="image/png" href="<?= base_url('assets/img/logo/') ?>logo-pb.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url(); ?>">Pustaka Booking</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?= base_url(); ?>">Beranda</a>
                    </li>
                    <?php
                        if (!empty($this->session->userdata('email'))) {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('/booking') ?>">Booking <?= $this->ModelBooking->getDataWhere('temp', ['email_user' => $this->session->userdata('email')])->num_rows() ?> Buku</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('/member/profil') ?>">Profil Saya</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('/member/logout') ?>">Logout</a>
                        </li>
                    <?php } else { ?>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('/autentikasi') ?>">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('/autentikasi/registrasi') ?>">Daftar</a>
                        </li> -->

                        <li class="nav-item">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#daftarModal" class="nav-link d-flex align-items-center gap-2">
                                Daftar
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" class="nav-link d-flex align-items-center gap-2">
                                Login
                            </a>
                        </li>
                    <?php } ?>  
                </ul>
            </div>

            <span class="text-light"><?= "Selamat Datang, {$user}" ?></span>
        </div>
    </nav>
    <!-- End Navbar -->

    <!-- Content -->
    <div class="container mt-4">
