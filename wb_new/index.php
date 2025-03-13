<?php
include '../config/koneksi.php';
session_start();
include '../page/Model/Setting.php';

?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="assets/css/metro-4.4.3.css">
    <link rel="stylesheet" href="assets/css/sky-net.css">
    <!-- <script  defer  src="jquery-1.11.3.min.js"></script> -->
    <!-- <script  defer  src="assets/js/jquery-2.2.4.min.js"></script> -->
    <script defer src="assets/js/jquery3.min.js"></script>
    <script defer src="assets/js/auto-tables.js"></script>
    <script type="module" crossorigin src="serial.js"></script>
    <script defer type="text/javascript" src="menu.js"></script>

    <script defer type="text/javascript" src="main.js"></script>
    <script defer type="text/javascript" src="popup.js"></script>
    <!-- <script defer  type="text/javascript" src="setting.js"></script>     -->
    <script defer type="text/javascript" src="master_data.js"></script>
    <script defer type="text/javascript" src="cetak_transaksi.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <style>
        @font-face {
            font-family: 'DS-DIGIB';
            src: url("assets/mif/DS-DIGIB.TTF") format("truetype");
        }

        .login-form {
            width: 350px;
            height: auto;
            top: 15%;
        }

        .kontenWarna {
            background-color: #F2F2F2 !important;
        }

        .bg1 {
            background-image: url('assets/img/anime-background-images-1.jpg') !important;
        }

        .indicator {
            font-family: "DS-DIGIB";
            float: right;
            background: black !important;
            color: red !important;
            font-size: 40px;
            text-align: center;
            font-weight: bold;
            /*padding: 0px;*/
            /*margin: 0px;*/
            width: 230px;
        }

        #page {
            background-image: url('Wall.png');
            background-repeat: no-repeat;
            background-position: top;
            position: relative;
        }

        .cctv {
            width: 100%;
            /*width: calc(30% - .2em);*/
            box-sizing: border-box;
            white-space: normal;
            box-sizing: border-box;
            display: inline-block;
            height: 180px;
            text-align: center;
            background-image: url('assets/img/noimg.png');
            background-repeat: no-repeat;
            background-position: center;
            border: 2px solid #5ebdec;
            background-size: cover;


            /*width: 50%;*/
        }

        .check {
            width: 95px !important;
        }

        .switch input[type="checkbox"]:checked~.check::after {
            transform: translateX(75px) translateY(-50%) !important;
        }

        section {
            background: #eee;
            box-sizing: border-box;
            padding: 5px;
        }

        #logo {
            float: right;

        }

        .pagination {
            flex-wrap: wrap;
        }

        input[disabled] {
            color: black !important;
        }

        .table.compact {
            padding: 0px 5px !important;
        }

        .info-box {
            width: 800px !important;
            height: auto;
            visibility: visible;
            top: 20px !important;
            left: 70px !important;
        }

        .info-box-tabel {
            width: 980px !important;
            height: auto;
            visibility: visible;
            top: 20px !important;
            left: 70px !important;
        }

        .table.compact td {
            padding: 2px 8px !important;
        }


        ul {
            list-style-type: none;
        }

        .ull {
            background-color: #eee;
            cursor: pointer;
            position: absolute;
            width: 96%;
            margin-left: 110%;
            margin-top: 8%;
        }

        .lii {
            padding: 5px;
            font-size: smaller;
            border: thin solid #7ff0ff;
            width: 280px;
            background-color: antiquewhite;
            font-weight: 600;
        }

        .lii:hover {
            background-color: #7ff0ff;
        }

        .fit {
            width: 100%;
            height: 100%;
        }

        #table-cctv td {
            padding: 4px !important;
        }
    </style>
</head>

