<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
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
            background-color: #f0f0f0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            color: black;
        }

        /* Navbar Styles */
        .navbar {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: rgba(0, 0, 0, 0.7);
            padding: 1em;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            padding: 0.5em 1em;
        }

        .navbar a:hover {
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 30px;
        }

        .navbar .menu a {
            margin-right: 0.5em;
        }

        .navbar .menu a.disabled {
            pointer-events: none; /* Disable clicking */
            opacity: 0.5; /* Make it look disabled */
        }

        .navbar .logo a {
            font-family: 'Italianno', cursive;
            font-size: 1.5em;
        }

        .user-info {
            display: flex;
            align-items: center;
            color: white;
            margin-right: 3em;
            position: relative;
        }

        .user-info svg {
            width: 35px;
            height: 35px;
            margin-right: 0.5em;
            cursor: pointer;
        }

        .user-info .login-button {
            padding: 8px 20px;
            border: 2px solid white;
            border-radius: 32px;
        }

        .dropdown {
            display: none;
            position: absolute;
            top: 50px;
            right: 0;
            background-color: white;
            color: black;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            overflow: hidden;
        }

        .dropdown a {
            display: block;
            padding: 10px 20px;
            text-decoration: none;
            color: black;
        }

        .dropdown a:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="logo">
            <a href="home.php">Luxury Hotel</a>
        </div>
        
        <div class="menu">
            <a href="home.php">Home</a>
            <a href="room.php" class="<?php echo isset($_SESSION['username']) ? '' : 'disabled'; ?>">Room</a>
            <a href="riwayat_reservasi.php" class="<?php echo isset($_SESSION['username']) ? '' : 'disabled'; ?>">Riwayat Reservasi</a>
        </div>
        <div class="user-info">
            <?php if (isset($_SESSION["username"])): ?>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" id="user-icon">
                    <circle cx="50" cy="50" r="50" fill="#4CAF50" />
                    <text x="50" y="62" font-size="40" text-anchor="middle" fill="white" font-family="Arial">
                        <?php echo substr($_SESSION["username"], 0, 1); ?>
                    </text>
                </svg>
                <span><?php echo $_SESSION["username"]; ?></span>
                <div class="dropdown" id="dropdown-menu" style="display: none;">
                    <a href="logout.php">Logout</a>
                </div>
            <?php else: ?>
                <a href="login.php" class="login-button">Login</a>
            <?php endif; ?>
        </div>
    </div>

    <script>
        const userIcon = document.getElementById('user-icon');
        const dropdownMenu = document.getElementById('dropdown-menu');

        if (userIcon) {
            userIcon.addEventListener('click', () => {
                dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
            });

            window.addEventListener('click', (event) => {
                if (!event.target.closest('.user-info')) {
                    dropdownMenu.style.display = 'none';
                }
            });
        }
    </script>
</body>
</html>
