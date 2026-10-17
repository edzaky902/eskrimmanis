<?php
// ===== DATA PRODUK (array) =====
$produk = [
    ["nama" => "Magnum clasic belgian cokelat",    "harga" => 15000,"images"=>"images/belgian milk.jpeg"],
    ["nama" => "Magnum pistachio",  "harga" => 15000,"images"=>"images/pistacio.jpeg"],
    ["nama" => "Magnum blueberry cheesecake", "harga" => 15000,"images"=>"images/blueberry.jpeg"],
    
];

// ===== PAGE VIEW COUNTER =====
$file = "counter.txt";
$jumlah = (int) file_get_contents($file);
$jumlah = $jumlah + 1;
file_put_contents($file, $jumlah);

// ===== PEMROSESAN FORM (POST) =====
$hasil = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama   = htmlspecialchars($_POST["nama"]);
    $rasa   = $_POST["rasa"];
    $jumlah_cup = (int) $_POST["jumlah"];

    $harga = 15000;
    foreach ($produk as $p) {
        if ($p["nama"] == $rasa) {
            $harga = $p["harga"];
        }
    }

    // Operator aritmatika
    $total = $harga * $jumlah_cup;

    // Percabangan if/else untuk diskon
    if ($total >= 50000) {
        $diskon = $total * 0.1;
        $keterangan = "Selamat! Anda mendapat diskon 10%";
    } else {
        $diskon = 0;
        $keterangan = "Belum mendapat diskon (minimal belanja Rp50.000)";
    }

    $bayar = $total - $diskon;

    // Struk pembayaran
    $hasil .= "<div class='struk'>";
    $hasil .= "<h3>Struk Pembayaran</h3>";
    $hasil .= "<p>Nama Pelanggan : <b>" . $nama . "</b></p>";
    $hasil .= "<p>Varian Rasa : " . $rasa . "</p>";
    $hasil .= "<p>Harga Satuan : Rp" . number_format($harga, 0, ",", ".") . "</p>";
    $hasil .= "<p>Jumlah : " . $jumlah_cup . " cup</p>";
    $hasil .= "<p>Total Belanja : Rp" . number_format($total, 0, ",", ".") . "</p>";
    $hasil .= "<p>Diskon : Rp" . number_format($diskon, 0, ",", ".") . "</p>";
    $hasil .= "<p class='info'>" . $keterangan . "</p>";
    $hasil .= "<p class='bayar'>Total Bayar : Rp" . number_format($bayar, 0, ",", ".") . "</p>";
    $hasil .= "</div>";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sweet Ice Cream</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;500;600;700&family=Poppins:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- HEADER / NAVIGASI -->
    <header class="header">
        <div class="brand">🍦 Sweet Ice Cream</div>
        <nav class="nav">
            <a href="#beranda">Beranda</a>
            <a href="#profil">Profil &amp; Visi Misi</a>
            <a href="#produk">Produk &amp; Harga</a>
            <a href="#pesan">Pesan Sekarang</a>
        </nav>
        <a href="#pesan" class="btn btn-terracotta">Pesan</a>
    </header>

    <main>
        <!-- HERO -->
        <section class="hero" id="beranda">
            <div class="hero-text">
                <h1>Es Krim Magnum</h1>
                <p>Rasa Terbaik Dari Bahan Berkualitas</p>
                <div class="tags">
                    <span class="tag">belgian cokelat</span>
                    <span class="tag">pistachio</span>
                    <span class="tag">blueberry cheesecake</span>
                </div>
                <a href="#pesan" class="btn btn-terracotta">Pesan Sekarang</a>
            </div>
            <div class="hero-image">
            <img src="images/belgian milk.jpeg" alt="Es Krim Magnum" onerror="this.style.display='none'">
                <span class="badge-float">⭐ Menu Favorit</span>
            </div>
        </section>

        <!-- PROFIL & VISI MISI -->
        <section class="section" id="profil">
            <h2>Profil &amp; Visi Misi</h2>
            <p class="deskripsi">
                Sweet Ice Cream adalah usaha di bidang makanan dan minuman (F&amp;B)
                yang berfokus pada es krim dan gelato. Kami membuat setiap varian
                dari bahan berkualitas agar rasanya lembut, segar, dan manis di setiap cup.
            </p>
            <div class="visimisi">
                <div class="card">
                    <h3>Visi</h3>
                    <ul>
                        <li>Menjadi toko es krim favorit keluarga di Indonesia.</li>
                        <li>Menghadirkan rasa manis yang berkualitas untuk semua orang.</li>
                    </ul>
                </div>
                <div class="card">
                    <h3>Misi</h3>
                    <ul>
                        <li>Menggunakan bahan baku pilihan yang segar.</li>
                        <li>Menyediakan banyak varian rasa dengan harga terjangkau.</li>
                        <li>Memberikan pelayanan yang ramah dan cepat.</li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- PRODUK & HARGA -->
        <section class="section" id="produk">
            <h2>Produk &amp; Harga</h2>
            <div class="grid">
                <?php foreach ($produk as $p) { ?>
                    <div class="card produk-card">
                        <span class="badge-star">⭐ Produk Unggulan</span>
                         <img src="<?php echo $p["images"]; ?>" alt="<?php echo $p["nama"]; ?>" class="produk-img" style="width:100%; height:180px; object-fit:cover; border-radius:18px;">
                        <h3><?php echo $p["nama"]; ?></h3>
                        <p class="harga">Rp<?php echo number_format($p["harga"], 0, ",", "."); ?> / cup</p>
                    </div>
                <?php } ?>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($produk as $p) {
                        echo "<tr>";
                        echo "<td>" . $no . "</td>";
                        echo "<td>" . $p["nama"] . "</td>";
                        echo "<td>Rp" . number_format($p["harga"], 0, ",", ".") . " per cup</td>";
                        echo "</tr>";
                        $no++;
                    }
                    ?>
                </tbody>
            </table>
        </section>

        <!-- FORM PEMESANAN -->
        <section class="section" id="pesan">
            <h2>Pesan Sekarang</h2>
            <div class="order-wrap">
                <form method="POST" action="index.php#pesan" class="form">
                    <label for="nama">Nama Pelanggan</label>
                    <input type="text" id="nama" name="nama" placeholder="Masukkan nama Anda" required>

                    <label for="rasa">Pilih Varian Es Krim</label>
                    <select id="rasa" name="rasa" required>
                        <?php foreach ($produk as $p) { ?>
                            <option value="<?php echo $p["nama"]; ?>"><?php echo $p["nama"]; ?></option>
                        <?php } ?>
                    </select>

                    <label for="jumlah">Jumlah Cup</label>
                    <input type="number" id="jumlah" name="jumlah" min="1" value="1" required>

                    <button type="submit" class="btn btn-terracotta">Pesan</button>
                    <p class="promo">Promo: diskon 10% untuk total belanja minimal Rp50.000!</p>
                </form>

                <div class="hasil">
                    <?php
                    if ($hasil != "") {
                        echo $hasil;
                    } else {
                        echo "<p class='kosong'>Struk pembayaran akan tampil di sini setelah Anda memesan.</p>";
                    }
                    ?>
                </div>
            </div>
        </section>
    </main>

    <!-- FOOTER -->
    <footer class="footer">
        <p>Jumlah pengunjung halaman: <b><?php echo $jumlah; ?></b></p>
        <p>&copy; <?php echo date("Y"); ?> Sweet Ice Cream. All rights reserved.</p>
    </footer>

</body>
</html>
