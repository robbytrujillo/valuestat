<?php
session_start();
include 'includes/db.php';

$username = $_POST['username'];
$password = $_POST['password'];
$role     = $_POST['role'];

// Ganti query ini sesuai struktur tabel user kamu
$query = "SELECT * FROM users WHERE username = '$username' AND password = '$password' AND role = '$role'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) === 1) {
    $_SESSION['user'] = mysqli_fetch_assoc($result);
    $_SESSION['role'] = $role;

    if ($role == 'admin') {
        header('Location: dashboard/admin.php');
    } elseif ($role == 'guru') {
        header('Location: dashboard/guru.php');
    } elseif ($role == 'siswa') {
        header('Location: dashboard/siswa.php');
    }
    exit;
} else {
    $_SESSION['error'] = 'Username, Password, atau Role salah!';
    header('Location: index.php');
    exit;
}
?>
