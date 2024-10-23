<?php
require 'koneksi.php';
session_start();

if (isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
    $usia = $_POST['usia'];
    $email = $_POST['email'];
    $role = "user";

    
    $foto = $_FILES['foto']['name'];
    $file_tmp = $_FILES['foto']['tmp_name'];
    $file_size = $_FILES['foto']['size'];
    
    $validExtension = ['jpg', 'jpeg', 'png'];
    $fileExtension = explode('.', $foto);
    $fileExtension = strtolower(end($fileExtension));

    if (!in_array($fileExtension, $validExtension)){
        echo"
            <script>
                alert('Tolong Upload Gambar jpg, jpeg, png')
            </script>
        ";
    } else {
        $max_size = 5 * 1024 * 1024;
        if ($file_size > $max_size) {
            echo "<script>alert('File terlalu besar! Maksimum 5MB.');</script>";
            exit;
        }
        $new_file_name = date('Y-m-d H.i.s') . '.' . pathinfo($foto, PATHINFO_EXTENSION);
        if(move_uploaded_file($file_tmp, "images/" . $new_file_name)){
            $query = "INSERT INTO data_akun (nama, usia, email, pass, foto, roles) VALUES ('$nama', '$usia', '$email', '$pass', '$new_file_name', '$role')";
            
            if (mysqli_query($conn, $query)) {
                $_SESSION['login'] = true;
                $_SESSION['roles'] = $role;
                $_SESSION['email'] = $email;
                header('Location: index.php');
            } else {
                echo "<script>alert('Gagal mendaftarkan akun!');</script>";
            }

    

        }
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
                <form action="" method="POST" enctype="multipart/form-data" class="register-form">

                    <label for="foto">Upload Foto Profil</label>
                    <input type="file" id="foto" name="foto">
                    
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
