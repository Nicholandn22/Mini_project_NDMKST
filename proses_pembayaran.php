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

    // Masukkan data pesanan ke tabel pesanan
    $tanggal_pesan = date('Y-m-d');
    $query_pesanan = "INSERT INTO pesanan (total_harga, pembayaran, tanggal_pesan, id_user) 
                    VALUES ('$total_price', '$metode_pembayaran', '$tanggal_pesan', $idUser)";
    $result_pesanan = mysqli_query($conn, $query_pesanan);
    if (!$result_pesanan) {
        die("Error: " . mysqli_error($conn));
    }
    $id_pesanan = mysqli_insert_id($conn); // Dapatkan ID pesanan yang baru saja dimasukkan

    // Sekarang, masukkan detail tiket ke dalam tabel detail_pesanan
    $counter = 0;
    foreach ($quantities as $id_tiket => $quantity) {
        if ($quantity > 0) {
            // Ambil data pemesan dari form
            $nama_depan = isset($_POST['first_name'][$counter]) ? $_POST['first_name'][$counter] : '';
            $nama_belakang = isset($_POST['last_name'][$counter]) ? $_POST['last_name'][$counter] : '';
            $email = isset($_POST['email'][$counter]) ? $_POST['email'][$counter] : '';
            $nomor_telepon = isset($_POST['phone_number'][$counter]) ? $_POST['phone_number'][$counter] : '';

            // Query INSERT untuk memasukkan data pemesan ke dalam tabel
            $query_insert_pemesan = "INSERT INTO pemesan_tiket (namaDepan_pemesan, namaBelakang_pemesan, email_pemesan, nomor_pemesan, id_pesanan, id_tiket) 
                                VALUES ('$nama_depan', '$nama_belakang', '$email', '$nomor_telepon', $id_pesanan, $id_tiket)";
            $result_insert_pemesan = mysqli_query($conn, $query_insert_pemesan);
            if (!$result_insert_pemesan) {
                die("Error: " . mysqli_error($conn));
            }
        }
        $counter++;
    }

    // Redirect atau tampilkan halaman sukses pembayaran
    // header("Location: success.php");
    // exit();
}
?>
