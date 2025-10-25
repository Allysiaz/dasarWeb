        <?php
        // PHP Logic
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Tambahkan validasi peran (pastikan $requiredRole didefinisikan di admin_dashboard/member_dashboard)
        // $requiredRole akan di-set oleh admin_dashboard.php atau member_dashboard.php
        if (!isset($_SESSION['status']) || $_SESSION['status'] !== 'login' || $_SESSION['role'] !== $requiredRole) {
            header("Location: index.php");
            exit;
        }

        // Ambil peran user saat ini
        $currentUserRole = $_SESSION['role'] ?? '';

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

        <nav class="navbar navbar-expand-sm navbar-dark"> 
            <div class="container">
                <a class="navbar-brand" href="<?php echo ($_SESSION['role'] == 'admin') ? 'admin_dashboard.php' : 'member_dashboard.php'; ?>">
                    <img src="img/logo.png" id="navbarLogo" alt="Nadine's Highlight Logo">
                    <b>Nadine's Highlight</b>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <span class="nav-link disabled text-white-50">Logged in as: <?php echo $_SESSION['username'] . ' (' . $_SESSION['role'] . ')'; ?></span>
                        </li>
                        <li class="nav-item ml-2">
                            <a class="btn btn-outline-light btn-sm" href="logout.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container mt-4">
            <div class="jumbotron dashboard-header"> 
                <h1 class="display-4"><?php echo $jumbotronHeader; ?></h1>
                <p class="lead"><?php echo $jumbotronLead; ?></p>
                <hr class="my-4">
                <p id="jumbotronBody"><?php echo $jumbotronBody; ?></p> 
            </div>

            <?php if ($currentUserRole === 'admin'): ?>
                <h2>Form Upload Highlight</h2>
                
                <div class="file-upload-container mb-5" id="uploadContent">
                    <form id="imageUploadForm" enctype="multipart/form-data">
                        
                        <div class="file-input-container">
                            <input type="file" class="d-none" id="imageFile" name="imageFile" accept="image/*" required>
                            <label for="imageFile" class="file-label btn-info">Pilih Gambar Highlight</label>
                        </div>
                        
                        <small id="fileStatus" class="form-text text-muted d-block mt-2">Belum ada file dipilih.</small>

                        <button type="submit" class="btn btn-secondary upload-button" id="uploadButton" disabled>Upload</button>
                        
                        <div id="uploadStatus" class="mt-3 font-weight-bold upload-status"></div>
                        <div id="uploadedImagePreview" class="mt-3"></div>
                    </form>
                </div>
                <?php endif; ?>
            <button class="btn btn-block btn-primary mb-3" id="toggleGallery">Lihat Galeri Foto</button>

            <div id="galleryContent" style="display:none;"> 
                <h2>Galeri Foto Unggahan</h2>
                
                <?php if ($currentUserRole === 'admin'): ?>
                    <p class="text-danger">Admin dapat mengelola foto di sini. <br>Tombol 'Hapus Foto Terpilih' hanya aktif untuk Anda.</p>
                    <button type="button" class="btn btn-danger" id="deleteSelectedBtn">Hapus Foto Terpilih</button> 
                    <hr>
                <?php else: ?>
                    <p class="text-info">Anda hanya dapat melihat galeri ini. Fitur upload/delete dikhususkan untuk Administrator.</p>
                <?php endif; ?>

                <div class="row mt-3">
                     <div class="col-md-4 mb-3" id="gallery-loading">
                        <p>Loading galeri...</p>
                    </div>
                </div>
            </div>
        </div>

        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/jquery-ui.min.js"></script>
        <script src="costum.js"></script>
        <script>
            // Load gallery ketika halaman siap
            $(document).ready(function() {
                loadGallery();
            });
        </script>
    </body>
    </html>
