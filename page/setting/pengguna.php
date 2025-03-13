<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="card full-height">
                <div class="card-body">
                    <div class="page-header">
                        <h4 class="page-title">Daftar Pengguna</h4>
                        <div class="ml-md-auto py-2 py-md-0">
                            <a href='#' data-btn='add' data-judul='Tambah Data' class='infoPR btn btn-sm btn-primary'
                                data-toggle='modal'><i class="fas fa-plus-circle"></i> Tambah User</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama User</th>
                                    <th>Jabatan</th>
                                    <th>Username</th>
                                    <th>Level</th>
                                    <th>Aktif</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    echo modal(1);
?>
<script type="text/javascript">
    var tabel = null;
    function isiTabel() {
        $(document).ready(function () {
            tabel = $('#basic-datatables').DataTable({
                "destroy": true,
                "processing": true,
                "ajax":
                {
                    "url": "Ajax/pengguna.php", // URL file untuk proses select datanya
                    "type": "POST",
                    "data": {
                        "btn": 'tabel',
                        "jenis": ''
                    }
                },
                "lengthMenu": [10, 50, 100, 200, 300, 500],
                "pageLength": 10,
                "columns": [
                    {
                        "data": "no",
                        "sClass": "text-center"
                    },
                    { "data": "nama_user" },
                    { "data": "jabatan" },
                    { "data": "username" },

                    { "data": "level" },
                    { "data": "aktif" },
                    {
                        "render": function (data, type, row) { // Tampilkan kolom aksi
                            var html =

                                "<a class='infoPR btn btn-xs btn-warning' data-btn='edit' data-judul='Edit User' title='Edit Data'  data-id='" + row.id + "'   data-toggle='modal' ><i class='fa fa-edit'></i></a> &nbsp;" +
                                "<a class=' btn btn-xs btn-danger hapus'  title='Hapus Data' data-id='" + row.id + "'   href='#'><i class='fa fa-trash'></i></a>";
                            return html
                        }
                    }
                ]
            });
        });
    }
    isiTabel();
    $(document).on("click", ".infoPR", function () {
        var url = document.URL;
        var id = $(this).data('id');
        var btn = $(this).data('btn');
        var judul = $(this).data('judul');
        $.ajax({
            url: 'Ajax/pengguna.php',
            type: 'post',
            data: { id: id, btn: btn, url: url },
            success: function (response) {
                $('.modal-body').html(response);
                $('.modal-title').html(judul);
                $('#empModal').modal('show');
            }
        });
    });

    $(document).on("click", ".hapus", function () {
        var url = document.URL;
        var id = $(this).data('id');
        swal({
            title: "Apakah anda yakin?",
            text: "Data yang sudah dihapus tidak dapat dikembalikan",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ya, hapus!",
            closeOnConfirm: false
        },
        function () {
            $.ajax({
                url: 'Ajax/pengguna.php',
                type: 'post',
                data: { id: id, btn: 'hapus', url: url },
                success: function (response) {
                    swal("Terhapus!", "Data anda berhasil dihapus.", "success");
                    isiTabel();
                },
            });
        });
    });
</script>