<?php
    $koneksi = pg_connect("host=localhost port=5432 dbname=prakwebdb user=postgres password=nadine15");

    if (!$koneksi) {
        die("Koneksi database Gagal: " . pg_last_error()); 
    }
?>