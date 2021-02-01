<?php
   if(!defined('INDEX')) die("");

   $query = mysqli_query($con, "SELECT absen.*, pegawai.nama FROM absen JOIN pegawai ON absen.pegawai_id = pegawai.pegawai.id WHERE absen_id='$_GET[absen_id]'");
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
<form name="myForm" onsubmit="return validateForm()" method="post" action="?hal=ap_update">
<input type="hidden" name="absen_id" value="<?= $data['absen_id'] ?>">

</div>
   <div class="form-group">
      <label for="harga">Nama Pegawai</label>   
      <div class="input"><select name="nama">
                <?php
                    $query = mysqli_query($con, "SELECT pegawai_id, nama FROM pegawai ORDER BY pegawai_id ASC");
                    while($row=mysqli_fetch_assoc($query)){
                        if($pegawai_id == $row['pegawai_id']) {
                            echo "<option value='$row[pegawai_id]' selected='true'>$row[nama]</option>";
                        }else{
                            echo "<option value='$row[pegawai_id]'>$row[nama]</option>";
                        }
                    }
                ?>
            </select></div> 
   </div>         
   <div class="form-group">
      <label for="hari/tanggal">Hari/Tanggal</label>   
      <div class="input"><input type="date" id="h_t" name="h_t" onkeyup="validasi()" value="<?= $data['tanggal'] ?>" required></div> 
   </div>

   <div class="form-group">
    </br>
        <label>Keterangan</label>
        <br>
        <span class="input">
              <input type="radio" name="keterangan" value="masuk" <?php if($status == "masuk"){ echo "checked='true'"; } ?> required/>&radic; &nbsp; &nbsp; &nbsp; Masuk
                </br>
              <input type="radio" name="keterangan" value="izin" <?php if($status == "izin"){ echo "checked='true'"; } ?> />&#73; &nbsp; &nbsp; &nbsp; Izin
              </br>
              <input type="radio" name="keterangan" value="sakit" <?php if($status == "sakit"){ echo "checked='true'"; } ?> />&#83; &nbsp; &nbsp; &nbsp; Sakit
              </br>
              <input type="radio" name="keterangan" value="absen" <?php if($status == "absen"){ echo "checked='true'"; } ?> />&mdash; &nbsp; &nbsp; &nbsp; Absen
        </span>
    </div>

   <div class="form-group">
      <input type="submit" value="Edit" class="tombol simpan">
      <input type="reset" value="reset" class="tombol reset">
   </div>
</form>