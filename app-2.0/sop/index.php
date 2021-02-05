<?php
  session_start();
  ob_start();
  
  include "lib/config.php";

  if(empty($_SESSION['username']) or empty($_SESSION['password'])){
     echo "<p align='center'> Anda harus login terlebih dahulu!</p>";
     echo "<meta http-equiv='refresh' content='2; url=login.php'>";
  }else{
    define('INDEX', true);
    $level = $_SESSION['level'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOP SalMum</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Big+Shoulders+Stencil+Text:wght@300;400&family=Coustard&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css"/>
    <!-- <link rel="stylesheet" href="css/style1.css"/> -->
    <!-- <link rel="stylesheet" href="css/bootstrap.min.css"/> -->
</head>
<body>
    
    <nav>
        <div class="logo">
            <h4>SOP Salon Mumtaza</h4>
        </div>

        <ul <?php echo $level != 'owner' ? "style='justify-content:flex-end;'" : "" ;?>>
            <li class="dropbtn" <?php echo $level != 'owner' ? "style='margin-right:20px;'" : "" ;?>><a href="?hal=sop">Home</a></li>
            <?php if($level == 'owner') : ?>
                <li class="dropbtn1"><a href="?hal=rekap_harian">Rekap SOP Harian</a></li>
                <li class="dropbtn2"><a href="?hal=rekap_bulanan">Rekap SOP Bulanan</a></li>
            <?php endif; ?>
            <!-- penutup level -->
            <li>
                <a href="logout.php">Logout</a>
            </li>
        </ul>

        <div class="menu-toggle">
            <input type="checkbox"/>
            <span></span>
            <span></span>
            <span></span>
        </div>
    </nav>

    <!-- Isi Kontent -->
    <section class="main">
            <?php include "konten.php"; ?>
    </section>
    <footer>
        Copyright &copy; Abka Zailani
    </footer>
    <script src="js/script.js"></script>
</body>
</html>
<?php
   }
?>