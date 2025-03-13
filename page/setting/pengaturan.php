<?php
if (isset($_POST['updconf'])) {
    extract($_POST);
    if ($set == 'menu') {
        $upd = mysqli_query($k, "UPDATE tb_menu_surat SET kode='$konten' WHERE id='$idd'");
    } elseif ($set == 'conf') {
        $upd = mysqli_query($k, "UPDATE conf_sistem SET content='$konten' WHERE id='$idd'");
    }
    if ($upd) {
        echo berhasil_j("disimpan");
    } else {
        echo gagal_j("disimpan");
    }
}

if (isset($_POST['updfoto'])) {
    extract($_POST);
    $nama_file = "$konten";

    if ($_FILES["gambar"]["tmp_name"] != '') {
        $foto = $_FILES["gambar"]["tmp_name"];
        $ext1 = pathinfo($_FILES["gambar"]["name"], PATHINFO_EXTENSION);
        $nama_file = date('dmy-his') . '-' . rand() . '.' . $ext1;
        $dirfoto = '../assets/image/';
        $pindah = move_uploaded_file($foto, $dirfoto . $nama_file);
    }
    $upd = mysqli_query($k, "UPDATE conf_sistem SET content='$nama_file' WHERE id='$idd'");

    if ($upd) {
        echo berhasil_j("disimpan");
    } else {
        echo gagal_j("disimpan");
    }
}
?>
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <h4 class="page-title">Pengaturan</h4>
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-with-nav">
                        <div class="card-header">
                            <div class="row row-nav-line">
                                <ul class="nav nav-tabs nav-line nav-color-secondary w-100 pl-3" role="tablist">
                                    <li class="nav-item submenu"> <a class="nav-link active show" data-toggle="tab"
                                            href="#home" role="tab" aria-selected="true">Umum</a> </li>

                                    <li class="nav-item submenu"> <a class="nav-link" data-toggle="tab" href="#profile"
                                            role="tab" aria-selected="false">Konfigurasi Sistem</a> </li>
                                </ul>
                            </div>
                        </div>

                        <div class="card-body">
                            <!--  -->
                            <div class="tab-content">
                                <div class=" tab-pane fade active show " aria-selected="true" role="tabpanel" id="home">
                                    <table class="table table-typo">
                                        <tbody>
                                            <?php
                                            $qr = mysqli_query($k, "SELECT * FROM conf_sistem WHERE jenis=1");
                                            while ($d = mysqli_fetch_array($qr)) {

                                                if ($d['gambar'] == 1) {
                                                    $x = 'confg';
                                                } else {
                                                    $x = 'conf';
                                                }
                                                echo "
                                            <tr>
                                                <td>
                                                    <p>$d[desc]</p>

                                                </td>
                                                <td><p class='text-info'>$d[content]</p></td>
                                                <td>
                                                    <button class='btn btn-xs btn-info $x' data-set='conf'  title='Edit Konfigurasi' data-toggle='tooltip' data-id='$d[id]' data-content='$d[content]'   ><i class='fas fa-pencil-alt'></i></button>
                                                </td>
                                            </tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>

                                <div class=" tab-pane fade " role="tabpanel" id="profile">
                                    <table class="table table-typo">
                                        <tbody>
                                            <?php
                                            $qr = mysqli_query($k, "SELECT * FROM conf_sistem WHERE jenis=2");
                                            while ($d = mysqli_fetch_array($qr)) {
                                                if ($d['gambar'] == 1) {
                                                    $x = 'confg';
                                                } else {
                                                    $x = 'conf';
                                                }
                                                echo "
                                            <tr>
                                                <td>
                                                    <p>$d[desc]</p>

                                                </td>
                                                <td><p class='text-info'>$d[content]</p></td>
                                                <td>
                                                    <button class='btn btn-xs btn-info $x' data-set='conf'  title='Edit Konfigurasi' data-toggle='tooltip'  data-id='$d[id]' data-content='$d[content]'   ><i class='fas fa-pencil-alt'></i></button>
                                                </td>
                                            </tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>

                                <div class=" tab-pane fade " role="tabpanel" id="menu">
                                    <table class="table table-typo">
                                        <tbody>
                                            <?php
                                            $qr = mysqli_query($k, "SELECT * FROM conf_sistem WHERE jenis=3");
                                            while ($d = mysqli_fetch_array($qr)) {

                                                if ($d['gambar'] == 1) {
                                                    $x = 'confg';
                                                } else {
                                                    $x = 'conf';
                                                }
                                                echo "
                                            <tr>
                                                <td>
                                                    <p>$d[desc]</p>

                                                </td>
                                                <td><p class='text-info'>$d[content]</p></td>
                                                <td>
                                                    <button class='btn btn-xs btn-info $x' data-set='conf' title='Edit Konfigurasi' data-toggle='tooltip'   data-id='$d[id]' data-content='$d[content]'  ><i class='fas fa-pencil-alt'></i></button>
                                                </td>
                                            </tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>

                                <div class=" tab-pane fade " role="tabpanel" id="kode">
                                    <table class="table table-typo">
                                        <tbody>
                                            <?php
                                            $qr = mysqli_query($k, "SELECT id,nama_menu,kode FROM tb_menu_surat");
                                            while ($d = mysqli_fetch_array($qr)) {
                                                echo "
                                            <tr>
                                                <td>
                                                    <p>$d[nama_menu]</p>

                                                </td>
                                                <td><p class='text-info'>$d[kode]</p></td>
                                                <td>
                                                    <button class='btn btn-xs btn-info conf' data-set='menu' title='Edit Konfigurasi' data-toggle='tooltip'   data-id='$d[id]' data-content='$d[kode]'  ><i class='fas fa-pencil-alt'></i></button>
                                                </td>
                                            </tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!--  -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo modal(); ?>
<script type="text/javascript">
    $(document).on("click", ".conf", function () {
        var id = $(this).data('id');
        var cntnt = $(this).data('content');
        var set = $(this).data('set');
        var html = "<div class='card-body'><form method='POST' action='' class='row'>" +
            "<input type='hidden' name='idd' value='" + id + "'>" +
            "<input type='hidden' name='set' value='" + set + "'>" +
            "<input type='text' autocomplete='off' name='konten' class='form-control col-md-8' value='" + cntnt + "'>" +
            "<input type='submit' name='updconf' value='Simpan' class='col-md-3 btn btn-sm btn-primary'></form></div>";
        $('.modal-body').html(html);
        $('.modal-title').html('Update Konfigurasi');
        $('#empModal').modal('show');
    });

    $(document).on("click", ".confg", function () {
        var id = $(this).data('id');
        var cntnt = $(this).data('content');
        var set = $(this).data('set');
        var html = "<div class='card-body'><form method='POST' action='' enctype='multipart/form-data' >" +
            "<input type='hidden' name='idd' value='" + id + "'>" +
            "<input type='hidden' name='konten' value='" + cntnt + "'>" +
            "<img src='../assets/image/" + cntnt + "' width='150px'>" +
            "Ganti Gambar : <input type='file' name='gambar'>" +
            "<input type='submit' name='updfoto' value='Simpan' class='col-md-3 btn btn-sm btn-primary'></form></div>";
        $('.modal-body').html(html);
        $('.modal-title').html('Update Konfigurasi');
        $('#empModal').modal('show');
    });

</script>