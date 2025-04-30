<?php
include '../../includes/db.php';
session_start();

if (isset($_POST['simpan'])) {
  $nis     = $_POST['nis'];
  $nama    = $_POST['nama'];
  $kelas   = $_POST['kelas'];
  $mapel   = $_POST['mapel'];
  $nilai   = $_POST['nilai'];
  $ket     = $_POST['keterangan'];

  $query = "INSERT INTO nilai_siswa 
    (nis, nama, kelas, mapel, nilai, keterangan) 
    VALUES 
    ('$nis', '$nama', '$kelas', '$mapel', '$nilai', '$ket')";

  if (mysqli_query($conn, $query)) {
    $pesan = "<div class='alert alert-success' id='pesan-sukses'>Data nilai berhasil disimpan.</div>";
  } else {
    $pesan = "<div class='alert alert-danger' id='pesan-gagal'>Gagal menyimpan data nilai.</div>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Input Nilai Siswa</title>
  <link rel="icon" type="image/x-icon" href="../../assets/images/ihbs-logo.png">
  
  <!-- bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <!-- css-extend -->
  <link rel="stylesheet" href="assets/css/style.css">

  <!-- jQuery UI Autocomplete -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

<style>
  #suggestions {
    max-height: 200px;
    overflow-y: auto;
    border: 1px solid #ced4da;
    border-radius: .25rem;
    margin-top: 5px;
  }
</style>

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
                        <a class="dropdown-item" href="input-nilai.php">Input Nilai</a>
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
                        <a class="dropdown-item" href="input-nilai.php">Input Nilai</a>
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
    <div class="col-md-5">
      <div class="card p-4 shadow-md" style="border-radius: 5%;">
        <h3 class="text-center mt-3 mb-3"><span style="color: #50A745"><b>INPUT NILAI SISWA</b></span></h3>
        <?= isset($pesan) ? $pesan : '' ?>
        <form action="" method="POST">
          <div class="form-group">
              <label for="nama">Nama Siswa</label>
              <input type="text" class="form-control rounded-pill" id="nama" name="nama" placeholder="Isi Nama Siswa" autocomplete="off">
              <div id="suggestions" class="list-group" style="position: absolute; z-index: 1000;"></div>
          </div>
          <div class="form-group">
              <div class="row">
                  <div class="col">
                      <input type="text" class="form-control bg-light rounded-pill" id="nis" name="nis" placeholder="Nomor induk" readonly>
                  </div>
                  <div class="col">
                      <input type="text" class="form-control bg-light rounded-pill" id="kelas" name="kelas" placeholder="Kelas" readonly>
                  </div>
              </div>    
          </div>
          <div class="form-group">
              <label for="nama_mapel">Mata Pelajaran</label>
              <input type="text" class="form-control rounded-pill" id="nama_mapel" name="mapel" placeholder="Pilih Mapel" autocomplete="off">
              <div id="suggestions-mapel" class="list-group" style="position: absolute; z-index: 1000;"></div>
          </div>
          <!-- <div class="form-group">
            <label>Mata Pelajaran</label>
            <select name="mapel" class="form-control rounded-pill" required>
              <option value="">Pilih Mapel</option>
              <?php
              // $mapel = mysqli_query($conn, "SELECT * FROM mapel");
              // while ($m = mysqli_fetch_assoc($mapel)) {
              //   echo "<option value='{$m['nama_mapel']}'>{$m['nama_mapel']}</option>";
              // }
              ?>
            </select>
          </div> -->
          <div class="form-group">
            <label>Nilai</label>
            <input type="number" name="nilai" class="form-control rounded-pill" step="0.01" required>
          </div>
          <div class="form-group">
            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control rounded-pill" rows="3"></textarea>
          </div>
          <div class="text-center">
            <button type="submit" name="simpan" class="btn btn-success btn-sm rounded-pill">Simpan</button>
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

<!-- jquery -->
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

<!-- js-extends -->
<script src="../../assets/js/cari-siswa.js"></script>
<script src="../../assets/js/cari-mapel.js"></script>
<script src="../../assets/js/time-alert.js"></script>

</body>
</html>
