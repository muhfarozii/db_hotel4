<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengelolaan Data Pengguna</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        .container {
            margin-left: 270px;
            padding: 1em;
        }

        .table-container {
            margin-top: 20px;
        }

        .no-data {
            text-align: center;
        }
    </style>
</head>

<body>
<?php include 'sidebar.php'; ?>
    <!-- Main Content -->
    <div class="container">
        <h2 class="text-center">Data Pengguna</h2>
        <div class="search-bar mb-3">
            <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Cari berdasarkan apapun..." class="form-control">
        </div>

        <!-- Table -->
        <div class="table-container">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>E-mail</th>
                        <th>No Telp</th>
                        <th>Jenis Kelamin</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="transaction-table">
                    <?php
                    // Informasi koneksi database
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $database = "db_hotel";

                    // Membuat koneksi
                    $conn = new mysqli($servername, $username, $password, $database);

                    // Memeriksa koneksi
                    if ($conn->connect_error) {
                        die("<tr><td colspan='6' class='text-center'>Koneksi ke database gagal: " . $conn->connect_error . "</td></tr>");
                    }

                    // Query untuk mengambil data dari tabel pengguna
                    $sql = "SELECT id, username, email, phone, gender FROM daftar_pengguna";
                    $result = $conn->query($sql);

                    // Memeriksa jika ada data dalam tabel
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['username'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['phone'] . "</td>";
                            echo "<td>" . $row['gender'] . "</td>";
                            echo "<td><a href='edit_pengguna.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Edit</a> <a href='delete_pengguna.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm delete-btn'>Hapus</a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6' class='no-data'>Tidak ada data yang ditemukan</td></tr>";
                    }

                    // Menutup koneksi
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
        document.querySelectorAll('.delete-btn').forEach(function(button) {
            button.addEventListener('click', function(event) {
                if (!confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                    event.preventDefault();
                }
            });
        });

        function searchTable() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("transaction-table");
            tr = table.getElementsByTagName("tr");

            for (i = 1; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1]; // Column 2 for Username
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
</body>

</html> 
