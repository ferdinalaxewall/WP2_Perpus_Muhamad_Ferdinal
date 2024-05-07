
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card">
            <form class="card-body" action="<?= base_url('member/ubahProfil') ?>" method="post" enctype="multipart/form-data">
                <div class="mb-3 row">
                    <label for="nama" class="col-sm-3 col-form-label">
                        Nama Lengkap
                    </label>
                    <div class="col-sm-9">
                        <input type="text" name="nama" id="nama" class="form-control" value="<?= $data['nama'] ?>" required>
                        <?= form_error('nama', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="email" class="col-sm-3 col-form-label">
                        Email
                    </label>
                    <div class="col-sm-9">
                        <input type="email" name="email" id="email" class="form-control" value="<?= $data['email'] ?>" required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="alamat" class="col-sm-3 col-form-label">
                        Alamat
                    </label>
                    <div class="col-sm-9">
                        <textarea name="alamat" id="alamat" rows="5" class="form-control" required><?= $data['alamat']  ?></textarea>
                        <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                </div>
        
                <div class="mb-3 row">
                    <label for="image" class="col-sm-3 col-form-label">
                        Gambar
                    </label>
                    <div class="col-sm-9">
                        <div class="row py-1" style="gap: 10px;">
                            <div class="col-12">
                                <img src="<?= base_url("assets/img/profile/{$data['image']}") ?>" alt="" class="img-thumbnail" onerror="this.src='<?= base_url() ?>/assets/img/default-not-found-image.png'" style="width: 250px;">
                            </div>
                            <div class="col-12">
                                <div class="custom-file">
                                    <input type="file" name="image" id="image" accept="image/*" class="custom-file-input">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        
                <div class="row justify-content-end">
                    <div class="col-sm-9">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a class="btn btn-dark" href="<?= base_url('member/profil') ?>">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>