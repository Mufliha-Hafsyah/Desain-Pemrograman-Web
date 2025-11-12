<?php
include 'koneksi.php';

$id = $_GET['id'];
$sql = "DELETE FROM mhs WHERE id='$id'";

$hapus = pg_query($koneksi, $sql);

if ($hapus) {
    header("location: index.php?pesan=hapus");
} else {
    echo "Gagal menghapus data: " . pg_last_error($koneksi);
}
?>