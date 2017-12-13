  <div class="row">
    <div class="col-md-12">
      <div id="footer" >Developed by rachmadif13@gmail.com</div>
    </div>
  </div>
</div>
</body>
</html>
<script>
     $(window).on('load', function(){// makes sure the whole site is loaded
        $('#status').fadeOut(); // will first fade out the loading animation
        $('#preloader').delay(250).fadeOut('slow'); // will fade out the white DIV that covers the website.
        $('body').delay(250).css({'overflow':'visible'});
    });
</script>
