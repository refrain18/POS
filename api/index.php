<?php
include "../library/config.php";

// Headers
header('Access-Control-Allow-Origin: *'); //Set Akses Api ke Public
header('Content-Type: application/json'); //Set Format Data

// Query untuk narik data tabel payment
$query = mysqli_query($con, "SELECT * FROM payment ORDER BY payment_id");

// tarik semua data hasil query
$data = mysqli_fetch_all($query);

// menampilkan data dalam format JSON
echo json_encode($data);