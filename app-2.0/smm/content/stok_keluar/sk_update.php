<?php
   if(!defined('INDEX')) die("");

   $id = $_POST['sk_id'];

   ini_set('date.timezone', 'Asia/Jakarta');
   $now = date("Y-m-d");
   $stok_keluar = $_POST["stok"];
   

   $query = mysqli_query($con, "UPDATE stok_keluar SET 
      tanggal = '$now',
      stok = '$stok_keluar'
      WHERE sk_id='$id'
   ");

   if($query){
      echo "Data berhasil disimpan!";
      echo "<meta http-equiv='refresh' content='1; url=?mod=stok_keluar&hal=stok_keluarM'>";
   }else{
      echo "Tidak dapat menyimpan data!<br>";
      echo mysqli_error($con);
   }
?>