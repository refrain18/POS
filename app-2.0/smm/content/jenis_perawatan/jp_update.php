<?php
   if(!defined('INDEX')) die("");

   $id = $_POST['jp_id'];
   $nama_perawatan = $_POST["nama_perawatan"];
   $harga = $_POST["harga"];
   $waktu = date('H:i:s', mktime(0, $_POST["waktu"], 0));
   $komisi = isset($_POST["komisi"]) && !empty($_POST["komisi"]) ? $_POST["komisi"] : 0;
   
   $query = mysqli_query($con, "UPDATE jenis_perawatan SET
      nama_perawatan = '$nama_perawatan',
      harga = '$harga',
      waktu = '$waktu',
      komisi = '$komisi'
      WHERE jp_id='$id'");

   if($query){
      echo "Data berhasil disimpan!";
      echo "<meta http-equiv='refresh' content='1; url=?mod=jenis_perawatan&hal=jenis_perawatan'>";
   }else{
      echo "Tidak dapat menyimpan data!<br>";
      echo mysqli_error($con);
   }
?>