<?php
$hargaProduk = 120000;
$diskon = 20;

echo "Harga produk: Rp $hargaProduk <br>";

if ($hargaProduk > 100000) {
    $jumlahDiskon = ($diskon / 100) * $hargaProduk;
    $hargaDiskon = $hargaProduk - $jumlahDiskon;
    echo "Anda mendapatkan diskon sebesar $diskon%.<br>";
} else {
    $hargaDiskon = $hargaProduk;
    echo "Maaf, pembelian Anda tidak mendapatkan diskon.<br>";
}

echo "Harga yang harus dibayar adalah: Rp " . $hargaDiskon;
?>