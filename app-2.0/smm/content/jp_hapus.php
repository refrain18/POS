<?php
   if(!defined('INDEX')) die("");

   $query = mysqli_query($con, "DELETE FROM jenis_perawatan WHERE jp_id='$_GET[jp_id]'");

   if($query){
      echo "Data berhasil dihapus!";
      echo "<meta http-equiv='refresh' content='1; url=?hal=jenis_perawatan'>";
   }else{
      echo "Tidak dapat menyimpan data!<br>";
      echo mysqli_error($con);
   }
?>