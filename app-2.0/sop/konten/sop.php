<?php
   if(!defined('INDEX')) die("");
?>


<h1 >Selamat Datang di Standard Operating Procedure</h1>
<h3 class="judul">Anda login sebagai <?= ucfirst($level) ?> </h3>
<a class="tombol" href="?hal=sop_tambah">Tambah</a>
<table class="table">
   <thead>
      <tr>
         <th>No</th>
         <th>Nama Pegawai</th>
         <th>Jenis Perawatan</th>
         <th>Foto Pegawai</th>
         <th>Foto Bukti Customer</th>
         <th>Waktu Perawatan</th>
         <th>Hasil Rundown</th>
         <th>Keterangan</th>
         <th>Komisi</th>
         <?php if($level == 'owner') : ?>
         <th>Aksi</th>
         <?php endif; ?>
      </tr>
   </thead>
   <tbody>
<?php
   $query = mysqli_query($con, "SELECT sop.*, pegawai.nama, jenis_perawatan.nama_perawatan, sop.komisi FROM sop JOIN pegawai ON  
                                sop.pegawai_id = pegawai.pegawai_id JOIN jenis_perawatan ON sop.jp_id = jenis_perawatan.jp_id 
                                ORDER BY id_sop DESC");
   $no = 0;
   while($data = mysqli_fetch_array($query)){
      $no++;
?>
      <tr>
         <td><?= $no ?></td>
         <td><?= $data['nama'] ?></td>
         <td><?= $data['nama_perawatan'] ?></td>
         <td><?= $data['foto_pegawai'] ?></td>
         <td><?= $data['foto_customer'] ?></td>
         <td><?= $data['waktu'] ?></td>
         <td><?= $data['hasil_rundown'] ?></td>
         <td><?= $data['keterangan'] ?></td>
         <td><?= $data['komisi'] ?></td>
         <?php if($level == 'owner') : ?>
            <td>
               <a class="tombol edit" href="?hal=sop_edit&id_sop=<?= $data['id_sop'] ?>"> Edit </a>
               <a class="tombol hapus" href="?hal=sop_hapus&id_sop=<?= $data['id_sop'] ?>" onclick="return confirm('Anda yakin akan meghapus data ini?');"> Hapus </a>
            </td>
         <?php endif; ?>
     </tr>
<?php
   }
?>
   </tbody>
</table>