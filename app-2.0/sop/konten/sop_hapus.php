<?php
   if(!defined('INDEX')) die("");

   $query = mysqli_query($con, "DELETE FROM sop WHERE id_sop='$_GET[id_sop]'");

   if($query){
      echo "Data berhasil dihapus!";
      echo "<meta http-equiv='refresh' content='1; url=?hal=sop'>";
   }else{
      echo "Tidak dapat menyimpan data!<br>";
      echo mysqli_error($con);
   }
?>