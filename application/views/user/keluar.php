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

                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="searchInput" placeholder="Search...">
                            </div>
                        </div>

                    </h5>
                    <div class="table-responsive text-nowrap">
                        <table id="dataTable" class="table">
                            <!-- <caption class="ms-4">
                                2 Transaksi Cash Keluar
                            </caption> -->
                            <thead>
                                <tr>
                                    <th width="5px">No</th>
                                    <th>Tanggal</th>
                                    <th class="text-center">Debit</th>
                                    <th class="text-center">Kredit</th>
                                    <th class="text-center">Saldo</th>
                                    <th class="text-center">ID</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $saldo = 0; // Saldo awal
                                foreach ($read as $r) {
                                    // Hitung saldo
                                    $saldo = $saldo + $r->debit - $r->kredit;
                                ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?= $r->tanggal ?></strong></td>
                                        <td><?= $r->debit ?></td>
                                        <td><?= $r->kredit ?></td>
                                        <td><?= $saldo ?></td>
                                        <td></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                            <!-- <tfoot>
                                <th>
                                    TOTAL
                                </th>
                                <th>

                                </th>
                                <th>
                                    200.000
                                </th>
                                <th>

                                </th>
                                <th>

                                </th>
                            </tfoot> -->
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