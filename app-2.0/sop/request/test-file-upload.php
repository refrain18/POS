<?php

$status = false;
$msg = 'Error pada server tidak diketahui!';

$created_at = isset($_POST['time_stamp']) && !empty($_POST['time_stamp']) ? $_POST['time_stamp'] : false;
$id_user = isset($_POST['id_user']) && !empty($_POST['id_user']) ? $_POST['id_user'] : false;
$id_jp = isset($_POST['pilihan_jenis_perawatan']) && !empty($_POST['pilihan_jenis_perawatan']) ? $_POST['pilihan_jenis_perawatan'] : false;
$foto_pg = isset($_FILES['foto_pegawai']) && !empty($_FILES['foto_pegawai']) ? $_FILES['foto_pegawai'] : false;
$foto_struk = isset($_FILES['foto_bukti_struk']) && !empty($_FILES['foto_bukti_struk']) ? $_FILES['foto_bukti_struk'] : false;
$ket = isset($_POST['keterangan']) || !empty($_POST['keterangan']) ? $_POST['keterangan'] : '-';

if (!$created_at || !$id_user || !$id_jp || !$foto_pg || !$foto_struk) {
  $status = true;
  $msg = 'Server Exception: Request tidak valid!';
}

if (!$status) {

  //* Do query insert here

  $status = true;
  $msg = 'Request berhasil!';
}

echo json_encode(
  array(
    'status' => $status,
    'message' => $msg
  )
);