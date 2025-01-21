
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sidebar</title>
    </head>
    <style>
        .sidebar {
            width: 250px;
            background-color: #333;
            color: white;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            padding: 1em;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 1em;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            margin-bottom: 10px;
            border-radius: 5px;
        }

        .sidebar a:hover {
            background-color: #575757;
        }

    </style>
    <body>
<div class="sidebar">
    <h2>Menu</h2>
    <a href="dashboard.php">Dashboard</a>
    <a href="daftar_kamar.php">Daftar Kamar</a>
    <a href="riwayat.php">Riwayat Reservasi</a>
    <a href="pengguna.php">Pengguna</a>
    <a href="logout.php">Logout</a>
</div>
</body>
</html>