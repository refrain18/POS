<?php
   if(!defined('INDEX')) die("");
?>

<h2 class="judul">Detail Rekap Stok Masuk Bulanan Salon Mumtaza</h2>
<div class="label_123">
    <label class="l_namaProduk" for="">Nama Produk :</label>
    <br>
    <label class="l_tsm" for="">Total Stok Masuk :</label>
    <label class="l_bulan_rsm" for="">Bulan :</label>
</div>
<a class="cetak" href="?hal=rsm_cetak_detail">Cetak</a>
<br>
<!-- <a class="cetak" href="?hal=cetak_pg">Cetak</a> -->
</br>
<table class="table">
   <thead>
      <tr>
         <th>No</th>
         <th>Waktu Masuk</th>
         <th>Jumlah Stok Masuk</th>
         <th>Harga Satuan</th>
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
     </tr>
<?php
   //}
?>
   </tbody>
</table>