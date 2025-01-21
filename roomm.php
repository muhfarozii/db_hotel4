<?php
// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'db_hotel');

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mendapatkan ID kamar terbaru dari database (urutan dari kecil ke besar)
$query = "SELECT id FROM rooms ORDER BY id DESC LIMIT 1";
$result = $conn->query($query);

// Mengambil ID kamar pertama (terkecil)
$id_kamar = 1;  // Default ke 1 jika tidak ditemukan
if ($result && $result->num_rows > 0) {
    $room_data = $result->fetch_assoc();
    $id_kamar = $room_data['id'];  // ID kamar pertama dari urutan terkecil
}

// Mendapatkan data kamar berdasarkan ID
$query = "SELECT * FROM rooms WHERE id = $id_kamar";
$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
    $room = $result->fetch_assoc();
} else {
    echo "Kamar tidak ditemukan.";
    exit();
}

// Memeriksa jika tombol Check In ditekan
if (isset($_POST['check_in'])) {
    $nama = $_POST['nama'];
    $umur = $_POST['umur'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tanggal_check_in = $_POST['tanggal_check_in'];
    $tanggal_check_out = $_POST['tanggal_check_out'];

    // Menyimpan data reservasi
    $stmt = $conn->prepare("INSERT INTO reservasi (nama, umur, jenis_kelamin, nama_kamar, harga, tanggal_check_in, tanggal_check_out) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sissdss", $nama, $umur, $jenis_kelamin, $room['name'], $room['price'], $tanggal_check_in, $tanggal_check_out);

    if ($stmt->execute()) {
        header("Location: riwayat_reservasi.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran Kamar</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }
        .carousel-container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
        }
        .carousel-inner img {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 15px;
        }
        .content {
            margin-top: 30px;
        }
        .list-group-item {
            font-size: 1.2em;
            display: flex;
            align-items: center;
        }
        .list-group-item i {
            margin-right: 10px;
        }
        .form-group {
            margin-bottom: 1.5em;
        }
        .star-rating {
            color: gold;
            font-size: 1em;
            margin-bottom: 10px;
        }
        .back-button {
            position: absolute;
            top: 10px;
            left: 10px;
        }

        .nama-kamar {
            font-weight: bold;
        }

        .deskripsi-kamar {
            margin-bottom: 8px;
        }

        .price-room {
            margin-top: 8px;
            margin-bottom: 16px;
        }

        .form-reservasi {
            margin-top: 24px;
            margin-bottom: 16px;
        }

        .btn.btn-primary {
            color: white;
            background-color: #007bff;
            border-radius: 24px;
            padding: 10px 16px;
            border: none;
            float: right;
            margin-bottom: 16px;
        }
    </style>
    
</head>
<body>
    <div class="container">
        <!-- Tombol Back -->
        <a href="javascript:history.back()" class="btn btn-secondary back-button">
            <i class="fas fa-arrow-left"></i> Back
        </a>

        <!-- Carousal -->
        <div class="carousel-container">
            <div id="imageCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <!-- Gambar kamar menggunakan URL yang ada di database -->
                        <img src="<?php echo $room['image_url']; ?>" alt="Gambar Kamar" class="d-block w-100">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#imageCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#imageCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>

        <!-- Content Section -->
        <div class="content">
            <h2 class="nama-kamar"><?php echo htmlspecialchars($room['name']); ?></h2>
            <p class="deskripsi-kamar"><?php echo nl2br(htmlspecialchars($room['description'])); ?></p>
            <div class="star-rating">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <h4 class="price-room">Rp. <?php echo number_format($room['price'], 0, ',', '.'); ?></h4>
            <ul class="list-group">
                <?php
                // Pastikan facilities terdecode dengan benar
                $facilities = json_decode($room['facilities'], true);
                if (is_array($facilities)) {
                    foreach ($facilities as $key => $value) {
                        echo "<li class='list-group-item'><i class='fas fa-" . strtolower($key) . "'></i> $key: $value</li>";
                    }
                } else {
                    echo "<li class='list-group-item'>Fasilitas tidak tersedia.</li>";
                }
                ?>
            </ul>
        </div>

        <!-- Formulir Pendaftaran -->
        <h2 class="form-reservasi">Form Pendaftaran Kamar</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="nama">Nama Lengkap:</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="umur">Umur:</label>
                <input type="number" class="form-control" id="umur" name="umur" required>
            </div>
            <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin:</label>
                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="tanggal_check_in">Tanggal Check-In:</label>
                <input type="date" class="form-control" id="tanggal_check_in" name="tanggal_check_in" required>
            </div>
            <div class="form-group">
                <label for="tanggal_check_out">Tanggal Check-Out:</label>
                <input type="date" class="form-control" id="tanggal_check_out" name="tanggal_check_out" required>
            </div>
            <button type="submit" name="check_in" class="btn btn-primary">Check In</button>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
