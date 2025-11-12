<?php
session_start();
require __DIR__ . '/CRUD/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nim = isset($_POST["NIM"]) ? trim($_POST["NIM"]) : '';
    $password = isset($_POST["password"]) ? $_POST["password"] : '';
    
    if (empty($nim) || empty($password)) {
        echo "NIM dan Password harus diisi!";
    }

    // Gunakan parameterized query untuk mencegah SQL injection
    $sql = "SELECT username, nim, password FROM users WHERE nim = $1";
    $result = pg_query_params(get_pg_connection(), $sql, array($nim));

    if ($result && pg_num_rows($result) > 0) {
        $user = pg_fetch_assoc($result);
        
        // Verifikasi password dengan hash yang tersimpan
        if (password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['nim'] = $user['nim'];
            $_SESSION['username'] = $user['username'];
            
            echo "success";
            pg_close(get_pg_connection());
            exit;
        }
    }
    
    // Jika sampai di sini, berarti login gagal
    echo "NIM atau Password Salah!";
    pg_close(get_pg_connection());
    exit;
}
?>