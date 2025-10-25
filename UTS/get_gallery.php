<?php
// get_gallery.php
session_start();

// Cek login
if (!isset($_SESSION['status']) || $_SESSION['status'] !== 'login') {
    echo json_encode([]);
    exit;
}

$upload_dir = 'uploads/';
$images = [];

if (is_dir($upload_dir)) {
    $files = scandir($upload_dir);
    foreach ($files as $file) {
        if ($file != '.' && $file != '..' && preg_match('/\.(jpg|jpeg|png|gif)$/i', $file)) {
            $images[] = $file;
        }
    }
}

// Sort by newest first
rsort($images);

header('Content-Type: application/json');
echo json_encode($images);
?>