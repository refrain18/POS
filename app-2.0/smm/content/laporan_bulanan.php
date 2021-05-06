<?php
   if(!defined('INDEX')) die("");
   // Untuk Filter Detail Laporan Bulanan
   $filter = isset($_GET['filter']) ? explode(',', $_GET['filter']) : false;

   // Cek level User
   if ($level != 'owner') {
      // Redirect User ke Dashboard
      header('Location: index.php');
      die();
   }
?>

<h2 class="judul">Data Laporan Bulanan</h2>

<?php if($filter): ?>

   Info : <?= ucfirst($filter[0]) ?> <br>
   Bulan : <?= ucfirst($filter[1]) ?>

   <?php
      // Query untuk menarik deretan data laporan yang terfilter
      $query = "SELECT payment_id, DAY(waktu) as tgl, nama_produk, harga, diskon, qty, sub_total FROM payment WHERE jenis_transaksi = '$filter[0]'AND MONTHNAME(waktu) = '$filter[1]'";
      $execQuery = mysqli_query($con, $query);
      $grandTotal = 0;
   ?>

   <table class="table">
      <thead>
         <tr>
            <th>ID</th>
            <th>Tanggal</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Diskon</th>
            <th>Qty</th>
            <th>Sub Total</th>
         </tr>
      </thead>
      <tbody>
         <?php while($data = mysqli_fetch_array($execQuery)) :?>
         <tr>
            <td><?= $data['payment_id'] ?></td>
            <td><?= $data['tgl'] ?></td>
            <td><?= $data['nama_produk'] ?></td>
            <td><?= $data['harga'] ?></td>
            <td><?= $data['diskon'] ?></td>
            <td><?= $data['qty'] ?></td>
            <td><?= $data['sub_total'] ?></td>
         </tr>
         <?php
            // Akumulasi Sub Total 
            $grandTotal += $data['sub_total'];
            endwhile; 
         ?>
      </tbody>
      <tfoot>
         <tr>
            <td colspan="6"><center><b>Grand Total</b></center></td>
            <td><?= $grandTotal ?></td>
         </tr>
      </tfoot>
   </table>
   <br>
   <div style="float:right">
      <a class="tombol edit" href="?hal=laporan_bulanan">Kembali</a>
   </div>

<?php else : ?>

<table class="table">
   <thead>
      <tr>
         <th>Bulan</th>
         <th>Total Pemasukan</th>
         <th>Total Pengeluaran</th>
         <th>Aksi</th>
      </tr>
   </thead>
   <tbody>
<?php
   // Query Untuk Mengambil SUM Data Debet & Kredit per Bulan
   $query = "SELECT 
      MONTHNAME(a.waktu) as bulan, 
      (SELECT SUM(sub_total) FROM payment b WHERE MONTHNAME(b.waktu) = MONTHNAME(a.waktu) AND b.jenis_transaksi = 'debet') as income, 
      (SELECT SUM(sub_total) FROM payment c WHERE MONTHNAME(c.waktu) = MONTHNAME(a.waktu) AND c.jenis_transaksi = 'kredit') as outcome 
   FROM 
      payment a 
   GROUP BY 
      MONTHNAME(a.waktu) 
   ORDER BY 
      a.waktu";

   $execQuery = mysqli_query($con, $query);

   while($data = mysqli_fetch_array($execQuery)) :
?>
      <tr>
         <td><?= $data['bulan'] ?></td>
         <td><?= $data['income'] ?></td>
         <td><?= !empty($data['outcome']) ? $data['outcome'] : "-"; ?></td>
         <td>
            <a class="tombol edit" href="?hal=laporan_bulanan&filter=<?= "debet,".strtolower($data['bulan']) ?>"> Detail Debet</a>
            <a class="tombol edit" href="?hal=laporan_bulanan&filter=<?= "kredit,".strtolower($data['bulan']) ?>"> Detail Kredit</a>
         </td>
      </tr>
<?php endwhile; ?>
   </tbody>
</table>

<?php endif ?>