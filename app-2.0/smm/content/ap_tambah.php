<?php
   if(!defined('INDEX')) die("");
?>

<h2 class="judul">Tambah Absen Pegawai</h2>
<form name="myForm" onsubmit="return validateForm()" method="post" action="?hal=ap_insert" enctype="multipart/form-data">

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
      <div class="input"><input type="date" id="h_t" name="h_t" onkeyup="validasi()" required></div> 
   </div>

   <div class="form-group">
    </br>
        <label>Keterangan</label>
        <br>
        <span class="input">
              <input type="radio" name="keterangan" value="masuk"  required/>&radic; &nbsp; &nbsp; &nbsp; Masuk
                </br>
              <input type="radio" name="keterangan" value="izin"  />&#73; &nbsp; &nbsp; &nbsp; Izin
              </br>
              <input type="radio" name="keterangan" value="sakit"  />&#83; &nbsp; &nbsp; &nbsp; Sakit
              </br>
              <input type="radio" name="keterangan" value="absen"  />&mdash; &nbsp; &nbsp; &nbsp; Absen
        </span>
    </div>

   <div class="form-group">
      <input type="submit" value="Tambah" class="tombol simpan">
      <input type="reset" value="reset" class="tombol reset">
   </div>
</form>