<?php
   if(!defined('INDEX')) die("");

   $id_user = $_POST['user_id'];
   $nama = $_POST["nama"];
   $tmp_lahir = $_POST["tmpt_lahir"];
   $tgl_lahir = $_POST["tgl_lahir"];
   $no_hp = $_POST["no_hp"];
   $email = $_POST["email"];
   $alamat = $_POST["alamat"];
   $tgl_bergabung = $_POST["date_joined"];
   $level = $_POST["level"];
   $username = $_POST["username"];
   $pass = md5($_POST["password"]);
   $status = $_POST["status"];
   
   $queryUser = "UPDATE user SET 
      level = '$level',
      username = '$username',
      email = '$email',
      password = '$pass',
      status = '$status' 
      WHERE user_id = '$id_user';"
   ;

   $queryPegawai = "UPDATE pegawai SET 
      nama = '$nama',
      tmpt_lahir = '$tmp_lahir',
      tgl_lahir = '$tgl_lahir',
      no_hp = '$no_hp',
      alamat = '$alamat',
      tanggal_bergabung = '$tgl_bergabung' 
      WHERE user_id = '$id_user';"
   ;

   // Cek jika update pada tabel pegawai berhasil
   if (mysqli_query($con, $queryUser)) {
      // Cek jika update pada tabel user berhasil 
      if (mysqli_query($con, $queryPegawai)) {
         echo "Data berhasil diperbaharui!";
         echo "<meta http-equiv='refresh' content='1; url=?mod=pegawai&hal=data_pegawai'>";
         die();
      }
   } 
   echo "Tidak dapat memperbaharui data!<br>";
   echo die('Terjadi kesalahan query: '.mysqli_error($con));