<?php
require 'koneksi.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start(); 
}

// Menyiapkan query dasar untuk mengambil semua manga
$query = "SELECT * FROM manga";
$mangas = [];

// Jika form pencarian di-submit
if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    // Query SQL untuk mencari berdasarkan judul, sinopsis, atau genre
    $query = "SELECT * FROM manga WHERE judul LIKE '%$search%' OR sinopsis LIKE '%$search%' OR genre LIKE '%$search%'";
}

$result = mysqli_query($conn, $query);

// Memasukkan hasil ke array $mangas
while ($row = mysqli_fetch_assoc($result)) {
    $mangas[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZManga - Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <main>
    <section class="manga-grid">
        <?php if (!empty($mangas)): ?>
            <?php foreach($mangas as $manga): ?>
            <div class="manga-item">
                <img src="cover/<?= $manga['cover_image']; ?>" alt="<?= $manga['judul']; ?>">
                <div class="manga-info">
                    <h3><a href="detail_manga.php?id=<?= $manga['id']; ?>"><?= $manga['judul']; ?></a></h3>
                    <p><?= $manga['genre']; ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Manga tidak ditemukan.</p>
        <?php endif; ?>
    </section>
    </main>


    <?php if (isset($_SESSION['login'])&&$_SESSION["roles"] === "admin"):?>
    <a href="add_manga.php" class="add-button">
        <div class="plus">+</div>
    </a>
    <?php endif; ?>

    <?php include 'footer.php'; ?>
</body>
</html>
