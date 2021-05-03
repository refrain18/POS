<?php
   if(!defined('INDEX')) die("");

   $query = mysqli_query($con, "DELETE FROM payment WHERE payment_id='$_GET[payment_id]'");

   if($query){
      echo "Data berhasil dihapus!";
      echo "<meta http-equiv='refresh' content='1; url=?mod=transaksi&hal=pos'>";
   }else{
      echo "Tidak dapat menyimpan data!<br>";
      echo mysqli_error($con);
   }
?>