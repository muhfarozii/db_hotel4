<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Transaksi</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-image: url('https://cdn.villa-bali.com/cache/fullSize/villas/villa-emile/villa-emile-33-pool-night-d-5b29c04adca54.jpg'); 
            padding: 20px;
        }
        .container {
            max-width: 900px;
            margin: 90px auto;
            background: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 60px;
            border-radius: 40px;
        }
        .table {
            margin-top: 50px;
        }
        .table thead th {
            background-color: #343a40;
            color: white;
        }
        .no-data {
            text-align: center;
            font-style: italic;
        }
        .search-bar {
            margin-bottom: 20px;
            margin-top: 2em;
        }
    </style>
    <script>
        function searchTable() {
            var input, filter, table, tr, td, i, j, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toLowerCase();
            table = document.getElementById("transaction-table");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                tr[i].style.display = "none";
                td = tr[i].getElementsByTagName("td");
                for (j = 0; j < td.length; j++) {
                    if (td[j]) {
                        txtValue = td[j].textContent || td[j].innerText;
                        if (txtValue.toLowerCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                            break;
                        }
                    }
                }
            }
        }
    </script>
</head>
<body>
<?php include "navbar2.php";?> 

    <div class="container">
        <h2 class="text-center">Data Operator</h2>
        <div class="search-bar">
            <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Cari berdasarkan apapun..." class="form-control">
        </div>

        <!-- Table -->
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>E-mail</th>
                    <th>Password</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="transaction-table">
                <?php
                // Informasi koneksi database
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "daftar_pengguna";

                // Membuat koneksi
                $conn = new mysqli($servername, $username, $password, $database);

                // Memeriksa koneksi
                if ($conn->connect_error) {
                    die("<tr><td colspan='5' class='text-center'>Koneksi ke database gagal: " . $conn->connect_error . "</td></tr>");
                }

                // Query untuk mengambil data dari tabel pengguna
                $sql = "SELECT * FROM pengguna";
                $result = $conn->query($sql);

                // Memeriksa jika ada data dalam tabel
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['username'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['password'] . "</td>";
                        echo "<td><a href='edit_pengguna.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Edit</a> <a href='delete_pengguna.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm delete-btn'>Hapus</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='no-data'>Tidak ada data yang ditemukan</td></tr>";
                }

                // Menutup koneksi
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.querySelectorAll('.delete-btn').forEach(function(button) {
            button.addEventListener('click', function(event) {
                if (!confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                    event.preventDefault();
                }
            });
        });
    </script>
</body>
</html>
