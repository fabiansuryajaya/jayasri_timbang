<?php
extract($_POST);
include '../../config/koneksi.php';
include '../../config/fungsi.php';
if (isset($btn)) { 
    if($btn == 'add'){
?>
        <form method="POST" id="form" action="Ajax/pengguna.php">
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group form-inline">
                        <label for="inlineinput" class="col-md-3 col-form-label">Nama User </label> 
                        <input type="text" id="nama_user" required placeholder="Cth : Bambang" name="nama_user" class="col-md-6 form-control">
                    </div> 
                    <div class="form-group form-inline">
                        <label for="inlineinput" class="col-md-3 col-form-label">Jabatan </label> 
                        <input type="text" id="jabatan" required placeholder="Cth : Operator" name="jabatan" class="col-md-6 form-control">
                    </div> 
                    <div class="form-group form-inline">
                        <label for="inlineinput" class="col-md-3 col-form-label">Username </label> 
                        <input type="text" id="username" required placeholder="cth : gagak1" name="username" class="col-md-6 form-control">
                    </div> 
                    <div class="form-group form-inline">
                        <label for="inlineinput" class="col-md-3 col-form-label">Password </label> 
                        <input type="text" id="password" required placeholder="Cth : Gagak123" name="password" class="col-md-6 form-control">
                    </div> 
                    <div class="form-group form-inline">
                        <label for="inlineinput" class="col-md-3 col-form-label">Level </label>
                        <select name="level" required id="level" class="select2 form-control col-md-6">
                            <option value="">-- Silahkan Pilih --</option>
                            <option>Admin</option>
                            <option>Operator</option>
                            <option>Pengawas</option>
                        </select>
                    </div>  
                </div> 
            </div> 
            <div class="form-group form-inline"> 
                <label for="inlineinput" class="col-md-3 col-form-label"> </label>
                <button type="submit" name="tambah" class="btn btn-sm btn-primary" ><i class="fa fa-save"> Simpan Data</i></button>
            </div>  
        </form>
<?php 
    }elseif($btn == 'edit'){ 
    $xx = mysqli_fetch_array(mysqli_query($k,"SELECT * FROM tb_user WHERE id='$id'"));
?>
        <form method="POST" id="form" action="Ajax/pengguna.php">
            <div class="row">
                <div class="col-lg-12">
                    <input type="text" id="id" value="<?php echo  $id; ?>"   name="id" hidden>
                    <div class="form-group form-inline">
                        <label for="inlineinput" class="col-md-3 col-form-label">Nama User </label> 
                        <input type="text" id="nama_user" value="<?php echo $xx['nama_user']; ?>" required placeholder="Cth : Bambang" name="nama_user" class="col-md-6 form-control">
                    </div> 
                    <div class="form-group form-inline">
                        <label for="inlineinput" class="col-md-3 col-form-label">Jabatan </label> 
                        <input type="text" id="jabatan" value="<?php echo $xx['jabatan']; ?>" required placeholder="Cth : Operator" name="jabatan" class="col-md-6 form-control">
                    </div> 
                    <div class="form-group form-inline">
                        <label for="inlineinput" class="col-md-3 col-form-label">Username </label> 
                        <input type="text" id="username" value="<?php echo $xx['username']; ?>"  required placeholder="cth : gagak1" name="username" class="col-md-6 form-control">
                    </div> 
                    <div class="form-group form-inline">
                        <label for="inlineinput" class="col-md-3 col-form-label">Password </label> 
                        <input type="text" id="password"   placeholder="Kosongkan jika tidak diganti." name="password" class="col-md-6 form-control">
                    </div> 
                    <div class="form-group form-inline">
                        <label for="inlineinput" class="col-md-3 col-form-label">Level </label>
                        <select name="level" required id="level" class="select2 form-control col-md-6">
                            <option value="">-- Silahkan Pilih --</option>
                            <option>Admin</option>
                            <option>Operator</option>
                            <option>Pengawas</option>
                        </select>
                    </div>  
                    <div class="form-group form-inline">
                        <label for="inlineinput" class="col-md-3 col-form-label">Aktif </label>
                        <select name="aktif" required id="aktif" class="select2 form-control col-md-6">
                            <option value="1" >Aktif</option> 
                            <option value="0" >Nonaktif</option> 
                        </select>
                    </div>  
                </div> 
            </div> 
            <div class="form-group form-inline"> 
                <label for="inlineinput" class="col-md-3 col-form-label"> </label>
                <button type="submit" name="simpan" class="btn btn-sm btn-primary" ><i class="fa fa-save"> Simpan Data</i></button>
            </div>  
        </form>
<?php
    }elseif($btn=='tabel'){ 
        $no   = 1;
        $res  = array();
        $data = array(); 
        $qry  = mysqli_query($k,"SELECT * FROM tb_user");  
        $jsonResult = '{"data" : '; 
           while ($d = mysqli_fetch_array($qry)) {  
            $data['no']                = $no;
            $data['id']                = $d['id']; 
            $data['nama_user']    = $d['nama_user']; 
            $data['jabatan']        = $d['jabatan']; 
            $data['username']        = $d['username'];  
            $data['level']            = $d['level']; 
            $data['aktif']            = aktif($d['aktif']); 
            array_push($res, $data);
            $no++;
        }
        $jsonResult .= json_encode($res);
        $jsonResult .= ' }';
        echo $jsonResult;
    }elseif ($btn == 'hapus') {
        $qry = mysqli_query($k,"DELETE FROM tb_user  WHERE id='$id'"); 
    }
}

if (isset($_POST['tambah'])) {
    $nama_user = $_POST['nama_user'];
    $jabatan   = $_POST['jabatan'];
    $username  = $_POST['username'];
    $password  = substr(sha1(anti($_POST['password'])),0,15);
    $level     = $_POST['level'];
    $ins = mysqli_query($k, "INSERT INTO tb_user (nama_user,jabatan,username,password,level,aktif) VALUES ('$nama_user','$jabatan','$username','$password','$level','1')");
    if ($ins) {
        echo "<script>alert('Berhasil ditambahkan'); document.location='../index.php?page=pengguna';</script>";
    }else{
        echo "<script>alert('Gagal ditambahkan'); document.location='../index.php?page=pengguna';</script>";
    }
}

if (isset($_POST['simpan'])) {
    $nama_user = $_POST['nama_user'];
    $jabatan   = $_POST['jabatan'];
    $username  = $_POST['username'];
    if ($_POST['password'] != '') {
        $pass = "password='".substr(sha1(anti($_POST['password'])),0,15)."',";
    }else{
        $pass ='';
    }
    $level = $_POST['level'];
    $aktif = $_POST['aktif'];

    $ins = mysqli_query($k, "UPDATE tb_user SET nama_user='$nama_user', jabatan='$jabatan', username='$username', $pass level='$level', aktif='$aktif' WHERE id='$id'");
    if ($ins) {
        echo "<script> alert('Berhasil diupdate'); document.location='../index.php?page=pengguna';</script>";
    }else{ 
        echo "<script> alert('Gagal diupdate'); document.location='../index.php?page=pengguna';</script>";
    }
}