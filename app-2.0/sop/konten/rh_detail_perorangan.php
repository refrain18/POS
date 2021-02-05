<?php
   if(!defined('INDEX')) die("");
   // Untuk Filter Detail Laporan Bulanan
   $filter = isset($_GET['q']) && !empty($_GET['q']) ? $_GET['q'] : false;

   if (!$filter) {
      echo "<meta http-equiv='refresh' content='1; url=?hal=rekap_harian'>";
   }

   $query = "SELECT 
      sop_a.id_sop, jp.nama_perawatan, sop_a.foto_pegawai as img_pgw, sop_a.foto_customer as img_struk, sop_a.hasil_rundown, sop_a.keterangan, pegawai.nama, 
      (SELECT COUNT(hasil_rundown) FROM sop sop_b WHERE sop_b.pegawai_id = sop_a.pegawai_id AND sop_b.hasil_rundown = 'Terpenuhi') as completed, 
      (SELECT COUNT(hasil_rundown) FROM sop sop_c WHERE sop_c.pegawai_id = sop_a.pegawai_id AND sop_c.hasil_rundown != 'Terpenuhi') as incompleted 
      FROM sop sop_a JOIN pegawai ON pegawai.pegawai_id = sop_a.pegawai_id JOIN jenis_perawatan jp ON jp.jp_id = sop_a.jp_id 
      WHERE sop_a.pegawai_id = '6' AND sop_a.tanggal = '$filter[1]';
   ";
   $execQuery = mysqli_query($con, $query);
   $resQuery = mysqli_fetch_assoc($execQuery);
   $no = 0;
?>

<h2 class="judul">Detail Rekap SOP Harian Salon Mumtaza</h2>
<div class="label_123">
    <label class="l_haritanggal" for="">Hari/Tanggal : <?php echo $resQuery['tanggal']; ?></label>
    <br>
    <label class="l_tsh" for="">Nama : <?php echo $resQuery['nama']; ?></label>
    <label class="l_rc" for="">Rundown Complete : <?php echo $resQuery['completed'][0]; ?></label>
    <label class="l_ri" for="">Rundown Incomplete : <?php echo $resQuery['incompleted'][0]; ?></label>
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
         <th>Foto Struk</th>
         <th>Rundown</th>
         <th>Keterangan</th>
         <?php if($level == 'owner') : ?>
         <th>Aksi</th>
         <?php endif; ?>
      </tr>
   </thead>
   <tbody>
<?php
   // $query = "SELECT 
   //    pegawai.pegawai_id, 
   //    pegawai.nama, 
   //    (SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(waktu))) FROM sop sop_b WHERE sop_b.tanggal = sop_a.tanggal) as total_waktu, 
   //    (SELECT COUNT(hasil_rundown) FROM sop sop_c WHERE sop_c.tanggal = sop_a.tanggal AND sop_c.hasil_rundown = 'Terpenuhi') as total_completed, 
   //    (SELECT COUNT(hasil_rundown) FROM sop sop_d WHERE sop_d.tanggal = sop_a.tanggal AND sop_d.hasil_rundown != 'Terpenuhi') as total_incompleted, 
   //    (SELECT SUM(komisi) FROM sop sop_e WHERE sop_e.tanggal = sop_a.tanggal) as total_komisi 
   //    FROM sop sop_a JOIN pegawai ON sop_a.pegawai_id = pegawai.pegawai_id 
   //    WHERE sop_a.tanggal = '$filter_tgl' GROUP BY pegawai_id;
   // ";
   // $execQuery = mysqli_query($con, $query);
   // $no = 0;
   while($data = mysqli_fetch_array($execQuery)){
   $no++;
?>
      <tr>
         <td><?= $no ?></td>
         <td><?= $data['nama'] ?></td>
         <td><?= $data['nama_perawatan'] ?></td>
         <td><?= $data['img_pgw'] ?></td>
         <td><?= $data['img_struk'] ?></td>
         <td><?= $data['hasil_rundown'] ?></td>
         <td><?= $data['keterangan'] ?></td>
         <?php if($level == 'owner') : ?>
            <td>
               <a class="tombol edit" href="?hal=sop_edit&q=<?= $data['id_sop'] ?>"> Detail </a>
            </td>
         <?php endif; ?>
     </tr>
<?php
   }
?>
   </tbody>
</table>
<a class="tombol edit" style="margin-top:30px;float:right;" href="?hal=rekap_harian">Kembali</a>
