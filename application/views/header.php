<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="favicon.ico">

    <title><?php echo $judul; ?></title>

    <!-- Bootstrap core CSS -->
    <link rel="icon" type="image/png" href="<?php echo base_url('assets/images/bjn.png');?>">
    <link href="<?php echo base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    <div class="navbar-wrapper">
      <div class="container">

        <nav class="navbar navbar-inverse">
          <div class="container-fluid">
            <div class="navbar-header">
              <a class="navbar-brand" href="<?php echo base_url() ?>">Wisata Bojonegoro</a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
              <ul class="nav navbar-nav">
                <li class="<?php if($aktif == "home"){echo "active";} ?>"><a href="<?php echo base_url() ?>">Home</a></li>

                <li class="dropdown <?php if($drop == "wisata"){echo "active";} ?>">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="<?php if($drop == "wisata"){echo "true";} ?>">WISATA <span class="caret"></span></a>
                  <ul class="dropdown-menu" >
                  <?php foreach ($w as $row): ?>
                    <li class=""><a href="<?php echo site_url('Wisata/select/'.$row->id_wisata) ?>"><?php echo $row->nama_wisata ?></a></li>
                    <li role="separator" class="divider"></li>
                  <?php endforeach; ?>
                  </ul>
                </li>
                <li class="dropdown <?php if($drop == "kategori"){echo "active";} ?>">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="<?php if($drop == "edukasi"){echo "true";} ?>">KATEGORI <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                  <?php foreach ($k as $row): ?>
                    <li class=""><a href="<?php echo site_url('Kategori/select/'.$row->id_kategori) ?>"><?php echo $row->nama_kategori ?></a></li>
                    <li role="separator" class="divider">
                  <?php endforeach; ?>
                  </ul>
                </li>
              </ul>

              <ul class="nav navbar-nav navbar-right">
                <?php $usernamed  =  $this->session->userdata('usernamed'); ?>
                <?php $akses      =  $this->session->userdata('hak_akses'); ?>
                <?php if($akses == "admin") : ?>
                <li><a href="<?php echo site_url('admin') ?>">
                  <i class="glyphicon glyphicon-home"></i> ADMIN</a>
                </li>
                <?php endif; ?>
                <li class="dropdown">
                  <?php if ($usernamed != "" && $akses != "") : ?>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"><i class="glyphicon glyphicon-user"></i>
                        Selamat Datang <strong> <?php echo $akses; ?></strong> A.N. <strong><?php echo $usernamed; ?></strong>
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                      <li>
                        <a href="#" onclick="confirm_logout('<?php echo site_url("login/logout") ?>')"><i class="glyphicon glyphicon-log-out"></i> Logout</a>
                      </li>
                      <li role="separator" class="divider"></li>
                      <li>
                        <a href="<?php echo site_url("login/atur") ?>" ><i class="glyphicon glyphicon-cog"></i> Pengaturan Akun</a>
                      </li>
                    </ul>
                  <?php else: ?>
                    <a href="<?php echo site_url('login'); ?>"><i class="glyphicon glyphicon-log-in"></i> Login</a>
                  <?php endif; ?>
                </li>
              </ul>

            </div>
          </div>
        </nav>
      </div>

      <!-- Modal Popup untuk delete-->
      <div class="modal fade" id="myModal3">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" style="text-align:center;">Anda Yakin Ingin Logout?</h4>
            </div>

            <div class="modal-footer">
              <a href="#" class="btn btn-info" id="logout"><i class="glyphicon glyphicon-check"></i> Ya</a>
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-backward"></i> Tidak</button>
            </div>
          </div>
        </div>
      </div>
      <!-- Modal Popup untuk delete-->
