<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .content {
            margin-left: 270px;
            padding: 20px;
        }

        .dashboard-card {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            flex: 1;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            color: white;
            text-align: center;
            cursor: pointer;
        }

        .card.green { background-color: #28a745; }
        .card.red { background-color: #dc3545; }

        .table-container, .login-container {
            margin-top: 30px;
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .button-green {
            display: inline-block;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            text-align: center;
            text-decoration: none;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <?php include 'sidebar.php'; ?>
    <div class="content">
        <h1>Dashboard</h1>
        <p>Selamat datang di Sistem Hotel.</p>

        <?php
        $host = "localhost";
        $username = "root";
        $password = "";
        $database = "db_hotel";

        $conn = new mysqli($host, $username, $password, $database);

        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        $query_kamar = "SELECT COUNT(*) AS total_kamar FROM rooms";
        $query_customer = "SELECT COUNT(DISTINCT nama) AS total_customer FROM reservasi";

        $total_kamar = $conn->query($query_kamar)->fetch_assoc()['total_kamar'];
        $total_customer = $conn->query($query_customer)->fetch_assoc()['total_customer'];
        ?>

        <!-- Dashboard Cards -->
        <div class="dashboard-card">
            <div class="card green" onclick="loadData('kamar')">
                <h3>Jumlah Kamar</h3>
                <p><?php echo $total_kamar; ?></p>
            </div>
            <div class="card red" onclick="loadData('customer')">
                <h3>Jumlah Pengguna</h3>
                <p><?php echo $total_customer; ?></p>
            </div>
        </div>

        <!-- Detail Login -->
        <div class="login-container">
    <h3>Detail Login</h3>
    <div style="display: flex; flex-direction: column; gap: 10px;">
        <div>
            <strong>Username:</strong> <span>admin</span>
        </div>
        <div>
            <strong>Hak Akses:</strong> <a class="button-green">Admin Login</a>
        </div>
    </div>
</div>


        <!-- Table Data -->
        <div id="table-container" class="table-container" style="display: none;">
            <h3 id="table-title">Data</h3>
            <table id="data-table">
                <thead>
                    <!-- Header tabel akan dimuat di sini -->
                </thead>
                <tbody>
                    <!-- Data tabel akan dimuat di sini -->
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function loadData(type) {
            const container = document.getElementById('table-container');
            const tableTitle = document.getElementById('table-title');
            const tableHead = document.getElementById('data-table').querySelector('thead');
            const tableBody = document.getElementById('data-table').querySelector('tbody');

            // Reset konten tabel
            tableHead.innerHTML = '';
            tableBody.innerHTML = '<tr><td colspan="2">Loading...</td></tr>';
            container.style.display = 'block';

            // Tentukan judul dan header tabel berdasarkan tipe data
            let title = '';
            let headers = '';

            if (type === 'customer') {
                title = 'Data Customer';
                headers = `
                    <tr>
                        <th>Nama</th>
                        <th>Umur</th>
                    </tr>
                `;
            } else if (type === 'kamar') {
                title = 'Data Kamar';
                headers = `
                    <tr>
                        <th>Kode Kamar</th>
                        <th>Nama Kamar</th>
                    </tr>
                `;
            }

            tableTitle.textContent = title;
            tableHead.innerHTML = headers;

            // Fetch data dari server
            fetch(`load_data.php?type=${type}`)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        tableBody.innerHTML = `<tr><td colspan="2">${data.error}</td></tr>`;
                        return;
                    }
                    tableBody.innerHTML = data.map(row => `
                        <tr>
                            <td>${row.kolom1}</td>
                            <td>${row.kolom2}</td>
                        </tr>
                    `).join('');
                })
                .catch(error => {
                    console.error(error);
                    tableBody.innerHTML = '<tr><td colspan="2">Terjadi kesalahan.</td></tr>';
                });
        }
    </script>
</body>
</html>
