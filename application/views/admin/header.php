<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="<?php echo base_url('assets/images/bjn.png');?>">

    <title><?php echo $judul; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/css/w3.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/datatables.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>media/css/jquery.dataTables.min.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
      <!-- Static navbar -->
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo site_url('admin') ?>">ADMIN WISATA</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li class="<?php if($aktif == "dashboard"){echo "active";} ?>"><a href="<?php echo site_url('admin') ?>"><i class="glyphicon glyphicon-home"></i> DASHBOARD</a></li>
              <li class="<?php if($aktif == "kw"){echo "active";} ?>"><a href="<?php echo site_url('kategori') ?>"><i class="glyphicon glyphicon-cog"></i> KATEGORI WISATA</a></li>
              <li class="<?php if($aktif == "ws"){echo "active";} ?>"><a href="<?php echo site_url('wisata') ?>"><i class="glyphicon glyphicon-globe"></i> WISATA</a></li>
<!--              <li class="<?php if($aktif == "pegawai"){echo "active";} ?>"><a href="<?php echo site_url('pegawai') ?>"><i class="glyphicon glyphicon-user"></i> PEGAWAI</a></li>
              <li class="<?php if($aktif == "user"){echo "active";} ?>"><a href="<?php echo site_url('user') ?>"><i class="glyphicon glyphicon-user"></i> USER</a></li> -->
              <li><a href="<?php echo site_url('home') ?>"><img src="<?php echo base_url('assets/images/bjn.png');?>" style="width:15px; height: 15px; align: center;"> WISATA BOJONEGORO</a></li>
            </ul>
            <ul class="nav navbar-nav">
              <li>
                <a href="#" onclick="confirm_logout('<?php echo site_url("login/logout") ?>')"><i class="glyphicon glyphicon-lock"></i> Logout</a>
              </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <?php $usernamed  =  $this->session->userdata('usernamed'); ?>
              <?php $akses      =  $this->session->userdata('hak_akses'); ?>
              <li class="dropdown">
                <?php if ($usernamed != "" && $akses != "") : ?>
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"><i class="glyphicon glyphicon-user"></i>
                      Selamat Datang <strong> <?php echo $akses; ?></strong> A.N. <strong><?php echo $usernamed; ?></strong>
                      <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu">
                    <li>
                      <a href="#" onclick="confirm_logout('<?php echo site_url("login/logout") ?>')"><i class="glyphicon glyphicon-lock"></i> Logout</a>
                      <li role="separator" class="divider"></li>
                    </li>
                  </ul>
                <?php endif; ?>
              </li>
            </ul>
          </div>

        </div>
      </nav>

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
