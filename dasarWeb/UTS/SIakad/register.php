<?php
    require __DIR__ . '/connection.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nim = $_POST['NIM'];
        $password = $_POST['password'];
        $userName = $_POST['USERNAME'];

        $hashed_password = password_hash($password, PASSWORD_DEFAULT); 

        $check_sql = "SELECT nim FROM users WHERE nim = $1"; 
        $check_result = pg_query_params($dbConnect, $check_sql, array($nim));

        if (pg_num_rows($check_result) > 0) {
            echo "NIM sudah terdaftar. Silakan login atau gunakan NIM lain.";
        } else {
            $insert_sql = "INSERT INTO users (username, nim, password) VALUES ($1, $2, $3)";
            $result = pg_query_params($dbConnect, $insert_sql, array($userName, $nim, $hashed_password)); 

            if ($result) {
                echo "success_register"; // Indikasi sukses registrasi untuk AJAX
            } else {
                echo "Registrasi Gagal. Error: " . pg_last_error($dbConnect);
            }
        }
    }
?>