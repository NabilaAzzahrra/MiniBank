<!doctype html>
<html lang="en">

<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="<?= base_url('assets/templates/log/') ?>css/style.css">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/templates') ?>/img_sidebar/mkp.png" />

</head>

<body>
    <section class="ftco-section">
        <div class="container">
            <!-- <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <h2 class="heading-section">Login #05</h2>
                </div>
            </div> -->
            <div class="row justify-content-center">
                <div class="col-md-7 col-lg-5">
                    <div class="wrap">

                        <div class="login-wrap p-5 p-md-5">
                            <div class="d-flex">
                                <div class="w-100">
                                    <h3 class="mb-4">Masuk</h3>
                                </div>
                                <div class="w-100">
                                    <!-- <p class="social-media d-flex justify-content-end">
                                        <a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-facebook"></span></a>
                                        <a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-twitter"></span></a>
                                    </p> -->
                                </div>
                            </div>

                            <?php echo $this->session->flashdata('pesan'); ?>

                            <form action="<?= base_url('Auth/login') ?>" class="signin-form" method="post">
                                <div class="form-group mt-5">
                                    <input type="text" class="form-control" name="username" required>
                                    <label class="form-control-placeholder" for="username">Username</label>
                                </div><br>
                                <div class="form-group">
                                    <input id="password-field" type="password" name="password" class="form-control" required>
                                    <label class="form-control-placeholder" for="password">Password</label>
                                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="form-control btn btn-primary rounded submit px-3">Masuk</button>
                                </div>
                                <!-- <div class="form-group d-md-flex">
                                    <div class="w-50 text-md-right">
                                        <a href="#">Lupa Password</a>
                                    </div>
                                </div> -->
                            </form>
                            <p class="text-center">Belum Punya Akun? <a href="<?= base_url('Daftar/index') ?>">Daftar</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="<?= base_url('assets/templates/log/') ?>js/jquery.min.js"></script>
    <script src="<?= base_url('assets/templates/log/') ?>js/popper.js"></script>
    <script src="<?= base_url('assets/templates/log/') ?>js/bootstrap.min.js"></script>
    <script src="<?= base_url('assets/templates/log/') ?>js/main.js"></script>

</body>

</html>