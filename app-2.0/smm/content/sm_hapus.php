<?php
   if(!defined('INDEX')) die("");

   $query = mysqli_query($con, "DELETE FROM stok_masuk WHERE stok_masuk_id='$_GET[stok_masuk_id]'");

   if($query){
      echo "Data berhasil dihapus!";
      echo "<meta http-equiv='refresh' content='1; url=?hal=stok_masukM'>";
   }else{
      echo "Tidak dapat menyimpan data!<br>";
      echo mysqli_error($con);
   }
?>