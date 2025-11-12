<?php
function get_pg_connection(): PgSql\Connection {
    static $conn = null;

    // Jika koneksi sudah ada, langsung pakai lagi (singleton)
    if ($conn instanceof PgSql\Connection) {
        return $conn;
    }

    // Konfigurasi database kamu
    $host = 'localhost';
    $port = '5432';
    $dbname = 'db_login';
    $user = 'postgres';
    $password = '191205';

    // String koneksi dengan opsi UTF8
    $connStr = "host=$host port=$port dbname=$dbname user=$user password=$password options='--client_encoding=UTF8'";

    // Coba koneksi
    $conn = @pg_connect($connStr);

    if (!$conn) {
        $err = pg_last_error() ?: 'Unknown error from pg_connect';
        throw new RuntimeException("Koneksi PostgreSQL gagal: " . $err);
    }

    // Set encoding UTF8
    pg_set_client_encoding($conn, 'UTF8');

    return $conn;
}

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
