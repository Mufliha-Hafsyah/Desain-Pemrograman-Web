<?php
session_start();

// Cek login
if (!isset($_SESSION['nim'])) {
    header('Location: login-page.html');
    exit;
}

include '../CRUD/koneksi.php'; // ✅ path benar ke koneksi

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
<html>
<head>
    <title>SIAKAD POLINEMA</title>
    <link rel="stylesheet" href="styleHome.css">
    <script src="jquery-3.7.1.js"></script>
    <script src="scriptHomePage.js"></script>
    <link rel="icon" href="../img/lambang-polinema.png">
</head>
<body>
    <div class="sidebar">
        <div class="profile">
            <a href="update_data.php">
                <img src="../img/fotoUser.jpg">
            </a>
            <h3><?php echo $user_username; ?></h3>
            <p><?php echo $user_nim; ?></p>
        </div>

        <nav class="menu">
            <a href="#">Beranda</a>
            <a href="#">General</a>
            <a href="#">LMS</a>
            <a href="#">Kalender Akademik</a>
            <a href="#">Nilai Akademik</a>
            <a href="#">Pembayaran UKT</a>
            <a href="#">Presensi Mahasiswa</a>
            <a href="#">Kartu Tanda Mahasiswa</a>
            <a href="../CRUD/index.php" target="_blank">Data Tugas</a>
            <a href="logout.php" id="logout">Log Out</a>
        </nav>
    </div>

    <div class="main">
        <header class="header">
            <h1>SIAKAD POLINEMA</h1>
            <img src="../img/logo-jti.png" class="img-head">
        </header>

        <div class="search-bar">
            <input type="text" name="search" id="src" placeholder="Cari Mata Kuliah">
        </div>

        <div class="announcement">
            <h3>Announcement</h3>
            <div class="announcement-content">
                <table>
                    <tr>
                        <td>Jadwal UAS D-IV Teknik Informatika Semester Genap 2024-2025</td>
                        <td><button class="unduh-btn">Unduh</button></td>
                    </tr>
                    <tr>
                        <td>Jadwal UAS D-IV Sistem Informasi Bisnis Semester Genap 2024-2025</td>
                        <td><button class="unduh-btn">Unduh</button></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="tugas">
            <h3>Daftar Tugas / Quiz yang Akan Datang</h3>
            <table>
                <tr>
                    <th>Course</th>
                    <th>Content</th>
                    <th>Deadline</th>
                </tr>
                <?php if (count($tugas) > 0): ?>
                    <?php foreach ($tugas as $t): ?>
                        <tr>
                            <td><?= htmlspecialchars($t['nama_mk']) ?></td>
                            <td><?= htmlspecialchars($t['tugas']) ?></td>
                            <td><?= htmlspecialchars($t['deadline']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="4" style="text-align:center;">Belum ada tugas yang ditambahkan.</td></tr>
                <?php endif; ?>
            </table>
        </div>
    </div>
</body>
</html>
