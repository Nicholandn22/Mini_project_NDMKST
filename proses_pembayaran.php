<?php
include "koneksi.php";
session_start();

// Periksa apakah koneksi berhasil
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Periksa apakah form sudah disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari session
    $idUser = $_SESSION['id_user'];
    $total_price = $_SESSION['total_price'];

    // Ambil data dari form
    $quantities = isset($_POST['quantity']) ? $_POST['quantity'] : array();
    $jenis_tiket = isset($_POST['jenis_tiket']) ? $_POST['jenis_tiket'] : array();
    $metode_pembayaran = isset($_POST['metode_pembayaran']) ? $_POST['metode_pembayaran'] : '';
    $id_tikets = $_POST['id_tiket'];

    // Masukkan data pesanan ke tabel pesanan
    $tanggal_pesan = date('Y-m-d');
    $query_pesanan = "INSERT INTO pesanan (total_harga, pembayaran, tanggal_pesan, id_user) 
                    VALUES ('$total_price', '$metode_pembayaran', '$tanggal_pesan', $idUser)";
    $result_pesanan = mysqli_query($conn, $query_pesanan);
    if (!$result_pesanan) {
        die("Error: " . mysqli_error($conn));
    }

    // Dapatkan id_pesanan yang baru saja digenerate
    $id_pesanan = mysqli_insert_id($conn);

    // Retrieve form data
    $first_names = $_POST['first_name'];
    $last_names = $_POST['last_name'];
    $emails = $_POST['email'];
    $phone_numbers = $_POST['phone_number'];

    // Iterate through each ticket and insert into the database
    for ($i = 0; $i < count($id_tikets); $i++) {
        $first_name = $first_names[$i];
        $last_name = $last_names[$i];
        $email = $emails[$i];
        $phone_number = $phone_numbers[$i];
        $id_tiket = $id_tikets[$i];

        // Insert the ticket buyer's details into the pemesan_tiket table
        $query = "INSERT INTO pemesan_tiket (namaDepan_pemesan, namaBelakang_pemesan, nomor_pemesan, email_pemesan, id_pesanan, id_tiket) 
                 VALUES ('$first_name', '$last_name', '$phone_number', '$email', '$id_pesanan', '$id_tiket')";

        $result = mysqli_query($conn, $query);

        if (!$result) {
            echo "Error: " . mysqli_error($conn);
            exit;
        }
    }

    // Redirect atau tampilkan halaman sukses pembayaran
    header("Location: success.php");
    exit();
}
?>
