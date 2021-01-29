<?php
   if(!defined('INDEX')) die("");
?>

<h2 class="judul">Sistem Penggajian Pegawai</h2>
<a class="tombol" href="?hal=gp_tambah">Tambah</a>
<a class="cetak" href="?hal=gp_cetak">Cetak</a>

<table class="table">
   <thead>
      <tr>
         <th>No</th>
         <th>Periode</th>
         <th>Nama</th>
         <th>Gaji Pokok</th>
         <th>Tunjangan</th>
         <th>Loyalitas</th>
         <th>Kedisiplinan</th>
         <th>Transport + Uang Makan</th>
         <th>Total Gaji</th>
         <th>Tidak Piket & Telponan</th>
         <th>Total Terima</th>
         <th>Aksi</th>
      </tr>
   </thead>
   <tbody>
<?php
   $query = mysqli_query($con, "SELECT gaji.*, pegawai.nama FROM gaji JOIN pegawai ON gaji.pegawai_id = pegawai.pegawai_id ORDER BY gaji_id DESC");
   $no = 0;
   while($data = mysqli_fetch_array($query)){
      $no++;
?>
      <tr>
         <td><?= $no ?></td>
         <td><?= date('d F Y',strtotime($data['periode_awal'])) ."&nbsp;<br>s/d<br>&nbsp;". date('d F Y',strtotime($data['periode_akhir'])) ?></td>
         <td><?= $data['nama'] ?></td>
         <td><?= $data['gaji_pokok'] ?></td>
         <td><?= $data['tunjangan'] ?></td>
         <td><?= $data['loyalitas'] ?></td>
         <td><?= $data['kedisiplinan'] ?></td>
         <td><?= $data['transport_umakan'] ?></td>
         <td><?= $data['total_gaji'] ?></td>
         <td><?= $data['tpi_tel'] ?></td>
         <td><?= $data['total_terima'] ?></td>
         <td>
            <a class="tombol edit" href="?hal=gp_edit&gaji_id=<?= $data['gaji_id'] ?>"> Edit </a>
            <a class="tombol hapus" href="?hal=gp_hapus&gaji_id=<?= $data['gaji_id'] ?>"> Hapus </a>
         </td>
     </tr>
<?php
   }
?>
   </tbody>
</table>