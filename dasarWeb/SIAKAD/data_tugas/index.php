<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Tugas - CRUD PostgreSQL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="../img/lambang-polinema.png">
</head>
<body>

<?php
// 1. Panggil file koneksi database
include 'koneksi.php';
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">

            <a href="../content/homePage.php" class="btn btn-danger mb-3">
                Kembali
            </a> 
            
            <h2 class="mb-4">Data Tugas Mata Kuliah</h2>
            
            <a href="tambahData.php" class="btn btn-primary mb-3">Tambah Tugas</a>

            <?php 
            // Pesan notifikasi
            if(isset($_GET['pesan'])){
                if($_GET['pesan'] == "input"){
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            Data tugas berhasil ditambahkan!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>';
                }else if($_GET['pesan'] == "update"){
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            Data tugas berhasil diperbarui!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>';
                }else if($_GET['pesan'] == "hapus"){
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Data tugas berhasil dihapus!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>';
                }
            }
            ?>

            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered">
                    <thead class="table-white">
                        <tr>
                            <th>No</th>
                            <th>Nama Mata Kuliah</th>
                            <th>Nama Tugas</th>
                            <th>Deadline</th>
                            <th>Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        // 2. Query untuk mengambil semua data tugas dari PostgreSQL
                        $query = pg_query(get_pg_connection(), "SELECT * FROM mata_kuliah ORDER BY id ASC");
                        
                        // Cek jika query gagal
                        if (!$query) {
                            die("Query Error: " . pg_last_error(get_pg_connection()));
                        }

                        $no = 1;
                        // 3. Loop untuk menampilkan data
                        while($data = pg_fetch_assoc($query)){
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($data['nama_mk']); ?></td>
                            <td><?php echo htmlspecialchars($data['tugas']); ?></td>
                            <td><?php echo htmlspecialchars($data['deadline']); ?></td>
                            <td><?php echo htmlspecialchars($data['dibuat']); ?></td>
                            <td>
                                <a href="editData.php?id=<?php echo htmlspecialchars($data['id']); ?>" 
                                   class="btn btn-sm btn-warning text-white">Edit</a>
                                
                                <a href="hapus.php?id=<?php echo htmlspecialchars($data['id']); ?>" 
                                   class="btn btn-sm btn-danger" 
                                   onclick="return confirm('Yakin ingin menghapus tugas ini?')">Delete</a>
                            </td>
                        </tr>
                        <?php 
                        } // End while loop
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
