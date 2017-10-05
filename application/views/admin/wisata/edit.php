<?php $this->load->view('admin/header'); ?>
<?php if($this->session->flashdata('erroredit')!=""){
      echo '<div class="alert alert-danger"><strong>Error!</strong> Data Gagal Diedit.</div>';
}?>
<div class="panel panel-success">
    <div class="panel-heading">
    	<strong> EDIT DATA WISATA <?php echo $wisata['nama_wisata'] ?></strong>
    </div>
    <div class="panel-body">
		<?php echo form_open_multipart('wisata/edit_proses/'.$wisata['id_wisata']); ?>	
		<div class="form-group">
			<label>Nama Wisata</label>
			<input type="text" name="nama_wisata" class="form-control" value="<?php echo $wisata['nama_wisata']; ?>" placeholder="Masukkan Nama">
			<?php echo form_error('nama_wisata') ?>
		</div>
		<div class="form-group">
			<label>Nama Kategori</label>
          <label>Kategori Wisata</label>
          <div class="choose">
            <select name="id_kategori" class="form-control">
              <option value="">--PILIH KATEGORI--</option>
              <?php foreach ($kategori as $row): ?>
              <option value="<?php echo $row->id_kategori ?>" <?php if($row->id_kategori == $wisata['id_kategori']){echo "selected";} ?>><?php echo $row->nama_kategori ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <?php echo form_error('id_kategori') ?>
        </div>
        <div class="form-group">
          <textarea name="sekilas" cols="55" rows="10"><?php echo $wisata['sekilas']; ?></textarea>
              <?php echo form_error('sekilas') ?>
        </div>
        <div class="form-group">
              <label>Upload Foto</label>
              <input type="file" name="gambar" class="form-control">
              <input type="hidden" name="gambar_lama" class="form-control" value="<?php echo $wisata['gambar']; ?>">
              <br>
              <img src="<?php echo base_url('assets/images/'.$wisata['gambar']); ?>" width="500px">
              <?php ?>
        </div>
		<div class="form-group">
			<button type="submit" name="btnUpdate" class="btn btn-success"> <i class="glyphicon glyphicon-ok"></i> UPDATE</button>
		</div>
		<?php echo form_close(); ?>
	</div>
</div>
<?php $this->load->view('admin/footer'); ?>