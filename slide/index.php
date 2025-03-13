<?php
include 'connect.php';
session_start();
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
            width: calc(50% - .2em);
            box-sizing: border-box;
            white-space: normal;
            box-sizing: border-box;
            display: inline-block;
            height: 225px;
            text-align: center;
            background-image: url('assets/img/noimg.png');
            background-repeat: no-repeat;
            background-position: center;
            border: 2px solid #5ebdec;
            background-size: cover;


            /*width: 50%;*/
        }

        .cctvPrint {
            width: calc(50% - .2em);
            box-sizing: border-box;
            white-space: normal;
            box-sizing: border-box;
            display: inline-block;
            height: 130px;
            text-align: center;
            background-image: url('assets/img/noimg.png');
            background-repeat: no-repeat;
            background-position: center;
            border: 2px solid #5ebdec;
            background-size: cover;


            /*width: 50%;*/
        }

        .cctv2 {
            top: -30px;
            box-sizing: border-box;
            height: 200px;
            display: inline-block;
            text-align: center;
            background-image: url('assets/img/noimg.png');
            background-repeat: no-repeat;
            background-position: center;
            border: 2px solid #5ebdec;
            background-size: cover;


            width: 23%;
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

        .table.compact td {
            padding: 5px 8px !important;
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

                                <div style="/*display: none !important;" class="d-flex flex-column">
                                    <center> <small>Konfigurasi</small></center>

                                    <table class="table compact border  ">
                                        <tr>
                                            <td>
                                                <strong>Port</strong>
                                            </td>
                                            <td>
                                                <select id="ports" title="Baudrate" class="combobox">

                                                </select>
                                            </td>
                                            <td>
                                                <strong>Speed</strong>
                                            </td>
                                            <td>
                                                <input id="custom_baudrate" type="number" min="1"
                                                    placeholder="Enter baudrate..." hidden>

                                                <select id="baudrate" class="combobox">
                                                    <option value="1200">1200 baud</option>
                                                    <option value="2400">2400 baud</option>
                                                    <option value="4800">4800 baud</option>
                                                    <option selected value="9600" selected>9600 baud</option>
                                                    <option value="19200">19200 baud</option>
                                                    <option value="38400">38400 baud</option>
                                                    <option value="57600">57600 baud</option>
                                                    <option value="115200">115200 baud</option>
                                                </select>
                                                <select id="databits" title="Databits">
                                                    <option value="7" selected>7</option>
                                                    <option value="8">8</option>
                                                </select>
                                                <select style="display:none;" id="parity" title="Parity">
                                                    <option value="none">None</option>
                                                    <option value="even" selected>Even</option>
                                                    <option value="odd">Odd</option>
                                                </select>
                                                <select id="stopbits" style="display:none;" title="Stopbits">
                                                    <option value="1" selected>1</option>
                                                    <option value="2">2</option>
                                                </select>
                                                <input type="checkbox" hidden id="rtscts">
                                                <button hidden id="download">Download output</button>
                                                <button hidden id="clear">Clear output</button>

                                            </td>
                                            <td>
                                                <input type="button" id="connect" class="button info" value="Connect" />



                                                <input hidden id="echo" type="checkbox">
                                                <input hidden id="enter_flush" type="checkbox">
                                                <input hidden id="convert_eol" checked type="checkbox">
                                                <input hidden id="autoconnect" checked type="checkbox">

                                            </td>
                                        </tr>

                                    </table>

                                </div>
                                <div class="group-divider"></div>
                                <div class="d-inline  ">

                                    <input type="text" name="kg" value="00000" readonly class="indicator" id="hasilkg">
                                </div>
                                <!-- <button class="command-button small shadowed" style="font-size: 16px !important;" id="captureTB" >Capture<br>Timbangan</button>  -->
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            <!-- AREA -->
            <div id="page" class=" h-vh-100  " style="margin:5px;">


                <img src="assets/img/wbs.png" id="logo">
            </div>
            <!-- AREA -->
            <div id="entry1data" class=" h-vh-100  " style="margin:5px;">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-5">
                                <table class="table compact border   ">
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
                                            <strong>Nomor DO</strong>
                                        </td>
                                        <td>
                                            <input type="text" id="no_do" class="metro-input" data-role="input">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 90px;">
                                            <strong>Nomor SPB</strong>
                                        </td>
                                        <td>
                                            <input type="text" id="no_spb" class="metro-input" data-role="input">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <strong>Asal</strong>
                                        </td>
                                        <td>
                                            <select id="asal" class="metro-input" style="width:100%">
                                            </select>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td>
                                            <strong>Tujuan</strong>
                                        </td>
                                        <td>
                                            <select id="tujuan" class="metro-input" style="width:100%">
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <strong>Timbang 1</strong>
                                        </td>
                                        <td>
                                            <!-- <input type="text" id="tara"  class="metro-input" data-role="input"  readonly> -->

                                            <div class="input mb-1">
                                                <input type="text" readonly id="tara" data-role="input"
                                                    data-clear-button="false" class="metro-input" title=""
                                                    data-role-input="true">
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
                                            <input type="text" id="material" value="TBS" class="metro-input"
                                                data-role="input" value="">
                                        </td>
                                    </tr>


                                </table>

                            </div>

                            <div class="col-md-7">
                                <table class="table compact border ">

                                    <tr>
                                        <td style="width: 120px;">
                                            <strong>No. Kendaraan</strong>
                                        </td>
                                        <td>
                                            <div class="input mb-1">
                                                <input type="text" data-role="input" class="metro-input"
                                                    placeholder="Input Plat Nomor" id="kendaraan">
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

                                    <tr>
                                        <td>
                                            <strong>Divisi/Blok/Tahun Tanam</strong>
                                        </td>
                                        <td>
                                            <input type="text" id="divblok" class="metro-input" data-role="input"
                                                value="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Jumlah Janjang (JJG)</strong>
                                        </td>
                                        <td>
                                            <input type="text" id="jjg" class="metro-input" data-role="input" value="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Brondol</strong>
                                        </td>
                                        <td>
                                            <input type="text" id="brondol" class="metro-input" data-role="input"
                                                value="">
                                            <input type="hidden" id="tglmasuk" class="metro-input" readonly>

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
                                            <button class="button success flat shadowed" id="save_hasil"> <span
                                                    class="mif-floppy-disk"></span> &nbsp; Simpan</button>
                                        </td>
                                        <td>
                                            <button class="button warning flat shadowed" id="reset_data"> <span
                                                    class="mif-refresh"></span> &nbsp; Reset Entry</button>
                                        </td>
                                    </tr>

                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- AREA -->
            <div id="entry2data" class=" h-vh-100  " style="margin:5px;">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-5">
                                <table class="table compact border   ">
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
                                            <strong>Nomor DO</strong>
                                        </td>
                                        <td>
                                            <input type="text" id="no_do2" class="metro-input" disabled
                                                data-role="input">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 90px;">
                                            <strong>Nomor SPB</strong>
                                        </td>
                                        <td>
                                            <input type="text" id="no_spb2" class="metro-input" disabled
                                                data-role="input">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Timbang 1</strong>
                                        </td>
                                        <td>
                                            <input type="text" id="tara2" disabled class="metro-input" data-role="input"
                                                readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Timbang 2</strong>
                                        </td>
                                        <td>

                                            <div class="input mb-1">
                                                <input type="text" readonly id="bruto" data-role="input"
                                                    data-clear-button="false" class="metro-input" title=""
                                                    data-role-input="true">
                                                <div class="button-group">
                                                    <button class="button input-custom-button primary" id="captureTB2"
                                                        tabindex="-1" type="button">Capture</button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <strong>Netto 1</strong>
                                        </td>
                                        <td>
                                            <input type="text" id="netto1" class="metro-input" data-role="input"
                                                readonly>

                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <strong>Penalty<br>Grading</strong>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="cell-md-6">
                                                    <div class="input mb-1">
                                                        <input type="number" placeholder="Penalty" value="0"
                                                            data-role="input" id="penalty" class="metro-input"
                                                            onkeyup="pengurang()" data-role-input="true">
                                                        <div class="button-group">

                                                        </div>
                                                        <div class="append">%</div>
                                                    </div>

                                                    <div class="input mb-1">
                                                        <input type="number" onkeyup="pengurang()" data-role="input"
                                                            value="0" id="grading" placeholder="Grading"
                                                            class="metro-input" data-role-input="true">
                                                        <div class="button-group">

                                                        </div>
                                                        <div class="append">%</div>
                                                    </div>

                                                </div>
                                                <div class="cell-md-6">

                                                    <div class="input mb-1">
                                                        <input type="text" readonly data-role="input" value="0"
                                                            id="penaltykg" placeholder="Grading" class="metro-input"
                                                            data-role-input="true">
                                                        <div class="button-group">

                                                        </div>
                                                        <div class="append">Kg</div>
                                                    </div>
                                                    <div class="input mb-1">
                                                        <input type="text" readonly data-role="input" value="0"
                                                            id="gradingkg" placeholder="Grading" class="metro-input"
                                                            data-role-input="true">
                                                        <div class="button-group">

                                                        </div>
                                                        <div class="append">Kg</div>
                                                    </div>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Netto 2</strong>
                                        </td>
                                        <td>
                                            <input type="text" id="netto" class="metro-input" data-role="input"
                                                readonly>
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



                                </table>

                                <br>

                            </div>

                            <div class="col-md-7">
                                <table class="table compact border ">
                                    <tr>
                                        <td style="width: 120px;">
                                            <strong>No. Kendaraan</strong>
                                        </td>
                                        <td>
                                            <input type="text" id="kendaraan2" class="metro-input" data-role="input"
                                                style="width: 100%;" disabled>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Pengemudi</strong>
                                        </td>
                                        <td>
                                            <input type="text" id="pengemudi2" class="metro-input" data-role="input"
                                                style="width: 100%;" disabled>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Asal</strong>
                                        </td>
                                        <td>
                                            <input type="text" id="asal2" class="metro-input" data-role="input"
                                                style="width: 100%;" disabled>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Tujuan</strong>
                                        </td>
                                        <td>
                                            <input type="text" id="tujuan2" class="metro-input" data-role="input"
                                                disabled style="width: 100%;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Divisi/Blok/Tahun Tanam</strong>
                                        </td>
                                        <td>
                                            <input type="text" id="divblok2" disabled class="metro-input"
                                                data-role="input" value="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Jumlah Janjang (JJG)</strong>
                                        </td>
                                        <td>
                                            <input type="text" id="jjg2" class="metro-input" disabled data-role="input"
                                                value="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Brondol</strong>
                                        </td>
                                        <td>
                                            <input type="text" id="brondol2" class="metro-input" disabled
                                                data-role="input" value="">
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
                                        <td style="width: 120px;">
                                        </td>
                                        <td>
                                            <input type="hidden" id="nama_user_text2" class="metro-input" disabled>
                                        </td>
                                    </tr>
                                    <tr style="display:none;">
                                        <td>
                                            <strong>Tgl Masuk</strong>
                                        </td>
                                        <td>
                                            <input type="text" id="tglmasuk2" class="metro-input" data-role="input"
                                                disabled>
                                        </td>
                                    </tr>
                                    <tr style="display:none;">
                                        <td>
                                            <strong>Tgl Keluar</strong>
                                        </td>
                                        <td>
                                            <input type="text" id="tglkeluar" class="metro-input" data-role="input"
                                                readonly>
                                        </td>
                                    </tr>
                                </table>
                                <table class="table compact border">
                                    <tr>
                                        <td>
                                            <button class="button success flat shadowed" id="save_hasil2"> <span
                                                    class="mif-floppy-disk"></span> &nbsp; Simpan</button>
                                            <a class="button primary flat shadowed" target="_BLANK" id="print" href="#">
                                                <span class="mif-printer"></span> &nbsp; Cetak DO</a>
                                        </td>
                                        <td>
                                            <button class="button  warning flat shadowed" id="reset_data2"> <span
                                                    class="mif-refresh"></span> &nbsp; Reset Entry</button>
                                        </td>
                                    </tr>

                                </table>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
            <!-- AREA -->
            <div id="cetakPrintData" class=" h-vh-100  " style="margin:5px;">
                <div class="row">
                    <div class="col-md-12">
                        <table style="display:inline-table !important;" class="table compact border striped cell-border"
                            id="tampiltransaksi" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tgl</th>
                                    <th>No Tiket</th>
                                    <th>No DO</th>
                                    <th>No SPB</th>
                                    <th>Asal</th>
                                    <th>Tujuan</th>
                                    <th>Kendaraan</th>
                                    <th>Sopir</th>
                                    <th>Timbang 1 (Kg)</th>
                                    <th>Timbang 2 (Kg)</th>
                                    <th>P/G%</th>
                                    <th>Netto (Kg)</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
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
                            <li><a href="#" id="m_asal"><span class="mif-truck icon"></span> Data Asal</a></li>
                            <li><a href="#" id="m_tujuan"><span class="mif-airplane icon"></span> Data Tujuan</a></li>

                        </ul>
                    </div>

                    <!-- ASAL -->
                    <div class="col-md-3" id="m_d_asal">
                        <ul class="v-menu">
                            <li class="menu-title"><span class="mif-add icon"></span> Tambah Data Asal Pengiriman</li>
                            <br>
                            <table style="width:90%;">
                                <tr>
                                    <td style="padding:5px">
                                        <span class="mif-bus icon"></span>
                                    </td>
                                    <td>
                                        <input style="width:100%;" type="text" name="asalxx" id="asalxx"
                                            class="form-control" placeholder="Masukan Asal Pengiriman">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:5px">
                                        <span class="mif-bus icon"></span>
                                    </td>
                                    <td>
                                        <input style="width:100%;" type="text" name="kode_surat" id="kode_surat"
                                            class="form-control" placeholder="Masukan Kode Singkat">
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:10px">
                                    </td>
                                    <td>
                                        <br>
                                        <center>
                                            <button class="button success flat small shadowed" id="add_asal"> <span
                                                    class="mif-floppy-disk"></span> &nbsp; Simpan</button>
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
                                    <th>Asal Pengiriman</th>
                                    <th style="width:10px">Kode</th>
                                    <th style="width:10px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="t_asal_body">

                            </tbody>
                        </table>

                    </div>

                    <!-- DATAAA -->
                    <!-- TUJUAN -->
                    <div class="col-md-3" id="m_d_tujuan">
                        <ul class="v-menu">
                            <li class="menu-title"><span class="mif-add icon"></span> Tambah Data Tujuan Pengiriman</li>
                            <br>
                            <table style="width:90%;">
                                <tr>
                                    <td style="padding:5px">
                                        <span class="mif-bus icon"></span>
                                    </td>
                                    <td>
                                        <input style="width:100%;" type="text" name="tujuanxx" id="tujuanxx"
                                            class="form-control" placeholder="Masukan Tujuan Pengiriman">
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:10px">
                                    </td>
                                    <td>
                                        <br>
                                        <center>
                                            <button class="button success flat small shadowed" id="add_tujuan"> <span
                                                    class="mif-floppy-disk"></span> &nbsp; Simpan</button>
                                        </center>
                                        <br>
                                    </td>
                                </tr>
                            </table>

                        </ul>
                    </div>


                    <div class="col-md-7" id="m_d_tujuan2">
                        <input type="text" class="form-control mb-3 tablesearch-input"
                            data-tablesearch-table="#t_tujuan" placeholder="Cari Data....">
                        <table style="display:inline-table !important;"
                            class="table  tablesearch-table compact border striped cell-border" id="t_tujuan"
                            width="100%">
                            <thead>
                                <tr>
                                    <th style="width:10px">No</th>
                                    <th>Tujuan Pengiriman</th>
                                    <th style="width:10px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="t_tujuan_body">

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
        <div class="info-box" id="info-box-1" data-role="infobox">
            <span class="button square closer va-middle"></span>
            <div class="info-box-content">
                <input type="text" class="form-control mb-3 tablesearch-input" data-tablesearch-table="#tampil"
                    placeholder="Cari Data....">
                <table style="display:inline-table !important;"
                    class="table  tablesearch-table compact border striped cell-border" id="tampil" width="100%">
                    <thead>
                        <tr>
                            <th>No Tiket</th>
                            <th>Nomor SPB</th>
                            <th>Nomor DO</th>
                            <th>Kendaraan</th>
                            <th>Sopir</th>
                            <th>Timbang 1 (Kg)</th>
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
            <span class="button square closer va-middle"></span>
            <div class="info-box-content">

                <textarea rows="3" class="textarea" style="min-height:300px" id="receive_textarea" readonly></textarea>

            </div>
        </div>


        <script defer src="assets/js/metro-4.4.3.js"></script>
    </body>

</html>
<script type="text/javascript">
    var newOption = document.createElement("option");
    newOption.text = "Loading.."; // Teks untuk pilihan baru
    newOption.value = "prompt"; // Nilai untuk pilihan baru 
    var select = document.getElementById("ports");
    setTimeout(function () {
        select.appendChild(newOption);
    }, 100);
</script>