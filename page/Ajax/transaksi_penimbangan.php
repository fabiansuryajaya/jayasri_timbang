<?php
extract($_POST);
include '../../config/koneksi.php';
include '../../config/fungsi.php';
if ($btn == 'view') {
    $x = mysqli_fetch_array(mysqli_query($k, "SELECT * FROM tb_weighing_scale WHERE id='$id'"));
?>
    <ul class="nav nav-pills nav-secondary nav-pills-no-bd" id="pills-tab-without-border" role="tablist">
        <li class="nav-item">
            <a class="nav-link  active show" id="pills-home-tab-nobd" data-toggle="pill" href="#pills-home-nobd" role="tab"
                aria-controls="pills-home-nobd" aria-selected="false">Data</a>
        </li>
        <li class="nav-item submenu">
            <a class="nav-link" id="pills-profile-tab-nobd" data-toggle="pill" href="#pills-profile-nobd" role="tab"
                aria-controls="pills-profile-nobd" aria-selected="true">CCTV 1 & 2</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pills-contact-tab-nobd" data-toggle="pill" href="#pills-contact-nobd" role="tab"
                aria-controls="pills-contact-nobd" aria-selected="false">CCTV 3 & 4</a>
        </li>
    </ul>
    <div class="tab-content mt-2 mb-3" id="pills-without-border-tabContent">
        <div class="tab-pane fade active show" id="pills-home-nobd" role="tabpanel" aria-labelledby="pills-home-tab-nobd">
            <?php
            $netto = abs($x['timbang1'] - $x['timbang2']);
            echo "
            <table class='table table-striped' width='100%'>
                <tr>
                    <th>No. Tiket </th> <th>:</th> <td>$x[tiket]</td>  
                    <th>Material</th> <th>:</th> <td>$x[material]</td>
                </tr>
                <tr>
                    <th>Asal</th> <th>:</th> <td>$x[asal]</td> 
                    <th>Tujuan</th>  <th>:</th> <td>$x[tujuan]</td>
                </tr>
                <tr>
                    <th>No. Kendaraan</th> <th>:</th> <td>$x[kendaraan]</td> 
                    <th>Pengemudi</th> <th>:</th> <td>$x[pengemudi]</td>
                </tr>
                <tr>
                    <th>Timbang 1</th> <th>:</th> <td>$x[timbang1]</td> 
                    <th>Timbang 2</th> <th>:</th> <td>$x[timbang2]</td>
                </tr> 
                <tr>
                    <th>Netto</th> <th>:</th> <td>$netto</td> 
                    <th></th> <th></th> <td></td>
                </tr> 
                <tr>
                    <th>Tgl. Masuk</th> <th>:</th> <td>$x[tgl_masuk] </td>
                    <th>Tgl. Keluar</th> <th>:</th> <td>$x[tgl_keluar]</td>
                </tr> 
                <tr>
                    <th>Catatan</th> <th>:</th> <td>$x[catatan]</td>
                    <th>Operator Timbang</th> <th>:</th> <td>$x[createdby]</td>
                </tr> 
            </table>
            ";
            ?>
        </div>
        <div class="tab-pane fade " id="pills-profile-nobd" role="tabpanel" aria-labelledby="pills-profile-tab-nobd">
        <?php
            echo "<img src='../CCTV/car/$x[tiket]-IN-cctv1.jpeg' width='100%'>";
            echo "<img src='../CCTV/car/$x[tiket]-IN-cctv2.jpeg' width='100%'>";
        ?>
        </div>
        <div class="tab-pane fade" id="pills-contact-nobd" role="tabpanel" aria-labelledby="pills-contact-tab-nobd">
        <?php
            echo "<img src='../CCTV/car/$x[tiket]-OUT-cctv1.jpeg' width='100%'>";
            echo "<img src='../CCTV/car/$x[tiket]-OUT-cctv2.jpeg' width='100%'>";
        ?>
        </div>
    </div>
<?php
} elseif ($btn == 'hapus') {
    $qry = mysqli_query($k, "UPDATE tb_weighing_scale SET rowstatus='0' WHERE id='$id'");
} elseif ($btn == 'tabel') {

    if (strlen($tgl1) > 0 && strlen($tgl2) > 0) {
        $qrAdd = "DATE(tgl_masuk) BETWEEN '$tgl1' AND '$tgl2' AND ";
    } else {
        $qrAdd = "";
    }
    if ($mode == 'all') {
        $mode_timbang = '';
    } else {
        $mode_timbang = "mode_timbang = '$mode' AND ";
    }

    $no = 1;
    $res = array();
    $data = array();
    $qry = mysqli_query($k, "SELECT * FROM  tb_weighing_scale WHERE $mode_timbang $qrAdd rowstatus=1 order by id desc");
    $jsonResult = '{"data" : ';
    while ($d = mysqli_fetch_array($qry)) {
        $netto = abs($d['timbang1'] - $d['timbang2']);

        $data['no'] = $no;
        $data['id'] = $d['id'];
        $data['jenis'] = $d['mode_timbang'];
        $data['tiket'] = $d['tiket'];
        $data['kendaraan'] = $d['kendaraan'];
        $data['pengemudi'] = $d['pengemudi'];
        $data['asal'] = $d['asal'];
        $data['tujuan'] = $d['tujuan'];
        $data['material'] = $d['material'];
        $data['tara'] = $d['timbang1'];
        $data['bruto'] = $d['timbang2'];
        $data['netto'] = number_format($netto);
        $data['catatan'] = $d['catatan'];
        $data['tgl_masuk'] = $d['tgl_masuk'];
        $data['harga_pokok'] = $d['harga_pokok'];
        $data['harga_pokok'] = number_format($d['harga_pokok'] * $netto);
        $data['harga_jual'] = number_format($d['harga_jual'] * $netto);

        $data['profit'] = number_format(($d['harga_jual'] * $netto) - ($d['harga_pokok'] * $netto));
        array_push($res, $data);
        $no++;
    }
    $jsonResult .= json_encode($res);
    $jsonResult .= ' }';
    echo $jsonResult;

} else {

}