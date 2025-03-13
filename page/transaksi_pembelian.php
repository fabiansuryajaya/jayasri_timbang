<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<style type="text/css">
    .table td,
    .table th {
        padding: 0.3rem !important;
    }

    .table:not(.table-sm) thead th {
        padding-top: 8px !important;
        padding-bottom: 8px !important;
        font-size: 12px !important;
    }

    #table-2_filter {
        /*    width: 10%;*/
        float: right;
        /*    right: 50%;*/
        position: relative;
    }

    #table-2_length {
        width: 10% !important;
        float: left;
        margin-right: 5%;

    }

    button.buttons-html5 {
        padding: revert-layer;
    }
</style>
<script type="text/javascript">
    $(".wrapper").addClass("sidebar_minimize");
</script>
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="card full-height">
                <div class="card-body">
                    <div class="page-header">
                        <h4 class="page-title">Transaksi Pembelian</h4>
                    </div>
                    <div class="table-responsive">
                        <table id="table-2" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Jenis</th>
                                    <th>Tiket</th>
                                    <th>Material</th>
                                    <th>Supplier</th>
                                    <th>Kendaraan</th>
                                    <th>Pengemudi</th>
                                    <th>Timbang 1</th>
                                    <th>Timbang 2</th>
                                    <th>Netto</th>
                                    <th>Timestamp</th>
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

<?php echo modal(); ?>
<script type="text/javascript">
    var tabel = null;
    function isiTabel(tgl1 = null, tgl2 = null) {
        $(document).ready(function () {
            tabel = $('#table-2').dataTable({
                "destroy": true,
                "processing": true,
                "ajax":
                {
                    "url": "Ajax/transaksi_penimbangan.php", // URL file untuk proses select datanya
                    "type": "POST",
                    "data": {
                        "btn": 'tabel',
                        "mode": 'Penerimaan',
                        "tgl1": tgl1,
                        "tgl2": tgl2
                    }
                },
                "lengthMenu": [10, 50, 100, 200, 300, 500],
                "pageLength": 10,
                "dom": 'lBfrtip', //lBfrtip 
                "buttons": [
                    {
                        extend: 'excelHtml5',
                        title: 'Transaksi Pembelian ' + (tgl1 ?? '') + ' - ' + (tgl2 ?? ''),
                        text: '<i class="fa fa-table fainfo" aria-hidden="true" ></i> Quick Excel',
                        titleAttr: 'Export Excel',
                        "oSelectorOpts": { filter: 'applied', order: 'current' },
                        exportOptions: {
                            modifier: {
                                page: 'all',
                            },
                            format: {
                                header: function (data, columnIdx) {
                                    if (columnIdx == 0) {
                                        return 'No';
                                    } else {
                                        return data.split("<")[0];
                                    }
                                }
                            }
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        orientation: 'landscape',
                        pageSize: 'A4',
                        title: 'Transaksi Pembelian ' + (tgl1 ?? '') + ' - ' + (tgl2 ?? ''),
                        text: '<i class="fa fa-file fainfo" aria-hidden="true" ></i> Quick PDF',
                        titleAttr: 'Export PDF',
                        "oSelectorOpts": { filter: 'applied', order: 'current' },
                        exportOptions: {
                            modifier: {
                                page: 'all',
                            },
                            format: {
                                header: function (data, columnIdx) {
                                    if (columnIdx == 0) {
                                        return 'No';
                                    } else {
                                        return data.split("<")[0];
                                    }
                                }
                            }
                        }
                    },
                ],
                "columns": [
                    {
                        "data": "no",
                        "sClass": "text-center"
                    },
                    { "data": "jenis", },
                    { "data": "tiket", },

                    { "data": "material" },
                    { "data": "asal" },
                    { "data": "kendaraan" },
                    { "data": "pengemudi" },
                    { "data": "tara" },
                    { "data": "bruto" },
                    { "data": "netto" },
                    { "data": "tgl_masuk" },
                    {
                        "render": function (data, type, row) { // Tampilkan kolom aksi
                            var html =
                                "<a href='#' data-id='" + row.id + "' data-toggle='tooltip' title='Lihat Data' data-judul='Lihat Data' data-btn='view'  class='infoPR btn btn-xs btn-info'  > <i class='fa fa-file'></i> </a> " +
                                "<a class=' btn btn-xs btn-warning ' title='Print Data'  data-original-title='Lihat Data'   href='Report/surat_jalan.php?tiket=" + row.id + "' target='_BLANK'><i class='fa fa-print'></i></a>&nbsp;" +
                                "<a class=' btn btn-xs btn-danger hapus'  title='Hapus Data' data-id='" + row.id + "'   href='#'><i class='fa fa-trash'></i></a>";
                            return html
                        }
                    }
                ]
            });
            $('#table-2_filter').append('<label> &nbsp; Filter Date : </label>' +
                '<input id="tglPDF"  type="text" class="form-control dtr" name="tgl" value="" />' +
                '<input hidden type="text" name="tg1" id="tg1">' +
                '<input hidden type="text" name="tg2" id="tg2">&nbsp;' +
                '<button class="btn btn-sm btn-info " id="filterDate"><i class="fa fa-filter"></i></button>');

            $('#filterDate').on('click', function () {
                var tg1 = $('#tg1').val();
                var tg2 = $('#tg2').val();
                document.location = '?page=transaksi_timbangan&tgl1=' + tg1 + '&tgl2=' + tg2;
                // isiTabel(tg1,tg2);
            });
        });
    }

    var tgl1 = getParameterByName('tgl1');
    var tgl2 = getParameterByName('tgl2');
    isiTabel(tgl1, tgl2);

    $(document).on("click", ".infoPR", function () {
        var url = document.URL;
        var id = $(this).data('id');
        var btn = $(this).data('btn');
        var judul = $(this).data('judul');

        $.ajax({
            url: 'Ajax/transaksi_penimbangan.php',
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
                url: 'Ajax/transaksi_penimbangan.php',
                type: 'post',
                data: { id: id, btn: 'hapus', url: url },
                success: function (response) {
                    swal("Terhapus!", "Data anda berhasil dihapus.", "success");
                    isiTabel();
                },
            });
        });
    });
    $(function () {
        $('.dtr').daterangepicker({
            opens: 'left'
        }, function (start, end, label) {
            $('#tg1').val(start.format('YYYY-MM-DD'));
            $('#tg2').val(end.format('YYYY-MM-DD'));
        });
    });
    function getParameterByName(name) {
        name = name.replace(/[\[\]]/g, "\\$&");
        var url = window.location.href;
        var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
            results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, " "));
    }
    // $("button.buttons-excel").addClass("btn-sm btn-success");
    // $("button.buttons-pdf").addClass("btn-sm btn-danger");
    // $("select[name=table-2_length]").removeClass("form-control");
</script>