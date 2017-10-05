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
            <strong>DATA WISATA PADA KATEGORI <?php echo $kategori['nama_kategori']; ?></strong>
      </div>
      <div class="panel-body">
      <div>
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Data</button>
      </div>
      <br>
            <table class="table table-hover table-bordered">
                  <thead>
                        <tr>
                              <th width="100px">ID Wisata</th>
                              <th>Nama Wisata</th>
                              <th>Kategori Wisata</th>
                              <th>Aksi</th>
                        </tr>
                  </thead>
                  <tbody>
                        <?php foreach ($detail as $row):?>
                        <tr>
                              <td><?php echo $row->id_wisata; ?></td>
                              <td><?php echo $row->nama_wisata; ?></td>
                              <td><?php echo $row->nama_kategori; ?></td>
                              <td width="150px" class="text-center">
                                    <a type="button" href="<?php echo site_url('wisata/edit/'.$row->id_wisata) ?>" title="<?php echo "Edit ".$row->nama_wisata; ?>" class="btn btn-success"><i class="glyphicon glyphicon-pencil"></i></a>
                                    <a type="button" href="#" title="<?php echo "Hapus ".$row->nama_wisata; ?>" onclick="confirm_modal('<?php echo site_url("wisata/hapus/".$row->id_kategori) ?>')" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></a>
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
                  <strong> TAMBAH DATA WISATA</strong>
                </div>
                <div class="panel-body">
                        <?php echo form_open('wisata/tambah'); ?>      
                        <div class="form-group">
                              <label>ID Wisata</label>
                              <input type="text" name="id_wisata" class="form-control" placeholder="Masukkan ID wisata" autofocus>
                              <?php echo form_error('id_wisata') ?>
                        </div>
                        <div class="form-group">
                              <label>Nama Wisata</label>
                              <input type="text" name="nama_wisata" class="form-control" placeholder="Masukkan Nama wisata">
                              <?php echo form_error('nama_wisata') ?>
                        </div>
                        <div class="form-group">
                              <label>Kategori Wisata</label>
                              <div class="choose">
                              <select name="id_kategori" class="form-control">
                                <option value="">--PILIH KATEGORI--</option>
                                <?php foreach ($k as $row): ?>
                                <option value="<?php echo $row->id_kategori ?>"><?php echo $row->nama_kategori ?></option>
                                <?php endforeach; ?>
                              </select>
                              </div>
                              <?php echo form_error('id_kategori') ?>
                        </div>
                        <div class="form-group">
                          <textarea name="sekilas" cols="55" rows="10"></textarea>
                              <?php echo form_error('sekilas') ?>
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