<?php
   if(!defined('INDEX')) die("");
?>

<h2 class="judul">Data POS</h2>
<a class="tombol" href="?hal=pos_tambah">Tambah</a>

<table class="table">
   <thead>
      <tr>
         <th>No</th>
         <th>Nama Produk</th>
         <th>Harga</th>
         <th>Diskon</th>
         <th>Jumlah</th>
         <th>Jenis Transaksi</th>
         <th>Sub Total</th>
         <th>Aksi</th>
      </tr>
   </thead>
   <tbody>
<?php
   $query = mysqli_query($con, "SELECT * FROM payment ORDER BY payment_id DESC");
   $no = 0;
   while($data = mysqli_fetch_array($query)){
      $no++;
?>
      <tr>
         <td><?= $no ?></td>
         <td><?= $data['nama_produk'] ?></td>
         <td><?= $data['harga'] ?></td>
         <td><?= $data['diskon'] ?></td>
         <td><?= $data['qty'] ?></td>
         <td><?= $data['jenis_transaksi'] ?></td>
         <td><?= $data['sub_total'] ?></td>
         <td>
            <a class="tombol edit" href="?hal=pos_edit&payment_id=<?= $data['payment_id'] ?>"> Edit </a>
            <a class="tombol hapus" href="?hal=pos_hapus&payment_id=<?= $data['payment_id'] ?>"> Hapus </a>
         </td>
     </tr>
<?php
   }
?>
   </tbody>
</table>