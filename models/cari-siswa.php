<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "valuestat";  // Ganti sesuai database Anda

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

if (isset($_GET['nama'])) {
  
  $nama = $conn->real_escape_string($_GET['nama']);
  $query = "SELECT nama, nis, kelas FROM siswa WHERE nama LIKE '%$nama%' LIMIT 5";
  $result =$conn->query( $query);

  $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode($data);
}

$conn->close();
?>
