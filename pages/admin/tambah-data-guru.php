<?php
include '../../includes/db.php';
session_start();

// $id = $_GET['id'];
// $data = mysqli_query($conn, "SELECT * FROM siswa WHERE id = $id");
// $siswa = mysqli_fetch_assoc($data);

// Handle tambah
if (isset($_POST['tambah'])) {
  $nip = $_POST['nip'];
  $nama = $_POST['nama'];
  $mapel = $_POST['mapel'];
  $jenis_kelamin = $_POST['jenis_kelamin'];
  $no_hp = $_POST['no_hp'];
  $email = $_POST['email'];

  $query = "INSERT INTO guru (nip, nama, mapel, jenis_kelamin, no_hp, email) 
            VALUES ('$nip', '$nama', '$mapel', '$jenis_kelamin', '$no_hp', '$email')";

  mysqli_query($conn, $query);
  header("Location: data-guru.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Tambah Guru</title>
  <link rel="icon" type="image/x-icon" href="../../assets/images/ihbs-logo.png">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<!-- <?php include 'includes/sidebar.php'; ?> -->

<nav class="navbar navbar-expand-lg navbar-light bg-light container sticky-top">
    <img src="../../assets/images/valuestat-logo.png" style="width: 150px; margin-left: 0%; margin-top: 1%">    
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a style="color: #28A745;" class="nav-link" href="dashboard.php"><b>Dashboard</b></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                        Data Master
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="data-siswa.php">Data Siswa</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="data-guru.php">Data Guru</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="data-mapel.php">Data Mapel</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="data-kelas.php">Data Kelas</a>
                    </div>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="data_siswa.php">Data Siswa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="data_petugas.php">Data Petugas</a>
                </li> -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                        Data Nilai
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="data-nilai.php">Nilai Harian</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="nilai-bulanan.php">Nilai Bulanan</a>
                    </div>
                </li>
                <!-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                        Ijin Laptop
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="data-perijinan-laptop.php">Perijinan Laptop</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="data-pengembalian-laptop.php">Pengembalian Laptop</a>
                    </div>
                </li> -->
                <!-- <li class="nav-item">
                    <a class="nav-link" href="data_perijinan.php">Data Perijinan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="data_kedatangan.php">Data Kedatangan</a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link rounded-pill" href="../../logout.php">Logout</a>
                </li>
            </ul>
        </div>
</nav>

<div class="container mt-4 ">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="card p-4 shadow-md" style="border-radius: 5%;">
        <h3 class="text-center mt-3 mb-3"><span style="color: #50A745"><b>TAMBAH GURU</b></span></h3>
        <form action="" method="POST">
            <div class="form-group">
              <label for="nip">NIP</label>
              <input type="text" name="nip" id="nip" class="form-control rounded-pill" placeholder="NIP" required>
            </div>
            <div class="form-group">
              <label for="nama">Nama Guru</label>
              <input type="text" name="nama" id="nama" class="form-control rounded-pill" placeholder="Nama Guru" required>
            </div>
            <div class="form-group">
              <label for="mapel">Mapel</label>
              <input type="text" name="mapel" id="mapel" class="form-control rounded-pill" placeholder="Mata Pelajaran" required>
            </div>
            <div class="form-group">
              <label for="jenis_kelamin">Jenis Kelamin</label>
              <select name="jenis_kelamin" id="jenis_kelamin" class="form-control rounded-pill">
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
              </select>
            </div>
            <div class="form-group">
              <label for="no_hp">No Handphone</label>
              <input type="no_hp" name="no_hp" id="no_hp" class="form-control rounded-pill" placeholder="Nomor Handphone" required>
            </div>
            <div class="form-group">
              <label for="email">E-mail</label>
              <input type="email" name="email" id="email" class="form-control rounded-pill" placeholder="Email" required>
            </div>
            <div class="text-center">
              <button type="submit" name="tambah" class="btn btn-success btn-sm rounded-pill">Tambah</button>
              <a href="data-siswa.php" class="btn btn-info btn-sm rounded-pill">Kembali</a>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include "../../includes/footer.php"; ?>

<!-- bootstrap -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
