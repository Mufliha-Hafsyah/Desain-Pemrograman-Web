<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $nim = $_POST['nim'];
    $email = $_POST['email'];
    $jurusan = $_POST['jurusan'];
    $created_at = date('Y-m-d H:i:s'); // Contoh kolom 'dibuat'

    // Query INSERT
    // Perhatikan: PostgreSQL sering membutuhkan tanda kutip ganda pada nama kolom/tabel jika nama tersebut bukan huruf kecil semua atau mengandung spasi. 
    // Untuk amannya, gunakan huruf kecil semua pada nama kolom di database.
    $sql = "INSERT INTO mhs (nim, email, jurusan, dibuat) VALUES ('$nim', '$email', '$jurusan', '$created_at')";
    
    $simpan = pg_query($koneksi, $sql);

    if ($simpan) {
        header("location: index.php?pesan=input");
    } else {
        echo "Gagal menyimpan data: " . pg_last_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Tambah Data Mahasiswa Baru</h4>
                </div>
                <div class="card-body">
                    
                    <?php 
                    // Tampilkan pesan error jika ada
                    if (isset($error_message)) {
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                Gagal menyimpan data: ' . htmlspecialchars($error_message) . '
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>';
                    }
                    ?>
                    
                    <form method="POST" action=""> 
                        
                        <div class="mb-3">
                            <label for="nim" class="form-label">NIM</label>
                            <input type="text" class="form-control" id="nim" name="nim" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="jurusan" class="form-label">Jurusan</label>
                            <input type="text" class="form-control" id="jurusan" name="jurusan" required>
                        </div>
                        
                        <button type="submit" class="btn btn-success me-2">Simpan Data</button>
                        <a href="index.php" class="btn btn-secondary">Batal / Kembali</a>
                        
                    </form>
                    
                </div> </div> </div> </div> </div> <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>