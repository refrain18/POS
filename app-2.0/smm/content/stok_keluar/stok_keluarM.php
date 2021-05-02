<?php
   if(!defined('INDEX')) die("");
?>

<h2 class="judul">Penggunaan Produk Mingguan</h2>
<br>
<a class="tombol" href="?hal=sk_tambah">Tambah</a>

<table class="table">
   <thead>
      <tr>
         <th>No</th>
         <th>Hari/Tanggal</th>
         <th>Nama Produk</th>
         <th>Jumlah Stok Masuk</th>
         <th>Aksi</th>
      </tr>
   </thead>
   <tbody>
<?php
   $query = mysqli_query($con, "SELECT stok_keluar.*, produk_salon.nama_produk FROM stok_keluar JOIN produk_salon ON 
                                stok_keluar.produk_id = produk_salon.produk_id ORDER BY sk_id DESC");
   $no = 0;
   while($data = mysqli_fetch_array($query)){
      $no++;
?>
      <tr>
         <td><?= $no ?></td>
         <td><?= $data['tanggal'] ?></td>
         <td><?= $data['nama_produk'] ?></td>
         <td><?= $data['stok'] ?></td>
         <td>
            <a class="tombol edit" href="?hal=sk_edit&sk_id=<?= $data['sk_id'] ?>"> Edit </a>
            <a class="tombol hapus" href="?hal=sk_hapus&sk_id=<?= $data['sk_id'] ?>"> Hapus </a>
         </td>
     </tr>
<?php
   }
?>
   </tbody>
</table>