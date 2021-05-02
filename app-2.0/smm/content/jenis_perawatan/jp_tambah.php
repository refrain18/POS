<?php
   if(!defined('INDEX')) die("");
?>

<!-- <script>
function validateForm() {
  var x = document.forms["myForm"]["file"].value;
  var y = document.forms["myForm"]["jumlah"].value;
  if (x == "") {
    alert("TIDAK ADA BUKTI FOTO TRANSAKSI, DATA TIDAK DIPROSES");
    return false;
  }
  if (y == 0 || y == "") {
    alert("QTY TIDAK BOLEH 0 ATAU KOSONG");
    return false;
  }
}
</script> -->

<h2 class="judul">Tambah Jenis Perawatan</h2>
<form name="myForm" onsubmit="return validateForm()" method="post" action="?hal=jp_insert" enctype="multipart/form-data">

   <div class="form-group">
      <label for="nama_perawatan">Nama Perawatan</label>   
      <div class="input"><input type="text" id="nama_perawatan" name="nama_perawatan"></div> 
   </div>

   <div class="form-group">
      <label for="harga">Harga</label>   
      <div class="input"><input type="number" id="harga" name="harga"></div> 
   </div>

   <div class="form-group">
      <label for="waktu">Waktu</label>   
      <div class="input"><input type="time" id="waktu" name="waktu"></div> 
   </div>

   <div class="form-group">
      <label for="komisi">Komisi</label>   
      <div class="input"><input type="number" id="komisi" name="komisi" onkeyup="validasi()"></div> 
   </div>
   <div class="form-group">
      <input type="submit" value="Tambah" class="tombol simpan">
      <input type="reset" value="reset" class="tombol reset">
   </div>
   
</form>