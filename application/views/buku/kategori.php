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
                    <span class="text-primary mt-2"><i class="fas fa-tag"></i> Data Kategori Buku</span>
                    <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addCategoryModal">
                        <i class="fa fa-plus"></i>
                        Tambah Kategori
                    </a>
                </div>

                <table class="table table-hover mt-3 default-dataTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Kategori</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($categories as $index => $category) {
                        ?>

                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= $category['nama_kategori'] ?></td>
                            <td>
                                <a href="<?= base_url('buku/ubahKategori/') . $category['id_kategori'] ?>" class="btn btn-info btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="<?= base_url('buku/hapusKategori/') . $category['id_kategori'] ?>" class="btn btn-danger btn-sm"
                                onclick="return confirm('Apakah kamu yakin akan menghapus <?= $judul . ' ' . $category['nama_kategori'] ?>?')">
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

 <!-- Add Category Modal-->
 <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="<?= base_url('buku/kategori') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="kategori" class="form-label">Jenis Kategori</label>
                        <select name="kategori" id="kategori" class="form-control form-control-user" required>
                            <option value="" selected disabled>Pilih Jenis Kategori</option>
                            <?php foreach($category_types as $type) { ?>
                                <option value="<?= $type ?>"><?= ucfirst($type) ?></option>
                            <?php } ?>
                        </select>
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