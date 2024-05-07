<?= $this->session->flashdata('pesan') ?>

<div class="row" style="row-gap: 15px;">
    <?php foreach($buku as $item) { ?>
        <div class="col-md-3">
            <div class="card">
                <img src="<?= base_url() . "assets/img/buku/{$item->image}" ?>" alt="" class="card-img-top" onerror="this.src='<?= base_url() ?>/assets/img/default-not-found-image.png'">
                <div class="card-body">
                    <h5 class="card-title"><?= $item->judul_buku ?></h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>

                    <div class="d-flex align-items-center justify-content-center flex-wrap gap-2">
                        <a href="<?= base_url() . "booking/tambahBooking/{$item->id}" ?>" class="btn btn-outline-warning btn-sm d-flex align-items-center gap-2">
                            <i class="bx bx-cart-alt"></i> Booking
                        </a>
                        <a href="<?= base_url() . "/home/detailbuku/{$item->id}" ?>" class="btn btn-outline-primary btn-sm d-flex align-items-center gap-2">
                            <i class="bx bx-search-alt"></i> Lihat Detail 
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>