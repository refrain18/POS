<?php
   if(!defined('INDEX')) die("");
?>

<h2 class="judul">Rekap Kinerja Pegawai Bulanan</h2>
<br>
<div>
<form action="">   
<label class="label_bulan" for="">Bulan</label>
<select class="select_bulan" name="bulan" id="bulan">
    <option value="januari">Januari</option>
    <option value="februari">Februari</option>
    <option value="maret">Maret</option>
    <option value="april">April</option>
    <option value="mei">Mei</option>
    <option value="juni">Juni</option>
    <option value="juli">Juli</option>
    <option value="agustus">Agustus</option>
    <option value="september">September</option>
    <option value="oktober">Oktober</option>
    <option value="november">November</option>
    <option value="desember">Desember</option>
</select>

<label class="label_tahun" for="">Tahun</label>
<select class="select_tahun" name="tahun" id="tahun">
    <option value="2020">2020</option>
    <option value="2021">2021</option>
</select>
</form>
</div>
<a class="cetak" href="?hal=ra_cetak">Cetak</a>
<br>
<!-- <a class="cetak" href="?hal=cetak_pg">Cetak</a> -->
</br>
<table class="table">
   <thead>
      <tr>
         <th rowspan="2">No</th>
         <th rowspan="2">Nama Pegawai</th>
         <th colspan="2">Total Piket Membersihkan</th>
         <th colspan="2">Total Telponan</th>
         <th rowspan="2">Aksi</th>
      </tr>
      <tr>
          <th>Piket</th>
          <th>Tidak Piket</th>
          <th>Ya</th>
          <th>Tidak</th>
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
            <a class="tombol_detail" href="?hal=rk_detail&=<?= $data[''] ?>"> Detail </a>
         </td>
     </tr>
<?php
   //}
?>
   </tbody>
</table>