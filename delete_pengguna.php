<?php
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

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus data
    $sql = "DELETE FROM daftar_pengguna WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);  // Menggunakan prepared statement dengan tipe data integer untuk ID

    if ($stmt->execute() === TRUE) {
        echo "Data berhasil dihapus";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();  // Menutup statement
    $conn->close();  // Menutup koneksi

    // Redirect kembali ke halaman pengguna
    header("Location:pengguna.php");
    exit();
} else {
    echo "ID tidak ditemukan.";
}
?>
