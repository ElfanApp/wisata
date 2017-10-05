<?php $this->load->view('header'); ?>
    <div class="container marketing">
      <div class="row featurette">
        <?php if($this->session->flashdata('errorakses')!=""){
          echo '<div class="alert alert-danger"><strong>Error!</strong> Hanya <strong>ADMIN</strong> yang boleh mengakses Halaman Tersebut</div>';
        }?>
        <?php if($this->session->flashdata('erlog')!=""){
          echo '<div class="alert alert-danger">Anda harus <strong>LOGIN</strong> terlebih dahulu</div>';
        }?>
        <div class="col-md-7">
          <h2 class="featurette-heading">KABUPATEN BOJONEGORO</h2>
          <p class="lead">
          		Kabupaten Bojonegoro adalah sebuah kabupaten di Provinsi Jawa Timur, Indonesia. Ibu kotanya adalah Bojonegoro. Kabupaten ini berbatasan dengan Kabupaten Tuban di utara, Kabupaten Lamongan di timur, Kabupaten Nganjuk, Kabupaten Madiun, dan Kabupaten Ngawi di selatan, serta Kabupaten Blora (Jawa Tengah) di barat. Bagian barat Bojonegoro (perbatasan dengan Jawa Tengah) merupakan bagian dari Blok Cepu, salah satu sumber deposit minyak bumi terbesar di Indonesia.
          </p>
          <p class="lead">
          	Bengawan Solo mengalir dari selatan, menjadi batas alam dari Provinsi Jawa Tengah, kemudian mengalir ke arah timur, di sepanjang wilayah utara Kabupaten Bojonegoro. Bagian utara merupakan Daerah Aliran Sungai Bengawan Solo yang cukup subur dengan pertanian yang ekstensif. Kawasan pertanian umumnya ditanami padi pada musim penghujan, dan tembakau pada musim kemarau. Bagian selatan adalah pegunungan kapur, bagian dari rangkaian Pegunungan Kendeng. Bagian barat laut (berbatasan dengan Jawa Tengah) adalah bagian dari rangkaian Pegunungan Kapur Utara.
			<br>
			Kota Bojonegoro terletak di jalur Surabaya-Cepu-Semarang. Kota ini juga dilintasi jalur kereta api jalur Surabaya-Semarang-Jakarta.
          </p>
          <p class="lead">
          	Karena letak Geografisnya, Bojonegoro menjadi daerah yang kaya akan Minyak Bumi. Selain minyak bumi, Kabupaten kecil ini juga memiliki berbagai macam tempat wisata. Web ini akan memperkenalkan beberapa wisata yang terkenal di Bojonegoro, untuk lebih detailnya, klik Menu Wisata.
          </p>
        </div>
        <div class="col-md-5">
          <img src="<?php echo base_url() ?>assets/images/pemkab.jpg" alt="Gedung Pemkab Bojonegoro" style="width: 450px">
        </div>
      </div>

      <hr class="featurette-divider">


      <!-- FOOTER -->
      <footer>
        <p class="pull-right"><a href="#"><button class="btn btn-info">Back to top</button></a></p>
        <p>&copy; 2017 Elfan Rodhian</p>
      </footer>

    </div>

<?php $this->load->view('footer'); ?>
