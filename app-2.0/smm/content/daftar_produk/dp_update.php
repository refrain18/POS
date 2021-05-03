<?php
   if(!defined('INDEX')) die("");

   $nama_produk = $_POST["nama_produk"];
   $stok = $_POST["stok"];
   $harga = $_POST["harga"];
   

   $query = mysqli_query($con, "UPDATE produk_salon SET
      nama_produk = '$nama_produk',
      stok = '$stok',
      harga = '$harga'
      WHERE produk_id='$_POST[produk_id]'
   ");

   if($query){
      echo "Data berhasil disimpan!";
      echo "<meta http-equiv='refresh' content='1; url=?mod=daftar_produk&hal=daftar_produk'>";
   }else{
      echo "Tidak dapat menyimpan data!<br>";
      echo mysqli_error($con);
   }
?>