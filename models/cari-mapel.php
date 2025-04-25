<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "valuestat";  // Ganti sesuai database Anda

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

if (isset($_GET['nama_mapel'])) {
  // $nama = mysqli_real_escape_string($conn, $_GET['nama']);
  $nama = $_GET['nama_mapel'];
  $query = "SELECT nama_mapel, kode_mapel FROM mapel WHERE nama_mapel LIKE '$nama_mapel' LIMIT 5";
  $result =$conn->query( $query);

  $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode($data);
}

$conn->close();
?>
