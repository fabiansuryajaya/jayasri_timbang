var SERVER = window.location.protocol + "//" + window.location.host + '/jayasri/';
var API = window.location.protocol + "//" + window.location.host +  '/jayasri/API/';


$(document).ready(function() {  
    $("#version").html('Versi 4');
    $('#content').show();   
    // $('#login').hide();   
    $('#tentang').hide();    
    $('#entry1data').hide();    
    $('#entry2data').hide();    
    $('#masterData2').hide();    
    $('#cetakPrintData').hide();    
    


});



function err(e)
{
  var info = "<h5 >Error!</h5>" +
  e;
  Metro.infobox.create(info,"",{
    closeButton: true,
    autoHide: 3000
}); 
}


$('#ambil2').on('click',function(){  
    if($('#kodeLama').val() == '')
    {
        $("#ambil2").attr('target',"");   
        console.log('error tiket kosong');
        err('Tiket Kosong.')
    }else{
        $("#ambil2").attr('target',"_BLANK");   

    }
});
$('#print').on('click',function(){  
    if($('#kodeLama').val() == '')
    {
        $("#print").attr('target',"");   
        console.log('error tiket kosong');
        err('Tiket Kosong.')
    }else{
        $("#print").attr('target',"_BLANK");   

    }
});

$('#save_hasil2').on('click',function(){  
    if($('#kodeLama').val() == '')
    { 
        console.log('error tiket kosong');
        err('Tiket Kosong.')
    }else{
       $(this).html('Process..');
       $(this).attr('disabled','disabled');
       $("#deleteData").attr('disabled','disabled');

       save_hasil2();
   } 
});


$('#save_hasil').on('click',function(){  
    if($('#taraOCR').val() < 1)
    {  
        console.log('error tara kosong');
        err('Timbang 1 Kosong.');
    }else if($('#plate_recognize').val() === ''){
        err('Nopol Harus Diisi.');
    }else if($('#pengemudi').val() === ''){
        err('Sopir Harus Diisi.');
    }else{
     $(this).html('Process..');
     $(this).attr('disabled','disabled');
     save_hasil();
 } 
}); 

function no_record(){ 
//no record otomatis 
    var mode;
    if ($("#switchMode").is(':checked')) {
        mode = "01"; //pengiriman
    }else{
        mode = "02"; //penerimaan
    }

    $.ajax({ 
        url: API+'timbangan.php?record='+mode, 
        type: "get", 
        dataType: "json",
        timeout: 10000,
        success: function(response){  
            $("#no_tiket").val(response.tiket);   
            $("#gudang").val(response.gudang);   
            $("#material").val(response.material);   
            $("#hpp").val(response.hpp);   
            $("#hjp").val(response.hjp);   
            $("#id_material").val(response.id_material);   

        },
        error : function(xhr, response, error){
            console.log(xhr);
            console.log(response);
            console.log(error); 
        }
    }); 
};

// Ceklis switch camera
function switchMode(){ 
    if ($("#switchMode").is(':checked')) {
        $('#statusMode').html('Mode Pengiriman Aktif');
        $('#statusMode').removeClass('warning');
        $('#statusMode').addClass('success');
        // $("#cam1-1").show();
        $("#tujuanMode").show();
        $("#asalMode").hide();

    } else {
        // $("#cam1-1").hide();
        // $("#cam2-2").prop('hidden',false);
        $("#asalMode").show();
        $("#tujuanMode").hide();

        $('#statusMode').html('Mode Penerimaan Aktif');  
        $('#statusMode').removeClass('success');
        $('#statusMode').addClass('warning');
    } 
    no_record();
}
switchMode();

