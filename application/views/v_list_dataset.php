
        <nav class="navbar-default navbar-side" role="navigation" style="background:#DEDEDE;overflow-y:scroll;margin-top:-4%">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu" >

                    <li>
                        <!-- <a href="index.html"><i class="fa fa-dashboard"></i> </a> -->
                        <img src="<?= base_url()?>/assets/img/bgku.png" width="100%" height="100%"></img>
                    </li>
                    <li>
                        <a style="color:black">"Get The knowledge now !"</a>
                    </li>
                    <li>
                        <a style="color:black">"Without health ,your life will meaningless"</a>
                    </li>
                    <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />

                </ul>

            </div>

        </nav>

        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div class="header"> 
                <h3 class="page-header" style="padding:10px">
                         Silahkan <small>Melihat dataset !</small>
                </h3>
                    <ol class="breadcrumb">
                    </ol> 

             </div>
            <div id="pageku">  
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12" >                     
                        <div class="panel panel-default">
                            <div class="panel-heading" style="text-align:center" >
                            <a href="<?= site_url()?>/c_index/artikel_ori" style="text-decoration:none; color:white">Artikel Original</div>
                                <div class="panel-body" style="border-bottom: solid 25px #F5F5F5">
                                    <img src="<?php echo base_url()?>assets/img/ori.png" width="44%" height="60%"style="margin-left:28%"> </img>
                                    </a>
                                </div>
                        </div>            
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">                     
                        <div class="panel panel-default">
                            <div class="panel-heading" style="text-align:center">
                              <a href="<?= site_url()?>/c_index/hasil_preprocessing" style="text-decoration:none; color:white">Hasil Preprocessing</div>
                            <div class="panel-body" style="border-bottom: solid 25px #F5F5F5">
                                <img src="<?php echo base_url()?>assets/img/ekstraksi.png" width="44%" height="60%" style="margin-left:28%"> </img>
                                </a>
                             </div>
                        </div>            
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">                     
                        <div class="panel panel-default">
                            <div class="panel-heading" style="text-align:center">
                            <a href="<?= site_url()?>/c_index/hasil_ekstraksi" style="text-decoration:none; color:white">Hasil Ekstraksi Fitur</div>
                            <div class="panel-body" style="border-bottom: solid 25px #F5F5F5">
                                <img src="<?php echo base_url()?>assets/img/ekstraksi.png" width="44%" height="60%"style="margin-left:28%"> </img>
                            </a>
                            </div>
                        </div>            
                    </div> 
                </div>
                 <!-- /. ROW  -->
                
<!--                  <footer><p>All right reserved 2017 </a></p></footer> -->
                </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
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
    
   
</body>
</html>