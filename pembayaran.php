  <?php

  include "koneksi.php";
  session_start();
  $username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
    $idUser = $_SESSION['id_user'] ? $_SESSION['id_user'] : '';
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






          <!-- <div class="paymenbutton">
              <a href="success.php"><button>Lanjutkan Pembayaran</button></a>
          </div> -->

          
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

    // Panggil fungsi toggleSubmitButton() saat input berubah
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

  <!-- INI ADALAH PEMBAYARAN YANG BISA MEMBRIKAN VALUE -->
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
            <img
              src="Logo/Logo Mytic (White).png"
              alt=""
            />
            <h1>My.Tic</h1>
            <p>
              My.Tic adalah platform digital pemesanan tiket baik konser,
              festival, ataupun fanmeet dalam negri maupun luar negri. Dengan
              kemudahan akses dan pembayaran memberikan pengalaman membeli tiket
              yang menyenangkan.
            </p>

            <div class="parent">
              <div class="child child-1">
                <button class="button btn-1">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    height="1em"
                    viewBox="0 0 512 512"
                    fill="#1e90ff"
                  >
                    <path
                      d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"
                    ></path>
                  </svg>
                </button>
              </div>

              <div class="child child-2">
                <button class="button btn-2">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    height="1em"
                    viewBox="0 0 448 512"
                    fill="#ff00ff"
                  >
                    <path
                      d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"
                    ></path>
                  </svg>
                </button>
              </div>
              <div class="child child-3">
                <button class="button btn-3">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    height="1em"
                    viewBox="0 0 496 512"
                  >
                    <path
                      d="M165.9 397.4c0 2-2.3 3.6-5.2 3.6-3.3.3-5.6-1.3-5.6-3.6 0-2 2.3-3.6 5.2-3.6 3-.3 5.6 1.3 5.6 3.6zm-31.1-4.5c-.7 2 1.3 4.3 4.3 4.9 2.6 1 5.6 0 6.2-2s-1.3-4.3-4.3-5.2c-2.6-.7-5.5.3-6.2 2.3zm44.2-1.7c-2.9.7-4.9 2.6-4.6 4.9.3 2 2.9 3.3 5.9 2.6 2.9-.7 4.9-2.6 4.6-4.6-.3-1.9-3-3.2-5.9-2.9zM244.8 8C106.1 8 0 113.3 0 252c0 110.9 69.8 205.8 169.5 239.2 12.8 2.3 17.3-5.6 17.3-12.1 0-6.2-.3-40.4-.3-61.4 0 0-70 15-84.7-29.8 0 0-11.4-29.1-27.8-36.6 0 0-22.9-15.7 1.6-15.4 0 0 24.9 2 38.6 25.8 21.9 38.6 58.6 27.5 72.9 20.9 2.3-16 8.8-27.1 16-33.7-55.9-6.2-112.3-14.3-112.3-110.5 0-27.5 7.6-41.3 23.6-58.9-2.6-6.5-11.1-33.3 2.6-67.9 20.9-6.5 69 27 69 27 20-5.6 41.5-8.5 62.8-8.5s42.8 2.9 62.8 8.5c0 0 48.1-33.6 69-27 13.7 34.7 5.2 61.4 2.6 67.9 16 17.7 25.8 31.5 25.8 58.9 0 96.5-58.9 104.2-114.8 110.5 9.2 7.9 17 22.9 17 46.4 0 33.7-.3 75.4-.3 83.6 0 6.5 4.6 14.4 17.3 12.1C428.2 457.8 496 362.9 496 252 496 113.3 383.5 8 244.8 8zM97.2 352.9c-1.3 1-1 3.3.7 5.2 1.6 1.6 3.9 2.3 5.2 1 1.3-1 1-3.3-.7-5.2-1.6-1.6-3.9-2.3-5.2-1zm-10.8-8.1c-.7 1.3.3 2.9 2.3 3.9 1.6 1 3.6.7 4.3-.7.7-1.3-.3-2.9-2.3-3.9-2-.6-3.6-.3-4.3.7zm32.4 35.6c-1.6 1.3-1 4.3 1.3 6.2 2.3 2.3 5.2 2.6 6.5 1 1.3-1.3.7-4.3-1.3-6.2-2.2-2.3-5.2-2.6-6.5-1zm-11.4-14.7c-1.6 1-1.6 3.6 0 5.9 1.6 2.3 4.3 3.3 5.6 2.3 1.6-1.3 1.6-3.9 0-6.2-1.4-2.3-4-3.3-5.6-2z"
                    ></path>
                  </svg>
                </button>
              </div>
              <div class="child child-4">
                <button class="button btn-4">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    height="1em"
                    viewBox="0 0 320 512"
                    fill="#4267B2"
                  >
                    <path
                      d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"
                    ></path>
                  </svg>
                </button>
              </div>
            </div>
            
            <div id="plgbwh">
            <hr />
            <div id="copyright">
              &copy; 2023 Copyright Website Anda -
              <a href="https://www.websiteanda.com">Website Anda</a>
            </div>
          </div>
        </div>
      </footer>
    </body>
  </html>
  <script>
      feather.replace();
</script> 