$('#captureTB').on('click', function() {  
    var today = new Date();
    var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
    var time =  ('0'+today.getHours()).slice(-2) + ":" + today.getMinutes() + ":" + today.getSeconds();

    var hsl = $('#hasilkg').val(); 
    $('#tara').val(hsl);  
    $('#tglmasuk').val(date+' '+time); 
    getOCR('taraOCR','IN','captureTB');

});
// Koreksi Plat
function koreksi(e)
{
   $('#'+e).removeAttr('disabled');
   $('#'+e).removeClass('disabled'); 
   $('#'+e).focus();  
}
// LOG
function captureLog(tiket, type) {
    var id;
    if (type == "IN") {
        id = 'tangkapGambar1';
    } else {
        id = 'tangkapGambar2';
    }
    console.log(id);
    const today = new Date();
    const year = today.getFullYear(); 
    const month = String(today.getMonth() + 1).padStart(2, '0'); // Months are zero-based
    const day = String(today.getDate()).padStart(2, '0');

    const todaysDate = `${year}${month}${day}`; 
    if(type == "IN"){
    // URLs of the images to append


        var image1 = SERVER+'CCTV/car/'+todaysDate + '/' + tiket + '-IN-cam1.jpeg';
        var image2 = SERVER+'CCTV/car/'+todaysDate + '/' + tiket + '-IN-cam2.jpeg';
        var image3 = SERVER+'CCTV/car/'+todaysDate + '/' + tiket + '-IN-cam3.jpeg';
        var image4 = SERVER+'CCTV/car/'+todaysDate + '/' + tiket + '-IN-cam4.jpeg';

    // Create a container to hold the original element and additional images
        var container = document.createElement('div');
        var originalElement = document.querySelector("#" + id);

    // Clone the original element and append it to the container
        var clonedElement = originalElement.cloneNode(true);
        container.appendChild(clonedElement);

    // Create a grid layout container for images
        var imageGrid = document.createElement('div');
        imageGrid.style.display = 'grid';
    imageGrid.style.gridTemplateColumns = '1fr 1fr'; // Two columns
    imageGrid.style.gap = '10px'; // Space between images
    imageGrid.style.marginTop = '10px';

    // Create and append image elements
    [image1, image2, image3, image4].forEach((src) => {
        var img = document.createElement('img');
        img.src = src;
        img.style.width = '300px'; // Make images fill their grid cell
        img.style.height = 'auto';
        imageGrid.appendChild(img);
    });
}else{
        // URLs of the images to append


    var image1 = SERVER+'CCTV/car/'+todaysDate + '/' + tiket + '-IN-cam1.jpeg';
    var image2 = SERVER+'CCTV/car/'+todaysDate + '/' + tiket + '-IN-cam2.jpeg';
    var image3 = SERVER+'CCTV/car/'+todaysDate + '/' + tiket + '-IN-cam3.jpeg';
    var image4 = SERVER+'CCTV/car/'+todaysDate + '/' + tiket + '-IN-cam4.jpeg';
    var image5 = SERVER+'CCTV/car/' +todaysDate + '/' +  tiket + '-OUT-cam1.jpeg';
    var image6 = SERVER+'CCTV/car/' +todaysDate + '/' +  tiket + '-OUT-cam2.jpeg';
    var image7 = SERVER+'CCTV/car/' +todaysDate + '/' +  tiket + '-OUT-cam3.jpeg';
    var image8 = SERVER+'CCTV/car/' +todaysDate + '/' +  tiket + '-OUT-cam4.jpeg';

    // Create a container to hold the original element and additional images
    var container = document.createElement('div');
    var originalElement = document.querySelector("#" + id);

    // Clone the original element and append it to the container
    var clonedElement = originalElement.cloneNode(true); 
    container.appendChild(clonedElement);

    // Create a grid layout container for images
    var imageGrid = document.createElement('div');
    imageGrid.style.display = 'grid';
    imageGrid.style.gridTemplateColumns = '1fr 1fr'; // Two columns
    imageGrid.style.gap = '10px'; // Space between images
    imageGrid.style.marginTop = '10px';

    // Create and append image elements
    [image1, image2, image3, image4,image5, image6,image7,image8].forEach((src) => {
        var img = document.createElement('img');
        img.src = src;
        img.style.width = '300px'; // Make images fill their grid cell
        img.style.height = 'auto';
        imageGrid.appendChild(img);
    });
}

    // Append the image grid to the container
container.appendChild(imageGrid);

    // Append the container to the body temporarily
container.style.position = 'absolute';
    container.style.left = '-9999px'; // Move off-screen
    document.body.appendChild(container);
    // Capture the container with html2canvas
    html2canvas(container).then(canvas => {
        let imageData = canvas.toDataURL("image/jpeg");

        // Send the captured image data to the server
        $.ajax({
            url: API + 'capLog.php',
            type: 'POST',
            data: { image: imageData, tiket },
            success: function(response) {
                console.log("Cap LOG :");                
                console.log('Image saved successfully: ' + response);

                //no record otomatis
                $('#tara').val("");
                $('#tglmasuk').val("");
                $('#material').val(""); 
                $('#kendaraan').val("");
                $('#pengemudi').val("");
                $('#asal').val(""); 
                $('#tujuan').val(""); 
                $('#catatan').val("");    

                $('#gudang').val("");  
                $('#taraOCR').val("");  
                $('#plate_recognize').val("");  

                $("#switchMode").val("");

                $('#hpp').val("");  
                $('#hjp').val("");  
                $('#id_material').val("");  

                no_record();  
                var info2 = "<h5 >Berhasil Disimpan</h5>"
                Metro.infobox.create(info2,"",{
                    closeButton: true,
                    autoHide: 3000
                }); 
                $("#save_hasil").html(' <span class="mif-floppy-disk"></span> &nbsp; Simpan');
                $("#save_hasil").removeAttr('disabled');

                $("#save_hasil2").html(' <span class="mif-floppy-disk"></span> &nbsp; Simpan');
                $("#save_hasil2").removeAttr('disabled');
            },
            error: function() {
              var info2 = "<h5 >Gambar gagal disimpan</h5>"
              Metro.infobox.create(info2,"",{
                closeButton: true,
                autoHide: 3000
            }); 
          }
      }); 

        // Clean up: remove the container after capture
        document.body.removeChild(container);
    });
}
function captureCCTV(tiket,type)
{     

    if(tiket !=''){
        $.ajax({ 
            url:  API+'capCCTV.php', 
            type: 'POST',
            data : {tiket,type}, 
            dataType: "html",
            timeout: 1000000,
            success: function(response){   
                console.log("Cap CCTV :");
                console.log(response);
                  setTimeout(function() {
                    captureLog(tiket, type);
                }, 1000);
            },
            error: function(jqXHR, textStatus, errorThrown) {  
                err('CCTV Tidak terhubung, periksa kembali koneksi CCTV');
            }
        }); 
    }else{
        err('Kode Tiket tidak tersedia');
    }
}   
function autoC(value,id,idlist)
{

    if(value != '')  
    {  
        $.ajax({  
           url:"autoC.php",  
           method:"POST",  
           data:{cari:value, id,idlist},  
           success:function(data)  
           {   
              $('#'+idlist).fadeIn();  
              $('#'+idlist).html(data);  
          }  
      });  

        $("#hpp").val("");   
        $("#hjp").val("");   
        $("#id_material").val("");  
    }  
}
// Klik list di autocomplete untuk set inputan
function setData(id,idlist,id_material,nama_produk,satuan,hpp,hjp)
{
    $("#"+id).val(nama_produk);
    $("#id_material").val(id_material);
    $("#hpp").val(hpp);
    $("#hjp").val(hjp);

    $("#"+idlist).fadeOut(); 

}


