<?php
  session_start();
  $username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
  $isLoggedIn = !empty($username);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Main</title>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="style.css" />
    <script src="https://unpkg.com/feather-icons"></script>
  </head>
  <body>
    <header>
      <div class="navigation">
        <div id="judul">
          <img
            src="Logo/logo Mytic (Blue).png"
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
  <div id="changing">
    <section id="bgchange"></section>
  </div>
  <script>
  const backgroundImages = [
  'url("Konser/IVE/header.jpg")',
  'url("Konser/BersuaFestival/Poster.2.png")',
  'url("Konser/ChaEunWoo/Poster.2.jpg")',
  'url("Konser/IU/Poster.2.png")',
  'url("Konser/BlessThisConcert/Poster.2.png")',
  'url("Konser/NiallHoran/header.webp")',
  'url("Konser/SoundOfDowntown/Poster.png")',
  'url("Konser/TheEternity/Poster.2.png")',
  'url("Konser/TheBoyz/header.jpg")',
  'url("Konser/YOONITE/Poster.1.jpg")',
  'url("Konser/PrambananJazz/Banner_Prambanan_Jazz.webp")',
  ];

  let currentIndex = 0;
      const section = document.querySelector('#bgchange');

      function changeBackground() {
      section.style.backgroundImage = `linear-gradient(to bottom, transparent 80%, rgba(255, 255, 255, 1) 100%), ${backgroundImages[currentIndex]}`;
      currentIndex = (currentIndex + 1) % backgroundImages.length; 
    }

setInterval(changeBackground, 7000);

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
    <form id="form" action="listkonser.php" method="GET">
    <div class="container">
        <div class="search">
            <p>Cari Konser</p>
            <input type="text" id="my-konser" name="konser" placeholder="Nama Konser" />
        </div>
        <div class="search">
            <p>Lokasi</p>
            <input type="text" id="my-location" name="lokasi" placeholder="Lokasi" />
        </div>
        <div class="search">
            <p>Waktu</p>
            <input type="date" id="my-date" name="tanggal" placeholder="Tanggal" />
        </div>
        <!-- tombol search -->
        <button type="submit" class="btn-search">Search</button>
        <!-- tombol search -->
    </div>
</form>

<div class="kategori-dropdown">
  <button class="dropdown-button">Pilih Kategori: <i data-feather="chevron-down"></i></button>
    <div class="dropdown-content">
      <a href="listkonser.php">Semua Kategori</a></li>
      <a href="listkonser.php?kategori=Konser">Konser</a></li>
      <a href="listkonser.php?kategori=Festival">Festival</a></li>
      <a href="listkonser.php?kategori=Fan Meet">Fan Meet</a></li>
    </div>
