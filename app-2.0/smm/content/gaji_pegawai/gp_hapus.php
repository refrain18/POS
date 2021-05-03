<?php
   if(!defined('INDEX')) die("");

   $query = mysqli_query($con, "DELETE FROM gaji WHERE gaji_id='$_GET[gaji_id]'");

   if($query){
      echo "Data berhasil dihapus!";
      echo "<meta http-equiv='refresh' content='1; url=?mod=gaji_pegawai&hal=gaji_pegawai'>";
   }else{
      echo "Tidak dapat menyimpan data!<br>";
      echo mysqli_error($con);
   }
?>