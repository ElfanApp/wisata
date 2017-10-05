<?php $this->load->view('header'); ?>

    <div class="container marketing">
      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading"><?php echo $wis['nama_wisata']; ?></h2>
          <p class="lead">
            <?php echo $wis['sekilas']; ?>
          </p>
        </div>
        <div class="col-md-5">
          <img src="<?php echo base_url('assets/images/'.$gb2['gb2']) ?>" alt="<?php echo $wis['nama_wisata'] ?>" style="width: 450px">
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
