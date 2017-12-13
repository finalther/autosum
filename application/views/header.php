<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Artificial Intelligent</title>
    <link href="<?= base_url()?>assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?= base_url()?>assets/css/font-awesome.min.css" rel="stylesheet" />
<!--     <link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'> -->
    <link href='http://fonts.googleapis.com/css?family=Quicksand:400,300,700|Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link href="<?= base_url()?>assets/css/mycustom.css" rel="stylesheet" />
    <link href="<?= base_url()?>assets/vendor/jquery_confirm/jquery-confirm.min.css" rel="stylesheet" />
    <link rel="icon" type="image/png" sizes="16x16" href="<?=base_url()?>assets/img/favpn.png">
    <script src="<?= base_url()?>assets/js/jquery-3.2.1.min.js"></script>
    <script src="<?= base_url()?>assets/vendor/jquery_confirm/jquery-confirm.min.js"></script>
    <script src="<?= base_url()?>assets/js/bootstrap.min.js"></script>
</head>
<style>
    .navbar-inverse .navbar-nav>.active>a{
      background-color:#007FFF;
    }
    .navbar-inverse .navbar-nav>li>a:hover{
      background-color:#007FFF;
    }
hr{
  /*border-color: #007FFF;*/
}

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
<nav class="navbar navbar-inverse" style="border-color: transparent;border-radius:0px;">
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
        <ul class="nav navbar-nav navbar-right">
          <li class="<?= ($this->uri->segment(2)=='') ? "active" : ''; ?>"><a href="<?= base_url()?>Home" style="color:white">Beranda</a></li>
          <li class="<?= ($this->uri->segment(2)=='aboutApp') ? "active" : ''; ?>"><a href="<?= base_url()?>Home/aboutApp" style="color:white">Tentang Sistem</a></li>
          <li class="<?= ($this->uri->segment(2)=='aboutMe') ? "active" : ''; ?>"><a href="<?= base_url()?>Home/aboutMe" style="color:white">Tentang Saya</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container-fluid">
    <h3 style="color:#007FFF;  text-shadow: 1px 1px 1px rgba(10, 150, 150, 1);line-height:0.5em;">Sistem Peringkas Teks Otomatis</h3>
      <font style="color:gray; font-weight: 900; letter-spacing: 2px;font-family:palatino;font-size:10px;"> Temukan makna tulisan lebih cepat</font>
  <hr>
  </div>
