<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $errors = array();

    if (empty($password)) {
        $errors[] = "Password harus diisi.";
    } elseif (strlen($password) < 8) {
        $errors[] = "Password harus minimal 8 karakter.";
    }

    if (!empty($errors)) {
        echo "<h3>Validasi Gagal di Server:</h3>";
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    } else {
        echo "<h3>Data Berhasil Dikirim dan Divalidasi</h3>";
        echo "Nama: " . htmlspecialchars($nama) . " <br>";
        echo "Email: " . htmlspecialchars($email) . " <br>";
        echo "Password (panjang): " . strlen($password) . " karakter<br>";
    }
}
?>