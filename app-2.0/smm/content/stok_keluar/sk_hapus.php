<?php
   if(!defined('INDEX')) die("");

   $query = mysqli_query($con, "DELETE FROM stok_keluar WHERE sk_id='$_GET[sk_id]'");

   if($query){
      echo "Data berhasil dihapus!";
      echo "<meta http-equiv='refresh' content='1; url=?hal=stok_keluarM'>";
   }else{
      echo "Tidak dapat menyimpan data!<br>";
      echo mysqli_error($con);
   }
?>