<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZManga - Welcome</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <?php include 'navbar.php'; ?>
    </header>

    <main>
        <section class="welcome-section">
            <div class="welcome-container">
                <h1>Selamat Bergabung, <?php echo htmlspecialchars($_POST['username']); ?>!</h1>
                <p>Selamat datang di komunitas ZManga!</p>
                <ul>
                    <li><strong>Username:</strong> <?php echo htmlspecialchars($_POST['username']); ?></li>
                    <li><strong>Usia:</strong> <?php echo htmlspecialchars($_POST['age']); ?></li>
                    <li><strong>Manga Favorit:</strong> <?php echo htmlspecialchars($_POST['favoriteManga']); ?></li>
                </ul>
                <a href="index.php" class="return-button">Kembali ke Home</a>
            </div>
        </section>
    </main>

    <footer>
        <?php include 'footer.php'; ?>
    </footer>

    <script src="script.js"></script>
</body>
</html>
