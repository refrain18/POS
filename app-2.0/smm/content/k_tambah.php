<?php
   if(!defined('INDEX')) die("");
?>

<h2 class="judul">Tambah Kinerja Pegawai</h2>
<form method="post" action="?hal=k_insert" enctype="multipart/form-data">

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
        <label>Keterangan Piket Membersihkan</label>
        <br>
        <span class="input">
              <input type="radio" name="piket" value="piket"  required/>&radic; &nbsp; &nbsp; &nbsp; Piket
                </br>
              <input type="radio" name="piket" value="tidak_piket"  />&mdash; &nbsp; &nbsp; &nbsp; Tidak Piket
        </span>
    </div>
    <div class="form-group">
    </br>
        <label>Keterangan Telponan Di Salon</label>
        <br>
        <span class="input">
              <input type="radio" name="telponan" value="ya"  required/>&radic; &nbsp; &nbsp; &nbsp; Ya
                </br>
              <input type="radio" name="telponan" value="tidak"  />&mdash; &nbsp; &nbsp; &nbsp; Tidak
        </span>
    </div>
   <div class="form-group">
      <input type="submit" value="Tambah" class="tombol simpan">
      <input type="reset" value="reset" class="tombol reset">
   </div>
   
</form>