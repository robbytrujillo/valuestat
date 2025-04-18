<!-- index.php -->
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login | Statistik Nilai Siswa</title>
  <link rel="icon" type="image/x-icon" href="assets/images/ihbs-logo.png">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    
  <div class="container login-container">
    <div class="row justify-content-center">
      <div class="col-md-5">
        <div class="card p-4 shadow">
          <div class="text-center">
            <img src="assets/images/valuestat-logo.png" alt="Logo" class="logo mb-3" style="width: 180px; margin-left: 0%; margin-top: 2%">
            <!-- <h4 class="mb-4 text-dark">Login Aplikasi Statistik Nilai</h4> -->
          </div>
          <form action="login-proses.php" method="POST">
            <div class="form-group">
              <label for="username" class="text-dark"><strong style="color: #467228;">Username</strong></label>
              <input type="text" class="form-control" name="username" id="username" required>
            </div>
            <div class="form-group">
              <label for="password" class="text-dark"><strong style="color: #467228;">Password</strong></label>
              <input type="password" class="form-control" name="password" id="password" required>
            </div>
            <div class="form-group">
              <label for="role" class="text-dark"><strong style="color: #467228;">Role</strong></label>
              <select name="role" id="role" class="form-control" required>
                <option value="">-- Pilih Role --</option>
                <option value="admin">Admin</option>
                <option value="guru">Guru</option>
                <option value="siswa">Siswa</option>
              </select>
            </div>
            <button type="submit" class="btn btn-success btn-block rounded-pill">🔐 <b>Login</b></button>
            <div class="small text-center text-dark mt-3"><b>&copy; 2025 IT Development IHBS </b></div>
          </form>
          <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger mt-3 text-center">
              <?= $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
