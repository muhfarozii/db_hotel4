<?php
// Konfigurasi database
$host = "localhost";
$username = "root";
$password = "";
$database = "db_hotel";

// Koneksi ke database
$conn = new mysqli($host, $username, $password, $database);

// Periksa koneksi
if ($conn->connect_error) {
    echo json_encode(["error" => "Koneksi database gagal: " . $conn->connect_error]);
    exit;
}

// Dapatkan parameter
$type = $_GET['type'] ?? '';
$type = $conn->real_escape_string($type); // Sanitasi parameter

// Tentukan query berdasarkan tipe data
$query = '';
switch ($type) {
    case 'kamar':
        $query = "SELECT id AS kolom1, name AS kolom2 FROM rooms";
        break;

    case 'customer':
        $query = "SELECT DISTINCT nama AS kolom1, umur AS kolom2 FROM reservasi";
        break;

    default:
        echo json_encode(["error" => "Tipe data tidak valid"]);
        exit;
}

// Eksekusi query
$result = $conn->query($query);

if (!$result) {
    echo json_encode(["error" => "Query gagal: " . $conn->error]);
    $conn->close();
    exit;
}

// Periksa hasil query
if ($result->num_rows > 0) {
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);
} else {
    echo json_encode(["error" => "Tidak ada data ditemukan"]);
}

// Tutup koneksi
$conn->close();
?>
