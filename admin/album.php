    <?php
    session_start();
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
        <style>
             .modal-dialog {
        max-width: 400px; /* Sesuaikan ukuran lebar */
    }
        </style>
    </head>

    <body>
    <nav class="navbar navbar-expand-lg" style="background-color: #ffffff; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php" style="font-size: 24px; font-weight: bold; color: #262626;">GALERI FOTO</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav me-auto">
        <!-- <a href="home.php" class="nav-link" style="color: #262626;">Home</a>         -->
        <a href="album.php" class="nav-link" style="color: #262626;">Album</a>
        <a href="foto.php" class="nav-link" style="color: #262626;">Foto</a>
      </div>
      <a href="../config/aksi_logout.php" class="btn btn-outline-danger m-1" style="border-radius: 20px; color: #ff0000;">Keluar</a>
    </div>
  </div>
</nav>
        <div class="container">
            <div class="row">
            <div class="card mt-2">
    <div class="card-header text-center">Tambah Album</div>
    <div class="card-body">
        <form action="../config/aksi_album.php" method="POST">
            <div class="mb-3">
                <label class="form-label">Nama Album</label>
                <input type="text" name="namaalbum" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea class="form-control" name="deskripsi" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary w-100" name="tambah">Tambah Album</button>
        </form>
    </div>
</div>
                <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Modal untuk Tambah Album -->
            <div class="modal fade" id="tambahAlbum" tabindex="-1" aria-labelledby="tambahAlbumLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahAlbumLabel">Tambah Album Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../config/aksi_album.php" method="POST">
                    <label class="form-label">Nama Album</label>
                    <input type="text" name="namaalbum" class="form-control" required>
                    <label class="form-label mt-2">Deskripsi</label>
                    <textarea class="form-control" name="deskripsi" required></textarea>
            </div>
            <div class="modal-footer">
                <button type="submit" name="tambah" class="btn btn-primary">Tambah Album</button>
                </form>
            </div>
        </div>
    </div>
</div> 
</div> 
<br>

            <!-- Data Album -->
            <div class="card mt-2">
                <div class="card-header">Data Album</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Album</th>
                                <th>Deskripsi</th>
                                <th width="120px">Tanggal</th>
                                <th width="150px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $userid = $_SESSION['userid'];
                            $sql = mysqli_query($koneksi, "SELECT * FROM album WHERE userid='$userid'");
                            while ($data = mysqli_fetch_array($sql)) {
                            ?>
                                <tr>   
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $data['namaalbum'] ?></td>
                                    <td><?php echo $data['deskripsi'] ?></td>
                                    <td><?php echo $data['tanggalbuat'] ?></td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit<?php echo $data['albumid'] ?>">
                                            Edit
                                        </button>

                                        <!-- Modal Edit Album -->
                                        <div class="modal fade" id="edit<?php echo $data['albumid'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="../config/aksi_album.php" method="POST">
                                                            <input type="hidden" name="albumid" value="<?php echo $data['albumid'] ?>">
                                                            <label class="form-label">Nama Album</label>
                                                            <input type="text" name="namaalbum" value="<?php echo $data['namaalbum'] ?>" class="form-control" required>
                                                            <label class="form-label">Deskripsi</label>
                                                            <textarea class="form-control" name="deskripsi" required><?php echo $data['deskripsi']; ?></textarea>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" name="edit" class="btn btn-primary">Edit Data</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus<?php echo $data['albumid'] ?>">
                                            Hapus
                                        </button>

                                        <!-- Modal Hapus Album -->
                                        <div class="modal fade" id="hapus<?php echo $data['albumid'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="../config/aksi_album.php" method="POST">
                                                            <input type="hidden" name="albumid" value="<?php echo $data['albumid'] ?>">
                                                            Apakah anda yakin ingin menghapus data <strong> <?php echo $data['namaalbum'] ?> </strong>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" name="hapus" class="btn btn-primary">Hapus Data</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


            </div>
        </div>
        </div>


        <footer class="d-flex justify-content-center border-top mt-3 bg-light fixed-bottom">
            <p>&copy; UKK RPL| 2024</p>
        </footer>

        <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
    </body>

    </html>