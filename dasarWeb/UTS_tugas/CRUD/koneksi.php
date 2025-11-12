<?php

// koneksi.php
// Pastikan ekstensi pgsql aktif di php.ini

function get_pg_connection(): PgSql\Connection {
    $host = "localhost"; // Ganti jika host database berbeda
    $port = "5432";      // Port default PostgreSQL
    $dbname = "db_login"; // Ganti dengan nama database Anda
    $user = "postgres"; // Ganti dengan username PostgreSQL Anda
    $password = "191205"; // Ganti dengan password PostgreSQL Anda
    static $conn = null;
    if ($conn instanceof PgSql\Connection) {
        return $conn;
    }

    $connStr = "host=$host port=$port dbname=$dbname user=$user password=$password options='--client_encoding=UTF8'";
    $conn = @pg_connect($connStr);

    if (!$conn) {
        // Jangan pakai @ di produksi; untuk debug bisa tampilkan detail
         $err = pg_last_error() ?: 'Unknown error from pg_connect';
        throw new RuntimeException("Koneksi PostgreSQL gagal. Periksa host/port/db/user/pass & ekstensi pgsql.");
        throw new RuntimeException("Koneksi PostgreSQL gagal: " . $err);
    }
    return $conn;
}

/** Helper sederhana untuk aman menjalankan query dengan parameter */
function qparams(string $sql, array $params) {
    $conn = get_pg_connection();
    $res = @pg_query_params($conn, $sql, $params);
    if ($res === false) {
        throw new RuntimeException("Query gagal: " . pg_last_error($conn));
        
    }
    return $res;
}

function q(string $sql) {
    $conn = get_pg_connection();
    $res = @pg_query($conn, $sql);
    if ($res === false) {
        throw new RuntimeException("Query gagal: " . pg_last_error($conn));
    }
    return $res;
}
?>