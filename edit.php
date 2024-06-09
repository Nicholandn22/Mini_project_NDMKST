<?php
include "koneksi.php";
if ($_POST) {
    $id_pemesanTiket = $_POST['id_pemesanTiket'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    for ($i = 0; $i < count($id_pemesanTiket); $i++) {
        $namaDepan_pemesan = mysqli_real_escape_string($conn, $first_name[$i]);
        $namaBelakang_pemesan = mysqli_real_escape_string($conn, $last_name[$i]);
        $nomor_pemesan = mysqli_real_escape_string($conn, $phone[$i]);
        $email_pemesan = mysqli_real_escape_string($conn, $email[$i]);
        $id_pemesanTiket_item = intval($id_pemesanTiket[$i]);

        $sql = "UPDATE pemesan_tiket SET 
                namaDepan_pemesan = '$namaDepan_pemesan', 
                namaBelakang_pemesan = '$namaBelakang_pemesan', 
                nomor_pemesan = '$nomor_pemesan', 
                email_pemesan = '$email_pemesan'
                WHERE id_pemesanTiket = $id_pemesanTiket_item";

        if (!mysqli_query($conn, $sql)) {
            echo '<h3>Gagal Update Data</h3>';
            echo mysqli_error($conn);
        } else {
            echo '<h3>Berhasil Update Data</h3>';
            header("Location: keranjang.php");
            exit;
        }
    }
}
?>