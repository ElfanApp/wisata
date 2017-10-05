<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php echo $judul; ?></title>
    <style type="text/css">
      table{
        border-collapse: collapse;
        width: 70%;
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
        padding-left: 2px;
        padding-right : 2px;
        vertical-align: top;
      }
      img{
        width: 70%;
        padding-left : 15%;
        padding-right: 15%;
      }
    </style>
  </head>

  <body>
    <img src="<?php echo base_url('assets/kop.jpg') ?>" alt="kop surat">
    <p style="text-align: center"> <strong>Tabel Pegawai</strong></p>
    <table>
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
    <p style="text-align: center"><a href="<?php echo site_url()?>/pegawai/cetakPDF">Cetak PDF</a></p>
  </body>
</html>
