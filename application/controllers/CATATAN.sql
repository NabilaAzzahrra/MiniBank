-- V_JML_NABUNG --
SELECT
    t_nasabah.no_rekening,
    SUM(jumlah) AS saldo
FROM
    `t_nasabah`
    INNER JOIN t_menabung ON t_menabung.no_rekening = t_nasabah.no_rekening
GROUP BY
    t_nasabah.no_rekening;

--  V_JML_NABUNG_NASABAH --
SELECT
    t_nasabah.no_rekening,
    t_nasabah.nama_nasabah,
    v_jml_nabung.saldo
FROM
    `t_nasabah`
    LEFT JOIN v_jml_nabung ON v_jml_nabung.no_rekening = t_nasabah.no_rekening;

-- V_JML_TF--
SELECT
    t_nasabah.no_rekening,
    SUM(jumlah) AS j_tf
FROM
    `t_nasabah`
    LEFT JOIN t_transfer ON t_transfer.no_rekening = t_nasabah.no_rekening
GROUP BY
    t_nasabah.no_rekening;

--  V_JML_TF_NASABAH --
SELECT
    t_nasabah.no_rekening,
    t_nasabah.nama_nasabah,
    v_jml_tf.j_tf
FROM
    `t_nasabah`
    LEFT JOIN v_jml_tf ON v_jml_tf.no_rekening = t_nasabah.no_rekening;

-- V_SALDO_TERSEDIA --
SELECT
    v_jml_nabung_nasabah.*,
    v_jml_tf_nasabah.j_tf,
    (saldo - IF(j_tf IS NULL, 0, j_tf)) AS saldo_tersedia
FROM
    `v_jml_nabung_nasabah`
    INNER JOIN v_jml_tf_nasabah ON v_jml_tf_nasabah.no_rekening = v_jml_nabung_nasabah.no_rekening;

-- V_SALDO_BANK--
SELECT
    (
        SUM(v_saldo_tersedia.saldo_tersedia) - SUM(t_peminjaman.jumlah_pinjam)
    ) + SUM(t_peminjaman.terbayar) AS saldo_bank,
    SUM(t_peminjaman.belum_terbayar) AS belum_terbayar
FROM
    `v_saldo_tersedia`
    LEFT JOIN t_peminjaman ON t_peminjaman.no_rekening = v_saldo_tersedia.no_rekening;

-- V_kredit -- (Failed)
SELECT
    t_menabung.no_rekening,
    t_menabung.tanggal AS tanggal_kredit,
    t_menabung.jumlah AS kredit
FROM
    `t_menabung`
    LEFT JOIN t_transfer ON t_transfer.no_rekening = t_menabung.no_rekening;

-- V_DEBIT --
SELECT
    t_menabung.no_rekening,
    t_menabung.tanggal AS tanggal_debit,
    t_menabung.jumlah AS debit
FROM
    `t_menabung`;

-- V_KREDIT --
SELECT
    t_transfer.no_rekening,
    t_transfer.tanggal AS tanggal_debit,
    t_transfer.jumlah AS debit
FROM
    `t_transfer`;

-- V_DEBIT_KREDIT --
SELECT
    no_rekening,
    tanggal_debit AS tanggal,
    debit,
    0 AS kredit
FROM
    v_debit
UNION
ALL
SELECT
    no_rekening,
    tanggal_kredit AS tanggal,
    0 AS debit,
    kredit
FROM
    v_kredit;

-- V_TF --
SELECT
    no_rekening,
    tanggal,
    jumlah
FROM
    `t_transfer`;

-- V_MENABUNG--
SELECT
    no_rekening,
    tanggal,
    jumlah
FROM
    `t_menabung`;

-- V_PINJAM --
SELECT
    no_rekening,
    tanggal_pinjam,
    jumlah_pinjam
FROM
    `t_peminjaman`;

-- V_BAYAR --
SELECT
    no_rekening,
    tanggal_pembayaran,
    jumlah_bayar
FROM
    `t_pembayaran`
    INNER JOIN t_peminjaman ON t_peminjaman.id_peminjaman = t_pembayaran.id_peminjaman;

-- V_DEBIT_SELURUH --
SELECT
    no_rekening,
    tanggal,
    jumlah AS debit
FROM
    v_menabung
UNION
ALL
SELECT
    no_rekening,
    tanggal_pembayaran AS tanggal,
    jumlah_bayar AS debit
FROM
    v_bayar;

-- V_KREDIT_SELURUH --
SELECT
    no_rekening,
    tanggal,
    jumlah AS kredit
FROM
    v_tf
UNION
ALL
SELECT
    no_rekening,
    tanggal_pinjam AS tanggal,
    jumlah_pinjam AS kredit
FROM
    v_pinjam;

-- V_DEBIT_KREDIT_SELURUH --
SELECT
    no_rekening,
    tanggal,
    debit,
    0 AS kredit
FROM
    v_debit_seluruh
UNION
ALL
SELECT
    no_rekening,
    tanggal,
    0 AS debit,
    kredit
FROM
    v_kredit_seluruh;