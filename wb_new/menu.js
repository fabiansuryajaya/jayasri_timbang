 $('#home').on('click',function(){   
    $('#page').show();   
    $('#entry1').css('background','');  
    $('#entry2').css('background','');   
    $('#cetakPrint').css('background',''); 

    $('#masterData').css('background','');     
    $('#entry1data').hide();   
    $('#entry2data').hide();  
    $('#streamCCTV').hide();  
    $('#cetakPrintData').hide();    
    $('#masterData2').hide();      

});
 $('#entry1').on('click',function(){ 
    $('#entry1').css('background','#a4cef9');  
    $('#entry2').css('background','');   
    $('#cetakPrint').css('background',''); 

    $('#masterData').css('background','');     
    $('#entry1data').show();   
    $('#entry2data').hide();   
    $('#streamCCTV').show();  

    $('#page').hide();   
    $('#masterData2').hide();   
    $('#cetakPrintData').hide();    
    no_record(); 

       // load_kendaraan_inquiry();
       // load_sopir_inquiry();
});  
 $('#entry2').on('click',function(){  
    $('#entry2').css('background','#a4cef9');  
    $('#entry1').css('background','');   
    $('#cetakPrint').css('background','');   

    $('#masterData').css('background','');   
    $('#entry2data').show();   
    $('#entry1data').hide();   
    $('#streamCCTV').show();  

    $('#page').hide();   
    $('#masterData2').hide();   
    $('#cetakPrintData').hide();    

    load_table(); 
}); 
 $('#cetakPrint').on('click',function(){  
    $('#cetakPrint').css('background','#a4cef9');  
    $('#entry1').css('background','');   
    $('#entry2').css('background','');   
    $('#masterData').css('background','');   
    $('#cetakPrintData').show();   
    $('#entry1data').hide();   
    $('#entry2data').hide();   
    $('#streamCCTV').hide();  

    $('#page').hide();   
    $('#masterData2').hide();   

    load_table_transaksi();
});

 $('#masterData').on('click',function(){  
    $('#masterData').css('background','#a4cef9');  
    $('#entry1').css('background','');   
    $('#entry2').css('background','');   
    $('#cetakPrint').css('background','');   
    $('#cetakPrintData').hide();   
    $('#entry1data').hide();   
    $('#entry2data').hide();   
    $('#streamCCTV').hide();  
    
    $('#page').hide();   
    $('#masterData2').show();   
    load_table_transaksi();
});
