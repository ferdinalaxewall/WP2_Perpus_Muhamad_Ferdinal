<center>
    <div>
        <h3 style="margin-bottom: 0;">Nama Anggota : <?= $useraktif->nama ?></h3>
        <p>Buku yang dibooking:</p>
    </div>
    <div class="table-responsive" style="width: 100%">
        <table border="1" cellpadding="5" style="width: 100%;">
            <tr>
                <th>No.</th>
                <th>Buku</th>
                <th>Penulis</th>
                <th>Penerbit</th>
                <th>Tahun Terbit</th>
            </tr>

            <?php foreach ($items as $index => $item) { ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= $item['judul_buku'] ?></td>
                    <td><?= $item['pengarang'] ?></td>
                    <td><?= $item['penerbit'] ?></td>
                    <td><?= $item['tahun_terbit'] ?></td>
                </tr>
            <?php } ?>
        </table>

        <hr>
        
        <p>
            <?= md5(date('Y-m-d')) ?>
        </p>
    </div>
</center>