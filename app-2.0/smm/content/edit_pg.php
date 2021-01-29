<?php
   if(!defined('INDEX')) die("");

   $query = mysqli_query($con, "SELECT * FROM pegawai WHERE pegawai_id='$_GET[pegawai_id]'");
   $data = mysqli_fetch_array($query);

   $status = $data['status'];
?>

<script>
function validateForm() {
  var y = document.forms["myForm"]["jumlah"].value;

  if (y == 0 || y == "") {
    alert("QTY TIDAK BOLEH 0 ATAU KOSONG");
    return false;
  }
}
</script>

<h2 class="judul">Edit Data Pegawai</h2>
<form name="myForm" onsubmit="return validateForm()" method="post" action="?hal=update_pg">
   <input type="hidden" name="pegawai_id" value="<?= $data['pegawai_id'] ?>">

   <div class="form-group">
      <label for="harga">Nama</label>   
      <div class="input"><input type="text" id="nama" name="nama" onkeyup="validasi()" value="<?= $data['nama'] ?>" required></div> 
   </div>       
   <div class="form-group">
      <label for="harga">Tempat Lahir</label>   
      <div class="input"><input type="text" id="tmpt_lahir" name="tmpt_lahir" onkeyup="validasi()" value="<?= $data['tmpt_lahir'] ?>" required></div> 
   </div>

   <div class="form-group">
      <label for="diskon">Tanggal Lahir</label>   
      <div class="input"><input type="date" id="tgl_lahir" name="tgl_lahir" value="<?= $data['tgl_lahir'] ?>" required></div> 
   </div>

   <div class="form-group">
      <label for="jumlah">Jabatan</label>   
      <div class="input"><select name="jabatan" value="<?= $data['jabatan'] ?>" required>
                            <option value="leader">Leader</option>
                            <option value="staf">Staf</option>
                            <option value="helper">Helper</option>
                        </select>    
      </div> 
   </div>
   <div class="form-group">
      <label for="jumlah">No.HP</label>   
      <div class="input"><input type="phone" id="no_hp" name="no_hp" minlength="11" maxlength="13" onkeyup="validasi()" value="<?= $data['no_hp'] ?>" required></div> 
   </div>
   <div class="form-group">
      <label for="jumlah">Alamat</label>   
      <div class="input"><textarea name="alamat" id="alamat" cols="50" rows="10" value="<?= $data['alamat'] ?>" required></textarea></div> 
   </div>
   <div class="form-group">
      <label for="jumlah">Tanggal Bergabung</label>   
      <div class="input"><input type="date" id="join" name="join" value="<?= $data['tanggal_bergabung'] ?>" required></div> 
   </div>
   <div class="form-group">
   </br>
        <label>Status</label>
        <span>
              <input type="radio" name="status" value="on" <?php if($status == "on"){ echo "checked='true'"; } ?> required/>On
              <input type="radio" name="status" value="off" <?php if($status == "off"){ echo "checked='true'"; } ?> />Off
        </span>
    </div>
 
   <div class="form-group">
      <input type="submit" value="Simpan" class="tombol simpan">
   </div>
</form>