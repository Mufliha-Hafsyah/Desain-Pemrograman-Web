<?php
session_start();
require __DIR__ . '/CRUD/connection.php'; 

$err = ''; 
$nim = ''; 
$username = ''; 

$nim_target = $_SESSION['nim'] ?? null; 

if (!$nim_target) {
    http_response_code(401);
    exit('Akses ditolak. Sesi login tidak ditemukan. Harap login terlebih dahulu.');
}

// --- Fungsi Pembantu untuk Eksekusi Query ---
function execute_query($sql, $params) {
    global $dbConnect;
    
    $result = pg_query_params($dbConnect, $sql, $params);
    
    if (!$result) {
        throw new Exception(pg_last_error($dbConnect));
    }
    return $result;
}

try {
    $res = execute_query('SELECT nim, username FROM users WHERE nim=$1', [$nim_target]);
    
    $user = pg_fetch_assoc($res);
    if (!$user) {
        http_response_code(404);
        exit('Akun user dengan NIM ' . htmlspecialchars($nim_target) . ' tidak ditemukan.');
    }
    
    $nim = $user['nim']; 
    $username = $user['username'];
    
} catch (Throwable $e) {
    exit('Error saat mengambil data: ' . htmlspecialchars($e->getMessage()));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username_baru = trim($_POST['username'] ?? '');
    $password_baru = $_POST['password'] ?? ''; 
    
    $username = $username_baru;

    if ($username_baru === '') {
        $err = 'Username wajib diisi.';
    } else {
        try {
            
            if ($password_baru !== '') {
                $hashed_password = password_hash($password_baru, PASSWORD_DEFAULT);
                
                $sql = 'UPDATE users SET username=$1, password=$2 WHERE nim=$3';
                $params = [$username_baru, $hashed_password, $nim_target];

            } else {
                $sql = 'UPDATE users SET username=$1 WHERE nim=$2';
                $params = [$username_baru, $nim_target];
            }
            
            // Eksekusi Update
            execute_query($sql, $params);
            
            // Perbarui sesi username
            $_SESSION['username'] = $username_baru;

            // Redirect ke halaman homePage setelah sukses
            header('Location: homePage.php');
            exit;
            
        } catch (Throwable $e) {
            $err = 'Gagal menyimpan perubahan: ' . htmlspecialchars($e->getMessage());
        }
    }
}
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ubah Akun User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
        rel="stylesheet" 
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
        crossorigin="anonymous">
</head>
<body>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-6">
                <div class="card shadow-lg p-4">
                    <h1 class="card-title text-center mb-4">Profile (NIM: <?= htmlspecialchars($nim) ?>)</h1>

                    <?php if ($err): ?>
                        <div class="alert alert-danger" role="alert">
                            <?= htmlspecialchars($err) ?>
                        </div>
                    <?php endif; ?>

                    <form method="post">
                        <div class="mb-3">
                            <label for="nim_readonly" class="form-label fw-bold">NIM (Tidak dapat diubah)</label>
                            <input type="text" name="nim_readonly" id="nim_readonly"value="<?= htmlspecialchars($nim) ?>" class="form-control bg-light" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="username_input" class="form-label fw-bold">Username</label>
                            <input type="text" name="username" id="username_input" value="<?= htmlspecialchars($username ?? '') ?>" class="form-control" required>
                        </div>

                        <div class="mb-4">
                            <label for="password_input" class="form-label fw-bold">Password Baru (Kosongkan jika tidak ingin diubah)</label>
                            <input type="password" name="password" id="password_input"value="" class="form-control" placeholder="Masukkan password baru">
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button class="btn btn-primary me-md-2" type="submit">Simpan Perubahan</button>
                            <a class="btn btn-secondary" href="homePage.php">Batal</a>
                        </div>
                        </form>

                    <hr class="my-4">
                    <p class="text-danger text-center"> Hapus akun secara permanen. </p>
                    <button type="button" class="btn btn-danger w-100" id="deleteAccountBtn"> Hapus Akun Saya </button>
                    <form id="deleteAccount" action="delete.php" method="post" style="display:none;">
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        document.getElementById('deleteAccountBtn').addEventListener('click', function() {
        const confirmDelete = confirm('Apakah Anda Yakin Untuk Menghapus Akun Ini? Hapus Akun Tidak Bisa Dibatalkan');
        if (confirmDelete) {
            document.getElementById('deleteAccount').submit();
        }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
          integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
          crossorigin="anonymous"></script>
</body>
</html>