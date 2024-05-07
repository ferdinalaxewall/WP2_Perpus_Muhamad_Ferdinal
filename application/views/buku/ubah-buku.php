<div class="container-fluid">

    <h1 class="h3 mb-0 text-gray-800">Ubah Buku</h1>
    
    <div class="row mt-3">
        <div class="card col-12">
            <div class="card-body">
                <?= form_open_multipart(base_url('buku/ubahbuku/' .  $book['id'])) ?>
                    
                    <div class="form-group">
                        <label for="judul_buku" class="form-label">Judul Buku</label>
                        <input type="text" name="judul_buku" id="judul_buku" placeholder="Masukkan Judul Buku" value="<?= $book['judul_buku'] ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="image" class="form-label">Gambar Buku</label>
                        <div class="col-12">
                            <img src="<?= base_url("assets/img/buku/{$book['image']}") ?>" alt="" class="img-thumbnail">
                        </div>
                        <input type="file" name="image" id="image" placeholder="Masukkan Gambar Buku" class="form-control" accept="image/*" required>
                    </div>
                    <div class="form-group">
                        <label for="id_kategori" class="form-label">Kategori Buku</label>
                        <select name="id_kategori" id="id_kategori" class="form-control form-control-user" required>
                            <option value="" disabled>Pilih Kategori Buku</option>
                            <?php foreach($categories as $category) { ?>
                                <option value="<?= $category['id_kategori'] ?>" <?php $category['id_kategori'] == $book['id_kategori'] ? 'selected' : ''; ?>>
                                    <?= ucfirst($category['nama_kategori']) ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="pengarang" class="form-label">Nama Pengarang</label>
                        <input type="text" name="pengarang" id="pengarang" placeholder="Masukkan Nama Pengarang" value="<?= $book['pengarang'] ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="penerbit" class="form-label">Nama Penerbit</label>
                        <input type="text" name="penerbit" id="penerbit" placeholder="Masukkan Nama Penerbit" value="<?= $book['penerbit'] ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                        <select name="tahun_terbit" id="tahun_terbit" class="form-control form-control-user" required>
                            <?php for($i = date('Y'); $i > 1800; $i--) { ?>
                                <option value="<?= $i ?>" <?php $book['tahun_terbit'] == $i ? 'selected' : ''; ?>>
                                    <?= $i ?>
                                </option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="isbn" class="form-label">Nomor ISBN</label>
                        <input type="number" name="isbn" id="isbn" placeholder="Masukkan Nomor ISBN" value="<?= $book['isbn'] ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="stok" class="form-label">Stok</label>
                        <input type="number" name="stok" id="stok" placeholder="Masukkan Stok" value="<?= $book['stok'] ?>" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i> Simpan Perubahan
                        </button>
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>