
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url() ?>assets/js/jquery.min.js"></script>
    
    <script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        function confirm_logout(logout_url)
        {
          $('#myModal3').modal('show');
          document.getElementById('logout').setAttribute('href' , logout_url);
        }
    </script>
  </body>
</html>
