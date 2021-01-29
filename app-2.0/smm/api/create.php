<?php

include "../library/config.php";

// URL Untuk Input data
// POS/api/create.php?nama_produk=aquagalon&harga=19000&diskon=0&jenis_transaksi=kredit&qty=2

$nama_produk = $_GET['nama_produk'];
$harga = (int) $_GET['harga'];
$diskon = (int) $_GET['diskon'];
$jenis_transaksi = $_GET['jenis_transaksi'];
$qty = (int) $_GET['qty'];
$subtotal = ($harga -($harga * $diskon/100)) * $qty;
$now = date("Y-m-d H:i:s");

$query = mysqli_query($con, "INSERT INTO payment SET
      waktu = '$now',
      nama_produk = '$nama_produk',
      harga = '$harga',
      diskon = '$diskon',
      qty = '$qty',
      jenis_transaksi = '$jenis_transaksi',
      sub_total = '$subtotal'
   ");

if ($query) {
  echo "input data berhasil";
}   else {
  echo "input data gagal";
}


