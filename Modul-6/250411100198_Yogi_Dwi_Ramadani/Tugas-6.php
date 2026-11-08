# Praktikum PAW Modul 6 - Pengelolaan Master Detil Data

Aplikasi web sederhana (PHP + MySQL) untuk mengelola data **master-detail** pada transaksi penjualan. Tabel `transaksi` sebagai master dan tabel `transaksi_detail` sebagai detail.

## Fitur

1. **Database `penjualan`** dengan 7 tabel dan relasi foreign key (data master minimal 5, data transaksi 10).
2. **Halaman master-detail transaksi.** Pilih transaksi di dropdown lalu klik **Load**, data detailnya ikut berubah. Pada form tambah barang, barang yang sudah ada di detail tidak muncul lagi di dropdown, jadi barang yang sama tidak bisa diinput dua kali dalam satu transaksi.
3. **Hapus barang dengan pengecekan.** Barang yang sudah dipakai di `transaksi_detail` tidak bisa dihapus dan muncul notifikasi.
4. **Total transaksi otomatis.** Setiap detail baru disimpan, kolom `total` pada tabel `transaksi` dihitung ulang dari jumlah `harga x qty`.

## Struktur Folder

```
praktikum6/
├── database.sql        # struktur tabel + data contoh
├── koneksi.php         # koneksi ke MySQL
├── index.php           # menu awal
├── transaksi.php       # halaman master-detail
├── barang.php          # data barang
├── hapus_barang.php    # hapus barang dengan pengecekan
└── screenshots/
```

## Cara Menjalankan

