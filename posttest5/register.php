<?php
require 'koneksi.php';
session_start();

if (isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $usia = $_POST['usia'];
    $email = $_POST['email'];
    $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT); 

    $query = "INSERT INTO data_akun (nama, usia, email, pass) VALUES ('$nama', '$usia', '$email', '$pass')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $_SESSION['email'] = $email;
        echo "<script>alert('Berhasil mendaftarkan akun!');</script>";
        header('Location: index.php');
    } else {
        echo "<script>alert('Gagal mendaftarkan akun!');</script>";
    }
}
?>
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
                <form action="" method="POST" class="register-form">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="nama" required placeholder="Masukkan username" required>

                    <label for="usia">Usia</label>
                    <input type="number" id="age" name="usia" required placeholder="Masukkan usia">

                    <label for="Email">Email</label>
                    <input type="Email" id="Email" name="email" placeholder="Masukkan Email" required>

                    <label for="pass">Password</label>
                    <input type="password" id="password" name="pass" placeholder="Masukkan Password" required>

                    <input type="submit" value="Tambah" name="tambah" class="button">
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
