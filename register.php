<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WEB GALERI FOTO</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <style>
        body {
            background-color: #fafafa;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .card-body {
            padding: 2rem;
        }
        .btn-primary {
            background-color: #0095f6;
            border: none;
        }
        .btn-primary:hover {
            background-color: #007bbf;
        }
        .footer-text {
            color: #8e8e8e;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg" style="background-color: #001f3f; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php" style="font-size: 24px; font-weight: bold; color: #ffffff;">GALERI FOTO</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-nav me-auto">
        <a href="login.php" class="nav-link text-white">Home</a>        
        <a href="login.php" class="nav-link text-white">Album</a>
        <a href="login.php" class="nav-link text-white">Foto</a>
    </div>
  </div>
</nav>

<div class="container py-5" style="max-width: 10000px;">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body" style="background-color: #001f3f;">
                    <div class="text-center">
                        <alt style="width: 100px; margin-bottom: 20px;">
                        <h5 style="color: white;">Registrasi</h5>
                    </div>
                    <form action="config/aksi_register.php" method="POST">
                        <label class="form-label" style="color: white;">Username</label>
                        <input type="text" name="username" class="form-control" required>
                        <label class="form-label" style="color: white;">Password</label>
                        <input type="password" name="password" class="form-control" required>
                        <label class="form-label" style="color: white;">Email</label>
                        <input type="email" name="email" class="form-control" required>
                        <label class="form-label" style="color: white;">Nama Lengkap</label>
                        <input type="text" name="namalengkap" class="form-control" required>
                        <label class="form-label" style="color: white;">Alamat</label>
                        <input type="text" name="alamat" class="form-control" required>
                        <div class="mt-4">
                            <button class="btn btn-primary btn-block" type="submit" name="kirim">DAFTAR</button>
                        </div>
                    </form> 
                    <hr>
                    <p class="text-center footer-text" style="color: white;">Sudah punya akun? <a href="login.php" style="color: #FFD700;">Login disini!</a></p>
                </div>
            </div>
        </div>
    </div>
</div>


<footer class="d-flex justify-content-center border-top mt-3 bg-light fixed-bottom">
    <p class="footer-text">&copy; UKK RPL | 2024</p>
</footer>

<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
</body>
</html>
