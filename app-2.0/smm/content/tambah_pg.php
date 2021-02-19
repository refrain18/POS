<?php
   if(!defined('INDEX')) die("");
?>
<script>
function validateForm(context) {
   try {
      let form = context;
      let validasiHuruf = /^[a-zA-Z ]+$/;  
      let inputNama = form.nama.value;
      let inputTempatLahir = form.tmpt_lahir.value;
      let inputNoHp = form.no_hp.value;
      
      if (!inputNama.match(validasiHuruf)) {
         alert("NAMA HARUS HURUF !");
         return false;
      }
      if (!inputTempatLahir.match(validasiHuruf)) {
         alert("TEMPAT LAHIR HARUS HURUF !");
         return false;
      }
      if (!inputNoHp.match(/^[0-9]+$/)) {
         alert("NO.HP HARUS ANGKA !");
         return false;
      }
      return true;
   } catch (e) {
      alert('Terjadi kesalahan pada program validasi form!'+ e);
      return false;
   }
}
</script>
<h2 class="judul">Tambah Data Pegawai</h2>
<form name="formTambahPegawai" onsubmit="return validateForm(this)" method="POST" action="?hal=insert_pg" enctype="multipart/form-data">

   <div class="form-group">
      <label for="nama">Nama</label>   
      <div class="input"><input type="text" id="nama" name="nama" maxlength="30" required></div> 
   </div>       
   <div class="form-group">
      <label for="tmpt_lahir">Tempat Lahir</label>   
      <div class="input"><input type="text" id="tmpt_lahir" name="tmpt_lahir" required></div> 
   </div>

   <div class="form-group">
      <label for="tgl_lahir">Tanggal Lahir</label>   
      <div class="input"><input type="date" id="tgl_lahir" name="tgl_lahir" required></div> 
   </div>

   <div class="form-group">
      <label for="level">Level</label>   
      <div class="input">
         <select name="level" required>
            <option value="admin">Admin</option>
            <option value="clusterx">Clusterx</option>
            <option value="kasir">Kasir</option>
            <option value="sdm">SDM</option>
         </select>    
      </div> 
   </div>
   <div class="form-group">
      <label for="no_hp">No.HP</label>   
      <div class="input"><input type="phone" id="no_hp" name="no_hp" minlength="11" maxlength="13" required></div> 
   </div>
   <div class="form-group">
      <label for="email">Email</label>   
      <div class="input"><input type="email" id="email" name="email" maxlength="20" required></div> 
   </div>
   <div class="form-group">
      <label for="alamat">Alamat</label>   
      <div class="input"><textarea name="alamat" id="alamat" cols="50" rows="7" maxlength="200" required></textarea></div> 
   </div>
   <div class="form-group">
      <label for="date_joined">Tanggal Bergabung</label>   
      <div class="input"><input type="date" id="date_joined" name="date_joined" required></div> 
   </div>
   <div class="form-group">
      <label for="username">Username</label>   
      <div class="input"><input type="text" id="username" name="username" minlength="3" maxlength="20" required></div> 
   </div>
   <div class="form-group">
      <label for="pass">Password</label>   
      <div class="input"><input type="password" id="pass" name="password" minlength="8" maxlength="16" required></div> 
   </div>
   <div class="form-group"></br>
        <label>Status</label>
        <span>
              <input type="radio" name="status" value="on"  required/>On
              <input type="radio" name="status" value="off"  />Off
        </span>
    </div>

   <div class="form-group">
      <input type="submit" value="Simpan" class="tombol simpan">
      <input type="reset" value="reset" class="tombol reset">
   </div>
</form>