<?php
session_start();
// Pengecekan cookie ingat saya
if (isset($_COOKIE['user_remember']) && isset($_COOKIE['role_remember'])) {
    $_SESSION['status'] = 'login';
    $_SESSION['username'] = $_COOKIE['user_remember'];
    $_SESSION['role'] = $_COOKIE['role_remember'];
    
    if ($_SESSION['role'] === 'admin') {
        header("Location: homeAdmin.php");
    } else {
        header("Location: homeMember.php");
    }
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nadine's Highlight - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css"> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 login-form-container">
                <!-- Header Judul -->
                <div class="login-header">
                    <img src="img/logo.png" alt="Nadine's Highlight Logo" class="logo-custom">
                    <h1 class="mb-2"><b>Nadine's Highlight</b></h1>
                    <p class="lead">Catch the Glow. Follow the Story.</p>
                </div>
                
                <div class="login-form-body">
                    <h2 class="mb-3">Login</h2>
                    
                    <!-- Menampilkan alert bila error -->
                    <?php if (isset($_GET['error'])): ?>
                        <div class="alert alert-danger" role="alert">
                            Login gagal. Username atau password salah!
                        </div>
                    <?php endif; ?>
                    
                    <!-- Menampilkan alert bila success -->
                    <?php if (isset($_GET['message'])): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo htmlspecialchars($_GET['message']); ?>
                        </div>
                    <?php endif; ?>
                    
                    <div id="alertMessage" class="alert alert-danger" style="display:none;"></div>
                    
                    <form id="loginForm" action="sessionLoginProcess.php" method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-4 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Ingat Saya</label>
                        </div>
                        <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
                    </form>
                    
                    <div class="mt-4 text-center">
                        <small class="text-muted">
                            admin/1234 atau nadine/5678
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <p class="text-center text-secondary mt-5">Copyright &copy; 2025 Nadine's Highlight</p>

    <script src="login_validation.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7Y92S4rC5O+3275x4G9s6L5" crossorigin="anonymous"></script>
</body>
</html>