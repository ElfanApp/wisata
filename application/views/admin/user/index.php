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
            <strong>DATA USER</strong>
      </div>
      <div class="panel-body">
      <div>
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Data</button>
      </div>
      <br>
            <table class="table table-hover table-bordered" id="user">
                  <thead>
                        <tr>
                              <th width="100px">ID User</th>
                              <th>Nama User</th>
                              <th>Hak Akses</th>
                              <th>Aksi</th>
                        </tr>
                  </thead>
                  <tbody>
                        <?php foreach ($all as $row):?>
                        <tr>
                              <td><?php echo $row->id_user; ?></td>
                              <td><?php echo $row->nama_user; ?></td>
                              <td><?php echo $row->hak_akses; ?></td>
                              <td width="150px" class="text-center">
                                    <a type="button" href="<?php echo site_url('user/edit/'.$row->id_user) ?>" title="<?php echo "Edit ".$row->nama_user; ?>" class="btn btn-success"><i class="glyphicon glyphicon-pencil"></i></a>
                                    <a type="button" href="#" title="<?php echo "Hapus ".$row->nama_user; ?>" onclick="confirm_modal('<?php echo site_url("user/hapus/".$row->id_user) ?>')" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></a>
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
                  <strong> TAMBAH DATA USER</strong>
                </div>
                <div class="panel-body">
                        <?php echo form_open_multipart('user/tambah'); ?>
                        <div class="form-group">
                              <label>Nama User</label>
                              <input type="text" name="nama_user" class="form-control" placeholder="Masukkan Nama User">
                              <?php echo form_error('nama_user') ?>
                        </div>
                        <div class="form-group">
                              <label>Username</label>
                              <input type="text" name="username" class="form-control" placeholder="Masukkan Username">
                              <?php echo form_error('username') ?>
                        </div>
                        <div class="form-group">
                          <label>Password</label>
                          <input type="password" name="password" class="form-control" placeholder="Masukkan Password Baru">
                              <?php echo form_error('password') ?>
                        </div>
                        <div class="form-group">
                          <label>Konfirmasi Password</label>
                          <input type="password" name="password2" class="form-control" placeholder="Konfirmasi Password Baru">
                              <?php echo form_error('password2') ?>
                        </div>
                        <div class="form-group">
                          <select class="form-control" name="hak_akses" required>
                            <option value="">--Pilih Hak Akses--</option>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                          </select>
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
