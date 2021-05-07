<?php
   if(!defined('INDEX')) die("");

   $now = date("Y-m-d H:i:s");
   $harga = (int)$_POST["harga"];
   $diskon = (int)$_POST["diskon"];
   $jumlah = (int)$_POST["jumlah"];

   $subtotal = ($harga -($harga * $diskon/100))  * $jumlah;

   $query = mysqli_query($con, "UPDATE payment SET
      waktu = '$now',
      nama_produk = '$_POST[namaproduk]',
      harga = '$harga',
      diskon = '$diskon',
      qty = '$jumlah',
      sub_total = '$subtotal'
   WHERE payment_id='$_POST[payment_id]'");

// var_dump($query);die;

   if($query){
      echo "Data berhasil disimpan!";
      echo "<meta http-equiv='refresh' content='1; url=?mod=laporan_manajemen_bulanan&hal=laporan_manbul'>";
   }else{
      echo "Tidak dapat menyimpan data!<br>";
      echo mysqli_error($con);
   }
?>