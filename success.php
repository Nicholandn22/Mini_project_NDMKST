<?php 
  session_start();
  $username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
  $idUser = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : '';
  $isLoggedIn = !empty($username);

  include "koneksi.php";

  // Define a default value for email
  $email = '';

  if ($idUser) {
    $sql = "SELECT user.id_user, user.email_user FROM user WHERE user.id_user = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $idUser);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $email = $row['email_user'];
    }
    mysqli_stmt_close($stmt);
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="success.css" />  <!-- nnt - dignati file css kaleann -->
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

    <a href="detail.php" id="kembali"><button>
      <span><i data-feather="chevron-left"></i></span>
    </button></a>

    <div id="completed">
      <h1>Completed!</h1>
    </div>
    <div id="img-gambar">
      <img src="Konser/succes.png" alt="success">
    </div>
    <div class="info-bwh">
      <div id="information">
        <div class="information">
          <h3>Detail pembelian sudah dikirim ke email</h3>
        </div>
        <div class="information">
          <p><?php echo htmlspecialchars($email); ?></p>
        </div>
        <div class="btn-bawah">
          <p>Apakah anda belum menerima email?</p>
          <button id="resend-button"><a href="#" id="resend-button">Kirim Ulang</a></button>
          <button id="home-button"><a href="main.php" id="home-button">Home</a></button>
        </div>
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
</body>
</html>
<script>
      feather.replace();
</script> 