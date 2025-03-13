<?php
function aktif($e)
{
  if ($e == 1) {
    $r = 'Ya';
  } else {
    $r = 'Tidak';
  }
  return $r;
}

function cleanNumber($input)
{
  $cleanedInput = str_replace([',', '.'], '', $input);
  $number = (int) $cleanedInput;
  return $number;
}

function json_dec($e)
{
  return json_decode(preg_replace('/\r|\n/', '\n', trim($e)), true);
}

function modal()
{
  return " 
    <div class='modal fade ' style='z-index:99999999 !important' id='empModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
      <div class='modal-dialog modal-lg'  role='document'>
        <div class='modal-content'>
          <div class='modal-header'>
            <h5 class='modal-title' id='exampleModalLabel'></h5>
            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
            </button>
          </div>
          <div id='cntnt' class='modal-body'>
          </div>
          <div class='modal-footer'> 
            <button type='button' class='btn btn-secondary btn-sm' data-dismiss='modal'>Batal</button> 
          </div>
        </div>
      </div>
    </div>";
}

function gantikutip($e)
{
  return str_replace("'", "`", $e);
}
function cari_string($e)
{
  $kata = str_replace("#kompetensi", $_SESSION['kompetensi'], $e);
  return $kata;
}

function jenkel($e)
{
  if ($e == 'P') {
    $a = "<small class='badge badge-success'>Perempuan</small>";
  } else {
    $a = "<small class='badge badge-info'>Laki-laki</small>";
  }

  return $a;
}

function accGBR($e)
{
  if ($e == 1) {
    $a = "<i class='fa fa-ban' style='color:red; position:absolute; margin-left:-10px; width:20px; '></i>";
  } elseif ($e == 2) {
    $a = "<i class='fa fa-lock' style='color:green; position:absolute; margin-left:-10px; width:20px; '></i>";
  } else {
    $a = null;
  }
  return $a;
}

function anti($data)
{
  $a = strip_tags(htmlentities(htmlspecialchars(addslashes($data))));
  return $a;
}

function berhasil_j($e)
{
  echo "<script>sweetAlert('Berhasil','Data $e', 'success'); </script>";
}

function gagal_j($e)
{
  echo "<script>sweetAlert('Gagal','Data  $e', 'error'); </script>";
}

function berhasil($e, $r)
{
  echo "<div class='alert alert-success alert-dismissible'>
          <button type='button' class='close' data-dismiss='alert' aria-hidden'true'>×</button>
          <h4><i class='icon fa fa-check'></i> Perhatian!</h4>
          Data Berhasil Di$e!
        </div>";
  echo "<meta http-equiv='refresh' content='1,$r'>";
}

function gagal($e, $r)
{
  echo "<div class='alert alert-danger alert-dismissible'>
          <button type='button' class='close' data-dismiss='alert' aria-hidden'true'>×</button>
          <h4><i class='icon fa fa-ban'></i> Perhatian!</h4>
          Data Gagal Di$e!
        </div>";
}

function tgl_range($tgl)
{
  $tanggal = explode('/', $tgl);
  return $tanggal[2] . '-' . $tanggal[0] . '-' . $tanggal[1];
}

function tgl_miring($tgl)
{
  $tanggal = substr($tgl, 8, 2);
  $bulan = substr($tgl, 5, 2);
  $tahun = substr($tgl, 0, 4);
  return $tanggal . '/' . $bulan . '/' . $tahun;
}

function tgl_jam_miring($tgl)
{
  $tanggal = substr($tgl, 8, 2);
  $bulan = substr($tgl, 5, 2);
  $tahun = substr($tgl, 0, 4);
  $jam = substr($tgl, 11, 5);
  return $tanggal . '/' . $bulan . '/' . $tahun . ' ' . $jam;
}

function bulan_tahun($tgl)
{
  $gg = explode('-', $tgl);
  return getBulan($gg[0]) . ' ' . $gg[1];
}

function tgl_muter($tgl)
{
  $tanggal = substr($tgl, 0, 2);
  $bulan = substr($tgl, 3, 2);
  $tahun = substr($tgl, 6, 4);
  return $tahun . '-' . $bulan . '-' . $tanggal;
}

function tgl_gabung($tgl)
{
  $tanggal = substr($tgl, 8, 2);
  $bulan = substr($tgl, 5, 2);
  $tahun = substr($tgl, 0, 4);
  return $tanggal . '-' . $bulan . '-' . $tahun;
}

function tgl_pisah($tgl)
{
  $tanggal = substr($tgl, 0, 2);
  $bulan = substr($tgl, 2, 2);
  $tahun = substr($tgl, 4, 4);
  return $tahun . '-' . $bulan . '-' . $tanggal;
}

