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
    $gambar_konser = $_SESSION['gambar_konser'];
    $judul_konser = $_SESSION['judul_konser'];
    $deskripsi_konser = $_SESSION['Deskripsi_konser'];
    $tanggal_konser = $_SESSION['tanggal_konser'];
    $waktu_konser = $_SESSION['jam_mulai'];
    $idUser = $_SESSION['id_user'];
    $total_price = $_SESSION['total_price'];


    // Ambil data dari form
    $quantities = $_POST['quantity'];
    $jenis_tiket = $_POST['jenis_tiket'];
    $metode_pembayaran = $_POST['metode_pembayaran'];

    // Hitung total harga
    // $total_price = 0;
    foreach ($quantities as $id_tiket => $quantity) {
        if ($quantity > 0) {
            // Ambil harga tiket dari database
            $query = "SELECT harga FROM tiket WHERE id_tiket = $id_tiket";
            $result = mysqli_query($conn, $query);
            if (!$result) {
                die("Error: " . mysqli_error($conn));
            }
            $row = mysqli_fetch_assoc($result);
            $harga_tiket = $row['harga'];

            // Hitung total harga tiket untuk jenis tiket ini
            
        }
    }

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
    // Anda bisa menggunakan $id_pesanan dan mengakses data tiket dari $quantities dan $jenis_tiket

    // Redirect atau tampilkan halaman sukses pembayaran
    header("Location: success.php");
    exit();
}

// Setelah mendapatkan data dari form
// Iterasi melalui data pemesan
foreach ($tickets_by_type as $type => $tickets) {
    foreach ($tickets as $ticket) {
        // Ambil data pemesan dari form
        $nama_depan = $_POST['first_name_' . $counter];
        $nama_belakang = $_POST['last_name_' . $counter];
        $email = $_POST['email_' . $counter];
        $nomor_telepon = $_POST['phone_number_' . $counter];

        // Query INSERT untuk memasukkan data pemesan ke dalam tabel
        $query_insert_pemesan = "INSERT INTO pemesan_tiket (namaDepan_pemesan, namaBelakang_pemesan, email_pemesan, nomor_pemesan, id_pesanan, id_tiket) 
                                VALUES ('$nama_depan', '$nama_belakang', '$email', '$nomor_telepon', $id_pesanan, $ticket)";
        $result_insert_pemesan = mysqli_query($conn, $query_insert_pemesan);
        if (!$result_insert_pemesan) {
            die("Error: " . mysqli_error($conn));
        }

        // Tambahkan counter untuk mengakses data pemesan berikutnya
        $counter++;
    }
}


?>
