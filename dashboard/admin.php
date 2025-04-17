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
<body>
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
</body>
</html>
