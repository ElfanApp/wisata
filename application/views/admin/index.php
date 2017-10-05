<?php $this->load->view('admin/header'); ?>

<div class="panel panel-info">
    <div class="panel-heading">
          <strong>DASHBOARD</strong>
    </div>
    <div class="panel-body">
          <div class="col-sm-6">
            <div class="w3-container w3-green w3-padding-16">
              <div class="w3-left"><i class="glyphicon glyphicon-cog"></i></div>
              <div class="w3-right">
                <strong><h1><?php echo $jum_k; ?></h1></strong>
              </div>
              <div class="w3-clear"></div>
              <h4>JUMLAH KATEGORI WISATA</h4>
            </div>
          </div>

          <div class="col-sm-6">
            <div class="w3-container w3-blue w3-padding-16">
              <div class="w3-left"><i class="glyphicon glyphicon-globe"></i></div>
              <div class="w3-right">
                <strong><h1><?php echo $jum_w; ?></h1></strong>
              </div>
              <div class="w3-clear"></div>
              <h4>JUMLAH WISATA</h4>
            </div>
          </div>
    </div>
</div>

<?php $this->load->view('admin/footer'); ?>