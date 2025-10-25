<?php
session_start(); // Memulai session

// Menghapus semua variabel session [cite: 333]
session_unset();

// Menghancurkan session (Spesifikasi UTS No. 7) [cite: 333]
session_destroy();

// Menghapus cookie "remember_me" dengan mengatur waktu kedaluwarsa ke masa lalu [cite: 296]
setcookie('remember_me', "", time() - 3600, "/");

// Redirect ke halaman login
header("Location: index.php");
exit;
?>