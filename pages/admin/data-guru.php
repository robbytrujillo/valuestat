<?php
include '../../includes/db.php';
session_start();

// Tambah guru
if (isset($_POST['tambah'])) {
  $nip = $_POST['nip'];
  $nama = $_POST['nama'];
  $mapel = $_POST['mapel'];
  $jk = $_POST['jk'];
  $no_hp = $_POST['no_hp'];
  $email = $_POST['email'];

  $query = "INSERT INTO guru (nip, nama, mapel, jenis_kelamin, no_hp, email)
            VALUES ('$nip', '$nama', '$mapel', '$jk', '$no_hp', '$email')";
  mysqli_query($conn, $query);
  header("Location: data-guru.php");
}

// Hapus guru
if (isset($_GET['hapus'])) {
  $id = $_GET['hapus'];
  mysqli_query($conn, "DELETE FROM guru WHERE id = $id");
  header("Location: data-guru.php");
}

// Pagination logic
$limit = 10; // jumlah data per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page > 1) ? ($page * $limit) - $limit : 0;

// Hitung total data
$result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM guru");
$row_total = mysqli_fetch_assoc($result);
$total = $row_total['total'];
$pages = ceil($total / $limit);

// Ambil data sesuai halaman
$guru = mysqli_query($conn, "SELECT * FROM guru ORDER BY id DESC LIMIT $start, $limit");
$no = $start + 1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Data Guru</title>
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

<div class="container mt-4">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card p-4 shadow-md" style="border-radius: 25px;">
        <h3 class="text-center mt-2 mb-3"><span style="color: #50A745"><b>DATA GURU</b></span></h3>
        <div class="col-md-10">
          <form action="" method="POST" class="mb-4">
            <div class="form-row mt-3 mb-2">
              <!-- <div class="col-md-2"><input type="text" name="nip" class="form-control rounded-pill" placeholder="NIP" required></div>
              <div class="col-md-3"><input type="text" name="nama" class="form-control rounded-pill" placeholder="Nama Guru" required></div>
              <div class="col-md-2"><input type="text" name="mapel" class="form-control rounded-pill" placeholder="Mapel" required></div>
              <div class="col-md-2">
                <select name="jk" class="form-control rounded-pill">
                  <option value="Laki-laki">Laki-laki</option>
                  <option value="Perempuan">Perempuan</option>
                </select>
              </div>
              <div class="col-md-2"><input type="text" name="no_hp" class="form-control rounded-pill" placeholder="No. HP"></div>
              <div class="col-md-3 mt-2"><input type="email" name="email" class="form-control rounded-pill" placeholder="Email"></div> -->
              <div class="col-md-2 mt-2">
                <!-- <button type="submit" name="tambah" class="btn btn-primary btn-md btn-block rounded-pill">Add</button> -->
                 <a href="tambah-data-guru.php" class="btn btn-success btn-md rounded-pill">Tambah</a>
              </div>
            </div>
          </form>
        </div>
      
        <table class="table table-bordered-0 table-striped">
          <thead class="thead-light">
            <tr>
              <th>No</th>
              <th>NIP</th>
              <th>Nama</th>
              <th>Mapel</th>
              <th>JK</th>
              <th>No. HP</th>
              <th>Email</th>
              <th>Aksi</th>
            </tr>
          </thead>                      
          <tbody>
            <?php
            // $guru = mysqli_query($conn, "SELECT * FROM guru ORDER BY id DESC");
            // $no = 1;
            while ($row = mysqli_fetch_assoc($guru)) :
            ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= $row['nip'] ?></td>
                <td><?= $row['nama'] ?></td>
                <td><?= $row['mapel'] ?></td>
                <td><?= $row['jenis_kelamin'] ?></td>
                <td><?= $row['no_hp'] ?></td>
                <td><?= $row['email'] ?></td>
                <td>
                  <a href="edit-data-guru.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm rounded-pill">Edit</a>
                  <a href="?hapus=<?= $row['id'] ?>" onclick="return confirm('Yakin hapus?')" class="btn btn-danger btn-sm rounded-pill">Hapus</a>
                </td>
              </tr>
            <?php endwhile ?>
          </tbody>
        </table>
        
        <!-- Pagination -->
        <nav>
          <ul class="pagination justify-content-center">
            <?php if ($page > 1): ?>
              <li class="page-item">
                <a class="page-link" href="?page=<?= $page - 1; ?>">« Prev</a>
              </li>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $pages; $i++): ?>
              <li class="page-item <?= ($i == $page) ? 'active' : ''; ?>">
                <a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a>
              </li>
            <?php endfor; ?>

            <?php if ($page < $pages): ?>
              <li class="page-item">
                <a class="page-link" href="?page=<?= $page + 1; ?>">Next »</a>
              </li>
            <?php endif; ?>
          </ul>
        </nav>
        
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
