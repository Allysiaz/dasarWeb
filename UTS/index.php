<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['status']) && $_SESSION['status'] === 'login') {
    header("Location: " . $_SESSION['role'] . "_dashboard.php");
    exit;
}

$remembered_username = '';
if (isset($_COOKIE['remember_me'])) {
    $cookie_data = json_decode($_COOKIE['remember_me'], true);
    if ($cookie_data) {
        $_SESSION['status'] = 'login';
        $_SESSION['username'] = $cookie_data['username'];
        $_SESSION['role'] = $cookie_data['role'];

        header("Location: " . $cookie_data['role'] . "_dashboard.php");
        exit;
    }
    $remembered_username = $cookie_data['username'] ?? '';
}

$pageTitle = "Login";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nadine's Highlight - <?php echo $pageTitle; ?></title>
    
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery-ui.min.css">
    <link rel="stylesheet" href="style.css">
    
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="jumbotron text-center login-header"> 
                <h1>Nadine's Highlight</h1>
                <p class="lead">Catch the Glow. Follow the Story.</p>
            </div>
            <div class="card">
                <div class="card-header">Login</div>
                <div class="card-body">
                    <?php if (isset($_SESSION['login_error'])): ?>
                        <div class="alert alert-danger" role="alert"><?php echo $_SESSION['login_error']; unset($_SESSION['login_error']); ?></div>
                    <?php endif; ?>
                    
                    <form id="loginForm" action="login_process.php" method="POST">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required value="<?php echo htmlspecialchars($remembered_username); ?>">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="rememberMe" name="rememberMe">
                            <label class="form-check-label" for="rememberMe">Ingat Saya</label>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block" name="submit">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-5 footer-copyright"> 
        <p>Copyright &copy; 2025 Nadine's Highlight</p>
    </div>
</div>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script> 
<script src="js/jquery-ui.min.js"></script> 
<script src="custom.js"></script>
</body>
</html>