<?php include 'function.php' ?>
<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <title>Laporan</title>
 <link rel="stylesheet" href="">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
 <style>
  .line-title{
   border: 0;
   border-style: inset;
   border-top: 1px solid #000;
  }
 </style>
</head>
<body>
 <img src="<?php echo base_url(); ?>assets/image/1024.png" style="position: absolute; width: 90px;">
 <table style="width: 100%;">
  <tr>
   <td align="center">
    <span style="line-height: 1.6; font-weight: bold;">
     LAPORAN KEUANGAN<br>
     HIMPUNAN MAHASISWA LANGKAT
     <br> UNIVERSITAS SUMATERA UTARA
    </span>
   </td>
  </tr>
 </table>

 <hr class="line-title">
 <p align="center">
  <b>PERIODE : <?php echo bulan($bulan)." ".$tahun; ?></b>
 </p>
 <table style="font-size:12px;width:100%;" border="1px solid">
  <tr>
    <th><center>Tanggal</center></th>
    <th><center>Keterangan</center></th>
    <th><center>Pendapatan</center></th>
    <th><center>Pengeluaran</center></th>
  </tr>
  <?php
  $pendapatan = 0;
  $pengeluaran = 0;
  $nomor = 1;
  foreach ($laporan as $row) { ?>
    <tr>
      <td width="15%"><?php echo tgl_indo($row->tanggal); ?></td>
      <td width="50%"><?php echo $row->keterangan; ?></td>
      <td><?php if($row->pendapatan == 0){echo '';} else {echo rupiah($row->pendapatan);$pendapatan += $row->pendapatan;} ?></td>
      <td><?php if($row->pengeluaran == 0){echo '';} else {echo rupiah($row->pengeluaran);$pengeluaran += $row->pengeluaran;} ?></td>
    </tr>
  <?php $nomor++; }?>
    <tr style="font-weight:bold">
      <td colspan="2"><center>Total</center></td>
      <td><?php echo rupiah($pendapatan); ?></td>
      <td><?php echo rupiah($pengeluaran); ?></td>
    </tr>
 </table>
</body>
</html>
