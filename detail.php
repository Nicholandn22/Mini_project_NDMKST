<?php 
include "koneksi.php";
if($_GET){
    $id = intval($_GET['id']); // Ensure the ID is an integer to prevent SQL injection
    $sql = "SELECT konser.id_konser, 
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
            (SELECT MIN(harga) FROM tiket WHERE tiket.id_konser = konser.id_konser) AS min_harga
            FROM konser
            WHERE konser.id_konser = {$id}";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "Data yang akan diedit tidak ada.";
        if (!$result) {
            echo "Error: " . mysqli_error($conn); // Output any SQL error for debugging
        }
    }
}

  session_start();
  $username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
  $idUser = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : '';
  $isLoggedIn = !empty($username);


$id_konser = isset($_GET['id']) ? $_GET['id'] : '';
$gambar_konser = isset($_GET['gambar']) ? +$_GET['gambar'] : '';
$judul_konser = isset($_GET['judul']) ? $_GET['judul'] : '';
$deskripsi_konser = isset($_GET['deskripsi']) ? $_GET['deskripsi'] : '';
$tanggal_konser = isset($_GET['tanggal']) ? $_GET['tanggal'] : '';
$waktu_konser = isset($_GET['waktu']) ? $_GET['waktu'] : '';

// Simpan data ke dalam session untuk digunakan nanti
$_SESSION['id_konser'] = $row['id_konser'];
$_SESSION['gambar_konser'] = $row['gambar_tumb'];
$_SESSION['judul_konser'] = $row['judul_konser'];
$_SESSION['Deskripsi_konser'] = $row['Deskripsi_konser'];
$_SESSION['tanggal_konser'] = $row['tanggal_awal'];
$_SESSION['jam_mulai'] = $row['jam_mulai'];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detail</title>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="detail.css" />
    <script src="https://unpkg.com/feather-icons"></script>
