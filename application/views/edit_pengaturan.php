<?php $this->load->view('header'); ?>
    <div class="container">

        <div class="col-sm-4"></div>

        <div class="jumbotron">
          <div class="panel panel-success">
              <div class="panel-heading text-center">
              	<strong> EDIT AKUN</strong>
              </div>
              <?php if($this->session->flashdata('errormail')!=""){
                    echo '<div class="alert alert-danger"><strong>Error!</strong> E-mail sudah ada.</div>';
              }?>
              <div class="panel-body">
          		<?php echo form_open('login/atur_proses'); ?>
          		<div class="form-group">
          			<label>Nama User</label>
          			<input type="text" name="nama_user" class="form-control" value="<?php echo $user['nama_user']; ?>" autofocus>
          			<?php echo form_error('nama_user') ?>
          		</div>
          		<div class="form-group">
          			<label>E-mail</label>
          			<input type="e-mail" name="email" class="form-control" value="<?php echo $user['email']; ?>">
          			<?php echo form_error('email') ?>
          		</div>
          		<div class="form-group">
          			<label>Username</label>
          			<input type="text" name="username" class="form-control" value="<?php echo $user['username']; ?>">
          			<?php echo form_error('username') ?>
          		</div>
              <div class="form-group">
          			<label>Password</label>
          			<input type="password" name="password" class="form-control" value="<?php echo $user['password']; ?>">
          			<?php echo form_error('password') ?>
          		</div>
              <div class="form-group">
          			<label>Konfirmasi Password</label>
          			<input type="password" name="password2" class="form-control" placeholder="Masukkan Kembali Password">
                <?php if($this->session->flashdata('errorpass')!=""){
                  echo '<div class="alert alert-danger"><strong>Error!</strong> Password Tidak sama</div>';
                }?>
          		</div>
          		<div class="form-group">
          			<button type="submit" name="btnUpdate" class="btn btn-success"> <i class="glyphicon glyphicon-ok"></i> EDIT</button>
          		</div>
          		<?php echo form_close(); ?>
          	</div>
          </div>
        </div>
        <div class="col-sm-4"></div>
    </div>
<?php $this->load->view('footer'); ?>
