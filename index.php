<?php
  session_start();
  ob_start();
  
  include "library/config.php";

  if(empty($_SESSION['username']) or empty($_SESSION['password'])){
     echo "<p align='center'> Anda harus login terlebih dahulu!</p>";
     echo "<meta http-equiv='refresh' content='2; url=login.php'>";
  }else{
    define('INDEX', true);
    $level = $_SESSION['level'];
?>
<!DOCTYPE HTML>
<html>
   <head>
      <title>Sistem Manajemem Kas</title>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="css/style.css">
   </head>
   <body>
      <header>
         POS
      </header>
      <div class="container">
         <aside>
            <ul class="menu">
               <li> <a href="?hal=dashboard" class="aktif">Dashboard</a> </li>
               <li> <a href="?hal=pos">Tambah Transaksi</a> </li>
               <?php if($level == 'owner') : ?>
                  <li> <a href="?hal=laporan_harian">Laporan Harian</a> </li>
                  <li> <a href="?hal=laporan_bulanan">Laporan Bulanan</a> </li>
               <?php endif; ?>
               <li> <a href="logout.php">Keluar</a> </li>
            </ul>
         </aside>
         <section class="main">
            <?php include "konten.php"; ?>
         </section>
      </div>
      <script>
         // Menghilangkan Notif dalam interval waktu tertentu
         $('#notif').delay(3000).fadeOut(300);
      </script>
      <footer>
         Copyright &copy; Abka Zailani
      </footer>
   </body>
</html>   
<?php
   }
?>
 