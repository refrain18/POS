<?php
   if(!defined('INDEX')) die("");
   
   // Untuk Filter Detail Laporan Harian
   $filter_thn = isset($_GET['filter_thn']) ? $_GET['filter_thn'] : '';
   
   // Set Time Zone    
   ini_set('date.timezone', 'Asia/Jakarta');
   $currentYear = date('Y');

   $where_clause = "WHERE YEAR(a.tanggal) = '$currentYear'";
   if (!empty($filter_thn)) {
      // Cek validitas format value filter
      if (date_parse($filter_thn)['error_count'] == 0) {
         $where_clause = "WHERE YEAR(a.tanggal) = '$filter_thn'";
      }
   }

   // Query Untuk Mengambil Data SOP per Bulan
   $query = "SELECT 
         YEAR(a.tanggal) as tahun 
      FROM 
         sop a 
      GROUP BY 
         YEAR(a.tanggal) 
      ORDER BY 
         a.tanggal
   ";

   $execQuery = mysqli_query($con, $query) OR die('Terjadi kesalahan pada query: '.mysqli_error($con));
?>

<h2 class="judul">Rekap SOP Bulanan Salon Mumtaza</h2>
<div class="flex-container" style="justify-content: space-between; width: 80%;">
   <div class="flex-item clear-padding clear-border">
      <form action="" method="GET">
         <label for="tahun">Filter Tahun : </label>
         <input type="hidden" name="hal" value="rekap_bulanan" readonly>
         <select class="standar-input" name="filter_thn" id="tahun">
            <option value="">--Pilih--</option>
            <?php while($row = mysqli_fetch_assoc($execQuery)) : ?>
               <option value="<?= $row['tahun'] ?>" <?= $filter_thn == $row['tahun'] ? 'selected' : ''; ?>><?= $row['tahun'] ?></option>
            <?php endwhile ?>
         </select>
         <input class="t_search" type="submit" value="Search">
      </form>
   </div>
</div>
<a class="btn_cetak" target="_BLANK" href="konten/rb_cetak_pertahun.php?q=<?= !empty($filter_thn) ? $filter_thn : $currentYear; ?>" style="margin: 0px 0px 15px;">Cetak</a>
<br>
<table class="table">
   <thead>
      <tr>
         <th>No</th>
         <th>Bulan</th>
         <th>Total SOP Bulanan</th>
         <th>Rundown Complete</th>
         <th>Rundown Incomplete</th>
         <th>Aksi</th>
      </tr>
   </thead>
   <tbody>
   <?php
   // Query Untuk Mengambil Data SOP per Bulan
   $query = "SELECT 
         MONTHNAME(a.tanggal) as bulan, 
         COUNT(a.id_sop) as total_sop, 
         (SELECT COUNT(hasil_rundown) FROM sop b WHERE MONTHNAME(b.tanggal) = MONTHNAME(a.tanggal) AND b.hasil_rundown = 'Terpenuhi') as total_completed, 
         (SELECT COUNT(hasil_rundown) FROM sop c WHERE MONTHNAME(c.tanggal) = MONTHNAME(a.tanggal) AND c.hasil_rundown != 'Terpenuhi') as total_incompleted 
      FROM 
         sop a 
      $where_clause 
      GROUP BY 
         MONTHNAME(a.tanggal) 
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
            <td><?= $resQuery['bulan'] ?></td>
            <td><?= $resQuery['total_sop'] ?></td>
            <td><?= $resQuery['total_completed'] ?></td>
            <td><?= $resQuery['total_incompleted'] ?></td>
            <td>
               <a class="tombol_detail" href="?hal=rb_detail&q=<?= strtolower($resQuery['bulan']) ?>"> Detail </a>
            </td>
         </tr>
      <?php endwhile; ?>
   <?php else : ?>
         <tr>
            <td colspan="6"><center>Belum ada data tersedia!</center></td>
         </tr>
   <?php endif ?>

   </tbody>
</table>