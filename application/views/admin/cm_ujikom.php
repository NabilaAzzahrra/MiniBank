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
                            <caption class="ms-4">
                                0 Transaksi Masuk
                            </caption>
                            <thead>
                                <tr>
                                    <th width="5px">No. Rekening</th>
                                    <th>Nama Nasabah</th>
                                    <th class="text-center">Jumlah</th>
                                    <th class="text-center">Tanggal</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong></strong></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                                <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                            <tfoot>
                                <th>
                                    TOTAL
                                </th>
                                <th>

                                </th>
                                <th>
                                    
                                </th>
                                <th>

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