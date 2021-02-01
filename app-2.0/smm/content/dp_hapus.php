<?php
   if(!defined('INDEX')) die("");

   $query = mysqli_query($con, "DELETE FROM produk_salon WHERE produk_id='$_GET[produk_id]'");

   if($query){
      echo "Data berhasil dihapus!";
      echo "<meta http-equiv='refresh' content='1; url=?hal=daftar_produk'>";
   }else{
      echo "Tidak dapat menyimpan data!<br>";
      echo mysqli_error($con);
   }
?>