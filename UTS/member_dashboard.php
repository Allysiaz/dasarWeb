<?php
$pageTitle = "Member Dashboard";
$requiredRole = 'member';

// Data untuk Jumbotron
$jumbotronHeader = "Halo,!";
$jumbotronLead = "Selamat datang di dashboard Member Anda.";
$jumbotronBody = "Sebagai member, Anda hanya memiliki akses untuk melihat galeri foto highlight. Fitur upload dikhususkan untuk Admin. Klik pada jumbotron untuk melihat efek jQuery."; // Diubah

// Memanggil template
require 'dashboard_template.php';
?>