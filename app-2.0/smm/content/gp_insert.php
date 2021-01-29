<?php
   if(!defined('INDEX')) die("");

   $awal = $_POST["awal"];
   $akhir = $_POST["akhir"];
   $nama = $_POST["nama"];
   $gaji_pokok = (int) $_POST["gajipokok"];
   $tunjangan = (int) $_POST["tunjangan"];
   $loyalitas = (int) $_POST["loyalitas"];
   $kedisiplinan = (int) $_POST["kedisiplinan"];
   $transport_umakan = (int) $_POST["transport_umakan"];
   $total_gaji = (int) $_POST["totalgaji"];
   $tpi_tel = (int) $_POST["tpi_tel"];
   $total_terima = (int) $_POST["totalterima"];
   

   $query = mysqli_query($con, "INSERT INTO gaji SET
      periode_awal = '$awal',
      periode_akhir = '$akhir',
      pegawai_id = '$nama',
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
      echo "Data berhasil disimpan!";
      echo "<meta http-equiv='refresh' content='1; url=?hal=gaji_pegawai'>";
   }else{
      echo "Tidak dapat menyimpan data!<br>";
      echo mysqli_error($con);
   }
?>