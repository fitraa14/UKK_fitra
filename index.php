<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WEB GALERI FOTO</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <style>
      .btn:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3);
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
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav me-auto">
        <a href="login.php" class="nav-link" style="color: #ffffff;">Home</a>
        <a href="login.php" class="nav-link" style="color: #ffffff;">Album</a>
        <a href="login.php" class="nav-link" style="color: #ffffff;">Foto</a>
      </div>
      <a href="../config/aksi_logout.php" class="btn btn-outline-danger m-1" style="border-radius: 20px; color: #ff0000;">Keluar</a>
    </div>
  </div>
</nav>


<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card text-center" style="background-color: #001f3f; border-radius: 15px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);">
                <div class="card-body p-5" style="color: #ffffff;">
                    <h2 class="card-title" style="font-weight: bold; font-size: 2.5rem;">Selamat Datang di Galeri Foto!</h2>
                    <p class="card-text mt-3" style="font-size: 1.2rem;">
                        Temukan keindahan dan cerita di balik setiap foto yang kami sajikan. 
                        Bergabunglah dengan komunitas kami dan bagikan momen berharga Anda!
                    </p>
                    <div class="mt-4">
                        <a href="login.php" class="btn btn-light px-4 py-2" 
                           style="border-radius: 30px; font-size: 1.1rem; transition: all 0.3s ease;">
                            Login
                        </a>
                        <a href="register.php" class="btn btn-outline-light px-4 py-2" 
                           style="border-radius: 30px; margin-left: 15px; font-size: 1.1rem; transition: all 0.3s ease;">
                            Registrasi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<footer class="d-flex justify-content-center border-top mt-3 bg-light fixed-bottom">
  <p>&copy; UKK RPL| 2024</p>
</footer>

<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
</body>
</html>
