<?php 
include 'koneksi.php';

session_start();
if(isset($_SESSION['username'])){
  header("location: main.html");
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
  $email = $_POST['email_user'];
  $password = $_POST['password_user'];

  $query = "SELECT * FROM user WHERE email_user = '$email' AND password_user = '$password'";
  $result = mysqli_query($conn, $query);

  if(mysqli_num_rows($result) == 1){
    $row = mysqli_fetch_assoc($result);
    session_start();
    $_SESSION['id_user'] = $row['id_user'];
    $_SESSION['username'] = $row['username'];

    header("Location: main.html");
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
              src="Logo/Logo Mytic (White).png"
              alt=""
            />
            <!-- <h1>My.Tic</h1> -->
          </div>
          <div id="kanan">
            <ul>
              <a href="main.html">Utama</a>
              <a href="#">List Konser</a>
              <a href="main.html">Tentang Kami</a>
              <a href="#"><i data-feather="user"></i> Login</a>
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
          <span span class="button_top">Button</span>
        </button>
        <h5>By continuing, you agree to the <a href="#">Terms of use</a> and <a href="#">Privacy Policy</a></h5>
        <div class="opsi2">
          <h5>Do not have an account ? <a href="#">Create account</a></h5>
          <h5><a href="#">Forget your password</a></h5>
        </div>
      </form>
    </div>
  </main>
  <script>
      feather.replace();
  </script> 
</body>
</html>