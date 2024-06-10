<?php 
include 'koneksi.php';

session_start();
if(isset($_SESSION['username'])){
  header("location: main.php");
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
  $email = $_POST['email_user'];
  $password = $_POST['password_user'];

  $query = "SELECT * FROM user WHERE email_user = '$email' AND password_user = '$password'";
  $result = mysqli_query($conn, $query);

  if(mysqli_num_rows($result) == 1){
    $row = mysqli_fetch_assoc($result);
    $_SESSION['id_user'] = $row['id_user'];
    $_SESSION['username'] = $row['username'];

    header("Location: main.php");
    exit();
  }else{
    $error = "Username atau password salah";
  }
}
$error = '';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="login.css" />
    <script src="https://unpkg.com/feather-icons"></script>
</head>
<body>
<header>
        <div class="navigation">
          <div id="judul">
            <img
              src="Logo/Logo Mytic (Blue).png"
              alt=""
            />
            <h1>My.Tic</h1>
          </div>
          <div id="kanan">
            <ul>
              <a href="main.php">Utama</a>
              <a href="listkonser.php">List Konser</a>
              <a href="#"><i data-feather="user"></i>Login</a>
            </ul>
          </div>
        </div>
    </header>

  <main>
    <div class="containerBox">
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <h2>Log in</h2>
        <h4>Email</h4>
        <input type="text" placeholder="Masukkan Email Anda" id="email_user" name="email_user" require>
        <h4>Your Password</h4>
        <input type="password" placeholder="Masukkan Password Anda" id="password_user" name="password_user" require>
        <button type="submit">
          <span span class="button_top">Login</span>
        </button>
        <h5 id="tou_pp">By continuing, you agree to the <a href="#">Terms of use</a> and <a href="#">Privacy Policy</a></h5>
        <div class="opsi2">
          <h5>Do not have an account ? <a href="#">Create account</a></h5>
          <h5><a href="#">Forget your password</a></h5>
        </div>
      </form>
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