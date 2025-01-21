<?php
// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'db_hotel');

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mengecek apakah form disubmit
if (isset($_POST['submit'])) {
    // Mengambil data dari form
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image_url = $_POST['image_url'];
    $facilities = isset($_POST['facilities']) ? json_encode($_POST['facilities']) : '';  // Menggabungkan fasilitas yang dipilih menjadi array JSON
    $description = $_POST['description'];  // Menambahkan deskripsi kamar

    // Menghapus karakter selain angka untuk menyimpan harga sebagai angka murni
    $price = str_replace(['Rp', '.', ','], '', $price);

    // Query untuk memasukkan data ke tabel rooms
    $sql = "INSERT INTO rooms (name, price, image_url, facilities, description) VALUES ('$name', '$price', '$image_url', '$facilities', '$description')";

    if ($conn->query($sql) === TRUE) {
        $message = "Kamar berhasil ditambahkan!";
        header("Location: daftar_kamar.php?message=" . urlencode($message));
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kamar</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: 'Comic Sans MS', cursive, sans-serif;
            background: url('https://cdn.villa-bali.com/cache/fullSize/villas/villa-emile/villa-emile-33-pool-night-d-5b29c04adca54.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #4a4a4a;
        }

        .container {
            margin-top: 120px;
            text-align: center;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            max-width: 600px;
        }

        h2 {
            color: black;
            font-size: 32px;
            margin-top: 40px;
        }

        .form-group {
            margin-bottom: 1.5em;
        }

        .btn-primary {
            background-color:rgb(19, 120, 235);
            color: white;
            border-radius: 25px;
            padding: 12px 30px;
            font-size: 16px;
        }

        .btn-primary:hover {
            background-color:rgb(149, 155, 161);
        }

        .btn-batal {
            background-color:rgb(142, 158, 170);
            color: white;
            border-radius: 25px;
            padding: 12px 30px;
            font-size: 16px;
        }

        .btn-batal:hover {
            background-color:rgb(112, 130, 138);
        }

        .button-container {
            display: flex;
            justify-content: space-between;
        }

        .icon {
            font-size: 50px;
            margin-bottom: 20px;
            color:rgb(0, 119, 255);
        }

        .facility {
            display: inline-flex;
            align-items: center;
        }

        .facility i {
            margin-right: 8px;
        }

        .facility input[type="number"] {
            width: 50px;
            margin-left: 5px;
        }

        .form-control {
            width: 100%;
            display: inline-block;
        }

        textarea {
            width: 100%;
            height: 150px;
            resize: none;
        }
    </style>
</head>
<body>

    <!-- Main Content -->
    <div class="container">
        <h2>Tambah Kamar Baru</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label for="name">Nama Kamar:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="price">Harga:</label>
                <input type="text" id="price" name="price" class="form-control" oninput="formatCurrency(this)" required>
            </div>

            <div class="form-group">
                <label for="image_url">URL Gambar:</label>
                <input type="text" id="image_url" name="image_url" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="facilities">Fasilitas:</label><br>

                <div class="facility">
                    <i class="fas fa-wifi icon"></i>
                    <label for="wifi">WiFi</label>
                    <input type="number" name="facilities[WiFi]" min="1" placeholder="Jumlah" class="form-control" style="width: 80px; display: inline-block;">
                </div><br>

                <div class="facility">
                    <i class="fas fa-users icon"></i>
                    <label for="people">People</label>
                    <input type="number" name="facilities[People]" min="1" placeholder="Jumlah" class="form-control" style="width: 80px; display: inline-block;">
                </div><br>

                <div class="facility">
                    <i class="fas fa-bath icon"></i>
                    <label for="bathroom">Bathroom</label>
                    <input type="number" name="facilities[Bathroom]" min="1" placeholder="Jumlah" class="form-control" style="width: 80px; display: inline-block;">
                </div><br>

                <div class="facility">
                    <i class="fas fa-fan icon"></i>
                    <label for="ac">AC</label>
                    <input type="number" name="facilities[AC]" min="1" placeholder="Jumlah" class="form-control" style="width: 80px; display: inline-block;">
                </div><br>

                <div class="facility">
                    <i class="fas fa-tv icon"></i>
                    <label for="tv">TV</label>
                    <input type="number" name="facilities[TV]" min="1" placeholder="Jumlah" class="form-control" style="width: 80px; display: inline-block;">
                </div><br>

            </div>

            <!-- Form Deskripsi Kamar -->
            <div class="form-group">
                <label for="description">Deskripsi Kamar:</label>
                <textarea id="description" name="description" class="form-control" placeholder="Tuliskan deskripsi kamar" required></textarea>
            </div>

            <div class="button-container">
                <button type="submit" name="submit" class="btn btn-primary">Tambah Kamar</button>
                <button type="button" class="btn btn-batal" onclick="window.history.back()">Batal</button>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // Format input harga menjadi Rp. 00.000,00
        function formatCurrency(input) {
            let value = input.value.replace(/\D/g, "");
            value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            input.value = "Rp. " + value;
        }
    </script>
</body>
</html>
