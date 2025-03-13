<?php
session_start();
ob_start();
include '../../config/koneksi.php';
include_once '../../config/fungsi.php';

if (isset($_GET['tgl1'])) {
    $tgl1 = $_GET['tgl1'];
    $tgl2 = $_GET['tgl2'];
?>
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Surat Jalan</title>
        <style type="text/css">
            .batas {
                margin-top: 100px;
            }
            .hed {
                font-size: 10px;
                font-weight: bold;
                line-height: 13px;
            }
            .th {
                font-size: 14px;
                text-align: center;
                border: 1px solid black;
                padding: 1px;
                word-break: break-all;
            }
            .text7 {
                font-size: 7px;
                text-align: center;
                padding: 1px;
            }
            .Content {
                font-size: 14px;
                text-align: left;
                padding: 2px;
                word-break: break-all;
            }
            .namaContent {
                font-size: 9px;
                text-align: left;
                padding: 3px;
            }
            .table {
                border-collapse: collapse;
            }
            .nama_acc {
                font-weight: bold;
            }
            .warna {
                background-color: #009641;
                color: #fff;
            }
            p {
                font-size: 14px;
                margin-left: 0px;
                font-weight: bold;
            }
            .kiri {
                margin-left: 800px;
            }
            .kiri2 {
                margin-left: 270px;
            }
            .center {
                text-align: center;
            }
            .right {
                text-align: right;
            }
            .left {
                text-align: left;
            }
        </style>
    </head>
    <body class="dotted">
        <?php
        $nama_pt = mysqli_fetch_array(mysqli_query($k, "SELECT content FROM conf_sistem WHERE id=1"));
        ?>
        <h3 class="center">TRANSAKSI TIMBANGAN</h3>
        <h3 class="center"><?= $nama_pt['content']; ?></h3>
        <p>Tanggal: <?php echo tgl_miring($tgl1) . ' - ' . tgl_miring($tgl2); ?></p>
        <table class="table" border="1">
            <thead>
                <tr class="warna">
                    <th class="th warna" width="30">No</th>
                    <th class="th warna" width="50">No. Tiket</th>
                    <th class="th warna" width="100">Nomor DO</th>
                    <th class="th warna" width="65">Material</th>
                    <th class="th warna" width="150">Supplier</th>
                    <th class="th warna" width="150">Customer</th>
                    <th class="th warna" width="80">No. Polisi</th>
                    <th class="th warna" width="80">Pengemudi</th>
                    <th class="th warna" width="70">Timbang 1 (Kg)</th>
                    <th class="th warna" width="70">Timbang 2 (Kg)</th>
                    <th class="th warna" width="70">Netto (Kg)</th>
                    <th class="th warna" width="85">Tgl Jam Masuk</th>
                    <th class="th warna" width="85">Tgl Jam Keluar</th>
                    <th class="th warna" width="85">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $data = mysqli_query($k, "SELECT   * FROM tb_weighing_scale WHERE rowstatus=1 AND DATE(tgl_masuk) BETWEEN '$tgl1' AND '$tgl2' ORDER BY DATE(tgl_masuk) ASC  ");
                if (mysqli_num_rows($data) == 0) {
                    echo "<tr><td colspan='3'>Tidak ada data!</td></tr>";
                } else {
                    while ($q = mysqli_fetch_array($data)) {
                        $netto = abs($q['timbang1'] - $q['timbang2']);
                        echo " <tr>
                        <td  class='th Content center'> $no </td>     
                        <td  class='th Content center' >$q[tiket]</td>  
                        <td  class='th Content center' >$q[nomor_do]</td>  
                        <td  class='th Content center'>$q[material]</td> 
                        <td  class='th Content'>$q[asal]</td>      
                        <td  class='th Content'>$q[tujuan]</td>      
                        <td  class='th Content center'>$q[kendaraan]</td>       
                        <td  class='th Content'>$q[pengemudi]</td>      
                        <td  class='th Content center'>" . number_format($q['timbang1']) . "</td> 
                        <td  class='th Content center'>" . number_format($q['timbang2']) . "</td>  
                        <td  class='th Content center'>" . number_format($netto) . "</td>  
                        <td  class='th Content center'>$q[tgl_masuk]</td> 
                        <td  class='th Content center'>$q[tgl_keluar]</td> 
                        <td  class='th Content center'>$q[catatan]</td> 
                        ";
                        echo "</tr>";
                        $no++;
                    }
                }
                ?>
            </tbody>
        </table>
    </body>
    </html>
    <?php
    $filename = "Laporan_Timbangan_" . date('d-m-Y') . ".pdf";
    $content = ob_get_clean();
    $content = '<page style="font-family: Arial">' . $content . '</page>';
    require_once('../../assets/html2pdf/html2pdf.class.php');
    try {
        $html2pdf = new HTML2PDF('L', 'A3', 'en', false, 'ISO-8859-15', array(10, 10, 10, 10));
        $html2pdf->setDefaultFont('Arial');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output($filename);
    } catch (HTML2PDF_exception $e) {
        echo $e;
    }
}
?>