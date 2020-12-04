<?php

include "../library/config.php";

// URL Untuk Input data
// api/create.php?nama_produk=aquagalon&harga=19000&diskon=0&jenis_transaksi=kredit&qty=2

// Mengambil data dari url
$nama_produk = isset($_GET['nama_produk']) && !empty($_GET['nama_produk']) ? $_GET['nama_produk'] : null;
$harga = (int) isset($_GET['harga']) && !empty($_GET['harga']) ? $_GET['harga'] : null;
$diskon = (int) isset($_GET['diskon']) && (int) $_GET['diskon'] >= 0 ?  $_GET['diskon'] : null;
$jenis_transaksi = isset($_GET['jenis_transaksi']) && !empty($_GET['jenis_transaksi']) ? $_GET['jenis_transaksi'] : null;
$qty = (int) isset($_GET['qty']) && !empty($_GET['qty']) ? $_GET['qty'] : null;
$date = date("Y-m-d H:i:s");

// Menyiapkan pesan kesalahan jika terjadi kesalahan pada penulisan url
$pesan = "";
switch (null) {
  case $nama_produk:
    $pesan = 'Nama variabel untuk mengisi Nama Produk harus ditulis "nama_produk" dan tidak boleh dikosongkan';
    break;
  case $harga:
    $pesan = 'Nama variabel untuk mengisi Harga Produk harus ditulis "harga" dan tidak boleh dikosongkan';
    break;
  case $diskon:
    $pesan = 'Nama variabel untuk mengisi Diskon Produk harus ditulis "diskon" dan tidak boleh dikosongkan';
    break;
  case $jenis_transaksi:
    $pesan = 'Nama variabel untuk mengisi Jenis Transaksi harus ditulis "jenis_transaksi" dan tidak boleh dikosongkan';
    break;
  case $qty:
    $pesan = 'Nama variabel untuk mengisi Qty harus ditulis "qty" dan tidak boleh dikosongkan';
    break;
  default:
    break;
}

// Cek jika terjadi kesalahan pada URL
if ($pesan != "") {
  // cetak pesan gagal dalam bentuk json
  echo json_encode(
    array(
      "status" => "Input data gagal",
      "pesan" => $pesan
    )
  );
  // Menghentikan Program
  die();
}

// Menghitung Sub Total
$subtotal = (($harga - ($harga * $diskon / 100)) * $qty);

// Query untuk input data
$query = mysqli_query($con, "INSERT INTO payment SET
  waktu = '$date',
  nama_produk = '$nama_produk',
  harga = '$harga',
  diskon = '$diskon',
  qty = '$qty',
  jenis_transaksi = '$jenis_transaksi',
  sub_total = '$subtotal'
");

// Cetak pesan berhasil dalam bentuk json
echo json_encode(
  array(
    "status" => "Input data berhasil"
  )
);
