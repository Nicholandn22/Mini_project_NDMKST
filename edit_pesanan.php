<?php
include "koneksi.php";
session_start();
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
$idUser = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : '';
$isLoggedIn = !empty($username);
$id = intval($_GET['id']);

$sql = "SELECT *
        FROM pesanan
        INNER JOIN pemesan_tiket ON pesanan.id_pesanan = pemesan_tiket.id_pesanan
        INNER JOIN tiket ON pemesan_tiket.id_tiket = tiket.id_tiket
        INNER JOIN konser ON tiket.id_konser = konser.id_konser
        WHERE pesanan.id_pesanan = {$id}";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $judul_konser = $row["judul_konser"];
    $deskripsi_konser = $row["Deskripsi_konser"];
    $tempat = $row["tempat"].', '.$row["kota"];
    $tanggal_konser = $row["tanggal_tiket"];
    $gambar_konser = $row["gambar_header"];
    $tanggal_pesan = strtotime($row['tanggal_pesan']);
    $editable_until = $tanggal_pesan + (24 * 60 * 60);
} else {
    echo "Data yang akan diedit tidak ada.";
    if (!$result) {
        echo "Error: " . mysqli_error($conn); // Output any SQL error for debugging
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Pesanan</title>
    <link rel="stylesheet" href="pembayaran.css" />
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" />
</head>
<body>
<header>
    <div class="navigation">
        <div id="judul">
            <img src="Logo/Logo Mytic (White).png" alt="" />
            <h1>My.Tic</h1>
        </div>
        <div id="kanan">
            <ul>
                <a href="main.php">Utama</a>
                <a href="listkonser.php">List Konser</a>
                <a href="#">Tentang Kami</a>
                <li id="user-menu">
                    <a href="login.php"><i data-feather="user"></i> Login</a>
                </li>
            </ul>
        </div>
    </div>
</header>
<script>
    const isLoggedIn = <?php echo json_encode($isLoggedIn); ?>;
    const username = <?php echo json_encode($username); ?>;

    document.addEventListener('DOMContentLoaded', () => {
      const userMenu = document.getElementById('user-menu');

      if (isLoggedIn) {
        userMenu.innerHTML = `
          <div class="dropdown">
            <button class="dropdown-button"><i data-feather="user"></i> ${username} <i data-feather="chevron-down"></i></button>
            <div class="dropdown-content">
              <a href="logout.php">Log Out</a>
              <a href="keranjang.php">Keranjang Saya</a>
            </div>
          </div>
        `;
        feather.replace();
      }
    });
</script>
<main>
    <div class="breadcrumb">
        <a href="main.php">Utama</a>
        <h3><</h3>
        <a href="keranjang.php">Keranjang Saya</a>
        <h3><</h3>
        <a href="#">Edit Tiket</a>
    </div>

    <div class="gambar">
        <a href="keranjang.php"><button>
            <svg height="16" width="16" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 1024 1024">
                <path d="M874.690416 495.52477c0 11.2973-9.168824 20.466124-20.466124 20.466124l-604.773963 0 188.083679 188.083679c7.992021 7.992021 7.992021 20.947078 0 28.939099-4.001127 3.990894-9.240455 5.996574-14.46955 5.996574-5.239328 0-10.478655-1.995447-14.479783-5.996574l-223.00912-223.00912c-3.837398-3.837398-5.996574-9.046027-5.996574-14.46955 0-5.433756 2.159176-10.632151 5.996574-14.46955l223.019353-223.029586c7.992021-7.992021 20.957311-7.992021 28.949332 0 7.992021 8.002254 7.992021 20.957311 0 28.949332l-188.073446 188.073446 604.753497 0C865.521592 475.058646 874.690416 484.217237 874.690416 495.52477z"></path>
            </svg>
            <span>Kembali</span>
        </button></a>
        <h1>Informasi Pembelian</h1>
    </div>

    <div class="note">
        <h2><?php  echo "Dapat diubah sampai: " . date('H:i \W\I\B d-m-Y', $editable_until) . "</p>"; ?></h2>
    </div>

    <div class="eventdetail">
        <h1>Detail Kegiatan</h1>
        <div class="line1detail">
            <img src="<?php echo $gambar_konser; ?>" alt="Gambar konser">
            <h3 id="judulanu"><?php echo $judul_konser; ?></h3>
            <h3>
                <img src="Logo/detail_lokasi.png" alt="" /><?php echo $tempat; ?>
            </h3>
            <h3>
                <img src="Logo/detail_tanggal.png" alt="" /><?php echo $tanggal_konser; ?> ·
            </h3>
        </div>
        <br>
        <hr />

        <h1>Rincian Pembelian</h1>
        <div class="ordersum">
            <h3>Tiket</h3>
            <?php
            $sqlTickets = "SELECT jenis_tiket, COUNT(*) AS jumlah_tiket
                           FROM pemesan_tiket
                           INNER JOIN tiket ON pemesan_tiket.id_tiket = tiket.id_tiket
                           WHERE pemesan_tiket.id_pesanan = {$id}
                           GROUP BY jenis_tiket";
            $resultTickets = mysqli_query($conn, $sqlTickets);

            if ($resultTickets && mysqli_num_rows($resultTickets) > 0) {
                while ($ticketRow = mysqli_fetch_assoc($resultTickets)) {
                    echo '<strong><h3>' . $ticketRow['jumlah_tiket'] . ' x ' . $ticketRow['jenis_tiket'] . '</h3></strong>';
                }
            }
            ?>
            <hr />
            <h3>Harga Tiket</h3>
            <!-- <strong><h3><?php echo 'Rp. ' . number_format($total_price, 0, ',', '.'); ?></h3></strong> -->
            <hr />
            <h3>Total</h3>
            <!-- <strong><h3><?php echo 'Rp. ' . number_format($total_price, 0, ',', '.'); ?></h3></strong> -->
        </div>
    </div>

    <form action='edit.php' method='POST'>
        <input type='hidden' name='id_pesanan' value='<?php echo $id; ?>'>
        <?php
        $sqlTicketTypes = "SELECT DISTINCT tiket.jenis_tiket
                           FROM pemesan_tiket
                           INNER JOIN tiket ON pemesan_tiket.id_tiket = tiket.id_tiket
                           WHERE pemesan_tiket.id_pesanan = {$id}";
        $resultTicketTypes = mysqli_query($conn, $sqlTicketTypes);

        if ($resultTicketTypes && mysqli_num_rows($resultTicketTypes) > 0) {
            $counter = 0;
            while ($ticketTypeRow = mysqli_fetch_assoc($resultTicketTypes)) {
                $jenisTiket = $ticketTypeRow['jenis_tiket'];

                echo "<h2>Jenis Tiket: {$jenisTiket}</h2>";

                $sqlTickets = "SELECT *
                               FROM pemesan_tiket
                               INNER JOIN tiket ON pemesan_tiket.id_tiket = tiket.id_tiket
                               WHERE pemesan_tiket.id_pesanan = {$id}
                               AND tiket.jenis_tiket = '{$jenisTiket}'";
                $resultTickets = mysqli_query($conn, $sqlTickets);

                if ($resultTickets && mysqli_num_rows($resultTickets) > 0) {
                    while ($row = mysqli_fetch_assoc($resultTickets)) {
                        $oldND = $row["namaDepan_pemesan"];
                        $oldNB = $row["namaBelakang_pemesan"];
                        $oldE = $row["email_pemesan"];
                        $oldN = $row["nomor_pemesan"];
                        $id_pemesanTiket = $row["id_pemesanTiket"];
                        echo "
                        <div class='ticket-form'>
                            <h3>Detail Tiket " . ($counter + 1) . "</h3>
                            <div class='data-form'>
                                <input type='hidden' name='id_pemesanTiket[]' value='{$id_pemesanTiket}'>
                                <div>
                                    <label for='first_name_{$counter}'>Nama Depan:</label>
                                    <input type='text' id='first_name_{$counter}' name='first_name[]' value='{$oldND}' required>
                                </div>
                                <div>
                                    <label for='last_name_{$counter}'>Nama Belakang:</label>
                                    <input type='text' id='last_name_{$counter}' name='last_name[]' value='{$oldNB}' required>
                                </div>
                                <div>
                                    <label for='email_{$counter}'>Email:</label>
                                    <input type='email' id='email_{$counter}' name='email[]' value='{$oldE}' required>
                                </div>
                                <div>
                                    <label for='phone_{$counter}'>Nomor HP:</label>
                                    <input type='tel' id='phone_{$counter}' name='phone[]' value='{$oldN}' required>
                                </div>
                            </div>
                        </div>";
                        $counter++;
                    }
                }
            }
        }
        ?>
        <div class="order-button">
            <input type='submit' name='save' value='Simpan Perubahan'>
        </div>
        <div>
            <?php echo "<a class='btn btn-danger' href='batal.php?id=$id'>Batalkan Pesanan</a>" ?>
        </div>
    </form>
</main>

<footer>
      <div class="containft">
        <div class="abtus">
          <div id="jdul">
            <img
              src="Logo/Logo Mytic (White).png"
              alt=""
            />
            <h1>My.Tic</h1>
          </div>
          <p>
            My.Tic adalah platform digital pemesanan tiket baik konser,
            festival, ataupun fanmeet dalam negeri maupun luar negeri. Dengan
            kemudahan akses dan pembayaran memberikan pengalaman membeli tiket
            yang menyenangkan.
          </p>

          <div class="parent">
            <div class="child child-1">
              <button class="button btn-1">
                <a href="#" class="twitter"><i data-feather="twitter"></i></a>
              </button>
            </div>

            <div class="child child-2">
              <button class="button btn-2">
                <a href="#" class="instagram"><i data-feather="instagram"></i></a>
              </button>
            </div>
            <div class="child child-3">
              <button class="button btn-3">
              <a href="#" class="github"><i data-feather="github"></i></a>
              </button>
            </div>
            <div class="child child-4">
              <button class="button btn-4">
              <a href="#" class="facebook"><i data-feather="facebook"></i></a>
              </button>
            </div>
          </div>
          
          <div id="plgbwh">
          <hr />
          <div id="copyright">
            &copy; <b>2024</b> Copyright 71220831, 71220869, 71220937 -
            <a href="main.php">My.Tic</a>
          </div>
        </div>
      </div>
    </footer>
<script src="https://unpkg.com/feather-icons"></script>
<script>
    feather.replace();
</script>
</body>
</html>
