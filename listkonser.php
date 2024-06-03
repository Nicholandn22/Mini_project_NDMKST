<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
   <link rel="stylesheet" href="listkonser.css" />  <!-- nnt - dignati file css kaleann -->
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
              <a href="main.php">Tentang Kami</a>
              <a href="#"><i data-feather="user"></i> Login</a>
            </ul>
          </div>
        </div>
    </header>
    <main>
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
      <button type="submit" class="btn-search"> Search</button>  
      <!-- tombol search -->
  </div>
  </form>

      <div class="container-ft">
        <div class="dropdown-menus">
          <div class="dropdown">
            <select name="hari" id="hari-dropdown" onchange="filterResults()">
            <option value="">Semua Hari</option>
            <option value="Monday">Senin</option>
            <option value="Tuesday">Selasa</option>
            <option value="Wednesday">Rabu</option>
            <option value="Thursday">Kamis</option>
            <option value="Friday">Jumat</option>
            <option value="Saturday">Sabtu</option>
            <option value="Sunday">Minggu</option>
          </select>
          </div>
          <div class="dropdown">
            <select name="kategori" id="kategori-dropdown" onchange="filterResults()">
                <option value="">Semua Kategori</option>
                <option value="Konser">Konser</option>
                <option value="Festival">Festival</option>
                <option value="Fanmeet">Fanmeet</option>
            </select>
          </div>
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

        $search_konser = isset($_GET['konser']) ? $_GET['konser'] : '';
        $search_lokasi = isset($_GET['lokasi']) ? $_GET['lokasi'] : '';
        $search_tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : '';

        $sqlkonser = "SELECT 
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
                    WHERE 
                        (judul_konser LIKE '%$search_konser%' OR '$search_konser' = '') AND
                        (kota LIKE '%$search_lokasi%' OR '$search_lokasi' = '') AND
                        (tanggal_awal = '$search_tanggal' OR '$search_tanggal' = '')";
        $result = $conn->query($sqlkonser);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='box'>";
                $start_date = date_create($row['tanggal_awal']);
                $formatted_start_date = date_format($start_date, 'j F Y');

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
                    echo "<a href='detail.html'>Detail</a>";
                }
                echo "</div></div>";
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

      function filterResults() {
        var filterBy = document.getElementById('filter-dropdown').value;
        var url = 'listkonser.php?filter=' + encodeURIComponent(filterBy);
        window.location.href = url;
    }
  </script> 
</body>
</html>