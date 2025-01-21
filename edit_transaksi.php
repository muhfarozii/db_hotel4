<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "db_hotel";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $database);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mengambil data berdasarkan ID
    $sql = "SELECT * FROM reservasi WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Data tidak ditemukan.";
        exit();
    }
} else {
    echo "ID tidak ditemukan.";
    exit();
}

// Update data jika form disubmit
if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $umur = $_POST['umur'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $nama_kamar = $_POST['nama_kamar'];
    $harga = $_POST['harga'];
    $tanggal_check_in = $_POST['tanggal_check_in'];
    $tanggal_check_out = $_POST['tanggal_check_out'];

    // Query untuk mengupdate data
    $sql = "UPDATE reservasi SET 
            nama='$nama', 
            umur='$umur', 
            jenis_kelamin='$jenis_kelamin', 
            nama_kamar='$nama_kamar', 
            harga='$harga', 
            tanggal_check_in='$tanggal_check_in', 
            tanggal_check_out='$tanggal_check_out' 
            WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil diperbarui";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();

    // Redirect kembali ke halaman riwayat transaksi
    header("Location: riwayat.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Transaksi</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px;
            background-image: url('https://cdn.villa-bali.com/cache/fullSize/villas/villa-emile/villa-emile-33-pool-night-d-5b29c04adca54.jpg');
        }
        .container {
            max-width: 600px;
            background: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 40px;
            border-radius: 10px;
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">Edit Reservasi</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $row['nama']; ?>" required>
            </div>
            <div class="form-group">
                <label for="umur">Umur:</label>
                <input type="number" class="form-control" id="umur" name="umur" value="<?php echo $row['umur']; ?>" required>
            </div>
            <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin:</label>
                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                    <option value="Laki-laki" <?php if ($row['jenis_kelamin'] == 'Laki-laki') echo 'selected'; ?>>Laki-laki</option>
                    <option value="Perempuan" <?php if ($row['jenis_kelamin'] == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="nama_kamar">Nama Kamar:</label>
                <input type="text" class="form-control" id="nama_kamar" name="nama_kamar" value="<?php echo $row['nama_kamar']; ?>" required>
            </div>
            <div class="form-group">
                <label for="harga">Harga:</label>
                <input type="number" class="form-control" id="harga" name="harga" value="<?php echo $row['harga']; ?>" required>
            </div>
            <div class="form-group">
                <label for="tanggal_check_in">Tanggal Check-in:</label>
                <input type="date" class="form-control" id="tanggal_check_in" name="tanggal_check_in" value="<?php echo $row['tanggal_check_in']; ?>" required>
            </div>
            <div class="form-group">
                <label for="tanggal_check_out">Tanggal Check-out:</label>
                <input type="date" class="form-control" id="tanggal_check_out" name="tanggal_check_out" value="<?php echo $row['tanggal_check_out']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary" name="update">Update</button>
            <a href="riwayat.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
