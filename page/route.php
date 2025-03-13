<?php
if (isset($_GET["page"])) {
    switch ($_GET["page"]) {
        case "transaksi_timbangan";
            include "transaksi_timbangan.php";
            break;
        case "report_timbangan";
            include "Report/report_timbangan.php";
            break;
        case "add_data_penduduk";
            include "add_data_penduduk.php";
            break;
        case "dashboard";
            include "dashboard.php";
            break;
        case "pengaturan";
            include "setting/pengaturan.php";
            break;
        case "pengguna";
            include "setting/pengguna.php";
            break;
        case "system_timbangan";
            include "system_timbangan.php";
            break;
        case "penjualan";
            include "penjualan.php";
            break;
        case "transaksi_pembelian";
            include "transaksi_pembelian.php";
            break;
        case "transaksi_penjualan";
            include "transaksi_penjualan.php";
            break;
    }
} else {
    include "dashboard.php";
}