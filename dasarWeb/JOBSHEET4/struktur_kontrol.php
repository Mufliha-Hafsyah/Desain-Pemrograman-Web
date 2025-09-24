<?php
$nilaiNumerik = 92;

if ($nilaiNumerik >= 90 && $nilaiNumerik <= 100) {
    echo "Nilai huruf= A";
} elseif ($nilaiNumerik >= 80 && $nilaiNumerik < 90) {
    echo "Nilai huruf= B";
} elseif ($nilaiNumerik >= 70 && $nilaiNumerik < 80) {
    echo "Nilai huruf= C";
} elseif ($nilaiNumerik < 70) {
    echo "Nilai huruf= D";
}

$jarakSaatIni = 0;
$jarakTarget = 500;
$peningkatanHarian = 30;
$hari = 0;

while ($jarakSaatIni < $jarakTarget) {
    $jarakSaatIni += $peningkatanHarian;
    $hari++;
}
echo "<br><br>";
echo "Atlet tersebut memerlukan $hari hari untuk mencapai jarak 500 kilometer.";

$jumlahLahan = 10;
$tanamanPerLahan = 5;
$buahPerTanaman = 10;
$jumlahBuah = 0;

for ($i = 1; $i <= $jumlahLahan; $i++) {
    $jumlahBuah += ($tanamanPerLahan * $buahPerTanaman);
}

echo "<br><br>";
echo "Jumlah buah yang akan dipanen adalah: $jumlahBuah";

$skorUjian = [85, 92,  78, 96, 88];
$totalSkor = 0;

foreach ($skorUjian as $skor) {
    $totalSkor += $skor;
}

echo "<br><br>";
echo "Total skor ujian adalah: $totalSkor";
echo "<br><br>";

$nilaiSiswa = [85, 92, 58, 64, 90, 55, 88, 79, 70, 96];

foreach ($nilaiSiswa as $nilai) {
    if ($nilai < 60) {
        echo "Nilai: $nilai (Tidak lulus) <br>";
        continue;
    } 
    echo "Nilai: $nilai (Lulus) <br>";
}

//soal no 4.6
$nilai = [85, 92, 78, 64, 90, 75, 88, 79, 70, 96];
sort($nilai); 
$nilai = array_slice($nilai, 2, -2); 
$total = array_sum($nilai);
$rata = $total / count($nilai);
echo "<br><br>";
echo "Total nilai: $total<br>Rata-rata: $rata";

//soal no 4.7
$hargaProduk = 120000;
$diskon = 0;
if ($hargaProduk > 100000) {
    $diskon = $hargaProduk * 0.20;
}
$hargaAkhir = $hargaProduk - $diskon;
echo "<br><br>";
echo "Harga yang harus dibayar setelah diskon: Rp " . number_format($hargaAkhir, 0, ',', '.');

//soal no 4.8
$jumlahPoin = 650;
$jumlahPoin > 500 ? $hadiahTambahan = "YA" : $hadiahTambahan = "TIDAK";
echo "<br><br>";
echo "Total skor pemain adalah: $jumlahPoin poin<br>";
echo "Apakah pemain mendapatkan hadiah tambahan? $hadiahTambahan";
?>