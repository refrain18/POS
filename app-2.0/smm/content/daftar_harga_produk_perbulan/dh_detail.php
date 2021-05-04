<?php
   if(!defined('INDEX')) die("");

   $id = isset($_GET['produk_id']) && !empty($_GET['produk_id']) ? $_GET['produk_id'] : '';

   $stmt = "SELECT produk_salon.nama_produk FROM produk_salon WHERE produk_id = '$id'";
   $execQuery = mysqli_query($con, $stmt) OR die (mysqli_error($con));
   $res = mysqli_fetch_assoc($execQuery);
?>

<h2 class="judul">Detail Harga Produk Salon Mumtaza Perbulan</h2>
<div class="label_123">
   <label class="l_nama_produk" for="">Nama Produk : <?= $res['nama_produk'] ?></label>
   <!-- <br>
   <label class="l_bulan" for="">Bulan :</label>
   <label class="l_tahun" for="">Tahun :</label> -->
</div>
<!-- <a class="cetak" target="_BLANK" href="./content/daftar_harga_produk_perbulan/dh_cetak_detail.php?q=" style="margin: 0px 0px 15px 0;">Cetak</a> -->
<br>
</br>
<table class="table">
   <thead>
      <tr>
         <th>No</th>
         <th>Hari/Tanggal</th>
         <th>Harga</th>
         <th>Jumlah Kenaikan/Turun</th>
      </tr>
   </thead>
   <tbody>
<?php

$stmt = "SELECT stok_masuk.tanggal, produk_salon.nama_produk, stok_masuk.harga FROM stok_masuk JOIN produk_salon ON stok_masuk.produk_id = produk_salon.produk_id WHERE stok_masuk.produk_id = '$id'";
$execQuery = mysqli_query($con, $stmt) OR die (mysqli_error($con));

$no = 0;
while($row = mysqli_fetch_array($execQuery)){
   $no++;
?>
   <tr>
      <td><?= $no ?></td>
      <td><?= $row['tanggal'] ?></td>
      <td><?= $row['harga'] ?></td>
      <td><?= isset($jml_perubahan_harga) ? $jml_perubahan_harga-$row['harga'] : 0 ?></td>
   </tr>
   
<?php
   $jml_perubahan_harga = $row['harga'];
   }
?>
   </tbody>
</table>