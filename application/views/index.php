        <nav class="navbar-default navbar-side" role="navigation" style="background:#DEDEDE;margin-top:-30px;">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu" >

                    <li>
                        <!-- <a href="index.html"><i class="fa fa-dashboard"></i> </a> -->
                        <img src="<?= base_url()?>/assets/img/bgku.png" width="100%" height="100%"></img>
                    </li>
                    <li>
                        <a style="color:black"><small>Silahkan melakukan peringkasan Teks secara otomatis !<br>
                        Semoga dapat bermanfaat bagi semua pengguna.</small></a>
                    </li>
                    <br /><br /><br /><br /><br /><br /><br /><br /><br />

                </ul>
            </div>
        </nav>

        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div class="header"> 
                <h3 class="page-header" style="padding:25px">
                         Selamat Datang..<small>Silahkan Pilih Menu Program..</small>
                </h3>
                    <ol class="breadcrumb">
<!--                         <li></li> -->
                    </ol> 
             </div>
            <div id="pageku">  
                <div class="row">                       
                    <div class="col-md-6 col-sm-12 col-xs-12">                     
                        <div class="panel panel-default">
                            <div class="panel-heading" style="text-align:center">
                              <a href="#" onclick="showalert()" style="text-decoration:none; color:white">DATASET</div>
                                <div class="panel-body" style="border-bottom: solid 25px #F5F5F5">
                                    <img src="<?php echo base_url()?>assets/img/gambar.png" width="50%" height="60%" style="margin-left:28%"> </img></a>
                                </div>
                            </div>            
                        </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">                     
                        <div class="panel panel-default">
                            <div class="panel-heading" style="text-align:center">
                                <a href="<?= site_url()?>c_index/ringkas" style="text-decoration:none; color:white">MULAI RINGKAS</div>
                                <div class="panel-body" style="border-bottom: solid 25px #F5F5F5">
                                    <img src="<?php echo base_url()?>assets/img/ringkas.png" width="50%" height="60%"style="margin-left:28%"> </img></a>
                                </div>
                            </div>            
                        </div> 
                    </div>
                 <!-- /. ROW  -->
<!--                  <footer><p>Created at 2017 </a></p></footer> -->
                </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div> 
            <div id="footer" >Developed by rachmadif13@gmail.com</div>       
     <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="<?= base_url()?>assets/js/jquery-1.10.2.js"></script>
      <!-- Bootstrap Js -->
    <script src="<?= base_url()?>assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="<?= base_url()?>assets/js/jquery.metisMenu.js"></script>
     <!-- Morris Chart Js -->
     <script src="<?= base_url()?>assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="<?= base_url()?>assets/js/morris/morris.js"></script>
      <!-- Custom Js -->
    <script src="<?= base_url()?>assets/js/custom-scripts.js"></script>
    
   
   <script type="text/javascript">
   function showalert(){
    alert("Just For developer :)");
   }
   </script>
</body>
</html>