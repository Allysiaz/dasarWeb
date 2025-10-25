<?php 
// File: homeMember.php
require 'check_session.php'; 
if ($_SESSION['role'] !== 'member') { 
    header("Location: homeAdmin.php"); 
    exit(); 
}

$uploadDir = 'uploads/';
$allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

// --- Fungsi untuk menampilkan 3 foto terbaru  ---
function getLatestImages($dir, $extensions, $limit = 3) {
    $files = [];
    if (is_dir($dir)) {
        $allFiles = scandir($dir);
        
        foreach ($allFiles as $file) {
            if ($file !== '.' && $file !== '..') {
                $filePath = $dir . $file;
                $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
                
                if (is_file($filePath) && in_array($extension, $extensions)) {
                    $files[] = [
                        'name' => $file,
                        'path' => $filePath,
                        'time' => filemtime($filePath)
                    ];
                }
            }
        }
    }
    usort($files, function($a, $b) {
        return $b['time'] <=> $a['time'];
    });
    return array_slice($files, 0, $limit);
}

$latestImages = getLatestImages($uploadDir, $allowedExtensions, 3);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Member | Nadine's Highlight</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
      <div class="container-fluid container">
        <a class="navbar-brand navbar-brand-custom" href="homeMember.php">
            <img src="img/logo.png" alt="Logo" class="logo-nav">
            Nadine's Highlight
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="homeMember.php">Beranda</a>
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
                <h1 class="display-4 fw-bold">Selamat Datang, <?php echo $_SESSION['username']; ?>!</h1>
                <p class="lead mt-4">
                    "Highlight terindah tidak selalu berada di depan mata publik, melainkan terukir abadi di ruang rahasia kita. Di sinilah, setiap piksel adalah harta yang tak ternilai."
                </p>

                
            </div>
        </div>
        
        <h3 class="p-3 mb-0 fw-bold rounded-top" style="background-color: #d4d4d4ff;">Tentang Nadine's Highlight</h3>
        <div class="card mb-5 rounded-bottom" style="border-top: none;">
            <div class="card-body">
                <p class="mb-2">Nadine's Highlight dirancang sebagai media visual premium</p>
                <div class="accordion accordion-flush" id="sinopsisAccordion">
                    <div class="accordion-item" style="background-color: transparent;">
                        <h2 class="accordion-header" id="headingSinopsis">
                            <button class="accordion-button collapsed p-0 text-decoration-underline" 
                                    type="button" 
                                    data-bs-toggle="collapse" 
                                    data-bs-target="#collapseSinopsis" 
                                    aria-expanded="false" 
                                    aria-controls="collapseSinopsis" 
                                    style="background-color: transparent; color: var(--primary-color); box-shadow: none;">
                                Selengkapnya
                            </button>
                        </h2>
                        <div id="collapseSinopsis" class="accordion-collapse collapse" aria-labelledby="headingSinopsis" data-bs-parent="#sinopsisAccordion">
                            <div class="accordion-body p-0 pt-2">
                                <p class="mb-0">
                                    yang fokus pada momen-momen terbaik dan kisah-kisah di baliknya. Administrasi web ini mencakup kurasi ketat untuk menjaga kualitas konten yang dibagikan. Administrator bertanggung jawab memastikan semua file yang diunggah memenuhi standar resolusi dan batas ukuran yang ditetapkan, serta menjaga keamanan sistem. Fitur upload yang tersedia adalah alat utama Anda untuk memperkaya galeri bagi semua member.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
        </div>

        <h3 class="p-3 mb-0 fw-bold rounded-top" style="background-color: #d4d4d4ff;">Galeri Highlight Terbaru</h3>
        <div class="card mb-5 rounded-bottom" style="border-top: none;">
            <div class="card-body">
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <!-- Penamaan file yang di upload -->
                    <?php if (!empty($latestImages)): ?>
                        <?php foreach ($latestImages as $image): 
                            $formattedDate = date("d M Y", $image['time']);
                        ?>
                        <div class="col">
                            <div class="card h-100 shadow-sm">
                                <img src="<?php echo htmlspecialchars($image['path']); ?>" class="card-img-top" alt="Highlight Terbaru" style="height: 250px; object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title">Tanggal: <?php echo $formattedDate; ?></h5>
                                    <p class="card-text text-muted">Diunggah oleh: Admin</p>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-12">
                            <div class="alert alert-info">
                                Belum ada gambar Highlight yang diunggah '.
                            </div>
                        </div>
                    <?php endif; ?>
        </div>
                </div>
                </div>
        </div>


    </div>
    <p class="text-center text-secondary mt-5">Copyright &copy; 2025 Nadine's Highlight</p>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script>
        // Script ini tidak relevan lagi karena form upload telah dihapus, tapi dipertahankan jika user mengaktifkan kembali
        $(document).ready(function() {
            $('#fileSelectBtn').click(function() {
                $('#fileToUpload').trigger('click');
            });
            
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
</body>
</html>