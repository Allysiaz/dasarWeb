<?php
$dataSiswa = [
    ['Alice', 85],
    ['Bob', 92],
    ['Charlie', 78],
    ['David', 64],
    ['Eva', 90]
];

$totalNilai = 0;
foreach ($dataSiswa as $siswa) {
    $totalNilai += $siswa[1]; 
}

$jumlahSiswa = count($dataSiswa);
$rataRata = $totalNilai / $jumlahSiswa;

echo "Nilai rata-rata: $rataRata<br>";

echo "Daftar siswa dengan nilai di atas rata-rata:</b><br>";
foreach ($dataSiswa as $siswa) {
    if ($siswa[1] > $rataRata) {
        echo "Nama: {$siswa[0]}, Nilai: {$siswa[1]} <br>";
    }
}
?>