function save_hasil(){  
    var no_tiket    =  $('#no_tiket').val();
    var tara        =  $('#tara').val();
    var tglmasuk    =  $('#tglmasuk').val();
    var material    =  $('#material').val(); 
    var kendaraan   =  $('#plat_correct').val();
    var pengemudi   =  $('#pengemudi').val();
    var asal        =  $('#asal').val(); 
    var tujuan      =  $('#tujuan').val(); 
    var catatan     =  $('#catatan').val();  
    // material
    var hpp     =  $('#hpp').val();  
    var hjp     =  $('#hjp').val();  
    var id_material     =  $('#id_material').val();  

        // add
    var gudang       =  $('#gudang').val();  
    var taraOCR        =  $('#taraOCR').val();
    var plate_recognize       =  $('#plate_recognize').val();  

    // mode 
    var mode;
    if ($("#switchMode").is(':checked')) {
        mode = "Pengiriman"; //pengiriman
    }else{
        mode = "Penerimaan"; //penerimaan
    }

    var dataPost = {save_hasil:1,
        tiket:no_tiket,
        kendaraan:kendaraan,
        plate_recognize:plate_recognize,
        pengemudi:pengemudi,  
        asal:asal,   
        material:material,
        tara:tara,
        taraOCR:taraOCR,
        catatan:catatan, 
        gudang,
        tglmasuk, 
        asal,
        tujuan,
        mode,
        hpp,
        hjp,
        id_material };
        $.ajax({ 
            url:  API+'/timbangan.php',
            type: 'POST',
            data : dataPost, 
            dataType: "json",
            timeout: 10000,
            success: function(response){  

                if(response.code == 200){
                    captureCCTV(no_tiket,'IN');
                }else{ 
                    no_record();  
                    var info2 = "<h5 >"+response.message+"</h5>"
                    Metro.infobox.create(info2,"",{
                        closeButton: true,
                        autoHide: 3000
                    }); 
                }
                console.log(response); 
            },
            error: function(){
                console.log('error');
            }
        });  

    };

