    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Jumlah Anggota Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Jumlah Anggota
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?= $this->ModelUser->getUserWhere(['role_id' => 1])->num_rows() ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <a href="<?= base_url('user/anggota') ?>">
                                    <i class="fa fa-users fa-2x text-gray-300"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stok Buku Terdaftar Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Stok Buku Terdaftar
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?= $this->ModelBuku->total('stok', ['stok != 0']) ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <a href="<?= base_url('buku') ?>">
                                    <i class="fas fa-book fa-2x text-gray-300"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Buku yang Dipinjam Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Buku yang Dipinjam
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?= $this->ModelBuku->total('dipinjam', ['dipinjam != 0']) ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <a href="<?= base_url('user') ?>">
                                    <i class="fas fa-user-tag fa-2x text-gray-300"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Buku yang Dibooking Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Buku yang Dibooking
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?= $this->ModelBuku->total('dibooking', ['dibooking != 0']) ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <a href="<?= base_url('user') ?>">
                                    <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Row -->

        <div class="row px-2" style="row-gap: 15px;">
            <!-- Data User -->
            <div class="card col-12 px-3 py-2 shadow">
                <div class="table-responsive mt-2">
                    <div class="page-header mb-3">
                        <span class="text-primary mt-2"><i class="fas fa-user"></i> Data User</span>
                        <a href="<?= base_url('user/data_user') ?>" class="text-danger ml-3">
                            <i class="fas fa-search mt-2 float-right"></i> Tampilkan
                        </a>
                    </div>
    
                    <table class="table mt-3 default-dataTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Anggota</th>
                                <th>Email</th>
                                <th>Role ID</th>
                                <th>Aktif</th>
                                <th>Member Sejak</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($members as $index => $member) { ?>
    
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= $member['nama'] ?></td>
                                <td><?= $member['email'] ?></td>
                                <td><?= $member['role_id'] ?></td>
                                <td><?= $member['is_active'] ? 'Aktif' : 'Non-Aktif' ?></td>
                                <td>hehe</td>
                            </tr>
                                    
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Data Buku -->
            <div class="card col-12 px-3 py-2 shadow">
                <div class="table-responsive mt-2">
                    <div class="page-header mb-3">
                        <span class="text-primary mt-2"><i class="fas fa-book"></i> Data Buku</span>
                        <a href="<?= base_url('buku') ?>" class="text-danger ml-3">
                            <i class="fas fa-search mt-2 float-right"></i> Tampilkan
                        </a>
                    </div>
    
                    <table class="table mt-3 default-dataTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Judul Buku</th>
                                <th>Pengarang</th>
                                <th>Penerbit</th>
                                <th>Tahun Terbit</th>
                                <th>ISBN</th>
                                <th>Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach ($books as $index => $book) {
                            ?>
    
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= $book['judul_buku'] ?></td>
                                <td><?= $book['pengarang'] ?></td>
                                <td><?= $book['penerbit'] ?></td>
                                <td><?= $book['tahun_terbit'] ?></td>
                                <td><?= $book['isbn'] ?></td>
                                <td><?= $book['stok'] ?></td>
                            </tr>
                                    
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->