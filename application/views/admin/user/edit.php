<?php $this->load->view('admin/header'); ?>
<?php if($this->session->flashdata('errorkosong')!=""){
      echo '<div class="alert alert-success"><strong>Sukses!</strong>Data Berhasil Diedit, Password Tidak Dirubah.</div>';
}?>
<div class="panel panel-success">
    <div class="panel-heading">
    	<strong> EDIT DATA USER <?php echo $user['nama_user'] ?></strong>
    </div>
    <div class="panel-body">
		<?php echo form_open_multipart('user/edit_proses/'.$user['id_user']); ?>
		<div class="form-group">
			<label>Nama User</label>
			<input type="text" name="nama_user" class="form-control" value="<?php echo $user['nama_user']; ?>">
			<?php echo form_error('nama_user') ?>
		</div>
    <div class="form-group">
      <label>Username</label>
      <input type="text" name="username" class="form-control" value="<?php echo $user['username']; ?>" readonly>
      <?php echo form_error('username') ?>
    </div>
    <div class="form-group">
      <label>Password</label>
      <input type="password" name="password" class="form-control" value="<?php echo $user['password']; ?>" readonly>
      <?php echo form_error('password') ?>
    </div>
    <div class="form-group">
      <label>Password Baru</label>
      <input type="password" name="password_baru" class="form-control" placeholder="Masukkan Password Baru">
      <?php echo form_error('password_baru') ?>
    </div>
    <div class="form-group">
      <label>Konfirmasi Password Baru</label>
      <input type="password" name="password_baru2" class="form-control" placeholder="Masukkan Konfirmasi Password Baru">
      <?php echo form_error('password_baru2') ?>
    </div>
		<div class="form-group">
			<button type="submit" name="btnUpdate" class="btn btn-success"> <i class="glyphicon glyphicon-ok"></i> UPDATE</button>
		</div>
		<?php echo form_close(); ?>
	</div>
</div>
<?php $this->load->view('admin/footer'); ?>
