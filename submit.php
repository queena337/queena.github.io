<?php
$host = "localhost";       
$user = "root";            
$password = "";            
$dbname = "portfolioqueenaps_db"; 

// Membuat koneksi
$conn = new mysqli($host, $user, $password, $dbname);

// Cek koneksi berhasil atau tidak
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Tangkap data dari form
$name = htmlspecialchars(trim($_POST['name']));
$email = htmlspecialchars(trim($_POST['email']));
$message = htmlspecialchars(trim($_POST['message']));

// Pengecekan jika data kosong
if (empty($name) || empty($email) || empty($message)) {
    die("Semua field harus diisi.");
}

// Persiapkan statement untuk insert data ke tabel
$stmt = $conn->prepare("INSERT INTO pesanqueena (name, email, message) VALUES (?, ?, ?)");
if ($stmt === false) {
    die("Error preparing the statement: " . $conn->error);
}

// Bind parameter
$stmt->bind_param("sss", $name, $email, $message);

// Eksekusi query
if ($stmt->execute()) {
    echo "Pesan berhasil dikirim!";
} else {
    echo "Terjadi kesalahan: " . $stmt->error;
}

// Tutup statement dan koneksi
$stmt->close();
$conn->close();
?>
