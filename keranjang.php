<?php
  session_start();
  $username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
  $idUser = $_SESSION['id_user'] ? $_SESSION['id_user'] : '';
  $isLoggedIn = !empty($username);

  if (!isset($_SESSION['cart_timers'])) {
  $_SESSION['cart_timers'] = [];}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Saya</title>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
   <link rel="stylesheet" href="keranjang.css" />  <!-- nnt - dignati file css kaleann -->
    <script src="https://unpkg.com/feather-icons"></script>
</head>
<body>
    
<header>
        <div class="navigation">
          <div id="judul">
            <img
              src="Logo/Logo Mytic (White).png"
              alt=""
            />
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
                <a href="cart.php">Keranjang Saya</a>
                </div>
            </div>
            `;
            feather.replace();
        }
        });
    </script>
    <main>
      <div id="search">
        <form id="form" action="keranjang.php" method="GET">
            <input type="text" id="my-konser" name="cari" placeholder="Cari disini" />
        </form>
      </div>

      <div class="kategori-dropdown">
        <button class="dropdown-button">Pilih Kategori: <i data-feather="chevron-down"></i></button>
          <div class="dropdown-content">
            <a href="keranjang.php">Semua Kategori</a></li>
            <a href="keranjang.php?kategori=Konser">Konser</a></li>
            <a href="keranjang.php?kategori=Festival">Festival</a></li>
            <a href="keranjang.php?kategori=Fan Meet">Fan Meet</a></li>
          </div>
      </div>

      <div class="container-rekomen">
      <div class="container2">
      <?php
    include 'koneksi.php';

    // Periksa koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }
    $editable_duration = 15 * 60;

    $search_konser = isset($_GET['cari']) ? $conn->real_escape_string($_GET['cari']) : '';
    $kategori = isset($_GET['kategori']) ? $_GET['kategori'] : '';

  $sqlpesenan = "SELECT DISTINCT pesanan.id_pesanan, konser.judul_konser, pesanan.total_harga, pesanan.tanggal_pesan
                FROM pesanan
                INNER JOIN pemesan_tiket ON pesanan.id_pesanan = pemesan_tiket.id_pesanan
                INNER JOIN tiket ON pemesan_tiket.id_tiket = tiket.id_tiket
                INNER JOIN konser ON tiket.id_konser = konser.id_konser
                INNER JOIN featuring ON konser.id_konser = featuring.id_konser
                INNER JOIN artis ON featuring.id_artis = artis.id_artis 
                WHERE pesanan.id_user = $idUser AND (konser.judul_konser LIKE '%$search_konser%' OR konser.kategori_konser LIKE '%$search_konser%' OR artis.nama_artis LIKE '%$search_konser%')
                ORDER BY pesanan.id_pesanan DESC";
  
  if ($kategori == 'Fan Meet') {
    $sqlpesenan .= " AND kategori_konser = 'Fan Meet'";
  } else if ($kategori == 'Konser') {
    $sqlpesenan .= " AND kategori_konser = 'Konser'";
  } else if ($kategori == 'Festival') {
    $sqlpesenan .= " AND kategori_konser = 'Festival'";
  } else if ($kategori != '') {
    $sqlpesenan .= " AND kategori_konser = '$kategori'";
  }
  
  $result = $conn->query($sqlpesenan);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $id_pesanan = $row['id_pesanan'];

        $tanggal_pesan = strtotime($row['tanggal_pesan']);
        $editable_until = $tanggal_pesan + (24 * 60 * 60);
        $is_editable = time() < $editable_until;

        echo "<div class='ticket-container'>
              <div class='boxa'>
                  <h1>{$row['judul_konser']}</h1>";
        if ($is_editable) {
            echo "<p class='editable-until'>Dapat diubah sampai: " . date('H:i \W\I\B d-m-Y', $editable_until) . "</p>";
        } else {
            echo "<p class='editable-until'>Tidak dapat diubah</p>";
        }
        echo "</div>";
        $idpesan =  $row['id_pesanan'];
        $sqltiket = "SELECT DISTINCT konser.gambar_tumb, tiket.jenis_tiket, tiket.tanggal_tiket, tiket.harga, (SELECT COUNT(pesanan.id_pesanan)) AS 'jumlah'
                    FROM pesanan
                    INNER JOIN pemesan_tiket ON pesanan.id_pesanan = pemesan_tiket.id_pesanan
                    INNER JOIN tiket ON pemesan_tiket.id_tiket = tiket.id_tiket
                    INNER JOIN konser ON tiket.id_konser = konser.id_konser
                    WHERE pemesan_tiket.id_pesanan = {$row['id_pesanan']}
                    GROUP BY tiket.jenis_tiket";
        $restik = $conn->query($sqltiket);
        
        if ($restik->num_rows > 0) {
            while ($rowtik = $restik->fetch_assoc()) {
                $start_date = date_create($rowtik['tanggal_tiket']);
                $formatted_start_date = date_format($start_date, 'l, j F Y');
                echo "
                <div class='ticket'>
                    <img src='{$rowtik['gambar_tumb']}' alt='{$rowtik['jenis_tiket']}'>
                    <div class='ticket-details'>
                        <p class='ticket-day'>{$rowtik['jenis_tiket']}</p>
                        <p class='ticket-date'>{$formatted_start_date}</p>
                        <div class='ticket-details2'>
                            <p class='ticket-quantity'>x{$rowtik['jumlah']}</p>
                            <p class='ticket-price'>Rp. " . number_format(($rowtik['harga'] * $rowtik['jumlah']), 2, ',', '.'). "</p>
                        </div>
                    </div>
                </div>
                <hr />";
            }
        }
        echo "<div class='total'>
                  <p>Total Pesanan: <span id='harr'>Rp. ". number_format($row['total_harga'], 2, ',', '.') ."</span></p>";
        if ($is_editable) {
            echo "<a href='edit_pesanan.php?id=$idpesan'>Edit</a>";
        } else {
            echo "<a href='edit_pesanan.php?id=$idpesan' style='pointer-events: none; opacity: 0.5' >Edit</a>";
        }
        echo "</div>";
        echo "</div>";
    }
} else {
    echo "Tidak ada data konser yang ditemukan.";
}

// Tutup koneksi
$conn->close();
?>

      </div>
      </div>
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

    <script>
      feather.replace();
  </script> 
</body>
</html>