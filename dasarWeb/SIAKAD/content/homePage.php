<?php
session_start();

// Cek login
if (!isset($_SESSION['nim'])) {
    header('Location: login-page.php');
    exit;
}

require __DIR__ . '/CRUD/connection.php';

$user_nim = $_SESSION['nim'];
$user_username = htmlspecialchars($_SESSION['username']);
$tugas = [];

// Ambil data tugas dari tabel mata_kuliah
$query = "SELECT nama_mk, tugas, deadline FROM mata_kuliah ORDER BY deadline ASC";
$result = pg_query(get_pg_connection(), $query);

if ($result) {
    while ($row = pg_fetch_assoc($result)) {
        $tugas[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SIAKAD POLINEMA</title>
    <link rel="icon" href="../img/lambang-polinema.png">
    <script src="jquery-3.7.1.js"></script>
    <script src="scriptHomePage.js"></script>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="bg-light">
    <div class="d-flex flex-column flex-md-row min-vh-100">
        <div class="sidebar bg-primary text-white p-3 col-md-2 d-flex flex-column align-items-center">
            <div class="profile text-center mb-4">
                <div class="img-content d-flex justify-content-center ">
                    <a href="update_data.php" class="">
                        <img src="../img/fotoUser.jpg" class="rounded-circle img-fluid border border-3 border-light w-50 h-75 mt-2" alt="User">
                    </a>
                </div>
                <h5 class="mb-0 bg-primary bg-gradient rounded-top px-2 py-1">
                    <?php echo $user_username; ?>
                </h5>
                <p class="bg-primary rounded-bottom px-2 py-1 mb-0">
                    <?php echo $user_nim; ?>
                </p>
            </div>

            <nav class="menu nav flex-column w-100 text-center mt-3">
                <a href="#" class="btn btn-primary bg-gradient text-white py-2 border-bottom">Beranda</a>
                <a href="#" class="btn btn-primary bg-gradient text-white py-2 border-bottom">General</a>
                <a href="#" class="btn btn-primary bg-gradient text-white py-2 border-bottom">LMS</a>
                <a href="#" class="btn btn-primary bg-gradient text-white py-2 border-bottom">Kalender Akademik</a>
                <a href="#" class="btn btn-primary bg-gradient text-white py-2 border-bottom">Nilai Akademik</a>
                <a href="#" class="btn btn-primary bg-gradient text-white py-2 border-bottom">Pembayaran UKT</a>
                <a href="#" class="btn btn-primary bg-gradient text-white py-2 border-bottom">Presensi Mahasiswa</a>
                <a href="#" class="btn btn-primary bg-gradient text-white py-2 border-bottom">Kartu Tanda Mahasiswa</a>
                <a href="../data_tugas/index.php" target="_blank" class="btn btn-primary bg-gradient text-white py-2 border-bottom">Data Tugas</a>
                <a href="logout.php" id="logout" class="btn btn-danger mt-3">Log Out</a>
            </nav>
        </div>

        <!-- Main content -->
        <div class="flex-grow-1 p-4">
            <header class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 fw-bold text-primary mb-0">SIAKAD POLINEMA</h1>
                <img src="../img/logo-jti.png" class="img-fluid col-md-1" alt="Logo JTI">
            </header>

            <div class="search-bar mb-4">
                <input type="text" name="search" id="src" class="form-control" placeholder="Cari Mata Kuliah">
            </div>

            <!-- Announcement -->
            <section class="announcement mb-4">
                <h3 class="h5 fw-semibold mb-3">Announcement</h3>
                <div class="bg-white rounded shadow-sm p-3">
                    <table class="table align-middle mb-0">
                        <tr>
                            <td>Jadwal UAS D-IV Teknik Informatika Semester Genap 2024-2025</td>
                            <td class="text-end">
                                <button class="btn btn-outline-primary btn-sm">Unduh</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Jadwal UAS D-IV Sistem Informasi Bisnis Semester Genap 2024-2025</td>
                            <td class="text-end">
                                <button class="btn btn-outline-primary btn-sm">Unduh</button>
                            </td>
                        </tr>
                    </table>
                </div>
            </section>

            <!-- Daftar Tugas -->
            <section class="tugas">
                <h3 class="h5 fw-semibold mb-3">Daftar Tugas / Quiz yang Akan Datang</h3>
                <div class="table-responsive bg-white rounded shadow-sm">
                    <table class="table table-striped table-hover mb-0">
                        <thead class="table-primary">
                            <tr>
                                <th>Course</th>
                                <th>Content</th>
                                <th>Deadline</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($tugas) > 0): ?>
                                <?php foreach ($tugas as $t): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($t['nama_mk']) ?></td>
                                        <td><?= htmlspecialchars($t['tugas']) ?></td>
                                        <td><?= htmlspecialchars($t['deadline']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-3">
                                        Belum ada tugas yang ditambahkan.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</body>
</html>