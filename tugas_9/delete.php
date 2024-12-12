<?php
$conn = new mysqli('localhost', 'root', '', 'data_mahasiswa');
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$id = $_GET['id'];
$conn->query("DELETE FROM mahasiswa WHERE id=$id");

header('Location: index.php');
exit;
?>
