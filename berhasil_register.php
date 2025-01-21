<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Berhasil</title>
    <link rel="stylesheet" href="styles.css">
</head>
<link href="https://fonts.googleapis.com/css2?family=Italianno&display=swap" rel="stylesheet">
<style>
    body {
    margin: 0;
    padding: 0;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background-image: url('https://cdn.villa-bali.com/cache/fullSize/villas/villa-emile/villa-emile-33-pool-night-d-5b29c04adca54.jpg');
    background-size: cover;
    background-position: center;
    font-family: Arial, sans-serif;
}

.content {
    text-align: center;
    background-color: rgba(0, 0, 0, 0.5); /* Transparansi untuk membuat teks lebih terlihat */
    padding: 20px;
    border-radius: 10px;
    color: white;
}

h1 {
    font-size: 2em;
    margin-bottom: 20px;
}

.login-button {
    display: inline-block;
    padding: 10px 20px;
    background-color: #4CAF50; /* Warna hijau */
    color: white;
    text-decoration: none;
    font-size: 1em;
    border-radius: 5px;
}

.login-button:hover {
    background-color: #45a049;
}

    </style>
    <style>
        /* Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0; /* Light background color */
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            color: black; /* Ensures text visibility */
        }

        /* Navbar Styles */
        .navbar {
            width: 100%;
            display: flex;
            justify-content: flex-start; /* Align items to the start (left) */
            align-items: center;
            background-color: rgba(0, 0, 0, 0.7); /* semi-transparent background */
            padding: 1em;
            position: fixed; /* Keeps navbar at the top */
            top: 0;
            left: 0;
            z-index: 1000; /* Ensures navbar is above other elements */
        }

        .navbar .logo a {
            font-family: 'Italianno', cursive;
            font-size: 1.5em; /* Adjust font size as needed */
            color: white;
            text-decoration: none;
            margin-left: 1em; /* Add margin for better spacing */
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <div class="navbar">
        <div class="logo">
            <a href="#">Luxury Hotel</a>
        </div>
        
    </div>

</body>
<body>
    <div class="content">
        <h1>Register telah berhasil, lakukan login</h1>
        <a href="login.php" class="login-button">Login</a>
    </div>
</body>
</html>
