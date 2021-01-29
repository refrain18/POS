<?php
   if(!defined('INDEX')) die("");
?>

<h2 class="judul">Daftar Produk Salon Mumtaza</h2>
<a class="tombol" href="?hal=dp_tambah">Tambah</a>
<!-- <a class="cetak" href="?hal=cetak_pg">Cetak</a> -->

<table class="table">
   <thead>
      <tr>
         <th>No</th>
         <th>Nama Produk</th>
         <th>Stok</th>
         <th>Harga</th>
         <th>Aksi</th>
      </tr>
   </thead>
   <tbody>
<?php
   $query = mysqli_query($con, "SELECT * FROM produk_salon ORDER BY produk_id ASC");
   $no = 0;
   while($data = mysqli_fetch_array($query)){
      $no++;
?>
      <tr>
         <td><?= $no ?></td>
         <td><?= $data['nama_produk'] ?></td>
         <td><?= $data['stok'] ?></td>
         <td><?= $data['harga'] ?></td>
         <td>
            <a class="tombol edit" href="?hal=dp_edit&produk_id=<?= $data['produk_id'] ?>"> Edit </a>
            <a class="tombol hapus" href="?hal=dp_hapus&produk_id=<?= $data['produk_id'] ?>"> Hapus </a>
         </td>
     </tr>
<?php
   }
?>
   </tbody>
</table>