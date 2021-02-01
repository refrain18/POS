<?php
   if(!defined('INDEX')) die("");

   $query = mysqli_query($con, "DELETE FROM pegawai WHERE pegawai_id='$_GET[pegawai_id]'");

   if($query){
      echo "Data berhasil dihapus!";
      echo "<meta http-equiv='refresh' content='1; url=?hal=data_pegawai'>";
   }else{
      echo "Tidak dapat menyimpan data!<br>";
      echo mysqli_error($con);
   }
?>