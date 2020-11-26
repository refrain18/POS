<?php
   if(!defined('INDEX')) die("");
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
   $query = mysqli_query($con, "SELECT * FROM payment ORDER BY payment_id ASC");
   $saldo = 0;
   
   while($data = mysqli_fetch_array($query)){
    $gambar =  $data['gambar'];
?>
      <tr>
         <td><?= date('l, d F y',strtotime($data['waktu'])) ?></td>
         <td><?= $data['nama_produk'] ?></td>
         <td><a target='_blank' href="images/bukti_pembayaran/<?= $gambar ?>"><?= $data['gambar'] ?></a></td>
         <td align="center"><?= $data['jenis_transaksi'] == "debet" ? $data['sub_total']:"-" ?></td>
         <td align="center"><?= $data['jenis_transaksi'] == "kredit" ? $data['sub_total']:"-" ?></td>
         <td align="right"><?= ($data['jenis_transaksi'] == "debet") ? $saldo += $data['sub_total'] : $saldo -= $data['sub_total'] ?></td>
     </tr>
<?php
   }
?>
   </tbody>
</table>