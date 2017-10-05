    <!-- FOOTER -->
      <footer>
        <p class="pull-right"><a href="#"><button class="btn btn-info">Back to top</button></a></p>
        <p>&copy; 2017 Elfan Rodhian</p>
      </footer>
   </div>

    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url() ?>assets/js/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/datatables.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        $('#kategori').DataTable({
          "processing":true,
          "serverSide":true,
          "lengthMenu":[[5,10,100,-1],[5,10,100,"All"]],
          "ajax":{
            url : "<?php echo site_url('kategori/data_server') ?>",
            type : "POST"
          },

          "columnDefs":
          [
            {
              "targets":0,
              "data":"id_kategori"
            },
            {
              "targets":1,
              "data":"nama_kategori"
            },
            {
              "targets":2,
              "data": null,
              "searchable": false,
              "render":function(data,tipe,full,meta){
                return '<a type="button" href="<?php echo site_url("/kategori/detail/") ?>'+data["id_kategori"]+'" title="<?php echo 'Detail' ?> '+data["nama_kategori"]+'" class="btn btn-warning"><i class="glyphicon glyphicon-search"></i></a>'
              }
            },
            {
              "targets":3,
              "data": null,
              "searchable": false,
              "render":function(data,tipe,full,meta){
                return '<a type="button" href="<?php echo site_url("/kategori/edit/") ?>'+data["id_kategori"]+'" title="<?php echo 'Edit' ?> '+data["nama_kategori"]+'" class="btn btn-success"><i class="glyphicon glyphicon-pencil"></i></a>'
              }
            },
            {
              "targets":4,
              "data": null,
              "searchable": false,
              "render":function(data,tipe,full,meta){
                return '<a type="button" href="<?php echo site_url("/kategori/hapus/") ?>'+data["id_kategori"]+'" title="<?php echo 'Hapus'?>"'+data['nama_kategori']+' onclick="return confirm("Apakah Anda Yakin Ingin Menghapus")'+data['nama_kategori']+'"?";" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></a>'
              }
            }
          ],
        });
      });
    </script>

    <script type="text/javascript">
      $(document).ready(function(){
        $('#wisata').DataTable({
          "processing":true,
          "serverSide":true,
          "lengthMenu":[[5,10,100,-1],[5,10,100,"All"]],
          "ajax":{
            url : "<?php echo site_url('wisata/data_server') ?>",
            type : "POST"
          },

          "columnDefs":
          [
            {
              "targets":0,
              "data":"id_wisata",
            },
            {
              "targets":1,
              "data":"nama_wisata"
            },
            {
              "targets":2,
              "data":"nama_kategori"
            },
            {
              "targets":3,
              "data": null,
              "render":function(data,tipe,full,meta){
                return '<img src="<?php echo base_url()?>/assets/images/'+data["gambar"]+'">'
              }
            },
            {
              "targets":4,
              "data": null,
              "searchable": false,
              "render":function(data,tipe,full,meta){
                return '<a type="button" href="<?php echo site_url("/wisata/edit/")?>'+data["id_wisata"]+'" title="<?php echo 'Edit' ?> '+data["nama_wisata"]+'" class="btn btn-success"><i class="glyphicon glyphicon-pencil"></i></a>'
              }
            },
            {
              "targets":5,
              "data": null,
              "searchable": false,
              "render":function(data,tipe,full,meta){
                return '<a type="button" href="<?php echo site_url("/wisata/hapus/") ?>'+data["id_wisata"]+'" title="<?php echo 'Hapus'?>"'+data['nama_wisata']+' onclick="return confirm("Apakah Anda Yakin Ingin Menghapus")'+data['nama_wisata']+'"?";" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></a>'
              }
            }
          ]
        });
      });
    </script>

    <script type="text/javascript">
      $(document).ready(function(){
        $('#pegawai').DataTable();
      });
    </script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script>
		<?php
			if (isset($modal_show)) {
		 		echo $modal_show;
		 	}
		?>
	</script>

  <!-- Javascript untuk popup modal Delete-->
  <script type="text/javascript">
      function confirm_modal(delete_url)
      {
        $('#myModal2').modal('show');
        document.getElementById('delete_link').setAttribute('href' , delete_url);
      }
  </script>

   <!-- Javascript untuk popup modal Logout-->
  <script type="text/javascript">
      function confirm_logout(logout_url)
      {
        $('#myModal3').modal('show');
        document.getElementById('logout').setAttribute('href' , logout_url);
      }
  </script>
  </body>
</html>
