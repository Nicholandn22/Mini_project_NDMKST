<?php
include "koneksi.php";

if ($_GET) {
    $id_pemesanTiket = $_GET['id'];

    if (!empty($id_pemesanTiket)) {
            $id_pemesanTiket = intval($id_pemesanTiket);
            echo "<p>Deleting ID: $id_pemesanTiket</p>"; // Debug output

            // Use separate queries for deletion
            $sql1 = "DELETE FROM pemesan_tiket WHERE id_pesanan = $id_pemesanTiket";
            $sql2 = "DELETE FROM pesanan WHERE id_pesanan = $id_pemesanTiket";

            if (!mysqli_query($conn, $sql1)) {
                echo '<h3>Gagal Menghapus Data dari pemesan_tiket</h3>';
                echo mysqli_error($conn);
            } else {
                echo '<h3>Berhasil Menghapus Data dari pemesan_tiket</h3>';
            }

            if (!mysqli_query($conn, $sql2)) {
                echo '<h3>Gagal Menghapus Data dari pesanan</h3>';
                echo mysqli_error($conn);
            } else {
                echo '<h3>Berhasil Menghapus Data dari pesanan</h3>';
            }
        header("Location: keranjang.php");
        exit;
    } else {
        echo '<h3>Tidak ada tiket yang dipilih untuk dihapus atau ID tidak berupa array</h3>';
    }
}
?>
