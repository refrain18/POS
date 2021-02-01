<?php
   if(!defined('INDEX')) die("");

   $query = mysqli_query($con, "SELECT kinerja.*, pegawai.nama FROM kinerja JOIN pegawai ON kinerja.pegawai_id = pegawai.pegawai_id WHERE kinerja_id='$_GET[kinerja_id]'");
   $data = mysqli_fetch_array($query);

   $piket = $data['piket_bersih'];
   $telponan = $data['telponan'];
?>

<h2 class="judul">Edit Kinerja Pegawai</h2>
<form method="post" action="?hal=k_update" enctype="multipart/form-data">
<input type="hidden" name="kinerja_id" value="<?= $data['kinerja_id'] ?>">

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
      <div class="input"><input type="date" id="h_t" name="h_t" onkeyup="validasi()" value="<?= $data=['tanggal'] ?>" required></div> 
   </div>
   <div class="form-group">
    </br>
        <label>Keterangan Piket Membersihkan</label>
        <br>
        <span class="input">
              <input type="radio" name="piket" value="piket" <?php if($piket == "piket"){ echo "checked='true'"; } ?> required/>&radic; &nbsp; &nbsp; &nbsp; Piket
                </br>
              <input type="radio" name="piket" value="tidak_piket" <?php if($piket == "tidak_piket"){ echo "checked='true'"; } ?> />&mdash; &nbsp; &nbsp; &nbsp; Tidak Piket
        </span>
    </div>
    <div class="form-group">
    </br>
        <label>Keterangan Telponan Di Salon</label>
        <br>
        <span class="input">
              <input type="radio" name="telponan" value="ya" <?php if($telponan == "ya"){ echo "checked='true'"; } ?> required/>&radic; &nbsp; &nbsp; &nbsp; Ya
                </br>
              <input type="radio" name="telponan" value="tidak" <?php if($telponan == "tidak"){ echo "checked='true'"; } ?> />&mdash; &nbsp; &nbsp; &nbsp; Tidak
        </span>
    </div>
   <div class="form-group">
      <input type="submit" value="Edit" class="tombol simpan">
      <input type="reset" value="reset" class="tombol reset">
   </div>
   
</form>