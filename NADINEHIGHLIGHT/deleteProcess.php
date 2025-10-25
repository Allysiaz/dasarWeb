<?php
require 'check_session.php'; 

// **HANYA ADMIN YANG BOLEH MENGHAPUS**
if ($_SESSION['role'] !== 'admin') {
    $message = "Akses penghapusan ditolak! Hanya Admin yang diizinkan.";
    header("Location: galeri.php?delete_status=fail&message=" . urlencode($message));
    exit();
}

if (isset($_GET['filename'])) {
    $filename = basename($_GET['filename']); // Ambil nama file dan hindari path traversal
    $targetFile = 'uploads/' . $filename;

    // Pastikan file berada di folder uploads dan ekstensi file valid
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    if (file_exists($targetFile) && in_array($fileType, $allowedExtensions)) {
        // Cek apakah itu benar-benar file, bukan direktori, sebelum unlink
        if (is_file($targetFile)) { 
            if (unlink($targetFile)) { // Hapus file menggunakan unlink()
                $message = "File '" . htmlspecialchars($filename) . "' berhasil dihapus.";
                header("Location: galeri.php?delete_status=success&message=" . urlencode($message));
                exit();
            } else {
                $message = "Gagal menghapus file '" . htmlspecialchars($filename) . "'. Cek izin file.";
                header("Location: galeri.php?delete_status=fail&message=" . urlencode($message));
                exit();
            }
        } else {
            $message = "Gagal: Bukan file yang valid.";
            header("Location: galeri.php?delete_status=fail&message=" . urlencode($message));
            exit();
        }
    } else {
        $message = "File tidak ditemukan atau tidak diizinkan untuk dihapus.";
        header("Location: galeri.php?delete_status=fail&message=" . urlencode($message));
        exit();
    }
} else {
    // Jika tidak ada parameter filename
    header("Location: galeri.php?delete_status=fail&message=" . urlencode("Nama file tidak ditentukan."));
    exit();
}
?>