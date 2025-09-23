<?php
echo "========= PERHITUNGAN NILAI HURUF =========";
echo "<br>";
$nilaiNumerik = 92;
echo "Nilai = {$nilaiNumerik}";
echo "<br>";

if ($nilaiNumerik >= 90 && $nilaiNumerik <= 100) {
    echo "Nilai huruf: A";
} elseif ($nilaiNumerik >= 80 && $nilaiNumerik <= 90) {
    echo "Nilai huruf: B"; 
} elseif ($nilaiNumerik >= 70 && $nilaiNumerik <= 80) {
    echo "Nilai huruf: C";
} elseif ($nilaiNumerik < 70) {
    echo "Nilai huruf: D";
} 



echo "<br><br><br>";
echo "========= PERHITUNGAN TARGET JARAK =========";
$jarakSaatIni = 0;
$jarakTarget = 500;
$peningkatanHarian = 30;
$hari = 0;

while ($jarakSaatIni < $jarakTarget) {
    $jarakSaatIni += $peningkatanHarian;
    $hari++;
}
echo "<br>";
echo "Atlet tersebut memerlukan $hari hari untuk mencapai jarak 500 kilometer.";



echo "<br><br><br>";
echo "========= PERHITUNGAN LAHAN PANEN =========";
$jumlahLahan = 10;
$tanamanPerLahan = 5;
$buahPerTanaman = 10;
$jumlahBuah = 0;

for ($i = 1; $i <= $jumlahLahan ; $i++) { 
    $jumlahBuah += ($tanamanPerLahan + $buahPerTanaman);
}

echo "<br>";
echo "Jumlah buah yang akan dipanen adalah: $jumlahBuah";



echo "<br><br><br>";
echo "========= PERHITUNGAN SKOR UJIAN =========";
$totalUjian = [85, 92, 78, 96, 88];
$totalSkor = 0;

foreach ($totalUjian as $skor) {
    $totalSkor += $skor;
}

echo "<br>";
echo "Total skor ujian adalah: $totalSkor";



echo "<br><br><br>";
echo "========= PERHITUNGAN NILAI SISWA ========= <br>";
$nilaiSiswa = [85, 92, 58, 64, 90, 55, 88, 79, 70, 96];

foreach ($nilaiSiswa as $nilai) {
    if ($nilai < 60) {
        echo "Nilai: $nilai (Tidak lulus) <br>";
        continue;
    }
    echo "Nilai: $nilai (Lulus) <br>";
}
?>