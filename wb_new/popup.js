
$('#popupData').on('click', function() {  
    createInfoBox(1);

}); 


$('#popupDataKendaraan').on('click', function() {  
    createInfoBox(2);

}); 


$('#popupDataPengemudi').on('click', function() {  
    createInfoBox(3);

}); 


$('#check_raw').on('click', function() {  
    createInfoBox(4);

}); 


function createInfoBox(t){ 
    $('#info-box-'+t).data('infobox').open();
}


function load_table(){

 $.ajax({ 
    url: API+'timbangan.php', 
    type: "POST", 
    dataType: "json",
    timeout: 10000,
    data : {load_table:1},
    success: function(response){   
     var no =1;
     $("#tampil_body").empty();
     for (var i = 0; i < response.data.length; i++) {
        tr = $('<tr/>'); 


        tr.append("<td  data-tablesearch-text='"+response.data[i]['tiket']+"' ><button   class='button small' onclick=\"getData('"+response.data[i]['id']+"')\" data-tiket='"+response.data[i]['id']+"'>"+response.data[i]['tiket']+"</button></td>"); 

        tr.append("<td data-tablesearch-text='"+response.data[i]['mode_timbang']+"' >" + response.data[i]['mode_timbang'] + "</td>");
        tr.append("<td data-tablesearch-text='"+response.data[i]['gudang']+"' >" + response.data[i]['gudang'] + "</td>");
        tr.append("<td data-tablesearch-text='"+response.data[i]['plate_recognize']+"' >" + response.data[i]['plate_recognize'] + "</td>");
        tr.append("<td data-tablesearch-text='"+response.data[i]['kendaraan']+"' >" + response.data[i]['kendaraan'] + "</td>");
        tr.append("<td data-tablesearch-text='"+response.data[i]['pengemudi']+"' >" + response.data[i]['pengemudi'] + "</td>"); 
        tr.append("<td data-tablesearch-text='"+response.data[i]['taraOCR']+"' >" + response.data[i]['taraOCR'] + "</td>");
        tr.append("<td data-tablesearch-text='"+response.data[i]['tara']+"' >" + response.data[i]['tara'] + "</td>");
        tr.append("<td data-tablesearch-text='"+response.data[i]['tujuan']+"' >" + response.data[i]['tujuan'] + "</td>");
        tr.append("<td data-tablesearch-text='"+response.data[i]['asal']+"' >" + response.data[i]['asal'] + "</td>"); 
        tr.append("<td data-tablesearch-text='"+response.data[i]['material']+"' >" + response.data[i]['material'] + "</td>");

        tr.append("<td data-tablesearch-text='"+response.data[i]['tgl']+"' >" + response.data[i]['tgl'] + "</td>");

        $('#tampil_body').append(tr);
        no++;

    } 
    var headers = $('#tampil thead th'); 
    $(headers[2]).attr('data-tablesort-type', 'date'); 
    $('table').not(".tablesort").addClass('tablesort');

},
error : function(xhr, response, error){
    console.log(xhr);
    console.log(response);
    console.log(error); 
}
}); 
}

// $('#'+response.data[i]['tiket']).on('click', function(){ 
//  console.log($(this).data('tiket'));
//  getData($(this).data('tiket'));
//  $('#info-box-1').data('infobox').close();
// });
function load_kendaraan_inquiry(){

 $.ajax({ 
    url: API+'master.php', 
    type: "POST", 
    dataType: "json",
    timeout: 10000,
    data : {data_kendaraan:1},
    success: function(response){  
        $("#tampilKendaraanBody").empty();  
        for (var i = 0; i < response.data.length; i++) { 
            tr = $('<tr/>'); 
            tr.append("<td  data-tablesearch-text='"+response.data[i]['nopol']+"' ><button id='nop"+response.data[i]['id']+"' class='button small'  data-nopol='"+response.data[i]['nopol']+"' data-id='"+response.data[i]['id']+"'>+ Tambah</button></td>"); 
            tr.append("<td  data-tablesearch-text='"+response.data[i]['nopol']+"'  style='text-align:center;' >" + response.data[i]['nopol'] + "</td>");
            tr.append("<td  data-tablesearch-text='"+response.data[i]['jenis_kendaraan']+"'  style='text-align:center;'>" + response.data[i]['vendor'] + "</td>");
            $('#tampilKendaraanBody').append(tr); 
            $('#nop'+response.data[i]['id']).on('click', function(){  
                $('#kendaraan').val($(this).data('nopol'));
                $('#kendaraanID').val($(this).data('id'));
                $('#info-box-2').data('infobox').close();
            });
        }
    },
    error : function(xhr, response, error){
        console.log(xhr);
        console.log(response);
        console.log(error); 
    }
});  
}


