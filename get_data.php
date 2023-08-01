<?php
date_default_timezone_set('Asia/Jakarta'); // Zona Waktu Indonesia
// Membuat koneksi ke database
include('config/koneksi.php');

// Mengambil kode dari AJAX request
$kode = $_POST['kode'];

// Mengambil data dari database berdasarkan kode
$sql = "SELECT * FROM tb_daftar_parkir WHERE kode = '$kode'";
$result = $con->query($sql);

$response = array();

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $response['plat'] = $row['plat_nomor'];
  $response['jam_masuk'] = $row['jam_masuk'];

  // Menghitung total parkir berdasarkan jam masuk dan jam keluar
  $jamMasuk = strtotime($row['jam_masuk']);
  $jamKeluar = strtotime(date('Y-m-d H:i'));
  $selisihJam = ($jamKeluar - $jamMasuk) / 3600; // Selisih jam dalam satuan jam
  $tarifPerJam = 3000; // Tarif parkir per jam
  $total = $tarifPerJam * $selisihJam;
  $response['total'] = $total;
  
} else {
  $response['error'] = "Data tidak ditemukan";
}

// Mengirimkan response dalam format JSON
header('Content-Type: application/json');
echo json_encode($response);

$con->close();
?>
