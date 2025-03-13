<?php
session_start();
ob_start(); 
header( "Content-Type: application/vnd.ms-excel" );
header( "Content-disposition: attachment; filename=Report_Timbangan.xls" ); 
header("Content-Transfer-Encoding: BINARY");
header('Cache-Control: max-age=0');
include '../../config/koneksi.php';
include '../../config/fungsi.php';  

// ob_start();
if (isset($_GET['tgl1'])) {
    $tgl1 = $_GET['tgl1']; 
    $tgl2 = $_GET['tgl2']; 
?>
<html xmlns="http://www.w3.org/1999/xhtml">  
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Surat Jalan</title> 
        <style type="text/css">  
            .batas{
                margin-top: 100px;
            } 
            .hed{
                font-size: 10px;
                font-weight: bold;
                line-height: 13px;
            }
            .th{
                font-size: 13px;
                text-align: center; 
                border: 1px solid black;
                padding: 5px;
                word-break: break-all;
            }
            .text7{
                font-size: 7px;
                text-align: center;
                padding: 1px;
            }
            .Content{
                font-size: 12px;
                text-align: left;
                padding: 3px; 
                word-break: break-all;
            } 
            .namaContent{
                font-size: 9px;
                text-align: left;
                padding: 3px;
            }  
            .table{
                border-collapse: collapse;
            }
            .nama_acc{
                font-weight: bold;
            }
            .warna{
                background-color: #009641; 
                color: #fff;
            }
            p{
                font-size: 14px;
                margin-left: 0px; 
                font-weight: bold;
            }
            .kiri{
                margin-left:  800px;
            }
            .kiri2{
                margin-left:  270px;
            }
            .center{
                text-align: center;
            } 
            .right{
                text-align: right;
            } 
            .left{
                text-align: left;
            } 
        </style>
    </head>
    <body class="dotted">
    
        <h3 class="center">TRANSAKSI TIMBANGAN</h3>  
        <h3 class="center">PT. ARTTU PLANTATION</h3>  
        <p >Tanggal: <?php echo tgl_miring($tgl1).' - '.tgl_miring($tgl2); ?></p> 
        <br>
        <table class="table" border="1" >
            <thead>
                <tr class="warna">
                    <th  class="th warna" width="100">No</th>    
                    <th  class="th warna" width="150">No. Tiket</th> 
                    <th  class="th warna" width="200">Nomor Surat</th> 
                    <th  class="th warna" width="200">Nomor DO</th> 
                    <th  class="th warna" width="200">Nomor SPB</th> 
                    <th  class="th warna" width="100" >Material</th> 
                    <th  class="th warna" width="300" >Asal</th> 
                    <th  class="th warna" width="300" >Tujuan</th> 
                    <th  class="th warna" width="150">No. Polisi</th> 
                    <th  class="th warna" width="200">Pengemudi</th>  
                    <th  class="th warna" width="200">Div/Blok/Thn Tanam</th>  
                    <th  class="th warna" width="100">Jum. Janjang</th>  
                    <th  class="th warna" width="100">Brondol</th>     
                    <th  class="th warna" width="100">Timbang 1 (Kg)</th>   
                    <th  class="th warna" width="100">Timbang 2 (Kg)</th>   
                    <th  class="th warna" width="100">Netto 1 (Kg)</th>   
                    <th  class="th warna" width="100">P%</th>   
                    <th  class="th warna" width="100">P (Kg)</th>   
                    <th  class="th warna" width="100">G%</th>   
                    <th  class="th warna" width="100">G (Kg)</th>   
                    <th  class="th warna" width="100">Netto 2 (Kg)</th>  
                    <th  class="th warna" width="100">BJR</th>  
                    <th  class="th warna" width="200">Tgl Jam Masuk</th>  
                    <th  class="th warna" width="200">Tgl Jam Keluar</th>  
                    <th  class="th warna" width="200">Keterangan</th>  
                </tr> 
            </thead>
            <tbody>
                <?php
                $no = 1;
                $data = mysqli_query($k,"SELECT   * FROM tb_weighing_scale WHERE rowstatus=1 AND DATE(tgl_masuk) BETWEEN '$tgl1' AND '$tgl2' ORDER BY DATE(tgl_masuk) ASC  ");
                if(mysqli_num_rows($data) == 0){  
                    echo "<tr><td colspan='3'>Tidak ada data!</td></tr>";
                }else{ 
                    while ($q = mysqli_fetch_array($data)) {
                        $netto = abs($q['timbang1']-$q['timbang2']);
                        echo" <tr>
                        <td  class='th Content center'> $no </td>     
                        <td  class='th Content center' >$q[tiket]</td> 
                        <td  class='th Content center' >$q[nomor_surat]</td> 
                        <td  class='th Content center' >$q[nomor_do]</td> 
                        <td  class='th Content center' >$q[nomor_spb]</td> 
                        <td  class='th Content center'>$q[material]</td> 
                        <td  class='th Content'>$q[asal]</td>      
                        <td  class='th Content'>$q[tujuan]</td>      
                        <td  class='th Content center'>$q[kendaraan]</td>       
                        <td  class='th Content'>$q[pengemudi]</td>       
                        <td  class='th Content'>$q[divblok]</td>       
                        <td  class='th Content'>$q[jumlah_janjang]</td>       
                        <td  class='th Content'>$q[brondol]</td>       
                        <td  class='th Content center' >=".number_format($q['timbang1'])."</td> 
                        <td  class='th Content center' >=".number_format($q['timbang2'])."</td> 
                        <td  class='th Content center' >=".number_format($netto)."</td> 
                        <td  class='th Content center' >$q[penalty]</td> 
                        <td  class='th Content center'>".($netto * ($q['penalty']/100))."</td> 
                        <td  class='th Content center'>$q[grading]</td> 
                        <td  class='th Content center'>'".($netto * ($q['grading']/100))."</td> 
                        <td  class='th Content center'>'".number_format($q['netto'])."</td> 
                        <td  class='th Content center'>'"; echo $q['jumlah_janjang'] > 0 ? round($netto/$q['jumlah_janjang'],1) : 0; echo "</td> 
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
<?php } ?>