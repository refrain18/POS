<?php
   if(!defined('INDEX')) die("");
?>

<h2 class="judul">Daftar Produk Salon Mumtaza</h2>
<a class="tombol" href="?mod=daftar_produk&hal=dp_tambah">Tambah</a>
<a class="cetak" target="_BLANK" href="./content/daftar_produk/dp_cetak.php" style="margin: 0px 0px 15px 0;">Cetak</a>

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
         <td><?= rupiah($data['harga']) ?></td>
         <td>
            <a class="tombol edit" href="?mod=daftar_produk&hal=dp_edit&produk_id=<?= $data['produk_id'] ?>"> Edit </a>
            <a class="tombol hapus" href="?mod=daftar_produk&hal=dp_hapus&produk_id=<?= $data['produk_id'] ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"> Hapus </a>
         </td>
     </tr>
<?php
   }
?>
   </tbody>
</table>