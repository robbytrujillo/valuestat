<?php
include '../../includes/db.php';
session_start();

$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM nilai_siswa WHERE id = $id");
$nilai = mysqli_fetch_assoc($data);

// Handle update
if (isset($_POST['update'])) {
  $nis = $_POST['nis'];
  $nama = $_POST['nama'];
  $kelas = $_POST['kelas'];
  $mapel = $_POST['mapel'];
  $nilai = $_POST['nilai'];
  $keterangan = $_POST['keterangan'];

  $query = "UPDATE nilai_siswa SET 
              nis = '$nis',
              nama = '$nama',
              kelas = '$kelas',
              mapel = '$mapel',
              nilai = '$nilai',
              keterangan = '$keterangan'
            WHERE id = $id";

  if (mysqli_query($conn, $query)) {
    header("Location: data-nilai.php");
  } else {
    echo "Gagal mengupdate data!";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Nilai Siswa | Guru</title>
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
                        <a class="dropdown-item" href="nilai-harian.php">Nilai Harian</a>
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
        <h3 class="text-center mt-3 mb-3"><span style="color: #50A745"><b>EDIT DATA NILAI</b></span></h3>
        <form action="" method="POST">
            <div class="form-group">
              <label for="nis">NIS</label>
              <input type="text" name="nis" class="form-control rounded-pill" value="<?= $nilai['nis'] ?>">
            </div>
            <div class="form-group">
              <label for="nama">Nama Siswa</label>
              <input type="text" name="nama" class="form-control rounded-pill" value="<?= $nilai['nama'] ?>">
            </div>
            <div class="form-group">
              <label for="kelas">Kelas</label>
              <input type="text" name="kelas" class="form-control rounded-pill" value="<?= $nilai['kelas'] ?>">
            </div>
            <div class="form-group">
              <label for="nama_mapel">Mata Pelajaran</label>
              <input type="text" class="form-control rounded-pill" id="nama_mapel" name="mapel" value="<?=$nilai['mapel'] ?>" autocomplete="off">
              <div id="suggestions-mapel" class="list-group" style="position: absolute; z-index: 1000;"></div>
            </div>
            
            <div class="form-group">
              <label for="nilai">Nilai</label>
              <textarea name="nilai" class="form-control rounded-pill"><?= $nilai['nilai'] ?></textarea>
            </div>
            <div class="form-group">
              <label for="keterangan">Keterangan</label>
              <textarea name="keterangan" class="form-control rounded-pill"><?= $nilai['keterangan'] ?></textarea>
            </div>
            <div class="text-center">
              <button type="submit" name="update" class="btn btn-success btn-sm rounded-pill">Update</button>
              <a href="data-nilai.php" class="btn btn-info btn-sm rounded-pill">Kembali</a>
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

<script src="../../assets/js/cari-mapel.js"></script>

</body>
</html>
