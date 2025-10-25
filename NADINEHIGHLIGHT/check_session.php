<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] != 'login') {
    // Hapus cookie 'Ingat Saya' jika ada
    setcookie('user_remember', '', time() - 3600, "/", "", false, true);
    setcookie('role_remember', '', time() - 3600, "/", "", false, true);
    
    header("Location: sessionLoginForm.php");
    exit();
}
?>