function tgl_indo($tgl)
{
  $tanggal = substr($tgl, 8, 2);
  $bulan = getBulan(substr($tgl, 5, 2));
  $tahun = substr($tgl, 0, 4);
  return $tanggal . ' ' . $bulan . ' ' . $tahun;
}

function getBulan($bln)
{
  switch ($bln) {
    case 1:
      return "Januari";
      break;
    case 2:
      return "Februari";
      break;
    case 3:
      return "Maret";
      break;
    case 4:
      return "April";
      break;
    case 5:
      return "Mei";
      break;
    case 6:
      return "Juni";
      break;
    case 7:
      return "Juli";
      break;
    case 8:
      return "Agustus";
      break;
    case 9:
      return "September";
      break;
    case 10:
      return "Oktober";
      break;
    case 11:
      return "November";
      break;
    case 12:
      return "Desember";
      break;
  }
}

function hari($tgl)
{
  if ($tgl == 0) {
    $tgl = "Hari ini";
  }

  if ($tgl == 1) {
    $tgl = "Kemarin";
  }

  if ($tgl <= 7) {
    $tgl = $tgl . "Hari";
  }

  if ($tgl >= 7) {
    $tgl = "Minggu ini";
  }

  if ($tgl <= 14) {
    $tgl = "Minggu Lalu";
  }

  if ($tgl <= 30) {
    $tgl = "Bulan ini";
  }

  if ($tgl <= 30 or $tgl) {
    $tgl = "Bulan ini";
  }

  if ($tgl < 300) {
    $tgl = "Tahun ini";
  }

  if ($tgl > 360) {
    $tgl = "Tahun lalu";
  }

  if ($tgl > -1) {
    $tgl = "Tahun depan";
  }

  return $tgl;
}

function tanggal_indo($timestamp = '', $date_format = 'l, j F Y', $suffix = null)
{
  if (trim($timestamp) == '') {
    $timestamp = time();
  } elseif (!ctype_digit($timestamp)) {
    $timestamp = strtotime($timestamp);
  }

  $date_format = preg_replace("/S/", "", $date_format);

  $pattern = array(
    '/Mon[^day]/',
    '/Tue[^sday]/',
    '/Wed[^nesday]/',
    '/Thu[^rsday]/',
    '/Fri[^day]/',
    '/Sat[^urday]/',
    '/Sun[^day]/',
    '/Monday/',
    '/Tuesday/',
    '/Wednesday/',
    '/Thursday/',
    '/Friday/',
    '/Saturday/',
    '/Sunday/',
    '/Jan[^uary]/',
    '/Feb[^ruary]/',
    '/Mar[^ch]/',
    '/Apr[^il]/',
    '/May/',
    '/Jun[^e]/',
    '/Jul[^y]/',
    '/Aug[^ust]/',
    '/Sep[^tember]/',
    '/Oct[^ober]/',
    '/Nov[^ember]/',
    '/Dec[^ember]/',
    '/January/',
    '/February/',
    '/March/',
    '/April/',
    '/June/',
    '/July/',
    '/August/',
    '/September/',
    '/October/',
    '/November/',
    '/December/',
  );

  $replace = array(
    'Sen',
    'Sel',
    'Rab',
    'Kam',
    'Jum',
    'Sab',
    'Min',
    'Senin',
    'Selasa',
    'Rabu',
    'Kamis',
    'Jumat',
    'Sabtu',
    'Minggu',
    'Jan ',
    'Feb ',
    'Mar ',
    'Apr ',
    'Mei ',
    'Jun ',
    'Jul ',
    'Ags ',
    'Sep ',
    'Okt ',
    'Nov ',
    'Des ',
    'Januari ',
    'Februari ',
    'Maret ',
    'April ',
    'Juni ',
    'Juli ',
    'Agustus ',
    'Sepember ',
    'Oktober ',
    'November ',
    'Desember ',
  );
  $date = date($date_format, $timestamp);
  $date = preg_replace($pattern, $replace, $date);
  $date = "{$date} {$suffix}";
  return $date;
}
function getRomawi($bln)
{
  switch ($bln) {
    case 1:
      return "I";
      break;
    case 2:
      return "II";
      break;
    case 3:
      return "III";
      break;
    case 4:
      return "IV";
      break;
    case 5:
      return "V";
      break;
    case 6:
      return "VI";
      break;
    case 7:
      return "VII";
      break;
    case 8:
      return "VIII";
      break;
    case 9:
      return "IX";
      break;
    case 10:
      return "X";
      break;
    case 11:
      return "XI";
      break;
    case 12:
      return "XII";
      break;
  }
}