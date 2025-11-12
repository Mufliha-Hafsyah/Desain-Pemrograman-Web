<?php
    session_start();
    require __DIR__ . '/connection.php';

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        exit;
    }

    $nim_target = $_SESSION['nim'] ?? null;

    // 3. Validasi NIM Sesi
    if (!$nim_target) {
        // Jika sesi NIM tidak ditemukan, alihkan ke login
        header('Location: login-page.html');
        exit;
    }

    $sql = 'DELETE FROM users WHERE nim=$1';
    $result = pg_query_params($dbConnect, $sql, [$nim_target]);

    if (!$result) {
        throw new Exception(pg_last_error($dbConnect));
    }
    
    // 5. Hancurkan Sesi
    $_SESSION = array();
    session_destroy();
    
    // 6. Redirect ke halaman login
    header('Location: login-page.html');
    exit;

?>