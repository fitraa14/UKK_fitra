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
    <style>
        .custom-card {
        width: 100%; /* Atau atur sesuai kebutuhan */
        max-width: 10000px; /* Misalnya, batas maksimum */
        margin: 0 auto; /* Centering */
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
        <!-- Tambah Foto Section -->
        <div class="row">
    <div class="col-md-12 mx-auto">
        <div class="card custom-card"> <!-- Menambahkan kelas kustom -->
            <div class="card-header">Tambah Foto</div>
            <div class="card-body">
                <form action="../config/aksi_foto.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Judul Foto</label>
                        <input type="text" name="judulfoto" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="deskripsifoto" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Album</label>
                        <select class="form-control" name="albumid" required>
                            <?php
                            $sql_album = mysqli_query($koneksi, "SELECT * FROM album WHERE userid='$userid'");
                            while ($data_album = mysqli_fetch_array($sql_album)) { ?>
                                <option value="<?php echo $data_album['albumid'] ?>"><?php echo $data_album['namaalbum'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">File</label>
                        <input type="file" class="form-control" name="lokasifile" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="tambah">Tambah data</button>
                </form>
            </div>
        </div>
    </div>
</div>

        <!-- Data Galeri Foto Section -->
        <div class="row mt-4">
            <div class="col-md-10 mx-auto">
                <div class="card">
                    <div class="card-header">Data Galeri Foto</div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Foto</th>
                                    <th>Judul Foto</th>
                                    <th>Deskripsi</th>
                                    <th width="120px">Tanggal</th>
                                    <th width="150px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $sql = mysqli_query($koneksi, "SELECT * FROM foto WHERE userid='$userid'");
                                while ($data = mysqli_fetch_array($sql)) {
                                ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><img src="../assets/img/<?php echo htmlspecialchars($data['lokasifile'], ENT_QUOTES, 'UTF-8') ?>" width="100" alt="<?php echo htmlspecialchars($data['judulfoto'], ENT_QUOTES, 'UTF-8') ?>"></td>
                                        <td><?php echo htmlspecialchars($data['judulfoto'], ENT_QUOTES, 'UTF-8') ?></td>
                                        <td><?php echo htmlspecialchars($data['deskripsifoto'], ENT_QUOTES, 'UTF-8') ?></td>
                                        <td><?php echo htmlspecialchars($data['tanggalunggah'], ENT_QUOTES, 'UTF-8') ?></td>
                                        <td>
                                            <!-- Edit Button -->
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#edit<?php echo $data['fotoid'] ?>">
                                                Edit
                                            </button>

                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="edit<?php echo $data['fotoid'] ?>" tabindex="-1" aria-labelledby="editLabel<?php echo $data['fotoid'] ?>" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editLabel<?php echo $data['fotoid'] ?>">Edit Data</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="../config/aksi_foto.php" method="POST" enctype="multipart/form-data">
                                                            <div class="modal-body">
                                                                <input type="hidden" name="fotoid" value="<?php echo $data['fotoid'] ?>">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Judul Foto</label>
                                                                    <input type="text" name="judulfoto" value="<?php echo htmlspecialchars($data['judulfoto'], ENT_QUOTES, 'UTF-8') ?>" class="form-control" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Deskripsi</label>
                                                                    <textarea class="form-control" name="deskripsifoto" required><?php echo htmlspecialchars($data['deskripsifoto'], ENT_QUOTES, 'UTF-8') ?></textarea>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Album</label>
                                                                    <select class="form-control" name="albumid" required>
                                                                        <?php
                                                                        $sql_album_edit = mysqli_query($koneksi, "SELECT * FROM album WHERE userid='$userid'");
                                                                        while ($data_album_edit = mysqli_fetch_array($sql_album_edit)) { ?>
                                                                            <option <?php if ($data_album_edit['albumid'] == $data['albumid']) echo 'selected'; ?> value="<?php echo $data_album_edit['albumid'] ?>"><?php echo htmlspecialchars($data_album_edit['namaalbum'], ENT_QUOTES, 'UTF-8') ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Foto Saat Ini</label>
                                                                    <div>
                                                                        <img src="../assets/img/<?php echo htmlspecialchars($data['lokasifile'], ENT_QUOTES, 'UTF-8') ?>" width="100" alt="<?php echo htmlspecialchars($data['judulfoto'], ENT_QUOTES, 'UTF-8') ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Ganti File (Optional)</label>
                                                                    <input type="file" class="form-control" name="lokasifile">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit" name="edit" class="btn btn-primary">Simpan Perubahan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Hapus Button -->
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus<?php echo $data['fotoid'] ?>">
                                                Hapus
                                            </button>

                                            <!-- Hapus Modal -->
                                            <div class="modal fade" id="hapus<?php echo $data['fotoid'] ?>" tabindex="-1" aria-labelledby="hapusLabel<?php echo $data['fotoid'] ?>" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="hapusLabel<?php echo $data['fotoid'] ?>">Hapus Data</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="../config/aksi_foto.php" method="POST">
                                                            <div class="modal-body">
                                                                <input type="hidden" name="fotoid" value="<?php echo $data['fotoid'] ?>">
                                                                Apakah Anda yakin ingin menghapus data <strong><?php echo htmlspecialchars($data['judulfoto'], ENT_QUOTES, 'UTF-8') ?></strong>?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit" name="hapus" class="btn btn-danger">Hapus</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <?php
                        if (mysqli_num_rows($sql) == 0) {
                            echo '<p class="text-center">Tidak ada data galeri foto.</p>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="d-flex justify-content-center border-top mt-3 bg-light fixed-bottom">
        <p>&copy; UKK RPL | 2024</p>
    </footer>

    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>
