<?php
   if(!defined('INDEX')) die("");
   
   $filter_thn = isset($_GET['filter_thn']) ? $_GET['filter_thn'] : '';
   // Set Time Zone    
   ini_set('date.timezone', 'Asia/Jakarta');
   $currentYear = date('Y');
?>

<h2 class="judul">Sistem Penggajian Pegawai</h2>
<br>
<a class="tombol" href="?mod=gaji_pegawai&hal=gp_tambah">Tambah</a>
<a class="cetak" target="_BLANK" href="./content/gaji_pegawai/gp_cetak.php?q=<?= !empty($filter_thn) ? $filter_thn : $currentYear; ?>" style="margin: 0px 0px 15px 0;">Cetak</a>

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
         <th>Total Komisi</th>
         <th>Total Gaji</th>
         <th>Tidak Piket & Telponan</th>
         <th>Total Terima</th>
         <th>Aksi</th>
      </tr>
   </thead>
   <tbody>
<?php
   $query = "SELECT 
         gaji.*, pegawai.nama, sum(sop.komisi) as komisi 
      FROM 
         gaji LEFT JOIN pegawai ON gaji.pegawai_id = pegawai.pegawai_id LEFT JOIN sop ON pegawai.pegawai_id = sop.pegawai_id 
      GROUP BY gaji_id ORDER BY gaji_id;
   ";
   $execQuery_getGajiPegawai = mysqli_query($con, $query);
   $no = 0;
   while($data = mysqli_fetch_assoc($execQuery_getGajiPegawai)){
      $no++;
?>
      <tr>
         <td><?= $no ?></td>
         <td><?= date('d F Y',strtotime($data['periode_awal'])) ."&nbsp;<br>s/d<br>&nbsp;". date('d F Y',strtotime($data['periode_akhir'])) ?></td>
         <td><?= $data['nama'] ?></td>
         <td><?= titik($data['gaji_pokok']) ?></td>
         <td><?= titik($data['tunjangan']) ?></td>
         <td><?= titik($data['loyalitas']) ?></td>
         <td><?= titik($data['kedisiplinan']) ?></td>
         <td><?= titik($data['transport_umakan']) ?></td>
         <td><?= $data['komisi'] !== null ? titik($data['komisi']) : 0; ?></td>
         <td><?= titik($data['total_gaji']) ?></td>
         <td><?= titik($data['tpi_tel']) ?></td>
         <td><?= rupiah($data['total_terima']) ?></td>
         <td>
            <a class="tombol edit" href="?mod=gaji_pegawai&hal=gp_edit&gaji_id=<?= $data['gaji_id'] ?>"> Edit </a>
            <a class="tombol hapus" href="?mod=gaji_pegawai&hal=gp_hapus&gaji_id=<?= $data['gaji_id'] ?>"> Hapus </a>
         </td>
     </tr>
<?php
   }
?>
   </tbody>
</table>