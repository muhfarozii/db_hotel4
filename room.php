<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="room.css">
</head>
<style>
    body {
        margin: 0;
        display: flex;
        justify-content: center;
        /* align-items: center; */
        font-family: Arial, sans-serif;
        background-color: #fffaf0; /* Warna latar belakang krem */
    }

    .carousel-inner {
        width: 100%;
        height:600px;

    }
    
    .navbar {
        background-color: rgba(255, 255, 255, 0.8);
    }

    .carousel-container {
        position: relative;
        width: 100%;
        margin-top: 400px;
    }

    .carousel-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
    pointer-events: none; /* Agar tidak mengganggu interaksi */
    }

    .carousel-inner img {
        width: 100%;
        height: 600px;
        object-fit: cover;
    }

    .fixed-text {
        position: absolute;
        top: 80%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
        text-align: center;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
    }

    .rooms-section {
        padding: 2em 0;
    }

    .room-card {
        width: 100%;
        height: 420px;
        margin-bottom: 1.5em;
        background-color: white;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        /* overflow: hidden; */
        transition: transform 0.3s ease;
    }

    .room-card:hover {
        transform: translateY(-5px); /*efek hover*/
    }

    .room-card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 4px;
    }

    .room-card h5 {
        margin-top: 10px;
        font-size: 1.25rem;
        font-weight: bold;
    }

    .room-card h6 {
        color: #007bff;
        font-size: 1.1rem;
        margin: 10px 0;
    }

    .room-card p {
        font-size: 0.9rem;
        color: #666;
        margin: 10px 0;
        line-height: 1.5;
    }

    .room-card a {
        display: block;
        text-align: center;
        margin: 10px 0;
        padding: 10px;
        background-color: #007bff;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    /* .room-card a {
        background-color:  #0056b3;
    } */

    .footer {
        text-align: center;
        padding: 1em;
        background-color: #f8f9fa;
    }
</style>
<body>
    <?php include "navbar2.php"; ?>

    <div class="hero">
        <img src ="https://img.freepik.com/free-photo/cozy-hotel-reception-with-two-female-guests-waiting-concierge-finalize-booking-procedure-relaxed-customers-holding-baggages-getting-ready-check-lavish-resort_482257-67961.jpg?t=st=1737008721~exp=1737012321~hmac=7387a299dd542cb5697932ee73c47d74f123d841db218de78dd4b78779276bb9&w=826" alt = "gambar hotel">
    </div>
    <div>Carousel</div>
    <div class="carousel-container">
        <div id="roomCarousel" class="carousel-slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://p.turbosquid.com/ts-thumb/Ee/2q3jS9/eebABQOX/3d_bedroom_01/jpg/1464092554/1920x1080/fit_q87/efef351848417e3b5bd2274e805c92766f34cbb2/3d_bedroom_01.jpg" alt="Room 1">
                </div>
                <div class="carousel-item">
                    <img src="https://mir-s3-cdn-cf.behance.net/project_modules/1400/73a896143845407.6283ecd19f081.jpg" alt="Room 2">
                </div>
                <div class="carousel-item">
                    <img src="https://ik.imagekit.io/pashouses/pandu/pages/wp-content/uploads/2023/05/Studio-Munge-Esplanade-master-bedroom.jpg" alt="Room 3">
                </div>
            </div>
        </div>
        <div class="fixed-text">
            <h2>Welcome to Our Rooms</h2>
            <p>Discover the luxurious rooms available at our hotel.</p>
        </div>
    </div>

    <!-- Rooms Section -->
    <div class="rooms-section container">
        <div class="row">
            <?php
            // Koneksi ke database
            $conn = new mysqli("localhost", "root", "", "db_hotel");

            // Cek koneksi
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Query untuk mengambil data rooms
            $sql = "SELECT name, image_url, price, description FROM rooms";
            $result = $conn->query($sql);

            // Menampilkan data
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Menentukan parameter 'type' berdasarkan nama kamar
                    $type = '';
                    if ($row["name"] === "Deluxe Room") {
                        $type = "room1";
                    } elseif ($row["name"] === "Executive Room") {
                        $type = "room2";
                    } elseif ($row["name"] === "Suite Room") {
                        $type = "room3";
                    } elseif ($row["name"] === "Modern Suite") {
                        $type = "room4";
                    } elseif ($row["name"] === "Family Room") {
                        $type = "room5";
                    } elseif ($row["name"] === "Presidential Suite") {
                        $type = "room6";
                    } elseif ($row["name"] === "Romance Room") {
                        $type = "room7";
                    } elseif ($row["name"] === "Superior Room") {
                        $type = "room8";
                    } else {
                        $type = "room_default"; // Default untuk kamar lain
                    }

                    echo '
                    <div class="col-md-4">
                        <div class="room-card">
                            <img src="' . htmlspecialchars($row["image_url"]) . '" alt="' . htmlspecialchars($row["name"]) . '">
                            <h5>' . htmlspecialchars($row["name"]) . '</h5>
                            <h6>Rp. ' . number_format($row["price"], 0, ',', '.') . '</h6>
                            <p>' . (!empty($row["description"]) ? htmlspecialchars($row["description"]) : "Deskripsi tidak tersedia.") . '</p>
                            <a href="';

                            // Logika untuk menentukan URL berdasarkan nama kamar
                            if ($row["name"] === "Deluxe Room") {
                                echo 'room1.php?type=' . urlencode($type);
                            }elseif($row["name"] === "Executive Room") {
                                echo 'room2.php?type=' . urlencode($type);
                            } elseif ($row["name"] === "Suite Room") {
                                echo 'room3.php?type=' . urlencode($type);
                            } elseif ($row["name"] === "Modern Suite") {
                                echo 'room4.php?type=' . urlencode($type);
                            } elseif ($row["name"] === "Family Room") {
                                echo 'room5.php?type=' . urlencode($type);
                            } elseif ($row["name"] === "Presidential Suite") {
                                echo 'room6.php?type=' . urlencode($type);
                            } elseif ($row["name"] === "Romance Room") {
                                echo 'room7.php?type=' . urlencode($type);
                            } elseif ($row["name"] === "Superior Room") {
                                echo 'room8.php?type=' . urlencode($type);
                            } else {
                                echo 'roomm.php?type=' . urlencode($type);
                            }

                            echo '" class="btn btn-primary">Cek</a>
                        </div>
                    </div>';
                }
            } else {
                echo "<p>No rooms available.</p>";
            }

            // Menutup koneksi
            $conn->close();
            ?>
        </div>
    </div>

    <footer class="footer">
        <p>&copy; 2024 Luxury Hotel. Adem adem penake check in!</p>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
