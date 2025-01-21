<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kamar</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin-left: 250px; /* Memberikan ruang untuk sidebar */
        }

        .container {
            margin-top: 50px;
        }

        .rooms-section .room-card {
            border: 1px solid #ddd;
            padding: 20px;
            text-align: center;
            border-radius: 5px;
        }

        .rooms-section img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 5px;
        }

        .room-card h5 {
            margin-top: 15px;
            font-size: 1.25rem;
        }

        .room-actions {
            margin-top: 20px;
        }

        .room-actions button {
            margin-right: 10px;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            padding: 10px;
            background-color: #f8f9fa;
        }

        .add-room-btn {
            display: block;
            margin: 20px auto;
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-align: center;
        }

        .add-room-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <?php include 'sidebar.php'; ?>
    <!-- Main Content -->

    <div class="container">
        <h2 class="text-center">Daftar Kamar</h2>
        <div class="rooms-section">
            <div class="row">

            <?php
                $conn = new mysqli('localhost', 'root', '', 'db_hotel');
                
                if ($conn->connect_error) {
                    die("Koneksi gagal: " . $conn->connect_error);
                }

                if (isset($_GET['message'])) {
                    echo '<div class="alert alert-info text-center">' . htmlspecialchars($_GET['message']) . '</div>';
                }

                $sql = "SELECT * FROM rooms";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '
                        <div class="col-md-4">
                            <div class="room-card">
                                <img src="' . $row['image_url'] . '" alt="' . $row['name'] . '">
                                <h5>' . $row['name'] . '</h5>
                                <p>Rp. ' . number_format($row['price'], 2, ',', '.') . '</p>
                                <div class="room-actions">
                                    <a href="hapus_kamar.php?id=' . $row['id'] . '" class="btn btn-danger" onclick="return confirm(\'Apakah Anda yakin ingin menghapus kamar ini?\');">Hapus</a>
                                </div>
                            </div>
                        </div>';
                    }
                } else {
                    echo "<p>Belum ada kamar yang ditambahkan.</p>";
                }

                $conn->close();
            ?>

            </div>
        </div>

        <!-- Add Room Button -->
        <a href="tambah_kamar.php" class="add-room-btn">Tambah Kamar</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script> 
    <script>
        $(document).ready(function(){
            $('#roomCarousel').carousel({
                interval: 4000
            });
        });
    </script>
</body>
</html>
