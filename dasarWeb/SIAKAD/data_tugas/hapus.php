<?php
require __DIR__ . '/koneksi.php';

$id = (int)($_GET['id'] ?? 0);

if ($id <= 0) {
    http_response_code(400);
    exit('ID tidak valid.');
}

try {
    // Hapus data berdasarkan ID
    qparams('DELETE FROM mata_kuliah WHERE id = $1', [$id]);

    // Kembali ke halaman utama
    header('Location: index.php?pesan=hapus');
    exit;
} catch (Throwable $e) {
    echo "Gagal menghapus data: " . htmlspecialchars($e->getMessage());
}
?>
