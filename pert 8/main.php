<?php
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'account';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];

    $sql = "INSERT INTO table_account (nama, nim) VALUES ('$nama', '$nim')";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Data berhasil disimpan!</p>";
    } else {
        echo "ERROR: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 50%;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input[type="text"] {
            width: 97%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Form Input Data</h2>
        <form method="POST" action="">
            <label for="nama">Nama</label>
            <input type="text" id="nama" name="nama" required>

            <label for="nim">NIM</label>
            <input type="text" id="nim" name="nim" required>

            <button type="submit">Submit</button>
        </form>
        <a href="display.php" class="button">Lihat Data</a>
    </div>

</body>
</html>
