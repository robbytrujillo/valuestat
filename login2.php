<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login - Statistik Nilai</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      background: linear-gradient(to right,#FFFFFF, #CCD6E7);
    }
    .login-box {
      margin-top: 100px;
    }
  </style>
</head>
<body>
    <br><br><br>
  <div class="container login-box">
    <div class="row justify-content-center">
      <div class="col-md-5">
        <div class="card shadow-lg">
          <div class="card-header text-white bg-light text-center" style="border-radius: 15%">
            <h4 style="color: black">Login Statistik</h4>
          </div>
          <div class="card-body">
            <form action="auth.php" method="POST">
              <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required>
              </div>
              <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
              </div>
              <button type="submit" class="btn btn-primary btn-block rounded-pill">Masuk</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
