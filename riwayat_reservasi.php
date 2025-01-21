<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Reservasi</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-image: url('https://cdn.villa-bali.com/cache/fullSize/villas/villa-emile/villa-emile-33-pool-night-d-5b29c04adca54.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            padding-top: 80px; /* Mencegah konten tertutup navbar */
        }

        .container {
            max-width: 900px;
            background: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            border-radius: 20px;
            margin-bottom: 30px; /* Tambahkan margin bawah */
        }

        .table-container {
            max-height: 400px; /* Maksimum tinggi tabel */
            overflow-y: auto; /* Scroll khusus untuk tabel */
            margin-top: 10px;
        }

        .table thead th {
            background-color: #343a40;
            color: white;
            position: sticky;
            top: 0;
            z-index: 2; /* Supaya header tetap terlihat */
        }

        .search-bar {
            position: sticky;
            top: 80px; /* Tetap berada di bawah navbar */
            z-index: 100;
            background-color: white;
            padding: 10px 0;
            margin-bottom: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .no-data {
            text-align: center;
            font-style: italic;
        }

        .footer {
            color: white;
            text-align: center;
            margin-top: 5em;
        }
    </style>
</head>
<body>
<?php include "navbar2.php";?> <!-- Navbar inclusion -->

    <div class="container">
        <h2 class="text-center">Riwayat Reservasi</h2>

        <!-- Search Bar -->
        <div class="row search-bar">
            <div class="col-md-12">
                <input type="text" id="search-input" class="form-control" placeholder="Cari berdasarkan nama atau kamar...">
            </div>
        </div>

        <!-- Table -->
        <div class="table-container">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Nama Kamar</th>
                        <th>Harga</th>
                        <th>Bukti Reservasi</th>
                    </tr>
                </thead>
                <tbody id="transaction-table">
                <?php
                    // Koneksi database
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $database = "db_hotel";

                    $conn = new mysqli($servername, $username, $password, $database);
                    if ($conn->connect_error) {
                        die("<tr><td colspan='9' class='text-center'>Koneksi ke database gagal: " . $conn->connect_error . "</td></tr>");
                    }

                    $sql = "SELECT id, nama, nama_kamar, harga FROM reservasi";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['nama'] . "</td>";
                            echo "<td>" . $row['nama_kamar'] . "</td>";
                            echo "<td>Rp." . number_format($row['harga'], 0, ',', '.') . "</td>";
                            echo "<td><a href='detail_reservasi.php?id=" . $row['id'] . "'>Lihat Bukti Reservasi</a></td>";
                            echo "</tr>";
                        }                    
                    } else {
                        echo "<tr><td colspan='5' class='no-data'>Tidak ada data yang ditemukan</td></tr>";
                    }
                    $conn->close();
                ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.getElementById('search-input').addEventListener('input', function() {
            let filter = this.value.toUpperCase();
            let rows = document.querySelector("#transaction-table").rows;

            // Loop over the table rows and hide non-matching rows
            for (let i = 0; i < rows.length; i++) {
                let nameCol = rows[i].cells[1];
                let roomCol = rows[i].cells[2];
                if (nameCol || roomCol) {
                    let nameText = nameCol.textContent || nameCol.innerText;
                    let roomText = roomCol.textContent || roomCol.innerText;
                    // Show rows that match the search filter
                    if (nameText.toUpperCase().indexOf(filter) > -1 || roomText.toUpperCase().indexOf(filter) > -1) {
                        rows[i].style.display = "";
                    } else {
                        rows[i].style.display = "none"; // Hide rows that don't match
                    }
                }       
            }
        });
    </script>
</body>
</html>
