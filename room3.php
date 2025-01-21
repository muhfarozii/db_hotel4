<?php
// Informasi koneksi database
$servername = "localhost"; // Ganti dengan nama host Anda jika berbeda
$username = "root"; // Ganti dengan nama pengguna database Anda jika berbeda
$password = ""; // Ganti dengan kata sandi database Anda jika berbeda
$database = "db_hotel"; // Nama database

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $database);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}

// Memeriksa jika tombol Check In ditekan
if (isset($_POST['check_in'])) {
    // Mendapatkan data dari form
    $nama = $_POST['nama'];
    $umur = $_POST['umur'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $nama_kamar = "suite Room"; // Nilai otomatis untuk nama kamar
    $harga = 780000.00; // Nilai otomatis untuk harga
    $tanggal_check_in = $_POST['tanggal_check_in'];
    $tanggal_check_out = $_POST['tanggal_check_out'];

    // Cek apakah sudah ada reservasi dengan nama dan tanggal check-in yang sama
    $check_query = "SELECT * FROM reservasi WHERE nama = ? AND tanggal_check_in = ?";
    $stmt_check = $conn->prepare($check_query);
    $stmt_check->bind_param("ss", $nama, $tanggal_check_in);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        // Jika sudah ada, tampilkan pesan error
        echo "Error: Reservasi dengan nama dan tanggal check-in tersebut sudah ada!";
    } else {
        // Jika belum ada, lanjutkan dengan penyimpanan data
        $stmt = $conn->prepare("INSERT INTO reservasi (nama, umur, jenis_kelamin, nama_kamar, harga, tanggal_check_in, tanggal_check_out) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sissdss", $nama, $umur, $jenis_kelamin, $nama_kamar, $harga, $tanggal_check_in, $tanggal_check_out);

        // Menjalankan perintah dan memeriksa apakah berhasil
        if ($stmt->execute()) {
            // Mengarahkan ke riwayat.php
            header("Location: riwayat_reservasi.php");
            exit(); // Hentikan eksekusi skrip lebih lanjut
        } else {
            echo "Error: " . $stmt->error;
        }

        // Menutup statement
        $stmt->close();
    }

    // Menutup statement pengecekan
    $stmt_check->close();
}



// Menutup koneksi
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Page with Slider and List</title>
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

        .form-reservasi {
            margin-top: 24px;
            margin-bottom: 16px;
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

        .btn.btn-primary {
            float: right;
            color: white;
            background-color: #007BFF;
            border-radius: 24px;
            padding: 10px 15px;
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

        <!-- Carousel -->
        <div class="carousel-container">
            <div id="imageCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="https://th.bing.com/th/id/R.d92073f9d0baf6c734a288d531fa932b?rik=KfkJ%2fgTQDGO4uA&riu=http%3a%2f%2fwww.seasidepropertiesgroup.com%2fupload%2fcondobuilding%2fslideshow_img_20141030120438.jpg&ehk=IODvaQDG7VqTWKe%2ffJQsFA2cBm%2br03mw9781ivADUAk%3d&risl=&pid=ImgRaw&r=0" alt="Gambar 1">
                    </div>
                    <div class="carousel-item">
                        <img src="https://rarchitecture.com.au/wp-content/uploads/2021/08/5-1.jpg" alt="Gambar 2">
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
            <h2 class="nama-kamar">Suite Room</h2>
            <p class="deskripsi-kamar">
            Rasakan kemewahan dan kenyamanan tak tertandingi di Suite Room kami. Kamar ini dirancang untuk tamu yang menginginkan pengalaman menginap eksklusif, dengan ruang tidur terpisah, area lounge yang elegan, dan kamar mandi mewah yang dilengkapi dengan fasilitas premium. Nikmati fasilitas lengkap seperti TV layar datar, AC, mini-bar, serta akses ke layanan kamar 24 jam. Ideal untuk tamu bisnis atau pasangan yang mencari akomodasi istimewa dengan sentuhan privasi dan kemewahan.
            </p>
            <div class="star-rating">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <h4 class="price-room">Rp. 780.000</h4>
            <ul class="list-group">
                <li class="list-group-item"><i class="fas fa-wifi"></i>WiFi</li>
                <li class="list-group-item"><i class="fas fa-users"></i>2 People</li>
                <li class="list-group-item"><i class="fas fa-bath"></i>1 Bathroom</li>
                <li class="list-group-item"><i class="fas fa-snowflake"></i>AC</li>
                <li class="list-group-item"><i class="fas fa-tv"></i>TV</li>
            </ul>
        </div>

        <!-- Formulir Pendaftaran -->
        <h2 class="form-reservasi">Form Reservasi Kamar</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" id="nama" name="nama" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="umur">Umur:</label>
                <input type="number" id="umur" name="umur" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin:</label>
                <select id="jenis_kelamin" name="jenis_kelamin" class="form-control" required>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>

            <div class="form-group">
                <label for="tanggal_check_in">Tanggal Check-in:</label>
                <input type="date" id="tanggal_check_in" name="tanggal_check_in" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="tanggal_check_out">Tanggal Check-out:</label>
                <input type="date" id="tanggal_check_out" name="tanggal_check_out" class="form-control" required>
            </div>

            <button type="submit" name="check_in" class="btn btn-primary">Reservasi</button>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>