<?php
  if(!defined('INDEX')) die("");

  $id = isset($_POST['id_sop']) && !empty($_POST['id_sop']) ? $_POST['id_sop'] : false;

  if (!$id) {
    echo "<meta http-equiv='refresh' content='1; url=?hal=rekap_harian'>";
  }

  $id_pegawai = $_POST['pegawai_id'];
  $id_jenis_pelayanan = $_POST['jp_id'];
  $tgl = date('Y-m-d', strtotime($_POST['tgl_sop']));
  $nama_img_pegawai = $_FILES["fp"]["name"];
  $nama_img_struk = $_FILES["fs"]["name"];

  // Error handling - Upload File
  try {
    if (!is_writable('gambar/foto_pegawai') && !is_writable('gambar/foto_struk')) {
      throw new Exception('"Folder Penyimpanan Gambar memiliki akses terbatas" Error');
    } else {
      move_uploaded_file($_FILES["fp"]["tmp_name"], "gambar/foto_pegawai/".$nama_img_pegawai);
      move_uploaded_file($_FILES["fs"]["tmp_name"], "gambar/foto_struk/".$nama_img_struk);
    }
  } catch (Exception $e) {
    die("<h3>Gagal Upload File...</h3><br> <font color='red'><i>$e</i></red>");
  }

  $query = "UPDATE sop SET 
    pegawai_id = '$id_pegawai', 
    jp_id = '$id_jenis_pelayanan', 
    tanggal = '$tgl', 
    foto_pegawai = '$nama_img_pegawai', 
    foto_struk = '$nama_img_struk' 
    WHERE id_sop = '$id'
  ";
  $execQuery = mysqli_query($con, $query);

  if($execQuery){
    echo "Data berhasil diperbaharui!";
    echo "<meta http-equiv='refresh' content='1; url=?hal=rekap_harian'>";
  }else{
    echo "Tidak dapat memperbaharui data!<br>";
    echo "Query Message: ".mysqli_error($con);
  }