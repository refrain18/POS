<?php
// include autoloader
require_once '../lib/dompdf/autoload.inc.php';

include_once("../lib/config.php");
// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();

// Get Filter
$tgl = isset($_GET["q"]) && !empty($_GET["q"]) ? $_GET["q"] : false;

// Cek validitas value GET query
if ( !$tgl || (date_parse($tgl)['error_count'] != 0) || (count(explode('-', $tgl)) != 3) ) {
  echo "<meta http-equiv='refresh' content='1; url=../index.php?hal=rekap_harian'>";
  die();
}

// Style Laporan
$style = '
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">';
  // <link rel="stylesheet" href="../css/style.css">';

// Header laporan default
$isiLaporan = '<center><h2>Laporan SOP Harian Salon Mumtaza</h2></center><br><hr><br>';

$query = "SELECT 
  a.tanggal, COUNT(id_sop) as total_sop, 
  COUNT(id_sop) as total_cus, 
  (SELECT COUNT(hasil_rundown) FROM sop b WHERE b.tanggal = a.tanggal AND b.hasil_rundown = 'Terpenuhi') as total_completed, 
  (SELECT COUNT(hasil_rundown) FROM sop c WHERE c.tanggal = a.tanggal AND c.hasil_rundown != 'Terpenuhi') as total_incompleted 
  FROM sop a WHERE a.tanggal = '$tgl' GROUP BY a.tanggal;
";

$execQuery = mysqli_query($con, $query) OR die("Terjadi Kesalahan pada Query: ".mysqli_error($con));
$resQuery = mysqli_fetch_assoc($execQuery);

$isiLaporan .= "
  <p>
    <b>Hari/Tanggal :</b> ".date_format(date_create($resQuery['tanggal']), 'd-m-Y')."
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <b>Total SOP Harian :</b> $resQuery[total_sop]
  </p>
  <p>
    <b>Rundown Complete :</b> $resQuery[total_completed]
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <b>Rundown Incomplete :</b> $resQuery[total_incompleted]
  </p>
";

$query = "SELECT 
  pegawai.pegawai_id, 
  pegawai.nama, 
  (SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(waktu))) FROM sop sop_b WHERE sop_b.tanggal = sop_a.tanggal AND sop_b.pegawai_id = sop_a.pegawai_id) as total_waktu, 
  (SELECT COUNT(hasil_rundown) FROM sop sop_c WHERE sop_c.tanggal = sop_a.tanggal AND sop_c.pegawai_id = sop_a.pegawai_id AND sop_c.hasil_rundown = 'Terpenuhi') as total_completed, 
  (SELECT COUNT(hasil_rundown) FROM sop sop_d WHERE sop_d.tanggal = sop_a.tanggal AND sop_d.pegawai_id = sop_a.pegawai_id AND sop_d.hasil_rundown != 'Terpenuhi') as total_incompleted, 
  (SELECT SUM(komisi) FROM sop sop_e WHERE sop_e.tanggal = sop_a.tanggal) as total_komisi 
  FROM sop sop_a JOIN pegawai ON sop_a.pegawai_id = pegawai.pegawai_id 
  WHERE sop_a.tanggal = '$tgl' GROUP BY pegawai_id;
";
$execQuery = mysqli_query($con, $query);
$no = 0;
$tbody = '';
while($data = mysqli_fetch_array($execQuery)){
  $no++;
  $tbody .= "
    <tr>
      <td>$no</td>
      <td>$data[nama]</td>
      <td>$data[total_waktu]</td>
      <td>$data[total_completed]</td>
      <td>$data[total_incompleted]</td>
      <td>Rp. ".number_format($data['total_komisi'], 0, ".", ".")."</td>
    </tr>
  ";
}

$isiLaporan .= "
  <table class='table table-sm'>
    <thead>
      <tr>
        <th scope='col'>No</th>
        <th scope='col'>Nama</th>
        <th scope='col'>Total Waktu</th>
        <th scope='col'>Total Completed</th>
        <th scope='col'>Total Incompleted</th>
        <th scope='col'>Total Komisi</th>
      </tr>
    </thead>
    <tbody>
      $tbody
    </tbody>
  </table>"
;

$dompdf->loadHtml('
  <html>
    <head>
      <title>Cetak Laporan</title>
      '.$style.'
      <style>
        #tabel-laporan {
          font-size: 10pt;
          margin: 20px 0px;
        }
      </style>
    </head>
    <body>
      '.$isiLaporan.'
    </body>
  </html>'
);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');
// Render the HTML as PDF
$dompdf->render();
// Output the generated PDF to Browser
$dompdf->stream('laporan_sop_harian_pertanggal.pdf', ['Attachment' => 0]);