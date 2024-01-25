<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12 col-md-8 col-lg-12 order-3 order-md-2">
                <div class="card">
                    <h5 class="card-header">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="col-md-9">
                                    <a class="btn btn-primary" href="<?= base_url('Admin/t_peminjaman') ?>">Tambah</a>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="searchInput" placeholder="Search...">
                            </div>
                        </div>

                    </h5>
                    <div class="table-responsive text-nowrap">
                        <table id="dataTable" class="table">
                            <!-- <caption class="ms-4">
                                Total Belum Terbayar : 100.000
                            </caption> -->
                            <thead>
                                <tr>
                                    <th>No. Rekening</th>
                                    <th class="text-center">Nasabah</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Pinjaman</th>
                                    <th class="text-center">Terbayar</th>
                                    <th class="text-center">Belum dibayar</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total = 0;
                                $t_terbayar = 0;
                                $tb_terbayar = 0;
                                $belum_dibayar = 0;
                                foreach ($read as $r) {
                                    $total += $r->jumlah_pinjam;
                                    $t_terbayar += $r->terbayar;
                                    $tb_terbayar += $r->belum_terbayar;
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
                                        <td><span class="badge bg-label-danger me-1"><?= $sts ?></span></td>
                                        <td>
                                            <?= $r->jumlah_pinjam ?>
                                        </td>
                                        <td><?= $r->terbayar ?></td>
                                        <td class="text-left"><?= $r->belum_terbayar ?></td>
                                        <td class="text-center">
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
                                        </td>
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
                                    <?= $t_terbayar ?>
                                </th>
                                <th>
                                    <?= $tb_terbayar ?>
                                </th>
                                <th>

                                </th>
                            </tfoot>
                        </table>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
        </div>
    </div>
    <!-- / Content -->
    <script>
        const searchInput = document.getElementById('searchInput');
        const dataTable = document.getElementById('dataTable');

        searchInput.onkeyup = function() {
            const searchTerm = searchInput.value.toLowerCase();

            for (let i = 1; i < dataTable.rows.length; i++) {
                const row = dataTable.rows[i];
                const rowData = row.textContent.toLowerCase();

                if (rowData.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            }
        };
    </script>