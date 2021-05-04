<?php
   if(!defined('INDEX')) die("");

   ini_set('date.timezone', 'Asia/Jakarta');
   $now = date("Y-m-d"); 
   $produk_id = $_POST["produk_id"];
   $harga = $_POST["harga"];
   $stok_masuk = $_POST["stok"];

    // var_dump($now,$produk_id,$harga,$stok_masuk);die;

   $query = mysqli_query($con, "UPDATE stok_masuk SET
      produk_id = '$produk_id',
      tanggal = '$now',
      stok = '$stok_masuk',
      harga = '$harga'
      WHERE stok_masuk_id='$_POST[stok_masuk_id]'
   ")OR die(mysqli_error($con));

   if($query){
      echo "Data berhasil disimpan!";
      echo "<meta http-equiv='refresh' content='1; url=?mod=stok_masuk&hal=stok_masukM'>";
   }else{
      echo "Tidak dapat menyimpan data!<br>";
      echo mysqli_error($con);
   }
?>