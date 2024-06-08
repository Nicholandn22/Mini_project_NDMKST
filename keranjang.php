<?php
  session_start();
  $username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
  $idUser = $_SESSION['id_user'] ? $_SESSION['id_user'] : '';
  $isLoggedIn = !empty($username);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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

      <div class="container-rekomen">
      <div class="container2">
      <?php
    include 'koneksi.php';

    // Periksa koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }
      $search_konser = isset($_GET['cari']) ? $_GET['cari'] : '';

      $sqlkonser = "SELECT*
                    FROM `pesanan`
                    INNER JOIN pemesan_tiket ON pesanan.id_pesanan = pemesan_tiket.id_pesanan
                    INNER JOIN tiket ON pemesan_tiket.id_tiket = tiket.id_tiket
                    INNER JOIN konser ON tiket.id_konser = konser.id_konser
                    WHERE id_user = 1";
      $result = $conn->query($sqlkonser);

      if ($result->num_rows > 0) {
        $count = 0;
          while($row = $result->fetch_assoc()) {
              echo "<div class='box'>";
              $start_date = date_create($row['tanggal_awal']);
              $formatted_start_date = date_format($start_date, 'j F Y');
              $id=$row['id_konser'];

              if (strtotime($row['tanggal_awal']) > time() && $row['stok'] > 0) {
                  echo "<img src='" . $row['gambar_tumb'] . "' alt='Image'>";
              } else {
                  echo "<img src='" . $row['gambar_tumb'] . "' id='img_error' alt='Image'>";
              }
              echo "<div class='dalam'>";
              echo "<h3>" . $row["judul_konser"] . "</h3>";
              $sqlartis = "SELECT 
                              artis.nama_artis
                          FROM 
                              artis
                          INNER JOIN 
                              featuring ON artis.id_artis = featuring.id_artis
                          INNER JOIN
                              konser ON featuring.id_konser = konser.id_konser
                          WHERE konser.id_konser = ". $row['id_konser'];
              $resultartis = $conn->query($sqlartis);
              if ($resultartis->num_rows > 0) {
                  $artistNames = array();
                  while($rowArtis = $resultartis->fetch_assoc()) {
                      $artistNames[] = $rowArtis['nama_artis']; 
                  }
                  echo "<p>" . implode(", ", $artistNames) . "</p>";
              } else {
                  echo "<p> - </p>";
              }

              if (!empty($row['tanggal_akhir'])) {
                  $end_date = date_create($row['tanggal_akhir']);
                  $formatted_end_date = date_format($end_date, 'j F Y');
                  echo "<h4>" . $row['kota'] . " &bull; ". $formatted_start_date . " - " . $formatted_end_date . "</h4>";
              } else {
                  echo "<h4>" . $row['kota'] . " &bull; ". $formatted_start_date . "</h4>";
              }
              echo "<h5>" . $row["Deskripsi_konser"] . "</h5>";
              echo "<h2>Rp. " . number_format($row['harga'], 2, ',', '.') . "</h2>";
              if (strtotime($row['tanggal_awal']) < time() && strtotime($row['tanggal_akhir']) < time() ) {
                  echo "<a href='#' style='pointer-events: none;' id='detail_error'>Event sudah berlalu</a>";
              } else if($row['stok'] == 0){
                  echo "<a href='#' style='pointer-events: none;' id='detail_error'>Stok Habis</a>";
              }else {
                  echo "<a href='detail.php?id=$id'>Detail</a>";
              }
              echo "</div></div>";
              $count += 1;
              if($count == 6){
                break;
              }
          }
      } else {
          echo "Tidak ada data konser yang ditemukan.";
      }        

      // Tutup koneksi
      $conn->close();
      ?>
      </div>
      </div>
        <div class="ticket-container">
            <div class="boxa">
                <h1>#SATUDEKADEBERSAMA PRAMBANAN JAZZ</h1>
                <p class="editable-until">Editable until: 11:24:32 WIB 12-03-2024</p>
            </div>
            <div class="ticket">
                <img src="path/to/day2-image.jpg" alt="Day 2 Festival">
                <div class="ticket-details">
                    <p class="ticket-day">Day 2 (Festival)</p>
                    <p class="ticket-date">Saturday, 18 March 2024</p>  
                    <div class="ticket-details2">
                    <p class="ticket-quantity">x2</p>
                    <p class="ticket-price">Rp. 724.000</p></div>
                </div>
                
            </div>
            <hr>


            <div class="ticket">
                <img src="path/to/day3-image.jpg" alt="Day 3 Super Festival">
                <div class="ticket-details">
                    <p class="ticket-day">Day 3 (Super Festival)</p>
                    <p class="ticket-date">Sunday, 19 March 2024</p>
                    <div class="ticket-details2">
                    <p class="ticket-quantity">x1</p>
                    <p class="ticket-price">Rp. 456.000</p>
                    </div>
                </div>
            </div>
            <hr>
            
            <div class="total">
                <p>Total Pesanan: <span>Rp. 1.180.000</span></p>
                <button>Edit</button>
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