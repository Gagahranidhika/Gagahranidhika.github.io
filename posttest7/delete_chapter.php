<?php
require 'koneksi.php';
if (isset($_SESSION["lgin"]) || $_SESSION["login"]!== true || $_SESSION['role'] !== 'admin') {
    header('location:index.php ');
    exit;
}
if (!isset($_GET['manga_id']) || !isset($_GET['chapter_number'])) {
    echo "ID Manga atau Nomor Chapter tidak valid.";
    exit();
}

$manga_id = intval($_GET['manga_id']);
$chapter_number = intval($_GET['chapter_number']);

$query_manga = "SELECT judul FROM manga WHERE id = $manga_id";
$result_manga = mysqli_query($conn, $query_manga);
$manga = mysqli_fetch_assoc($result_manga);

if (!$manga) {
    echo "Manga tidak ditemukan.";
    exit();
}

$chapter_dir = "manga/{$manga['judul']}/chapter$chapter_number";

if (is_dir($chapter_dir)) {
    $files = glob("$chapter_dir/*"); 
    foreach ($files as $file) {
        if (is_file($file)) {
            unlink($file); 
        }
    }
    rmdir($chapter_dir); 
}

$query = "DELETE FROM chapter WHERE manga_id = $manga_id AND chapter_number = $chapter_number";

if (mysqli_query($conn, $query)) {
    
    echo "
    <script>
        alert('Chapter berhasil dihapus.');
        window.location.href = 'detail_manga.php?id=$manga_id';
    </script>
    ";
} else {
    
    echo "Gagal menghapus chapter: " . mysqli_error($conn);
}
?>
