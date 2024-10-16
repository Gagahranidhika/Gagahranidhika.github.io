<?php
require 'koneksi.php';
session_start();

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    
    $query = "SELECT * FROM data_akun WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);

    if ($data && password_verify($pass, $data['pass'])) {
        $_SESSION['email'] = $email;
        echo "<script>alert('Login berhasil!');</script>";
        header('Location: index.php'); 
    } else {
        echo "<script>alert('Login gagal, periksa email atau password Anda.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>ZManga - Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <?php include 'navbar.php'; ?>
    </header>
    <main>
        <section class="register-section">
            <div class="register-container">
                <h1>Login Akun ZManga</h1>
                <form action="login.php" method="POST" class="register-form">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required placeholder="Masukkan email">
                    
                    <label for="pass">Password</label>
                    <input type="password" id="password" name="pass" required placeholder="Masukkan password">
                    
                    <input type="submit" value="Login" name="login" class="button">
                </form>
            </div>
        </section>
    </main>
    <footer>
        <?php include 'footer.php'; ?>
    </footer>
</body>
</html>
