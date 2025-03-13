<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <h4 class="page-title">Report Timbangan</h4>
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-with-nav">
                        <div class="card-header">
                            <div class="row row-nav-line">
                                <ul class="nav nav-tabs nav-line nav-color-secondary w-100 pl-3" role="tablist">
                                    <?php
                                    if ($_SESSION['level'] == 'Admin') { ?>
                                        <li class="nav-item submenu"> <a class="nav-link    " data-toggle="tab"
                                                href="#excel" role="tab" aria-selected="false"><span
                                                    class="fa fa-file-excel"></span> &nbsp; Export Excel</a> </li>
                                    <?php } ?>
                                    <li class="nav-item submenu"> <a class="nav-link active show" data-toggle="tab"
                                            href="#pdf" role="tab" aria-selected="true"> <span
                                                class="fa fa-file-pdf"></span> &nbsp; Export PDF</a> </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <!--  -->
                            <div class="tab-content">
                                <div class=" tab-pane fade     " aria-selected="true" role="tabpanel" id="excel">
                                    <table class="table table-typo">
                                        <tbody>
                                            <tr>
                                                <th width="150">Pilih Range Tanggal </th>
                                                <td><input id="tglPDF" type="text" class="form-control dtr" name="tgl"
                                                        value="" />
                                                    <input hidden type="text" name="tg1" id='tg1'>
                                                    <input hidden type="text" name="tg2" id='tg2'>
                                                </td>
                                                <td><button onclick="cetakExcel();"
                                                        class="btn btn-success btn-sm">Export Excel</button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class=" tab-pane fade active show" role="tabpanel  " id="pdf">
                                    <table class="table table-typo">
                                        <tbody>
                                            <tr>
                                                <th width="150">Pilih Range Tanggal </th>
                                                <td><input id="tglPDF" type="text" class="form-control dtr" name="tgl"
                                                        value="" />
                                                    <input hidden type="text" name="tg1" id='tg1'>
                                                    <input hidden type="text" name="tg2" id='tg2'>
                                                </td>
                                                <td><button onclick="cetakPDF();" class="btn btn-danger btn-sm">Export
                                                        PDF</button></td>
                                            </tr>
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
    <script type="text/javascript">
        $(function () {
            $('.dtr').daterangepicker({
                opens: 'left'
            }, function (start, end, label) {
                $('#tg1').val(start.format('YYYY-MM-DD'));
                $('#tg2').val(end.format('YYYY-MM-DD'));
            });
        });
        function cetakPDF() {
            var tg1 = $('#tg1').val();
            var tg2 = $('#tg2').val();
            var host = window.location.hostname;
            window.open('Report/data_timbangan_pdf.php?tgl1=' + tg1 + '&tgl2=' + tg2, '_BLANK');
        }
        function cetakExcel() {
            var tg1 = $('#tg1').val();
            var tg2 = $('#tg2').val();
            var host = window.location.hostname;
            window.open('Report/mkj/data_report_excel.php?tgl1=' + tg1 + '&tgl2=' + tg2 + '&f_jenis=%&f_customer=%&f_supplier=%&f_material=%', '_BLANK');
        }
    </script>
</div>