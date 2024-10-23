<?php
session_start();
require 'koneksi.php';
// admin@gmail.com
// Admin123
if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $pass = $_POST["pass"];
    
    $query = "SELECT * FROM data_akun WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) === 1){
      $user = mysqli_fetch_assoc($result);
      if (password_verify($pass, $user['pass'])) {
        $_SESSION['login'] = true;
        $_SESSION['email'] = $email;
        if ($user['roles'] === 'admin') {
            $_SESSION['roles'] = 'admin'; 
            echo "
            <script>
            alert('Login berhasil! Selamat datang Admin.');
            document.location.href = 'index.php';
            </script>
            ";
          } else {
            $_SESSION['roles'] = 'user'; 
            echo "
            <script>
            alert('Login berhasil! Selamat datang User.');
            document.location.href = 'index.php';
            </script>
            ";
          }
        } else {
          echo "
          <script>
          alert('Password salah!');
          </script>
          ";
        }
    } else {
      echo "
      <script>
      alert('email tidak ditemukan!');
      </script>
      ";
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
                    <label for="email">email</label>
                    <input type="text" id="email" name="email" required placeholder="Masukkan email">
                    
                    <label for="pass">Password</label>
                    <input type="password" id="pass" name="pass" required placeholder="Masukkan password">
                    
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
