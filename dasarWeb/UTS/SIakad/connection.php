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
?>