<?php
require __DIR__ . '/koneksi.php';

$err = '';
$id = (int)($_GET['id'] ?? 0);

if ($id <= 0) {
    http_response_code(400);
    exit('ID tidak valid.');
}

// 🔹 Ambil data lama berdasarkan ID
try {
    $res = qparams('SELECT id, nama_mk, tugas, deadline FROM public.mata_kuliah WHERE id = $1', [$id]);
    $row = pg_fetch_assoc($res);

    if (!$row) {
        http_response_code(404);
        exit('Data tidak ditemukan.');
    }
} catch (Throwable $e) {
    exit('Error: ' . htmlspecialchars($e->getMessage()));
}

// Isi data awal untuk form
$nama_mk = $row['nama_mk'];
$tugas = $row['tugas'];
$deadline = $row['deadline'];

// 🔹 Proses update ketika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_mk = trim($_POST['nama_mk'] ?? '');
    $tugas   = trim($_POST['tugas'] ?? '');
    $deadline = trim($_POST['deadline'] ?? '');

    if ($nama_mk === '' || $tugas === '' || $deadline === '') {
        $err = 'Semua field wajib diisi.';
    } else {
        try {
            qparams(
                'UPDATE public.mata_kuliah 
                    SET nama_mk = $1, tugas = $2, deadline = $3 
                  WHERE id = $4',
                [$nama_mk, $tugas, $deadline, $id]
            );
            header('Location: index.php?pesan=update');
            exit;
        } catch (Throwable $e) {
            $err = $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Data Tugas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="../img/lambang-polinema.png">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-dark">
                    <h4 class="mb-0">Edit Data Tugas</h4>
                </div>
                <div class="card-body">

                    <?php if ($err): ?>
                        <div class="alert alert-danger"><?= htmlspecialchars($err) ?></div>
                    <?php endif; ?>

                    <form method="POST">
                        <div class="mb-3">
                            <label for="nama_mk" class="form-label">Nama Mata Kuliah</label>
                            <input type="text" class="form-control" id="nama_mk" name="nama_mk"
                                   value="<?= htmlspecialchars($nama_mk) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="tugas" class="form-label">Nama Tugas</label>
                            <input type="text" class="form-control" id="tugas" name="tugas"
                                   value="<?= htmlspecialchars($tugas) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="deadline" class="form-label">Deadline</label>
                            <input type="date" class="form-control" id="deadline" name="deadline"
                                   value="<?= htmlspecialchars($deadline) ?>" required>
                        </div>

                        <button type="submit" class="btn btn-success me-2">Simpan Perubahan</button>
                        <a href="index.php" class="btn btn-secondary">Batal</a>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
