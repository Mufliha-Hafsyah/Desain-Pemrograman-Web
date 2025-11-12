<?php
if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
    $targetDir = "uploads/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $targetFile = $targetDir . basename($_FILES["file"]["name"]);

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
        echo "File berhasil diunggah: " . htmlspecialchars(basename($_FILES["file"]["name"]));
    } else {
        echo "Gagal mengunggah file.";
    }
} else {
    echo "Tidak ada file yang diunggah atau terjadi kesalahan.";
}
?>