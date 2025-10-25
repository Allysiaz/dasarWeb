<?php
session_start();

// Hapus semua variabel session
session_unset();

// Hapus session
session_destroy();

// Hapus cookie 'Ingat Saya' (Remember Me)
setcookie('user_remember', '', time() - 3600, "/");
setcookie('role_remember', '', time() - 3600, "/");

// Arahkan kembali ke halaman login
header("Location: sessionLoginForm.php?message=Anda berhasil logout");
exit();
?>