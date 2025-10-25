<?php
// upload_process.php - VERSI DIPERBAIKI

// Aktifkan error reporting untuk debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// 1. Cek Status Login
if (!isset($_SESSION['status']) || $_SESSION['status'] !== 'login') {
    echo "Error: Akses ditolak. Silakan login terlebih dahulu.";
    exit;
}

// 2. Cek Peran (Pembatasan Admin)
if ($_SESSION['role'] !== 'admin') {
    echo "Error: Fitur upload hanya tersedia untuk Administrator.";
    exit;
}

// 3. Cek apakah request method POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "Error: Metode permintaan tidak valid.";
    exit;
}

// 4. Cek apakah file ada
if (!isset($_FILES['imageFile'])) {
    echo "Error: Tidak ada file yang dikirim. Key 'imageFile' tidak ditemukan.";
    exit;
}

$file = $_FILES['imageFile'];

// 5. Cek apakah ada error saat upload
if ($file['error'] !== UPLOAD_ERR_OK) {
    $error_messages = [
        UPLOAD_ERR_INI_SIZE => 'File terlalu besar (melebihi upload_max_filesize di php.ini)',
        UPLOAD_ERR_FORM_SIZE => 'File terlalu besar (melebihi MAX_FILE_SIZE di form)',
        UPLOAD_ERR_PARTIAL => 'File hanya terupload sebagian',
        UPLOAD_ERR_NO_FILE => 'Tidak ada file yang diupload',
        UPLOAD_ERR_NO_TMP_DIR => 'Folder temporary tidak ditemukan',
        UPLOAD_ERR_CANT_WRITE => 'Gagal menulis file ke disk',
        UPLOAD_ERR_EXTENSION => 'Upload dihentikan oleh ekstensi PHP'
    ];
    
    $error_msg = isset($error_messages[$file['error']]) 
        ? $error_messages[$file['error']] 
        : 'Error tidak diketahui (code: ' . $file['error'] . ')';
    
    echo "Error: " . $error_msg;
    exit;
}

// 6. Setup direktori upload
$target_dir = "uploads/";

// Buat folder uploads jika belum ada
if (!is_dir($target_dir)) {
    if (!mkdir($target_dir, 0777, true)) {
        echo "Error: Gagal membuat folder uploads. Periksa permission folder.";
        exit;
    }
}

// Cek apakah folder bisa ditulis
if (!is_writable($target_dir)) {
    echo "Error: Folder uploads tidak memiliki permission write. Jalankan: chmod 777 uploads/";
    exit;
}

// 7. Validasi ekstensi file
$allowed_ext = array('jpg', 'jpeg', 'png', 'gif');
$file_ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

if (!in_array($file_ext, $allowed_ext)) {
    echo "Error: Ekstensi file yang diizinkan adalah JPG, JPEG, PNG, atau GIF. File Anda: ." . $file_ext;
    exit;
}

// 8. Validasi ukuran file (2MB)
$max_size = 2 * 1024 * 1024; // 2MB
if ($file['size'] > $max_size) {
    $size_mb = round($file['size'] / 1024 / 1024, 2);
    echo "Error: Ukuran file tidak boleh melebihi 2 MB. Ukuran file Anda: " . $size_mb . " MB";
    exit;
}

// 9. Validasi MIME type (keamanan tambahan)
$allowed_mime = array('image/jpeg', 'image/jpg', 'image/png', 'image/gif');
$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mime_type = finfo_file($finfo, $file['tmp_name']);
finfo_close($finfo);

if (!in_array($mime_type, $allowed_mime)) {
    echo "Error: Tipe file tidak valid. Hanya gambar yang diperbolehkan. Tipe file Anda: " . $mime_type;
    exit;
}

// 10. Generate nama file unik
$new_file_name = $_SESSION['username'] . '_' . time() . '.' . $file_ext;
$target_file = $target_dir . $new_file_name;

// 11. Pindahkan file
if (move_uploaded_file($file['tmp_name'], $target_file)) {
    // SUCCESS - Format output sesuai dengan yang diharapkan costum.js
    echo "Success: File berhasil diunggah dengan nama: " . $new_file_name . ". <br>";
    echo '<img src="' . $target_file . '" class="img-fluid img-thumbnail mt-2" style="max-width: 200px;" alt="Uploaded Image">';
} else {
    echo "Error: Gagal memindahkan file ke direktori tujuan. Periksa permission folder uploads/";
    exit;
}
?>