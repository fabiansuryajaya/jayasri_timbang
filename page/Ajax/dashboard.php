<?php
extract($_GET);
header('Content-type: application/json; charset=utf-8');
include '../../config/koneksi.php';
include '../../config/fungsi.php';
$year = date('Y');
if ($data == 'total_harga_per_month') {
    // SQL query
    $sql = "SELECT DATE_FORMAT(tgl_masuk, '%Y-%m') AS month, SUM(harga_total) AS total_harga
    FROM tb_weighing_scale
    WHERE tgl_masuk BETWEEN '$year-01-01' AND '$year-12-31' AND mode_timbang='Pengiriman'
    GROUP BY DATE_FORMAT(tgl_masuk, '%Y-%m')
    ORDER BY month";

    $result = mysqli_query($k,$sql);

    $total_harga_per_month = array();

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $total_harga_per_month[$row["month"]] = $row["total_harga"];
        }
    }
    echo json_encode($total_harga_per_month);
}elseif($data == 'tonase_penjualan_harian'){ 
    // SQL query
    $sql = "SELECT 
    DATE(tgl_masuk) AS tanggal, 
    SUM(ABS(timbang1 - timbang2)) AS netto
    FROM 
    tb_weighing_scale
    WHERE mode_timbang='Pengiriman' AND 
    DATE(tgl_masuk) >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)
    GROUP BY 
    DATE(tgl_masuk)
    ORDER BY 
    DATE(tgl_masuk) ASC";

    $result = mysqli_query($k,$sql);

    $data = array();

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
    }
    echo json_encode($data); 
}elseif($data == 'total_penerimaan_per_month'){
    // SQL query
    $sql = "SELECT DATE_FORMAT(tgl_masuk, '%Y-%m') AS month, SUM(ABS(timbang1 - timbang2)) AS netto
    FROM tb_weighing_scale
    WHERE tgl_masuk BETWEEN '$year-01-01' AND '$year-12-31' AND mode_timbang='Penerimaan'
    GROUP BY DATE_FORMAT(tgl_masuk, '%Y-%m')
    ORDER BY month";

    $result = mysqli_query($k,$sql);

    $total_penerimaan_per_month = array();

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $total_penerimaan_per_month[$row["month"]] = $row["netto"];
        }
    }
    echo json_encode($total_penerimaan_per_month);
}elseif($data == 'tonase_penerimaan_harian'){ 
    // SQL query
    $sql = "SELECT 
    DATE(tgl_masuk) AS tanggal, 
    SUM(ABS(timbang1 - timbang2)) AS netto
    FROM 
    tb_weighing_scale
    WHERE mode_timbang='Penerimaan' AND 
    DATE(tgl_masuk) >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)
    GROUP BY 
    DATE(tgl_masuk)
    ORDER BY 
    DATE(tgl_masuk) ASC";
    $result = mysqli_query($k,$sql);
    $data = array();
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
    }
    echo json_encode($data);
}else{

}