<?php
   if(!defined('INDEX')) die("");

   $nama = $_POST["nama"];
   $tmp_lahir = $_POST["tmpt_lahir"];
   $tgl_lahir = $_POST["tgl_lahir"];
   $level = $_POST["level"];
   $no_hp = $_POST["no_hp"];
   $email = $_POST["email"];
   $alamat = $_POST["alamat"];
   $tgl_bergabung = $_POST["date_joined"];
   $username = $_POST["username"];
   $pass = md5($_POST["password"]);
   $status = $_POST["status"];

   $queryPegawai = "INSERT INTO user SET
      level = '$level',
      username = '$username',
      email = '$email',
      password = '$pass',
      status = '$status'"
   ; 
   
   if (mysqli_query($con, $queryPegawai)) {
      $last_id = mysqli_insert_id($con);
      

      $execLastQuery = mysqli_query($con, "INSERT INTO pegawai SET
         user_id = '$last_id',
         nama = '$nama',
         tmpt_lahir = '$tmp_lahir',
         tgl_lahir = '$tgl_lahir',
         no_hp = '$no_hp',
         alamat = '$alamat',
         tanggal_bergabung = '$tgl_bergabung'"
      );

      if ($execLastQuery) {
         echo "Data berhasil disimpan!";
         echo "<meta http-equiv='refresh' content='1; url=?mod=pegawai&hal=data_pegawai'>";
         die();
      }
   } 

   echo "Tidak dapat menyimpan data!<br>";
   echo mysqli_error($con);
?>