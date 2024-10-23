<?php
require 'koneksi.php';
if (isset($_SESSION["lgin"]) || $_SESSION["login"]!== true || $_SESSION['role'] !== 'admin') {
    header('location:index.php ');
    exit;
}
if (!isset($_GET['manga_id'])) {
    echo "ID Manga tidak valid.";
    exit();
}

$manga_id = intval($_GET['manga_id']);

$query_manga = "SELECT judul FROM manga WHERE id = $manga_id";
$result_manga = mysqli_query($conn, $query_manga);
$manga = mysqli_fetch_assoc($result_manga);

if (!$manga) {
    echo "Manga tidak ditemukan.";
    exit();
}

$manga_dir = "manga/{$manga['judul']}";

$query_delete_chapters = "DELETE FROM chapter WHERE manga_id = $manga_id";
if (!mysqli_query($conn, $query_delete_chapters)) {
    echo "Gagal menghapus chapter: " . mysqli_error($conn);
    exit();
}

$cover_image_path = "cover/{$manga['judul']}.jpg";
if (is_file($cover_image_path)) {
    unlink($cover_image_path); 
}

function deleteDirectory($dir) {
    if (!is_dir($dir)) {
        return;
    }
    
    $files = glob($dir . '/*');
    foreach ($files as $file) {
        if (is_file($file)) {
            unlink($file); 
        } elseif (is_dir($file)) {
            deleteDirectory($file); 
        }
    }
    rmdir($dir); 
}

deleteDirectory($manga_dir);

$query_delete_manga = "DELETE FROM manga WHERE id = $manga_id";
if (mysqli_query($conn, $query_delete_manga)) {
    
    echo "
    <script>
        alert('Manga berhasil dihapus.');
        window.location.href = 'index.php';
    </script>
    ";
} else {
    
    echo "Gagal menghapus manga: " . mysqli_error($conn);
}
?>
