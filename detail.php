<?php 
include "koneksi.php";
if($_GET){
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
            FROM 
              konser
            WHERE 
              konser.id_konser = {$_GET['id']}";
    $result = mysqli_query($conn,$sql);
    if (mysqli_num_rows($result)>0){
        $row = mysqli_fetch_assoc($result);
    }else{
        echo "Data yang akan diedit tidak ada.";
    }
}
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
          <img
            src="Logo/logo Mytic (White).png"
            alt=""
          />
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
    <main>

      <!-- breadcrumb -->
        <div class="breadcrumb">
          <a href="/main.html">Utama</a>
          <h3> < </h3>
          <a href="#">Detail Konser</a>
        </div>
      <!-- breadcrumb -->
     
      <div class="gambar">
        <a href="main.html"><button>
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
            <h2><?php echo $row['jam_mulai'] . " - " . $row['jam_akhir'] . " WIB"; ?></h2></span>
        </div>

        <div class="kanan">
          <h2>Harga Mulai</h2>
          <h1>Rp. 250.000</h1>
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
          <p>Prambanan Jazz merupakan festival musik internasional tahunan yang diadakan di pelataran Candi Prambanan, Yogyakarta, mengusung konsep gabungan dua mahakarya besar yaitu Candi Prambanan dan mahakarya musik internasional, serta musik nasional. Festival musik diusung sebagai salah satu media diplomasi kebudayaan Indonesia di dunia internasional untuk melengkapi ekosistem pariwisata dengan menjadi salah satu event wisata musik. Sejak pertama kali diselenggarakan pada tahun 2015.
          </p>
        </div>


        <div class="layout">
          <h1>Tata Letak</h1>
          <img src="/drive-download-20240310T064708Z-001/Layout.1.jpg" alt="">
        </div>

        <div class="term">
          <h1>Syarat & Kententuan</h1>
          <p>
            <ol>
              <li>Tiket konser belum termasuk tiket Candi Prambanan.</li>
              <li>Entry Pass yang valid adalah yang dibeli melalul Tiketbox.</li>
              <li>Satu E-karcis berlaku untuk satu orang.</li>
              <li>Panitia dan Promotor tidak bertanggung Jawab/ tidak ada penggantian kerugian atas pembellan tiket acara melalul calo/tempat/kanal/platform/yang bukan mitra resmi penjualan tiket</li>
              <li>Tiket yang hilang/dicuri tidak akan diganti atau diterbltkan ulang. Mesklpun anda memlliki bukti pembelian. kerahasiaan tiket merupakan tanggung jawab pembell</li>
              <li>Panitia acara, Promotor, dan Pengisl Acara tidak bertanggung jawab atas blaya transportasi atau akomodasi yang telah dikeluarkan penonton untuk mengunjungl acara Jika seandainya acara harus dibatalkan atau dipindahkan ke hari dan/atau waktu lain.</li>
              <li>Dalam keadaan-keadaan kahar seperti bencana alam, kerusuhan, perang, wabah, dan semua keadaan darurat yang diumumkan secara resmi oleh Pemerintah. Panitia/penyelenggara/prometor berhak untuk membatalkan dan/atau merubah waktu acara dan tata letak tempat tanpa pemberitahuan sebelumnya.</li>
              <li>Panitia/Penyelenggara/Promotor berhak untuk, merevisi waktu acara, tata letak tempat dan kapasitas penonton tanpa pemberitahuan sebelumnya.</li>
              <li>Jika acara dibatalkan, Promotor harus mengembalikan uang pembelian tiket yang sudah dibeli dengan jangka waktu yang akan diinfokan lebih lanjut oleh Promotor, tetapi akan dipotong biaya bank, biaya lain-lain dan pembayaran lain yang mungkin dikenakan untuk mentransfer uang kembali ke pelanggan.</li>
              <li>Panitia acara/penanggung jawab tempat acara, promotor, dan pengisi acara tidak bertanggung jawab atas hilangnya barang-barang pribadi para penonton atau kejadian-kejadian yang mengakibatkan cedera di sema area acara selama acara berlangsung, apapun alasannya.</li>
              <li>Harap membave kartu ID asli dan e-karcis dari Tiketbox.com saat melakukan penukaran tiket.</li>
              <li>Promotor berhak untuk:</li>
              <ul>
                <li>Melarang penonton masuk jika E-karcis telah digunakan oleh orang lain.</li>
                <li>Melarang penonton masuk ke area jika E-karcis yang digunakan tidak valid.</li>
                <li>Memproses atau mengajukan hukuman, baik perdata maupun pidana, terhadap pengunjung yang mendapatkan E-karcis secara tidak sah, termasuk ditemukannya memalsukan dan menggandakan E-karcis yang sah atau memperoleh E-karcis dengan cara yang tidak sesuai dengan prosedur.</li>
              </ul>
              <li>Penyelenggara mengambil tindakan tegas, dan berhak mengeluarkan pengunjung dari acara jika tidak mematuhi protokol kesehatan yang telah diterapkan.</li>
              <li>Barang yang boleh dibawa kedalam venue:</li>
              <ul>
                <li>Membawa kartu identitas dan uang pribadi</li>
                <li>Membawa bukti tiket/tanda masuk</li>
                <li>Membawa masker dan hand sanitizer</li>
              </ul>
              <li>Membawa obat-obatan pribadi:</li>
              <ul>
                <li>Membawa jas hujan</li>
                <li>Membawa handphone / perangkat lainnya</li>
                <li>Barang yang tidak diperbolehkan dibawa kedalam vanue</li>
                <li>Makanan dan minuman dari luar</li>
                <li>Kamera profesional seperti Drone, SLR, DSLR.</li>
                <li>Tongsis atau Selfie Stick</li>
                <li>Minuman beralkohol, obat-obatan terlarang, psikotropika, atau barang yang mengandung zat berbahava lainnva.</li>
                <li>Senjata tajam/api, bahan peledak, dan benda-benda yang dilarang menurut ketentuan peraturan perundang-undangan yang berlaku ke dalam Kolese Kanisius.</li>
                <li>Cairan dan benda yang mudah terbakar.</li>
                <li>Tas atau ransel berukuran besar.</li>
                <li>Laser dan pointer.</li>
                <li>Rokok yang terbuka segelnya</li>
                <li>Barang yang berbahaya untuk orang lain maupun diri sendiri walaupun tidak disebutkan pada peraturan diatas.</li>
              </ul>
              <li>Pihak promotor/ penyelenggara acara berhak mengambil, menyita dan tidak mengembalikan kepada penonton jika ditemukannya barang terlarang saat pengecekan barang.</li>
              <li>Dilarang merokok di dalam area acara.</li>
            </ol>
            <br>
            <span id="boldernih">Dilarang membuat kerusuhan dalam situasi apapun di dalam area acara
            SAYA TELAH MEMBACA DAN MEMAHAMI SYARAT DAN KETENTUAN PEMBELIAN DAN PENGGUNAAN ENTRY PASS DI ATAS. DAN JIKA ADA PERUBAHAN ATURAN PROMOTOR, AKAN SEGERA DIINFORMASIKAN DI AKUN MEDIA SOSIAL PROMOTOR DAN SAYA MEMBERIKAN PERSETUJUAN SAYA UNTUK DIKONTRAKKAN SECARA HUKUM DENGAN SYARAT DAN KETENTUAN.</span>
            </p>

          </div>

          <div class="line1" id="boxtiket">
            <div class="box">
              <h1>Day 1 <br>(Festival)</br> </h1>
              <p>1 Tiket untuk 1 Orang</p>
              <h2>Rp. 250.000</h2>
              <button>-</button>
              <h3>0</h3>
              <button>+</button>
              <h4>Tersedia: 4 </h4>
            </div>
    
            <div class="box">
              <h1>Day 2 <br>(Festival)</br></h1>
              <p>1 Tiket untuk 1 Orang</p>
              <h2>Rp. 250.000</h2>
              <button>-</button>
              <h3>0</h3>
              <button>+</button>
              <h4>Tersedia: 0 </h4>
            </div>
    
            <div class="box">
              <h1>Day 3 <br>(Festival)<br></h1>
              <p>1 Tiket untuk 1 Orang</p>
              <h2>Rp. 250.000</h2>
              <button>-</button>
              <h3>3</h3>
              <button>+</button>
              <h4>Tersedia: 6 </h4>
            </div>
    
            <div class="box">
              <h1>Day 3 Pass <br>(Festival)</br></h1>
              <p>3 Tiket untuk 3 Orang</p>
              <h2>Rp. 600.000</h2>
              <button>-</button>
              <h3>0</h3>
              <button>+</button>
              <h4>Tersedia: 11 </h4>
            </div>
          </div>

          <div class="line1">
            <div class="box">
              <h1>Day 1 <br>(Super Festival)<br></h1>
              <p>1 Tiket untuk 1 Orang</p>
              <h2>Rp. 350.000</h2>
              <button>-</button>
              <h3>0</h3>
              <button>+</button>
              <h4>Tersedia: 8 </h4>
            </div>
    
            <div class="box">
              <h1>Day 2 <br>(Super Festival)<br></h1>
              <p>1 Tiket untuk 1 Orang</p>
              <h2>Rp. 350.000</h2>
              <button>-</button>
              <h3>0</h3>
              <button>+</button>
              <h4>Tersedia: 0 </h4>
            </div>
    
            <div class="box">
              <h1>Day 3 <br>(Super Festival)<br></h1>
              <p>3 Tiket untuk 3 Orang</p>
              <h2>Rp. 350.000</h2>
              <button>-</button>
              <h3>0</h3>
              <button>+</button>
              <h4>Tersedia: 4 </h4>
            </div>
    
            <div class="box">
              <h1>Day 3 Pass <br>(Super Festival)<br></h1>
              <p>3 Tiket untuk 3 Orang</p>
              <h2>Rp. 840.000</h2>
              <button>-</button>
              <h3>0</h3>
              <button>+</button>
              <h4>Tersedia: 16 </h4>
            </div>
          </div>
    
          <div class="line1" id="line3">
            <div class="box">
              <h1>Gold <br>(Special Show)</br></h1>
              <p>1 Tiket untuk 1 Orang</p>
              <h2>Rp. 450.000</h2>
              <button>-</button>
              <h3>0</h3>
              <button>+</button>
              <h4>Tersedia: 16 </h4>
            </div>
    
            <div class="box">
              <h1>Diamond <br>(Special Show)</br></h1>
              <p>1 Tiket untuk 1 Orang</p>
              <h2>Rp. 750.000</h2>
              <button>-</button>
              <h3>0</h3>
              <button>+</button>
              <h4>Tersedia: 0 </h4>
            </div>
    
            <div class="box">
              <h1>VIP <br>(Special Show)</br></h1>
              <p>1 Tiket untuk 1 Orang</p>
              <h2>Rp. 1.00.000</h2>
              <button>-</button>
              <h3>0</h3>
              <button>+</button>
              <h4>Tersedia: 19 </h4>
            </div>
          </div>

          <div class="harga">
            <h1>Total Harga (IDR) <span>Rp. 750.000</span></h1>
            <a href="/pembayaran.html">
              <button class="btn">
                <svg
                  height="24"
                  width="24"
                  fill="#FFFFFF"
                  viewBox="0 0 24 24"
                  data-name="Layer 1"
                  id="Layer_1"
                  class="sparkle"
                >
                  <path
                    d="M10,21.236,6.755,14.745.264,11.5,6.755,8.255,10,1.764l3.245,6.491L19.736,11.5l-6.491,3.245ZM18,21l1.5,3L21,21l3-1.5L21,18l-1.5-3L18,18l-3,1.5ZM19.333,4.667,20.5,7l1.167-2.333L24,3.5,21.667,2.333,20.5,0,19.333,2.333,17,3.5Z"
                  ></path>
                </svg>
    
                <span class="text">Beli Tiket</span>
              </button></a
            >
          </div>

          


          


        <div class="tulisan">
          <h1>Event Terbaru</h1>
          <!-- <a href="#"><h1>Load More >></h1></a> -->
          <a href="#">
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
          <div class="box2">
            <img
            src="/drive-download-20240317T045143Z-001/The Eternity/Poster.jpg"
            alt="Image 6"
          />
          <h3>The Eternity</h3>
          <p>Chanyeol</p>
          <h4>Jakarta &bull; 9 Maret 2024</h4>
          <h5>
            On September 29th, 2023, the official Twitter account of Kpop group EXO (@weareoneEXO) announced CHANYEOL's fancon tour titled 'The Eternity' in Asia, starting from Taoyuan then Bangkok and Hong Kong.
            Then finally on December 19th, 2023, the @weareoneEXO account announced CHANYEOL's next fancon tour destinations in
          </h5>
          <h2>Rp. 1.400.000,00</h2>
          <a href="#">Detail</a>
          </div>
          <div class="box2">
            <img
            src="/drive-download-20240317T045143Z-001/Bersua Festival/Poster.3.png"
            alt="Image 4"
          />
          <h3>Bersua Festival</h3>
          <p>Yura Yunita, Lomba Sihir, Coldiac, Ngatmobilung</p>
          <h4>Yogyakarta &bull; 27-28 April 2024</h4>
          <h5>
            Di tengah keindahan Yogyakarta yang kaya akan budaya. BERSUA hadir
            sebagai panggung kebersamaan di mana musik menyatukan orang-orang
            dari berbagai latar belakang. Suatu acara di mana keluarga, sahabat,
            dan komunitas bisa bersatu dalam keindahan musik, merayakan
            keberagaman, dan menciptakan  ...
          </h5>
          <h2>Rp. 250.000,00</h2>
          <a href="#">Detail</a>
          </div>
  
          <div class="box2">
            <img
            src="/drive-download-20240317T045143Z-001/Niall Horan/Poster.1.jpg"
            alt="Image 5"
          />
          <h3>Niall Horan: The S.. </h3>
          <p>Niall Horan</p>
          <h4>Jakarta &bull; 11 Mei 2024</h4>
          <h5>
            The chart-topping global superstar Niall Horan has announced the following tour called “THE SHOW LIVE ON TOUR" – his biggest tour yet and first headline run since 2018’s Flicker World Tour. Niall Horan will be adding new dates in Asia and will be performing in Jakarta on Saturday, 11 May 2024 at Beach City International Stadi...
          </h5>
          <h2>Rp. 1.200.000,00</h2>
          <a href="#">Detail</a>
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
