<?php
    // if(!defined('INDEX')) die("");

    include "../lib/config.php";
    session_start();

    if (isset($_SESSION['sopArr'])) {
        $sopArr = $_SESSION['sopArr'];
    } else {
        echo "<meta http-equiv='refresh' content='1; url=?hal=sop'>";
    }

    // var_dump($sopArr);
    unset($_SESSION['sopArr']);
    // die("Selesai");

    // Menerima Request Data
    $hasilDurasiSop = isset($_POST['hasilDurasiSop']) ? $_POST['hasilDurasiSop'] : false;
    $keterangan = isset($_POST['ket']) ? $_POST['ket'] : false;

    // Default Response
    $status = false;
    $message = "Kesalahan Tidak Diketahui";

    // Error Handling 1 - Cek Request
    if (!$hasilDurasiSop && !$keterangan) {
        // Response
        $status = true;
        $message = "Request Tidak Valid";
    } 
    
    if(!$status) {
        // Menghapus Spasi
        $hasilDurasiSop = str_replace(' ', '', $hasilDurasiSop);
        // Konversi string ke format waktu
        $hasilDurasiSop = date("H:i:s", strtotime($hasilDurasiSop));

        $query = "SELECT waktu FROM jenis_perawatan WHERE jp_id = '$sopArr[id_jenis_perawatan]'";
        $execQuery = mysqli_query($con, $query);
        $queryResult = mysqli_fetch_assoc($execQuery);

        $targetDurasi = date("H:i:s", strtotime($queryResult['waktu']));

        if ($hasilDurasiSop < $targetDurasi) {
            $hasil_run_down = "Tidak terpenuhi";
        } elseif ($hasilDurasiSop >= $targetDurasi) {
            $hasil_run_down = "Terpenuhi";
        }

        $query = mysqli_query($con, "INSERT INTO sop SET 
            pegawai_id = '$sopArr[id_pegawai]',
            jp_id = '$sopArr[id_jenis_perawatan]',
            tanggal = '$sopArr[tanggal]',
            foto_pegawai = '$sopArr[foto_pegawai]',
            foto_customer = '$sopArr[foto_customer]',
            waktu = '$hasilDurasiSop',
            hasil_rundown = '$hasil_run_down',
            keterangan = '$keterangan'
        ");

        $status = true;
        if($execQuery){
            $message = "Data SOP telah disimpan!";
        }else{
            $message = "Query Gagal! ".mysqli_error($con);
        }
    }

    // Mengirim Response
    echo json_encode(
        array(
            "status" => $status,
            "message" => $message
        )
    );

    // $query = mysqli_query($con, "INSERT INTO sop SET 
    //     waktu = '$current_timestamp',
    //     pegawai_id = '$pegawai_id',
    //     jp_id = '$jp_id',
    //     foto_pegawai = '$f_pegawai',
    //     foto_customer = '$f_customer'
    // ");

    // if($query){
    //     echo "Data berhasil disimpan!";
    //     echo "<meta http-equiv='refresh' content='1; url=?hal=sop_rundown'>";
    // }else{
    //     echo "Tidak dapat menyimpan data!<br>";
    //     echo mysqli_error($con);
    // }

//    if(!empty($_FILES["fp"]["name"])){
//       $f_pegawai = $_FILES["fp"]["name"];
//       $tipefile = $_FILES["fp"]["type"];
//       $ukuranfile = $_FILES["fp"]["size"];
//       if($tipefile != "image/jpeg" and $tipefile != "image/jpg" and $tipefile != "image/png"){
//           header("location: ?hal=sop_tambah&id_sop=$id_sop&notif=tipefile");
//           die();
//       }elseif ($ukuranfile >= 3000000) {
//           header("location: ?hal=sop_tambah&id_sop=$id_sop&notif=ukuranfile");
//           die();
//       }else{
//           move_uploaded_file($_FILES["fp"]["tmp_name"], "gambar/foto_pegawai/".$f_pegawai);
//       }
//    }

//    if(!empty($_FILES["fc"]["name"])){
//     $f_customer = $_FILES["fc"]["name"];
//     $tipefile = $_FILES["fc"]["type"];
//     $ukuranfile = $_FILES["fc"]["size"];
//     if($tipefile != "image/jpeg" and $tipefile != "image/jpg" and $tipefile != "image/png"){
//         header("location: ?hal=sop_tambah&id_sop=$id_sop&notif=tipefilec");
//         die();
//     }elseif ($ukuranfile >= 3000000) {
//         header("location: ?hal=sop_tambah&id_sop=$id_sop&notif=ukuranfilec");
//         die();
//     }else{
//         move_uploaded_file($_FILES["fc"]["tmp_name"], "gambar/foto_customer/".$f_customer);
//     }
//  }

// $query = mysqli_query($con, "INSERT INTO sop SET 
// waktu = '$current_timestamp',
// pegawai_id = '$pegawai_id',
// jp_id = '$jp_id',
// foto_pegawai = '$f_pegawai',
// foto_customer = '$f_customer'
// ");

// if($query){
// echo "Data berhasil disimpan!";
// echo "<meta http-equiv='refresh' content='1; url=?hal=sop_rundown'>";
// }else{
// echo "Tidak dapat menyimpan data!<br>";
// echo mysqli_error($con);
// }
?>