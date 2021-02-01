<?php
   if(!defined('INDEX')) die("");

   $now = date("Y-m-d H:i:s");
   $produk_id = $_POST["produk_id"];
   $harga = $_POST["harga"];
   $stok_masuk = $_POST["stok"];
   

   $query = mysqli_query($con, "INSERT INTO stok_masuk SET
      tanggal = '$now',
      produk_id = '$produk_id',
      stok = '$stok_masuk',
      harga = '$harga'
   ");

   if($query){
      echo "Data berhasil disimpan!";
      echo "<meta http-equiv='refresh' content='1; url=?hal=stok_masukM'>";
   }else{
      echo "Tidak dapat menyimpan data!<br>";
      echo mysqli_error($con);
   }
?>