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
              <a href="#">List Konser</a>
              <a href="#">Tentang Kami</a>
              <a href="login.php"><i data-feather="user"></i> Login</a>
          </ul>
        </div>
      </div>
  </header>
  <div id="changing">
    <section id="bgchange"></section>
  </div>
  <script>
    const backgroundImages = [
  'url("Konser/IVE/Poster.1.webp")',
  'url("Konser/BersuaFestival/Poster.2.png")',
  'url("Konser/ChaEunWoo/Poster.1.jpeg")',
  'url("Konser/IU/Poster.1.jpg")',
  'url("Konser/BlessThisConcert/Poster.jpg")',
  'url("Konser/NiallHoran/Poster.1.jpg")',
  'url("Konser/SoundOfDowntown/Poster.jpg")',
  'url("Konser/TheEternity/Poster.jpg")',
];

  let currentIndex = 0;
      const section = document.querySelector('#bgchange');

      function changeBackground() {
      section.style.backgroundImage = `linear-gradient(to bottom, transparent 80%, rgba(255, 255, 255, 1) 100%), ${backgroundImages[currentIndex]}`;
      currentIndex = (currentIndex + 1) % backgroundImages.length; 
    }

setInterval(changeBackground, 7000);
  </script>

    <main>
      <div class="container">
        <div class="search">
          <p>Cari Konser</p>
          <input type="text" id="my-konser" placeholder="Nama Konser" />
        </div>
        <div class="search">
          <p>Lokasi</p>
          <input type="text" id="my-location" placeholder="Lokasi" />
        </div>
        <div class="search">
          <p>Waktu</p>
          <input type="date" id="my-date" placeholder="Tanggal" />
        </div>
        <!-- tombol search -->
        <a href="#" class="btn-search"> Search</a>  
        <!-- tombol search -->
      </div>

      <div class="container-ft">
        <div class="dropdown-menus">
          <div class="dropdown">
            <button class="dropdown-button">Hari <i data-feather="chevron-down"></i></button>
            <div class="dropdown-content">
              <a href="#">Senin</a>
              <a href="#">Selasa</a>
              <a href="#">Rabu</a>
              <a href="#">Kamis</a>
              <a href="#">Jumat</a>
              <a href="#">Sabtu</a>
              <a href="#">Minggu</a>
            </div>
          </div>
          <div class="dropdown">
            <button class="dropdown-button">Kategori <i data-feather="chevron-down"></i></button>
            <div class="dropdown-content">
              <a href="#">Konser</a>
              <a href="#">Festival</a>
              <a href="#">Fanmeet</a>
            </div>
          </div>
        </div>
      </div>

      <!-- tulisan opcoming event ama loadmore -->
      <div class="tulisan">
        <h1>Event Terbaru</h1>
        <!-- <a href="#"><h1>Load More >></h1></a> -->
        <a href="detail.html">
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
        <div class="box">
          <img
            src="Konser\PrambananJazz\Banner_Prambanan_Jazz.3.jpg"
            alt="Image 1"
          />
          <div class="dalam">
            <h3>PRAMBANAN JAZZ</h3>
            <p>Maliq & D'Essentials, Kahitna, Tulus, JKT48, Kunto  ...</p>
            <h4>Yogyakarta &bull; 5-7 Juli 2024</h4>
            <h5>
              Prambanan Jazz merupakan festival musik internasional tahunan yang
              diadakan di pelataran Candi Prambanan, Yogyakarta, mengusung konsep
              gabungan dua mahakarya besar yaitu Candi Prambanan dan mahakarya
              musik internasional, serta musik nasional. Festival musik diusung
              sebagai salah satu media diplomasi...
            </h5>
            <h2>Rp. 250.000,00</h2>
            <a href="/detail.html">Detail</a>
          </div>
        </div>
        <div class="box">
          <img
            src="Konser/ChaEunWoo/Poster.2.jpg"
            alt="Image 2"
          />
          <div class="dalam">
            <h3>Just One Minute</h3>
            <p>Cha Eun Woo</p>
            <h4>Jakarta &bull; 20 April 2024</h4>
            <h5>
              Our next event is CHA EUN-WOO 2024 Just One 10 Minute [Mystery
              Elevator] in Jakarta on 20 April 2024, 7pm at Tennis Indoor Senayan.
              Fans are invited to embark on a unique journey by riding the
              “Mystery Elevator” to an unexplored space, where they can fully
              indulge in and appreciate the multifaceted charms of CHA EUN W...
            </h5>
            <h2>Rp. 1.000.000,00</h2>
            <a href="/detail.html">Detail</a>
          </div>
        </div>

        <div class="box">
          <img
            src="Konser/IVE/Poster.2.jpeg"
            alt="Image 3"
          />
          <div class="dalam">
            <h3>IVE The First</h3>
            <p>IVE</p>
            <h4>Jakarta &bull; 24 Agustus 2024</h4>
            <h5>
              Show What I Have World Tour is the first worldwide concert tour and second tour overall by South Korean girl group Ive, in support of their extended play I've Mine. The tour began on October 7, 2023, in Seoul, South Korea and is currently set to conclude on August 24, 2024, in Jakarta, Indonesia. The tour consists of 32 concerts, includi...
            </h5>
            <h2>Rp. 1.200.000,00</h2>
            <a href="/detail.html">Detail</a>
          </div>
        </div>
      </div>

      <div class="container2">
        <div class="box">
          <img
            src="Konser/BersuaFestival/Poster.3.png"
            alt="Image 4"
          />
          <div class="dalam">
            <h3>Bersua Festival</h3>
            <p>Yura Yunita, Lomba Sihir, Coldiac, Ngatmobilung</p>
            <h4>Yogyakarta &bull; 27-28 April 2024</h4>
            <h5>
              Di tengah keindahan Yogyakarta yang kaya akan budaya. BERSUA hadir
              sebagai panggung kebersamaan di mana musik menyatukan orang-orang
              dari berbagai latar belakang. Suatu acara di mana keluarga, sahabat,
              dan komunitas bisa bersatu dalam keindahan musik, merayakan
              keberagaman, dan menciptakan kenangan yang ...
            </h5>
            <h2>Rp. 250.000,00</h2>
            <a href="/detail.html">Detail</a>
          </div>
        </div>
        <div class="box">
          <img
            src="Konser/NiallHoran/Poster.1.jpg"
            alt="Image 5"
          />
          <div class="dalam">
            <h3>Niall Horan: The S.. </h3>
            <p>Niall Horan</p>
            <h4>Jakarta &bull; 11 Mei 2024</h4>
            <h5>
              The chart-topping global superstar Niall Horan has announced the following tour called “THE SHOW LIVE ON TOUR" – his biggest tour yet and first headline run since 2018’s Flicker World Tour. Niall Horan will be adding new dates in Asia and will be performing in Jakarta on Saturday, 11 May 2024 at Beach City International Stadi...
            </h5>
            <h2>Rp. 1.200.000,00</h2>
            <a href="/detail.html">Detail</a>
          </div>
        </div>

        <div class="box">
          <img
            src="Konser/TheEternity/Poster.jpg"
            alt="Image 6"
          />
          <div class="dalam">
            <h3>The Eternity</h3>
            <p>Chanyeol</p>
            <h4>Jakarta &bull; 9 Maret 2024</h4>
            <h5>
              On September 29th, 2023, the official Twitter account of Kpop group EXO (@weareoneEXO) announced CHANYEOL's fancon tour titled 'The Eternity' in Asia, starting from Taoyuan then Bangkok and Hong Kong.
              Then finally on December 19th, 2023, the @weareoneEXO account announced CHANYEOL's next fancon tour destinations in the following cities which is

            </h5>
            <h2>Rp. 1.400.000,00</h2>
            <a href="/detail.html">Detail</a>
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

    <script>
      feather.replace();
  </script> 
  </body>
</html>