<?php
   if(!defined('INDEX')) die("");
   // Untuk Filter Detail Laporan Harian
   $filter_tgl = isset($_GET['filter']) ? $_GET['filter'] : '';

   if (empty($filter_tgl)) {
      echo "<meta http-equiv='refresh' content='1; url=?hal=rekap_harian'>";
   }

   $query = "SELECT 
      a.tanggal, COUNT(id_sop) as total_sop, 
      COUNT(id_sop) as total_cus, 
      (SELECT COUNT(hasil_rundown) FROM sop b WHERE b.tanggal = a.tanggal AND b.hasil_rundown = 'Terpenuhi') as total_completed, 
      (SELECT COUNT(hasil_rundown) FROM sop c WHERE c.tanggal = a.tanggal AND c.hasil_rundown != 'Terpenuhi') as total_incompleted 
      FROM sop a WHERE a.tanggal = '$filter_tgl' GROUP BY a.tanggal;
   ";
   $execQuery = mysqli_query($con, $query) OR die("Terjadi Kesalahan pada Query: ".mysqli_error($con));
   $resQuery = mysqli_fetch_assoc($execQuery);
   $no = 0;
?>

<h2 class="judul">Detail Rekap SOP Harian Salon Mumtaza</h2>
<div style="width: 80%;">
   <div class="flex-container">
      <div class="flex-item clear-padding clear-border" style="width: 15em;"><label><b>Hari/Tanggal : </b><?php echo $resQuery['tanggal']; ?></label></div>
      <div class="flex-item clear-padding clear-border" style="width: 15em;"><label><b>Total SOP Harian : </b><?php echo $resQuery['total_sop']; ?></label></div>
   </div>
   <div class="flex-container">
      <div class="flex-item clear-padding clear-border" style="width: 15em;"><label><b>Rundown Complete : </b><?php echo $resQuery['total_completed']; ?></label></div>
      <div class="flex-item clear-padding clear-border" style="width: 15em;"><label><b>Rundown Incomplete : </b><?php echo $resQuery['total_incompleted']; ?></label></div>
   </div>
</div>
<a class="btn_cetak" target="_BLANK" href="konten/rh_cetak_pertanggal.php?q=<?= $filter_tgl ;?>">Cetak</a>
<br><br>
<table class="table">
   <thead>
      <tr>
         <th>No</th>
         <th>Nama Pegawai</th>
         <th>Total Waktu Pekerjaan</th>
         <th>Total Rundown Completed</th>
         <th>Total Rundown Incompleted</th>
         <th>Total Komisi</th>
         <?php if($level == 'owner') : ?>
         <th>Aksi</th>
         <?php endif; ?>
      </tr>
   </thead>
   <tbody>
<?php
   $query = "SELECT 
      pegawai.pegawai_id, 
      pegawai.nama, 
      (SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(waktu))) FROM sop sop_b WHERE sop_b.tanggal = sop_a.tanggal AND sop_b.pegawai_id = sop_a.pegawai_id) as total_waktu, 
      (SELECT COUNT(hasil_rundown) FROM sop sop_c WHERE sop_c.tanggal = sop_a.tanggal AND sop_c.pegawai_id = sop_a.pegawai_id AND sop_c.hasil_rundown = 'Terpenuhi') as total_completed, 
      (SELECT COUNT(hasil_rundown) FROM sop sop_d WHERE sop_d.tanggal = sop_a.tanggal AND sop_d.pegawai_id = sop_a.pegawai_id AND sop_d.hasil_rundown != 'Terpenuhi') as total_incompleted, 
      (SELECT SUM(komisi) FROM sop sop_e WHERE sop_e.tanggal = sop_a.tanggal) as total_komisi 
      FROM sop sop_a JOIN pegawai ON sop_a.pegawai_id = pegawai.pegawai_id 
      WHERE sop_a.tanggal = '$filter_tgl' GROUP BY pegawai_id;
   ";
   $execQuery = mysqli_query($con, $query);
   $no = 0;
   while($data = mysqli_fetch_array($execQuery)){
   $no++;
?>
      <tr>
         <td><?= $no ?></td>
         <td><?= $data['nama'] ?></td>
         <td><?= $data['total_waktu'] ?></td>
         <td><?= $data['total_completed'] ?></td>
         <td><?= $data['total_incompleted'] ?></td>
         <td><?= $data['total_komisi'] ?></td>
         <?php if($level == 'owner') : ?>
            <td>
               <a class="tombol edit" href="?hal=rh_detail_perorangan&q=<?= "$data[pegawai_id],$filter_tgl" ?>"> Detail </a>
            </td>
         <?php endif; ?>
     </tr>
<?php
   }
?>
   </tbody>
</table>
<a class="tombol edit" style="margin-top:30px;float:right;" href="?hal=rekap_harian">Kembali</a>
