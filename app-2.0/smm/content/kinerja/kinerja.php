<?php
   if(!defined('INDEX')) die("");
?>

<h2 class="judul">Kinerja Pegawai</h2>
<a class="tombol" href="?hal=k_tambah">Tambah</a>
<!-- <a class="cetak" href="?hal=cetak_pg">Cetak</a> -->

<table class="table">
   <thead>
      <tr>
         <th rowspan="3">No</th>
         <th rowspan="3">Nama</th>
         <th colspan="7">Piket Membersihkan</th>
         <th colspan="7">Telponan</th>
         <th rowspan="3">Aksi</th>
      </tr>
      <tr>
         <th>Sn</th>
         <th>Sls</th>
         <th>Rb</th>
         <th>Kms</th>
         <th>Jmt</th>
         <th>Sbt</th>
         <th>Mng</th>
         <th>Sn</th>
         <th>Sls</th>
         <th>Rb</th>
         <th>Kms</th>
         <th>Jmt</th>
         <th>Sbt</th>
         <th>Mng</th>
      </tr>
      <tr>
         <th>tgl</th>
         <th>tgl</th>
         <th>tgl</th>
         <th>tgl</th>
         <th>tgl</th>
         <th>tgl</th>
         <th>tgl</th>
         <th>tgl</th>
         <th>tgl</th>
         <th>tgl</th>
         <th>tgl</th>
         <th>tgl</th>
         <th>tgl</th>
         <th>tgl</th>
      </tr>
   </thead>
   <tbody>
<?php
   // $query = mysqli_query($con, "SELECT absen.*, pegawai.nama FROM absen JOIN pegawai ON absen.pegawai_id = pegawai.pegawai_id ORDER BY id_absen DESC");
   // $no = 0;
   // while($data = mysqli_fetch_array($query)){
   //    $no++;
?>
      <tr>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td>
            <a class="tombol edit" href="?hal=k_edit&=<?= $data[''] ?>"> Edit </a>
            <a class="tombol hapus" href="?hal=k_hapus&=<?= $data[''] ?>"> Hapus </a>
         </td>
     </tr>
<?php
   //}
?>
   </tbody>
</table>