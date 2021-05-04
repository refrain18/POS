<?php
   if(!defined('INDEX')) die("");

   $query = mysqli_query($con, "DELETE FROM jenis_perawatan WHERE jp_id='$_GET[jp_id]'");

   if($query){
      echo "Data berhasil dihapus!";
      echo "<meta http-equiv='refresh' content='1; url=?mod=jenis_perawatan&hal=jenis_perawatan'>";
   }else{
      echo "Tidak dapat mneghapus data!<br>";
      echo mysqli_error($con);
   }
?>