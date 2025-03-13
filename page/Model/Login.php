<?php 
session_start();

function cari($username,$password){
    global $k;
    $pass = substr(sha1(anti($password)),0,15);  
    $qry = mysqli_query($k,"SELECT * FROM tb_user WHERE aktif=1 AND username = '$username' AND password = '$pass'"); 
    if (mysqli_num_rows($qry) > 0) {
        $x = mysqli_fetch_array($qry); 
          mysqli_query($k,"UPDATE tb_user SET last_login=NOW() WHERE id='$x[id]'");  
        $_SESSION['sesi_aktif']            = 1;
        $_SESSION['id_user']             = $x['id'];
        $_SESSION['jabatan']             = $x['jabatan'];
        $_SESSION['nama_user']            = $x['nama_user'];
        $_SESSION['level']                = $x['level'];
        $_SESSION['nama_user']            = $x['nama_user'];        
        $_SESSION['last_login']            = $x['last_login'];        
        $_SESSION['pass']                = $x['password'];        
        return 200;
    }else{
        return 400;
    }
}