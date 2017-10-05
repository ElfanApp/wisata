<?php $this->load->view('admin/header'); ?>

<?php if($this->session->flashdata('suksestambah')!=""){
      echo '<div class="alert alert-success"><strong>Sukses!</strong> Data Berhasil Ditambahkan.</div>';
}?>
<?php if($this->session->flashdata('suksesedit')!=""){
      echo '<div class="alert alert-success"><strong>Sukses!</strong> Data Berhasil Diedit.</div>';
}?>
<?php if($this->session->flashdata('sukseshapus')!=""){
      echo '<div class="alert alert-success"><strong>Sukses!</strong> Data Berhasil Dihapus.</div>';
}?>
<?php if($this->session->flashdata('errortambah')!=""){
      echo '<div class="alert alert-danger"><strong>Error!</strong> Data Gagal Ditambahkan.</div>';
}?>
<div class="panel panel-info">
      <div class="panel-heading">
            <strong>DATA PEGAWAI</strong>
      </div>
      <div class="panel-body">
      <div>
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Data</button>

            <a type="button" target="_blank" href="<?php echo site_url('pegawai/cetakPDF'); ?>" class="btn btn-warning">
              <i class="glyphicon glyphicon-print"></i> Cetak Data
            </a>
            
      </div>
      <br>
            <table class="table table-hover table-bordered" id="pegawai">
                  <thead>
                        <tr>
                              <th width="100px">NIP</th>
                              <th>Nama</th>
                              <th>Tanggal</th>
                              <th>Alamat</th>
                              <th>Foto</th>
                              <th>Aksi</th>
                        </tr>
                  </thead>
                  <tbody>
                        <?php foreach ($all as $row):?>
                        <tr>
                              <td><?php echo $row->nip; ?></td>
                              <td><?php echo $row->nama_pegawai; ?></td>
                              <td><?php echo $row->tanggal; ?></td>
                              <td><?php echo $row->alamat; ?></td>
                              <td>
                                <img src="<?php echo base_url('assets/images/pegawai/'.$row->foto) ?>" style="width: 150px;">
                              </td>
                              <td width="150px" class="text-center">
                                    <a type="button" href="<?php echo site_url('pegawai/edit/'.$row->id_pegawai) ?>" title="<?php echo "Edit ".$row->nama_pegawai; ?>" class="btn btn-success"><i class="glyphicon glyphicon-pencil"></i></a>
                                    <a type="button" href="#" title="<?php echo "Hapus ".$row->nama_pegawai; ?>" onclick="confirm_modal('<?php echo site_url("pegawai/hapus/".$row->id_pegawai) ?>')" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></a>
                              </td>
                        </tr>
                        <?php endforeach; ?>
                  </tbody>
            </table>
      </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Data</h4>
      </div>
      <div class="modal-body">
            <div class="panel panel-info">
                <div class="panel-heading">
                  <strong> TAMBAH DATA PEGAWAI</strong>
                </div>
                <div class="panel-body">
                        <?php echo form_open_multipart('pegawai/tambah'); ?>
                        <div class="form-group">
                              <label>NIP</label>
                              <input type="text" name="nip" class="form-control" placeholder="Masukkan NIP" autofocus>
                              <?php echo form_error('nip') ?>
                        </div>
                        <div class="form-group">
                              <label>Nama pegawai</label>
                              <input type="text" name="nama_pegawai" class="form-control" placeholder="Masukkan Nama Pegawai">
                              <?php echo form_error('nama_pegawai') ?>
                        </div>
                        <div class="form-group">
                              <label>Tanggal</label>
                              <input type="date" name="tanggal" class="form-control">
                              <?php echo form_error('tanggal') ?>
                        </div>
                        <div class="form-group">
                          <label>Alamat</label>
                          <input type="text" name="alamat" class="form-control" placeholder="Masukkan Alamat Pegawai">
                              <?php echo form_error('alamat') ?>
                        </div>
                        <div class="form-group">
                              <label>Upload Foto</label>
                              <input type="file" name="foto" class="form-control">
                        </div>
                              <button type="submit" class="btn btn-primary"> <i class="glyphicon glyphicon-plus-sign"></i> SIMPAN</button>
                        <?php echo form_close(); ?>
                  </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    <!--End Modal content-->
  </div>
</div>
<!--End Modal-->

<!-- Modal Popup untuk delete-->
<div class="modal fade" id="myModal2">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" style="text-align:center;">Anda Yakin Ingin Menghapus Data ini?</h4>
      </div>

      <div class="modal-footer">
        <a href="#" class="btn btn-danger" id="delete_link"><i class="glyphicon glyphicon-trash"></i> Delete</a>
        <button type="button" class="btn btn-success" data-dismiss="modal"><i class="glyphicon glyphicon-backward"></i> Cancel</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal Popup untuk delete-->
<?php $this->load->view('admin/footer'); ?>
