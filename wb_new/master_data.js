// Master Data


var m_d_asal   = $('#m_d_asal');
var m_d_asal2  = $('#m_d_asal2');
m_d_asal.hide();
m_d_asal2.hide(); 
// =============
var m_d_customer  = $('#m_d_customer'); 
var m_d_customer2  = $('#m_d_customer2'); 
m_d_customer.hide();  
m_d_customer2.hide();  
// =============
var m_d_sopir  = $('#m_d_sopir'); 
var m_d_sopir2  = $('#m_d_sopir2'); 
m_d_sopir.hide();  
m_d_sopir2.hide();  
// =============

$('#m_asal').on('click',function(){   
    t_asal();  
    m_d_customer.hide();
    m_d_customer2.hide()

    m_d_sopir.hide();
    m_d_sopir2.hide()

    m_d_asal.show();
    m_d_asal2.show()
});

$('#m_sopir').on('click',function(){   
    t_sopir();
    m_d_asal.hide();
    m_d_asal2.hide()

    m_d_sopir.show();
    m_d_sopir2.show()
    
    m_d_customer.hide();
    m_d_customer2.hide()
});



$('#m_customer').on('click',function(){   
    t_customer();   
    m_d_asal.hide();
    m_d_asal2.hide()

    m_d_sopir.hide();
    m_d_sopir2.hide()

    m_d_customer.show();
    m_d_customer2.show()
});






    // ASAL

