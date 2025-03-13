<?php
set_include_path( get_include_path().PATH_SEPARATOR."..");


include_once("xlsxwriter.class.php"); 
include '../../../config/koneksi.php';

function tgl_miring($tgl){ 

    $tanggal = substr($tgl,8,2);

    $bulan =  substr($tgl,5,2);

    $tahun = substr($tgl,0,4);

    return $tanggal.'/'.$bulan.'/'.$tahun;        



}

if (isset($_GET['tgl1'])) {
    $tgl1 = $_GET['tgl1']; 
    $tgl2 = $_GET['tgl2']; 
    $tgl1_miring =  tgl_miring($tgl1);
    $tgl2_miring =  tgl_miring($tgl2);

    $f_jenis    = $_GET['f_jenis']; 
    $f_customer    = $_GET['f_customer']; 
    $f_supplier    = $_GET['f_supplier']; 
    $f_material    = $_GET['f_material']; 
}

$nama_pt = mysqli_fetch_array(mysqli_query($k,"SELECT content FROM conf_sistem WHERE id=1"));

$filename = "Report Timbangan.xlsx";
header('Content-disposition: attachment; filename="'.XLSXWriter::sanitize_filename($filename).'"');
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate');
header('Pragma: public');

$sheet1 = 'Report Timbangan';

$header = array( 'number', 'string', 'string', 'string', 'string', 'string', 'string', 'string', 'string',  'number', 'number','number', 'datetime', 'datetime', 'string','price','price');

$formatHead = array('font'=>'Arial','font-size'=>12,'font-style'=>'bold', 'color'=>'#000','halign'=>'center');

$formatTitle = array('font'=>'Arial','font-size'=>10,'font-style'=>'bold', 'fill'=>'#000','color'=>'#000','fill'=>'#00ff99', 'border'=>'top,bottom', 'halign'=>'center');

$styles1 = array( 'font'=>'Arial','font-size'=>10,'font-style'=>'bold', 'fill'=>'#eee', 'halign'=>'center', 'border'=>'left,right,top,bottom');

$styles7 = array( 'border'=>'left,right,top,bottom');


$headTitle1 = array('TRANSAKSI TIMBANGAN');
$headTitle2 = array($nama_pt['content']); 
$title =  array( 'No', 'No Tiket',  'Jenis', 'Gudang',  'Material', 'Customer', 'Supplier', 'No. Polisi', 'Pengemudi', 'Timbang 1 (Kg)', 'Timbang 2 (Kg)', 'Netto (Kg)',  'Tgl Masuk', 'Tgl Keluar', 'Catatan','Harga Jual', 'Harga Total');
$writer = new XLSXWriter(); 
$writer->writeSheetRow($sheet1, $headTitle1, $formatHead);
$writer->writeSheetRow($sheet1, $headTitle2, $formatHead);
$writer->writeSheetRow($sheet1, array(""));
$writer->writeSheetRow($sheet1, array("Tanggal : ".$tgl1_miring.' - '.$tgl2_miring));
$writer->writeSheetRow($sheet1, $title, $styles1);

$writer->writeSheetHeader($sheet1, $header,$col_options = ['suppress_row'=>true,'widths'=>[5,8,17,14,14,10,25,25,13,15,40,12,11,13,13,13,6,10,6,10,10,6,23,23]]  );

$no = 1; 

$data = mysqli_query($k,"SELECT * FROM tb_weighing_scale WHERE   DATE(`tgl_masuk`) BETWEEN '$tgl1' AND '$tgl2' AND mode_timbang LIKE '$f_jenis'  AND `asal` LIKE '$f_supplier' AND `tujuan` LIKE '$f_customer' AND material LIKE '$f_material'  ORDER BY id DESC");  
while($row = mysqli_fetch_array($data)){
    $netto = abs($row['timbang1']-$row['timbang2']);

    $writer->writeSheetRow($sheet1, array($no,$row['tiket'], $row['mode_timbang'], $row['gudang'],  $row['material'], $row['tujuan'], $row['asal'], $row['kendaraan'], $row['pengemudi'], $row['timbang1'], $row['timbang2'], $netto, $row['tgl_masuk'], $row['tgl_keluar'], $row['catatan'],$row['mode_timbang']=='Pengiriman' ? $row['harga_jual'] : '',$row['mode_timbang']=='Pengiriman' ? $row['harga_total'] : ''),$styles7);
    $no++;
}


$writer->markMergedCell($sheet1, $start_row=0, $start_col=0, $end_row=0, $end_col=16);
$writer->markMergedCell($sheet1, $start_row=1, $start_col=0, $end_row=1, $end_col=16);


// $writer->writeSheet($rows,'Sheet1', $header);//or write the whole sheet in 1 call

// $writer->writeToFile('xlsx-simple.xlsx');
$writer->writeToStdOut();
// echo $writer->writeToString();

