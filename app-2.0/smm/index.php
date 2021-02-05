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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMM</title>
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
            <h4>Sistem Manajemen Mumtaza</h4>
        </div>

        <ul <?php echo $level != 'owner' ? "style='justify-content:flex-end;'" : "" ;?>>
            <li <?php echo $level != 'owner' ? "style='margin-right:20px;'" : "" ;?>><a href="?hal=dashboard">Home</a></li>
            <?php if($level != 'sdm' && $level != 'kasir') : ?>
                <li <?php echo $level != 'owner' ? "style='margin-right:20px;'" : "" ;?>><button onclick="myFunction()" class="dropbtn">Keuangan <i class="fa fa-caret-down"></i></button>
                    <div id="myDropdown" class="dropdown-content">
                        <a href="?hal=pos">Tambah Transaksi</a>
                        <!-- level akses owner  -->
                        <?php if($level == 'owner') : ?>
                            <a href="?hal=laporan_harian">Laporan Harian</a>
                            <a href="?hal=laporan_bulanan">Laporan Bulanan</a>
                            <a href="?hal=gaji_pegawai">Gaji Pegawai</a>
                            <a href="?hal=daftar_produk">Daftar Produk Salon</a>
                            <a href="?hal=daftar_hpp">Daftar Harga Produk Perbulan</a>
                            <a href="?hal=jenis_perawatan">Jenis Perawatan</a>
                        <?php endif; ?>
                    </div>
                </li>
            <?php endif; ?>
            <?php if($level != 'kasir' && $level != 'admin') : ?> 
            <li <?php echo $level != 'owner' ? "style='margin-right:20px;'" : "" ;?>><button onclick="myFunction1()" class="dropbtn1" >Pegawai <i class="fa fa-caret-down"></i></button>
                <div id="myDropdown1" class="dropdown-content1">
                    <a href="?hal=data_pegawai">Data Pegawai</a>
                    <a href="?hal=absen_pegawai">Absen Pegawai</a>
                    <a href="?hal=rekap_absen">Rekap Absen</a>
                    <a href="?hal=kinerja">Kinerja  Mingguan</a>
                    <a href="?hal=rekap_kinerja">Kinerja  Bulanan</a>
                </div>
            </li>
            <?php endif; ?>
            <?php if($level != 'sdm' && $level != 'admin') : ?>
            <li <?php echo $level != 'owner' ? "style='margin-right:20px;'" : "" ;?>><button onclick="myFunction2()" class="dropbtn2" >Laporan Stok Produk Salon <i class="fa fa-caret-down"></i></button>
                <div id="myDropdown2" class="dropdown-content2">
                    <a href="?hal=stok_masukM">Stok Masuk Mingguan</a>
                    <a href="?hal=rekap_sm">Stok Masuk Bulanan</a>
                    <a href="?hal=stok_keluarM">Penggunaan Mingguan</a>
                    <a href="?hal=rekap_sk">Penggunaan Bulanan</a>
                </div>
            </li>
            <!-- penutup level -->
            <?php endif; ?>
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
<script src="js/script.js"></script>
      <footer>
         Copyright &copy; Abka Zailani
      </footer>
</body>
</html>
<?php
   }
?>