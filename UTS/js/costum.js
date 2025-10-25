// costum.js - KODE LENGKAP DAN DIPERBAIKI

$(document).ready(function() {
    
    // =========================================================
    // 1. EFEK JUMBOTRON - Bounce saat diklik (jQuery UI)
    // =========================================================
    $('.jumbotron.dashboard-header').click(function() {
        $(this).effect("bounce", { times: 3 }, "slow");
    });

    // =========================================================
    // 2. TOGGLE GALERI - Slide animation
    // =========================================================
    $('#toggleGallery').click(function() {
        $('#galleryContent').slideToggle('slow');
        
        // Load galeri saat dibuka pertama kali
        if ($('#galleryContent').is(':visible')) {
            loadGallery();
        }
    });
    
    // =========================================================
    // 3. FUNGSIONALITAS HAPUS FOTO (Admin only)
    // =========================================================
    $('#deleteSelectedBtn').click(function() {
        var selectedImages = [];
        
        // Ambil semua checkbox yang dicentang
        $('.gallery-item input[type="checkbox"]:checked').each(function() {
            selectedImages.push($(this).data('filename'));
        });
        
        // Validasi: Harus ada yang dipilih
        if (selectedImages.length === 0) {
            alert('Silakan pilih minimal satu foto untuk dihapus.');
            return;
        }
        
        // Konfirmasi hapus
        if (confirm('Yakin ingin menghapus ' + selectedImages.length + ' foto?')) {
            $.ajax({
                url: 'delete_images.php',
                type: 'POST',
                data: { images: selectedImages },
                success: function(response) {
                    alert(response);
                    loadGallery(); // Reload galeri setelah hapus
                },
                error: function(xhr, status, error) {
                    console.error('Error deleting images:', error);
                    alert('Terjadi kesalahan saat menghapus foto.');
                }
            });
        }
    });
    
    // =========================================================
    // 4. LOGIKA FILE INPUT - Deteksi file yang dipilih
    // =========================================================
    $('#imageFile').change(function() {
        var fileName = $(this).val().split('\\').pop();
        var uploadButton = $('#uploadButton');
        
        if (this.files.length > 0) {
            // Ada file yang dipilih
            $('#fileStatus').text('File dipilih: ' + fileName);
            
            // Aktifkan tombol upload
            uploadButton.prop('disabled', false)
                        .removeClass('btn-secondary')
                        .addClass('btn-success')
                        .css('opacity', '1');
        } else {
            // Tidak ada file
            $('#fileStatus').text('Belum ada file dipilih.');
            
            // Nonaktifkan tombol upload
            uploadButton.prop('disabled', true)
                        .removeClass('btn-success')
                        .addClass('btn-secondary')
                        .css('opacity', '0.5');
        }
    });

    // =========================================================
    // 5. PROSES UPLOAD AJAX (Admin only)
    // =========================================================
    if ($("#imageUploadForm").length) {
        
        $('#imageUploadForm').on('submit', function(e) {
            e.preventDefault();
            
            // Debug: Cek apakah ada file yang dipilih
            var fileInput = $('#imageFile')[0];
            if (!fileInput.files || fileInput.files.length === 0) {
                alert('Silakan pilih file terlebih dahulu!');
                return false;
            }
            
            // Buat FormData object untuk upload file
            var formData = new FormData(this);
            
            // Debug log (bisa dihapus di production)
            console.log('=== UPLOAD DEBUG ===');
            console.log('File name:', fileInput.files[0].name);
            console.log('File size:', fileInput.files[0].size, 'bytes');
            console.log('File type:', fileInput.files[0].type);
            
            // Tampilkan status uploading
            $('#uploadStatus').html('<span class="alert alert-info d-block">Mengunggah file, mohon tunggu...</span>');
            
            // Kirim AJAX request
            $.ajax({
                url: 'upload_process.php', 
                type: 'POST',
                data: formData,
                processData: false,  // Penting untuk FormData
                contentType: false,  // Penting untuk FormData
                cache: false,
                
                success: function(response) {
                    // Debug log
                    console.log('Server response:', response);
                    
                    // Reset form setelah upload
                    $('#imageUploadForm')[0].reset();
                    $('#imageFile').trigger('change'); // Trigger untuk reset status
                    
                    // Cek response dari server
                    if (response.startsWith("Success:")) {
                        // Upload berhasil
                        var successMessage = response.substring(0, response.indexOf('<br>'));
                        $('#uploadStatus').html('<div class="alert alert-success">' + 
                            successMessage.replace('Success: ', '') + 
                            '</div>');
                        
                        // Tampilkan preview gambar
                        var imageHtml = response.substring(response.indexOf('<img'));
                        $('#uploadedImagePreview').html(imageHtml);
                        
                        // Reload galeri untuk menampilkan foto baru
                        setTimeout(function() {
                            if (typeof loadGallery === 'function') {
                                loadGallery();
                            }
                        }, 500);
                        
                    } else {
                        // Upload gagal / ada error
                        $('#uploadStatus').html('<div class="alert alert-danger">' + 
                            response.replace('Error: ', '') + 
                            '</div>');
                    }
                },
                
                error: function(xhr, status, error) {
                    // Error AJAX / koneksi
                    console.error('=== AJAX ERROR ===');
                    console.error('Status:', status);
                    console.error('Error:', error);
                    console.error('Response:', xhr.responseText);
                    
                    // Reset form
                    $('#imageUploadForm')[0].reset();
                    $('#imageFile').trigger('change');
                    
                    // Tampilkan error message
                    $('#uploadStatus').html('<div class="alert alert-danger">' +
                        'Terjadi kesalahan koneksi saat mengunggah. Error: ' + error +
                        '</div>');
                }
            });
        });
    }
    
    // =========================================================
    // 6. LOAD GALERI SAAT HALAMAN PERTAMA KALI DIBUKA (Optional)
    // =========================================================
    // Uncomment baris di bawah jika ingin galeri langsung load
    // loadGallery();
    
});