// ==================== KODE LAMA / TIMBANG ISI ============= //

    function formatNumberWithDots(number, decimals) {
        let parts = number.toFixed(decimals).split('.');
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        return parts.join(',');
    }
    $('#captureTB2').on('click', function() {  

       getOCR('brutoOCR','OUT','captureTB2');


   }); 
    function cleanNumber(input) { 
        let cleanedInput = input.replace(/,/g, ''); 
        let number = parseFloat(cleanedInput);

        return number;
    }
    function formatNumberWithDots(number, decimals) {
        let parts = number.toFixed(decimals).split('.');
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        return parts.join(',');
    }
    function save_hasil2(){ 

        var no_tiket    =  $('#kodeLama').val();
        var id          =  $('#idtkt').val();
        var timbang2    =  $('#bruto').val();
        var timbang2ocr    =  $('#brutoOCR').val();
        var totalhjp  =  $('#totalhjp').val(); 
        var hpp_total  =  $('#hpp_total').val();  

        var plate_recognize2x  =  $('#plate_recognize2x').val();  
        var plat_correct2x  =  $('#plat_correct2x').val();  
        $.ajax({ 
            url:  API+'/timbangan.php',
            type: 'POST',
            data : {save_hasil2:1, tiket:no_tiket, id:id, timbang2,timbang2ocr, totalhjp,hpp_total, plate_recognize2:plate_recognize2x, plat_correct2:plat_correct2x}, 
            dataType: "json",
            timeout: 1000,
            success: function(response){   
                load_table();  
                if(response.code == 200){
                    captureCCTV(no_tiket,'OUT');
                }else{ 
                    no_record();  
                    var info2 = "<h5 >"+response.message+"</h5>"
                    Metro.infobox.create(info2,"",{
                        closeButton: true,
                        autoHide: 3000
                    }); 
                }
                console.log(response);  
            },
            error: function(xhr, response, error){
                console.log(xhr);
                console.log(response);
                console.log(error);
            }
        });  
    };

    $('#reset_data2').on('click', function() {   
//no record otomatis
        $('#kodeLama').val("");
        $('#tara2').val("");
        $('#material2').val(""); 
        $('#plate_recognize2').val("");
        $('#plat_correct2').val("");
        $('#pengemudi2').val("");
        $('#asal2').val(""); 
        $('#tujuan2').val(""); 
        $('#catatan2').val("");   
        $('#tglmasuk2').val("");    
        $('#tglkeluar').val("");    
        $('#bruto').val("");    
        $('#taraOCR2').val("");    
        $('#brutoOCR').val("");    
        $('#netto').val("");    
        $('#nama_user_text2').val(""); 


        $("#plate_recognize2x").val("");
        $("#plat_correct2x").val(""); 
  // add
        $('#gudang2').val("");  
        $('#hpp2').val("");  
        $('#hpp_total').val("");  
        $('#hjp2').val("");  
        $('#totalhjp').val("");  
        $('#mode2').val("");  
    }); 

    $('#reset_data').on('click', function() {   
//no record otomatis
        $('#tara').val("");
        $('#material').val(""); 
        $('#kendaraan').val("");
        $('#pengemudi').val("");
        $('#asal').val(""); 
        $('#catatan').val("");   
        $('#tglmasuk').val("");  
// add
        $('#gudang').val("");  
        no_record(); 
    }); 



    $('#logout').on('click', function() {  

        $('#content').hide();   
        $('#login').show();   

    }); 
