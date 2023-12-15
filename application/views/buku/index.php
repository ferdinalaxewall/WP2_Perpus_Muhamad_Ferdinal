<div class="container-fluid">
    <?= $this->session->flashdata('pesan') ?>

    <div class="row">
        <div class="card col-12 px-3 py-2 shadow">

            <?php if (validation_errors()) { ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors() ?>
                </div>
            <?php } ?>

            <div class="table-responsive mt-2">
                <div class="page-header mb-3 d-flex align-items-center justify-content-between">
                    <span class="text-primary mt-2"><i class="fas fa-tag"></i> Data Buku</span>
                    <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addBookModal">
                        <i class="fa fa-plus"></i>
                        Tambah Buku
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
                            <th>Action</th>
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
                            <td>
                                <a href="<?= base_url('buku/ubahBuku/') . $book['id'] ?>" class="btn btn-info btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="<?= base_url('buku/hapusBuku/') . $book['id'] ?>" class="btn btn-danger btn-sm"
                                onclick="return confirm('Apakah kamu yakin akan menghapus <?= $judul . ' ' . $book['judul_buku'] ?>?')">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                                
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


 <!-- Add Book Modal-->
 <div class="modal fade" id="addBookModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Buku</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="<?= base_url('buku') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="judul_buku" class="form-label">Judul Buku</label>
                        <input type="text" name="judul_buku" id="judul_buku" placeholder="Masukkan Judul Buku" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="image" class="form-label">Gambar Buku</label>
                        <input type="file" name="image" id="image" placeholder="Masukkan Gambar Buku" accept="image/*" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="id_kategori" class="form-label">Kategori Buku</label>
                        <select name="id_kategori" id="id_kategori" class="form-control form-control-user" required>
                            <option value="" selected disabled>Pilih Kategori Buku</option>
                            <?php foreach($categories as $category) { ?>
                                <option value="<?= $category['id_kategori'] ?>"><?= ucfirst($category['nama_kategori']) ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="pengarang" class="form-label">Nama Pengarang</label>
                        <input type="text" name="pengarang" id="pengarang" placeholder="Masukkan Nama Pengarang" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="penerbit" class="form-label">Nama Penerbit</label>
                        <input type="text" name="penerbit" id="penerbit" placeholder="Masukkan Nama Penerbit" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                        <select name="tahun_terbit" id="tahun_terbit" class="form-control form-control-user" required>
                            <?php for($i = date('Y'); $i > 1800; $i--) { ?>
                                <option value="<?= $i ?>"><?= $i ?></option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="isbn" class="form-label">Nomor ISBN</label>
                        <input type="number" name="isbn" id="isbn" placeholder="Masukkan Nomor ISBN" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="stok" class="form-label">Stok</label>
                        <input type="number" name="stok" id="stok" placeholder="Masukkan Stok" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-plus-circle"></i> Tambah
                    </button>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>