<?php
   if(!defined('INDEX')) die("");
?>
<!-- <script>
function validateForm() {
  var validasiHuruf = /^[a-zA-Z ]+$/;  
  var x = document.forms["myForm"]["nama"].value;
  var y = document.forms["myForm"]["tmpt_lahir"].value;
  var z = document.forms["myForm"]["no_hp"].value;
  if (x.value.match(validasiHuruf)) {
    
  }else{
    alert("NAMA HARUS HURUF !");
    return false;
  }
  if (y !== (/^[a-zA-Z ]+$/)) {
    alert("TEMPAT LAHIR HARUS HURUF !");
    return false;
  }
  if (z !== (/^[0-9]+$/)) {
    alert("NO.HP HARUS ANGKA !");
    return false;
  }
}
</script> -->
<h2 class="judul">Tambah Produk Salon Mumtaza</h2>
<form name="myForm" onsubmit="return validateForm()" method="post" action="?hal=dp_insert" enctype="multipart/form-data">

   <?php
      
    //   $notif = isset($_GET['notif']) ? $_GET['notif'] : false;

    //   if($notif == 'tipefile') {
    //      echo "<div class='notif' id='notif'>Tipe file tidak didukung!</div>";
    //   }elseif($notif == 'ukuranfile') {
    //      echo "<div class='notif' id='notif'>Ukuran file tidak boleh lebih dari 1MB</div>";
    //   }

   ?>
   <div class="form-group">
      <label for="harga">Nama Produk</label>   
      <div class="input"><input type="text" id="nama_produk" name="nama_produk" onkeyup="validasi()" required></div> 
   </div>       
   <div class="form-group">
      <label for="harga">Stok</label>   
      <div class="input"><input type="number" id="stok" name="stok" onkeyup="validasi()" required></div> 
   </div>

   <div class="form-group">
      <label for="diskon">Harga</label>   
      <div class="input"><input type="number" id="harga" name="harga" required></div> 
   </div>

   <div class="form-group">
      <input type="submit" value="Simpan" class="tombol simpan">
      <input type="reset" value="reset" class="tombol reset">
   </div>
</form>