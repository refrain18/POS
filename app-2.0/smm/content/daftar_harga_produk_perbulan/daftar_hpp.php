<?php
   if(!defined('INDEX')) die("");
?>

<script>
   function getData() {
      // ! BUG: Ajax Response returning empty data
      let el_bln = document.getElementById('bulan');
      let el_thn = document.getElementById('tahun');
      
      if (el_bln.value == '' || el_thn.value == '') {
         console.log('Wait for other params...');
         return false;
      }

      let url = 'request/get_daftar_rata_harga_produk_perbulan.php'
      let req = `q={"bulan": "${el_bln.value}", "tahun": "${el_thn.value}"`;      
      console.log('Activated');
      $.ajax({
         url: url,
         method: "GET",
         data: req,
         dataType: "json",
         success: function (res) {
            if (res.status) {
               document.getElementById('tableData').innerHTML = res.data;
               console.log("Req Complete!");
            }
         },
         error: function (res) {
            alert(`Terjadi kesalahan pada server!\n${res.message}`);
         }
      });
   }
</script>

<h2 class="judul">Daftar Harga Produk Salon Mumtaza Perbulan</h2>
<!-- <br> -->
<div style="visibility:hidden;">
<form action="">   
<label class="label_bulan" for="">Bulan</label>
<select class="select_bulan" style="padding:0;" name="bulan" id="bulan" onchange="//getData();">
   <option value="" selected>--Pilih--</option>
    <option value="january">Januari</option>
    <option value="february">Februari</option>
    <option value="march">Maret</option>
    <option value="april">April</option>
    <option value="may">Mei</option>
    <option value="june">Juni</option>
    <option value="july">Juli</option>
    <option value="august">Agustus</option>
    <option value="september">September</option>
    <option value="october">Oktober</option>
    <option value="november">November</option>
    <option value="december">Desember</option>
</select>

<?php
$stmt = "SELECT DISTINCT 
      YEAR(tanggal) as tahun 
   FROM stok_masuk ORDER BY tanggal ASC;
";

$execQuery = mysqli_query($con, $stmt);
?>
<label class="label_tahun" for="">Tahun</label>
<select class="select_tahun" style="padding:0;" name="tahun" id="tahun" onchange="//getData();">
   <option value="" selected>--Pilih--</option>
   <?php while($thn = mysqli_fetch_assoc($execQuery)): ?>
      <option value="<?= $thn['tahun'] ?>"><?= $thn['tahun'] ?></option>
   <?php endwhile; ?>
</select>
</form>
</div>
<!-- <a class="cetak" target="_BLANK" href="./content/daftar_harga_produk_perbulan/dh_cetak.php?q=" style="margin: 0px 0px 15px 0;">Cetak</a> -->
<!-- <br> -->

</br>
</br>
<table class="table">
   <thead>
      <tr>
         <th>No</th>
         <th>Nama Produk</th>
         <th>Rata - Rata Harga Perbulan</th>
         <th>Aksi</th>
      </tr>
   </thead>
   <tbody id="tableData">
<?php
   $stmt = "SELECT 
         a.produk_id, b.nama_produk, 
         (SELECT ROUND(AVG(harga), 0) FROM stok_masuk c WHERE c.produk_id = a.produk_id) as hrg_rata 
      FROM stok_masuk a JOIN produk_salon b ON a.produk_id = b.produk_id 
      WHERE a.tanggal BETWEEN '2021-01-01' AND '2021-01-30' 
      GROUP BY a.produk_id ORDER BY a.produk_id ASC;
   ";

   $query = mysqli_query($con, $stmt);
   $no = 0;
   while($data = mysqli_fetch_array($query)){
?>
   <tr>
      <td><?= ++$no ?></td>
      <td><?= $data['nama_produk'] ?></td>
      <td><?= $data['hrg_rata'] ?></td>
      <td>
         <a class="tombol_detail" href="?mod=daftar_harga_produk_perbulan&hal=dh_detail&produk_id=<?= $data['produk_id'] ?>"> Detail </a>
      </td>
   </tr>
<?php
   }
?>
   </tbody>
</table>