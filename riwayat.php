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

<div class="container">
    <div class="table-container">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Umur</th>
                    <th>Jenis Kelamin</th>
                    <th>Nama Kamar</th>
                    <th>Harga</th>
                    <th>Tanggal Check-in</th>
                    <th>Tanggal Check-out</th>
                    <th>Action</th>
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

                $sql = "SELECT * FROM reservasi";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['nama'] . "</td>";
                        echo "<td>" . $row['umur'] . "</td>";
                        echo "<td>" . $row['jenis_kelamin'] . "</td>";
                        echo "<td>" . $row['nama_kamar'] . "</td>";
                        echo "<td>Rp. " . number_format($row['harga'], 0, ",", ".") . "</td>";
                        echo "<td>" . $row['tanggal_check_in'] . "</td>";
                        echo "<td>" . $row['tanggal_check_out'] . "</td>";
                        echo "<td class='action-buttons'>
                                <a href='edit_transaksi.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Edit</a> 
                                <a href='delete_transaksi.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm delete-btn'>Hapus</a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='9' class='no-data'>Tidak ada data yang ditemukan</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    document.getElementById('search-input').addEventListener('input', function() {
        let filter = this.value.toUpperCase();
        let rows = document.querySelector("#transaction-table").rows;

        for (let i = 0; i < rows.length; i++) {
            let nameCol = rows[i].cells[1];
            let roomCol = rows[i].cells[4];
            if (nameCol || roomCol) {
                let nameText = nameCol.textContent || nameCol.innerText;
                let roomText = roomCol.textContent || roomCol.innerText;
                rows[i].style.display = 
                    nameText.toUpperCase().indexOf(filter) > -1 || roomText.toUpperCase().indexOf(filter) > -1 ? "" : "none";
            }
        }
    });

    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', event => {
            if (!confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                event.preventDefault();
            }
        });
    });
</script>

</body>

</html>
