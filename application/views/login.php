<?php $this->load->view('header'); ?>
    <div class="container">

        <div class="col-sm-4"></div>

        <div class="col-sm-4">
          <?php echo form_open('login/login_proses'); ?>
            <h2 class="form-signin-heading text-center">Silahkan Login</h2>
            <?php if($this->session->flashdata('errorlogin')!=""){
                  echo '<div class="alert alert-danger"><strong>Error!</strong> Username dan Password tidak cocok.</div>';
            }?>
            <?php if($this->session->flashdata('suksesregister')!=""){
                  echo '<div class="alert alert-success"><strong>Sukses!</strong> Selamat, anda berhasil register. Silahkan login</div>';
            }?>
            <?php if($this->session->flashdata('suksesemail')!=""){
                  echo '<div class="alert alert-success"><strong>Sukses!</strong> Silahkan buka <a href="http://mail.google.com" target="_blank"> E-mail Anda </a>untuk melihat </div>';
            }?>
            <label class="sr-only">Username</label>
            <input type="text" name="username" class="form-control" placeholder="Masukkan Username atau E-mail" required autofocus>
            <br>
            <label class="sr-only">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Masukkan Password" required>
            <br>
            <p>Belum terdaftar? <br>
              <a href="<?php echo site_url('login/register') ?>"><i>Register</i></a> atau <a href="<?php echo site_url('login/lupa') ?>"><i>Lupa Password?</i></a>
            </p>
            <button class="btn btn-lg btn-primary btn-block" type="submit"><i class="glyphicon glyphicon-lock"></i> Log In</button>
          <?php echo form_close(); ?>
        </div>

        <div class="col-sm-4"></div>

    </div>
<?php $this->load->view('footer'); ?>
