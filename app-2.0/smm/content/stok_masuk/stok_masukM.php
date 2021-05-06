<?php
   if(!defined('INDEX')) die("");
?>

<h2 class="judul">Stok Masuk Mingguan</h2>
<a class="tombol" href="?mod=stok_masuk&hal=sm_tambah">Tambah</a>

<table class="table">
   <thead>
      <tr>
         <th>No</th>
         <th>Hari/Tanggal</th>
         <th>Nama Produk</th>
         <th>Harga</th>
         <th>Jumlah Stok Masuk</th>
         <th>Aksi</th>
      </tr>
   </thead>
   <tbody>
<?php
   $query = mysqli_query($con, "SELECT stok_masuk.*, produk_salon.nama_produk FROM stok_masuk JOIN produk_salon ON stok_masuk.produk_id = produk_salon.produk_id ORDER BY stok_masuk_id DESC");
   $no = 0;
   while($data = mysqli_fetch_array($query)){
      $no++;
?>
      <tr>
         <td><?= $no ?></td>
         <td><?= $data['tanggal'] ?></td>
         <td><?= $data['nama_produk'] ?></td>
         <td><?= rupiah($data['harga']) ?></td>
         <td><?= $data['stok'] ?></td>
         <td>
            <a class="tombol edit" href="?mod=stok_masuk&hal=sm_edit&stok_masuk_id=<?= $data['stok_masuk_id'] ?>"> Edit </a>
            <a class="tombol hapus" href="?mod=stok_masuk&hal=sm_hapus&stok_masuk_id=<?= $data['stok_masuk_id'] ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?')"> Hapus </a>
         </td>
     </tr>
<?php
   }
?>
   </tbody>
</table>