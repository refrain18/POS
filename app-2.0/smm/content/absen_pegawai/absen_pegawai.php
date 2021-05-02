<?php
   if(!defined('INDEX')) die("");
?>

<h2 class="judul">Absen Pegawai</h2>
<a class="tombol" href="?hal=ap_tambah">Tambah</a>
<!-- <a class="cetak" href="?hal=cetak_pg">Cetak</a> -->

<table class="table">
   <thead>
      <tr>
         <th rowspan="3">No</th>
         <th rowspan="3">Nama</th>
         <th colspan="7">Hari/Tanggal</th>
         <th rowspan="3">Aksi</th>
      </tr>
      <tr>
         <th>Senin</th>
         <th>Selasa</th>
         <th>Rabu</th>
         <th>Kamis</th>
         <th>Jumat</th>
         <th>Sabtu</th>
         <th>Minggu</th>
      </tr>
      <tr>
         <th>tanggal</th>
         <th>tanggal</th>
         <th>tanggal</th>
         <th>tanggal</th>
         <th>tanggal</th>
         <th>tanggal</th>
         <th>tanggal</th>
      </tr>
   </thead>
   <tbody>
<?php
   $query = mysqli_query($con, "SELECT absen.*, pegawai.nama FROM absen JOIN pegawai ON absen.pegawai_id = pegawai.pegawai_id ORDER BY id_absen DESC");
   $no = 0;
   while($data = mysqli_fetch_array($query)){
      $no++;
?>
      <tr>
         <td><?= $no ?></td>
         <td><?= $data['nama'] ?></td>
         <td><?= $data['keterangan'] ?></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td>
            <a class="tombol edit" href="?hal=ap_edit&id_absen=<?= $data['id_absen'] ?>"> Edit </a>
            <a class="tombol hapus" href="?hal=ap_hapus&id_absen=<?= $data['id_absen'] ?>"> Hapus </a>
         </td>
     </tr>
<?php
   }
?>
   </tbody>
</table>