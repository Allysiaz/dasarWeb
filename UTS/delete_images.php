<?php
// delete_images.php
session_start();

// Cek login dan role admin
if (!isset($_SESSION['status']) || $_SESSION['status'] !== 'login' || $_SESSION['role'] !== 'admin') {
    echo "Error: Akses ditolak.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['images'])) {
    $images = $_POST['images'];
    $upload_dir = 'uploads/';
    $deleted_count = 0;
    
    foreach ($images as $image) {
        $file_path = $upload_dir . basename($image);
        if (file_exists($file_path)) {
            if (unlink($file_path)) {
                $deleted_count++;
            }
        }
    }
    
    echo "Berhasil menghapus " . $deleted_count . " foto.";
} else {
    echo "Error: Tidak ada foto yang dipilih.";
}
?>