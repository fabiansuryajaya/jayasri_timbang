<?php
function judul(){
    global $k;
    $qry = mysqli_fetch_array(mysqli_query($k,"SELECT content FROM conf_sistem WHERE id=1"));
    return $qry['content'];
}

function subjudul(){
    global $k;
    $qry = mysqli_fetch_array(mysqli_query($k,"SELECT content FROM conf_sistem WHERE id=2"));
    return $qry['content'];
}

function jumlah_timbangan($mode){
    global $k;
    if($mode == 'all'){
        $mode1 ='';
    }else{
        $mode1= "mode_timbang='$mode' AND ";
    }
    $qry = mysqli_fetch_array(mysqli_query($k,"SELECT COUNT(*) AS jm FROM tb_weighing_scale WHERE $mode1 DATE(createdon)=DATE(NOW()) AND rowstatus=1"));
    return $qry['jm'];
} 

function baud(){
    global $k;
    $qry = mysqli_fetch_array(mysqli_query($k,"SELECT content FROM conf_sistem WHERE id=34"));
    return $qry['content'];
}

function logo(){
    global $k;
    $qry = mysqli_fetch_array(mysqli_query($k,"SELECT content FROM conf_sistem WHERE id=5"));
    return $qry['content'];
} 

function favicon(){
    global $k;
    $qry = mysqli_fetch_array(mysqli_query($k,"SELECT content FROM conf_sistem WHERE id=25"));
    return $qry['content'];
} 

function singkatan(){
    global $k;
    $qry = mysqli_fetch_array(mysqli_query($k,"SELECT content FROM conf_sistem WHERE id=6"));
    return $qry['content'];
}

function desa(){
    global $k;
    $qry = mysqli_fetch_array(mysqli_query($k,"SELECT content FROM conf_sistem WHERE id=7"));
    return $qry['content'];
}

function gambar_login(){
    global $k;
    $qry = mysqli_fetch_array(mysqli_query($k,"SELECT content FROM conf_sistem WHERE id=15"));
    return $qry['content'];
} 

function kode_surat(){
    global $k;
    $url = explode('?', $_SERVER['HTTP_REFERER'])[1];
    $qry = mysqli_fetch_array(mysqli_query($k,"SELECT kode FROM tb_menu_surat WHERE url='?$url'"));
    return $qry['kode']; 
} 

function active($e)
{
    $xx = $_GET['page']=="$e" ? 'active' : '';
    return $xx;
}

function expand($e)
{
    $xx = $_GET['sub']=="$e" ? 'active' : '';
    return $xx;
}

function show($e)
{
    $xx = $_GET['sub']=="$e" ? 'show' : '';
    return $xx;
}