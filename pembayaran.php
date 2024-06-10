  <?php

  include "koneksi.php";
  session_start();
  $username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
    $idUser = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : '';
    $isLoggedIn = !empty($username);
  

  // Check if the form was submitted
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Retrieve session variables
      // $id_pesanan = $_SESSION['id_pesanan'];  
      $gambar_konser = $_SESSION['gambar_konser'];
      $judul_konser = $_SESSION['judul_konser'];
      $deskripsi_konser = $_SESSION['Deskripsi_konser'];
      $tanggal_konser = $_SESSION['tanggal_konser'];
      $waktu_konser = $_SESSION['jam_mulai'];
      $tempat = $_SESSION['tempat'];
      

      // Retrieve form data
      $quantities = $_POST['quantity'];
      $jenis_tiket = $_POST['jenis_tiket'];

      

      // Calculate the total number of tickets and group by ticket type
      $tickets_by_type = [];
      foreach ($quantities as $id_tiket => $quantity) {
          if ($quantity > 0) {
              if (!isset($tickets_by_type[$jenis_tiket[$id_tiket]])) {
                  $tickets_by_type[$jenis_tiket[$id_tiket]] = [];
              }
              for ($i = 0; $i < $quantity; $i++) {
                  $tickets_by_type[$jenis_tiket[$id_tiket]][] = $id_tiket;
              }
          }
      }
  }

  // Hitung total harga tiket berdasarkan jenis tiket yang dipilih
  $total_price = 0;
      foreach ($quantities as $id_tiket => $quantity) {
          if ($quantity > 0) {
              // Ambil harga tiket dari tabel tiket berdasarkan jenis tiket
              $query = "SELECT harga FROM tiket WHERE id_tiket = $id_tiket";
              $result = mysqli_query($conn, $query);
              $row = mysqli_fetch_assoc($result);
              $harga_tiket = $row['harga'];

              // Hitung total harga tiket untuk jenis tiket ini
              $total_price += $harga_tiket * $quantity;
          }
      }

      // Masukkan total harga ke dalam session
      $_SESSION['total_price'] = $total_price;

  ?>
  <!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Payment</title>
      <link rel="stylesheet" href="pembayaran.css" />
      <link
        href="https://fonts.googleapis.com/css?family=Poppins"
        rel="stylesheet"
      />
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
        <!-- breadcrumb -->
        <div class="breadcrumb">
          <a href="main.php">Utama</a>
          <h3><</h3>
          <a href="listkonser.php">Detail Konser</a>
          <h3><</h3>
          <a href="#">Pembayaran</a>
        </div>
        <!-- breadcrumb -->

        <div class="gambar">
          <a href="detail.html"><button>
            <svg
              height="16"
              width="16"
              xmlns="http://www.w3.org/2000/svg"
              version="1.1"
              viewBox="0 0 1024 1024"
            >
              <path
                d="M874.690416 495.52477c0 11.2973-9.168824 20.466124-20.466124 20.466124l-604.773963 0 188.083679 188.083679c7.992021 7.992021 7.992021 20.947078 0 28.939099-4.001127 3.990894-9.240455 5.996574-14.46955 5.996574-5.239328 0-10.478655-1.995447-14.479783-5.996574l-223.00912-223.00912c-3.837398-3.837398-5.996574-9.046027-5.996574-14.46955 0-5.433756 2.159176-10.632151 5.996574-14.46955l223.019353-223.029586c7.992021-7.992021 20.957311-7.992021 28.949332 0 7.992021 8.002254 7.992021 20.957311 0 28.949332l-188.073446 188.073446 604.753497 0C865.521592 475.058646 874.690416 484.217237 874.690416 495.52477z"
              ></path>
            </svg>
            <span>Kembali</span>
          </button></a>
          <h1>Informasi Pembelian</h1>
        </div>

        <div class="note">
          <h2>
            Tiket digital akan dikirimkan ke Email pemesan pertama, pastikan email yang anda masukkan benar.
          </h2>
        </div>

        <div class="eventdetail">
          <h1>Detail Kegiatan</h1>
          <div class="line1detail">
            <!-- menampilkan gambar konser sekarang -->
            <img src="<?php echo $gambar_konser; ?>" alt="ini gambar konser">

            <!-- menampilkan judul konser sekarang -->
            <h3 id="judulanu"><?php echo $judul_konser; ?></h3>
            <h3>
              <!-- menampilkan deskripsi konser -->
              <img src="Logo/detail_lokasi.png" alt="" /><?php echo $tempat ?>
            </h3>
            <h3>
              <!-- menampilkan tanggal konser dimulai -->
              <img src="Logo/detail_tanggal.png" alt="" /><?php  echo $tanggal_konser  ?> ·
            </h3>
          </div>
          <br>
          <hr />

          <h1>Rincian Pembelian</h1>
        <!-- DI DIV YANG INI YANG TIKET TIKETAN -->
  <div class="ordersum">
      <h3>Tiket</h3>
      <?php 
      $totalTypes = count($tickets_by_type);
      $i = 1;
      foreach ($tickets_by_type as $type => $tickets) { 
          echo '<strong><h3>' . count($tickets) . ' x ' . $type . '</h3></strong>';
          if ($i < $totalTypes) {
              echo '<strong><h3> | </h3></strong>';
          }
          $i++;
      }
      ?>
      <hr />
      <h3>Harga Tiket</h3>
      <strong><h3>(<?php echo 'Rp. ' . number_format($total_price, 0, ',', '.'); ?>)</h3></strong>
      <hr />
      <h3>Total</h3>
      <strong><h3>(<?php echo 'Rp. ' . number_format($total_price, 0, ',', '.'); ?>)</h3></strong>
  </div>
        </div>

        <!-- MASUKKAN FORM DATA DIRI BAWAH INI -->
  <form action='proses_pembayaran.php' method='POST' onchange="toggleSubmitButton()">
      <input type='hidden' name='id_pesanan' value='<?php echo $id_pesanan; ?>'>
      <?php
      $counter = 0;
      foreach ($tickets_by_type as $type => $tickets) {
          echo "<div class='ticket-group'>
                  <h2>Jenis Tiket: {$type}</h2>";
          foreach ($tickets as $ticket) {
              echo "
                  <div class='ticket-form'>
                      <h3>Detail Tiket " . ($counter + 1) . "</h3>
                      <div class='data-form'>
                          <div>
                              <label for='first_name_{$counter}'>Nama Depan:</label>
                              <input type='text' id='first_name_{$counter}' name='first_name[]' >
                          </div>
                          <div>
                              <label for='last_name_{$counter}'>Nama Belakang:</label>
                              <input type='text' id='last_name_{$counter}' name='last_name[]' >
                          </div>
                          <div>
                              <label for='email_{$counter}'>Email:</label>
                              <input type='email' id='email_{$counter}' name='email[]' >
                          </div>
                          <div>
                              <label for='phone_number_{$counter}'>Nomor HP:</label>
                              <input type='number' id='phone_number_{$counter}' name='phone_number[]' >
                          </div>
                          <input type='hidden' name='id_tiket[]' value='{$ticket}'>
                      </div>
                  </div>
              ";
              $counter++;
          }
          echo "</div>";
      }
      ?>
      
        <script>
  // Function untuk menonaktifkan/mengaktifkan tombol submit berdasarkan validasi input
  function toggleSubmitButton() {
    // Ambil elemen tombol submit
    let submitButton = document.getElementById('submit_button');

    // Ambil nilai input dari setiap field
    let inputFields = document.querySelectorAll('input[type="text"], input[type="email"], input[type="tel"], select');
    let allFieldsFilled = true;
    let isValid = true;
    let selectedPaymentMethod = false; // Variabel untuk menyimpan status pemilihan metode pembayaran

    // Lakukan iterasi melalui setiap input field dan periksa validitasnya
    inputFields.forEach(function(field) {
      if (!field.checkValidity()) {
        isValid = false;
      }
      if (!field.value) {
        allFieldsFilled = false;
      }
    });

    // Cek validasi tambahan untuk nomor HP
    let phoneNumbers = document.querySelectorAll('input[type="tel"]');
    phoneNumbers.forEach(function(phoneNumber) {
      let phoneNumberValue = phoneNumber.value.trim();
      if (!phoneNumberValue.match(/^\d{10,14}$/)) { // Memeriksa apakah nomor berisi angka dan panjangnya 10-14 karakter
        isValid = false;
      }
    });

    // Periksa apakah setidaknya satu metode pembayaran dipilih
    let paymentMethods = document.querySelectorAll('input[type="radio"][name="metode_pembayaran"]');
    paymentMethods.forEach(function(paymentMethod) {
      if (paymentMethod.checked) {
        selectedPaymentMethod = true;
      }
    });

    // Set properti disabled dari tombol submit berdasarkan hasil validasi, pengisian semua field, dan pemilihan minimal satu metode pembayaran
    submitButton.disabled = !isValid || !allFieldsFilled || !selectedPaymentMethod;

  document.addEventListener('DOMContentLoaded', function() {
    let inputFields = document.querySelectorAll('input[type="text"], input[type="email"], input[type="tel"], select');
    inputFields.forEach(function(field) {
      field.addEventListener('input', toggleSubmitButton); // Gunakan event input agar validasi dilakukan saat nilai berubah, bukan saat blur
    });

    let paymentMethods = document.querySelectorAll('input[type="radio"][name="metode_pembayaran"]');
    paymentMethods.forEach(function(paymentMethod) {
      paymentMethod.addEventListener('change', toggleSubmitButton); // Gunakan event change untuk memantau perubahan pemilihan metode pembayaran
    });

    // Tambahkan event listener untuk memeriksa email dan nomor HP saat submit
    let submitButton = document.getElementById('submit_button');
    submitButton.addEventListener('click', function(event) {
      let existingEmails = Array.from(document.querySelectorAll('input[type="email"]')).map(email => email.value.trim().toLowerCase());
      let existingPhoneNumbers = Array.from(document.querySelectorAll('input[type="tel"]')).map(phone => phone.value.trim());

      let newEmail = document.getElementById('email').value.trim().toLowerCase();
      let newPhoneNumber = document.getElementById('nomor_hp').value.trim();

      if (existingEmails.includes(newEmail) || existingPhoneNumbers.includes(newPhoneNumber)) {
        alert('Email atau nomor HP sudah ada yang menggunakan. Silakan gunakan yang lain.');
        submitButton.disabled = true; // Menonaktifkan tombol submit jika ada duplikasi
        event.preventDefault(); // Mencegah form dari dikirim jika ada duplikasi
      } else {
        toggleSubmitButton(); // Panggil kembali fungsi toggleSubmitButton() untuk memastikan tombol submit tetap nonaktif jika masih ada field yang belum valid
      }
    });
  });
  }

