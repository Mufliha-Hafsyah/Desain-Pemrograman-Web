<?php
// Konfigurasi koneksi PostgreSQL
$host = "localhost"; // Ganti jika host database berbeda
$port = "5432";      // Port default PostgreSQL
$dbname = "db_mahasiswa"; // Ganti dengan nama database Anda
$user = "postgres"; // Ganti dengan username PostgreSQL Anda
$password = "191205"; // Ganti dengan password PostgreSQL Anda

$connection_string = "host=$host port=$port dbname=$dbname user=$user password=$password";

$koneksi = pg_connect($connection_string);

if (!$koneksi) {
    die("Koneksi gagal: " . pg_last_error());
}
?>