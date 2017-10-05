<?php $this->load->view('admin/header'); ?>
<?php if($this->session->flashdata('erroredit')!=""){
      echo '<div class="alert alert-danger"><strong>Error!</strong> Data Gagal Diedit.</div>';
}?>

<div class="panel panel-success">
    <div class="panel-heading">
    	<strong> EDIT DATA PEGAWAI <?php echo $kategori['nama_kategori'] ?></strong>
    </div>
    <div class="panel-body">
		<?php echo form_open('kategori/edit_proses/'.$kategori['id_kategori']); ?>	
		<div class="form-group">
			<label>Nama Kategori</label>
			<input type="text" name="nama_kategori" class="form-control" value="<?php echo $kategori['nama_kategori']; ?>" placeholder="Masukkan Nama">
			<?php echo form_error('nama_kategori') ?>
		</div>
			<button type="submit" name="btnUpdate" class="btn btn-success"> <i class="glyphicon glyphicon-ok"></i> UPDATE</button>
		<?php echo form_close(); ?>
	</div>
</div>

<?php $this->load->view('admin/footer'); ?>