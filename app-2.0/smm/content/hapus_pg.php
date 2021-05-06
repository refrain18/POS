<?php
   if(!defined('INDEX')) die("");

   $query = mysqli_query($con, "DELETE FROM user WHERE user_id='$_GET[user_id]'") or die('Terjadi kesalahan query: '.mysqli_error($con));

   if($query){
      echo "Data berhasil dihapus!";
      echo "<meta http-equiv='refresh' content='1; url=?hal=data_pegawai'>";
   }else{
      echo "Tidak dapat menyimpan data!<br>";
      echo mysqli_error($con);
   }
?>