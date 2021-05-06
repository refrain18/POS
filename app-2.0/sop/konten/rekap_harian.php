<?php
   if(!defined('INDEX')) die("");

   // Untuk Filter Detail Laporan Harian
   $filter_tgl = isset($_GET['filter_tgl']) ? $_GET['filter_tgl'] : '';

   $where_clause = "";
   if (!empty($filter_tgl)) {
      // Cek validitas format value filter
      if (date_parse($filter_tgl)['error_count'] == 0) {
         $where_clause = "WHERE a.tanggal = '$filter_tgl'";
      }
   }
?>

<h2 class="judul">Rekap SOP Harian Salon Mumtaza</h2><br>
<div class="flex-container" style="justify-content: space-between;">
   <div class="flex-item clear-padding clear-border" style="flex-grow: 9;">
      <form action="" method="GET">
         <input type="hidden" name="hal" value="rekap_harian" readonly>
         <input class="date_seach" type="date" name="filter_tgl" value="<?= $filter_tgl; ?>">
         <input class="t_search" type="submit" value="Search">
      </form>
   </div>
   <!-- <div class="flex-item clear-padding clear-border" style="margin-top: 2.5rem; flex-grow: 1;">
      <a class="btn_cetak" href="?hal=rh_cetak">Cetak</a>
   </div> -->
</div>
<table class="table">
   <thead>
      <tr>
         <th>No</th>
         <th>Hari/Tanggal</th>
         <th>Total SOP Harian</th>
         <th>Total Customer</th>
         <th>Rundown Complete</th>
         <th>Rundown Incomplete</th>
         <th>Aksi</th>
      </tr>
   </thead>
   <tbody>
<?php
   // Set Time Zone    
   ini_set('date.timezone', 'Asia/Jakarta');

   $query = "SELECT 
      a.tanggal, COUNT(id_sop) as total_sop, 
      COUNT(id_sop) as total_cus, 
      (SELECT COUNT(hasil_rundown) FROM sop b WHERE b.tanggal = a.tanggal AND b.hasil_rundown = 'Terpenuhi') as total_completed, 
      (SELECT COUNT(hasil_rundown) FROM sop c WHERE c.tanggal = a.tanggal AND c.hasil_rundown != 'Terpenuhi') as total_incompleted 
      FROM sop a $where_clause GROUP BY a.tanggal;
   ";
   $execQuery = mysqli_query($con, $query);
   $no = 0;
   while($resQuery = mysqli_fetch_assoc($execQuery)) :
?>
   <tr>
      <td><?php echo ++$no; ?></td>
      <td><?php echo date("D/d-m-Y", strtotime($resQuery['tanggal'])); ?></td>
      <td><?php echo $resQuery['total_sop']; ?></td>
      <td><?php echo $resQuery['total_cus']; ?></td>
      <td><?php echo $resQuery['total_completed']; ?></td>
      <td><?php echo $resQuery['total_incompleted']; ?></td>
      <td>
         <a class="tombol_detail" href="?hal=rh_detail_pertanggal&filter=<?php echo $resQuery['tanggal']; ?>"> Detail </a>
      </td>
   </tr>
<?php endwhile; ?>
   </tbody>
</table>