<?php
include '../../includes/db.php';
// include '../../models/cari-siswa.php';
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
    $pesan = "<div class='alert alert-success'>Data nilai berhasil disimpan.</div>";
  } else {
    $pesan = "<div class='alert alert-danger'>Gagal menyimpan data nilai.</div>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Input Nilai Siswa</title>
  <link rel="icon" type="image/x-icon" href="../../assets/images/ihbs-logo.png">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="stylesheet" href="assets/css/style.css">

  <!-- jQuery UI Autocomplete -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

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
    <div class="col-md-5">
      <div class="card p-4 shadow-md" style="border-radius: 5%;">
        <h3 class="text-center mt-3 mb-3"><span style="color: #50A745"><b>INPUT NILAI SISWA</b></span></h3>
        <?= isset($pesan) ? $pesan : '' ?>
        <form action="" method="POST">
          <div class="form-group">
            <label>Nama Siswa</label>
            <input type="text" name="nama" id="nama" class="form-control rounded-pill" required>
          </div>
          <div class="form-group">
            <label>Nomor Induk Siswa</label>
            <input type="text" name="nis" id="nis" class="form-control rounded-pill" readonly required>
          </div>
          <div class="form-group">
            <label>Kelas</label>
            <input type="text" name="kelas" id="kelas" class="form-control rounded-pill" readonly required>
          </div>

          <!-- <div class="form-group">
            <label>Kelas</label>
            <select name="kelas" class="form-control rounded-pill" required>
              <option value="">Pilih Kelas</option>
              <?php
              // $kelas = mysqli_query($conn, "SELECT * FROM kelas");
              // while ($k = mysqli_fetch_assoc($kelas)) {
              //   echo "<option value='{$k['nama_kelas']}'>{$k['nama_kelas']}</option>";
              // }
              ?>
            </select> -->
          <!-- </div> -->
          <div class="form-group">
            <label>Mata Pelajaran</label>
            <select name="mapel" class="form-control rounded-pill" required>
              <option value="">Pilih Mapel</option>
              <?php
              $mapel = mysqli_query($conn, "SELECT * FROM mapel");
              while ($m = mysqli_fetch_assoc($mapel)) {
                echo "<option value='{$m['nama_mapel']}'>{$m['nama_mapel']}</option>";
              }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label>Nilai</label>
            <input type="number" name="nilai" class="form-control rounded-pill" step="0.01" required>
          </div>
          <div class="form-group">
            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control rounded-pill" rows="3"></textarea>
          </div>
          <div class="text-center">
            <button type="submit" name="simpan" class="btn btn-success btn-sm rounded-pill">Simpan Nilai</button>
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

<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script>
  $(document).ready(function() {
  // Saat user mengetik di input nama_siswa
      $("#nama_siswa").on("input", function() {
          var nama = $(this).val();
          if (nama.length > 2) {  // Minimal 3 karakter untuk pencarian
              $.ajax({
                  url: "cari_siswa.php",
                  type: "GET",
                  data: {nama_siswa: nama},
                  success: function(response) {
                      let data = JSON.parse(response);
                      if (data.length > 0) {
                          $("#suggestions").empty().show();
                          data.forEach(function(item) {
                              $("#suggestions").append(`<a href="#" class="list-group-item list-group-item-action" onclick="pilihSiswa('${item.nama_siswa}', '${item.nomor_induk}', '${item.kelas}')">${item.nama_siswa}</a>`);
                          });
                      } else {
                          $("#suggestions").hide();
                      }
                                      }
              });
          } else {
              $("#suggestions").hide();
          }
      });
  });

  // Fungsi untuk mengisi input otomatis setelah memilih nama siswa
  function pilihSiswa(nama, nomor_induk, kelas) {
      $("#nama_siswa").val(nama);
      $("#nomor_induk").val(nomor_induk);
      $("#kelas").val(kelas);
      $("#suggestions").hide();
  }
</script>


</body>
</html>
