<?php
    $host = 'localhost';
    $port = '5432';
    $dbName = 'db_login';
    $userName = 'postgres';
    $password = '191205';

    $dbConnect = pg_connect("host=$host port=$port dbname=$dbName user=$userName password=$password");

    if (!$dbConnect) {
        die('Koneksi gagal: ' . pg_last_error());
    }

    pg_set_client_encoding($dbConnect, 'UTF8');

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nim = $_POST['NIM'];
        $password = $_POST['password'];
        
        $sql = "SELECT * FROM users where nim = '$nim' and password = '$password'";
        $result = pg_query($dbConnect, $sql);

        if ($result && pg_num_rows($result) > 0) {
            echo "success"; //dibaca oleh AJAX
        }else{
            echo "NIM atau Password Salah!";
        }
    }
?>