<?php
   if(!defined('INDEX')) die("");

   $awal = isset($_POST["awal"]) ? $_POST["awal"] : '';
   $akhir = isset($_POST["akhir"]) ? $_POST["akhir"] : '';
   $id_user = isset($_POST["nama"]) ? $_POST["nama"] : '';
   $gaji_pokok = isset($_POST["gajipokok"]) ? (int) $_POST["gajipokok"] : '';
   $tunjangan = isset($_POST["tunjangan"]) ? (int) $_POST["tunjangan"] : '';
   $loyalitas = isset($_POST["loyalitas"]) ? (int) $_POST["loyalitas"] : '';
   $kedisiplinan = isset($_POST["kedisiplinan"]) ? (int) $_POST["kedisiplinan"] : '';
   $transport_umakan = isset($_POST["transport_umakan"]) ? (int) $_POST["transport_umakan"] : '';
   $total_gaji = isset($_POST["totalgaji"]) ? (int) $_POST["totalgaji"] : '';
   $tpi_tel = isset($_POST["sanksi"]) ? (int) $_POST["sanksi"] : '';
   $total_terima = isset($_POST["totalterima"]) ? (int) $_POST["totalterima"] : '';

   if (
      $awal === '' || $akhir === '' || $id_user === '' || $gaji_pokok === '' || $tunjangan === '' || $loyalitas === '' || 
      $kedisiplinan === '' || $transport_umakan === '' || $total_gaji === '' || $tpi_tel === '' || $total_terima === ''
   ) {
      echo "<b>Kesalahan Program:</b> <i>Input invalid!</i>";
      echo "<meta http-equiv='refresh' content='3; url=?mod=gaji_pegawai&hal=gaji_pegawai'>";
      die();
   }

   $query = mysqli_query($con, "INSERT INTO gaji SET
      periode_awal = '$awal',
      periode_akhir = '$akhir',
      pegawai_id = '$id_user',
      gaji_pokok = '$gaji_pokok',
      tunjangan = '$tunjangan',
      loyalitas = '$loyalitas',
      kedisiplinan = '$kedisiplinan',
      transport_umakan = '$transport_umakan',
      total_gaji = '$total_gaji',
      tpi_tel = '$tpi_tel',
      total_terima = '$total_terima'
   ");

   if($query){
      echo "<b>Data berhasil disimpan!</b>";
      echo "<meta http-equiv='refresh' content='2; url=?mod=gaji_pegawai&hal=gaji_pegawai'>";
   }else{
      echo "<b>Tidak dapat menyimpan data!</b><br><br>";
      echo "<b>Kesalahan pada query SQL: </b><i>".mysqli_error($con)."</i>";
      echo "<meta http-equiv='refresh' content='3; url=?mod=gaji_pegawai&hal=gaji_pegawai'>";
   }