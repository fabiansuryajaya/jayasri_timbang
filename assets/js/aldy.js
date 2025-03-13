//COMPRO
      $(function(){
        $("#compro").on('change', function(event) {
            var file = event.target.files[0];
            if(file.size>=30*1024*1024) {
                alert("PDF images of maximum 30MB");
                document.getElementById('compro').value= null;
                return;
            }

            if(!file.type.match('application/pdf')) {
                alert("Hanya PDF File");
                document.getElementById('compro').value= null;

                return;
            }

            var fileReader = new FileReader();
            fileReader.onload = function(e) {
                var int32View = new Uint8Array(e.target.result);  
                if(int32View.length>4 && int32View[0]==37 && int32View[1]==80 && int32View[2]==68 && int32View[3]==70) {
                    // console.log('OK PDF');
                }else{
                    alert("Hanya PDF File ");
                            document.getElementById('compro').value= null; 
                    return;
                }
            };
            fileReader.readAsArrayBuffer(file);
        });
    });
     //LOGO
    $(function(){
        $("#logo").on('change', function(event) {
            var file = event.target.files[0];
            if(file.size>=3*1024*1024) {
                alert("JPG images of maximum 3MB");
                document.getElementById('logo').value= null;
                return;
            }

            if(!file.type.match('image/jp.*') && !file.type.match('image/png')) {
                alert("Hanya JPG, JPEG, dan PNG File");
                document.getElementById('logo').value= null;

                return;
            }

            var fileReader = new FileReader();
            fileReader.onload = function(e) {
                var int32View = new Uint8Array(e.target.result); 
                if(int32View.length>4 && int32View[0]==255 && int32View[1]==216 && int32View[2]==255 && int32View[3]==224) {
                    // console.log('OK JPG');
                } else if (int32View.length>4 && int32View[0]==137 && int32View[1]==80 && int32View[2]==78 && int32View[3]==71) {
                    // console.log('OK PNG'); 
                }else{
                    alert("Hanya JPG, JPEG, dan PNG File ");
                            document.getElementById('logo').value= null; 
                    return;
                }
            };
            fileReader.readAsArrayBuffer(file);
        });
    });




  $('#ptext').hide();
  $('#kotatext').hide();
  $('#kectext').hide();
  $('#keltext').hide();
    function pilihprov(id)
    { 
    console.log(id); 
  $.ajax({ 
        url: 'ajax.php',
        data : 'negara='+id,
        type: "post", 
        dataType: "html",
        timeout: 10000,
        success: function(response){
          $('#prov').html(response);
          // console.log(response);
        }
    });

  $('#ptext').hide();
}
function pilihkota(prop)
{  
  $('#ptext').hide();
  if (prop=='x') { 
      $('#ptext').show();
  }
  $.ajax({ 
        url: 'ajax.php',
        data : 'prop='+prop,
        type: "post", 
        dataType: "html",
        timeout: 10000,
        success: function(response){
          $('#kota').html(response);
          // console.log(response);
        }
    });
}
function pilihkec(kota) { 

  $('#kotatext').hide();
  if (kota=='x') { 
      $('#kotatext').show();
  }
  $.ajax({
    url : 'ajax.php',
    data : 'kota='+kota,
    type : 'post',
    dataType : 'html',
    timeout :10000,
    success : function(respon){
      $("#kec").html(respon);
      // console.log(respon);
    }
  })
}
function pilihdesa(kec) {

  $('#kectext').hide();
  if (kec=='x') { 
      $('#kectext').show();
  }
  $.ajax({
    url : 'ajax.php',
    data : 'kec='+kec,
    type : 'post',
    dataType : 'html',
    timeout : 10000,
    success : function(respon){
      $('#desa').html(respon);
      // console.log(respon);
    }
  })
}

function pilihkel(e) {

  $('#keltext').hide();
  if (e=='x') { 
      $('#keltext').show();
  }
  
}