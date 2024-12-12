<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn = new mysqli('localhost', 'root', '', 'data_mahasiswa');
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $nama = $_POST['nama'];
    $asal_kota = $_POST['asal_kota'];
    $universitas = $_POST['universitas'];
    $pekerjaan = $_POST['pekerjaan'];

    $sql = "INSERT INTO mahasiswa (nama, asal_kota, universitas, pekerjaan) VALUES ('$nama', '$asal_kota', '$universitas', '$pekerjaan')";
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
    <title>Insert Data</title>
    <style>
        /* Styling dasar body */
        body {
            font-family: Arial, sans-serif;
            background-image: url('tree.jpg');
            background-size: cover;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center; /* Pusatkan secara horizontal */
            align-items: center; /* Pusatkan secara vertikal */
            height: 100vh; /* Tinggi penuh layar */
        }

        /* Styling untuk kontainer */
        .container {
            background: #fff;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            max-width: 400px; /* Lebar maksimum kontainer */
            width: 100%;
            opacity: 0.9;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        /* Styling label dan input */
        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
            color: #555;
        }

        input {
            width: 95%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        /* Styling tombol */
        button {
            display: block;
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            background-color:rgb(51, 255, 0);
            color: #333;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Insert Data Mahasiswa</h1>
        <form method="POST">
            <label>Nama:</label>
            <input type="text" name="nama" required>
            <label>Asal Kota:</label>
            <input type="text" name="asal_kota" required>
            <label>Universitas:</label>
            <input type="text" name="universitas" required>
            <label>Pekerjaan:</label>
            <input type="text" name="pekerjaan" required>
            <button type="submit">Simpan</button>
        </form>
    </div>
</body>
</html>

