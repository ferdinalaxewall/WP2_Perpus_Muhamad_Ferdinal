<center>
    <div>
        <h4 class="mb-2">Terima Kasih, <?= $useraktif->nama ?></h4>
        <p>Buku yang ingin anda pinjam adalah sebagai berikut:</p>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th>No.</th>
                <th>Buku</th>
                <th>Penulis</th>
                <th>Penerbit</th>
                <th>Tahun</th>
            </tr>

            <?php foreach($items as $index => $item) { ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td>
                        <img src="<?= base_url("assets/img/buku/{$item['image']}") ?>" class="rounded" alt="No Picture" width="10%" onerror="this.src='<?= base_url('/assets/img/default-not-found-image.png') ?>'">
                    </td>
                    <td>
                        <?= $item['pengarang'] ?>
                    </td>
                    <td>
                        <?= $item['penerbit'] ?>
                    </td>
                    <td>
                        <?= $item['tahun_terbit'] ?>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <div class="d-flex align-items-center justify-content-start gap-2">
        <a href='<?= base_url("booking/exportToPdf/{$this->session->userdata('id')}") ?>' class="btn btn-danger" onclick="information('Waktu Pengambilan Buku 1 x 24 Jam dari Booking')" target="_blank">
            <i class="bx bxs-file-pdf me-2"></i> Cetak PDF
        </a>
    </div>
</center>