<?php
include '../../includes/db.php';
session_start();

// Handle tambah data
if (isset($_POST['tambah'])) {
  $nis = $_POST['nis'];
  $nama = $_POST['nama'];
  $kelas = $_POST['kelas'];
  $jk = $_POST['jk'];
  $alamat = $_POST['alamat'];

  $query = "INSERT INTO siswa (nis, nama, kelas, jenis_kelamin, alamat)
            VALUES ('$nis', '$nama', '$kelas', '$jk', '$alamat')";
  mysqli_query($conn, $query);
  header("Location: siswa.php");
}

// Handle hapus data
if (isset($_GET['hapus'])) {
  $id = $_GET['hapus'];
  mysqli_query($conn, "DELETE FROM siswa WHERE id = $id");
  header("Location: siswa.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Data Siswa</title>
  <link rel="icon" type="image/x-icon" href="../../assets/images/ihbs-logo.png">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body style="background:  #F6F8FD">

<!-- <?php include 'includes/sidebar.php'; ?> -->

<nav class="navbar navbar-expand-lg navbar-light bg-light container sticky-top">
    <img src="../../assets/images/valuestat-logo.png" style="width: 150px; margin-left: 0%; margin-top: 1%">    
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a style="color: #28A745;" class="nav-link" href="#"><b>Dashboard</b></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                        Data Master
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="siswa.php">Data Siswa</a>
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
  <h2>Data Siswa</h2>
  <form action="" method="POST" class="mb-4">
    <div class="form-row">
      <div class="col-md-2"><input type="text" name="nis" class="form-control" placeholder="NIS" required></div>
      <div class="col-md-3"><input type="text" name="nama" class="form-control" placeholder="Nama Siswa" required></div>
      <div class="col-md-2"><input type="text" name="kelas" class="form-control" placeholder="Kelas" required></div>
      <div class="col-md-2">
        <select name="jk" class="form-control">
          <option value="Laki-laki">Laki-laki</option>
          <option value="Perempuan">Perempuan</option>
        </select>
      </div>
      <div class="col-md-2"><input type="text" name="alamat" class="form-control" placeholder="Alamat"></div>
      <div class="col-md-1">
        <button type="submit" name="tambah" class="btn btn-success btn-block rounded-pill">Tambah</button>
      </div>
    </div>
  </form>

  <table class="table table-bordered table-striped">
    <thead class="thead-dark">
      <tr>
        <th>No</th>
        <th>NIS</th>
        <th>Nama</th>
        <th>Kelas</th>
        <th>JK</th>
        <th>Alamat</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $siswa = mysqli_query($conn, "SELECT * FROM siswa ORDER BY id DESC");
      $no = 1;
      while ($row = mysqli_fetch_assoc($siswa)) :
      ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= $row['nis'] ?></td>
          <td><?= $row['nama'] ?></td>
          <td><?= $row['kelas'] ?></td>
          <td><?= $row['jenis_kelamin'] ?></td>
          <td><?= $row['alamat'] ?></td>
          <td>
            <a href="edit-data-siswa.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm rounded-pill">Edit</a>
            <a href="?hapus=<?= $row['id'] ?>" onclick="return confirm('Yakin?')" class="btn btn-danger btn-sm rounded-pill">Hapus</a>
          </td>
        </tr>
      <?php endwhile ?>
    </tbody>
  </table>
</div>

<?php include "../../includes/footer.php"; ?>

<script src="https://kit.fontawesome.com/a076d05399.js"></script>

<!-- bootstrap -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
