<center>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th>No.</th>
                <th>Buku</th>
                <th>Penulis</th>
                <th>Penerbit</th>
                <th>Tahun</th>
                <th class="text-center">Aksi</th>
            </tr>

            <?php foreach($temp as $index => $item) { ?>
            <tr>
                <td><?= $index + 1 ?></td>
                <td>
                    <img src="<?= base_url("assets/img/buku/{$item['image']}") ?>" class="rounded" alt="No Picture" width="10%" onerror="this.src='<?= base_url('/assets/img/default-not-found-image.png') ?>'">
                </td>
                <td>
                    <?= $item['penulis'] ?>
                </td>
                <td>
                    <?= $item['penerbit'] ?>
                </td>
                <td>
                    <?= $item['tahun_terbit'] ?>
                </td>
                <td>
                    <div class="d-flex align-items-center justify-content-center flex-wrap">
                        <a href="<?= base_url("booking/hapusBooking/{$item['id_buku']}") ?>" onclick='confirm("Apakah anda yakin ingin menghapus buku " . $item["judul_buku"] . "dari daftar Booking Anda?")' class="btn btn-sm btn-outline-danger btn-icon">
                            <i class="bx bx-trash"></i>
                        </a>
                    </div>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>


    <div class="d-flex align-items-center justify-content-start flex-wrap gap-2">
        <a href="<?= base_url() ?>" class="btn btn-sm btn-primary">
            <i class="bx bx-left-arrow-alt"></i> Pilih Buku Lainnya
        </a>
        <a href='<?= base_url("booking/bookingSelesai/{$this->session->userdata("id")}") ?>' class="btn btn-sm btn-success">
            <i class="bx bx-right-arrow-alt"></i> Selesaikan Booking
        </a>
    </div>
</center>