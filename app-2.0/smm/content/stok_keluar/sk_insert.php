<?php
   if(!defined('INDEX')) die("");

   ini_set('date.timezone', 'Asia/Jakarta');
   $now = date("Y-m-d H:i:s");
   $produk_id = $_POST["produk_id"];
   $stok_keluar = $_POST["stok"];
   

   $query = mysqli_query($con, "INSERT INTO stok_keluar SET
      tanggal = '$now',
      produk_id = '$produk_id',
      stok = '$stok_keluar'
   ");

   if($query){
      echo "Data berhasil disimpan!";
      echo "<meta http-equiv='refresh' content='1; url=?mod=stok_keluar&hal=stok_keluarM'>";
   }else{
      echo "Tidak dapat menyimpan data!<br>";
      echo mysqli_error($con);
   }
?>