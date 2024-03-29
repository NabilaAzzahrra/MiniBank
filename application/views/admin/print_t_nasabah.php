<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Dokumen</title>
    <style>
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #FAFAFA;
            font: 12pt "Tahoma";
        }

        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .page {
            width: 135mm;
            min-height: 190mm;
            /* padding: 0mm; */
            /* margin-top: 12,5mm; */
            margin: 10mm auto;
            border: 1px #D3D3D3 solid;
            border-radius: 5px;
            background: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .subpage {
            padding: 1cm;
            border: 5px red solid;
            height: 257mm;
            outline: 2cm #FFEAEA solid;
        }

        td {
            padding-top: 5px;
            text-align: center;
        }

        @page {
            size: A4;
            margin: 0;
        }

        @media print {

            html,
            body {
                width: 210mm;
                height: 297mm;
            }

            .page {
                margin: 0;
                /* padding-top: 12,5mm; */
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
            }
        }
    </style>
</head>

<body>
    <div class="book">
        <div class="page" id="result"></div>

    </div>
    <script>
        let text = "";
        let tanggal = new Date().getDate();
        let getBulan = new Date().getMonth();
        let bulan;
        let tahun = new Date().getFullYear();
        switch (getBulan) {
            case 0:
                bulan = "Januari";
                break;
            case 1:
                bulan = "Februari";
                break;
            case 2:
                bulan = "Maret";
                break;
            case 3:
                bulan = "April";
                break;
            case 4:
                bulan = "Mei";
                break;
            case 5:
                bulan = "Juni";
                break;
            case 6:
                bulan = "Juli";
                break;
            case 7:
                bulan = "Agustus";
                break;
            case 8:
                bulan = "September";
                break;
            case 9:
                bulan = "Oktober";
                break;
            case 10:
                bulan = "November";
                break;
            case 11:
                bulan = "Desember";
                break;
            default:
                bulan = "Tidak ditemukan";
                break;
        }
        const profile = [{
            fname: "Uzumaki",
            lname: "Naruto",
            level: "Genin",
            nationality: "Konoha Gakure"
        }]
        profile.forEach(element => {
            text += `
            <?php
            $no = 1;
            $saldo = 0; // Saldo awal
            foreach ($read as $r) {
                $saldo = $saldo + $r->debit - $r->kredit;
            ?>
            <table>
                <tr>
                    <td width="40.76 px" height="40.04 px"><?= $no++ ?></td>
                    <td width="100.76 px"><?= $t->tanggal ?></td>
                    <td width="40.76 px">-</td>
                    <td width="90.76 px"><?= $r->debit ?></td>
                    <td width="90.76 px"><?= $r->kredit ?></td>
                    <td width="100.76 px"><?= $saldo ?></td>
                    <td width="40.76 px">-</td>
                </tr>
            </table>
            <?php
            }
            ?>
      `;
        });
        let sekarang = `${tanggal} ${bulan} ${tahun}`;
        document.getElementById('result').innerHTML = text;
        // document.getElementById('tanggal').innerHTML = sekarang;
    </script>
</body>

</html> -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Dokumen</title>
    <style>
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #FAFAFA;
            font: 12pt "Tahoma";
        }

        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .page {
            width: 135mm;
            min-height: 190mm;
            /* padding: 0mm; */
            /* margin-top: 12,5mm; */
            margin: 10mm auto;
            border: 1px #D3D3D3 solid;
            border-radius: 5px;
            background: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .subpage {
            padding: 1cm;
            border: 5px red solid;
            height: 257mm;
            outline: 2cm #FFEAEA solid;
        }

        td {
            padding-top: 0px;
            text-align: center;
        }

        @page {
            size: A4;
            margin: 0;
        }

        @media print {

            html,
            body {
                width: 210mm;
                height: 297mm;
            }

            .page {
                margin: 0;
                /* padding-top: 12,5mm; */
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
            }
        }
    </style>
</head>

<body>
    <div class="book">
        <?php
        // $no = 1;
        // $saldo = 0; // Saldo awal
        // foreach ($read as $r) {
        //     $saldo = $saldo + $r->debit - $r->kredit;
        ?>
        <div class="page" id="result">
            <table>
                <?php
                $no = 1;
                $saldo = 0; // Saldo awal
                foreach ($read as $r) {
                    $saldo = $saldo + $r->debit - $r->kredit;
                ?>
                    <tr>
                        <td width="40.76px" height="20.04px"><?= $no++ ?></td>
                        <td width="100.76px"><?= $r->tanggal ?></td>
                        <td width="40.76px">-</td>
                        <td width="90.76px"><?= $r->debit ?></td>
                        <td width="90.76px"><?= $r->kredit ?></td>
                        <td width="100.76px"><?= $saldo ?></td>
                        <td width="40.76px">-</td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
        <?php
        // }
        ?>
    </div>
    <script>
        /* Your JavaScript code here */
    </script>
</body>

</html>