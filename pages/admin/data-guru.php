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
  header("Location: guru.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>CRUD Data Guru</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
      <div class="card p-4 shadow-md" style="border-radius: 5%;">
        <h2 class="text-center mt-2 mb-3"><span style="color: #50A745">Data Guru</span></h2>
        <form action="" method="POST" class="mb-4">
          <div class="form-row">
            <div class="col-md-2"><input type="text" name="nip" class="form-control" placeholder="NIP" required></div>
            <div class="col-md-3"><input type="text" name="nama" class="form-control" placeholder="Nama Guru" required></div>
            <div class="col-md-2"><input type="text" name="mapel" class="form-control" placeholder="Mapel" required></div>
            <div class="col-md-2">
              <select name="jk" class="form-control">
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
              </select>
            </div>
            <div class="col-md-2"><input type="text" name="no_hp" class="form-control" placeholder="No. HP"></div>
            <div class="col-md-3 mt-2"><input type="email" name="email" class="form-control" placeholder="Email"></div>
            <div class="col-md-1 mt-2">
              <button type="submit" name="tambah" class="btn btn-primary btn-md btn-block rounded-pill">Add</button>
            </div>
          </div>
        </form>

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
            $guru = mysqli_query($conn, "SELECT * FROM guru ORDER BY id DESC");
            $no = 1;
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
                  <a href="edit_guru.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm rounded-pill">Edit</a>
                  <a href="?hapus=<?= $row['id'] ?>" onclick="return confirm('Yakin hapus?')" class="btn btn-danger btn-sm rounded-pill">Hapus</a>
                </td>
              </tr>
            <?php endwhile ?>
          </tbody>
        </table>  
      </div>
    </div>
  </div>
</div>

</body>
</html>
