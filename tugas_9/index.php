<?php
// Koneksi database
$conn = new mysqli('localhost', 'root', '', 'data_mahasiswa');

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Pagination
$limit = 10;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Ambil data mahasiswa
$result = $conn->query("SELECT * FROM mahasiswa LIMIT $limit OFFSET $offset");

// Hitung total data
$total_result = $conn->query("SELECT COUNT(*) AS total FROM mahasiswa")->fetch_assoc();
$total_pages = ceil($total_result['total'] / $limit);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>DATA MAHASISWA</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Asal Kota</th>
                <th>Universitas</th>
                <th>Pekerjaan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = $offset + 1; ?>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr class="<?= $i % 2 == 0 ? 'even' : 'odd'; ?>">
                <td><?= $i++; ?></td>
                <td><?= htmlspecialchars($row['nama']); ?></td>
                <td><?= htmlspecialchars($row['asal_kota']); ?></td>
                <td><?= htmlspecialchars($row['universitas']); ?></td>
                <td><?= htmlspecialchars($row['pekerjaan']); ?></td>
                <td>
                    <button class="update" onclick="location.href='update.php?id=<?= $row['id']; ?>'">UPDATE</button>
                    <button class="select" onclick="location.href='view.php?id=<?= $row['id']; ?>'">SELECT</button>
                    <button class="delete" onclick="if(confirm('Yakin ingin menghapus?')) location.href='delete.php?id=<?= $row['id']; ?>'">DELETE</button>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="?page=<?= $page - 1; ?>">Previous</a>
        <?php endif; ?>
        <?php if ($page < $total_pages): ?>
            <a href="?page=<?= $page + 1; ?>">Next</a>
        <?php endif; ?>
    </div>
    <button onclick="location.href='insert.php'">INSERT</button>
</body>
</html>
