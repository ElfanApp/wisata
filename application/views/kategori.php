<?php $this->load->view('header'); ?>

    <div class="container marketing">
    <?php foreach ($w_k as $row): ?>
      <div class="row featurette">
        <div class="col-md-7 col-md-push-5">
          <a href="<?php echo site_url('Wisata/select/'.$row->id_wisata) ?>"><h2 class="featurette-heading"><?php echo $row->nama_wisata ?></h2></a>
          <p class="lead">
              <?php echo $row->sekilas; ?>
          </p>
        </div>
        <div class="col-md-5 col-md-pull-7">
          <a href="<?php echo site_url('Wisata/select/'.$row->id_wisata) ?>"><img class="featurette-image img-responsive center-block" src="<?php echo base_url('assets/images/'.$row->id_wisata.'.png') ?>" style="width: 300px;"></a>
        </div>
      </div>

      <hr class="featurette-divider">
    <?php endforeach; ?>

      <!-- FOOTER -->
      <footer>
        <p class="pull-right"><a href="#"><button class="btn btn-info">Back to top</button></a></p>
        <p>&copy; 2017 Elfan Rodhian</p>
      </footer>

    </div>

<?php $this->load->view('footer'); ?>