// Fungsi untuk mengubah format plat nomor
    function formatPlatNomor(platNomor) {
    // Pisahkan huruf dan angka
        var matches = platNomor.match(/([a-zA-Z]+)(\d+)([a-zA-Z]*)/);

        if (!matches) {
        return platNomor; // Return original jika format tidak sesuai
    }

    var huruf = matches[1].toUpperCase();
    var angka = matches[2];
    var karakterLain = matches[3].toUpperCase();

    // Ubah format
    var platFormatted = huruf + " " + angka + " " + karakterLain;

    return platFormatted.trim(); // Hapus spasi ekstra jika ada
}

function getPlate(id,type)
{    
 var cam = 'cam1';
 var tiket;
 if(type == 'OUT'){
 tiket = document.getElementById('kodeLama').value; 

 $('#PlateOCR2').html('<span class="mif-hour-glass"></span>'); 

 }else{
 tiket = document.getElementById('no_tiket').value; 

 $('#PlateOCR').html('<span class="mif-hour-glass"></span>'); 

 }

 if(tiket !=''){
    $.ajax({ 
        // url:  API+'recognizeBasic.php',
        url:  API+'recognizeDigest.php',
        type: 'POST',
        data : {tiket,type,cam}, 
        dataType: "html",
        timeout: 1000000,
        success: function(response){  

            console.log(response); 
            // $("#file_cctv").val(tiket+"-"+type+"-"+cam+".jpeg"); 

            var dataX = JSON.parse(response); 
            if (dataX.results.length > 0) {  
                $('#'+id).val(formatPlatNomor(dataX.results[0].plate)); 
            } else {

                $("#"+id).val("Tidak Terdeteksi");
                err('Plat tidak terdeteksi. coba capture kembali!');
                    if(type == 'OUT'){
                        koreksi('plat_correct2x');
                    }else{
                        koreksi('plat_correct');                    
                    }
                console.log('Plat tidak terdeteksi. coba capture kembali!');  
            }  
            if(type == 'OUT'){
            $('#PlateOCR2').html('<span class="mif-refresh"></span>');
        }else{
            $('#PlateOCR').html('<span class="mif-refresh"></span>');
        }

        },
        error: function(jqXHR, textStatus, errorThrown) { 
            console.log(textStatus);
            console.log(errorThrown);
            console.log(jqXHR);
            $('#'+id).val('Server Disconnect'); 
            $('#PlateOCR').html('<span class="mif-refresh"></span>');  
            $('#PlateOCR2').html('<span class="mif-refresh"></span>');  
            err('CCTV Tidak terhubung, periksa kembali koneksi CCTV');
        }
    }); 
}else{
    err('Kode Tiket tidak tersedia');
}
} 


