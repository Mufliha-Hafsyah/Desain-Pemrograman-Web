<?php
    // session_start() HARUS di paling atas
    session_start();
    
    // Cek Sesi: Jika sesi 'nim' tidak ada, alihkan ke login
    if (!isset($_SESSION['nim'])) {
        header('Location: login-page.html');
        exit;
    }

    // Ambil data dari sesi
    $user_nim = $_SESSION['nim'];

    $user_username = htmlspecialchars($_SESSION['username']); 
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
                    <?php
                        $announcement = array(
                            "Jadwal UAS D-IV Teknik Informatika Semester Genap 2024-2025",
                            "Jadwal UAS D-IV Sistem Informasi Bisnis Semester Genap 2024-2025"
                        );
                        echo "<tr>";
                            echo "<td>". $announcement[0] ."</td>";
                            echo '<td><button class="unduh-btn">Unduh</button></td>';
                        echo "</tr>";
                        echo "<tr>";
                            echo "<td>". $announcement[1] ."</td>";
                            echo '<td><button class="unduh-btn">Unduh</button></td>';
                        echo "</tr>";
                    ?>
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
                <th>Submit</th>
            </tr>
            <tr>
               <?php
                    $task = array(
                        array("Algoritma dan Struktur Data", "Jobsheet 14 - TREE", "2 Juni 2025 14.00 WIB"),
                        array("Basis Data", "JOBSHEET 14 - DML", "6 Juni 2025 23.59 WIB")
                    );
                    echo "<tr>";
                        echo "<td>". $task[0][0] ."</td>";
                        echo "<td>". $task[0][1] ."</td>";
                        echo "<td>". $task[0][2] ."</td>";
                        echo '<td><button class="submit-btn">Submit</button></td>';
                    echo "</tr>";
                    echo "<tr>";
                        echo "<td>". $task[1][0] ."</td>";
                        echo "<td>". $task[1][1] ."</td>";
                        echo "<td>". $task[1][2] ."</td>";
                        echo '<td><button class="submit-btn">Submit</button></td>';
                    echo "</tr>";
                ?>
            </tr>
        </table>
        </div>
    </div>
</body>
</html>