</script>

        <div class="payment">
          <h1>Metode Pembayaran</h1>
    <div class="vrac">
      <h2>Virtual Account</h2>
      <input type="radio" id="radio11" name="metode_pembayaran" class="radio-input" value="BCA">
      <label for="radio11" class="radio-label">
        <span class="radio-inner-circle"></span>
        BCA
        <img src="Pyment_metods/Logo-Bank-BCA-1.png" alt="">
      </label>
      <input type="radio" id="radio21" name="metode_pembayaran" class="radio-input" value="BNI">
      <label for="radio21" class="radio-label">
        <span class="radio-inner-circle"></span>
        BNI
        <img src="Pyment_metods/BNI_logo.png" alt="">
      </label>
      
      <input type="radio" id="radio31" name="metode_pembayaran" class="radio-input" value="MANDIRI">
      <label for="radio31" class="radio-label">
        <span class="radio-inner-circle"></span>
        MANDIRI
        <img src="Pyment_metods/Logo Mandiri.png" alt="">
      </label>
    </div>
    <br>  
    <div class="vrac">
      <h2>E-Wallet</h2>
      <input type="radio" id="radio12" name="metode_pembayaran" class="radio-input" value="OVO">
      <label for="radio12" class="radio-label">
        <span class="radio-inner-circle"></span>
        OVO
        <img src="Pyment_metods/Logo_ovo_purple.svg.png" alt="">
      </label>
      
      <input type="radio" id="radio22" name="metode_pembayaran" class="radio-input" value="GOPAY">
      <label for="radio22" class="radio-label">
        <span class="radio-inner-circle"></span>
        GOPAY
        <img src="Pyment_metods/logo-gopay-vector.png" alt="">
      </label>
      
      <input type="radio" id="radio32" name="metode_pembayaran" class="radio-input" value="SHOPPEPAY">
      <label for="radio32" class="radio-label">
        <span class="radio-inner-circle"></span>
        SHOPEEPAY
        <img src="Pyment_metods/logo-shopeepay.png" alt="">
      </label>
    </div>
        </div>
        <div class="paymenbutton">
        <button id="submit_button" type='submit' disabled>Lanjutkan Pembayaran</button>
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
    </body>
  </html>
  <script>
      feather.replace();
</script> 
