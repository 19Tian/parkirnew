<?php
// Koneksi ke database
include "config/koneksi.php";

// Ambil kode dari POST data
$kode = $_POST['kode'];

// Query untuk mengambil data dari database berdasarkan kode
$query = "SELECT * FROM tb_daftar_parkir WHERE kode_keluar = '$kode'";
$result = mysqli_query($con, $query);

// Cek apakah query berhasil
if ($result) {
  // Cek jumlah baris data yang ditemukan
  if (mysqli_num_rows($result) > 0) {
    // Ambil data sebagai array asosiatif
    $data = mysqli_fetch_assoc($result);

    // Buat array response dengan data yang diambil dari database
    $response = array(
      'plat' => $data['plat_nomor'],
      'total' => $data['hitung_jam_masuk']
    );

    // Mengembalikan response dalam format JSON
    echo json_encode($response);
  } else {
    // Tidak ada data yang ditemukan
    $response = array('error' => 'Data tidak ditemukan');
    echo json_encode($response);
  }
} else {
  // Terjadi kesalahan saat menjalankan query
  $response = array('error' => 'Terjadi kesalahan saat mengambil data dari database');
  echo json_encode($response);
}

// Tutup koneksi ke database
mysqli_close($con);
?>
