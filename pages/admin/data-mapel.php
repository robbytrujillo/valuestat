<?php
include '../../includes/db.php';
session_start();

// Tambah Mapel
if (isset($_POST['tambah'])) {
  $kode = $_POST['kode_mapel'];
  $nama = $_POST['nama_mapel'];
  mysqli_query($conn, "INSERT INTO mapel (kode_mapel, nama_mapel) VALUES ('$kode', '$nama')");
  header("Location: data-mapel.php");
}

// Hapus Mapel
if (isset($_GET['hapus'])) {
  $id = $_GET['hapus'];
  mysqli_query($conn, "DELETE FROM mapel WHERE id = $id");
  header("Location: data-mapel.php");
}

// Pagination logic
$limit = 10; // jumlah data per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page > 1) ? ($page * $limit) - $limit : 0;

// Hitung total data
$result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM mapel");
$row_total = mysqli_fetch_assoc($result);
$total = $row_total['total'];
$pages = ceil($total / $limit);

// Ambil data sesuai halaman
$mapel = mysqli_query($conn, "SELECT * FROM mapel ORDER BY id DESC LIMIT $start, $limit");
$no = $start + 1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Data Mata Pelajaran</title>
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
                <h3 class="text-center mt-2 mb-3"><span style="color: #50A745"><b>DATA MAPEL</b></span></h3>
                <form action="" method="POST" class="mb-4">
                    <div class="form-row">
                    <!-- <div class="col-md-3">
                        <input type="text" name="kode_mapel" class="form-control rounded-pill" placeholder="Kode Mapel" required>
                    </div>
                    <div class="col-md-5">
                        <input type="text" name="nama_mapel" class="form-control rounded-pill" placeholder="Nama Mapel" required>
                    </div> -->
                        <div class="col-md-2">
                            <button type="submit" name="tambah" class="btn btn-success btn-md rounded-pill">Tambah</button>
                        </div>
                    </div>
                </form>

                <table class="table table-bordered-0 table-striped">
                    <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Kode Mapel</th>
                        <th>Nama Mapel</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    // $data = mysqli_query($conn, "SELECT * FROM mapel ORDER BY id DESC");
                    // $no = 1;
                    while ($row = mysqli_fetch_assoc($mapel)) :
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row['kode_mapel'] ?></td>
                        <td><?= $row['nama_mapel'] ?></td>
                        <td>
                        <a href="edit-data-mapel.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm rounded-pill">Edit</a>
                        <a href="?hapus=<?= $row['id'] ?>" onclick="return confirm('Yakin hapus mapel ini?')" class="btn btn-danger btn-sm rounded-pill">Hapus</a>
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
