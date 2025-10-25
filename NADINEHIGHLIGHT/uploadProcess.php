<?php
require 'check_session.php'; 

// **HANYA ADMIN YANG BOLEH UPLOAD**
if ($_SESSION['role'] !== 'admin') {
    $message = "Akses upload ditolak! Hanya Admin yang diizinkan.";
    header("Location: homeMember.php?upload_status=fail&message=" . urlencode($message));
    exit();
}

if (isset($_POST["submit_upload"])) {
    if (!isset($_FILES["fileToUpload"])) {
        header("Location: homeAdmin.php?upload_status=fail&message=" . urlencode("Tidak ada file yang diupload."));
        exit();
    }

    $targetDirectory = "uploads/"; 
    if (!is_dir($targetDirectory)) { 
        mkdir($targetDirectory, 0777, true);
    }
    
    $file = $_FILES["fileToUpload"];
    $targetFile = $targetDirectory . basename($file["name"]);
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // validasi ekstensi dan ukuran file
    $allowedExtensions = array("jpg", "jpeg", "png", "gif");
    $maxsize = 5 * 1024 * 1024; // Maksimum 5 MB

    if (in_array($fileType, $allowedExtensions) && $file["size"] <= $maxsize) {
        $newFileName = uniqid('highlight_', true) . '.' . $fileType;
        $finalTargetFile = $targetDirectory . $newFileName;

        if (move_uploaded_file($file["tmp_name"], $finalTargetFile)) {
            $message = "File '" . htmlspecialchars(basename($file["name"])) . "' berhasil diunggah.";
            header("Location: homeAdmin.php?upload_status=success&message=" . urlencode($message));
        } else {
            $message = "Gagal mengunggah file. Cek izin folder 'uploads/'.";
            header("Location: homeAdmin.php?upload_status=fail&message=" . urlencode($message));
        }
    } else {
        $message = "File tidak valid (hanya JPG, JPEG, PNG, GIF) atau melebihi ukuran maksimum 5MB yang diizinkan.";
        header("Location: homeAdmin.php?upload_status=fail&message=" . urlencode($message));
    }
} else {
    header("Location: homeAdmin.php");
}
exit();
?>