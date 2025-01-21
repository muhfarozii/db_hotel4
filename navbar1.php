<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
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
            justify-content: space-between;
            align-items: center;
            background-color: rgba(0, 0, 0, 0.7); /* semi-transparent background */
            padding: 1em;
            position: fixed; /* Keeps navbar at the top */
            top: 0;
            left: 0;
            z-index: 1000; /* Ensures navbar is above other elements */
        }

        .navbar a {
            color: white;
            text-decoration: none;
            padding: 0.5em 1em;
        }

        .navbar a:hover {
            background-color: rgba(255, 255, 255, 0.2); /* hover effect */
        }


        .navbar .menu a {
            margin-right: 1em;
        }

        .navbar .logo a {
            font-family: 'Italianno', cursive;
            font-size: 1.5em; /* Adjust font size as needed */
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <div class="navbar">
        <div class="logo">
            <a href="#">Luxury Hotel</a>
        </div>
        <div class="menu">
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        </div>
    </div>

</body>
</html>
