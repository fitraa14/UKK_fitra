<?php
session_start();
$userid = $_SESSION['userid'];
include '../config/koneksi.php';
if ($_SESSION['status'] != 'login')
  echo "<script>
    alert ('Anda belum login!');
    location.href='../index.php';
    </script>";

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>WEB GALERI FOTO</title>
  <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
  <style>
    .card {
        transition: transform 0.2s ease;
    }

    .card:hover {
        transform: scale(1.05);
        cursor: pointer;
    }
    .card {
        border: 2px solid #ddd; /* Bingkai */
        border-radius: 8px;
        transition: transform 0.2s ease; /* Efek transisi */
    }

    .card:hover {
        transform: scale(1.05); /* Efek zoom saat hover */
    }

    .card-img-top {
        height: 12rem; /* Tinggi gambar yang lebih kecil */
        object-fit: cover; /* Memastikan gambar tetap terpotong dengan baik */
        border-radius: 8px 8px 0 0; /* Hanya radius pada bagian atas */
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
        <a href="home.php" class="nav-link" style="color: #ffffff;">Home</a>
        <a href="album.php" class="nav-link" style="color: #ffffff;">Album</a>
        <a href="foto.php" class="nav-link" style="color: #ffffff;">Foto</a>
      </div>
      <a href="../config/aksi_logout.php" class="btn btn-outline-danger m-1" style="border-radius: 20px; color: #ff0000;">Keluar</a>
    </div>
  </div>
</nav>

<div class="container mt-4">
<div class="row">
    <?php
    $query = mysqli_query($koneksi, "SELECT * FROM foto INNER JOIN user ON foto.userid=user.userid INNER JOIN album ON foto.albumid=album.albumid");
    while ($data = mysqli_fetch_array($query)) { ?>
        <div class="col-md-3 mt-2">
            <a type="button" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['fotoid'] ?>">
                <div class="card mb-2">
                    <img src="../assets/img/<?php echo $data['lokasifile'] ?>" class="card-img-top" title="<?php echo $data['judulfoto'] ?>">
                    <div class="card-footer text-center" style="background-color: #ffffff;">
                        <!-- Tambahkan judul foto di sini -->
                        <div style="font-weight: bold; margin-bottom: 5px;">
                            <?php echo $data['judulfoto'] ?>
                        </div>
                        
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <div>
                                <?php
                                $fotoid = $data['fotoid'];
                                $ceksuka = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid' AND userid='$userid'");
                                if (mysqli_num_rows($ceksuka) == 1) { ?>
                                    <a href="../config/proses_like.php?fotoid=<?php echo $data['fotoid'] ?>"><i class="fa fa-heart" style="color: #e0245e;"></i></a>
                                <?php } else { ?>
                                    <a href="../config/proses_like.php?fotoid=<?php echo $data['fotoid'] ?>"><i class="fa-regular fa-heart"></i></a>
                                <?php }
                                $like = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid'");
                                echo '<span>' . mysqli_num_rows($like) . ' Suka</span>';
                                ?>
                            </div>
                            <a href="#" type="button" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['fotoid'] ?>"><i class="fa-regular fa-comment"></i></a>
                            <?php
                            $jmlkomen = mysqli_query($koneksi, "SELECT * FROM komentarfoto WHERE fotoid='$fotoid'");
                            echo '<span>' . mysqli_num_rows($jmlkomen) . ' Komentar</span>';
                            ?>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Modal untuk komentar -->
            <div class="modal fade" id="komentar<?php echo $data['fotoid'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <img src="../assets/img/<?php echo $data['lokasifile'] ?>" class="img-fluid" title="<?php echo $data['judulfoto'] ?>" style="border-radius: 8px;">
                                </div>
                                <div class="col-md-4">
                                    <div class="m-2">
                                        <strong><?php echo $data['judulfoto'] ?></strong><br>
                                        <span class="badge bg-secondary"><?php echo $data['namalengkap'] ?></span>
                                        <span class="badge bg-secondary"><?php echo $data['tanggalunggah'] ?></span>
                                        <span class="badge bg-primary"><?php echo $data['namaalbum'] ?></span>
                                        <hr>
                                        <p><?php echo $data['deskripsifoto'] ?></p>
                                        <hr>
                                        <?php
                                        $fotoid = $data['fotoid'];
                                        $komentar = mysqli_query($koneksi, "SELECT * FROM komentarfoto INNER JOIN user ON komentarfoto.userid=user.userid WHERE komentarfoto.fotoid='$fotoid'");
                                        while ($row = mysqli_fetch_array($komentar)) {
                                        ?>
                                            <p><strong><?php echo $row['namalengkap'] ?></strong> <?php echo $row['isikomentar'] ?></p>
                                        <?php } ?>
                                        <hr>
                                        <form action="../config/proses_komentar.php" method="POST">
                                            <div class="input-group">
                                                <input type="hidden" name="fotoid" value="<?php echo $data['fotoid'] ?>">
                                                <input type="text" name="isikomentar" class="form-control" placeholder="Tambah Komentar">
                                                <button type="submit" name="kirimkomentar" class="btn btn-outline-primary">Kirim</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
</div>


  <footer class="d-flex justify-content-center border-top mt-3 bg-light fixed-bottom">
    <p>&copy; ukk rpl | 2024</p>
  </footer>

  <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
</body>

</html>