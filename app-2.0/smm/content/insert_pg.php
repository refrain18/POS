<?php
   if(!defined('INDEX')) die("");

   $nama = $_POST["nama"];
   $tmp_lahir = $_POST["tmpt_lahir"];
   $tgl_lahir = $_POST["tgl_lahir"];
   $jabatan = $_POST["jabatan"];
   $no_hp = $_POST["no_hp"];
   $alamat = $_POST["alamat"];
   $tgl_bergabung = $_POST["join"];
   $status = $_POST["status"];
   

   $query = mysqli_query($con, "INSERT INTO pegawai SET
      nama = '$nama',
      tmpt_lahir = '$tmp_lahir',
      tgl_lahir = '$tgl_lahir',
      jabatan = '$jabatan',
      no_hp = '$no_hp',
      alamat = '$alamat',
      tanggal_bergabung = '$tgl_bergabung',
      pegawai.status = '$status'
   ");

   if($query){
      echo "Data berhasil disimpan!";
      echo "<meta http-equiv='refresh' content='1; url=?hal=data_pegawai'>";
   }else{
      echo "Tidak dapat menyimpan data!<br>";
      echo mysqli_error($con);
   }
?>