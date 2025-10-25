<?php
$pageTitle = "Admin Dashboard";
$requiredRole = 'admin';

// Data untuk Jumbotron
$jumbotronHeader = "Selamat Datang, Admin!";
$jumbotronLead = "Ini adalah halaman dashboard khusus untuk Administrator.";
$jumbotronBody = "Anda dapat mengelola konten dan melihat semua unggahan. Klik pada jumbotron untuk melihat efek jQuery.";

// Memanggil template
require 'dashboard_template.php'; 
?>