<?php $this->load->view('header'); ?>
    <div class="container">

        <div class="col-sm-4"></div>

        <div class="col-sm-4">
          <?php echo form_open('login/register_proses'); ?>
            <h2 class="form-signin-heading text-center">Silahkan Masukkan Data Anda</h2>
            <?php if($this->session->flashdata('errorregister')!=""){
                  echo '<div class="alert alert-danger"><strong>Error!</strong> Data tidak Valid atau Username Sudah Ada</div>';
            }?>
            <label class="sr-only">Nama Lengkap</label>
            <input type="text" name="nama_user" class="form-control" placeholder="Masukkan Nama Anda" autofocus>
            <?php echo form_error('nama_user'); ?>
            <br>
            <label class="sr-only">E-mail</label>
            <input type="e-mail" name="email" class="form-control" placeholder="Masukkan E-mail Anda" autofocus>
            <?php echo form_error('email'); ?>
            <br>
            <label class="sr-only">Username</label>
            <input type="text" name="username" class="form-control" placeholder="Masukkan Username" >
            <?php echo form_error('username'); ?>
            <br>
            <label class="sr-only">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Masukkan Password" >
            <?php echo form_error('password'); ?>
            <br>
            <label class="sr-only">Konfirmasi Password</label>
            <input type="password" name="password2" class="form-control" placeholder="Masukkan Password Sekali Lagi" >
            <?php echo form_error('password2'); ?>
            <br>
            <?php echo $image; ?>
            <?php if($this->session->flashdata('errorcap')!=""){
                  echo '<div class="alert alert-danger"><strong>Error!</strong> Captcha tidak Valid</div>';
            }?>
            <br>
            <input type="text" name="captcha" class="form-control" placeholder="Masukkan Captcha" >
            <br>
            <button class="btn btn-lg btn-primary btn-block" type="submit"><i class="glyphicon glyphicon-lock"></i> Register</button>
          <?php echo form_close(); ?>
        </div>

        <div class="col-sm-4"></div>

    </div>
<?php $this->load->view('footer'); ?>
