<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Artificial Intelligent</title>
    <!-- Bootstrap Styles-->
    <link href="<?= base_url()?>assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FontAwesome Styles-->
    <link href="<?= base_url()?>assets/css/font-awesome.css" rel="stylesheet" />
        <!-- Custom Styles-->
    <link href="<?= base_url()?>assets/css/custom-styles.css" rel="stylesheet" />
     <!-- Google Fonts-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <script src="<?= base_url()?>assets/js/jquery-1.10.2.js"></script>
    <script src="<?= base_url()?>assets/js/jquery.autogrowtextarea.min.js"></script>
    <script src="<?= base_url()?>assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url()?>assets/js/custom-jav.js"></script>

<style>
.scroll{
  background: #E8E8E8;
  padding: 10px;
  overflow-x: hidden;
  overflow-y: scroll;
  /*border-right:solid 20px #fff;*/
  position: fixed;

}

body { 
    padding-top: 55px; 
}

.hov:hover { 
color: #FFFFFF;
background-color: transparent;
text-decoration:none;
}

textarea#teks{
  border-color: #ECECEC;
/*  border-left: 4px solid #3366FF;*/
}

#sesudah_ringkas{
border:1px solid #ECECEC;

}

#footer {
  position: fixed;
  right: 0;
  bottom: 0;
  left: 0;
  padding: 0.3em;
  background-color: #efefef;
  text-align: left;
  border-bottom: 4px solid #3366FF;
  font-size: 12px;
}

</style>
</head>
<body style="background:white">
    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top" style="background-color:#3366FF;padding-top:0px;">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" style="color:#fff;">
          <!-- <div class="col-md-12 col-xs-12" style="padding:0px;"> -->
          <!-- <img src="<?=base_url()?>assets/img/bd2.png" style="height:25px;"></img> -->
          <strong>
              Sistem Peringkas Teks Otomatis
          </strong>
          <!-- </div>             -->
          </a>
        </div>
      </div>
    </nav>

     <div class="col-md-8 col-xs-12" style="padding:5px">
        <h4 class="page-header" style="background-color:#efefef;  border-left: 4px solid #3366FF;padding:10px">
        Teks Sebelum Diringkas</h4>
     <form action="#" method="POST" id="formku">
          <textarea placeholder="PASTE TEKS DISINI, KEMUDIAN TEKAN ENTER..." id="teks" name="teks" style="outline-color:#3366FF;font-size:12px;width:100%;padding:20px;text-align:justify;resize:none"></textarea>   
      </div>
      <div class="col-md-4 col-xs-12 " style="padding:5px">
      <div class="panel panel-default" style"background-color:#efefef">
        <div class="panel-heading" style="border-radius:0px;background-color:#efefef;color:black;border-left:4px solid #3366FF"> <small>Centang Fitur dibawah ini untuk meringkas !</small></div>
          <div class="panel-body" style="background-color:##efefef">
            <ul class="nav" >
              <li><input class="check" type="checkbox" name="pilih_fitur[]" value="0">Posisi Kalimat dalam Paragraf(F1)</li>
              <li><input class="check" type="checkbox" name="pilih_fitur[]" value="1">Posisi Keseluruhan Kalimat(F2)</li>
              <li><input class="check" type="checkbox" name="pilih_fitur[]" value="2">Data Numerik(F3)</li>
              <li><input class="check" type="checkbox" name="pilih_fitur[]" value="3">Tanda Koma Terbalik(F4)</li>
              <li><input class="check" type="checkbox" name="pilih_fitur[]" value="4">Panjang kalimat(F5)</li>
              <li><input class="check" type="checkbox" name="pilih_fitur[]" value="5">Kata kunci(F6)</li>
              <br>
              <li><button class="btn btn-primary" onclick="ringkas_sekarang()" type="button" style="border-radius:0px;background-color:#0866C6"><i class=" fa fa-refresh "> RINGKAS SEKARANG</i></button></li>
            </form>
            </ul>
          </div>
        </div>
      </div>


     <div class="col-md-8 col-xs-12" style="padding:5px">
        <h4 id="dsd" class="page-header" style="background-color:#efefef;  border-left: 4px solid #3366FF;padding:10px">
        Hasil Ringkasan</h4>
          <div style="outline:none;font-size:12px;width:100%;padding-top:20px;padding:20px;text-align:justify;" id="sesudah_ringkas"></div>
     </div>

    
    <div class="col-md-4 col-xs-12 " style="padding:5px">
      <div class="panel panel-default" style"background-color:#efefef">
        <div class="panel-heading" style="border-radius:0px;background-color:#efefef;color:black;border-left:4px solid #3366FF"> <small>Berikan Saran melalui :</small></div>
          <div class="panel-body" style="background-color:">
            <ul class="nav" >
              <table>
                <tr>
                  <td><i class="fa fa-google-plus-square"></i>E-mail</td>
                  <td>: </td>
                  <td> rachmadif13@gmail.com</td>
                </tr>
                <tr>
                    <td><i class="fa fa-share"></i>Line</td>
                    <td>: </td>
                    <td> rachmad0803</td>
                </tr>
                <tr>
                  <td><i class="fa fa-phone-square"></i>Whatsapp</td>
                  <td>: </td>
                  <td> 085853887362</td>
                </tr>
              </table>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-12 col-xs-12"><br><br></div>

      <!--  <font style="font-size:0.6em"><span class="countsesudah">0</span> karakter</font> -->
    <div id="footer" >Developed by rachmadif13@gmail.com</div>

<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Please Wait...</h4>
      </div>
      <div class="panel-body">
        <div class="progress progress-striped active">
          <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

     <!-- Metis Menu Js -->
     <script type="text/javascript">

    function ringkas_sekarang(){

              var formdata=$("#formku").serialize();
              if( formdata.indexOf('pilih_fitur')==-1 ) {
                  alert('Anda belum memilih fitur !');
                  return false;
              }

              $("#myModal").modal('show');
              $.ajax({
              type:"POST",
              url:"<?php echo site_url()?>c_index/hitung_knn",
              data: $("#formku").serialize(),
              success:function(data) {
              $("#myModal").modal('hide');
              $("#sesudah_ringkas").show();
              $("#dsd").show();
              $("#sesudah_ringkas").html(data+"<br>");
              $(".check").removeAttr('checked');
              }
            });
      }

    $(document).ready(function() {
      // $("#teks").css("height","500px");
      $("#sesudah_ringkas").hide();
      $("#dsd").hide();
      $('textarea').autoGrow({
        extraLine: true // Adds an extra line at the end of the textarea. Try both and see what works best for you.
      });
    });
</script>
</body>
</html>