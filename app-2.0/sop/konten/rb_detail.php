<?php
   if(!defined('INDEX')) die("");

   // Untuk Filter Detail Laporan Bulanan
   $filter = isset($_GET['q']) && !empty($_GET['q']) ? $_GET['q'] : false;

   // Cek validitas format value filter
   if ( !$filter || (date_parse($filter)['error_count'] != 0) ) {
      echo "<meta http-equiv='refresh' content='2; url=?hal=rekap_bulanan'>";
      die("Query Invalid!");
   }

   $query = "SELECT 
      a.tanggal, COUNT(id_sop) as total_sop,
      (SELECT COUNT(hasil_rundown) FROM sop b WHERE MONTHNAME(b.tanggal) = MONTHNAME(a.tanggal) AND b.hasil_rundown = 'Terpenuhi') as total_completed, 
      (SELECT COUNT(hasil_rundown) FROM sop c WHERE MONTHNAME(c.tanggal) = MONTHNAME(a.tanggal) AND c.hasil_rundown != 'Terpenuhi') as total_incompleted 
      FROM sop a WHERE MONTHNAME(a.tanggal) = '$filter' GROUP BY MONTHNAME(a.tanggal);
   ";
   $execQuery = mysqli_query($con, $query) OR die("Terjadi Kesalahan pada Query: ".mysqli_error($con));
   $resQuery = mysqli_fetch_assoc($execQuery);
?>

<h2 class="judul">Detail Rekap SOP Bulanan Salon Mumtaza</h2>
<br>
<div style="width: 80%;">
   <div class="flex-container">
      <div class="flex-item clear-padding clear-border" style="width: 15em;"><label><b>Bulan : </b><?php echo ucfirst($filter); ?></label></div>
      <div class="flex-item clear-padding clear-border" style="width: 15em;"><label><b>Total SOP Harian : </b><?php echo $resQuery['total_sop']; ?></label></div>
   </div>
   <div class="flex-container">
      <div class="flex-item clear-padding clear-border" style="width: 15em;"><label><b>Total Rundown Complete : </b><?php echo $resQuery['total_completed']; ?></label></div>
      <div class="flex-item clear-padding clear-border" style="width: 15em;"><label><b>Total Rundown Incomplete : </b><?php echo $resQuery['total_incompleted']; ?></label></div>
   </div>
</div>
<a class="btn_cetak" target="_BLANK" href="konten/rb_cetak_perbulan.php?q=<?= $filter; ?>">Cetak</a>
<br>
<br>
<table class="table">
   <thead>
      <tr>
         <th>No</th>
         <th>Hari/Tanggal</th>
         <th>Total SOP Harian</th>
         <th>Rundown Complete</th>
         <th>Rundown Incomplete</th>
      </tr>
   </thead>
   <tbody>
      <?php
      $query = "SELECT 
            a.tanggal, 
            COUNT(a.id_sop) as total_sop, 
            (SELECT COUNT(hasil_rundown) FROM sop b WHERE b.tanggal = a.tanggal AND b.hasil_rundown = 'Terpenuhi') as total_completed, 
            (SELECT COUNT(hasil_rundown) FROM sop c WHERE c.tanggal = a.tanggal AND c.hasil_rundown != 'Terpenuhi') as total_incompleted 
         FROM 
            sop a 
         WHERE 
            MONTHNAME(a.tanggal) = '$filter' 
         GROUP BY 
            a.tanggal 
         ORDER BY 
            a.tanggal
      ";

      $execQuery = mysqli_query($con, $query) OR die('Terjadi kesalahan pada query: '.mysqli_error($con));
      $no = 0;
      if ($execQuery && mysqli_num_rows($execQuery) > 0) :
         while($resQuery = mysqli_fetch_assoc($execQuery)) :
      ?>
            <tr>
               <td><?= ++$no ?></td>
               <td><?= date('d-m-Y', strtotime($resQuery['tanggal'])) ?></td>
               <td><?= $resQuery['total_sop'] ?></td>
               <td><?= $resQuery['total_completed'] ?></td>
               <td><?= $resQuery['total_incompleted'] ?></td>
            </tr>
         <?php endwhile; ?>
      <?php else : ?>
            <tr>
               <td colspan="6"><center>Belum ada data tersedia!</center></td>
            </tr>
      <?php endif ?>
   </tbody>
</table>
<a class="tombol edit" style="margin-top:30px;float:right;" href="?hal=rekap_bulanan">Kembali</a>