function t_asal(){  
   $.ajax({ 
    url: API+'master.php', 
    type: "POST", 
    dataType: "json",
    timeout: 10000,
    data : {data_produk:1},
    success: function(response){   
        $("#t_asal_body").empty(); 
        var no =1;
        for (var i = 0; i < response.data.length; i++) { 
            var no = (i+1);
            tr = $('<tr/>'); 
            tr.append("<td data-tablesearch-text='"+ no +"'   style='background-color: #5ebdec; color: white; font-weight: bold; text-align:center;'>" + no + "</td>"); 
            tr.append("<td  data-tablesearch-text='"+response.data[i]['nama_produk']+"'  style='text-align:center;'>" + response.data[i]['nama_produk'] + "</td>");
            tr.append("<td  data-tablesearch-text='"+response.data[i]['satuan']+"'  style='text-align:center;' >" + response.data[i]['satuan'] + "</td>");

            tr.append("<td  data-tablesearch-text='"+response.data[i]['harga_pokok']+"'  style='text-align:center;' >" + response.data[i]['harga_pokok'] + "</td>");

            tr.append("<td  data-tablesearch-text='"+response.data[i]['harga_jual']+"'  style='text-align:center;' >" + response.data[i]['harga_jual'] + "</td>");

            tr.append("<td   ><button  onclick='editProduk(\""+response.data[i]['id']+"\")' class='button mini   primary'  data-id='"+response.data[i]['id']+"' data-status='0'  ><span class='mif-pencil'></span></button> <button   onclick='delProduk(\""+response.data[i]['id']+"\",\""+response.data[i]['nama_produk']+"\")'  class='button mini   alert'  data-id='"+response.data[i]['id']+"' data-status='1' data-notif='aktifkan'><span class='mif-cross'></span></button></td>");

            $('#t_asal_body').append(tr);
            no++; 
            $('#asal'+response.data[i]['id']).on('click', function(){ 
                delProduk($(this).data('id'),$(this).data('produk'));

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

function add_produk(){  
    var idProduk        =  $('#idProduk').val();
    var namaProduk      =  $('#namaProduk').val();
    var satuanProduk    =  $('#satuanProduk').val();
    var hpProduk        =  $('#hpProduk').val();
    var hjProduk        =  $('#hjProduk').val(); 


    $.ajax({ 
        url:  API+'/master.php',
        type: 'POST',
        data : {add_produk:1,edit_produk:idProduk,nama_produk:namaProduk,satuan:satuanProduk,hpp:hpProduk, hjp:hjProduk}, 
        dataType: "json",
        timeout: 10000,
        success: function(response){ 
            console.log(response);
            if(response['code'] =="200"){ 
                var info2 = "<h5 >Berhasil Disimpan.</h5>";
                Metro.infobox.create(info2,"",{
                    closeButton: true,
                    autoHide: 3000
                }); 
                $('#idProduk').val("");
                $('#namaProduk').val("");
                $('#satuanProduk').val("");
                $('#hpProduk').val("");
                $('#hjProduk').val(""); 

                t_asal();
            }else if(response['code'] == "300"){

                var info2 = "<h5 >Gagal Disimpan, Duplikat asal.</h5>";
                Metro.infobox.create(info2,"",{
                    closeButton: true,
                    autoHide: 3000
                }); 
            }else{ 
                var info2 = "<h5 >Error. Code : </h5>"+response['code'];
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

function editProduk(id)
{
    $.ajax({ 
        url:  API+'/master.php',
        type: 'POST',
        data : {data_produk:1,editProduk:id}, 
        dataType: "json",
        timeout: 10000,
        success: function(res){ 
            console.log(res); 
            console.log(res.data[0].id);
            $('#idProduk').val(res.data[0].id);
            $('#namaProduk').val(res.data[0].nama_produk);
            $('#satuanProduk').val(res.data[0].satuan);
            $('#hpProduk').val(res.data[0].harga_pokok);
            $('#hjProduk').val(res.data[0].harga_jual);  
        },
        error: function(res){
            console.log(res);
            console.log('error');
        }
    });  

}

function del_produk(id){ 
    $.ajax({ 
        url:  API+'/master.php',
        type: 'POST',
        data : {del_produk:1,id:id}, 
        dataType: "json",
        timeout: 10000,
        success: function(response){   
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


function delProduk(id,produk){
    Metro.dialog.create({
        title: "Anda yakin?",
        content: "<div>Produk "+produk+" akan dihapus.</div>",
        actions: [
        {
            caption: "Ya, Hapus",
            cls: "js-dialog-close alert",
            onclick: function(){
                del_produk(id);
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


    // Customer Module

function t_customer(){ 
    console.log(API);

    $.ajax({ 
        url: API+'master.php', 
        type: "POST", 
        dataType: "json",
        timeout: 10000,
        data : {data_customer:1},
        success: function(response){   
            $("#t_customer_body").empty(); 
            var no =1;
            for (var i = 0; i < response.data.length; i++) { 
                var no = (i+1);
                tr = $('<tr/>'); 
                tr.append("<td data-tablesearch-text='"+ no +"'   style='background-color: #5ebdec; color: white; font-weight: bold; text-align:center;'>" + no + "</td>"); 
                tr.append("<td  data-tablesearch-text='"+response.data[i]['nama_customer']+"'  style='text-align:center;'>" + response.data[i]['nama_customer'] + "</td>");

                tr.append("<td  data-tablesearch-text='"+response.data[i]['nomor_telp']+"'  style='text-align:center;'>" + response.data[i]['nomor_telp'] + "</td>");

                tr.append("<td  data-tablesearch-text='"+response.data[i]['alamat']+"'  style='text-align:center;'>" + response.data[i]['alamat'] + "</td>");



                tr.append("<td   ><button  onclick='editCustomer(\""+response.data[i]['id']+"\")' class='button mini   primary'  data-id='"+response.data[i]['id']+"' data-status='0'  ><span class='mif-pencil'></span></button> <button   onclick='deleteCustomer(\""+response.data[i]['id']+"\",\""+response.data[i]['nama_customer']+"\")'  class='button mini   alert'  data-id='"+response.data[i]['id']+"' data-status='1' data-notif='aktifkan'><span class='mif-cross'></span></button></td>");

                $('#t_customer_body').append(tr);
                no++; 

            }
        },
        error : function(xhr, response, error){
            console.log(xhr);
            console.log(response);
            console.log(error); 
        }
    });  
}

function add_customer(){  
    var idCustomer        =  $('#idCustomer').val();  
    var nama_customer        =  $('#nama_customer').val();  
    var nomor_telp        =  $('#nomor_telp').val();  
    var alamat        =  $('#alamat').val();     
    $.ajax({ 
        url:  API+'/master.php',
        type: 'POST',
        data : {add_customer:1,edit_customer:idCustomer,nama_customer,nomor_telp,alamat }, 
        dataType: "json",
        timeout: 10000,
        success: function(response){ 
            console.log(response);
            if(response['code'] =="200"){ 
                var info2 = "<h5 >Berhasil Disimpan.</h5>";
                Metro.infobox.create(info2,"",{
                    closeButton: true,
                    autoHide: 3000
                }); 
                t_customer();
            }else if(response['code'] == "300"){

                var info2 = "<h5 >Gagal Disimpan, Duplikat data.</h5>";
                Metro.infobox.create(info2,"",{
                    closeButton: true,
                    autoHide: 3000
                }); 
            }else{ 
                var info2 = "<h5 >Error. Code : </h5>"+response['code'];
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


function editCustomer(id)
{
    $.ajax({ 
        url:  API+'/master.php',
        type: 'POST',
        data : {data_customer:1,editCustomer:id}, 
        dataType: "json",
        timeout: 10000,
        success: function(res){ 
            console.log(res); 
            console.log(res.data[0].id);
            $('#idCustomer').val(res.data[0].id);
            $('#nama_customer').val(res.data[0].nama_customer);
            $('#nomor_telp').val(res.data[0].nomor_telp);
            $('#alamat').val(res.data[0].alamat); 
        },
        error: function(res){
            console.log(res);
            console.log('error');
        }
    });  

}


function del_customer(id){ 
    $.ajax({ 
        url:  API+'/master.php',
        type: 'POST',
        data : {del_customer:1,id:id}, 
        dataType: "json",
        timeout: 10000,
        success: function(response){   
            Metro.infobox.create(response['message'],"",{
                closeButton: true,
                autoHide: 3000
            }); 
            t_customer();
        },
        error: function(){
            console.log('error');
            console.log(response['message']);
        }
    });  

};


function deleteCustomer(id,customer){
    Metro.dialog.create({
        title: "Anda yakin?",
        content: "<div>Customer atas nama "+customer+" akan dihapus.</div>",
        actions: [
        {
            caption: "Ya, Hapus",
            cls: "js-dialog-close alert",
            onclick: function(){
                del_customer(id);
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


// Module Driver

function t_sopir(){ 
    console.log(API);

    $.ajax({ 
        url: API+'master.php', 
        type: "POST", 
        dataType: "json",
        timeout: 10000,
        data : {data_sopir:1},
        success: function(response){   
            $("#t_sopir_body").empty(); 
            var no =1;
            for (var i = 0; i < response.data.length; i++) { 
                var no = (i+1);
                tr = $('<tr/>'); 
                tr.append("<td data-tablesearch-text='"+ no +"'   style='background-color: #5ebdec; color: white; font-weight: bold; text-align:center;'>" + no + "</td>"); 
                tr.append("<td  data-tablesearch-text='"+response.data[i]['nama_sopir']+"'  style='text-align:center;'>" + response.data[i]['nama_sopir'] + "</td>");

                tr.append("<td  data-tablesearch-text='"+response.data[i]['nomor_telp']+"'  style='text-align:center;'>" + response.data[i]['nomor_telp'] + "</td>");

                tr.append("<td  data-tablesearch-text='"+response.data[i]['nomor_polisi']+"'  style='text-align:center;'>" + response.data[i]['nomor_polisi'] + "</td>");



                tr.append("<td   ><button  onclick='editSopir(\""+response.data[i]['id']+"\")' class='button mini   primary'  data-id='"+response.data[i]['id']+"' data-status='0'  ><span class='mif-pencil'></span></button> <button   onclick='deleteSopir(\""+response.data[i]['id']+"\",\""+response.data[i]['nama_sopir']+"\")'  class='button mini   alert'  data-id='"+response.data[i]['id']+"' data-status='1' data-notif='aktifkan'><span class='mif-cross'></span></button></td>");

                $('#t_sopir_body').append(tr);
                no++; 

            }
        },
        error : function(xhr, response, error){
            console.log(xhr);
            console.log(response);
            console.log(error); 
        }
    });  
}

function add_sopir(){  
    var idSopir        =  $('#idSopir').val();  
    var nama_sopir        =  $('#nama_sopir').val();  
    var nomor_telp        =  $('#nomor_telp_sopir').val();  
    var nomor_polisi        =  $('#nomor_polisi').val();     
    $.ajax({ 
        url:  API+'/master.php',
        type: 'POST',
        data : {add_sopir:1,edit_sopir:idSopir,nama_sopir,nomor_telp,nomor_polisi }, 
        dataType: "json",
        timeout: 10000,
        success: function(response){ 
            console.log(response);
            if(response['code'] =="200"){ 
                var info2 = "<h5 >Berhasil Disimpan.</h5>";
                Metro.infobox.create(info2,"",{
                    closeButton: true,
                    autoHide: 3000
                }); 
                t_sopir();
            }else if(response['code'] == "300"){

                var info2 = "<h5 >Gagal Disimpan, Duplikat data.</h5>";
                Metro.infobox.create(info2,"",{
                    closeButton: true,
                    autoHide: 3000
                }); 
            }else{ 
                var info2 = "<h5 >Error. Code : </h5>"+response['code'];
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

function editSopir(id)
{
    $.ajax({ 
        url:  API+'/master.php',
        type: 'POST',
        data : {data_sopir:1,editSopir:id}, 
        dataType: "json",
        timeout: 10000,
        success: function(res){ 
            console.log(res); 
            console.log(res.data[0].id);
            $('#idSopir').val(res.data[0].id);
            $('#nama_sopir').val(res.data[0].nama_sopir);
            $('#nomor_telp_sopir').val(res.data[0].nomor_telp);
            $('#nomor_polisi').val(res.data[0].nomor_polisi); 
        },
        error: function(res){
            console.log(res);
            console.log('error');
        }
    });  

}


function del_sopir(id){ 
    $.ajax({ 
        url:  API+'/master.php',
        type: 'POST',
        data : {del_sopir:1,id:id}, 
        dataType: "json",
        timeout: 10000,
        success: function(response){   
            Metro.infobox.create(response['message'],"",{
                closeButton: true,
                autoHide: 3000
            }); 
            t_sopir();
        },
        error: function(){
            console.log('error');
            console.log(response['message']);
        }
    });  

};


function deleteSopir(id,sopir){
    Metro.dialog.create({
        title: "Anda yakin?",
        content: "<div>Sopir atas nama "+sopir+" akan dihapus.</div>",
        actions: [
        {
            caption: "Ya, Hapus",
            cls: "js-dialog-close alert",
            onclick: function(){
                del_sopir(id);
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