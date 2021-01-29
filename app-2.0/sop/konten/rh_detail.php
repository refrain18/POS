<?php
   if(!defined('INDEX')) die("");
?>

<h2 class="judul">Detail Rekap SOP Harian Salon Mumtaza</h2>
<div class="label_123">
    <label class="l_haritanggal" for="">Hari/Tanggal :</label>
    <br>
    <label class="l_tsh" for="">Total SOP Harian :</label>
    <label class="l_rc" for="">Rundown Complete :</label>
    <label class="l_ri" for="">Rundown Incomplete :</label>
</div>
<a class="cetak" href="?hal=rh_cetak_detail">Cetak</a>
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
<?php
//    $query = mysqli_query($con, "SELECT produk_salon.*, stok_masuk.harga FROM produk_salon JOIN stok_masuk ON produk_salon.produk_id = stok_masuk.produk_id ORDER BY produk_id ASC");
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
         <td></td>
     </tr>
<?php
   //}
?>
   </tbody>
</table>