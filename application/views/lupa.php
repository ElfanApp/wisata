<?php $this->load->view('header'); ?>
    <div class="container">

        <div class="col-sm-4"></div>

        <div class="col-sm-4">
          <?php echo form_open('login/lupa_proses'); ?>
            <h2 class="form-signin-heading text-center">Silahkan Masukkan Data Anda</h2>
            <label class="sr-only">E-mail</label>
            <input type="e-mail" name="email" class="form-control" placeholder="Masukkan E-mail Anda" autofocus>
            <?php echo form_error('email'); ?>
            <?php if($this->session->flashdata('errormail')!=""){
                  echo '<div class="alert alert-danger"><strong>Error!</strong> E-mail tidak terdaftar</div>';
            }?>
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
