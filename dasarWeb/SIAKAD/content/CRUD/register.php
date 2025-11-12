<?php
session_start();
require __DIR__ . '/connection.php'; // pastikan path ini benar

try {
    $conn = get_pg_connection();
} catch (Throwable $e) {
    error_log('DB connection error: ' . $e->getMessage());
    echo "Gagal koneksi ke database.";
    exit;
}

// Pastikan request menggunakan POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "Metode tidak valid.";
    exit;
}

// Ambil input dan sanitasi
$nim = trim($_POST['NIM'] ?? '');
$password = $_POST['password'] ?? '';
$username = trim($_POST['USERNAME'] ?? '');

// Validasi dasar
if ($nim === '' || $username === '' || $password === '') {
    echo "Semua field harus diisi.";
    exit;
}

// Validasi panjang password (opsional)
if (strlen($password) < 3) {
    echo "Password minimal 3 karakter.";
    exit;
}

// Cek apakah NIM sudah terdaftar
$check_sql = "SELECT nim FROM users WHERE nim = $1";
$check_result = pg_query_params($conn, $check_sql, [$nim]);

if (!$check_result) {
    echo "Terjadi kesalahan server: " . pg_last_error($conn);
    exit;
}

if (pg_num_rows($check_result) > 0) {
    echo "NIM sudah terdaftar. Silakan login atau gunakan NIM lain.";
    exit;
}

// Hash password dan simpan ke database
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
$insert_sql = "INSERT INTO users (username, nim, password) VALUES ($1, $2, $3)";
$insert_result = pg_query_params($conn, $insert_sql, [$username, $nim, $hashed_password]);

if ($insert_result) {
    echo "success_register"; // untuk dibaca oleh jQuery
} else {
    echo "Registrasi gagal. Error: " . pg_last_error($conn);
}
?>
