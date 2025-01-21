<?php
session_start();

// Koneksi ke database
$servername = "localhost";
$username_db = "root";
$password_db = "";
$database = "db_hotel";

$register_message = "";

// Membuat koneksi
$conn = new mysqli($servername, $username_db, $password_db, $database);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}

// Memeriksa jika tombol Login ditekan
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Jika pengguna adalah admin dengan kredensial khusus
    if ($username === "admin" && $email === "admin@gmail.com" && $password === "123") {
        $_SESSION["username"] = "admin";
        $_SESSION["is_login"] = true;
        $_SESSION['admin_logged_in'] = "true";

        header("Location: dashboard.php");
        exit;
    } else {
        // Menggunakan prepared statement untuk keamanan
        $sql = "SELECT * FROM `daftar_pengguna` WHERE username = ? AND email = ? AND password = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("sss", $username, $email, $password);
            $stmt->execute();
            $result = $stmt->get_result();

            // Memeriksa apakah hasil query menghasilkan setidaknya satu baris
            if ($result->num_rows > 0) {
                $data = $result->fetch_assoc();
                $_SESSION["username"] = $data["username"];
                $_SESSION["is_login"] = true;

                header("Location: home.php");
                exit; // Hentikan eksekusi skrip setelah redirect
            } else {
                $register_message = "Akun belum terdaftar!";
            }

            $stmt->close();
        } else {
            $register_message = "Terjadi kesalahan pada server.";
        }
    }
}

// Menutup koneksi
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- Google Fonts link for Italianno -->
    <link href="https://fonts.googleapis.com/css2?family=Italianno&display=swap" rel="stylesheet">
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

        .login-container {
            width: 400px;
            padding: 2em;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            border-radius: 8px;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .login-form {
            width: 100%;
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .login-form h2 {
            margin-bottom: 1em;
            color: white;
            text-align: center;
        }

        .login-form label {
            margin-bottom: 16px;
            font-weight: bold;
            align-self: flex-start;
        }

        .login-form input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            border: 1px solid #d0d0d0;
            border-radius: 20px;
            font-size: 16px;
            color: black;
            margin-bottom: 16px;
        }

        .login-form button {
            width: 100%;
            padding: 0.5em;
            background-color: #6200ff;
            color: rgb(255, 255, 255);
            border: none;
            border-radius: 20px;
            cursor: pointer;
            font-size: 18px;
        }

        .login-form button:hover {
            background-color: #00c414;
        }

        .login-form i {
            color: red;
        }

        .close-button {
            width: 100%;
            padding: 0.5em;
            background-color: #ff0000;
            color: rgb(255, 255, 255);
            border: none;
            border-radius: 20px;
            cursor: pointer;
            font-size: 18px;
            margin-top: 1em;
        }

        .close-button:hover {
            background-color:rgb(238, 15, 15);
        }
    </style>
</head>
<body>
<?php include 'navbar1.php'; ?>
    <div class="login-container">
        <div class="login-form">
            <h2>Login</h2>
            <form action="login.php" method="POST">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" required>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <?php echo "<i>$register_message</i>"; ?>
                <button type="submit" name="login">Masuk</button>
                <button type="button" class="close-button" onclick="window.location.href='home.php'">Kembali</button>
            </form>
        </div>
    </div>
</body>
</html>