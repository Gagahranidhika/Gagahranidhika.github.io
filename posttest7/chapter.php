<?php
require 'koneksi.php';

$manga = htmlspecialchars($_GET['manga']);
$chapter = intval($_GET['chapter']);

$chapterDir = "manga/$manga/chapter$chapter";

$total_pages = 0;
if (is_dir($chapterDir)) {
    if ($handle = opendir($chapterDir)) {
        while (false !== ($entry = readdir($handle))) {
            if (pathinfo($entry, PATHINFO_EXTENSION) === 'jpg') {
                $total_pages++;
            }
        }
        closedir($handle);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $manga; ?> - Chapter <?= $chapter; ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <?php include 'navbar.php'; ?>

    <div class="manga-container">
        <h1><?= $manga; ?> - Chapter <?= $chapter; ?></h1>
        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <img src="<?= $chapterDir ?>/<?= $chapter; ?>-<?= $i; ?>.jpg" alt="Page <?= $i; ?>" style="width: 100%; margin-bottom: 20px;">
        <?php endfor; ?>
    </div>

    <?php
    $next_chapter = $chapter + 1;
    $next_chapter_dir = "manga/$manga/chapter$next_chapter";
    if (is_dir($next_chapter_dir)): ?>
        <a href="chapter.php?manga=<?= $manga; ?>&chapter=<?= $next_chapter; ?>" class="next-chapter">Next Chapter</a>
    <?php endif; ?>

    <?php include 'footer.php'; ?>
</body>
</html>