function getOCR(id,type,idButton)
{    
 var cam = 'cam3';
 var tiket;
 if(type=='OUT'){
 tiket = document.getElementById('kodeLama').value; 
}else{
     tiket = document.getElementById('no_tiket').value; 
}
 $('#'+idButton).html('<span class="mif-hour-glass"></span>'); 

 if(tiket !=''){
    $.ajax({ 
        // url:  API+'recognizeBasic.php',
        url:  API+'OcrDigest.php',
        type: 'POST',
        data : {tiket,type,cam}, 
        dataType: "html",
        timeout: 1000000,
        success: function(response){  

            console.log(response); 
            // $("#file_cctv").val(tiket+"-"+type+"-"+cam+".jpeg"); 

            var dataX = JSON.parse(response); 
            if (dataX.results.length > 0) {  
                $('#'+id).val(dataX.results[0].plate); 
               
        } else {

            $("#"+id).val("Tidak Terdeteksi");
            err('tidak terdeteksi. coba capture kembali!'); 
            console.log('Tidak terdeteksi. coba capture kembali!');  
        }  



        $('#'+idButton).html('<span class="mif-refresh"></span>');

    },
    error: function(jqXHR, textStatus, errorThrown) { 
        console.log(textStatus);
        console.log(errorThrown);
        console.log(jqXHR);
        $('#'+id).val('Server Disconnect'); 
        $('#'+idButton).html('<span class="mif-refresh"></span>');  
        err('CCTV Tidak terhubung, periksa kembali koneksi CCTV');
    }
}); 

     if(type == 'OUT'){

                    var today = new Date();
                    var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
                    var time =  ('0'+today.getHours()).slice(-2) + ":" + today.getMinutes() + ":" + today.getSeconds();

                    var hsl    = $('#hasilkg').val().trim(); 
                     $('#bruto').val(hsl); 

                    var hslocr    = $('#bruto').val().trim(); 
                    // var hslocr    = $('#'+id).val().trim(); //jika perhitungan dengan OCR
                    var tara   = $('#tara2').val().trim(); 
                    // var tara   = $('#taraOCR2').val().trim(); //aktifkan jika menggunakan OCR
                    var netto;

                    netto = Math.abs(tara - hslocr);
                    $("#netto1").val(netto);

                    if(tara > hsl){ 

                     console.log('Tara > Hasil '+netto);

                 }else if(tara < hsl){

                     console.log('Tara < Hasil '+netto);

                 }else{
                     var netto = 0;
                 }


                 $('#netto').val(netto); 
                 $('#tglkeluar').val(date+' '+time);


                 console.log("Timbang 2 non ocr: "+hslocr);
                 console.log("Timbang 1 : "+tara);
                 console.log("Bersih : "+hslocr+'-'+tara+'='+netto); 
                 var harga_jual = cleanNumber($("#hjp2").val()); 
                 var harga_pokok = $("#hpp2").val();
                 if(harga_jual !='' ){
                    $("#totalhjp").val(formatNumberWithDots(harga_jual * netto,0));
                    $("#hpp_total").val(harga_pokok * netto); 

                }
            }
}else{
    err('Kode Tiket tidak tersedia');
}
} 

function delTransaction(id,tiket){
    Metro.dialog.create({
        title: "Anda yakin?",
        content: "<div>Data timbangan "+tiket+" akan dihapus.</div>",
        actions: [
            {
                caption: "Ya, Hapus",
                cls: "js-dialog-close alert",
                onclick: function(){
                    del_Transaction(id);
                }
            },
            {
                caption: "Batal",
                cls: "js-dialog-close",
                onclick: function(){
                    console.log("Batal Hapus");
                }
            }
        ]
    });
}



function del_Transaction(id){ 
    $.ajax({ 
        url:  API+'/timbangan.php',
        type: 'POST',
        data : {del_Transaction:1,id:id}, 
        dataType: "json",
        timeout: 10000,
        success: function(response){   
            $("#reset_data2").click();
            Metro.infobox.create(response['message'],"",{
                closeButton: true,
                autoHide: 3000
            }); 
            t_asal();
        },
        error: function(){
            console.log('error');
            console.log(response['message']);
        }
    });  

};