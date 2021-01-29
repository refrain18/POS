<?php
   if(!defined('INDEX')) die("");

   $now = date("Y-m-d");
   $produk_id = $_POST["produk_id"];
   $stok_keluar = $_POST["stok"];
   

   $query = mysqli_query($con, "UPDATE stok_keluar SET
      produk_id = '$produk_id',
      tanggal = '$now',
      stok = '$stok_keluar'
      WHERE sk_id='$_POST[sk_id]'
   ");

   if($query){
      echo "Data berhasil disimpan!";
      echo "<meta http-equiv='refresh' content='1; url=?hal=stok_keluarM'>";
   }else{
      echo "Tidak dapat menyimpan data!<br>";
      echo mysqli_error($con);
   }
?>