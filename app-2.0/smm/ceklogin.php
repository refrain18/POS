<?php
   session_start();
   include "library/config.php";

   $username = $_POST['username'];
   $password = md5($_POST['password']);

   $query = mysqli_query($con, "SELECT * FROM user WHERE (username='$username' AND password='$password') AND level != 'clusterx'");
   $data = mysqli_fetch_array($query);
   $jml = mysqli_num_rows($query);

   if($jml > 0){
      $_SESSION['smm_sessionArr'] = array(
         'user_id' => $data['user_id'],
         'username' => $data['username'],
         'password' => $data['password'],
         'level' => $data['level']
      );
      
      header('location: index.php');
   }else{
      echo "<p align='center'>Login Gagal</p>";
      echo "<meta http-equiv='refresh' content='2; url=login.php'>";
   }
?>