</head>
<body>
<header>
    <div class="navigation">
        <div id="judul">
            <img src="Logo/logo Mytic (White).png" alt="" />
            <h1>My.Tic</h1>
        </div>
        <div id="kanan">
            <ul>
                <a href="main.php">Utama</a>
                <a href="#">List Konser</a>
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

    <!-- breadcrumb -->
    <div class="breadcrumb">
        <a href="main.php">Utama</a>
        <h3> < </h3>
        <a href="#">Detail Konser</a>
    </div>
    <!-- breadcrumb -->

    <div class="gambar">
        <a href="main.php"><button>
            <svg height="16" width="16" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 1024 1024">
                <path d="M874.690416 495.52477c0 11.2973-9.168824 20.466124-20.466124 20.466124l-604.773963 0 188.083679 188.083679c7.992021 7.992021 7.992021 20.947078 0 28.939099-4.001127 3.990894-9.240455 5.996574-14.46955 5.996574-5.239328 0-10.478655-1.995447-14.479783-5.996574l-223.00912-223.00912c-3.837398-3.837398-5.996574-9.046027-5.996574-14.46955 0-5.433756 2.159176-10.632151 5.996574-14.46955l223.019353-223.029586c7.992021-7.992021 20.957311-7.992021 28.949332 0 7.992021 8.002254 7.992021 20.957311 0 28.949332l-188.073446 188.073446 604.753497 0C865.521592 475.058646 874.690416 484.217237 874.690416 495.52477z"></path>
            </svg>
            <span>Kembali</span>
        </button></a>
        <img src="<?php echo $row['gambar_header']; ?>" alt="Concert Header Image" />
    </div>
    <div class="contain">
        <div class="kiri">
            <h1><?php echo $row['judul_konser']; ?></h1>
            <span>
                <h2><?php echo $row['tempat'] . ", " . $row['kota']; ?></h2>
                <h2><?php 
                    if (!empty($row['tanggal_akhir'])) {
                        $end_date = date_create($row['tanggal_akhir']);
                        $formatted_end_date = date_format($end_date, 'j F Y');
                        echo date("j F Y", strtotime($row['tanggal_awal'])) . " - " . date("j F Y", strtotime($row['tanggal_akhir']));
                    } else {
                        echo date("j F Y", strtotime($row['tanggal_awal']));
                    }
                ?></h2>
                <h2><?php echo $row['jam_mulai'] . " - " . $row['jam_akhir'] . " WIB"; ?></h2>
            </span>
        </div>

        <div class="kanan">
            <h2>Harga Mulai</h2>
            <h1><?php echo "Rp. " . number_format($row['min_harga'], 2, ',', '.')?></h1>
            <a href="#boxtiket"><button> Beli Tiket</button></a>
        </div>
    </div>
    <div class="sosmed">
        <h1>Share : </h1>
        <a href=""><img src="Logo/share_facebook.png" alt=""></a>
        <a href=""><img src="Logo/share_instagram.png" alt=""></a>
        <a href=""><img src="Logo/share_twitter.png" alt=""></a>
        <a href=""><img src="Logo/share_link.png" alt=""></a>
    </div>
    <div class="event-inf">
        <h1>Informasi Kegiatan</h1>
        <div class="information">
            <div class="duration">
                <img src="Logo/deskripsi_jam.png" alt="">
                <p class="tambahan">Durasi</p>
                <p>14.00 - 23.00 WIB</p>
            </div>
            <div class="audience">
                <img src="Logo/deskripsi_audience.png" alt="">
                <p class="tambahan">Pengunjung</p>
                <p>Kegiatan ini terbuka untuk umum</p>
            </div>
            <div class="attention">
                <img src="Logo/deskripsi_peringatan.png" alt="">
                <p class="tambahan">Peringatan</p>
                <p>Menjaga barang bawaan pribadi</p>
            </div>
        </div>
    </div>

    <div class="desc">
        <h1>Deskripsi</h1>
        <p><?php echo $row['Deskripsi_konser']; ?></p>
    </div>

    <div class="layout" >
        <h1>Tata Letak</h1>
        <img src="<?php echo $row['gambar_layout']; ?>" alt="Concert Layout Image" >
    </div>

    <div class="term">
        <h1>Syarat & Kententuan</h1>
        <img src="<?php echo $row['gambar_tnc']; ?>" alt="Concert T&C Image" >
    </div>
    
    <div class="pertiketan">
    <form action="pembayaran.php" method="POST">
    <input type="hidden" name="id_konser" value="<?php echo $id; ?>">
    <h1>Tiket yang Tersedia</h1>
    
    <?php
    $sqltiket = "SELECT 
                    tiket.id_tiket, 
                    tiket.jenis_tiket, 
                    tiket.deskripsi_tiket, 
                    tiket.harga, 
                    tiket.stok
                FROM 
                    tiket
                WHERE 
                    tiket.id_konser = {$id}";
    $result = mysqli_query($conn, $sqltiket);
    
    if ($result && mysqli_num_rows($result) > 0) {
        echo '<div class="line1" id="boxtiket">';
        $count = 0; // Counter to track the number of boxes in a row
        while ($tiket = mysqli_fetch_assoc($result)) {
            $id_tiket = $tiket['id_tiket'];
            $jenis_tiket = $tiket['jenis_tiket'];
            $deskripsi_tiket = $tiket['deskripsi_tiket'];
            $harga_tiket = number_format($tiket['harga'], 2, ',', '.');
            $stok_tiket = $tiket['stok'];

            if ($count % 3 == 0 && $count != 0) {
                echo '</div><div class="line1" id="boxtiket">'; // Close the current row and start a new row after every 3 boxes
            }

            echo "<div class='ticket-box'>
                <h3>{$jenis_tiket}</h3>
                <p>{$deskripsi_tiket}</p>
                <span id='ticket-price><p '>Rp. {$harga_tiket}</p></span>";
                if ($stok_tiket <= 5) {
                    echo "<p style='color: red'>Stok: {$stok_tiket}</p>";
                } else {
                    echo "<p>Stok: {$stok_tiket}</p>";
                }
            echo "<div class='ticket-quantity'>";
                    if($stok_tiket == 0) {
                        echo "<button class='quantity-button-not' type='button' style='pointer-events: none; background-color: grey' disabled>-</button>
                        <input type='text' name='quantity[{$id_tiket}]' id='quantity-{$id_tiket}' value='0' readonly>
                        <input type='hidden' name='jenis_tiket[{$id_tiket}]' value='{$jenis_tiket}'>
                        <button class='quantity-button-not' type='button' style='pointer-events: none; background-color: grey' disabled>+</button>";
                    } else {
                        echo "<button class='quantity-button' type='button' onclick='decreaseQuantity({$id_tiket})'>-</button>
                        <input type='text' name='quantity[{$id_tiket}]' id='quantity-{$id_tiket}' value='0' readonly>
                        <input type='hidden' name='jenis_tiket[{$id_tiket}]' value='{$jenis_tiket}'>
                        <button class='quantity-button' type='button' onclick='increaseQuantity({$id_tiket}, {$stok_tiket})'>+</button>";
                    }
            echo "</div>
                </div>";

            $count++;
        }
        echo '</div>';
        echo '<button id="btn-submit" type="submit">Pesan Tiket</button>';
    } else {
        echo "Tidak ada tiket tersedia.";
        if (!$result) {
            echo "Error: " . mysqli_error($conn); // Output any SQL error for debugging
        }
    }
    ?>
</form>
</div>
<script>
function increaseQuantity(id, maxStok) {
    var quantityInput = document.getElementById('quantity-' + id);
    var currentValue = parseInt(quantityInput.value);
    if (currentValue < maxStok) {
        quantityInput.value = currentValue + 1;
    }
    toggleSubmitButton();
}

function decreaseQuantity(id) {
    var quantityInput = document.getElementById('quantity-' + id);
    var currentValue = parseInt(quantityInput.value);
    if (currentValue > 0) {
        quantityInput.value = currentValue - 1;
    }
    toggleSubmitButton();
}
function toggleSubmitButton() {
    var quantities = document.querySelectorAll('[id^="quantity-"]');
    var totalQuantity = 0;
    
    quantities.forEach(function(input) {
        totalQuantity += parseInt(input.value);
    });

    var submitButton = document.getElementById('btn-submit');
    if (totalQuantity > 0) {
        submitButton.disabled = false;
        submitButton.style.pointerEvents = 'visible';
        submitButton.style.backgroundColor = '#242565';
    } else {
        submitButton.disabled = true;
        submitButton.style.pointerEvents = 'none';
        submitButton.style.backgroundColor = 'grey';
    }
}
</script>

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
