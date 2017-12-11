<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Artificial Intelligent</title>
    <link href="<?= base_url()?>assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?= base_url()?>assets/css/font-awesome.min.css" rel="stylesheet" />
    <link href="<?= base_url()?>assets/css/mycustom.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
    <link href="<?= base_url()?>assets/vendor/jquery_confirm/jquery-confirm.min.css" rel="stylesheet" />
    <script src="<?= base_url()?>assets/js/jquery-3.2.1.min.js"></script>
    <script src="<?= base_url()?>assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url()?>assets/vendor/jquery_confirm/jquery-confirm.min.js"></script>
</head>
<style>

</style>

<body style="padding-bottom: 70px;">
<!-- Begin spinner -->
 <div id="preloader">
    <div id="status">
        <div class="sk-circle">
          <div class="sk-circle1 sk-child"></div>
          <div class="sk-circle2 sk-child"></div>
          <div class="sk-circle3 sk-child"></div>
          <div class="sk-circle4 sk-child"></div>
          <div class="sk-circle5 sk-child"></div>
          <div class="sk-circle6 sk-child"></div>
          <div class="sk-circle7 sk-child"></div>
          <div class="sk-circle8 sk-child"></div>
          <div class="sk-circle9 sk-child"></div>
          <div class="sk-circle10 sk-child"></div>
          <div class="sk-circle11 sk-child"></div>
          <div class="sk-circle12 sk-child"></div>
        </div>
        <font style="font-size: 12px;text-align: center;">Loading...</font>
    </div>
</div>
<!-- End spinner -->
<!-- Start Navbar -->
<nav class="navbar navbar-inverse" style="border-color: none;border-radius:0px;">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar2">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#" style="padding: 0px;"><img src="<?= base_url('assets/img/aiku3.svg')?>" style="height:70px; width:200px;padding:0px;margin:0px;">
        </a>
      </div>
      <div id="navbar2" class="navbar-collapse collapse">
