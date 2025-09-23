<?php
$jumlahKursi = 45;
$kursiDitempati = 28;

echo "Jumlah kursi = {$jumlahKursi} <br>";
echo "Jumlah kursi yang sudah terisi = {$kursiDitempati} <br>";

$kursiKosong = $jumlahKursi - $kursiDitempati;
$persentase = ($kursiKosong/$jumlahKursi) * 100;

echo "==================================================<br>";
echo "Persentase kursi yang masih kosong adalah {$persentase}% <br>";
echo "==================================================<br>";
?>