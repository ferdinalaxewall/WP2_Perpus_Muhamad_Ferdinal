<div class="container-fluid">
    <div class="row">
        <div class="col-lg-9">
            <?= form_open_multipart('user/ubahprofil') ?>

            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">
                    Email
                </label>
                <div class="col-sm-10">
                    <input type="email" name="email" id="email" class="form-control" value="<?= $user['email'] ?>" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="nama" class="col-sm-2 col-form-label">
                    Nama Lengkap
                </label>
                <div class="col-sm-10">
                    <input type="text" name="nama" id="nama" class="form-control" value="<?= $user['nama'] ?>" required>
                    <?= form_error('nama', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
            </div>

            <div class="form-group row">
                <label for="image" class="col-sm-2 col-form-label">
                    Gambar
                </label>
                <div class="col-sm-10">
                    <div class="row py-1" style="gap: 10px;">
                        <div class="col-12">
                            <img src="<?= base_url("assets/img/profile/{$user['image']}") ?>" alt="" class="img-thumbnail">
                        </div>
                        <div class="col-12">
                            <div class="custom-file">
                                <input type="file" name="image" id="image" accept="image/*" class="custom-file-input">
                                <label for="image" class="custom-file-label">
                                    Pilih File
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row justify-content-end">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a class="btn btn-dark" href="<?= base_url('user') ?>">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>