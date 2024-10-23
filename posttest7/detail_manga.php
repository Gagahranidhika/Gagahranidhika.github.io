<?php
require 'koneksi.php';

$manga_id = intval($_GET['id']);
$query = "SELECT * FROM manga WHERE id = $manga_id";
$result = mysqli_query($conn, $query);
$manga = mysqli_fetch_assoc($result);

$query_chapters = "SELECT * FROM chapter WHERE manga_id = $manga_id";
$result_chapters = mysqli_query($conn, $query_chapters);
$chapters = [];
while ($row = mysqli_fetch_assoc($result_chapters)) {
    $chapters[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $manga['judul']; ?> - ZManga</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <?php include 'navbar.php'; ?>
    
    <section class="manga-detail">
        <div class="manga-info">
            <img src="cover/<?= $manga['cover_image']; ?>" alt="<?= $manga['judul']; ?>" class="cover-image">
            <div class="manga-meta">
                <h1><?= $manga['judul']; ?></h1>
                <p><strong>Genre:</strong> <?= $manga['genre']; ?></p>
                <p><strong>Sinopsis:</strong> <?= $manga['sinopsis']; ?></p>
            </div>
        </div>
        
        <div class="chapter-section">
            <h2>Chapters</h2>
            <ul class="chapter-list">
                <?php foreach ($chapters as $chapter): ?>
                    <li>
                        <a href="chapter.php?manga=<?= $manga['judul']; ?>&chapter=<?= $chapter['chapter_number']; ?>">
                            Chapter <?= $chapter['chapter_number']; ?>: <?= $chapter['title']; ?>
                        </a>

                        <?php if (isset($_SESSION['login']) && $_SESSION["roles"] === "admin"): ?>
                            <a href="delete_chapter.php?manga_id=<?= $manga_id; ?>&chapter_number=<?= $chapter['chapter_number']; ?>" 
                               onclick="return confirm('Apakah Anda yakin ingin menghapus chapter ini?')">Hapus</a>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </section>
    
    <?php if (isset($_SESSION['login']) && $_SESSION["roles"] === "admin"): ?>
        <a href="add_chapter.php?manga_id=<?= $manga_id; ?>" class="add-button">Tambah Chapter</a>
    <?php endif; ?>
    <?php if (isset($_SESSION['login']) && $_SESSION["roles"] === "admin"): ?>
        <a href="delete_manga.php?manga_id=<?= $manga_id; ?>" class="delete-button" onclick="return confirm('Apakah Anda yakin ingin menghapus manga ini? Semua chapter dan data terkait akan dihapus.');">Hapus Manga</a>
    <?php endif; ?>
        
    <?php include 'footer.php'; ?>
</body>
</html>