<!--         <ul class="nav navbar-nav navbar-right">
          <li class="active"><a href="#">Home</a></li>
          <li><a href="#">About</a></li>
          <li><a href="#">Contact</a></li>
        </ul> -->
      </div>
    </div>
  </nav>
  <!-- End Navbar -->
  <div class="container-fluid">
      <h3 style="color:#007FFF;  text-shadow: 1px 1px 1px rgba(10, 150, 150, 1);line-height:0.5em;">Sistem Peringkas Teks Otomatis</h3>
      <font style="color:#gray; font-weight: 900; letter-spacing: 2px;font-family:palatino;font-size:10px;"> Temukan makna tulisan lebih cepat</font>
  <hr>
  <div class="row">
   <form action="javascript:void(0);" method="POST" id="formku">    
    <div class="col-md-8">
      <div class="row">
        <div class="col-md-6">
            <h4 style="background-color:#222222;color:#007FFF;border-left: 4px solid #3366FF;padding:10px;margin-bottom: 2px;"><i class="fa fa-book"  style="color:#007FFF"></i> 
                Teks Sebelum Diringkas</h4>
               <textarea placeholder="PASTE TEKS DISINI, KEMUDIAN TEKAN ENTER..." id="teks" name="teks" required></textarea>   
               <div id="charNum"></div>
        </div>
        <div class="col-md-6">
          <h4 id="dsd" style="background-color:#222222;color:#007FFF;border-left: 4px solid #3366FF;padding:10px;margin-bottom: 2px;"><i class="fa fa-bookmark"  style="color:#007FFF"></i> 
          Hasil Ringkasan</h4>
            <div style="outline:none;font-size:12px;width:100%;padding:20px;text-align:justify;background-color: #F1F1F1;font-size:16px;" id="sesudah_ringkas"><div style="height:360px;"></div></div>
            <div id="charAfter"></div>
        </div>
      </div>
    </div>
    
    <div class="col-md-4" style="padding-top: 10px;">
      <div class="panel panel-default" style"background-color:#efefef;border-radius:0px;">
        <div class="panel-heading" style="border-radius:0px;background-color:#222222;color:#007FFF;border-left:4px solid #3366FF"> <h4 style="margin:0px;" ><i class="fa fa-check-square-o"  style="color:#007FFF"></i> Centang Fitur !</h4></div>
          <div class="panel-body" style="border-radius:0px;">
            <ul class="nav" >
              <li><input class="check" type="checkbox" name="pilih_fitur[]" value="0">Posisi Kalimat dalam Paragraf(F1)</li>
              <li><input class="check" type="checkbox" name="pilih_fitur[]" value="1">Posisi Keseluruhan Kalimat(F2)</li>
              <li><input class="check" type="checkbox" name="pilih_fitur[]" value="2">Data Numerik(F3)</li>
              <li><input class="check" type="checkbox" name="pilih_fitur[]" value="3">Tanda Koma Terbalik(F4)</li>
              <li><input class="check" type="checkbox" name="pilih_fitur[]" value="4">Panjang kalimat(F5)</li>
              <li><input class="check" type="checkbox" name="pilih_fitur[]" value="5">Kata kunci(F6)</li>
              <br>
              <li><button class="btn btn-primary" onclick="ringkas_sekarang()" type="button"  style="border-radius:0px;background-color:#007FFF; border-color: transparent;"><i class=" glyphicon glyphicon-refresh"></i> RINGKAS SEKARANG</button></li>
            </ul>
          </div>
        </div>
    </form>
      <div class="panel panel-default" style"background-color:#efefef;border-radius:0px;">
        <div class="panel-heading" style="border-radius:0px;background-color:#222222;color:#007FFF;border-left:4px solid #3366FF"> <h4 style="margin:0px;"><i class="fa fa-envelope-square" style="color:#007FFF"></i> Berikan Saran melalui :</h4></div>
          <div class="panel-body" style="background-color:">
            <ul class="nav" >
              <table>
                <tr>
                  <td><i class="fa fa-google-plus-square"></i> E-mail</td>
                  <td>: </td>
                  <td> rachmadif13@gmail.com</td>
                </tr>
                <tr>
                    <td><i class="fa fa-phone"></i> Line</td>
                    <td>: </td>
                    <td> rachmad0803</td>
                </tr>
                <tr>
                  <td><i class="fa fa-whatsapp"></i> Whatsapp</td>
                  <td>: </td>
                  <td> 085853887362</td>
                </tr>
              </table>
            </ul>
          </div>
        </div>

    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div id="footer" >Developed by rachmadif13@gmail.com</div>
    </div>
  </div>
</div>

<script>
      function ringkas_sekarang(){
        var txt = $("#sesudah_ringkas").val();

        if(txt == ''){
            $.alert({
                title: 'Warning!',
                content: 'Inputan Harus Diisi!',
                type: 'red',
            });
            return false;
        }
        var formdata=$("#formku").serialize();
        $.ajax({
        type:"POST",
        url:"<?php echo site_url()?>home/ringkas",
        data: formdata,
        beforeSend:function(){
          $('#status').show();
          $('#preloader').show();
        },
        success:function(data) {
          $('#status').hide();
          $('#preloader').hide();
          $("#sesudah_ringkas").html(data);
          $(".check").prop('checked',false);
        }
      });
      }


   $(window).on('load', function(){// makes sure the whole site is loaded
        $('#status').fadeOut(); // will first fade out the loading animation
        $('#preloader').delay(250).fadeOut('slow'); // will fade out the white DIV that covers the website.
        $('body').delay(250).css({'overflow':'visible'});
    });

  $(document).ready(function(){
    countChar();
    var textarea = document.querySelector('textarea');
    textarea.addEventListener('input', autosize);
    textarea.addEventListener('input', countChar);
  });

  function autosize(){
    var el = this;
    setTimeout(function(){
      el.style.cssText = 'height:400px; padding:0';
      // for box-sizing other than "content-box" use:
      el.style.cssText = '-moz-box-sizing:content-box';
      el.style.cssText = 'height:' + el.scrollHeight + 'px';
    },0);
  }

  function countChar() {
    var len = $('#teks').val().length;
    $('#charNum').text(len + ' karakter');
  }


</script>

</body>
</html>
