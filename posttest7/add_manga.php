<?php
require 'koneksi.php';
if (isset($_SESSION["lgin"]) || $_SESSION["login"]!== true || $_SESSION['role'] !== 'admin') {
    header('location:index.php ');
    exit;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $sinopsis = mysqli_real_escape_string($conn, $_POST['sinopsis']);
    $genre = mysqli_real_escape_string($conn, $_POST['genre']);

    $judulDir = "manga/" . preg_replace("/[^a-zA-Z0-9]/", '_', $judul) . "/";
    
    
    if (!file_exists($judulDir)) {
        mkdir($judulDir, 0777, true);
    }
    
    $coverDir = "cover/";
    if (!file_exists($coverDir)) {
        mkdir($coverDir, 0777, true);
    }

    $cover_image = $_FILES['cover_image']['name'];
    $target_file = $coverDir . basename($cover_image);
    move_uploaded_file($_FILES['cover_image']['tmp_name'], $target_file);

    $query = "INSERT INTO manga (judul, sinopsis, genre, cover_image) VALUES ('$judul', '$sinopsis', '$genre', '$cover_image')";

    if (mysqli_query($conn, $query)) {
        echo "
        <script>
        alert('Berhasil menambahkan manga');
        document.location.href = 'index.php';
        </script>
        ";
    } else {
        echo "Gagal menambahkan manga: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Manga - Admin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <?php include 'navbar.php'; ?>
    </header>

    <main>
        <section class="register-section">
            <div class="register-container">
                <h1>Tambah Manga Baru</h1>
                <form action="add_manga.php" method="post" enctype="multipart/form-data">
                    <label for="judul">Judul:</label>
                    <input type="text" name="judul" id="judul" required><br><br>
                    
                    <label for="sinopsis">Deskripsi:</label>
                    <textarea name="sinopsis" id="sinopsis" required></textarea><br><br>
                    
                    <label for="genre">Genre:</label>
                    <input type="text" name="genre" id="genre" required><br><br>
                    
                    <label for="cover_image">Cover Image:</label>
                    <input type="file" name="cover_image" id="cover_image" required><br><br>
                    
                    <input type="submit" value="Tambah Manga">
                </form>
            </div>
        </section>
    </main>

</body>
</html>