<body>

    <body class="h-vh-100">

        <!-- ++++++++++++++++++ KONTEN ++++++++++++++++++ -->


        <div id="content" class="h-vh-100 " style="background:aliceblue;">
            <div class="example">
                <nav data-role="ribbonmenu" style="padding-bottom: 5px !important;" data-role-ribbonmenu="true"
                    class="ribbon-menu">
                    <ul class="tabs-holder" style="display:none !important;">
                        <li class="static" id="home"><a>Home</a></li>
                        <li class="active"><a href="#section_main">Main</a></li>
                    </ul>

                    <div class="content-holder">
                        <div class="section active" id="section_main">
                            <div class="group">


                                <button id="entry1" class="ribbon-button">
                                    <span class="icon"><img src="assets/img/1.png"></span>
                                    <span class="caption">Timbang Ke 1</span>
                                </button>

                                <button id="entry2" class="ribbon-button">
                                    <span class="icon"><img src="assets/img/2.png"></span>
                                    <span class="caption">Timbang Ke 2</span>
                                </button>
                                <div class="group-divider"></div>
                                <button id="cetakPrint" class="ribbon-button">
                                    <span class="icon"><img src="assets/img/printer.png"></span>
                                    <span class="caption">Cetak Transaksi</span>
                                </button>
                                <button id="masterData" class="ribbon-button">
                                    <span class="icon"><span class="mif-database"></span></span>
                                    <span class="caption">Master Data</span>
                                </button>
                                <div class="group-divider"></div>
                                <button id="check_raw" class="ribbon-button">
                                    <span class="icon"><img src="assets/img/serial.png"></span>
                                    <span class="caption">Serial Monitor</span>
                                </button>
                                <div class="group-divider"></div>
                                <div class="group-divider"></div>

                                <div style="/*display: none !important;" class="d-flex flex-column" id="cc">

                                </div>
                                <div class="group-divider"></div>
                                <div class="d-inline  " id="inline">
                                </div>
                                <!-- <button class="command-button small shadowed" style="font-size: 16px !important;" id="captureTB" >Capture<br>Timbangan</button>  -->
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            <!-- AREA -->
            <div id="page" class=" h-vh-100  " style="margin:5px;">


                <!-- <img src="assets/img/wbs.png" id="logo"> -->
                <img src="../assets/image/Jayasri_Besar.png" id="logo" style="width:10%; margin: 1%;">

            </div>
            <!-- AREA -->
            <div class=" h-vh-100  " id="streamCCTV" style="margin:5px;">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-5" id="entry1data">
                                <table id="tangkapGambar1" class="table compact border   ">
                                    <tr>
                                        <td style="width: 90px;">
                                            <strong>Mode Timbang</strong>
                                        </td>
                                        <td>
                                            <input type="checkbox" onclick="switchMode()" checked id="switchMode"
                                                data-role="switch" data-on="Pengiriman" data-off="Penerimaan">
                                            <code class="success" id="statusMode"
                                                style="padding: 3px 10px;height: auto;line-height: normal;margin-top: 0px;position: absolute;"></code>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 90px;">
                                            <strong>Tiket No </strong>
                                        </td>
                                        <td>
                                            <input type="text" id="no_tiket" class="metro-input" data-role="input"
                                                readonly>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width: 90px;">
                                            <strong>Gudang</strong>
                                        </td>
                                        <td>
                                            <input type="text" id="gudang" class="metro-input" data-role="input">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">
                                            <strong>Nomor Polisi</strong>
                                        </td>

                                        <td>

                                            <div class="input mb-1" style="width:88%">

                                                <input type="text" style="color: black !important;" id="plate_recognize"
                                                    readonly data-role="input" data-clear-button="false"
                                                    class="metro-input disabled" placeholder="OCR" title=""
                                                    data-role-input="true">
                                                <input type="text" id="plat_correct" disabled data-role="input"
                                                    data-clear-button="false" placeholder="Correct"
                                                    class="metro-input disabled" title="" data-role-input="true">
                                                <div class="button-group">
                                                    <button class="button input-custom-button secondary"
                                                        onclick="koreksi('plat_correct')" type="button"><i
                                                            class="mif-pencil"></i></button>
                                                </div>
                                                <button class="button input-custom-button primary" id="PlateOCR"
                                                    onclick="getPlate('plate_recognize','IN')"
                                                    style=" float: right;position: absolute;right: -46px;top: 0px;"
                                                    type="button"><i class="mif-camera"></i></button>
                                            </div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Pengemudi</strong>
                                        </td>
                                        <td>
                                            <div class="input mb-1">
                                                <input type="text" data-role="input" placeholder="Masukan Nama Sopir"
                                                    id="pengemudi" class="metro-input">

                                            </div>
                                        </td>
                                    </tr>

                                    <tr id="asalMode">
                                        <td>
                                            <strong>Supplier</strong>
                                        </td>
                                        <td>
                                            <input type="text" id="asal" class="metro-input" data-role="input">

                                        </td>
                                    </tr>

                                    <tr id="tujuanMode">
                                        <td>
                                            <strong>Customer</strong>
                                        </td>
                                        <td>
                                            <input type="text" id="tujuan" autocomplete="off" class="metro-input"
                                                data-role="input">

                                        </td>
                                    </tr>



                                    <tr>
                                        <td>
                                            <strong>Timbang 1</strong>
                                        </td>
                                        <td>

                                            <div class="input mb-1">

                                                <input type="text" style="color: black !important;" id="taraOCR"
                                                    readonly data-role="input" data-clear-button="false"
                                                    placeholder="OCR" class="metro-input disabled" title=""
                                                    data-role-input="true">
                                                <input type="text" style="color: black !important;" id="tara" readonly
                                                    data-role="input" data-clear-button="false"
                                                    class="metro-input disabled" placeholder="Indicator" title=""
                                                    data-role-input="true">
                                                <input type="hidden" id="tglmasuk">
                                                <div class="button-group">
                                                    <button class="button input-custom-button primary" id="captureTB"
                                                        tabindex="-1" type="button">Capture</button>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Material</strong>
                                        </td>
                                        <td>
                                            <input type="text" id="material"
                                                onkeyup="autoC(this.value,'material','material_list')"
                                                class="metro-input" data-role="input" value="">
                                            <input type="text" hidden name="hpp" id="hpp">
                                            <input type="text" hidden name="hjp" id="hjp">
                                            <input type="text" hidden name="id_material" id="id_material">

                                            <div style="position: absolute;z-index: 4; " id="material_list"></div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <strong>Keterangan</strong>
                                        </td>
                                        <td>
                                            <input type="text" id="catatan" class="metro-input" data-role="input"
                                                style="width: 100%;">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width: 120px;">
                                            <button class="button   success flat shadowed" id="save_hasil"> <span
                                                    class="mif-floppy-disk"></span> &nbsp; Simpan</button>
                                        </td>
                                        <td>
                                            <button class="button   warning flat shadowed" id="reset_data"> <span
                                                    class="mif-refresh"></span> &nbsp; Reset Entry</button>
                                        </td>
                                    </tr>

                                </table>

                            </div>
                            <!-- end timbang 1 -->
                            <!-- start timbang  2 -->
                            <div class="col-md-5" id="entry2data">
                                <table id="tangkapGambar2" class="table compact border   ">
                                    <tr>
                                        <td style="width: 90px;">
                                            <strong>Tiket No </strong>
                                        </td>
                                        <td>
                                            <input type="text" id="idtkt" hidden>
                                            <div class="input mb-1">
                                                <input type="text" data-role="input" readonly placeholder="Cari Tiket"
                                                    id="kodeLama" data-clear-button="false" class=""
                                                    data-custom-buttons="customButtons" title="" data-role-input="true">
                                                <input type="text" readonly style="text-align: right;" name="mode2"
                                                    id="mode2">
                                                <div class="button-group">
                                                    <button class="button input-custom-button primary flat shadowed"
                                                        tabindex="-1" type="button" id="popupData"><span
                                                            class="mif-search"></span></button>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width: 90px;">
                                            <strong>Gudang</strong>
                                        </td>
                                        <td>
                                            <input type="text" id="gudang2" class="metro-input" disabled
                                                data-role="input">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 120px;">
                                            <strong>No. Polisi 1</strong>
                                        </td>

                                        <td>

                                            <div class="input mb-1">

                                                <input type="text" style="color: black !important;"
                                                    id="plate_recognize2" readonly data-role="input"
                                                    data-clear-button="false" class="metro-input disabled"
                                                    placeholder="OCR" title="" data-role-input="true">
                                                <input type="text" id="plat_correct2" disabled data-role="input"
                                                    data-clear-button="false" placeholder="Correct"
                                                    class="metro-input disabled" title="" data-role-input="true">

                                            </div>

                                        </td>


                                    </tr>

                                    <!-- OCR Plat 2 -->

                                    <tr>
                                        <td width="25%">
                                            <strong>No. Polisi 2</strong>
                                        </td>

                                        <td>

                                            <div class="input mb-1" style="width:88%">

                                                <input type="text" style="color: black !important;"
                                                    id="plate_recognize2x" readonly data-role="input"
                                                    data-clear-button="false" class="metro-input disabled"
                                                    placeholder="OCR" title="" data-role-input="true">
                                                <input type="text" id="plat_correct2x" disabled data-role="input"
                                                    data-clear-button="false" placeholder="Correct"
                                                    class="metro-input disabled" title="" data-role-input="true">
                                                <div class="button-group">
                                                    <button class="button input-custom-button secondary"
                                                        onclick="koreksi('plat_correct2x')" type="button"><i
                                                            class="mif-pencil"></i></button>
                                                </div>
                                                <button class="button input-custom-button primary" id="PlateOCR2"
                                                    onclick="getPlate('plate_recognize2x','OUT')"
                                                    style=" float: right;position: absolute;right: -46px;top: 0px;"
                                                    type="button"><i class="mif-camera"></i></button>
                                            </div>

                                        </td>
                                    </tr>
                                    <!-- OCR Plat 2 -->

                                    <tr>
                                        <td>
                                            <strong>Pengemudi</strong>
                                        </td>
                                        <td>
                                            <input type="text" id="pengemudi2" class="metro-input" data-role="input"
                                                style="width: 100%;" disabled>
                                        </td>
                                    </tr>
                                    <tr id="asalMode2">
                                        <td>
                                            <strong>Supplier</strong>
                                        </td>
                                        <td>
                                            <input type="text" id="asal2" class="metro-input" data-role="input"
                                                style="width: 100%;" disabled>
                                        </td>
                                    </tr>

                                    <tr id="tujuanMode2">
                                        <td>
                                            <strong>Customer</strong>
                                        </td>
                                        <td>
                                            <input type="text" id="tujuan2" class="metro-input" data-role="input"
                                                style="width: 100%;" disabled>
                                        </td>
                                    </tr>
                                    <!--  -->


                                    <tr>
                                        <td>
                                            <strong>Timbang 1</strong>
                                        </td>
                                        <td>

                                            <div class="input mb-1">

                                                <input type="text" style="color: black !important;" id="taraOCR2"
                                                    readonly data-role="input" data-clear-button="false"
                                                    placeholder="OCR" class="metro-input disabled" title=""
                                                    data-role-input="true">
                                                <input type="text" style="color: black !important;" id="tara2" readonly
                                                    data-role="input" data-clear-button="false"
                                                    class="metro-input disabled" placeholder="Indicator" title=""
                                                    data-role-input="true">
                                        </td>
                                    </tr>



                                    <tr>
                                        <td>
                                            <strong>Timbang 2</strong>
                                        </td>
                                        <td>

                                            <div class="input mb-1">

                                                <input type="text" style="color: black !important;" id="brutoOCR"
                                                    readonly data-role="input" data-clear-button="false"
                                                    placeholder="OCR" class="metro-input disabled" title=""
                                                    data-role-input="true">
                                                <input type="text" style="color: black !important;" id="bruto" readonly
                                                    data-role="input" data-clear-button="false"
                                                    class="metro-input disabled" placeholder="Indicator" title=""
                                                    data-role-input="true">
                                                <input type="hidden" id="tglkeluar">

                                                <div class="button-group">
                                                    <button class="button input-custom-button primary" id="captureTB2"
                                                        tabindex="-1" type="button">Capture</button>
                                                </div>
                                            </div>


                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <strong>Netto</strong>
                                        </td>
                                        <td>
                                            <input type="text" id="netto" class="metro-input" data-role="input"
                                                readonly>
                                            <input type="text" id="hpp2" hidden>
                                            <input type="text" id="hjp2" hidden>
                                            <input type="text" id="totalhjp" hidden>
                                            <input type="text" id="hpp_total" hidden>

                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <strong>Material</strong>
                                        </td>
                                        <td>
                                            <input type="text" id="material2" class="metro-input" data-role="input"
                                                disabled>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td>
                                            <strong>Keterangan</strong>
                                        </td>
                                        <td>
                                            <input type="text" id="catatan2" class="metro-input" data-role="input"
                                                disabled style="width: 100%;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <button class="button  small success flat shadowed" id="save_hasil2"> <span
                                                    class="mif-floppy-disk"></span> &nbsp; Simpan</button>
                                            <a class="button primary  small flat shadowed" target="_BLANK" id="print"
                                                href="#"> <span class="mif-printer"></span> &nbsp; Cetak DO</a>
                                            <a class="button info  small flat shadowed" target="_BLANK" id="print_pos"
                                                href="#"> <span class="mif-printer"></span> &nbsp; Cetak DO POS</a>

                                            <button class="button  small  warning flat shadowed" id="reset_data2"> <span
                                                    class="mif-refresh"></span> &nbsp; Reset Form</button>
                                            <button class="button  small  alert flat shadowed"
                                                onclick="delTransaction($('#idtkt').val(),$('#kodeLama').val())"
                                                id="deleteData"> <span class="mif-cross"></span> &nbsp; Hapus
                                                Data</button>
                                        </td>
                                    </tr>

                                </table>

                                <br>

                            </div>
                            <!-- end timbang 2 -->

                            <div class="col-md-7">
                                <table class="table compact border " id="table-cctv">
                                    <tr>
                                        <td colspan="2" style="text-align:center">
                                            <div class="input-container">
                                                <strong>STREAM CCTV</strong>
                                            </div>
                                        </td>
                                    </tr>

                                    <?php
                                    $query = "SELECT * FROM conf_sistem WHERE `desc` IN ('cctv1', 'cctv2', 'cctv3', 'cctv4')";
                                    $result = mysqli_query($k, $query);

                                    while ($row = mysqli_fetch_array($result)) {
                                        switch ($row['desc']) {
                                            case 'cctv1':
                                                $cctv1 = $row;
                                                break;
                                            case 'cctv2':
                                                $cctv2 = $row;
                                                break;
                                            case 'cctv3':
                                                $cctv3 = $row;
                                                break;
                                            case 'cctv4':
                                                $cctv4 = $row;
                                                break;
                                        }
                                    }

                                    ?>
                                    <tr>
                                        <td>
                                            <div id="cam1-1" class="cctv">
                                                <iframe class="fit" src="<?= $cctv1['content']; ?>"
                                                    id="kamera_wb_1"></iframe>
                                                <button type="button" class="button mini primary "
                                                    style="position:absolute; bottom: 0; left: 0;">CCTV-1</button>

                                            </div>
                                        </td>
                                        <td>
                                            <div id="cam1-2" class="cctv">
                                                <iframe class="fit" src="<?= $cctv2['content']; ?>"
                                                    id="kamera_wb_2"></iframe>
                                                <button type="button" class="button mini primary "
                                                    style="position:absolute; bottom: 0; left: 0;">CCTV-2</button>

                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div id="cam1-3" class="cctv">
                                                <iframe class="fit" src="<?= $cctv3['content']; ?>"
                                                    id="kamera_wb_3"></iframe>
                                                <button type="button" class="button mini primary "
                                                    style="position:absolute; bottom: 0; left: 0;">CCTV-3</button>

                                            </div>
                                        </td>
                                        <td>

                                            <div id="cam1-4" class="cctv">
                                                <iframe class="fit" src="<?= $cctv4['content']; ?>"
                                                    id="kamera_wb_4"></iframe>
                                                <button type="button" class="button mini primary "
                                                    style="position:absolute; bottom: 0; left: 0;">CCTV-4</button>


                                            </div>
                                        </td>
                                    </tr>
                                    <!--  <tr>
          <td >

            <button title="Lihat Record CCTV" onclick="viewCCTV($('#no_tiket').val())" class="button input-custom-button success mini shadowed" id="reload"  tabindex="-1" type="button"><i class="mif-image"></i> Lihat Gambar</button>

        </td> 
    </tr> -->

                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Cetak Data Transaksi -->
            <!-- AREA -->
            <div id="cetakPrintData" class=" h-vh-100  " style="margin:5px;">
                <div class="row">
                    <div class="col-md-9">
                        <div style="/*display: none !important;" class="d-flex flex-column">
                            <table class="table compact border  " style="font-size: 12px; font-weight:400;">
                                <tr>
                                    <td width="10px">
                                        <strong>Tanggal</strong><br>
                                        <input type="date" name="f_tgl1" value="<?= date('Y-m-d') ?>" id="f_tgl1">
                                        <input type="date" name="f_tgl2" value="<?= date('Y-m-d') ?>" id="f_tgl2">
                                    </td>

                                    <td>
                                        <strong>Jenis</strong>
                                        <select style="width:100%;" class="form-control" name="f_jenis" id="f_jenis">
                                            <option value="%">- SEMUA -</option>
                                            <option value="Penerimaan">Penerimaan</option>
                                            <option value="Pengiriman">Pengiriman</option>
                                        </select>
                                    </td>

                                    <td>
                                        <strong>Customer</strong>

                                        <select style="width:100%;" class="form-control" name="f_customer"
                                            id="f_customer">
                                            <option value="%">- SEMUA CUSTOMER -</option>
                                            <?php
                                            $qry = mysqli_query($k, "SELECT tujuan FROM tb_weighing_scale GROUP BY kendaraan");

                                            while ($x = mysqli_fetch_array($qry)) {
                                                echo "<option value='$x[tujuan]'>$x[tujuan]</option>";
                                            }
                                            ?>

                                        </select>
                                    </td>


                                    <td>
                                        <strong>Supplier</strong>
                                        <select style="width:100%;" class="form-control" name="f_supplier"
                                            id="f_supplier">
                                            <option value="%">- SEMUA SUPPLIER -</option>
                                            <?php
                                            $qry = mysqli_query($k, "SELECT asal FROM tb_weighing_scale GROUP BY asal");

                                            while ($x = mysqli_fetch_array($qry)) {
                                                echo "<option value='$x[asal]'>$x[asal]</option>";
                                            }
                                            ?>

                                        </select>
                                    </td>

                                    <td>
                                        <strong>Material</strong>
                                        <select style="width:100%;" class="form-control" name="f_material"
                                            id="f_material">
                                            <option value="%">- SEMUA MATERIAL -</option>
                                            <?php
                                            $qry = mysqli_query($k, "SELECT material FROM tb_weighing_scale GROUP BY material");

                                            while ($x = mysqli_fetch_array($qry)) {
                                                echo "<option value='$x[material]'>$x[material]</option>";
                                            }
                                            ?>

                                        </select>
                                    </td>
                                    <td>
                                        <button class="button info mini" id="filter_data"><i
                                                class="mif-filter"></i></button>
                                        <span class="button success mini" id="export" onclick="exportExcel()"><i
                                                class="mif-file-excel"></i></span>

                                    </td>
                                </tr>

                            </table>

                            <table style="height: 400px; overflow-y:auto; font-size:12px;font-weight: 400;"
                                class="table compact border striped cell-border" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No Tiket</th>
                                        <th>Jenis</th>
                                        <th>Tanggal</th>
                                        <th>Gudang</th>
                                        <th>Plat Nomor</th>
                                        <th>Plat OCR</th>
                                        <th>Pengemudi</th>
                                        <th>Customer</th>
                                        <th>Supplier</th>
                                        <th>Timbang 1</th>
                                        <th>Timbang 1 OCR</th>
                                        <th>Timbang 2</th>
                                        <th>Timbang 2 OCR</th>
                                        <th>Netto</th>
                                        <th>Material</th>

                                    </tr>
                                </thead>
                                <tbody id="tampiltransaksi">

                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="col-md-3" style="">
                        <ul class="v-menu">
                            <li class="menu-title"><span class="mif-file icon"></span>Detail Data</li>
                            <table style="width:90%; font-size: 10px;" class="tablesort">
                                <tbody>

                                    <tr>
                                        <td colspan="4">
                                            <center>
                                                <a id="cetakSJ" target='_BLANK'
                                                    style="display:inline-block !important; "
                                                    class="button success flat small shadowed" href=''><span
                                                        class="mif-printer"></span> &nbsp; Cetak Tiket Timbang</a>


                                                <a id="cetakSJPOS" target='_BLANK'
                                                    style="display:inline-block !important; "
                                                    class="button success flat small shadowed" href=''><span
                                                        class="mif-printer"></span> &nbsp; Cetak POS 80</a>
                                            </center>
                                            <br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding:5px">No Tiket</td>
                                        <td>: <span id="d_no_tiket"></span></td>

                                        <td style="padding:5px">Jenis</td>
                                        <td>: <span id="d_jenis"></span></td>
                                    </tr>
                                    <tr>
                                        <td style="padding:5px">Gudang</td>
                                        <td>: <span id="d_gudang"></span></td>
                                        <td style="padding:5px">Sopir</td>
                                        <td>: <span id="d_pengemudi"></span></td>

                                    </tr>
                                    <tr>
                                        <td style="padding:5px">Plat Nomor</td>
                                        <td>: <span id="d_kendaraan"></span></td>
                                        <td style="padding:5px">OCR</td>
                                        <td>: <span id="d_plate_recognize"></span></td>
                                    </tr>
                                    <tr>
                                        <td style="padding:5px">Customer</td>
                                        <td>: <span id="d_customer"></span></td>

                                        <td style="padding:5px">Supplier</td>
                                        <td>: <span id="d_supplier"></span></td>
                                    </tr>
                                    <tr>
                                        <td style="padding:5px">Material</td>
                                        <td>: <span id="d_material"></span></td>

                                        <td style="padding:5px">Catatan</td>
                                        <td>: <span id="d_catatan"></span></td>
                                    </tr>
                                    <tr>
                                        <td style="padding:5px">Tgl Masuk</td>
                                        <td colspan="3">: <span id="d_tgl_masuk"></span></td>
                                    </tr>
                                    <tr>
                                        <td style="padding:5px">Tgl Keluar</td>
                                        <td colspan="3">: <span id="d_tgl_keluar"></span></td>
                                    </tr>
                                    <tr>
                                        <td style="padding:5px">Timbang 1</td>
                                        <td>: <span id="d_timbang1"></span> Kg</td>
                                        <td style="padding:5px">Timbang 1 OCR</td>
                                        <td>: <span id="d_timbang2"></span> Kg</td>
                                    </tr>
                                    <tr>
                                        <td style="padding:5px">Timbang 2</td>
                                        <td>: <span id="d_timbang1ocr"></span> Kg</td>
                                        <td style="padding:5px">Timbang 2 OCR</td>
                                        <td>: <span id="d_timbang2ocr"></span> Kg</td>
                                    </tr>
                                    <tr>
                                        <td style="padding:5px">Netto </td>
                                        <td>: <span id="d_netto"></span> Kg</td>
                                    </tr>


                                    <tr>
                                        <td colspan="2" style="padding:5px">
                                            <span>CCTV Masuk</span>
                                            <img src="" id="cam1-IN">
                                            <img src="" id="cam2-IN">
                                        </td>
                                    </tr>


                                    <tr>
                                        <td colspan="2" style="padding:5px">
                                            <span>CCTV Keluar</span>
                                            <img src="" id="cam1-OUT">
                                            <img src="" id="cam2-OUT">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </ul>
                    </div>
                </div>
            </div>
            <!-- AREA -->

            <!-- AREA -->
            <div id="masterData2" class=" h-vh-100  " style="margin:5px;">
                <div class="row">
                    <div class="col-md-2">
                        <ul class="v-menu">


                            <li class="menu-title">Master Data</li>

                            <?php
                            if ($_SESSION['level'] == 'Admin') { ?>
                                <li><a id="m_asal"><span class="mif-truck icon"></span> Data Produk</a></li>
                            <?php } ?>

                            <li><a id="m_sopir"><span class="mif-user-check icon"></span> Data Driver</a></li>

                            <li><a id="m_customer"><span class="mif-truck icon"></span> Data Customer</a></li>

                        </ul>
                    </div>

                    <!-- ASAL -->
                    <div class="col-md-3" id="m_d_asal">
                        <ul class="v-menu">
                            <li class="menu-title"><span class="mif-add icon"></span> Tambah/Edit Produk</li>
                            <br>
                            <table style="width:90%;">


                                <tr>
                                    <td style="padding:5px">
                                        <span class="mif-list2 icon"></span>
                                    </td>
                                    <td>
                                        <input style="width:100%;" type="hidden" name="idProduk" id="idProduk"
                                            class="form-control">

                                        <input style="width:100%;" type="text" name="namaProduk" id="namaProduk"
                                            class="form-control" placeholder="Nama Produk">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:5px">
                                        <span class="mif-stack3 icon"></span>
                                    </td>
                                    <td>
                                        <input style="width:100%;" type="text" name="satuanProduk" id="satuanProduk"
                                            class="form-control" placeholder="Satuan">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:5px">
                                        <span class="mif-dollar icon"></span>
                                    </td>
                                    <td>
                                        <input style="width:100%;" type="number" name="hpProduk" id="hpProduk"
                                            class="form-control" placeholder="Harga Pokok Produk">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:5px">
                                        <span class="mif-dollars icon"></span>
                                    </td>
                                    <td>
                                        <input style="width:100%;" type="number" name="hjProduk" id="hjProduk"
                                            class="form-control" placeholder="Harga Jual Produk">
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:10px">
                                    </td>
                                    <td>
                                        <br>
                                        <center>
                                            <button class="button success flat small shadowed" id="add_produk"
                                                onclick="add_produk()"> <span class="mif-floppy-disk"></span> &nbsp;
                                                Simpan</button>
                                        </center>
                                        <br>
                                    </td>
                                </tr>
                            </table>

                        </ul>
                    </div>


                    <div class="col-md-7" id="m_d_asal2">
                        <input type="text" class="form-control mb-3 tablesearch-input" data-tablesearch-table="#t_asal"
                            placeholder="Cari Data....">
                        <table style="display:inline-table !important;"
                            class="table  tablesearch-table compact border striped cell-border" id="t_asal"
                            width="100%">
                            <thead>
                                <tr>
                                    <th style="width:10px">No</th>
                                    <th>Nama Produk</th>
                                    <th style="width:10px">Satuan</th>
                                    <th style="width:10px">Harga Pokok</th>
                                    <th style="width:10px">Harga Jual</th>
                                    <th style="width:10px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="t_asal_body">

                            </tbody>
                        </table>

                    </div>

                    <!-- DATAAA -->
                    <!-- CUSTOMERRR -->
                    <div class="col-md-3" id="m_d_customer">
                        <ul class="v-menu">
                            <li class="menu-title"><span class="mif-add icon"></span> Tambah Data Customer</li>
                            <br>
                            <table style="width:90%;">
                                <tr>
                                    <td style="padding:5px">
                                        <span class="mif-user icon"></span>
                                    </td>
                                    <td>

                                        <input style="width:100%;" type="hidden" name="idCustomer" id="idCustomer">

                                        <input style="width:100%;" type="text" name="nama_customer" id="nama_customer"
                                            class="form-control" placeholder="Masukan Nama Customer">
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:5px">
                                        <span class="mif-phone icon"></span>
                                    </td>
                                    <td>
                                        <input style="width:100%;" type="text" name="nomor_telp" id="nomor_telp"
                                            class="form-control" placeholder="Masukan Nomor Telepon">
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:5px; vertical-align: top;">
                                        <span class="mif-home icon"></span>
                                    </td>
                                    <td>
                                        <textarea style="width:100%;" placeholder="Alamat Customer" id="alamat"
                                            name="alamat" rows="3" class="form-control"></textarea>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:10px">
                                    </td>
                                    <td>
                                        <br>
                                        <center>
                                            <button class="button success flat small shadowed" id="add_customer"
                                                onclick="add_customer()"> <span class="mif-floppy-disk"></span> &nbsp;
                                                Simpan</button>
                                        </center>
                                        <br>
                                    </td>
                                </tr>
                            </table>

                        </ul>
                    </div>


                    <div class="col-md-7" id="m_d_customer2">
                        <input type="text" class="form-control mb-3 tablesearch-input"
                            data-tablesearch-table="#t_tujuan" placeholder="Cari Data....">
                        <table style="display:inline-table !important;"
                            class="table  tablesearch-table compact border striped cell-border" id="t_tujuan"
                            width="100%">
                            <thead>
                                <tr>
                                    <th style="width:10px">No</th>
                                    <th>Nama Customer</th>
                                    <th>Nomor Telepon</th>
                                    <th>Alamat</th>
                                    <th style="width:10px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="t_customer_body">

                            </tbody>
                        </table>

                    </div>

                    <!-- DATAAA -->
                    <!-- SOPIRRR -->
                    <div class="col-md-3" id="m_d_sopir">
                        <ul class="v-menu">
                            <li class="menu-title"><span class="mif-add icon"></span> Tambah Data Driver</li>
                            <br>
                            <table style="width:90%;">
                                <tr>
                                    <td style="padding:5px">
                                        <span class="mif-user icon"></span>
                                    </td>
                                    <td>

                                        <input style="width:100%;" type="hidden" name="idSopir" id="idSopir">

                                        <input style="width:100%;" type="text" name="nama_sopir" id="nama_sopir"
                                            class="form-control" placeholder="Masukan Nama Sopir">
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:5px">
                                        <span class="mif-phone icon"></span>
                                    </td>
                                    <td>
                                        <input style="width:100%;" type="text" name="nomor_telp_sopir"
                                            id="nomor_telp_sopir" class="form-control"
                                            placeholder="Masukan Nomor Telepon">
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:5px; vertical-align: top;">
                                        <span class="mif-truck icon"></span>
                                    </td>
                                    <td>
                                        <input style="width:100%;" type="text" name="nomor_polisi" id="nomor_polisi"
                                            class="form-control" placeholder="Masukan Nomor Polisi Truck">
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:10px">
                                    </td>
                                    <td>
                                        <br>
                                        <center>
                                            <button class="button success flat small shadowed" id="add_sopir"
                                                onclick="add_sopir()"> <span class="mif-floppy-disk"></span> &nbsp;
                                                Simpan</button>
                                        </center>
                                        <br>
                                    </td>
                                </tr>
                            </table>

                        </ul>
                    </div>


                    <div class="col-md-7" id="m_d_sopir2">
                        <input type="text" class="form-control mb-3 tablesearch-input" data-tablesearch-table="#t_sopir"
                            placeholder="Cari Data....">
                        <table style="display:inline-table !important;"
                            class="table  tablesearch-table compact border striped cell-border" id="t_sopir"
                            width="100%">
                            <thead>
                                <tr>
                                    <th style="width:10px">No</th>
                                    <th>Nama Sopir</th>
                                    <th>Nomor Telepon</th>
                                    <th>Nomor Polisi</th>
                                    <th style="width:10px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="t_sopir_body">

                            </tbody>
                        </table>

                    </div>

                    <!-- DATAAA -->
                    <!-- DATAAA -->

                </div>
            </div>
            <!-- AREAA -->
        </div>
        <!-- TIKET -->
        <div class="info-box-tabel" id="info-box-1" data-role="infobox">
            <span class="button square closer va-middle"></span>
            <div class="info-box-content" style="width:985px !important">
                <input type="text" class="form-control mb-3 tablesearch-input" data-tablesearch-table="#tampil"
                    placeholder="Cari Data....">
                <table style="height: 300px; overflow:auto;"
                    class="table  tablesearch-table compact border striped cell-border" id="tampil" width="100%">
                    <thead>
                        <tr>
                            <th>No Tiket</th>
                            <th>Jenis</th>
                            <th>Gudang</th>
                            <th>Plate OCR</th>
                            <th>Kendaraan</th>
                            <th>Sopir</th>
                            <th>Timbang 1 OCR</th>
                            <th>Timbang 1 (Kg)</th>
                            <th>Customer</th>
                            <th>Supplier</th>
                            <th>Material</th>
                            <th>Tgl</th>
                        </tr>
                    </thead>

                    <tbody id="tampil_body">

                    </tbody>
                </table>
            </div>
        </div>

        <div class="info-box" id="info-box-2" data-role="infobox">
            <span class="button square closer va-middle"></span>
            <div class="info-box-content">
                <input type="text" class="form-control mb-3 tablesearch-input" data-tablesearch-table="#tampilKendaraan"
                    placeholder="Cari Data....">
                <table style="display:inline-table !important;"
                    class="table  tablesearch-table compact border striped cell-border" id="tampilKendaraan"
                    width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nomor Polisi</th>
                            <th>Vendor</th>
                        </tr>
                    </thead>
                    <tbody id="tampilKendaraanBody">

                    </tbody>
                </table>
            </div>
        </div>

        <div class="info-box" id="info-box-3" data-role="infobox">
            <span class="button square closer va-middle"></span>
            <div class="info-box-content">
                <input type="text" class="form-control mb-3 tablesearch-input" data-tablesearch-table="#tampilSopir"
                    placeholder="Cari Data....">
                <table style="display:inline-table !important;"
                    class="table  tablesearch-table compact border striped cell-border" id="tampilSopir" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Sopir</th>
                            <th>Vendor</th>
                        </tr>
                    </thead>
                    <tbody id="tampilSopirBody">

                    </tbody>
                </table>
            </div>
        </div>
        <!-- Cek Raw -->
        <div class="info-box" id="info-box-4" data-role="infobox">
            <span class="button square closer va-middle"> </span>
            <div class="info-box-content">

                <textarea rows="3" class="textarea" style="min-height:300px" id="receive_textarea" readonly></textarea>
                <button id="download" class="button small info"><i class="mif-download"></i>&nbsp; Download log</button>
            </div>
        </div>


        <script defer src="assets/js/metro-4.4.3.js"></script>

        <?php
        $queryC = mysqli_query($k, "SELECT * FROM conf_sistem WHERE id BETWEEN 27 AND 32");
        if (mysqli_num_rows($queryC) > 0) {
            while ($d = mysqli_fetch_array($queryC)) {
                echo strtolower(str_replace(" ", "_", $d["desc"]));
                echo "<input type='text' hidden id='" . strtolower(str_replace(" ", "_", $d["desc"])) . "' value='$d[content]'>";
            }
        }
        ?>
    </body>

</html>
<script type="text/javascript">
    document.getElementById("hasilkg").readOnly = true;
    <?php
    $hide = mysqli_fetch_array(mysqli_query($k, "SELECT content FROM conf_sistem WHERE id='35'"));
    if ($hide['content'] == 'Yes') { ?>
        const element = document.getElementById('cc');
        element.style.setProperty('display', 'none', 'important');

    <?php } ?>
</script>