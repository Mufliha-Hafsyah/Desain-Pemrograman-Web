<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $data_lama = pg_fetch_assoc(pg_query($koneksi, "SELECT * FROM mhs WHERE id='$id'"));
    // Tampilkan formulir dengan data_lama di kolom value
}

$err_massage = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nim = $_POST['nim'];
    $email = $_POST['email'];
    $jurusan = $_POST['jurusan'];

    // Query UPDATE
    $sql = "UPDATE mhs SET nim='$nim', email='$email', jurusan='$jurusan' WHERE id='$id'";
    
    $update = pg_query($koneksi, $sql);

    if ($update) {
        header("location: index.php?pesan=update");
    } else {
        $err_massage = "Gagal mengupdate data: " . pg_last_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Edit Data Mahasiswa</h4>
                </div>
                <div class="card-body">
                    
                    <?php 
                    // Tampilkan pesan error jika ada
                    if ($err_massage) {
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                ' . $err_massage . '
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>';
                    }
                    ?>
                    
                    <form method="POST" action="">
                        
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                        
                        <div class="mb-3">
                            <label for="nim" class="form-label">NIM</label>
                            <input type="text" class="form-control" id="nim" name="nim">
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        
                        <div class="mb-3">
                            <label for="jurusan" class="form-label">Jurusan</label>
                            <input type="text" class="form-control" id="jurusan" name="jurusan">
                        </div>
                        
                        <button type="submit" class="btn btn-primary text-white me-2">Simpan Perubahan</button>
                        <a href="index.php" class="btn btn-secondary">Batal</a>
                        
                    </form>
                    
                </div> </div> </div> </div> </div> <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>