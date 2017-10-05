<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php echo $judul; ?></title>
    <style type="text/css">
      table{
        border-collapse: collapse;
        width: 100%;
        margin: 0 auto;
      }
      table th{
        border: 1px solid #000;
        padding: 3px;
        font-weight: bold;
        text-align: center;
      }
      table td{
        border: 1px solid #000;
        padding: 3px;
        vertical-align: top;
      }
    </style>
  </head>
  <body>
    <img src="<?php echo base_url('assets/kop.jpg') ?>" alt="kop surat" width="100%">
    <p style="text-align: center"> <strong>Tabel Pegawai</strong></p>
    <br><br>
    <table style="width: 100%; border: 1; border-collapse: collapse;">
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>NIP</th>
        <th>Tanggal Lahir</th>
        <th>Alamat</th>
        <th>Foto</th>
      </tr>
      <?php $no = 0; foreach ($pegawai as $row): $no++; ?>
      <tr>
        <td><?php echo $no; ?></td>
        <td><?php echo $row->nama_pegawai; ?></td>
        <td><?php echo $row->nip; ?></td>
        <td><?php echo $row->tanggal; ?></td>
        <td><?php echo $row->alamat; ?></td>
        <td>
          <img src="<?php echo base_url('assets/images/pegawai/'.$row->foto) ?>" style="width: 150px;" align ="center">
        </td>
      </tr>
    <?php endforeach; ?>
    </table>
  </body>
</html>
