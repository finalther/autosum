

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
                  <?php $judulya=$value->judul; ?>
                 <a href="#" onclick="show_hasil('<?php echo $value->id; ?>','<?php echo $judulya?>')" > <?php echo $judulya ?></a>
              </td>
          </tr>
        <?php } ?>

      </tbody>
  </table>

</div>
               <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div class="header">
                <h3 class="page-header" style="padding: 15px 0px 15px 15px;">
                    <div id="bigtitle" style="color:#0000FF">Silahkan klik Judul artikel disamping !</div><small><div id="title"> </div></small>
                </h3>

                    <ol class="breadcrumb">
                    </ol>
             </div>
        <div id="pageku">
                  <div id="element_text">
                  <label style='background:white;font-size:12px;font-weight:bold;width:100%;height:380px;padding:0px;float:left' readonly > 
                    <h3 style="padding:20px;">Silahkan klik judul artikel mengetahui Hasil preprocessing !</h3>
                    <br>
                    <font style="padding:20px;font-size:17px;font-weight:normal">Tahap-tahap preprocessing :</font><br>
                    <ul style="font-size:15px;font-weight:normal">
                      <li>Segmentasi (pemecahan kalimat dalam paragraf dan kalimat)</li>
                      <li>Case Folding</li>
                      <li>Tokenisasi</li>
                      <li>Filtering (dengan stopword removal)</li>
                      <li>Stemming (menggunakan sastrawi)</li>
                    </ul>
                  </label>
                  </div>
            </div>
                 <footer><p>All right reserved.</a></p></footer>
            </div>
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

<script type="text/javascript">
function show_hasil(id,judul){
  $("#myModal").modal('show');
  $.ajax({
    url:"<?php echo site_url()?>/c_index/hitung_preprocessing/"+id,  
    success:function(data) {
      $("#myModal").modal('hide');
      $("#element_text").html(data);
      $("#bigtitle").html("<u>Hasil Preprocessing Artikel :</u>");
      $("#title").html(judul);
     window.history.back();
    }
  });

}

</script>
 


</body>
</html>
