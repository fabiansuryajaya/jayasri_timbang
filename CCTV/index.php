<?php
include '../config/koneksi.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Video CCTV</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <style type="text/css">
            body {
                background: #eee;
            }
            .cctv {
                width: calc(50% - .2em);
                box-sizing: border-box;
                white-space: normal;
                box-sizing: border-box;
                display: inline;
                height: 250px;
                text-align: center;
                background-repeat: no-repeat;
                background-position: center;
                border: 1px solid black;
                width: 50%;
            }
            section {
                box-sizing: border-box;
                padding: 5px;
            }
            .button {
                background-color: #2196f3;
                border: none;
                color: white;
                padding: 15px 32px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
            }
            .button-close {
                background-color: #e91e63;
                border: none;
                color: white;
                padding: 15px 32px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
            }
        </style>
    </head>
<body>
<?php
    $tiket = @$_GET['tiket'];
    $cam = @$_GET['cam'];
    $cctv1 = mysqli_fetch_array(mysqli_query($k, "SELECT * FROM conf_sistem a WHERE a.desc='cctv1'"));
    $cctv2 = mysqli_fetch_array(mysqli_query($k, "SELECT * FROM conf_sistem a WHERE a.desc='cctv2'"));
    $cctv3 = mysqli_fetch_array(mysqli_query($k, "SELECT * FROM conf_sistem a WHERE a.desc='cctv3'"));
    $cctv4 = mysqli_fetch_array(mysqli_query($k, "SELECT * FROM conf_sistem a WHERE a.desc='cctv4'"));
?>
    <section>
        <center>
            <h2>Realtime CCTV</h2>
            <h2>Tiket No : <?php echo $tiket; ?></h2>
            <div id="cam1" class="cctv">
                <iframe width="352" height="288" src="<?php echo "$cctv1[content]"; ?>"></iframe>
            </div>
            <div id="cam2" class="cctv">
                <iframe width="352" height="288" src="<?php echo "$cctv2[content]"; ?>"></iframe>
            </div>
            <div id="cam3" class="cctv">
                <iframe width="352" height="288" src="<?php echo "$cctv3[content]"; ?>"></iframe>
            </div>
            <div id="cam4" class="cctv">
                <iframe width="352" height="288" src="<?php echo "$cctv4[content]"; ?>"></iframe>
            </div>
            <br>
            <br>
            <br>
            <button id="take" class="button">Ambil Gambar</button>
            <button onclick="close_window();return false;" class="button-close">Close</button>
            <br>
            <br>
            <br>
            <img src="" id="cam1hasil" width="352" height="288">
            <img src="" id="cam2hasil" width="352" height="288">
            <img src="" id="cam3hasil" width="352" height="288">
            <img src="" id="cam4hasil" width="352" height="288">
            <div class="form-group">
                <p id="demo"></p>
            </div>
            <script type="text/javascript">
                function close_window() {
                    window.close();
                }
                $(document).ready(function () {
                    var tiket = '<?php echo $tiket; ?>';
                    var cam = '<?php echo $cam; ?>';
                    $('#cam1hasil').attr("src", tiket + '-cam' + cam + '-1.jpeg');
                    $('#cam2hasil').attr("src", tiket + '-cam' + cam + '-2.jpeg');
                    $('#cam3hasil').attr("src", tiket + '-cam' + cam + '-3.jpeg');
                    $('#cam4hasil').attr("src", tiket + '-cam' + cam + '-4.jpeg');
                    $('#take').click(function () {
                        var ajaxurl = 'exec.php',
                            data = { 'tiket': tiket, 'cam': cam };
                        $.post(ajaxurl, data, function (response) {
                            alert("Berhasil dicapture!");
                            console.log(response);
                            var time = new Date();
                            $('#cam1hasil').attr("src", tiket + '-cam' + cam + '-1.jpeg?' + time.getSeconds());
                            $('#cam2hasil').attr("src", tiket + '-cam' + cam + '-2.jpeg?' + time.getSeconds());
                            $('#cam3hasil').attr("src", tiket + '-cam' + cam + '-3.jpeg?' + time.getSeconds());
                            $('#cam4hasil').attr("src", tiket + '-cam' + cam + '-4.jpeg?' + time.getSeconds());
                        });
                    });
                });
            </script>
    </body>
</html>