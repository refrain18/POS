<?php
   if(!defined('INDEX')) die("");

   $id = isset($_POST['gaji_id']) ? $_POST['gaji_id'] : '';
   if ($id === '') {
      echo "Error Request!";
      echo "<meta http-equiv='refresh' content='1; url=?mod=gaji_pegawai&hal=gaji_pegawai'>";
      die();
   }
   
   $gaji_pokok = (int) $_POST["gajipokok"];
   $tunjangan = (int) $_POST["tunjangan"];
   $loyalitas = (int) $_POST["loyalitas"];
   $kedisiplinan = (int) $_POST["kedisiplinan"];
   $transport_umakan = (int) $_POST["transport_umakan"];
   $total_gaji = (int) $_POST["totalgaji"];
   $tpi_tel = (int) $_POST["tpi_tel"];
   $total_terima = (int) $_POST["totalterima"];

   $query = mysqli_query($con, "UPDATE gaji SET
      gaji_pokok = '$gaji_pokok',
      tunjangan = '$tunjangan',
      loyalitas = '$loyalitas',
      kedisiplinan = '$kedisiplinan',
      transport_umakan = '$transport_umakan',
      total_gaji = '$total_gaji',
      tpi_tel = '$tpi_tel',
      total_terima = '$total_terima'
   WHERE gaji_id = '$id'");

   if($query){
      echo "Data berhasil disimpan!";
      echo "<meta http-equiv='refresh' content='1; url=?mod=gaji_pegawai&hal=gaji_pegawai'>";
   }else{
      echo "Tidak dapat menyimpan data!<br>";
      echo mysqli_error($con);
   }
?>