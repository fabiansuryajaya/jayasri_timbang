function exportExcel() {
    var tgl1 = $("#f_tgl1").val();
    var tgl2 = $("#f_tgl2").val();
    var f_jenis = $("#f_jenis").val();
    var f_customer = $("#f_customer").val();
    var f_supplier = $("#f_supplier").val();
    var f_material = $("#f_material").val();


    window.open(SERVER + 'page/Report/mkj/data_report_excel.php?tgl1=' + tgl1 + '&tgl2=' + tgl2 + '&f_jenis=' + f_jenis + '&f_customer=' + f_customer + '&f_supplier=' + f_supplier + '&f_material=' + f_material, '_BLANK');

}
$('#filter_data').on('click', function () {
    load_table_transaksi();
});

function load_table_transaksi() {
    var tgl1 = $("#f_tgl1").val();
    var tgl2 = $("#f_tgl2").val();
    var f_jenis = $("#f_jenis").val();
    var f_customer = $("#f_customer").val();
    var f_supplier = $("#f_supplier").val();
    var f_material = $("#f_material").val();

    $.ajax({
        url: API + 'timbangan.php',
        type: "POST",
        dataType: "json",
        timeout: 10000,
        data: { load_table_transaksi: 1, tgl1, tgl2, f_jenis, f_customer, f_supplier, f_material },
        success: function (response) {
            $('#tampiltransaksi').empty();
            tr = $('<tr/>');

            var no = 1;


            for (var i = 0; i < response.data.length; i++) {
                var no = (i + 1);
                tr = $('<tr/>');
                tr.append("<td  style='background-color: #5ebdec; color: white; font-weight: bold; text-align:center;'>" + no + "</td>");
                tr.append("<td  style='text-align:center;' ><button class='button mini info' onclick='detail(" + response.data[i]['id'] + ")'>" + response.data[i]['tiket'] + "</button></td>");
                tr.append("<td  style='text-align:center;'>" + response.data[i]['mode_timbang'] + "</td>");
                tr.append("<td  style='text-align:center;'>" + response.data[i]['tgl_masuk'] + "</td>");

                tr.append("<td  style='text-align:center;' >" + response.data[i]['gudang'] + "</td>");
                tr.append("<td  style='text-align:center;' >" + response.data[i]['kendaraan'] + "<br>" + response.data[i]['kendaraan2'] + "</td>");
                tr.append("<td  style='text-align:center;' >" + response.data[i]['plate_recognize'] + "<br>" + response.data[i]['plate_recognize2'] + "</td>");
                tr.append("<td  style='text-align:center;' >" + response.data[i]['pengemudi'] + "</td>");
                tr.append("<td>" + response.data[i]['tujuan'] + "</td>");
                tr.append("<td>" + response.data[i]['asal'] + "</td>");
                tr.append("<td>" + response.data[i]['timbang1'] + "</td>");
                tr.append("<td>" + response.data[i]['ocrTimbang1'] + "</td>");
                tr.append("<td>" + response.data[i]['timbang2'] + "</td>");
                tr.append("<td>" + response.data[i]['ocrTimbang2'] + "</td>");
                tr.append("<td>" + response.data[i]['netto'] + "</td>");
                tr.append("<td>" + response.data[i]['material'] + "</td>");


                $('#tampiltransaksi').append(tr);
                no++;

                // tr.append("<td  style='text-align:center;' ><a  target='_BLANK'   href='"+SERVER+"page/Report/surat_jalan.php?tiket="+response.data[i]['id']+"'><i class='mif-list icon'></i>&nbsp;" + response.data[i]['tiket'] + "</a></td>");

            }
        },
        error: function (xhr, response, error) {
            console.log(xhr);
            console.log(response);
            console.log(error);
        }
    });

}

function detail(e) {

    $.ajax({
        url: API + 'timbangan.php',
        type: "POST",
        dataType: "json",
        timeout: 10000,
        data: { detail_data: e },
        success: function (res) {
            $("#cetakSJ").attr('href', SERVER + "page/Report/surat_jalan.php?tiket=" + res.data[0].id);

            $("#cetakSJPOS").attr('href', SERVER + "page/Report/surat_jalan_pos.php?tiket=" + res.data[0].id);

            $("#d_no_tiket").html(res.data[0].tiket);
            $("#d_jenis").html(res.data[0].mode_timbang);
            $("#d_gudang").html(res.data[0].gudang);
            $("#d_plate_recognize").html(res.data[0].plate_recognize);
            $("#d_kendaraan").html(res.data[0].kendaraan);
            $("#d_no_tiket").html(res.data[0].tiket);
            $("#d_pengemudi").html(res.data[0].pengemudi);
            $("#d_customer").html(res.data[0].tujuan);
            $("#d_supplier").html(res.data[0].asal);
            $("#d_catatan").html(res.data[0].catatan);
            $("#d_tgl_masuk").html(res.data[0].tgl_masuk);
            $("#d_tgl_keluar").html(res.data[0].tgl_keluar);
            $("#d_timbang1").html(res.data[0].timbang1);
            $("#d_timbang1ocr").html(res.data[0].ocrTimbang1);
            $("#d_timbang2").html(res.data[0].timbang2);
            $("#d_timbang2ocr").html(res.data[0].ocrTimbang2);
            $("#d_material").html(res.data[0].material);
            $("#d_netto").html(res.data[0].netto);
            // $("#cam1-IN").attr('src',SERVER+'CCTV/car/'+res.data[0].tiket+'-IN-cam1.jpeg');
            // $("#cam2-IN").attr('src',SERVER+'CCTV/car/'+res.data[0].tiket+'-IN-cam1.jpeg');
            // $("#cam1-OUT").attr('src',SERVER+'CCTV/car/'+res.data[0].tiket+'-OUT-cam1.jpeg');
            // $("#cam2-OUT").attr('src',SERVER+'CCTV/car/'+res.data[0].tiket+'-OUT-cam1.jpeg');
        },
        error: function (xhr, response, error) {
            console.log(xhr);
            console.log(response);
            console.log(error);
        }
    });
}