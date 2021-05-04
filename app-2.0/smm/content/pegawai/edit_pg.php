<?php
   if(!defined('INDEX')) die("");

   if (isset($_GET['user_id']) && !empty($_GET['user_id'])) {
      $id_user = $_GET['user_id'];
   } else {
      echo "<meta http-equiv='refresh' content='1; url=?mod=pegawai&hal=data_pegawai'>";
   }
   $query = mysqli_query(
      $con, 
      "SELECT pegawai.*, user.*, user.user_id FROM pegawai JOIN user ON pegawai.user_id = user.user_id WHERE user.user_id='$id_user'"
   ) or die('Terjadi kesalahan query: '.mysqli_error($con));
   
   if (mysqli_num_rows($query) <= 0) {
      echo "<meta http-equiv='refresh' content='1; url=?mod=pegawai&hal=data_pegawai'>";
   }

   $data = mysqli_fetch_assoc($query);
   $status = $data['status'];
?>

<script>
function validateForm(context) {
   try {
      if (!confirm('Lanjutkan menyimpan data!')) return false;
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

<h2 class="judul">Edit Data Pegawai</h2>
<form name="myForm" onsubmit="return validateForm(this)" method="post" action="?mod=pegawai&hal=update_pg">
   <input type="hidden" name="user_id" value="<?= $data['user_id'] ?>">

   <div class="form-group">
      <label for="nama">Nama</label>   
      <div class="input"><input type="text" id="nama" name="nama" maxlength="30" value="<?= $data['nama'] ?>" required></div> 
   </div>       
   <div class="form-group">
      <label for="tmpt_lahir">Tempat Lahir</label>   
      <div class="input"><input type="text" id="tmpt_lahir" name="tmpt_lahir" value="<?= $data['tmpt_lahir'] ?>" required></div> 
   </div>

   <div class="form-group">
      <label for="tgl_lahir">Tanggal Lahir</label>   
      <div class="input"><input type="date" id="tgl_lahir" name="tgl_lahir" value="<?= $data['tgl_lahir'] ?>" required></div> 
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
      <div class="input"><input type="phone" id="no_hp" name="no_hp" minlength="11" maxlength="13" value="<?= $data['no_hp'] ?>" required></div> 
   </div>
   <div class="form-group">
      <label for="email">Email</label>   
      <div class="input"><input type="email" id="email" name="email" maxlength="20" value="<?= $data['email'] ?>" required></div> 
   </div>
   <div class="form-group">
      <label for="alamat">Alamat</label>   
      <div class="input"><textarea name="alamat" id="alamat" cols="50" rows="7" maxlength="200" required><?= $data['alamat'] ?></textarea></div> 
   </div>
   <div class="form-group">
      <label for="date_joined">Tanggal Bergabung</label>   
      <div class="input"><input type="date" id="date_joined" name="date_joined" value="<?= $data['tanggal_bergabung'] ?>" required></div> 
   </div>
   <div class="form-group">
      <label for="username">Username</label>   
      <div class="input"><input type="text" id="username" name="username" minlength="3" maxlength="20" value="<?= $data['username'] ?>" required></div> 
   </div>
   <div class="form-group">
      <label for="pass">Password</label>   
      <div class="input"><input type="password" id="pass" name="password" minlength="8" maxlength="16" required></div> 
   </div>
   <div class="form-group"></br>
        <label>Status</label>
        <span>
              <input type="radio" name="status" value="on" <?php echo $status == "on" ? "checked='true'" : "";  ?> required/>On
              <input type="radio" name="status" value="off" <?php echo $status == "off" ? "checked='true'" : "";  ?> />Off
        </span>
    </div>
 
   <div class="form-group">
      <input type="submit" value="Simpan" class="tombol simpan">
   </div>
</form>