</div>

      <!-- tulisan opcoming event ama loadmore -->
      <div class="tulisan">
        <h1>Event Terbaru</h1>
        <!-- <a href="#"><h1>Load More >></h1></a> -->
        <a href="listkonser.php">
          <button class="readmore-btn">
            <span class="book-wrapper">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="rgb(86, 69, 117)"
                viewBox="0 0 126 75"
                class="book"
              >
                <rect
                  stroke-width="3"
                  stroke="#fff"
                  rx="7.5"
                  height="70"
                  width="121"
                  y="2.5"
                  x="2.5"
                ></rect>
                <line
                  stroke-width="3"
                  stroke="#fff"
                  y2="75"
                  x2="63.5"
                  x1="63.5"
                ></line>
                <path
                  stroke-linecap="round"
                  stroke-width="4"
                  stroke="#fff"
                  d="M25 20H50"
                ></path>
                <path
                  stroke-linecap="round"
                  stroke-width="4"
                  stroke="#fff"
                  d="M101 20H76"
                ></path>
                <path
                  stroke-linecap="round"
                  stroke-width="4"
                  stroke="#fff"
                  d="M16 30L50 30"
                ></path>
                <path
                  stroke-linecap="round"
                  stroke-width="4"
                  stroke="#fff"
                  d="M110 30L76 30"
                ></path>
              </svg>

              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 65 75"
                class="book-page"
              >
                <path
                  stroke-linecap="round"
                  stroke-width="4"
                  stroke="#fff"
                  d="M40 20H15"
                ></path>
                <path
                  stroke-linecap="round"
                  stroke-width="4"
                  stroke="#fff"
                  d="M49 30L15 30"
                ></path>
                <path
                  stroke-width="3"
                  stroke="#fff"
                  d="M2.5 2.5H55C59.1421 2.5 62.5 5.85786 62.5 10V65C62.5 69.1421 59.1421 72.5 55 72.5H2.5V2.5Z"
                ></path>
              </svg>
            </span>
            <span class="text"> Selengkapnya </span>
          </button>
        </a>
      </div>
      <div class="container2">
      <?php
        include 'koneksi.php';

        // Periksa koneksi
        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        $kategori = isset($_GET['kategori']) ? $_GET['kategori'] : '';
                $search_konser = isset($_GET['search_konser']) ? $_GET['search_konser'] : '';
                $search_lokasi = isset($_GET['search_lokasi']) ? $_GET['search_lokasi'] : '';
                $search_tanggal = isset($_GET['search_tanggal']) ? $_GET['search_tanggal'] : '';

        $sqlkonser = "SELECT DISTINCT
                                    konser.id_konser, 
                                    konser.judul_konser, 
                                    konser.kategori_konser, 
                                    konser.Deskripsi_konser, 
                                    konser.kota, 
                                    konser.tempat, 
                                    konser.tanggal_awal, 
                                    konser.tanggal_akhir, 
                                    konser.jam_mulai, 
                                    konser.jam_akhir, 
                                    konser.batas_umur, 
                                    konser.gambar_tumb, 
                                    konser.gambar_header, 
                                    konser.gambar_layout, 
                                    konser.gambar_tnc,
                                    (SELECT MIN(harga) FROM tiket WHERE tiket.id_konser = konser.id_konser) AS min_harga,
                                    (SELECT SUM(tiket.stok) FROM tiket WHERE tiket.id_konser = konser.id_konser) AS stok
                                FROM 
                                    konser
                                INNER JOIN featuring ON konser.id_konser = featuring.id_konser
                                INNER JOIN artis ON featuring.id_artis = artis.id_artis 
                                WHERE 
                                    ((judul_konser LIKE '%$search_konser%' OR '$search_konser' = '') OR (nama_artis LIKE '%$search_konser%' OR '$search_konser' = '') OR (kategori_konser LIKE '%$search_konser%' OR '$search_konser' = '')) AND
                                    (kota LIKE '%$search_lokasi%' OR '$search_lokasi' = '') AND
                                    (tanggal_awal = '$search_tanggal' OR '$search_tanggal' = '')";

                if ($kategori == 'Fan Meet') {
                  $sqlkonser .= " AND kategori_konser = 'Fan Meet'";
                } else if ($kategori == 'Konser') {
                  $sqlkonser .= " AND kategori_konser = 'Konser'";
                } else if ($kategori == 'Festival') {
                  $sqlkonser .= " AND kategori_konser = 'Festival'";
                } else if ($kategori != '') {
                  $sqlkonser .= " AND kategori_konser = '$kategori'";
                }

              // Perbaiki logika untuk menangani opsi "Semua Kategori"
              // Jika kategori tidak terdefinisi atau kosong, jangan tambahkan filter kategori
              

                $sqlkonser .= " ORDER BY konser.tanggal_awal DESC";
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
                echo "<h2>Rp. " . number_format($row['min_harga'], 2, ',', '.') . "</h2>";
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
            festival, ataupun fanmeet dalam negri maupun luar negri. Dengan
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
            &copy; 2024 Copyright Website Anda -
            <a href="main.php">My.Tic</a>
          </div>
        </div>
      </div>
    </footer>

    <script>
      feather.replace();
      function filterResults() {
          var kategori = document.getElementById('kategori-dropdown').value;
          var searchParams = new URLSearchParams(window.location.search);
          searchParams.set('kategori', kategori);
          window.location.search = searchParams.toString();
      }

      function filterResults() {
          var kategori = document.getElementById('kategori-dropdown').value;
          var searchParams = new URLSearchParams(window.location.search);
          searchParams.set('kategori', kategori);
          window.location.search = searchParams.toString();
      }
  </script> 
  </body>
</html>