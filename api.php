<?php
require_once "koneksi.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pastikan untuk melakukan sanitasi data yang diterima sebelum digunakan
    $tgl = date('Y-m-d');
    $nama = $_POST['nama'] ?? '';
    $alamat = $_POST['alamat'] ?? '';
    $tujuan = $_POST['tujuan'] ?? '';
    $nope = $_POST['nope'] ?? '';
    $asal = $_POST["asal"] ?? '';
    $kategori = $_POST["category"] ?? '';
    $file = $_FILES['image']['tmp_name'];
    $uploadPath = "image/";
    $imageName = uniqid() . '.png'; // Nama unik untuk gambar
    $targetPath = $uploadPath . $imageName;
    if (move_uploaded_file($file, $targetPath)) {
        $simpan = mysqli_query($koneksi, "INSERT INTO ttamu VALUES('','$tgl','$nama','$kategori','$alamat', '$tujuan', '$nope','$targetPath','$asal')");
        if ($simpan) {
            $response = array(
                'status' => 'success',
                'message' => 'Data telah diterima dan diproses.',
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat mengunggah gambar.'
            );
        }
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Terjadi kesalahan saat mengunggah gambar.'
        );
    }
    // Mengembalikan respon dalam format JSON
    header('Content-Type: application/json');
    echo json_encode($response);
    exit(); // Hentikan eksekusi skrip
}


if ($_SERVER["REQUEST_METHOD"] == "GET") {
    header('Content-Type: application/json');
    $data = [];
    for ($i = 0; $i < 12; $i++) {
        $query = mysqli_query($koneksi, "SELECT * FROM ttamu WHERE MONTH(tanggal) = " . ($i + 1) . " AND YEAR(tanggal) = " . date('Y'));
        $result = mysqli_num_rows($query);
        $data[] = $result;
    }
    $response = array(
        'status' => 'success',
        'labels' => ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'], // Array to store month names
        'data' => $data
    );
    echo json_encode($response);
    exit();
}