function load_sopir_inquiry(){

 $.ajax({ 
    url: API+'master.php', 
    type: "POST", 
    dataType: "json",
    timeout: 10000,
    data : {data_sopir:1},
    success: function(response){  
        $("#tampilSopirBody").empty();  
        for (var i = 0; i < response.data.length; i++) { 
            tr = $('<tr/>'); 
            tr.append("<td  data-tablesearch-text='"+response.data[i]['id']+"' ><button id='sopir"+response.data[i]['id']+"' class='button small'  data-sopir='"+response.data[i]['nama_sopir']+"' data-id='"+response.data[i]['id']+"'>+ Tambah</button></td>"); 
            tr.append("<td  data-tablesearch-text='"+response.data[i]['nama_sopir']+"'  style='text-align:center;'>" + response.data[i]['nama_sopir'] + "</td>");
            tr.append("<td  data-tablesearch-text='"+response.data[i]['vendor']+"'  style='text-align:center;' >" + response.data[i]['vendor'] + "</td>");

            $('#tampilSopirBody').append(tr); 
            $('#sopir'+response.data[i]['id']).on('click', function(){  
                $('#pengemudi').val($(this).data('sopir'));
                $('#pengemudiID').val($(this).data('id'));
                $('#info-box-3').data('infobox').close();
            });
        }
    },
    error : function(xhr, response, error){
        console.log(xhr);
        console.log(response);
        console.log(error); 
    }
});  
}

function getData(kodeLama){ 
 $('#info-box-1').data('infobox').close();
 $("#deleteData").removeAttr('disabled');                

 $.ajax({ 
    url:  API+'/timbangan.php',
    data : {timbangisi:1,kodeLama:kodeLama},
    type: "POST", 
    dataType: "json",
    timeout: 10000,
    success: function(response){ 
        console.log(response);    
        $("#plate_recognize2x").val("");
        $("#plat_correct2x").val("");
        
        $("#bruto").val("");
        $("#brutoOCR").val("");
        $("#netto").val("");

        $("#kodeLama").val(response.tiket);  
        $("#taraOCR2").val(response.taraOCR);  
        $("#tara2").val(response.tara);  
        $("#idtkt").val(response.id);  
        $("#material2").val(response.material); 
        $("#tglmasuk2").val(response.tgl); 
        $("#plate_recognize2").val(response.plate_recognize); 
        $("#plat_correct2").val(response.kendaraan); 
        $("#pengemudi2").val(response.pengemudi); 
        $("#asal2").val(response.asal); 
        $("#tujuan2").val(response.tujuan); 
        $("#catatan2").val(response.catatan); 
        $("#nama_user_text2").val(response.nama_user); 
        $("#print").attr('href', SERVER+"page/Report/surat_jalan.php?tiket="+response.id);
        $("#print_pos").attr('href', SERVER+"page/Report/surat_jalan_pos.php?tiket="+response.id);
            // $("#ambil2").attr('href',SERVER+'CCTV/index.php?tiket='+response.tiket+"&cam=2");  
            // $("#reload_gambar2").attr('data-tiket',response.tiket); 
            // add
        $('#gudang2').val(response.gudang); 
        $('#mode2').val(response.mode_timbang); 
        $('#no_do2').val(response.no_do); 
        
        $('#hpp2').val(response.harga_pokok);  
        $('#hjp2').val(response.harga_jual); 

        if(response.mode_timbang == 'Pengiriman'){
            $('#tujuanMode2').show();
            $('#asalMode2').hide();
            $("#hjpMode").show();
        }else{
            $('#tujuanMode2').hide();
            $('#asalMode2').show();
            $("#hjpMode").hide();


        }
    },
    error : function(xhr, response, error){
        console.log(xhr);
        console.log(response);
        console.log(error); 
        $("#kodeLama").val('ID Tidak diketahui!'); 
    }
});  
};

