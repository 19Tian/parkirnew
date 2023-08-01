<?php
date_default_timezone_set('Asia/Jakarta'); // Zona Waktu Indonesia
// Membuat koneksi ke database
include('config/koneksi.php');

// Mengambil kode dan jam_keluar dari AJAX request
$kode = $_POST['kode'];
$jamKeluar = $_POST['jam_keluar'];

// Perbarui data jam_keluar di database
$sql = "UPDATE tb_daftar_parkir SET jam_keluar = '$jamKeluar' WHERE kode = '$kode'";
if ($con->query($sql) === TRUE) {
  $response['success'] = true;
} else {
  $response['success'] = false;
}

// Mengirimkan response dalam format JSON
header('Content-Type: application/json');
echo json_encode($response);

$con->close();
?>
