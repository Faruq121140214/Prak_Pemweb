<?php
$conn = new mysqli('localhost', 'root', '', 'data_mahasiswa');
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$id = $_GET['id'];
$data = $conn->query("SELECT * FROM mahasiswa WHERE id=$id")->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Mahasiswa</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-image: url('blue.jpg');
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            width:max-content;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            opacity: 0.9;
        }
        h1 {
            color: #007bff;
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: auto;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color:rgb(184, 184, 184);
            color: white;
        }
        td {
            background-color: #f8f9fa;
        }
        button {
            display: block;
            width: 150px;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            margin: 20px auto;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Detail Mahasiswa</h1>
        <table>
            <tr>
                <th>Informasi</th>
                <th>Detail</th>
            </tr>
            <tr>
                <td>Nama</td>
                <td><?= $data['nama']; ?></td>
            </tr>
            <tr>
                <td>Asal Kota</td>
                <td><?= $data['asal_kota']; ?></td>
            </tr>
            <tr>
                <td>Universitas</td>
                <td><?= $data['universitas']; ?></td>
            </tr>
            <tr>
                <td>Pekerjaan</td>
                <td><?= $data['pekerjaan']; ?></td>
            </tr>
        </table>
        <button onclick="location.href='index.php'">Kembali</button>
    </div>
</body>
</html>