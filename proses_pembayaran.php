<?php 
include "koneksi.php";
session_start();

// Menangani data yang dikirimkan melalui formulir
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mendapatkan data dari formulir
    $id_pesanan = $_POST['id_pesanan'];

    // Loop untuk mendapatkan data dari setiap tiket yang dipesan
    $counter = 0;
    while (isset($_POST['first_name_' . $counter])) {
        $namaDepan = $_POST['first_name_' . $counter];
        $namaBelakang = $_POST['last_name_' . $counter];
        $nomor = $_POST['phone_' . $counter];
        $email = $_POST['email_' . $counter];
        $id_tiket = $_POST['id_tiket_' . $counter];
        
        // Query SQL untuk memasukkan data ke dalam tabel pemesan_tiket
        $sql = "INSERT INTO pemesan_tiket (namaDepan_pemesan, namaBelakang_pemesan, nomor_pemesan, email_pemesan, id_pesanan, id_tiket)
        VALUES ('$namaDepan', '$namaBelakang', '$nomor', '$email', '$id_pesanan', '$id_tiket')";
        
        if ($conn->query($sql) === TRUE) {
            echo "Data telah berhasil dimasukkan.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $counter++;
    }

    // Tutup koneksi database
    $conn->close();
}

?>
