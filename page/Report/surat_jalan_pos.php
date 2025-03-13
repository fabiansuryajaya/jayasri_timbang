<?php
ob_start();
error_reporting(0);
include '../../config/koneksi.php';
include '../../config/fungsi.php';
include '../../page/Model/Setting.php';
if (isset($_GET['tiket'])) {
    $tiket = $_GET['tiket'];
    $data = mysqli_fetch_array(mysqli_query($k, "SELECT * FROM tb_weighing_scale WHERE id='$tiket'"));
    ?>
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Surat Jalan</title>
        <style type="text/css">
            body,
            td,
            th,
            tr,
            table,
            div {
                font-size: 13px;
                font-weight: bold;
                font-family: Courier-Oblique;
            }
        </style>
    </head>
    <body>
        <table width="100%" border='0'>
            <tbody>
                <tr>
                    <td style="width: 185px; border-bottom: 1px solid #000;  font-size: 15px; vertical-align: top; text-align:center;"
                        colspan="2">
                        <br><br><strong><?= judul() ?></strong><br>TIKET TIMBANGAN<br>NO : <?= $data['tiket']; ?>
                    </td>
                </tr>
                <tr>
                    <td style=" height: 20px; margin-left: 30px;">Gudang</td>
                    <td style=" height: 20px;">: <?php echo $data['gudang']; ?></td>
                </tr>
                <tr>
                    <?php
                    if ($data['mode_timbang'] == 'Penerimaan') { ?>
                        <td style="  ">Supplier</td>
                        <td style=" height: 18px;">: <?php echo $data['asal']; ?></td>
                    <?php } else { ?>
                        <td style="  ">Customer</td>
                        <td style=" height: 18px;">: <?php echo $data['tujuan']; ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td style=" height: 20px; margin-left: 30px;">No. Polisi</td>
                    <td style=" height: 20px;">: <?php echo $data['kendaraan'] . " ($data[plate_recognize])"; ?></td>
                </tr>
                <tr>
                    <td style="  ">Sopir</td>
                    <td style=" height: 18px; ">: <?php echo $data['pengemudi']; ?></td>
                </tr>
                <tr>
                    <td>Tanggal Masuk</td>
                    <td colspan="1">: <?php echo $data['tgl_masuk']; ?></td>
                </tr>
                <tr>
                    <td>Tanggal Keluar</td>
                    <td colspan="1">: <?php echo $data['tgl_keluar']; ?></td>
                </tr>
                <tr>
                    <td style=" height: 20px; margin-left: 30px;">Material</td>
                    <td style=" height: 20px;">: <?php echo $data['material']; ?></td>
                </tr>
                <tr>
                    <td>Timbang 1</td>
                    <td style="  height: 18px;">: <?php echo number_format($data['timbang1']); ?> Kg</td>
                </tr>
                <tr>
                    <td style="height: 18px;">Timbang 2</td>
                    <td colspan="2" style="border-bottom: 1px solid;">: <?php echo number_format($data['timbang2']); ?> Kg
                    </td>
                </tr>
                <tr>
                    <td style=" height: 18px;">Netto</td>
                    <td colspan="2">: <?php echo number_format($netto); ?> Kg</td>
                </tr>
                <tr>
                    <td>Catatan</td>
                    <td style="height: 18px;">:
                        <?php
                        $catatan = str_replace("/>", "", nl2br($data['catatan']));
                        if (strlen($catatan) > 15) {
                            $catatan = wordwrap($catatan, 15, "<br>", true);
                        }
                        echo $catatan;
                        ?>
                    </td>
                </tr>
                <tr>
                    <?php

                    if ($data['mode_timbang'] == 'Pengiriman') { ?>
                        <td>Harga Jual</td>
                        <td style="height: 18px;">: <?= number_format($data['harga_jual']); ?></td>
                    <?php } else { ?>
                        <td>Harga Beli</td>
                        <td style="height: 18px;">: <?= number_format($data['harga_pokok']); ?></td>
                    <?php } ?>
                </tr>

                <tr>
                    <?php
                    $netto = abs($data['timbang1'] - $data['timbang2']) - $data['penaltykg'];
                    if ($data['mode_timbang'] == 'Pengiriman') { ?>
                        <td>Total</td>
                        <td style="height: 18px;">: <?= number_format($data['harga_total']); ?></td>
                    <?php } else { ?>
                        <td>Total</td>
                        <td style="height: 18px;">: <?php echo number_format($netto * $data['harga_pokok']); ?></td>
                    <?php } ?>
                </tr>
            </tbody>
        </table>
        <br>
        <br>
        <br>
        <br>
        <table border="0" style="text-align:center;">
            <tr>
                <th>Disetujui Oleh</th>
                <th style="width:158;">Penimbang</th>
            </tr>
            <tr>
                <td><br><br><br></td>
                <td><br><br><br></td>
                <td><br><br><br></td>
            </tr>
            <tr>
                <td>______________</td>
                <td><?php echo $data['createdby']; ?></td>
            </tr>
            <!--  -->
            <tr>
                <th style="width:158;" colspan="2"><br>
                    <br>
                    <br>Sopir
                </th>
            </tr>
            <tr>
                <td colspan="2"><br><br><br></td>
            </tr>
            <tr>
                <td colspan="2"><?php echo $data['pengemudi'] ?></td>
            </tr>
        </table>
    </body>
    </html>
    <?php
    $filename = "Surat_jalan_" . date('d-m-Y') . ".pdf";
    $content = ob_get_clean();
    $content = '<page style="font-family: Courier-Oblique">' . $content . '</page>';
    require_once('../../assets/html2pdf/html2pdf.class.php');
    try {
        $html2pdf = new HTML2PDF('P', array(200.0, 80.0), 'en', false, 'ISO-8859-15', array(7, 3, 3, 1));
        $html2pdf->setDefaultFont('Arial');
        // $html2pdf->setTestTdInOnePage(false);
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        ob_end_clean();
        $html2pdf->Output($filename);
    } catch (HTML2PDF_exception $e) {
        echo $e;
    }
}