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
                                    <a class="btn btn-primary" href="<?= base_url('Admin/t_transfer') ?>">Tambah</a>
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
                                List of Projects
                            </caption> -->
                            <thead>
                                <tr>
                                    <th width="5px">No</th>
                                    <th class="text-center">No. Rekening</th>
                                    <th class="text-center">Nasabah</th>
                                    <th class="text-center">Jenis Tabungan</th>
                                    <th class="text-center">No. Rekening tujuan</th>
                                    <!-- <th class="text-center">Nasabah</th> -->
                                    <!-- <th class="text-center">Jenis Tabungan Tujuan</th> -->
                                    <th class="text-center">Jumlah</th>
                                    <th class="text-center">Tanggal</th>
                                    <!-- <th class="text-center">Action</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $total = 0;
                                foreach ($read as $r) {
                                    $total += $r->jumlah;
                                ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $r->no_rekening ?></td>
                                        <td><?= $r->nama_nasabah ?></td>
                                        <td><?= $r->jenis_tabungan ?></td>
                                        <td><?= $r->no_rek_dituju ?></td>
                                        <!-- <td><?= $r->nama_nasabah ?></td> -->
                                        <!-- <td><?= $r->jenis_tabungan_dituju ?></td> -->
                                        <td><?= $r->jumlah ?></td>
                                        <td><?= $r->tanggal ?></td>
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

                                </th>
                                <th>

                                </th>
                                <th>
                                    <?= $total ?>
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