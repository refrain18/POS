<?php
   session_start();
   include "lib/config.php";

   $username = $_POST['username'];
   $password = md5($_POST['password']);

   $query = mysqli_query($con, "SELECT user.*, pegawai.pegawai_id 
      FROM user JOIN pegawai ON user.user_id = pegawai.user_id 
      WHERE user.username='$username' AND user.password='$password'"
   );
   $data = mysqli_fetch_array($query);
   $jml = mysqli_num_rows($query);

   if($jml > 0){
      $_SESSION['id_user'] = $data['user_id'];
      // $_SESSION['id_pegawai'] = $data['pegawai_id'];
      $_SESSION['username'] = $data['username'];
      $_SESSION['password'] = $data['password'];
      $_SESSION['level'] = $data['level'];
      
      header('location: index.php');
   }else{
      echo "<p align='center'>Login Gagal</p>";
      echo "<meta http-equiv='refresh' content='2; url=login.php'>";
   }
?>