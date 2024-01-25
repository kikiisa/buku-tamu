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
    if(move_uploaded_file($file, $targetPath)) {
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
    }else{
        $response = array(
            'status' => 'error',
            'message' => 'Terjadi kesalahan saat mengunggah gambar.'
        );
    }
    // Mengembalikan respon dalam format JSON
    header('Content-Type: application/json');
    echo json_encode($response);
    exit(); // Hentikan eksekusi skrip
} else {
    // Jika bukan permintaan POST, Anda bisa mengirim respons kesalahan
    $response = array(
        'status' => 'error',
        'message' => 'Metode permintaan yang diperlukan adalah POST.'
    );
    // Mengembalikan respon dalam format JSON
    header('Content-Type: application/json');
    echo json_encode($response);
    exit(); // Hentikan eksekusi skrip
}
?>
