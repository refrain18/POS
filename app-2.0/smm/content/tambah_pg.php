<?php
   if(!defined('INDEX')) die("");
?>
<script>
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
</script>
<h2 class="judul">Tambah Data Pegawai</h2>
<form name="myForm" onsubmit="return validateForm()" method="post" action="?hal=insert_pg" enctype="multipart/form-data">

   <?php
      
    //   $notif = isset($_GET['notif']) ? $_GET['notif'] : false;

    //   if($notif == 'tipefile') {
    //      echo "<div class='notif' id='notif'>Tipe file tidak didukung!</div>";
    //   }elseif($notif == 'ukuranfile') {
    //      echo "<div class='notif' id='notif'>Ukuran file tidak boleh lebih dari 1MB</div>";
    //   }

   ?>
   <div class="form-group">
      <label for="harga">Nama</label>   
      <div class="input"><input type="text" id="nama" name="nama" onkeyup="validasi()" required></div> 
   </div>       
   <div class="form-group">
      <label for="harga">Tempat Lahir</label>   
      <div class="input"><input type="text" id="tmpt_lahir" name="tmpt_lahir" onkeyup="validasi()" required></div> 
   </div>

   <div class="form-group">
      <label for="diskon">Tanggal Lahir</label>   
      <div class="input"><input type="date" id="tgl_lahir" name="tgl_lahir" required></div> 
   </div>

   <div class="form-group">
      <label for="jumlah">Jabatan</label>   
      <div class="input"><select name="jabatan" required>
                            <option value="leader">Leader</option>
                            <option value="staf">Staf</option>
                            <option value="helper">Helper</option>
                        </select>    
      </div> 
   </div>
   <div class="form-group">
      <label for="jumlah">No.HP</label>   
      <div class="input"><input type="phone" id="no_hp" name="no_hp" minlength="11" maxlength="13" onkeyup="validasi()" required></div> 
   </div>
   <div class="form-group">
      <label for="jumlah">Alamat</label>   
      <div class="input"><textarea name="alamat" id="alamat" cols="50" rows="10" required></textarea></div> 
   </div>
   <div class="form-group">
      <label for="jumlah">Tanggal Bergabung</label>   
      <div class="input"><input type="date" id="join" name="join"  required></div> 
   </div>
   <div class="form-group">
    </br>
        <label>Status</label>
        <span>
              <input type="radio" name="status" value="on"  required/>On
              <input type="radio" name="status" value="off"  />Off
        </span>
    </div>
    <!-- <div class="form-group">
      <label for="bukti_pembayaran">Struk Pembayaran</label>   
      <div class="input"><input type="file" id="cb" name="file"></div> 
   </div> -->

   <div class="form-group">
      <input type="submit" value="Simpan" class="tombol simpan">
      <input type="reset" value="reset" class="tombol reset">
   </div>
</form>