// =========================================================
// FUNGSI: Load Galeri dari Server
// =========================================================
function loadGallery() {
    console.log('Loading gallery...');
    
    $.ajax({
        url: 'get_gallery.php',
        type: 'GET',
        dataType: 'json',
        
        success: function(images) {
            console.log('Gallery loaded:', images.length, 'images');
            displayGallery(images);
        },
        
        error: function(xhr, status, error) {
            console.error('Error loading gallery:', error);
            $('.row.mt-3').html('<div class="col-12"><p class="text-danger">Gagal memuat galeri. Error: ' + error + '</p></div>');
        }
    });
}

// =========================================================
// FUNGSI: Tampilkan Galeri
// =========================================================
function displayGallery(images) {
    var galleryHtml = '';
    
    // Cek apakah user adalah admin (ada tombol delete)
    var isAdmin = $('#deleteSelectedBtn').length > 0;
    
    if (images.length === 0) {
        // Tidak ada foto
        galleryHtml = '<div class="col-12"><p class="text-muted">Belum ada foto yang diunggah.</p></div>';
    } else {
        // Ada foto, tampilkan dalam grid
        images.forEach(function(image) {
            galleryHtml += '<div class="col-md-4 mb-3 gallery-item">';
            galleryHtml += '  <div class="card shadow-sm">';
            
            // Checkbox untuk admin
            if (isAdmin) {
                galleryHtml += '    <div class="card-header p-2 bg-light">';
                galleryHtml += '      <input type="checkbox" data-filename="' + image + '" class="mr-2"> ';
                galleryHtml += '      <small>Pilih untuk hapus</small>';
                galleryHtml += '    </div>';
            }
            
            // Gambar
            galleryHtml += '    <img src="uploads/' + image + '" class="card-img-top" alt="' + image + '" style="height: 200px; object-fit: cover;">';
            
            // Nama file
            galleryHtml += '    <div class="card-body p-2">';
            galleryHtml += '      <small class="text-muted">' + image + '</small>';
            galleryHtml += '    </div>';
            
            galleryHtml += '  </div>';
            galleryHtml += '</div>';
        });
    }
    
    // Update DOM
    $('.row.mt-3').html(galleryHtml);
    
    console.log('Gallery displayed:', images.length, 'images');
}

// =========================================================
// FUNGSI TAMBAHAN (Optional)
// =========================================================

// Fungsi untuk format ukuran file (jika diperlukan)
function formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
}

// Validasi file di sisi client (sebelum upload)
function validateFileClient(file) {
    const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
    const maxSize = 2 * 1024 * 1024; // 2MB
    
    if (!allowedTypes.includes(file.type)) {
        alert('Tipe file tidak valid. Hanya JPG, PNG, dan GIF yang diperbolehkan.');
        return false;
    }
    
    if (file.size > maxSize) {
        alert('Ukuran file terlalu besar. Maksimal 2MB. Ukuran file Anda: ' + formatFileSize(file.size));
        return false;
    }
    
    return true;
}