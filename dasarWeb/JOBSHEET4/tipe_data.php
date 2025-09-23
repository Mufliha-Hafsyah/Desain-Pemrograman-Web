<?php
$a = 10;
$b = 5;
$c = $a + 5;
$d = $b + (10 * 5);
$e = $d - $c;
//Tipe data integer
echo "<b>Contoh Tipe Data Integer pada PHP</b><br>";
echo "Variabel a: {$a} <br>";
echo "Variabel b: {$b} <br>";
echo "Variabel c: {$c} <br>";
echo "Variabel d: {$d} <br>";
echo "Variabel e: {$e} <br>";

var_dump($e);
echo "<br><br>";

//Tipe data float
echo "<b>Contoh Tipe Data Float pada PHP</b><br>";
$nilaiMatematika = 5.1;
$nilaiIPA = 6.7;
$nilaiBahasaIndonesia = 9.3;

$rataRata = ($nilaiMatematika + $nilaiIPA + $nilaiBahasaIndonesia) / 3;

echo "Matematika: {$nilaiMatematika} <br>";
echo "IPA: {$nilaiIPA} <br>";
echo "Bahasa Indonesia: {$nilaiBahasaIndonesia} <br>";
echo "Rata-rata nilai: {$rataRata} <br>";

var_dump($rataRata);
echo "<br><br>";

//Tipe data boolean
echo "<b>Contoh Tipe Data Boolean pada PHP</b><br>";
$apakahSiswaLulus = true;
$apakahSiswaSudahUjian = false;

var_dump($apakahSiswaLulus);
echo "<br>";
var_dump($apakahSiswaSudahUjian);
echo "<br><br>";

//Tipe data string
echo "<b>Contoh Tipe Data String pada PHP</b><br>";
$namaDepan = "Ibnu";
$namaBelakang = 'Jakaria';

$namaLengkap = "{$namaDepan} {$namaBelakang}";
$namaLengkap2 = $namaDepan . ' ' . $namaBelakang;

echo "Nama Depan: {$namaDepan} <br>";
echo 'Nama Belakang: ' . $namaBelakang . '<br>';

echo $namaLengkap;
echo "<br><br>";

//Tipe data array
echo "<b>Contoh Tipe Data Array pada PHP</b><br>";
$listMahasiswa = ["Wahid Abdullah", "Elmo Bachtiar", "Lendis Febri"];
echo $listMahasiswa[0];
?>