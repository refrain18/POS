<?php
   if(!defined('INDEX')) die("");

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
<br>
<div>
   <label for="tahun">Filter Tahun : </label>
   <select class="standar-input" name="tahun" id="tahun">
      <option value="2020">2020</option>
      <?php while($row = mysqli_fetch_assoc($execQuery)) : ?>
         <option value="<?= $row['tahun'] ?>"><?= $row['tahun'] ?></option>
      <?php endwhile ?>
   </select>
   <a class="btn_cetak" href="?hal=rb_cetak" style="margin: 15px 0px;">Cetak</a>
</div>
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