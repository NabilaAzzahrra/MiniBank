<style>
    .text-seagreen {
        color: seagreen;
    }

    .alert-success {
        background-color: rgb(232 250 223) !important
    }

    .yuhu {
        color: #318c59;
        ;
    }
</style>
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
<?php
                                foreach ($saldo as $s) {
                                }
                                ?>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="alert alert-success mb-4" role="alert" style="color: black;">
            Selamat Datang <b class="yuhu"><?= $this->session->userdata('name') ?></b>
        </div>
        <div class="row">
            <div class="col-lg-12 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-seagreen">MKP DIGI BANK</h5>
                                <p class="mb-4">
                                    Kamu telah memasuki halaman <span class="fw-bold">MKP DIGI BANK</span>, silahkan cek semua data anda.
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img src="<?= base_url('assets/templates') ?>/assets/img/illustrations/man-with-laptop-light.png" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between pb-0">
                        <div class="card-title mb-10">
                            <h5 class="m-0 me-2">Tabungan</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="p-0 m-0">
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-info"><i class="bx bx-user"></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Umum</h6>
                                        <small class="text-muted">Tabungan yang disediakan khusus untuk Umum</small>
                                    </div>
                                    <?php
                                    foreach ($umum as $u) {
                                        if ($u->jumlah > 0) {
                                            $um = $u->jumlah;
                                        } else {
                                            $um = 0;
                                        }
                                    }
                                    ?>
                                    <div class="user-progress">
                                        <small class="fw-semibold">Rp <?=number_format($s->saldo_tersedia)?></small>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--/ Order Statistics -->
            <!--/ Total Revenue -->
            <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
                <div class="row">
                    <div class="col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="<?= base_url('assets/templates') ?>/assets/img/icons/unicons/paypal.png" alt="Credit Card" class="rounded" />
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn p-0" type="button" id="cardOpt4" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                                            <a class="dropdown-item" href="javascript:void(0);">Selengkapnya</a>
                                            <!-- <a class="dropdown-item" href="javascript:void(0);">Delete</a> -->
                                        </div>
                                    </div>
                                </div>
                                <?php
                                foreach ($pembayaran as $p) {
                                }
                                ?>
                                <span class="d-block mb-1">Pembayaran</span>
                                <h3 class="card-title text-nowrap mb-2">Rp <?= number_format($p->jumlah) ?></h3>
                                <!-- <small class="text-danger fw-semibold"><i class="bx bx-down-arrow-alt"></i> 0,1%</small> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="<?= base_url('assets/templates') ?>/assets/img/icons/unicons/cc-primary.png" alt="Credit Card" class="rounded" />
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                            <a class="dropdown-item" href="javascript:void(0);">Selengkapnya</a>
                                            <!-- <a class="dropdown-item" href="javascript:void(0);">Delete</a> -->
                                        </div>
                                    </div>
                                </div>
                                <?php
                                foreach ($transfer as $tf) {
                                }
                                ?>
                                <span class="d-block mb-1">Transfer</span>
                                <h3 class="card-title mb-2">Rp <?= number_format($tf->jumlah) ?></h3>
                                <!-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.14%</small> -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="row"> -->
                <div class="row">
                    <div class="col-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded bg-label-info"><i class=" bx bx-dollar-circle"></i></span>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn p-0" type="button" id="cardOpt4" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                                            <a class="dropdown-item" href="javascript:void(0);">Selengkapnya</a>
                                            <!-- <a class="dropdown-item" href="javascript:void(0);">Delete</a> -->
                                        </div>
                                    </div>
                                </div>
                                
                                <span class="d-block mb-1">Saldo</span>
                                <h3 class="card-title text-nowrap mb-2">Rp <?=number_format($s->saldo_tersedia)?></h3>
                                <!-- <small class="text-danger fw-semibold"><i class="bx bx-down-arrow-alt"></i> 0,1%</small> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- / Content -->