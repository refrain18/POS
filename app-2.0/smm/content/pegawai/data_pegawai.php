<?php
   if(!defined('INDEX')) die("");
?>

<h2 class="judul">Data Pegawai</h2>
<a class="tombol" href="?hal=tambah_pg">Tambah</a>
<!-- <a class="cetak" href="?hal=cetak_pg">Cetak</a> -->

<table class="table">
   <thead>
      <tr>
         <th>No</th>
         <th>Nama</th>
         <th>Tempat Lahir</th>
         <th>Tanggal Lahir</th>
         <th>Jabatan</th>
         <th>No.HP</th>
         <th>Alamat</th>
         <th>Tanggal Bergabung</th>
         <th>Status</th>
         <th>Aksi</th>
      </tr>
   </thead>
   <tbody>
<?php
   $query = mysqli_query($con, "SELECT pegawai.*, user.level, user.status FROM pegawai JOIN user ON pegawai.user_id = user.user_id ORDER BY pegawai_id ASC");
   $no = 0;
   while($data = mysqli_fetch_array($query)){
      $no++;
?>
      <tr>
         <td><?= $no ?></td>
         <td><?= $data['nama'] ?></td>
         <td><?= $data['tmpt_lahir'] ?></td>
         <td><?= $data['tgl_lahir'] ?></td>
         <td><?= $data['level'] ?></td>
         <td><?= $data['no_hp'] ?></td>
         <td><?= $data['alamat'] ?></td>
         <td><?= $data['tanggal_bergabung'] ?></td>
         <td><?= $data['status'] ?></td>
         <td>
            <a class="tombol edit" href="?hal=edit_pg&user_id=<?= $data['user_id'] ?>"> Edit </a>
            <a class="tombol hapus" onclick="confirm('Aksi ini akan menghapus data secara permanen?')" href="?hal=hapus_pg&user_id=<?= $data['user_id'] ?>"> Hapus </a>
         </td>
     </tr>
<?php
   }
?>
   </tbody>
</table>