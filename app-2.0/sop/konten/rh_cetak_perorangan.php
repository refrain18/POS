<?php
// include autoloader
require_once '../lib/dompdf/autoload.inc.php';

include_once("../lib/config.php");
// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();

// Get Filter
$filter = isset($_GET["q"]) && !empty($_GET["q"]) ? explode(',', $_GET['q']) : false;

if (!$filter || ( !isset($filter[0]) || !isset($filter[1]) ) ) {
  echo "<meta http-equiv='refresh' content='1; url=../index.php?hal=rekap_harian'>";
  die();
}

// Cek validitas value GET query
if (is_numeric($filter[0]) && date_parse($filter[1])['error_count'] == 0) {
  $id = $filter[0];
  $tgl = $filter[1];
} else {
  echo "<meta http-equiv='refresh' content='1; url=../index.php?hal=rekap_harian'>";
  die();
}

// Style Laporan
$style = '
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">';

// Header laporan default
$isiLaporan = '<center><h2>Laporan SOP Harian Salon Mumtaza</h2></center><br><hr><br>';

$query = "SELECT 
  pegawai.nama, 
  (SELECT COUNT(sop_b.hasil_rundown) FROM sop sop_b WHERE sop_b.tanggal = sop_a.tanggal AND sop_b.pegawai_id = sop_a.pegawai_id AND sop_b.hasil_rundown = 'Terpenuhi') as completed, 
  (SELECT COUNT(sop_c.hasil_rundown) FROM sop sop_c WHERE sop_c.tanggal = sop_a.tanggal AND sop_c.pegawai_id = sop_a.pegawai_id AND sop_c.hasil_rundown != 'Terpenuhi') as incompleted 
  FROM sop sop_a JOIN pegawai ON sop_a.pegawai_id = pegawai.pegawai_id WHERE sop_a.pegawai_id = '$id' AND sop_a.tanggal = '$tgl' GROUP BY sop_a.tanggal;
";

$execQuery = mysqli_query($con, $query) OR die("Terjadi Kesalahan pada Query: ".mysqli_error($con));
if (mysqli_num_rows($execQuery) <= 0) {
  echo "<meta http-equiv='refresh' content='1; url=?hal=rekap_harian'>";
  die();
}
$resQuery = mysqli_fetch_assoc($execQuery);

$isiLaporan .= "
  <p>
    <b>Nama :</b> $resQuery[nama]
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <b>Hari/Tanggal :</b> ".date_format(date_create($tgl), 'd-m-Y')."
  </p>
  <p>
    <b>Rundown Complete :</b> $resQuery[completed]
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <b>Rundown Incomplete :</b> $resQuery[incompleted]
  </p>
";

$query = "SELECT 
  sop.id_sop, jp.nama_perawatan, sop.foto_pegawai as img_pgw, sop.foto_struk as img_struk, sop.hasil_rundown, sop.keterangan, pegawai.nama
  FROM sop JOIN pegawai ON pegawai.pegawai_id = sop.pegawai_id JOIN jenis_perawatan jp ON jp.jp_id = sop.jp_id 
  WHERE sop.pegawai_id = '$id' AND sop.tanggal = '$tgl';
";

$execQuery = mysqli_query($con, $query);
$no = 0;
$tbody = '';
while($data = mysqli_fetch_array($execQuery)){
  $no++;
  $tbody .= "
    <tr>
      <td>$no</td>
      <td>$data[nama_perawatan]</td>
      <td>$data[img_pgw]</td>
      <td>$data[img_struk]</td>
      <td>$data[hasil_rundown]</td>
      <td>$data[keterangan]</td>
    </tr>
  ";
}

$isiLaporan .= "
  <table class='table table-sm'>
    <thead>
      <tr>
        <th scope='col'>No</th>
        <th scope='col'>Jenis Perawatan</th>
        <th scope='col'>Foto Pegawai</th>
        <th scope='col'>Foto Struk</th>
        <th scope='col'>Rundown</th>
        <th scope='col'>Keterangan</th>
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
$dompdf->stream('laporan_sop_harian_peroragan.pdf', ['Attachment' => 0]);