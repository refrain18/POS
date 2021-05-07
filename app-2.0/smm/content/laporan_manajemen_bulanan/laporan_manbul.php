<?php
   if(!defined('INDEX')) die("");
?>

<h2 class="judul">Laporan Manajemen Bulanan</h2>
<a class="tombol" href="?mod=laporan_manajemen_bulanan&hal=lmb_tambah">Tambah</a>
<?php if($level == 'owner') : ?>   
<table class="table">
   <thead>
      <tr>
         <th>No</th>
         <th>Hari/Tanggal</th>
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

   //menampilkan data berdasarkan bulan dan tahun
   $timestamp = date('Y-m');

   $query = mysqli_query($con, "SELECT * FROM payment WHERE DATE_FORMAT(waktu,'%Y-%m') = '$timestamp' ORDER BY payment_id ASC");
   $no = 0;
   while($data = mysqli_fetch_array($query)){
      $no++;
?>
      <tr>
         <td><?= $no ?></td>
         <td><?= date('l, d F y',strtotime($data['waktu'])) ?></td>
         <td><?= $data['nama_produk'] ?></td>
         <td><?= rupiah($data['harga']) ?></td>
         <td><?= $data['diskon'] ?></td>
         <td><?= $data['qty'] ?></td>
         <td><?= $data['jenis_transaksi'] ?></td>
         <td><?= titik($data['sub_total']) ?></td>
         <td>
            <a class="tombol edit" href="?mod=laporan_manajemen_bulanan&hal=lmb_edit&payment_id=<?= $data['payment_id'] ?>"> Edit </a>
            <a class="tombol hapus" href="?mod=laporan_manajemen_bulanan&hal=lmb_hapus&payment_id=<?= $data['payment_id'] ?>"> Hapus </a>
         </td>
     </tr>
<?php
   }
?>
   </tbody>
</table>
<?php endif; ?>