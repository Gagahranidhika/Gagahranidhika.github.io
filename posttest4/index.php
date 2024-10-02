<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZManga - Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <!-- Navbar -->
        <?php include 'navbar.php'; ?>
    </header>

    <main>
        <section class="manga-grid">
            <div class="manga-item">
                <img src="Komik-One-Piece.jpg" alt="One Piece">
                <div class="manga-info">
                    <h3><a href="manga-detail.php">One Piece</a></h3>
                    <ul class="chapter-list">
                        <li><a href="chapter.php">Ch. 1</a> <span>59 seconds ago</span></li>
                    </ul>
                </div>
            </div>
            <div class="manga-item">
                <img src="Manga-Naruto.jpg" alt="Naruto">
                <div class="manga-info">
                    <h3><a href="manga-detail.php">Naruto</a></h3>
                    <ul class="chapter-list"></ul>
                </div>
            </div>
        </section>
    </main>

    <div class="menu-overlay" onclick="closePopup()"></div>

    <div class="popup" id="mangaPopup">
        <div class="popup-content">
            <span class="close" onclick="closePopup()">&times;</span>
            <h2>Chapter Baru Telah Dirilis!</h2>
            <p>Chapter 1 dari <strong>One Piece</strong> sudah tersedia untuk dibaca sekarang!</p>
            <a href="chapter.php" class="read-button">Baca Sekarang</a>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <?php include 'footer.php'; ?>
    </footer>

    <script src="script.js"></script>
</body>
</html>
