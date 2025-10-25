<?php
session_start();

// Data pengguna 
$valid_users = [
    'admin' => ['password' => '1234', 'role' => 'admin'],
    'nadine' => ['password' => '5678', 'role' => 'member']
];

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $remember = isset($_POST['remember']);

    if (isset($valid_users[$username]) && $valid_users[$username]['password'] === $password) {
        // Login berhasil
        $_SESSION['status'] = 'login';
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $valid_users[$username]['role'];

        // SET COOKIE untuk fitur "Ingat Saya"
        if ($remember) {
            $expire_time = time() + (86400 * 7); // 7 hari
            setcookie('user_remember', $username, $expire_time, "/");
            setcookie('role_remember', $valid_users[$username]['role'], $expire_time, "/");
        } else {
            // Hapus cookie jika user tidak mencentang "Ingat Saya"
            setcookie('user_remember', '', time() - 3600, "/"); //saat waktu kadaluarsa, langsung dihapus
            setcookie('role_remember', '', time() - 3600, "/");
        }

        // Redirect ke dashboard
        if ($_SESSION['role'] === 'admin') {
            header("Location: homeAdmin.php");
        } else {
            header("Location: homeMember.php");
        }
        exit();
    } else {
        // Login gagal
        header("Location: sessionLoginForm.php?error=gagal_login");
        exit();
    }
} else {
    // Jika tidak ada POST, arahkan kembali ke form login
    header("Location: sessionLoginForm.php");
    exit();
}
?>