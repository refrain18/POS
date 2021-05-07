<?php
   if(!defined('INDEX')) die("");

   $user = $user_id;
   $now = date("Y-m-d H:i:s");
   $harga = (int) $_POST["harga"];
   $diskon = (int) $_POST["diskon"];
   $jumlah = (int) $_POST["jumlah"];
   $subtotal = ($harga -($harga * $diskon/100)) * $jumlah;
   


   if(!empty($_FILES["file"]["name"])){
      $nama_file = $_FILES["file"]["name"];
      $tipefile = $_FILES["file"]["type"];
      $ukuranfile = $_FILES["file"]["size"];
      if($tipefile != "image/jpeg" and $tipefile != "image/jpg" and $tipefile != "image/png"){
          header("location: ?mod=laporan_manajemen_bulanan&hal=lmb_tambah&payment_id=$payment_id&notif=tipefile");
          die();
      }elseif ($ukuranfile >= 3000000) {
          header("location: ?mod=laporan_manajemen_bulanan&hal=lmb_tambah&payment_id=$payment_id&notif=ukuranfile");
          die();
      }else{
          move_uploaded_file($_FILES["file"]["tmp_name"], "images/bukti_pembayaran/".$nama_file);
      }
   }
   $query = mysqli_query($con, "INSERT INTO payment SET
      user_id = '$user',
      waktu = '$now',
      nama_produk = '$_POST[namaproduk]',
      harga = '$harga',
      diskon = '$diskon',
      qty = '$jumlah',
      jenis_transaksi = '$_POST[jenistransaksi]',
      gambar = '$nama_file',
      sub_total = '$subtotal'
   ");

   if($query){
      echo "Data berhasil disimpan!";
      echo "<meta http-equiv='refresh' content='1; url=?mod=transaksi&hal=pos'>";
   }else{
      echo "Tidak dapat menyimpan data!<br>";
      echo mysqli_error($con);
   }
?>