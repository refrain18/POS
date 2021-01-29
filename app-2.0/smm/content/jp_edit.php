<?php
   if(!defined('INDEX')) die("");

   $query = mysqli_query($con, "SELECT * FROM jenis_perawatan WHERE jp_id='$_GET[jp_id]'");
   $data = mysqli_fetch_array($query);
?>

<!-- <script>
function validateForm() {
  var y = document.forms["myForm"]["jumlah"].value;

  if (y == 0 || y == "") {
    alert("QTY TIDAK BOLEH 0 ATAU KOSONG");
    return false;
  }
}
</script> -->

<h2 class="judul">Edit Jenis Perawatan</h2>
<form name="myForm" onsubmit="return validateForm()" method="post" action="?hal=jp_update">
   <input type="hidden" name="jp_id" value="<?= $data['jp_id'] ?>">

   <div class="form-group">
      <label for="nama_perawatan">Nama Perawatan</label>   
      <div class="input">
         <input type="text" id="nama_perawatan" name="nama_perawatan" value="<?= $data['nama_perawatan'] ?>">
      </div> 
   </div>

   <div class="form-group">
      <label for="harga">Harga</label>   
      <div class="input"><input type="number" id="harga" name="harga" value="<?= $data['harga'] ?>"></div> 
   </div>

   <div class="form-group">
      <label for="waktu">Waktu</label>   
      <div class="input"><input type="time" id="waktu" name="waktu" value="<?= $data['waktu'] ?>"></div> 
   </div>

   <div class="form-group">
      <label for="komisi">Komisi</label>   
      <div class="input"><input type="number" id="komisi" name="komisi" onkeyup="validasi()" value="<?= $data['komisi'] ?>"></div> 
   </div>
   <div class="form-group">
      <input type="submit" value="Edit" class="tombol simpan">
   </div>
</form>