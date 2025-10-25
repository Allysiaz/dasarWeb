<?php
session_start(); 
$users = [
    'admin' => ['password' => '1234', 'role' => 'admin'],
    'member' => ['password' => '5678', 'role' => 'member']
];

if (isset($_POST['submit'])) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $rememberMe = isset($_POST['rememberMe']);
    
    // Verifikasi kredensial
    if (isset($users[$username]) && $users[$username]['password'] === $password) {
        $role = $users[$username]['role'];
        
        // Set Session (Penyimpanan status login di server) [cite: 307]
        $_SESSION['status'] = 'login';
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $role;
        
        // Set Cookie "Remember Me" (Spesifikasi UTS No. 4) [cite: 272]
        if ($rememberMe) {
            $cookie_value = json_encode(['username' => $username, 'role' => $role]);
            $expire_time = time() + (86400 * 30); // Cookie berlaku 30 hari
            setcookie('remember_me', $cookie_value, $expire_time, "/"); 
        } else {
            // Hapus cookie jika user tidak mencentang
            setcookie('remember_me', "", time() - 3600, "/"); 
        }
        
        // Redirect ke dashboard yang sesuai (Spesifikasi UTS No. 6)
        header("Location: " . $role . "_dashboard.php");
        exit;
    } else {
        // Login gagal
        $_SESSION['login_error'] = "Username atau password salah.";
        header("Location: index.php");
        exit;
    }
} else {
    header("Location: index.php");
    exit;
}
?>