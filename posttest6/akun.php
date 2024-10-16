<?php
require 'koneksi.php';
session_start();


if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit;
}

$email = $_SESSION['email'];
$query = "SELECT * FROM data_akun WHERE email = '$email'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);
$show_edit_form = false;


if (isset($_POST['edit'])) {
    $show_edit_form = true;
}


if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $usia = $_POST['usia'];
    
    
    $update_query = "UPDATE data_akun SET nama='$nama', usia='$usia'";

    
    if (!empty($_POST['pass'])) {
        $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
        $update_query .= ", pass='$pass'";
    }

    
    if (!empty($_FILES['foto']['name'])) {
        $foto = $_FILES['foto']['name'];
        $file_tmp = $_FILES['foto']['tmp_name'];
        $file_size = $_FILES['foto']['size'];
        
        
        $max_size = 5 * 1024 * 1024;
        if ($file_size > $max_size) {
            echo "<script>alert('File terlalu besar! Maksimum 5MB.');</script>";
            exit;
        }
        
        
        $new_file_name = date('Y-m-d H.i.s') . '.' . pathinfo($foto, PATHINFO_EXTENSION);
        move_uploaded_file($file_tmp, "images/" . $new_file_name);

        
        $update_query .= ", foto='$new_file_name'";
        
        
        if (!empty($data['foto'])) {
            unlink("images/" . $data['foto']);
        }
    }

    
    $update_query .= " WHERE email='$email'";
    mysqli_query($conn, $update_query);
    echo "<script>alert('Akun diperbarui!');</script>";
    header("Refresh:0");
}


if (isset($_POST['delete'])) {
    
    if (!empty($data['foto'])) {
        unlink("images/" . $data['foto']);
    }

    
    $delete_query = "DELETE FROM data_akun WHERE email='$email'";
    mysqli_query($conn, $delete_query);
    session_destroy();
    header('Location: register.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZManga - Akun</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <?php include 'navbar.php'; ?>
</header>

<main>
    <section class="register-section">
        <div class="register-container">
            <h1>Informasi Akun</h1>

            <?php if (!$show_edit_form): ?>
                <ul>
                    <li>
                        <?php if (!empty($data['foto'])): ?>
                            <img src="images/<?php echo $data['foto']; ?>" alt="Foto Profil" width="320">
                        <?php else: ?>
                            Tidak ada foto profil
                        <?php endif; ?>
                    </li>
                    <li><strong>Username:</strong> <?php echo $data['nama']; ?></li>
                    <li><strong>Usia:</strong> <?php echo $data['usia']; ?></li>
                    <li><strong>Email:</strong> <?php echo $data['email']; ?></li>
                </ul>

                <form method="POST">
                    <input type="submit" name="edit" value="Edit Akun" class="button">
                    <input type="submit" name="delete" value="Hapus Akun" class="button delete" onclick="return confirm('Apakah Anda yakin ingin menghapus akun ini?')">
                </form>
            <?php else: ?>
                <form action="akun.php" method="POST" enctype="multipart/form-data" class="register-form">
                    <label for="foto">Ganti Foto Profil</label>
                    <input type="file" id="foto" name="foto" accept="image/*">

                    <label for="username">Username</label>
                    <input type="text" id="username" name="nama" value="<?php echo $data['nama']; ?>" required>
                    
                    <label for="usia">Usia</label>
                    <input type="number" id="usia" name="usia" value="<?php echo $data['usia']; ?>" required>

                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo $data['email']; ?>" readonly>

                    <label for="pass">Password (kosongkan jika tidak ingin mengubah)</label>
                    <input type="password" id="pass" name="pass" placeholder="Masukkan password baru jika ingin mengubah">


                    <input type="submit" value="Update Akun" name="update" class="button">
                </form>
            <?php endif; ?>
        </div>
    </section>
</main>

<footer>
    <?php include 'footer.php'; ?>
</footer>

</body>
</html>
