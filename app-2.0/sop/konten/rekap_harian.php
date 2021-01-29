<?php
   if(!defined('INDEX')) die("");
?>

<h2 class="judul">Rekap SOP Harian Salon Mumtaza</h2>
<br>
<div>
<form action="">   
    <input class="date_seach" type="date">
    <input class="t_search" type="submit" value="Search">
</form>
<a class="cetak_rh" href="?hal=rh_cetak">Cetak</a>
</div>
<!-- <a class="cetak" href="?hal=cetak_pg">Cetak</a> -->
</br>
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
//    $query = mysqli_query($con, "SELECT absen.*, pegawai.nama FROM absen JOIN pegawai ON absen.pegawai_id = pegawai.pegawai_id ORDER BY pegawai_id ASC");
//    $no = 0;
//    while($data = mysqli_fetch_array($query)){
//       $no++;


?>
      <tr>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td>
            <a class="tombol_detail" href="?hal=rh_detail&=<?= $data[''] ?>"> Detail </a>
         </td>
     </tr>
<?php
   //}
?>
   </tbody>
</table>