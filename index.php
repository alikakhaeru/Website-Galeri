<!-- INDEX.PHP -->

<?php
include 'config/koneksi.php';


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Galeri foto</title>
    <!-- link bootstrap css -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
</head>
<body>
<!-- menambahkan bootstrap navbar -->
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container">
    <a class="navbar-brand" href="index.php">Website Galeri foto</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
     aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Untuk mengatur tampilan navbar diatas -->
    <div class="collapse navbar-collapse mt-2" id="navbarNavAltMarkup">
      <div class="navbar-nav me-auto">
       
      </div>
      <a href="register.php" class="btn btn-outline-primary m-1">
        Daftar
      </a>
      <!-- coppy dari atas yang membedakan cuma success -->
      <a href="login.php" class="btn btn-outline-success m-1">
        Masuk
      </a>
    </div>
  </div>
</nav>

<!-- CONTAINER -->
<div class="container mt-2">
    <div class="row">
      <?php
      $query = mysqli_query($koneksi, "SELECT * FROM foto INNER JOIN user ON foto.userid=user.userid INNER JOIN album ON foto.albumid=album.albumid");
      while ($data = mysqli_fetch_array($query)) {
      ?>
        <div class="col-md-3 mt-2">
          <a type="button" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['fotoid'] ?>">

            <div class="card">
              <img style="height: 12rem;" src="assets/img/<?php echo $data['lokasifile'] ?> " class="card-img-top" title="<?php echo $data['judulfoto'] ?>">
              <div class="card-footer text-center">

                <?php
                $fotoid = $data['fotoid'];
                ?>
                  <a href="#" type="submit" name="suka">
                    <i class="fa-regular fa-heart"></i></a>

                <?php 
                $like = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid'");
                echo mysqli_num_rows($like) . 'suka';
                ?>
                <a class="text-primary" type="button" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['fotoid'] ?>"><i class="fa-regular fa-comment"></i></a>
                <?php
                $jlmkomen = mysqli_query($koneksi,"SELECT * FROM komentarfoto WHERE fotoid='$fotoid'");
                echo mysqli_num_rows($jlmkomen).' komentar';
                ?>
              </div>
            </div>
          </a>
          <div class="modal fade" id="komentar<?php echo $data['fotoid'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-8">
                      <img src="assets/img/<?php echo $data['lokasifile'] ?> " class="card-img-top" title="<?php echo $data['judulfoto'] ?>">
                    </div>
                    <div class="col-md-4">
                      <div class="m-2">
                        <div class="overflow-auto">
                          <div class="sticky-top">
                          <strong>Judul</strong><br>
                            <strong><?php echo $data['judulfoto'] ?></strong><br>
                            <span class="badge bg-secondary"><?php echo $data['namalengkap'] ?></span>
                            <span class="badge bg-secondary"><?php echo $data['tanggalunggah'] ?></span>
                            <span class="badge bg-primary"><?php echo $data['namaalbum'] ?></span>
                          </div>
                          <hr>
                          <strong>Deskripsi</strong>
                          <p align="left"><?php echo $data['deskripsifoto'] ?></p>
                          <hr>
                          <strong>Komentar</strong>
                          <?php
                          $fotoid = $data['fotoid'];
                          $komentar = mysqli_query($koneksi, "SELECT * FROM komentarfoto
                          INNER JOIN user ON komentarfoto.userid=user.userid WHERE komentarfoto.fotoid='$fotoid'");
                          while ($row = mysqli_fetch_array($komentar)) {
                          ?>
                            <p align="left">
                              <strong><?php echo $row['namalengkap'] ?></strong>
                              <small><?php echo $row['tanggalkomentar'] ?></small><br>
                              <?php echo $row['isikomentar'] ?>
                            </p>
                          <?php } ?>
                          <hr>
                        </div>
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

<!-- Footer -->
<footer class="d-flex justify-content-center border-top mt-3 bg-light fixed-bottom">
    <p>&copy; UKK RPL 2024 | Alika Khaeru </p>
</footer>
<!-- link bootstrap js -->
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>

</body>
</html>