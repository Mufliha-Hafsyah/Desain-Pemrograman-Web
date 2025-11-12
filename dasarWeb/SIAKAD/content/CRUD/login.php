<?php
session_start();
require_once __DIR__ . '/connection.php';

// Ambil input
$nim = isset($_POST['NIM']) ? trim($_POST['NIM']) : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

// --- Dapatkan koneksi dari fungsi ---
try {
    $conn = get_pg_connection();  // koneksi PostgreSQL
} catch (Throwable $e) {
    error_log('DB connection error in login.php: ' . $e->getMessage());
    echo "Gagal koneksi ke database.";
    exit;
}

// Validasi sederhana
if ($nim === '' || $password === '') {
    echo "NIM dan Password harus diisi!";
    exit;
}

// Gunakan prepared query untuk mencegah SQL injection
$sql = 'SELECT username, nim, password FROM users WHERE nim = $1 LIMIT 1';
$result = pg_query_params($conn, $sql, array($nim));

if (!$result) {
    error_log('Query error: ' . pg_last_error($conn));
    echo "Terjadi kesalahan pada server.";
    exit;
}

if (pg_num_rows($result) === 0) {
    echo "NIM atau Password salah!";
    exit;
}

$user = pg_fetch_assoc($result);
$hash = $user['password'];

// Verifikasi password
if (password_verify($password, $hash)) {
    // Sukses login → buat session
    session_regenerate_id(true);
    $_SESSION['nim'] = $user['nim'];
    $_SESSION['username'] = $user['username'];

    echo "success";
    pg_close($conn);
    exit;
} else {
    echo "NIM atau Password salah!";
    pg_close($conn);
    exit;
}
