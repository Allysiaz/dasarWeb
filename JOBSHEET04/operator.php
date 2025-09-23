<?php
$a = 10;
$b = 5;

$hasilTambah = $a + $b;
$hasilKurang = $a - $b;
$hasilKali = $a * $b;
$hasilBagi = $a / $b;
$sisaBagi = $a % $b;
$pangkat = $a ** $b;

$hasilSama = $a == $b;
$hasilTidakSama = $a != $b;
$hasilLebihKecil = $a < $b;
$hasilLebihBesar = $a > $b;
$hasilLebihKecilSama = $a <= $b;
$hasilLebihBesarSama = $a >= $b;

$hasilAnd = $a && $b;
$hasilOr = $a || $b;
$hasilNotA = !$a;
$hasilNotB = !$b;

$a += $b;
$a -= $b;
$a *= $b;
$a /= $b;
$a %= $b;

$hasilIdentik = $a === $b;
$hasilTidakIdentik = $a !== $b;

echo "Nilai a = 10 || Nilai b = 5";
echo "<br>Hasil Penjumlahan = $hasilTambah";
echo "<br>Hasil Pengurangan = $hasilKurang";
echo "<br>Hasil Perkalian   = $hasilKali";
echo "<br>Hasil Pembagian   = $hasilBagi";
echo "<br>Sisa Pembagian    = $sisaBagi";
echo "<br>Hasil Pangkat     = $pangkat";

echo "<br><br>";
echo "Apakah a == b ? " . ($hasilSama ? 'true' : 'false') . "<br>";
echo "Apakah a != b ? " . ($hasilTidakSama ? 'true' : 'false') . "<br>";
echo "Apakah a < b ? " . ($hasilLebihKecil ? 'true' : 'false') . "<br>";
echo "Apakah a > b ? " . ($hasilLebihBesar ? 'true' : 'false') . "<br>";
echo "Apakah a <= b ? " . ($hasilLebihKecilSama ? 'true' : 'false') . "<br>";
echo "Apakah a >= b ? " . ($hasilLebihBesarSama ? 'true' : 'false') . "<br>";

echo "<br>";
echo "<br>Hasil dari \$a && \$b (AND) adalah: "; 
var_dump($hasilAnd); 
echo "<br>Hasil dari \$a || \$b (OR) adalah: ";
var_dump($hasilOr);
echo "<br>Hasil dari !\$a (NOT A) adalah: ";
var_dump($hasilNotA);
echo "<br>Hasil dari !\$b (NOT B) adalah: ";
var_dump($hasilNotB);

echo "<br";
echo "<br>Hasil a += b = $a += $b; ";
echo "<br>Hasil a += b = $hasilKurang";
echo "<br>Hasil a += b = $hasilKali";
echo "<br>Hasil a += b = $hasilBagi";
echo "<br>Sisa Pembagian    = $sisaBagi";
echo "<br>Hasil Pangkat     = $pangkat";

echo "<br>";
echo "<br>Hasil dari \$a === \$b (Identik) adalah: ";
var_dump($hasilIdentik);
echo "<br>Hasil dari \$a !== \$b (Tidak Identik) adalah: ";
var_dump($hasilTidakIdentik);

?>