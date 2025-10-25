<?php 
require 'check_session.php'; // Memastikan user sudah login
if ($_SESSION['role'] !== 'admin') { 
    header("Location: homeMember.php"); 
    exit(); 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Admin | Nadine's Highlight</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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
                    <a class="nav-link active" aria-current="page" href="homeAdmin.php">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="galeri.php">Galeri</a>
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
        <div class="p-5 mb-5 jumbotron-custom">
            <div class="container-fluid py-3">
                <h1 class="display-4 fw-bold">Selamat Datang, Admin!</h1>
                <p class="lead mt-4">
                    "Highlight terindah tidak selalu berada di depan mata publik, melainkan terukir abadi di ruang rahasia kita. Di sinilah, setiap piksel adalah harta yang tak ternilai."
                </p>
                

                
            </div>
        </div>
        <h3 class="p-3 mb-0 fw-bold rounded-top" style="background-color: #d4d4d4ff;">Upload Memori</h3>
        <div class="card mb-5 rounded-bottom" style="border-top: none;">
            <div class="card-body">
                <form id="uploadForm" action="uploadProcess.php" method="POST" enctype="multipart/form-data">
                    <div class="custom-file-upload-container" style="border: 2px dashed #ccc;">
                        
                        <p class="lead text-muted mb-4">Unggah foto-foto spesial Anda sekarang.</p>
                        
                        <div class="file-input-wrapper mb-3">
                            <button type="button" class="btn-file-select" id="fileSelectBtn">Pilih Gambar Highlight</button>
                            <input type="file" id="fileToUpload" name="fileToUpload" required>
                        </div>
                        
                        <div class="upload-info mb-4" id="fileNameDisplay">Belum ada file dipilih.</div>

                        <button type="submit" name="submit_upload" class="btn btn-success" id="uploadBtn" disabled>Upload</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Pesan upload berhasil -->
    <?php if (isset($_GET['upload_status'])): ?>
        <div class="alert alert-<?php echo ($_GET['upload_status'] == 'success') ? 'success' : 'danger'; ?> alert-dismissible fade show mt-4" role="alert">
            <?php echo htmlspecialchars($_GET['message']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

</div>
    </div>
    
    <script>
        // Ambil nama file
        $(document).ready(function() {
            $('#fileToUpload').change(function() {
                var fileName = $(this).val().split('\\').pop(); 
                
                if (fileName) {
                    $('#fileNameDisplay').text('File terpilih: ' + fileName).css('color', 'green');
                    $('#uploadBtn').prop('disabled', false).removeClass('btn-secondary').addClass('btn-success');
                } else {
                    $('#fileNameDisplay').text('Belum ada file dipilih.').css('color', '#6c757d');
                    $('#uploadBtn').prop('disabled', true).removeClass('btn-success').addClass('btn-secondary');
                }
            });
        });
    </script>
    <p class="text-center text-secondary mt-5">Copyright &copy; 2025 Nadine's Highlight</p>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>