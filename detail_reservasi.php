<?php
// Koneksi database
$servername = "localhost";
$username = "root";
$password = "";
$database = "db_hotel";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}

// Ambil ID dari URL
$id = isset($_GET['id']) ? $_GET['id'] : null;

// Jika ID tidak ada, alihkan ke halaman sebelumnya atau beri peringatan
if ($id === null) {
    echo "ID tidak ditemukan.";
    exit;
}

// Ambil data reservasi berdasarkan ID
$sql = "SELECT * FROM reservasi WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "Data reservasi tidak ditemukan.";
    exit;
}

// Menutup koneksi
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Reservasi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-image: url('https://cdn.villa-bali.com/cache/fullSize/villas/villa-emile/villa-emile-33-pool-night-d-5b29c04adca54.jpg');
            background-size: cover; /* Menyesuaikan ukuran gambar agar menutupi seluruh halaman */
            background-position: center; /* Menempatkan gambar di tengah */
            background-attachment: fixed; /* Membuat gambar latar belakang tetap ketika halaman digulir */
            padding: 20px;
        }

        .container {
            max-width: 900px;
            background: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 60px;
            border-radius: 40px;
            margin-top:4.5em;
        }
    </style>
</head>
<body>
    <?php include "navbar2.php"; ?>

    <div class="container">
        <h2 class="text-center">Bukti Reservasi</h2>

        <table class="table table-striped">
            <tr>
                <th>ID</th>
                <td><?php echo $row['id']; ?></td>
            </tr>
            <tr>
                <th>Nama</th>
                <td><?php echo $row['nama']; ?></td>
            </tr>
            <tr>
                <th>Umur</th>
                <td><?php echo $row['umur']; ?></td>
            </tr>
            <tr>
                <th>Jenis Kelamin</th>
                <td><?php echo $row['jenis_kelamin']; ?></td>
            </tr>
            <tr>
                <th>Nama Kamar</th>
                <td><?php echo $row['nama_kamar']; ?></td>
            </tr>
            <tr>
                <th>Harga</th>
                <td>Rp. <?php echo number_format($row['harga'], 0, ",", "."); ?></td>
            </tr>
            <tr>
                <th>Tanggal Check-in</th>
                <td><?php echo $row['tanggal_check_in']; ?></td>
            </tr>
            <tr>
                <th>Tanggal Check-out</th>
                <td><?php echo $row['tanggal_check_out']; ?></td>
            </tr>
        </table>

        <a href="riwayat_reservasi.php" class="btn btn-primary">Kembali ke Riwayat Reservasi</a>
    </div>

</body>
</html>
