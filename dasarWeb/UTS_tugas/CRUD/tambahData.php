<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $nama_matkul = $_POST['nama_matkul'];
    $tugas = $_POST['tugas'];
    $deadline = $_POST['deadline'];
    $created_at = date('Y-m-d'); // Waktu data dibuat

    if ($nama_matkul === '' || $tugas === '' || $deadline === '') {
        $err = 'Nama Mata Kuliah, Tugas dan Deadline wajib diisi.';
    } else {
        $nama_matkul = pg_escape_string(get_pg_connection(), $nama_matkul);
        $tugas = pg_escape_string(get_pg_connection(), $tugas);
        $deadline = pg_escape_string(get_pg_connection(), $deadline);

        $sql = "INSERT INTO mata_kuliah (nama_mk, tugas, deadline, dibuat)
                VALUES ('$nama_matkul', '$tugas', '$deadline', '$created_at')";

        $simpan = pg_query(get_pg_connection(), $sql);

        if ($simpan) {
            header("Location: index.php");
            exit;
        } else {
            $error_message = pg_last_error(get_pg_connection());
            echo "<div class='alert alert-danger text-center mt-3'>
                    Gagal menyimpan data: $error_message
                  </div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Data Tugas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="../img/lambang-polinema.png">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 mx-auto">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0" style="font-size: 50px;">Tambah Data Tugas Baru</h4>
                </div>
                <div class="card-body">
                    
                    <form method="POST"> 
                        
                        <div class="mb-3">
                            <label for="nama_matkul" class="form-label" style="font-size: 20px;">Nama Mata Kuliah</label>
                            <input type="text" class="form-control" id="nama_matkul" name="nama_matkul" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="tugas" class="form-label" style="font-size: 20px;">Nama Tugas</label>
                            <input type="text" class="form-control" id="tugas" name="tugas" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="deadline" class="form-label" style="font-size: 20px;"x>Deadline</label>
                            <input type="date" class="form-control" id="deadline" name="deadline" required>
                        </div>
                        
                        <button type="submit" class="btn btn-success me-2" style="font-size: 20px;">Simpan Data</button>
                        <a href="index.php" class="btn btn-secondary" style="font-size: 20px;">Batal</a>
                        
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
