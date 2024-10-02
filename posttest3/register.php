<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZManga - Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <?php include 'navbar.php'; ?>
    </header>

    <main>
        <section class="register-section">
            <div class="register-container">
                <h1>Register Akun ZManga</h1>
                <form action="welcome.php" method="POST" class="register-form">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required placeholder="Masukkan username">

                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required placeholder="Masukkan password">

                    <label for="age">Usia</label>
                    <input type="number" id="age" name="age" required placeholder="Masukkan usia">

                    <label for="favoriteManga">Manga Favorit</label>
                    <input type="text" id="favoriteManga" name="favoriteManga" placeholder="Masukkan manga favorit">

                    <button type="submit" class="submit-button">Daftar</button>
                </form>
            </div>
        </section>
    </main>

    <footer>
        <?php include 'footer.php'; ?>
    </footer>

    <script src="script.js"></script>
</body>
</html>
