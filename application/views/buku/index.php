<div class="container-fluid">
    <div class="row">
        <div class="card col-12 px-3 py-2 shadow">
            <div class="table-responsive mt-2">
                <div class="page-header mb-3">
                    <span class="text-primary mt-2"><i class="fas fa-book"></i> Data Buku</span>
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
                        </tr>
                                
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>