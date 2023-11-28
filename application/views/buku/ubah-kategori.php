<div class="container-fluid">

    <h1 class="h3 mb-0 text-gray-800">Ubah Kategori Buku</h1>
    
    <div class="row mt-3">
        <div class="card col-12">
            <div class="card-body">
                <form action="<?= base_url("buku/ubahKategori/{$category['id_kategori']}") ?>" method="post">
                    <div class="form-group">
                        <label for="kategori" class="form-label">Jenis Kategori</label>
                        <select name="kategori" id="kategori" class="form-control form-control-user" required>
                            <option value="" selected disabled>Pilih Jenis Kategori</option>
                            <?php foreach($category_types as $type) { ?>
                                <option value="<?= $type ?>" <?= $type == $category['nama_kategori'] ? 'selected' : '' ?>>
                                    <?= ucfirst($type) ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>