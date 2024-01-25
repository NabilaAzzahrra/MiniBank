<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12 col-md-8 col-lg-12 order-3 order-md-2">
                <div class="card mb-4 p-4">
                    <form action="<?= base_url('Admin/cari_t_nasabah') ?>" method="get">
                        <div class="row">
                            <div class="col-md-3">
                                <select name="no_rek" class="form-control select2" style="width: 100%;" data-placeholder="Pilih Rekening" onchange="return getNasabah()">
                                    <option value="">--Pilih Rekening--</option>
                                    <?php foreach ($nasabah as $p) { ?>
                                        <option value="<?= $p->no_rekening ?>"><?= $p->no_rekening ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <input type="date" class="form-control" id="searchInput" name="dari" required>
                            </div>
                            <div class="col-md-3">
                                <input type="date" class="form-control" id="searchInput" name="sampai" required>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-danger" id="searchInput">Cari</button>
                            </div>
                        </div>
                    </form>
                </div>
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
                            <thead>
                                <tr>
                                    <th width="5px">No</th>
                                    <th>No Rekening</th>
                                    <th>Tanggal</th>
                                    <th class="text-center">Debit</th>
                                    <th class="text-center">Kredit</th>
                                    <th class="text-center">Saldo</th>
                                    <th class="text-center">ID</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // $no = 1;
                                // $saldo = 0; // Saldo awal
                                // foreach ($read as $r) {
                                //     // Hitung saldo
                                //     $saldo = $saldo + $r->debit - $r->kredit;
                                ?>
                                <tr>
                                    <!-- <td><?= $no++ ?></td>
                                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?= $r->no_rekening ?></strong></td>
                                        <td><?= $r->tanggal ?></td>
                                        <td><?= $r->debit ?></td>
                                        <td><?= $r->kredit ?></td>
                                        <td></td>
                                        <td></td> -->

                                    <td></td>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong></strong></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <?php
                                // }
                                ?>
                            </tbody>
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