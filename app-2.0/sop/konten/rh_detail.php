<?php
   if(!defined('INDEX')) die("");
   // Untuk Filter Detail Laporan Bulanan
   $filter_tgl = isset($_GET['filter']) && !empty($_GET['filter']) ? $_GET['filter'] : false;

   $query = "SELECT 
      a.tanggal, COUNT(id_sop) as total_sop, 
      COUNT(id_sop) as total_cus, 
      (SELECT COUNT(hasil_rundown) FROM sop b WHERE b.tanggal = a.tanggal AND b.hasil_rundown = 'Terpenuhi') as total_completed, 
      (SELECT COUNT(hasil_rundown) FROM sop c WHERE c.tanggal = a.tanggal AND c.hasil_rundown != 'Terpenuhi') as total_incompleted 
      FROM sop a WHERE a.tanggal = '$filter_tgl' GROUP BY a.tanggal;
   ";
   $execQuery = mysqli_query($con, $query);
   $resQuery = mysqli_fetch_assoc($execQuery);
   $no = 0;
?>

<h2 class="judul">Detail Rekap SOP Harian Salon Mumtaza</h2>
<div class="label_123">
    <label class="l_haritanggal" for="">Hari/Tanggal : <?php echo $resQuery['tanggal']; ?></label>
    <br>
    <label class="l_tsh" for="">Total SOP Harian : <?php echo $resQuery['total_sop']; ?></label>
    <label class="l_rc" for="">Rundown Complete : <?php echo $resQuery['total_completed']; ?></label>
    <label class="l_ri" for="">Rundown Incomplete : <?php echo $resQuery['total_incompleted']; ?></label>
</div>
<!-- <a class="cetak" href="?hal=rh_cetak_detail">Cetak</a> -->
<br>
<!-- <a class="cetak" href="?hal=cetak_pg">Cetak</a> -->
</br>
<table class="table">
   <thead>
      <tr>
         <th>No</th>
         <th>Nama Pegawai</th>
         <th>Jenis Perawatan</th>
         <th>Foto Pegawai</th>
         <th>Foto Bukti Customer</th>
         <th>Waktu Perawatan</th>
         <th>Keterangan</th>
      </tr>
   </thead>
   <tbody>
      <tr>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
     </tr>
   </tbody>
   <a class="tombol edit" href="?hal=rekap_harian">Kembali</a>
</table>