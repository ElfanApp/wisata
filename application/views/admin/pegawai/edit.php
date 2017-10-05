<?php $this->load->view('admin/header'); ?>
<?php if($this->session->flashdata('erroredit')!=""){
      echo '<div class="alert alert-danger"><strong>Error!</strong> Data Gagal Diedit.</div>';
}?>
<div class="panel panel-success">
    <div class="panel-heading">
    	<strong> EDIT DATA PEGAWAI <?php echo $pegawai['nama_pegawai'] ?></strong>
    </div>
    <div class="panel-body">
		<?php echo form_open_multipart('pegawai/edit_proses/'.$pegawai['id_pegawai']); ?>	
		<div class="form-group">
			<label>Nama pegawai</label>
			<input type="text" name="nama_pegawai" class="form-control" value="<?php echo $pegawai['nama_pegawai']; ?>" placeholder="Masukkan Nama">
			<?php echo form_error('nama_pegawai') ?>
		</div>
    <div class="form-group">
      <label>Tanggal Lahir</label>
      <input type="date" name="tanggal" class="form-control" value="<?php echo $pegawai['tanggal']; ?>">
      <?php echo form_error('tanggal') ?>
    </div>
    <div class="form-group">
      <label>Alamat</label>
      <input type="alamat" name="alamat" class="form-control" value="<?php echo $pegawai['alamat']; ?>">
      <?php echo form_error('alamat') ?>
    </div>
    <div class="form-group">
          <label>Upload Foto</label>
          <input type="file" name="foto" class="form-control">
          <input type="hidden" name="foto_lama" class="form-control" value="<?php echo $pegawai['foto']; ?>">
          <br>
          <img src="<?php echo base_url('assets/images/pegawai/'.$pegawai['foto']); ?>" width="500px">
    </div>
		<div class="form-group">
			<button type="submit" name="btnUpdate" class="btn btn-success"> <i class="glyphicon glyphicon-ok"></i> UPDATE</button>
		</div>
		<?php echo form_close(); ?>
	</div>
</div>
<?php $this->load->view('admin/footer'); ?>