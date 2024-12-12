<?php
$conn = new mysqli('localhost', 'root', '', 'data_mahasiswa');
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$id = $_GET['id'];
$data = $conn->query("SELECT * FROM mahasiswa WHERE id=$id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $asal_kota = $_POST['asal_kota'];
    $universitas = $_POST['universitas'];
    $pekerjaan = $_POST['pekerjaan'];

    $sql = "UPDATE mahasiswa SET nama='$nama', asal_kota='$asal_kota', universitas='$universitas', pekerjaan='$pekerjaan' WHERE id=$id";
    if ($conn->query($sql)) {
        header('Location: index.php');
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data</title>
</head>
<body>
    <h1>Update Data mahasiswa</h1>
    <form method="POST">
        <label>Nama:</label><br>
        <input type="text" name="nama" value="<?= $data['nama']; ?>" required><br>
        <label>Asal Kota:</label><br>
        <input type="text" name="asal_kota" value="<?= $data['asal_kota']; ?>" required><br>
        <label>Universitas:</label><br>
        <input type="text" name="universitas" value="<?= $data['universitas']; ?>" required><br>
        <label>Pekerjaan:</label><br>
        <input type="text" name="pekerjaan" value="<?= $data['pekerjaan']; ?>" required><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>
