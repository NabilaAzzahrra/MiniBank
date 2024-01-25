<!-- <link href="<?= base_url('assets/search/') ?>library/bootstrap-5/bootstrap.min.css" rel="stylesheet" /> -->

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12 col-md-8 col-lg-12 order-3 order-md-2">
                <div class="card " style="padding-left: 40px; padding-right: 40px; padding-top: 20px; padding-bottom: 20px;">
                    <form action="<?= base_url('Admin/act_pinjam') ?>" method="post">
                        <!-- <div class="mb-2">
                            <label for="exampleFormControlInput1" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                        </div> -->
                        <div class="form-group">
                            <label>No Rekening</label>
                            <select name="no_rek" class="form-control select2" style="width: 100%;" data-placeholder="Pilih Rekening" onchange="return getNasabah()">
                                <option value="">--PILIH--</option>
                                <?php foreach ($nasabah as $p) { ?>
                                    <option value="<?= $p->no_rekening ?>"><?= $p->no_rekening ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div id="nsbh">
                            <!-- <div class="mb-2">
                                <label for="exampleFormControlInput1" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                            </div> -->
                            <div class="form-group" name="nasabah">
                                <label>Nasabah</label>
                                <input type="text" name="nama_nasabah" class="form-control" placeholder="Nama Nasabah" readonly>
                            </div>
                            <div class="form-group" name="no_wa">
                                <label>No WA</label>
                                <input type="text" name="no_wa" class="form-control" placeholder="No WA" readonly>
                            </div>
                            <div class="form-group" name="email">
                                <label>Email</label>
                                <input type="text" name="email" class="form-control" placeholder="Email" readonly>
                            </div>
                            <div class="form-group" name="jenis_tabungan">
                                <label>Jenis Tabungan</label>
                                <input type="text" name="jenis_tabungan" class="form-control" placeholder="Jenis Tabungan" readonly>
                            </div>
                            <div class="form-group" name="status">
                                <label>Status</label>
                                <input type="text" name="status" class="form-control" placeholder="Status" readonly>
                            </div>
                        </div>
                       
                        <div class="form-group" name="status">
                            <label>Jumlah Pinjam</label>
                            <input type="number" name="jumlah_pinjam" class="form-control" placeholder="Jumlah Pinjam">
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