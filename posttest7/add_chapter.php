<?php
require 'koneksi.php';
if (isset($_SESSION["lgin"]) || $_SESSION["login"]!== true || $_SESSION['role'] !== 'admin') {
    header('location:index.php ');
    exit;
}
$manga_id = isset($_GET['manga_id']) ? intval($_GET['manga_id']) : null;

$query_manga = "SELECT * FROM manga";
$result_manga = mysqli_query($conn, $query_manga);
$mangas = [];
while ($row = mysqli_fetch_assoc($result_manga)) {
    $mangas[] = $row;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $manga_id = intval($_POST['manga_id']);
    $chapter_number = intval($_POST['chapter_number']);
    $chapter_title = mysqli_real_escape_string($conn, $_POST['chapter_title']);
    $total_pages = count($_FILES['pages']['name']);
    
    $query_judul = "SELECT judul FROM manga WHERE id = $manga_id";
    $result_judul = mysqli_query($conn, $query_judul);
    $manga = mysqli_fetch_assoc($result_judul);
    $judul_manga = preg_replace("/[^a-zA-Z0-9]/", '_', $manga['judul']);

    $chapter_dir = "manga/$judul_manga/chapter$chapter_number";
    
    if (!is_dir($chapter_dir)) {
        mkdir($chapter_dir, 0777, true);
    }

    for ($i = 0; $i < $total_pages; $i++) {
        $page_name = "{$chapter_number}-" . ($i + 1) . ".jpg";
        if (!move_uploaded_file($_FILES['pages']['tmp_name'][$i], "$chapter_dir/$page_name")) {
            echo "Error uploading page " . ($i + 1);
        }
    }
    
    $query = "INSERT INTO chapter (manga_id, chapter_number, title, total_pages)
              VALUES ('$manga_id', '$chapter_number', '$chapter_title', '$total_pages')";

    if (mysqli_query($conn, $query)) {
        header("Location: detail_manga.php?id=$manga_id");
        exit();
    } else {
        echo "Gagal menambahkan chapter: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Chapter - Admin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header> <?php include 'navbar.php'; ?></header>
    <main>
        <section class="register-section">
            <div class="register-container">
                <h1>Tambah Chapter Baru</h1>
                <form action="add_chapter.php" method="post" enctype="multipart/form-data">
                    <label for="manga_id">Pilih Manga:</label>
                    <select name="manga_id" id="manga_id" required>
                        <?php foreach ($mangas as $manga): ?>
                            <option value="<?= $manga['id']; ?>" <?= $manga['id'] == $manga_id ? 'selected' : ''; ?>>
                                <?= $manga['judul']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select><br><br>
                    
                    <label for="chapter_number">Nomor Chapter:</label>
                    <input type="number" name="chapter_number" id="chapter_number" required><br><br>
                    
                    <label for="chapter_title">Judul Chapter:</label>
                    <input type="text" name="chapter_title" id="chapter_title" required><br><br>
                    
                    <label for="pages">Halaman Chapter :</label>
                    <input type="file" name="pages[]" id="pages" multiple accept="image/*" required><br><br>
                    
                    <input type="submit" value="Tambah Chapter">
                </form>
            </div>
        </section>
    </main>
</body>
</html>
