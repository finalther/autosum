<div class="scroll" style="width:255px;height:425px;position:fixed;margin-top:6%">
<table class="table table-striped
            table-bordered" style="background-color:white;">
      <thead style="background-color:#0866C6; color:#fff">
      <tr>
        <td colspan =2> <strong >Daftar judul Artikel</strong></td>
      </tr>
        <tbody>
        <?php
        $i=1;
        foreach ($artikel as $key => $value) { ?>
          <tr style="font-size:12px;">
             <td> <?php echo $i++."."?> </td>
             <td>
                  <a href="#" onclick="show_hasil('<?php echo $value->id; ?>')" > <?php echo $value->judul; ?></a>
             </td>
          </tr>
      <?php } ?>
      </tbody>
    </table>

</div>

               <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div class="header">
                <h3 class="page-header" style="padding: 15px 0px 15px 15px;">
                         <div id="bigtitle" style="color:#0000FF">Silahkan klik Judul artikel disamping !</div><small><div id="title"><br> </div></small>
                </h3>
                    <ol class="breadcrumb">
                    </ol>
             </div>
              <div id="pageku">
                  <div id="element_text">
                  <label style='background:white;font-size:12px;width:100%;height:380px;padding:0px;float:left' readonly > 
                    <h3 style="padding:20px;">Silahkan klik judul artikel mengetahui detail isi artikel!</h3>
                    <br>
                    <font style="padding:20px;font-size:17px;font-weight:normal">Artikel tersebut digunakan sebagai data latih.</font><br>
                    <ul style="font-size:15px;font-weight:normal;">
                      <li>Berisi informasi tentang berita kesehatan antara lain tentang :</li>
                      <li>Pola makan yang sehat</li>
                      <li>Feeling good</li>
                      <li>dll.</li>
                    </ul>
                  </label>
                  </div>
            </div>
<!--                  <footer><p>Created at 2017</a></p></footer> -->
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
        <!-- Modal -->
      <div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="margin-top:30%">
            <div class="modal-body">
              <center><img src="<?=base_url()?>assets/img/loading.gif"></center>
            </div>
          </div>
        </div>
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

    <script type="text/javascript">
function show_hasil(id){
  $("#myModal").modal('show');
  $.ajax({
    type:"POST",
    url:"<?php echo site_url()?>/c_index/get_artikel/"+id,  
    dataType:'json',
    success:function(data) {
      $("#myModal").modal('hide');
      $("#element_text").html("<textarea style='border:none;font-size:12px;width:100%;height:380px;padding:20px;float:left;' readonly >"+data.file+"</textarea>");
      $("#bigtitle").html("<u>Detail Artikel</u>");
      $("#title").html(data.judul);
      window.history.back();
    }
  });

}

</script>


</body>
</html>
