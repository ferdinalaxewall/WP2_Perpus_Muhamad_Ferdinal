<?= $this->session->flashdata('pesan') ?>

<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="d-flex border flex-wrap shadow-sm rounded">
            <div class="col-md-5">
                <img src="<?= base_url("assets/img/profile/{$data->image}") ?>" onerror="this.src='<?= base_url() ?>/assets/img/default-not-found-image.png'" alt="" class="w-100 h-100" style='object-fit: cover; object-position: center;'>
            </div>
            <div class="col-md-7">
                <div class="p-3 d-flex flex-column justify-content-center h-100">
                    <h3 class="mb-1"><?= $data->nama ?></h3>
                    <h5 class='mb-3'><?= $data->email ?></h5>
    
                    <p class="text-muted mb-0">Jadi member sejak:</p>
                    <p>
                        <strong><?= date('d F Y', strtotime($data->tanggal_input)) ?></strong>
                    </p>

                    <a href="<?= base_url('member/ubahProfil') ?>" class="btn btn-primary">
                        <i class="bx bx-edit-alt"></i> Ubah Profil
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>