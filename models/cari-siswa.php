<?php
include '../includes/db.php';

if (isset($_GET['nama'])) {
  $nama = mysqli_real_escape_string($conn, $_GET['nama']);
  $query = "SELECT nis, kelas FROM siswa WHERE nama = '$nama' LIMIT 1";
  $result = mysqli_query($conn, $query);

  if ($row = mysqli_fetch_assoc($result)) {
    echo json_encode($row);
  } else {
    echo json_encode(['nis' => '', 'kelas' => '']);
  }
}
?>
