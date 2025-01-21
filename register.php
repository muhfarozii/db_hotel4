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
    die("Koneksi ke database gagal: " . $conn->connect_error);
}

// Memeriksa jika tombol Daftar ditekan
if (isset($_POST['register'])) {
    // Mendapatkan data dari form
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $birthdate = $_POST['birthdate'];
    $gender = $_POST['gender'];

    // Menggunakan prepared statement untuk mencegah SQL injection
    $stmt = $conn->prepare("INSERT INTO `daftar_pengguna` (username, email, password, phone, birthdate, gender) VALUES (?, ?, ?, ?, ?, ?)");

    if ($stmt) {
        $stmt->bind_param("ssssss", $username, $email, $password, $phone, $birthdate, $gender);

        // Mengeksekusi query
        if ($stmt->execute()) {
            // Mengarahkan ke berhasil_register.php
            header("Location: berhasil_register.php");
            exit(); // Hentikan eksekusi skrip lebih lanjut
        } else {
            echo "Error: " . $stmt->error;
        }

        // Menutup statement
        $stmt->close();
    } else {
        echo "Terjadi kesalahan pada pernyataan SQL: " . $conn->error;
    }
}

// Menutup koneksi
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register Page</title>
    <style>
        /* Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-image: url('https://cdn.villa-bali.com/cache/fullSize/villas/villa-emile/villa-emile-33-pool-night-d-5b29c04adca54.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: white;
        }

        .register-container {
            width: 400px;
            padding: 1.5em;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            border-radius: 8px;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin-top:6em;
        }

        .register-form {
            width: 100%;
            display: flex;
            flex-direction: column;
        }

        .register-form h2 {
            margin-bottom: 0.5em;
            color: white;
            text-align: center;
        }

        .register-form label {
            margin-bottom: 0.5em;
            font-weight: bold;
            align-self: flex-start;
        }

        .register-form input, .register-form select {
            width: 100%;
            padding: 0.5em;
            margin-bottom: 1em;
            border: 1px solid #d0d0d0;
            border-radius: 20px;
            font-size: 16px;
            color: black;
        }

        .gender-container {
            display: flex;
            flex-direction: row;
            gap: 1em;
            align-items: center;
            margin-bottom: 0.5em;
            margin-top:1em;
        }

        .gender-item {
            display: flex;
            align-items: center;
            gap: 0.5em;
        }

        .register-form button {
            width: 100%;
            padding: 0.5em;
            background-color: #6200ff;
            color: rgb(255, 255, 255);
            border: none;
            border-radius: 20px;
            cursor: pointer;
            font-size: 18px;
        }

        .register-form button:hover {
            background-color: #00c414;
        }
    </style>
</head>
<body>
<?php include 'navbar1.php'; ?>
    <div class="register-container">
        <div class="register-form">
            <h2>Register</h2>
            <form action="" method="post">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>

                <label for="email">E-mail</label>
                <input type="text" id="email" name="email" required>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>

                <label for="phone">Nomor Telepon</label>
                <input type="text" id="phone" name="phone" required>

                <label for="birthdate">Tanggal Lahir</label>
                <input type="date" id="birthdate" name="birthdate" required>

                <label>Jenis Kelamin</label>
                <div class="gender-container">
                    <div class="gender-item">
                        <label for="male">Pria</label>
                        <input type="radio" id="male" name="gender" value="Pria" required>
                    </div>
                    <div class="gender-item">
                        <label for="female">Wanita</label>
                        <input type="radio" id="female" name="gender" value="Wanita" required>
                    </div>
                </div>

                <button type="submit" name="register">Daftar</button>
            </form>
        </div>
    </div>
</body>
</html>
