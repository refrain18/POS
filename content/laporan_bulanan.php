<?php
   if(!defined('INDEX')) die("");
?>

<h2 class="judul">Data Laporan Bulanan</h2>

<table class="table">
   <thead>
      <tr>
         <th>Bulan</th>
         <th>Total Pemasukan</th>
         <th>Total Pengeluaran</th>
         <th>Aksi</th>
      </tr>
   </thead>
   <tbody>
<?php
   $query = mysqli_query($con, "SELECT MONTHNAME(waktu) as bulan, SUM(sub_total) as sub_total FROM payment GROUP BY MONTH(waktu)");
   
   while($data = mysqli_fetch_array($query)){
?>
      <tr>
         <td><?= $data['bulan'] ?></td>
         <td><?= $data['sub_total'] ?></td>
         <td><?= $data['sub_total'] ?></td>
         <td>
            <a class="tombol edit" href="?hal=pos_edit&payment_id=<?= $data['payment_id'] ?>"> Detail </a>
         </td>
     </tr>
<?php
   }
?>
   </tbody>
</table>