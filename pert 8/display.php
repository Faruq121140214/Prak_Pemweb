<?php
$host = 'localhost';
$username = 'root'; 
$password = ''; 
$dbname = 'account'; 

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set limit per page
$limit = 10;

// Get current page from URL, default to page 1
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Calculate offset
$offset = ($page - 1) * $limit;

// Fetch total number of records
$sql_count = "SELECT COUNT(*) AS total FROM table_account";
$result_count = $conn->query($sql_count);
$row_count = $result_count->fetch_assoc();
$total_records = $row_count['total'];

// Fetch data for current page
$sql = "SELECT * FROM table_account LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Tabel</title>
    <style>
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(odd) {
            background-color: #f2f2f2;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .btn {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        .btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Data dari Tabel Account</h2>
        
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>NIM</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['nama'] . "</td>";
                        echo "<td>" . $row['nim'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>Tidak ada data</td></tr>";
                }

                // Ensure there are 10 rows, even if data is less than 10
                $remaining_rows = $limit - $result->num_rows;
                for ($i = 0; $i < $remaining_rows; $i++) {
                    echo "<tr><td>-</td><td>-</td><td>-</td></tr>";
                }
                ?>
            </tbody>
        </table>
        
        <div class="pagination">
            <?php
            // Calculate the total number of pages
            $total_pages = ceil($total_records / $limit);

            // Display pagination links
            if ($page > 1) {
                echo "<a class='btn' href='?page=" . ($page - 1) . "'>Previous</a>";
            }

            if ($page < $total_pages) {
                echo "<a class='btn' href='?page=" . ($page + 1) . "'>Next</a>";
            }
            ?>
        </div>

        <br><br>
        <a class="btn" href="main.php">Kembali ke Form Input</a>
    </div>

</body>
</html>

<?php
$conn->close();
?>
