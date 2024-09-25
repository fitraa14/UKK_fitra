<?php
include 'koneksi.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $namalengkap = mysqli_real_escape_string($koneksi, $_POST['namalengkap']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);

    // Cek apakah username sudah ada di database
    $checkQuery = mysqli_query($koneksi, "SELECT username FROM user WHERE username = '$username'");
    
    if (mysqli_num_rows($checkQuery) > 0) {
        // Jika username sudah terdaftar
        echo "<script>
        alert('Username sudah terdaftar, silakan gunakan username lain.');
        location.href='../register.php';
        </script>";
    } else {
        // Jika username belum ada, lanjutkan proses penyimpanan
        $sql = mysqli_query($koneksi, "INSERT INTO user (username, password, email, namalengkap, alamat) 
        VALUES ('$username','$password','$email','$namalengkap','$alamat')");

        if ($sql) {
            echo "<script>
            alert('Pendaftaran akun berhasil');
            location.href='../login.php';
            </script>";
        } else {
            echo "<script>
            alert('Gagal mendaftarkan akun, coba lagi.');
            location.href='../register.php';
            </script>";
        }
    }
}
?>
