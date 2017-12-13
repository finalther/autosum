
  <!-- End Navbar -->
  <div class="container-fluid">
  <div class="row">
   <form action="javascript:void(0);" method="POST" id="formku">    
    <div class="col-md-8">
      <div class="row">
        <div class="col-md-6">
            <h4 style="background-color:#222222;border-left: 4px solid #3366FF;padding:10px;margin-bottom: 2px;"><i class="fa fa-book"></i> 
                Teks Sebelum Diringkas</h4>
               <textarea placeholder="PASTE TEKS DISINI, KEMUDIAN TEKAN ENTER..." id="teks" name="teks" required></textarea>   
               <div id="charNum"></div>
        </div>
        <div class="col-md-6">
          <h4 id="dsd" style="background-color:#222222;border-left: 4px solid #3366FF;padding:10px;margin-bottom: 2px;"><i class="fa fa-bookmark"></i> 
          Hasil Ringkasan</h4>
            <div style="outline:none;font-size:12px;width:100%;padding:20px;text-align:justify;background-color: #F1F1F1;font-size:16px;font-family: 'Montserrat', sans-serif;" id="sesudah_ringkas"><div style="height:360px;"></div></div>
            <div id="charAfter"></div>
        </div>
      </div>
    </div>
    
    <div class="col-md-4" style="padding-top: 10px;">
      <div class="panel panel-default" style="background-color:#efefef;border-radius:0px;">
        <div class="panel-heading" style="border-radius:0px;background-color:#222222;color:#007FFF;border-left:4px solid #3366FF"> <h4 style="margin:0px;" ><i class="fa fa-check-square-o"></i> Centang Fitur !</h4></div>
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
      <div class="panel panel-default" style="background-color:#efefef;border-radius:0px;">
        <div class="panel-heading" style="border-radius:0px;background-color:#222222;color:#007FFF;border-left:4px solid #3366FF"> <h4 style="margin:0px;"><i class="fa fa-envelope-square"></i> Berikan Saran melalui :</h4></div>
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

<script>
      function ringkas_sekarang(){
        var checked = $("input[type=checkbox]:checked").length;
        var txt     = $("#teks").val();
        if(!checked){
            $.alert({
                title: 'Warning!',
                content: 'Silahkan Pilih Fitur!',
                type: 'red',
            });
            return false;
        }
        if(txt==''){
            $.alert({
                title: 'Warning!',
                content: 'Silahkan Masukkan Teks Inputan!',
                type: 'red',
            });
            return false;
        }
        var formdata=$("#formku").serialize();
        $.ajax({
        type:"POST",
        url:"<?php echo site_url()?>Home/ringkas",
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
