<?php 
require 'check_session.php'; 

$uploadDir = 'uploads/';
$allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Galeri | Nadine's Highlight</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
      <div class="container-fluid container">
        <a class="navbar-brand navbar-brand-custom" href="homeAdmin.php">
            <img src="img/logo.png" alt="Logo" class="logo-nav">
            Nadine's Highlight
        </a>
            
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="homeAdmin.php">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="galeri.php">Galeri</a>
                </li>
            </ul>
            
            <ul class="navbar-nav ms-auto"> 
                <li class="nav-item d-none d-lg-flex align-items-center"> 
                    <span class="nav-link text-white me-3 py-0">Logged in as: <?php echo $_SESSION['username']; ?> (<?php echo $_SESSION['role']; ?>)</span>
                </li>
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Pengaturan
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item text-danger" href="sessionLogout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        
      </div>
    </nav>
    
    <div class="container mt-5">
        <h1 class="display-4 fw-bold">My Highlight</h1>

        <!-- alert penghapusan -->
        <?php if (isset($_GET['delete_status'])): ?>
            <div class="alert alert-<?php echo ($_GET['delete_status'] == 'success') ? 'success' : 'danger'; ?> alert-dismissible fade show mt-4" role="alert">
                <?php echo htmlspecialchars($_GET['message']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4 mt-4">
            <?php
            $hasImages = false;

            if (is_dir($uploadDir)) {
                $files = scandir($uploadDir);
                foreach ($files as $file) {
                    if ($file != "." && $file != "..") {
                        $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                        
                        if (in_array($extension, $allowedExtensions)) {
                            $hasImages = true;
                            $fileTimestamp = filemtime($uploadDir . $file);
                            $formattedDate = date("d M Y", $fileTimestamp);

                            // pembuatan card gambar
                            echo '<div class="col">';
                            echo '  <div class="card h-100 shadow-sm">';
                            echo '    <img src="' . $uploadDir . htmlspecialchars($file) . '" class="card-img-top" alt="Nadine Highlight" style="height: 250px; object-fit: cover;">';
                            echo '    <div class="card-body">';
                            echo '      <h5 class="card-title">Tanggal: ' . $formattedDate . '</h5>';
                            echo '      <p class="card-text text-muted">Diunggah oleh: Admin</p>'; 
                            
                            // tombol hapus untuk admin
                            if ($_SESSION['role'] === 'admin') {
                                $delete_url = 'deleteProcess.php?filename=' . urlencode($file);
                                echo '      <a href="' . $delete_url . '" class="btn btn-sm btn-danger mt-2" onclick="return confirm(\'Anda yakin ingin menghapus file: ' . htmlspecialchars($file) . '?\')">Hapus</a>';
                            }
                            echo '    </div>';
                            echo '  </div>';
                            echo '</div>';
                        }
                    }
                }
                if (!$hasImages) {
                    echo '<div class="col-12 col-md-6 mx-auto">'; // Menggunakan col-md-6 untuk lebar maksimal 50% dan mx-auto untuk menengahkan
                    echo '  <div class="alert alert-warning mb-0 text-center" role="alert">Belum ada gambar Highlight yang diunggah.</div>';
                    echo '</div>';
                }
            } else {
                echo '<div class="col-12">';
                echo '  <div class="alert alert-danger" role="alert">Folder uploads/ tidak ditemukan.</div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
    <p class="text-center text-secondary mt-5">Copyright &copy; 2025 Nadine's Highlight</p>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>