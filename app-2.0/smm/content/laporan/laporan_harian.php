<?php
   if(!defined('INDEX')) die("");

   // Cek level User
   if ($level != 'owner') {
      // Redirect User ke Dashboard
      header('Location: index.php');
      die();
   }
?>

<h2 class="judul">Data Laporan Harian</h2>

<table class="table">
   <thead>
      <tr>
         <th>Hari/Tanggal</th>
         <th>Transaksi</th>
         <th>Bukti Pembayaran</th>
         <th>Debet</th>
         <th>Kredit</th>
         <th>Saldo</th>
      </tr>
   </thead>
   <tbody>
<?php
   // Mengambil current timestamp
   ini_set('date.timezone', 'Asia/Jakarta');

   //menampilkan data berdasarkan bulan dan tahun
   $timestamp = date('Y-m');
// var_dump($timestamp);die;

   $query = mysqli_query($con, "SELECT * FROM payment WHERE DATE_FORMAT(waktu,'%Y-%m') = '$timestamp'  ORDER BY payment_id ASC");
   $saldo = 0;
   
   while($data = mysqli_fetch_array($query)){
    $gambar =  $data['gambar'];
?>
      <tr>
         <td><?= date('l, d F y',strtotime($data['waktu'])) ?></td>
         <td><?= $data['nama_produk'] ?></td>
         <td><a target='_blank' href="images/bukti_pembayaran/<?= $gambar ?>"><?= $data['gambar'] ?></a></td>
         <td align="center"><?= $data['jenis_transaksi'] == "debet" ? titik($data['sub_total']):"-" ?></td>
         <td align="center"><?= $data['jenis_transaksi'] == "kredit" ? titik($data['sub_total']):"-" ?></td>
         <td align="right"><?= ($data['jenis_transaksi'] == "debet") ? titik($saldo += $data['sub_total']) : titik($saldo -= $data['sub_total']) ?></td>
     </tr>
<?php
   }
?>
   </tbody>
</table>