1. Install [XAMPP](https://www.apachefriends.org/), lalu nyalakan **Apache** dan **MySQL**.
2. Letakkan folder `praktikum6` di `C:\xampp\htdocs\`.
3. Buka `http://localhost/phpmyadmin`, pilih tab **Import**, lalu import file `database.sql` (database `penjualan` terbuat otomatis).
4. Buka `http://localhost/praktikum6/` di browser.

> Koneksi di `koneksi.php` memakai user `root` tanpa password (default XAMPP). Sesuaikan kalau MySQL kamu memakai password.

## Struktur Database

| Tabel | Keterangan |
|---|---|
| `supplier` | data pemasok barang |
| `pelanggan` | data pelanggan |
| `user` | data pengguna aplikasi |
| `barang` | data barang, `supplier_id` mengacu ke `supplier` |
| `transaksi` | **master**, `pelanggan_id` mengacu ke `pelanggan` |
| `transaksi_detail` | **detail**, primary key `(transaksi_id, barang_id)`, mengacu ke `transaksi` dan `barang` |
| `pembayaran` | pembayaran, `transaksi_id` mengacu ke `transaksi` |

## Screenshot

**Menu awal**

![Menu](screenshots/menu.png)

**Master-detail (pilih transaksi lalu klik Load)**

![Master Detail](screenshots/master-detail.png)

**Dropdown barang (barang yang sudah dipakai tidak muncul)**

![Dropdown](screenshots/dropdown-barang.png)

**Hapus barang yang sudah dipakai (ditolak)**

![Hapus gagal](screenshots/hapus-gagal.png)

**Hapus barang yang belum dipakai (berhasil)**

![Hapus berhasil](screenshots/hapus-berhasil.png)

**Total transaksi sebelum dan sesudah menambah detail**

![Sebelum](screenshots/total-sebelum.png)
![Sesudah](screenshots/total-sesudah.png)

## Kode Program

### `database.sql`

```sql
DROP DATABASE IF EXISTS penjualan;
CREATE DATABASE IF NOT EXISTS penjualan;
USE penjualan;

CREATE TABLE supplier (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100),
  telp VARCHAR(12),
  alamat TEXT
);

CREATE TABLE pelanggan (
  id VARCHAR(20) PRIMARY KEY,
  nama VARCHAR(100),
  jenis_kelamin ENUM('L','P'),
  telp VARCHAR(12),
  alamat TEXT
);

CREATE TABLE user (
  id_user TINYINT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(30),
  password VARCHAR(35),
  nama VARCHAR(50),
  alamat VARCHAR(150),
  hp VARCHAR(20),
  level TINYINT(1)
);

CREATE TABLE barang (
  id INT AUTO_INCREMENT PRIMARY KEY,
  kode_barang VARCHAR(10),
  nama_barang VARCHAR(100),
  harga INT,
  stok INT,
  supplier_id INT,
  FOREIGN KEY (supplier_id) REFERENCES supplier(id)
);

CREATE TABLE transaksi (
  id INT AUTO_INCREMENT PRIMARY KEY,
  waktu_transaksi DATE,
  keterangan TEXT,
  total INT DEFAULT 0,
  pelanggan_id VARCHAR(20),
  FOREIGN KEY (pelanggan_id) REFERENCES pelanggan(id)
);

CREATE TABLE transaksi_detail (
  transaksi_id INT,
  barang_id INT,
  harga INT,
  qty INT,
  PRIMARY KEY (transaksi_id, barang_id),
  FOREIGN KEY (transaksi_id) REFERENCES transaksi(id) ON DELETE CASCADE,
  FOREIGN KEY (barang_id) REFERENCES barang(id) ON DELETE RESTRICT
);

CREATE TABLE pembayaran (
  id INT AUTO_INCREMENT PRIMARY KEY,
  waktu_bayar DATETIME,
  total INT,
  metode ENUM('TUNAI','TRANSFER','EDC'),
  transaksi_id INT,
  FOREIGN KEY (transaksi_id) REFERENCES transaksi(id)
);

-- ===== DATA =====
INSERT INTO supplier (nama, telp, alamat) VALUES
('PT Sumber Pangan', '031111111', 'Surabaya'),
('CV Tani Makmur', '031222222', 'Sidoarjo'),
('PT Indo Mie', '031333333', 'Gresik'),
('UD Kopi Jaya', '031444444', 'Malang'),
('PT Bersih Sejahtera', '031555555', 'Mojokerto');

INSERT INTO pelanggan (id, nama, jenis_kelamin, telp, alamat) VALUES
('P001', 'Budi Santoso', 'L', '081111111', 'Bangkalan'),
('P002', 'Siti Aminah', 'P', '081222222', 'Surabaya'),
('P003', 'Agus Pratama', 'L', '081333333', 'Sidoarjo'),
('P004', 'Dewi Lestari', 'P', '081444444', 'Gresik'),
('P005', 'Rudi Hartono', 'L', '081555555', 'Madura');

INSERT INTO user (username, password, nama, alamat, hp, level) VALUES
('admin', MD5('admin123'), 'Administrator', 'Surabaya', '082111111', 1),
('kasir1', MD5('kasir123'), 'Kasir Satu', 'Bangkalan', '082222222', 2),
('kasir2', MD5('kasir123'), 'Kasir Dua', 'Sidoarjo', '082333333', 2),
('gudang1', MD5('gudang123'), 'Staf Gudang', 'Gresik', '082444444', 3),
('owner', MD5('owner123'), 'Pemilik Toko', 'Surabaya', '082555555', 1);

INSERT INTO barang (kode_barang, nama_barang, harga, stok, supplier_id) VALUES
('BRG001', 'Beras 5kg', 65000, 50, 1),
('BRG002', 'Minyak Goreng 2L', 38000, 40, 1),
('BRG003', 'Gula Pasir 1kg', 17000, 60, 2),
('BRG004', 'Telur 1kg', 28000, 30, 2),
('BRG005', 'Mie Instan', 3500, 200, 3),
('BRG006', 'Kopi Sachet', 1500, 300, 4),
('BRG007', 'Sabun Mandi', 4500, 100, 5);

INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id) VALUES
('2026-10-01', 'Belanja bulanan', 0, 'P001'),
('2026-10-02', 'Belanja harian', 0, 'P002'),
('2026-10-03', 'Beli telur', 0, 'P003'),
('2026-10-05', 'Belanja bulanan', 0, 'P004'),
('2026-10-06', 'Belanja harian', 0, 'P005'),
('2026-10-08', 'Beli mie', 0, 'P001'),
('2026-10-10', 'Belanja mingguan', 0, 'P002'),
('2026-10-12', 'Beli gula', 0, 'P003'),
('2026-10-15', 'Belanja mingguan', 0, 'P004'),
('2026-10-18', 'Beli beras', 0, 'P005');

INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES
(1,1,65000,1),(1,2,38000,2),
(2,3,17000,2),(2,5,3500,10),
(3,4,28000,1),
(4,1,65000,2),(4,3,17000,1),(4,5,3500,5),
(5,2,38000,1),(5,4,28000,2),
(6,5,3500,20),
(7,1,65000,1),(7,4,28000,1),(7,2,38000,1),
(8,3,17000,5),
(9,2,38000,3),(9,5,3500,4),
(10,1,65000,3);

-- total transaksi dihitung dari detail
UPDATE transaksi t SET total = (SELECT SUM(harga*qty) FROM transaksi_detail d WHERE d.transaksi_id = t.id);

INSERT INTO pembayaran (waktu_bayar, total, metode, transaksi_id) VALUES
('2026-10-01 10:00:00', 141000, 'TUNAI', 1),
('2026-10-02 11:30:00', 69000, 'TRANSFER', 2),
('2026-10-03 09:15:00', 28000, 'TUNAI', 3),
('2026-10-05 14:00:00', 164500, 'EDC', 4),
('2026-10-06 16:45:00', 94000, 'TUNAI', 5);
```

### `koneksi.php`

```php
<?php
$koneksi = mysqli_connect("localhost", "root", "", "penjualan");

if (mysqli_connect_error()) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
```

### `index.php`

```php
<!DOCTYPE html>
<html>
<head>
    <title>Praktikum 6 - Master Detail</title>
</head>
<body>
    <h1>Praktikum PAW Modul 6</h1>
    <h3>Pengelolaan Master Detil Data</h3>
    <ul>
        <li><a href="transaksi.php">Master-Detail Transaksi</a></li>
        <li><a href="barang.php">Data Barang (hapus dengan pengecekan)</a></li>
    </ul>
</body>
</html>
```

### `transaksi.php`

```php
<?php
include "koneksi.php";

// id transaksi (master) yang dipilih, kalau belum ada ambil transaksi pertama
if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
} else {
    $q_awal = mysqli_query($koneksi, "SELECT MIN(id) AS id FROM transaksi");
    $awal = mysqli_fetch_assoc($q_awal);
    $id = (int) $awal['id'];
}

$pesan = "";

// ===== proses simpan detail =====
if (isset($_POST['simpan'])) {
    $barang_id = (int) $_POST['barang_id'];
    $qty = (int) $_POST['qty'];

    // cek lagi di sisi server, barang tidak boleh dobel
    $cek = mysqli_query($koneksi, "SELECT * FROM transaksi_detail
                                   WHERE transaksi_id = $id AND barang_id = $barang_id");

    if ($qty <= 0) {
        $pesan = "Qty harus lebih dari 0!";
    } elseif (mysqli_num_rows($cek) > 0) {
        $pesan = "Barang sudah ada di transaksi ini!";
    } else {
        // harga diambil dari tabel barang
        $q_barang = mysqli_query($koneksi, "SELECT harga FROM barang WHERE id = $barang_id");
        $barang = mysqli_fetch_assoc($q_barang);
        $harga = $barang['harga'];

        // simpan detail
        mysqli_query($koneksi, "INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty)
                                VALUES ($id, $barang_id, $harga, $qty)");

        // hitung ulang total transaksi lalu simpan ke tabel transaksi
        mysqli_query($koneksi, "UPDATE transaksi SET total =
                                (SELECT SUM(harga * qty) FROM transaksi_detail WHERE transaksi_id = $id)
                                WHERE id = $id");

        $pesan = "Detail berhasil disimpan, total diperbarui.";
    }
}

// data master yang dipilih
$q_master = mysqli_query($koneksi, "SELECT t.*, p.nama FROM transaksi t
                                    LEFT JOIN pelanggan p ON t.pelanggan_id = p.id
                                    WHERE t.id = $id");
$master = mysqli_fetch_assoc($q_master);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Master Detail Transaksi</title>
</head>
<body>
    <h1>Master Detail Transaksi</h1>
    <p><a href="index.php">Menu</a> | <a href="barang.php">Data Barang</a></p>

    <!-- PILIH MASTER (tombol Load) -->
    <form method="get" action="transaksi.php">
        Pilih Transaksi:
        <select name="id">
            <?php
            $q_list = mysqli_query($koneksi, "SELECT t.id, t.waktu_transaksi, p.nama FROM transaksi t
                                              LEFT JOIN pelanggan p ON t.pelanggan_id = p.id
                                              ORDER BY t.id");
            while ($r = mysqli_fetch_assoc($q_list)) {
                $pilih = ($r['id'] == $id) ? "selected" : "";
                echo "<option value='" . $r['id'] . "' $pilih>" . $r['id'] . " - " . $r['waktu_transaksi'] . " - " . $r['nama'] . "</option>";
            }
            ?>
        </select>
        <input type="submit" value="Load">
    </form>

    <?php if ($pesan != "") { echo "<p><b>$pesan</b></p>"; } ?>

    <!-- MASTER -->
    <h3>Data Transaksi (Master)</h3>
    <table border="1" cellpadding="5">
        <tr><td>ID Transaksi</td><td><?php echo $master['id']; ?></td></tr>
        <tr><td>Tanggal</td><td><?php echo $master['waktu_transaksi']; ?></td></tr>
        <tr><td>Pelanggan</td><td><?php echo $master['nama']; ?></td></tr>
        <tr><td>Keterangan</td><td><?php echo $master['keterangan']; ?></td></tr>
        <tr><td>Total</td><td><?php echo number_format($master['total']); ?></td></tr>
    </table>

    <!-- DETAIL -->
    <h3>Detail Barang</h3>
    <table border="1" cellpadding="5">
        <tr>
            <th>No</th>
            <th>Barang</th>
            <th>Harga</th>
            <th>Qty</th>
            <th>Subtotal</th>
        </tr>
        <?php
        $q_detail = mysqli_query($koneksi, "SELECT d.*, b.nama_barang FROM transaksi_detail d
                                            INNER JOIN barang b ON d.barang_id = b.id
                                            WHERE d.transaksi_id = $id");
        $no = 1;
        while ($row = mysqli_fetch_assoc($q_detail)) {
            echo "<tr>";
            echo "<td>" . $no++ . "</td>";
            echo "<td>" . $row['nama_barang'] . "</td>";
            echo "<td>" . number_format($row['harga']) . "</td>";
            echo "<td>" . $row['qty'] . "</td>";
            echo "<td>" . number_format($row['harga'] * $row['qty']) . "</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <!-- FORM INPUT DETAIL -->
    <h3>Tambah Barang</h3>
    <form method="post" action="transaksi.php?id=<?php echo $id; ?>">
        Barang:
        <select name="barang_id">
            <?php
            // hanya barang yang belum ada di detail transaksi ini
            $q_pilih = mysqli_query($koneksi, "SELECT * FROM barang
                                               WHERE id NOT IN
                                               (SELECT barang_id FROM transaksi_detail WHERE transaksi_id = $id)");
            while ($b = mysqli_fetch_assoc($q_pilih)) {
                echo "<option value='" . $b['id'] . "'>" . $b['nama_barang'] . " - Rp " . number_format($b['harga']) . "</option>";
            }
            ?>
        </select>
        Qty: <input type="number" name="qty" min="1" value="1">
        <input type="submit" name="simpan" value="Simpan">
    </form>
</body>
</html>
```

### `barang.php`

```php
<?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Barang</title>
</head>
<body>
    <h1>Data Barang</h1>
    <p><a href="index.php">Menu</a> | <a href="transaksi.php">Master-Detail Transaksi</a></p>

    <?php
    if (isset($_GET['pesan'])) {
        echo "<p><b>" . htmlspecialchars($_GET['pesan']) . "</b></p>";
    }
    ?>

    <table border="1" cellpadding="5">
        <tr>
            <th>ID</th>
            <th>Kode</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
        <?php
        $result = mysqli_query($koneksi, "SELECT * FROM barang");
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['kode_barang'] . "</td>";
            echo "<td>" . $row['nama_barang'] . "</td>";
            echo "<td>" . number_format($row['harga']) . "</td>";
            echo "<td>" . $row['stok'] . "</td>";
            echo "<td><a href='hapus_barang.php?id=" . $row['id'] . "' onclick=\"return confirm('Yakin hapus?')\">Hapus</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
```

### `hapus_barang.php`

```php
<?php
include "koneksi.php";

$id = (int) $_GET['id'];

// cek dulu apakah barang sudah dipakai di transaksi_detail
$cek = mysqli_query($koneksi, "SELECT * FROM transaksi_detail WHERE barang_id = $id");

if (mysqli_num_rows($cek) > 0) {
    $pesan = "Barang tidak bisa dihapus karena masih digunakan pada transaksi!";
} else {
    mysqli_query($koneksi, "DELETE FROM barang WHERE id = $id");
    $pesan = "Barang berhasil dihapus.";
}

header("Location: barang.php?pesan=" . urlencode($pesan));
?>
```

## Penjelasan Singkat

- **Master-detail:** `transaksi.php` mengambil data master dengan `LEFT JOIN` ke `pelanggan`, lalu data detail dengan `INNER JOIN` antara `transaksi_detail` dan `barang` berdasarkan `transaksi_id` (foreign key).
- **Dropdown tanpa barang dobel:** query dropdown memakai `WHERE id NOT IN (SELECT barang_id FROM transaksi_detail WHERE transaksi_id = ...)`.
- **Hapus dengan pengecekan:** `hapus_barang.php` mengecek dulu ke `transaksi_detail`, kalau ada datanya maka penghapusan ditolak. Di database, relasi `barang_id` juga memakai `ON DELETE RESTRICT`.
- **Total otomatis:** setelah `INSERT` detail, dijalankan `UPDATE transaksi SET total = (SELECT SUM(harga * qty) ...)`.

## Catatan

Proyek ini dibuat untuk keperluan praktikum. Password pada tabel `user` memakai `MD5` hanya sebagai data contoh dan tidak untuk dipakai di aplikasi sebenarnya.
