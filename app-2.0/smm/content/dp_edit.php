<?php
   if(!defined('INDEX')) die("");

   $query = mysqli_query($con, "SELECT * FROM produk_salon WHERE produk_id='$_GET[produk_id]'");
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

<h2 class="judul">Edit Produk Salon Mumtaza</h2>
<form name="myForm" onsubmit="return validateForm()" method="post" action="?hal=dp_update">
<input type="hidden" name="produk_id" value="<?= $data['produk_id'] ?>">

   <div class="form-group">
      <label for="harga">Nama Produk</label>   
      <div class="input"><input type="text" id="nama_produk" name="nama_produk" onkeyup="validasi()" value="<?= $data['nama_produk'] ?>" required></div> 
   </div>       
   <div class="form-group">
      <label for="harga">Stok</label>   
      <div class="input"><input type="number" id="stok" name="stok" onkeyup="validasi()" value="<?= $data['stok'] ?>" required></div> 
   </div>

   <div class="form-group">
      <label for="diskon">Harga</label>   
      <div class="input"><input type="number" id="harga" name="harga" value="<?= $data['harga'] ?>" required></div> 
   </div>
   <div class="form-group">
      <input type="submit" value="Simpan" class="tombol simpan">
   </div>
</form>