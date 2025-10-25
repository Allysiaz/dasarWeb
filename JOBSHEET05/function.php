<?php

function perkenalan($nama, $salam="Assalamualaikum") {
    echo $salam.", ";
    echo "Perkenalkan, nama saya ".$nama. "<br/>";
    echo "Senang berkenalan dengan Anda <br/>";
}

// Memanggil fungsi yang sudah dibuat
perkenalan("Hamdana", "Hallo");

echo "<hr>";

$saya = "Elok";
$ucapanSalam = "Selamat pagi";

// memanggil lagi
perkenalan($saya, $ucapanSalam);

?>