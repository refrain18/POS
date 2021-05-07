<?php
   if(!defined('INDEX')) die("");
?>

<h2 class="judul">Laporan Keuangan Harian</h2>
<a class="tombol" href="?mod=transaksi&hal=pos_tambah">Tambah</a>
<?php if($level == 'owner' || $level == 'admin') : ?>   
<table class="table">
   <thead>
      <tr>
         <th>No</th>
         <th>Nama Transaksi</th>
         <th>Jumlah Transaksi</th>
         <th>Diskon</th>
         <th>Qty</th>
         <th>Jenis Transaksi</th>
         <th>Sub Total</th>
         <th>Aksi</th>
      </tr>
   </thead>
   <tbody>
<?php
   // Mengambil current timestamp
   ini_set('date.timezone', 'Asia/Jakarta');
   $timestamp = date('Y-m-d');
   
   if ($level == 'admin') {
      $ilang = "WHERE waktu = '$timestamp' AND user.level ='admin'";
   }else{
      $ilang = "WHERE waktu = '$timestamp'";
   }

   $query = mysqli_query($con, "SELECT * FROM payment JOIN user ON payment.user_id=user.user_id $ilang ORDER BY payment_id ASC");
   $no = 0;
   while($data = mysqli_fetch_array($query)){
      $no++;
?>
      <tr>
         <td><?= $no ?></td>
         <td><?= $data['nama_produk'] ?></td>
         <td><?= rupiah($data['harga']) ?></td>
         <td><?= $data['diskon'] ?></td>
         <td><?= $data['qty'] ?></td>
         <td><?= $data['jenis_transaksi'] ?></td>
         <td><?= rupiah($data['sub_total']) ?></td>
         <td>
            <a class="tombol edit" href="?mod=transaksi&hal=pos_edit&payment_id=<?= $data['payment_id'] ?>"> Edit </a>
            <a class="tombol hapus" href="?mod=transaksi&hal=pos_hapus&payment_id=<?= $data['payment_id'] ?>"> Hapus </a>
         </td>
     </tr>
<?php
   }
?>
   </tbody>
</table>
<?php endif; ?>