<?php
   if(!defined('INDEX')) die("");

   $waktu = date("Y-m-d H:i:s");
   $nama_produk = $_POST["nama_produk"];
   $stok = $_POST["stok"];
   $harga = $_POST["harga"];
   

   $query = mysqli_query($con, "INSERT INTO produk_salon SET
      waktu = '$waktu',
      nama_produk = '$nama_produk',
      stok = '$stok',
      harga = '$harga'
   ");

   if($query){
      echo "Data berhasil disimpan!";
      echo "<meta http-equiv='refresh' content='1; url=?hal=daftar_produk'>";
   }else{
      echo "Tidak dapat menyimpan data!<br>";
      echo mysqli_error($con);
   }
?>