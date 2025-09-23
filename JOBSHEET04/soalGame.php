<?php
$daftarPoin = [150, 200, 100, 80, 50];
$totalSkor = 0;

foreach ($daftarPoin as $poin) {
    $totalSkor += $poin;
}
echo "Total skor pemain adalah: $totalSkor <br>";

$statusHadiah = ($totalSkor > 500) ? "YA" : "TIDAK";

echo "Apakah pemain mendapatkan hadiah tambahan? <b>($statusHadiah)</b>";
?>