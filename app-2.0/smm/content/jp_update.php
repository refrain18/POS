<?php
   if(!defined('INDEX')) die("");

   $nama_perawatan = $_POST["nama_perawatan"];
   $harga = $_POST["harga"];
   $waktu = $_POST["waktu"];
   $komisi = $_POST["komisi"];
   
   $query = mysqli_query($con, "UPDATE jenis_perawatan SET
      nama_perawatan = '$nama_perawatan',
      harga = '$harga',
      waktu = '$waktu',
      komisi = '$komisi'
      WHERE jp_id='$_POST[jp_id]'");

   if($query){
      echo "Data berhasil disimpan!";
      echo "<meta http-equiv='refresh' content='1; url=?hal=jenis_perawatan'>";
   }else{
      echo "Tidak dapat menyimpan data!<br>";
      echo mysqli_error($con);
   }
?>