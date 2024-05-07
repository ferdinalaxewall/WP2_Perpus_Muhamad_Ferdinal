<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="text-center">
            <img src="<?= base_url() . "assets/img/buku/{$buku->image}" ?>" alt="" onerror="this.src='<?= base_url() ?>/assets/img/default-not-found-image.png'" style="height: 250px; object-fit:cover; object-position:center;">      
            <h4 class="my-3">
                <?= $buku->judul_buku ?>
            </h4>
        </div>

        <table class="table table-striped">
            <tr>
                <th>Judul Buku:</th>
                <td><?= $buku->judul_buku ?></td>
                <td>&nbsp;</td>
                <th>Kategori:</th>
                <td><?= $buku->nama_kategori ?></td>
            </tr>
            <tr>
                <th>Penerbit:</th>
                <td><?= $buku->penerbit ?></td>
                <td>&nbsp;</td>
                <th>Dipinjam:</th>
                <td><?= $buku->dipinjam ?></td>
            </tr>
            <tr>
                <th>Tahun Terbit:</th>
                <td><?= substr($buku->tahun_terbit, 0, 4) ?></td>
                <td>&nbsp;</td>
                <th>Dibooking:</th>
                <td><?= $buku->dibooking ?></td>
            </tr>
            <tr>
                <th>ISBN:</th>
                <td><?= $buku->isbn ?></td>
                <td>&nbsp;</td>
                <th>Tersedia:</th>
                <td><?= $buku->stok ?></td>
            </tr>
        </table>

        <div class="d-flex align-items-center justify-content-center flex-wrap gap-2">
            <a href="<?= base_url() . "booking/tambahBooking/{$buku->id}" ?>" class="btn btn-outline-warning btn-sm d-flex align-items-center gap-2">
                <i class="bx bx-cart-alt"></i> Booking
            </a>
            <a href="<?= base_url() ?>" class="btn btn-outline-secondary btn-sm d-flex align-items-center gap-2">
                <i class="bx bx-undo"></i> Kembali 
            </a>
        </div>
    </div>
</div>