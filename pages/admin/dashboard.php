<!-- Assume session & DB connected -->
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Admin</title>
  <link rel="icon" type="image/x-icon" href="../assets/images/ihbs-logo.png">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    .card-icon {
      font-size: 30px;
    }
  </style>
</head>
<body style="background:  #F6F8FD">
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
  <h3 class="text-center mb-4">Dashboard Admin - Statistik Nilai</h3>

  <!-- Card -->
  <div class="row">
    <div class="col-md-3 mb-3">
      <div class="card bg-info text-white shadow h-100 py-2">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <div><i class="card-icon fas fa-users"></i> User</div>
            <h4>15</h4>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <div class="card bg-success text-white shadow h-100 py-2">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <div><i class="card-icon fas fa-user-graduate"></i> Siswa</div>
            <h4>200</h4>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <div class="card bg-warning text-white shadow h-100 py-2">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <div><i class="card-icon fas fa-chalkboard-teacher"></i> Petugas</div>
            <h4>10</h4>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <div class="card bg-danger text-white shadow h-100 py-2">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <div><i class="card-icon fas fa-chart-line"></i> Statistik</div>
            <h4>48</h4>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Grafik -->
  <div class="row">
    <div class="col-md-8">
      <canvas id="lineChart" height="200"></canvas>
    </div>
    <div class="col-md-4">
      <canvas id="pieChart" height="200"></canvas>
    </div>
  </div>
</div>

<?php include "../../includes/footer.php"; ?>

<!-- Chart Script -->
<script>
const ctx = document.getElementById('lineChart').getContext('2d');
const lineChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: ['1 Mar', '5 Mar', '10 Mar', '15 Mar', '20 Mar', '25 Mar', '30 Mar'],
    datasets: [{
      label: 'Nilai Rata-rata',
      data: [78, 82, 81, 85, 80, 84, 87],
      borderColor: 'blue',
      fill: false
    }]
  }
});

const ctxPie = document.getElementById('pieChart').getContext('2d');
const pieChart = new Chart(ctxPie, {
  type: 'pie',
  data: {
    labels: ['Izin', 'Sakit', 'Alpa'],
    datasets: [{
      data: [10, 5, 3],
      backgroundColor: ['#007bff', '#ffc107', '#dc3545']
    }]
  }
});
</script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>

<!-- bootstrap -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
