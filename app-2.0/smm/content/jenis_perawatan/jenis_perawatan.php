<?php
   if(!defined('INDEX')) die("");
?>

<h2 class="judul">Jenis Perawatan</h2>
<a class="tombol" href="?mod=jenis_perawatan&hal=jp_tambah">Tambah</a>

<table class="table">
   <thead>
      <tr>
         <th>No</th>
         <th>Nama Perawatan</th>
         <th>Harga</th>
         <th>Waktu</th>
         <th>Komisi</th>
         <th>Aksi</th>
      </tr>
   </thead>
   <tbody>
<?php
   $query = mysqli_query($con, "SELECT * FROM jenis_perawatan ORDER BY jp_id ASC");
   $no = 0;
   while($data = mysqli_fetch_array($query)){
      $no++;
?>
      <tr>
         <td><?= $no ?></td>
         <td><?= $data['nama_perawatan'] ?></td>
         <td><?= $data['harga'] ?></td>
         <td><?= $data['waktu'] ?></td>
         <td><?= $data['komisi'] ?></td>
         <td>
            <a class="tombol edit" href="?mod=jenis_perawatan&hal=jp_edit&jp_id=<?= $data['jp_id'] ?>"> Edit </a>
            <a class="tombol hapus" href="?mod=jenis_perawatan&hal=jp_hapus&jp_id=<?= $data['jp_id'] ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"> Hapus </a>
         </td>
     </tr>
<?php
   }
?>
   </tbody>
</table>