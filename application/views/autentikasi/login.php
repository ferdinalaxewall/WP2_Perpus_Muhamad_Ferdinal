<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center align-items-center" style="min-height: 100vh;">

        <div class="col-lg-6 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Halaman Login</h1>
                                </div>

                                <?= $this->session->flashdata('pesan') ?>

                                <form class="user" method="post" action="<?= base_url('autentikasi') ?>">
                                
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user" name="email"
                                            id="exampleInputEmail" aria-describedby="emailHelp" value="<?= set_value('email') ?>"
                                            placeholder="Enter Email Address..." required>

                                        <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>

                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" name="password"
                                            id="exampleInputPassword" placeholder="Password" required>
                                            
                                        <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Masuk
                                    </button>
                                </form>

                                <hr>

                                <div class="text-center">
                                    <a class="small" href="<?= base_url('autentikasi/lupaPassword') ?>">Lupa Password?</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="<?= base_url('autentikasi/registrasi') ?>">Daftar Member!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>