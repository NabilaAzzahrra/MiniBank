<!-- <link href="<?= base_url('assets/search/') ?>library/bootstrap-5/bootstrap.min.css" rel="stylesheet" /> -->

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12 col-md-8 col-lg-12 order-3 order-md-2">
                <div class="card " style="padding-left: 40px; padding-right: 40px; padding-top: 20px; padding-bottom: 20px;">

                    <table id="dataTable" class="table">
                        <caption class="ms-4">
                            <!-- Total Belum Terbayar : <?= $r->belum_terbayar ?> -->
                        </caption>
                        <thead>
                            <tr>
                                <th>No. Rekening</th>
                                <th class="text-center">Nasabah</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Pinjaman</th>
                                <th class="text-center">Terbayar</th>
                                <!-- <th class="text-center">Actions</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total = 0;
                            foreach ($read as $r) {
                                $total += $r->jumlah_pinjam;
                                if ($r->belum_terbayar == 0) {
                                    $sts = "Sudah";
                                    $bg = "info";
                                } else {
                                    $sts = "Belum";
                                    $bg = "danger";
                                }
                            ?>
                                <tr>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?= $r->no_rekening ?></strong></td>
                                    <td><?= $r->nama_nasabah ?></td>
                                    <td><span class="badge bg-label-<?= $bg ?> me-1"><?= $sts ?></span></td>
                                    <td>
                                        <?= $r->jumlah_pinjam ?>
                                    </td>
                                    <td><?= $r->terbayar ?></td>
                                    <!-- <td class="text-center">
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="<?= base_url('Admin/bayar?id_peminjaman=') ?><?= $r->id_peminjaman ?>"><i class="bx bx-edit-alt me-1"></i> Bayar</a>
                                                <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                                <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                                            </div>
                                        </div>
                                    </td> -->
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <th>
                                Total
                            </th>
                            <th>

                            </th>
                            <th>

                            </th>
                            <th>
                                <?= $total ?>
                            </th>
                            <th>

                            </th>
                            <th>

                            </th>
                            <th>

                            </th>
                        </tfoot>
                    </table>

                    <form action="<?= base_url('Admin/act_bayar') ?>" method="post">
                        <div class="form-group" name="status" hidden>
                            <label>Pembayaran</label>
                            <input type="number" name="id_peminjaman" class="form-control" placeholder="Pembayaran" value="<?= $_GET['id_peminjaman'] ?>">
                        </div>
                        <div class="form-group" name="status">
                            <label>Terbayar</label>
                            <input type="number" name="terbayar" class="form-control" placeholder="Pembayaran" value="<?= $r->terbayar ?>" readonly>
                        </div>
                        <div class="form-group" name="status">
                            <label>Belum Terbayar</label>
                            <input type="number" name="belum_terbayar" class="form-control" placeholder="Pembayaran" value="<?= $r->belum_terbayar ?>" readonly>
                        </div>
                        <div class="form-group" name="status">
                            <label>Pembayaran</label>
                            <input type="number" name="pembayaran" class="form-control" placeholder="Pembayaran">
                        </div>
                        <div class="form-group mt-2">
                            <button class="btn btn-success" type="submit">Simpan</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        <div class="row">
        </div>
    </div>
    <!-- / Content -->
    <script>
        function getNasabah() {
            var kode = $('[name="no_rek"]').val();
            $('#nsbh').load('<?= base_url() ?>Admin/getNasabah/' + kode);
        }
    </script>