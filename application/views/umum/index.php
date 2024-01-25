<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title><?= $title ?></title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/templates') ?>/img_sidebar/mkp.png" />

    <!-- Icons font CSS-->
    <link href="<?= base_url('assets/templates/regis/') ?>vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="<?= base_url('assets/templates/regis/') ?>vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="<?= base_url('assets/templates/regis/') ?>vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="<?= base_url('assets/templates/regis/') ?>vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="<?= base_url('assets/templates/regis/') ?>css/main.css" rel="stylesheet" media="all">
    <style>
        .card {
            margin-left: 10px;
            margin-right: 10px;
        }

        .bg-gra-03 {
            /* background: -webkit-gradient(linear, left bottom, right top, from(#08aeea), to(#b721ff));
            background: -webkit-linear-gradient(bottom left, #08aeea 0%, #b721ff 100%);
            background: -moz-linear-gradient(bottom left, #08aeea 0%, #b721ff 100%);
            background: -o-linear-gradient(bottom left, #08aeea 0%, #b721ff 100%); */
            background: linear-gradient(to top right, #e8edb7 0%, #aaf9b0 100%);
        }

        .form-row {
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-flex-wrap: wrap;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            -webkit-box-align: center;
            -webkit-align-items: center;
            -moz-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <div class="page-wrapper bg-gra-03 p-t-45 p-b-50">
        <div class="wrapper wrapper--w790">
            <div class="card card-5">
                <div class="card-heading">
                    <h5 class="title">Pendaftaran Akun</h5>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('Daftar/add_daftar') ?>" enctype="multipart/form-data" method="POST">
                        <?php
                        $this->load->model('Models', 'm');
                        $kode_barang = $this->m->CreateCode();
                        ?>
                        <div class="form-row" hidden>
                            <div class="name" hidden >No Rekening</div>
                            <div class="value"  hidden>
                                <div class="input-group" hidden>
                                    <input class="input--style-5" type="text" name="no_rek" value="<?= $kode_barang; ?>">
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="name">Nama Lengkap</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="name">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Username</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="username">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Password</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="password">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Profile</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="file" name="foto">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">No WA</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="number" name="no_wa" placeholder="6281******">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Email</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="email" name="email">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Jenis Tabungan</div>
                            <div class="value">
                                <div class="input-group">
                                    <div class="rs-select2 js-select-simple select--no-search">
                                        <select name="jenis_tabungan">
                                            <option disabled="disabled" selected="selected">Pilih Jenis Tabungan</option>
                                            <option value="umum">Umum</option>
                                            <option value="ujikom">Uji Kompetensi</option>
                                            <option value="kurban">Kurban</option>
                                        </select>
                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button class="btn btn--radius-2 btn--green" type="submit">Daftar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="<?= base_url('assets/templates/regis/') ?>vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="<?= base_url('assets/templates/regis/') ?>vendor/select2/select2.min.js"></script>
    <script src="<?= base_url('assets/templates/regis/') ?>vendor/datepicker/moment.min.js"></script>
    <script src="<?= base_url('assets/templates/regis/') ?>vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="<?= base_url('assets/templates/regis/') ?>js/global.js"></script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->