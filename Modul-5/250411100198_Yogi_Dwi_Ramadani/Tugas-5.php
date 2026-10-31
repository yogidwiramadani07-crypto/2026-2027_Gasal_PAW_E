-- =====================================================
-- MODULE 5 : DATABASE - Tugas Praktikum
-- Database: penjualan
-- =====================================================
DROP DATABASE IF EXISTS penjualan;
CREATE DATABASE penjualan CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE penjualan;

-- ---------- 1. SKEMA ----------
CREATE TABLE pelanggan (
  id            VARCHAR(20)  NOT NULL,
  nama          VARCHAR(100) NOT NULL,
  jenis_kelamin ENUM('L','P') NOT NULL,
  telp          VARCHAR(12)  NOT NULL,
  alamat        TEXT         NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB;

CREATE TABLE supplier (
  id     INT(11)      NOT NULL AUTO_INCREMENT,
  nama   VARCHAR(100) NOT NULL,
  telp   VARCHAR(12)  NOT NULL,
  alamat TEXT         NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB;

CREATE TABLE barang (
  id          INT(11)      NOT NULL AUTO_INCREMENT,
  kode_barang VARCHAR(10)  NOT NULL,
  nama_barang VARCHAR(100) NOT NULL,
  harga       INT(11)      NOT NULL,
  stok        INT(11)      NOT NULL,
  supplier_id INT(11)      DEFAULT NULL,
  PRIMARY KEY (id),
  KEY supplier_id (supplier_id),
  CONSTRAINT fk_barang_supplier FOREIGN KEY (supplier_id)
    REFERENCES supplier (id) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE transaksi (
  id               INT(11)     NOT NULL AUTO_INCREMENT,
  waktu_transaksi  DATE        NOT NULL,
  keterangan       TEXT,
  total            INT(11)     NOT NULL,
  pelanggan_id     VARCHAR(20) NOT NULL,
  PRIMARY KEY (id),
  KEY pelanggan_id (pelanggan_id),
  CONSTRAINT fk_transaksi_pelanggan FOREIGN KEY (pelanggan_id)
    REFERENCES pelanggan (id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE transaksi_detail (
  transaksi_id INT(11) NOT NULL,
  barang_id    INT(11) NOT NULL,
  harga        INT(11) NOT NULL,
  qty          INT(11) NOT NULL,
  PRIMARY KEY (transaksi_id, barang_id),
  KEY barang_id (barang_id),
  CONSTRAINT fk_detail_transaksi FOREIGN KEY (transaksi_id)
    REFERENCES transaksi (id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT fk_detail_barang FOREIGN KEY (barang_id)
    REFERENCES barang (id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE pembayaran (
  id           INT(11)  NOT NULL AUTO_INCREMENT,
  waktu_bayar  DATETIME NOT NULL,
  total        INT(11)  NOT NULL,
  metode       ENUM('TUNAI','TRANSFER','EDC') NOT NULL,
  transaksi_id INT(11)  NOT NULL,
  PRIMARY KEY (id),
  KEY transaksi_id (transaksi_id),
  CONSTRAINT fk_pembayaran_transaksi FOREIGN KEY (transaksi_id)
    REFERENCES transaksi (id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE user (
  id_user  TINYINT(2)   NOT NULL AUTO_INCREMENT,
  username VARCHAR(30)  NOT NULL,
  password VARCHAR(35)  NOT NULL,
  nama     VARCHAR(50)  NOT NULL,
  alamat   VARCHAR(150) NOT NULL,
  hp       VARCHAR(20)  NOT NULL,
  level    TINYINT(1)   NOT NULL COMMENT '1=admin, 2=kasir',
  PRIMARY KEY (id_user)
) ENGINE=InnoDB;

-- ---------- 2. DATA (minimal 10 per tabel) ----------
INSERT INTO supplier (nama, telp, alamat) VALUES
('PT. Maju Bersama',  '08123456',     'Surabaya'),
('PT. Senang Sekali', '081515563',    'Bangkalan'),
('PT. Segar Segar',   '0845454663',   'Surabaya'),
('CV. Sumber Rejeki', '031555001',    'Sidoarjo'),
('PT. Mitra Jaya',    '081330012345', 'Gresik'),
('UD. Berkah Abadi',  '082233445566', 'Malang'),
('PT. Sentosa Makmur','031777888',    'Surabaya'),
('CV. Karya Mandiri', '085612345678', 'Mojokerto'),
('PT. Global Niaga',  '081998877665', 'Jombang'),
('UD. Tani Makmur',   '087755443322', 'Lamongan');

INSERT INTO barang (kode_barang, nama_barang, harga, stok, supplier_id) VALUES
('BRG001','Beras Premium 5kg', 65000,100,1),
('BRG002','Minyak Goreng 2L',  36000, 80,2),
('BRG003','Gula Pasir 1kg',    16000,120,3),
('BRG004','Telur Ayam 1kg',    28000, 60,4),
('BRG005','Tepung Terigu 1kg', 12000, 90,5),
('BRG006','Kopi Bubuk 200g',   18000, 70,6),
('BRG007','Teh Celup 25s',      9000,150,7),
('BRG008','Susu UHT 1L',       17000,110,8),
('BRG009','Mie Instan',         3500,300,9),
('BRG010','Sabun Mandi',        4500,200,10);

INSERT INTO pelanggan (id, nama, jenis_kelamin, telp, alamat) VALUES
('PLG001','Budi Santoso',  'L','081211110001','Surabaya'),
('PLG002','Siti Aminah',   'P','081211110002','Sidoarjo'),
('PLG003','Ahmad Fauzi',   'L','081211110003','Gresik'),
('PLG004','Dewi Lestari',  'P','081211110004','Malang'),
('PLG005','Rizky Pratama', 'L','081211110005','Surabaya'),
('PLG006','Nur Hidayah',   'P','081211110006','Bangkalan'),
('PLG007','Agus Salim',    'L','081211110007','Mojokerto'),
('PLG008','Rina Wulandari','P','081211110008','Jombang'),
('PLG009','Hendra Gunawan','L','081211110009','Lamongan'),
('PLG010','Putri Ayu',     'P','081211110010','Surabaya');

INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id) VALUES
('2026-10-01','Pembelian bulanan',        130000,'PLG001'),
('2026-10-03','Pembelian minyak goreng',  108000,'PLG002'),
('2026-10-05','Pembelian gula',            80000,'PLG003'),
('2026-10-07','Pembelian telur',           56000,'PLG004'),
('2026-10-09','Pembelian tepung',          48000,'PLG005'),
('2026-10-12','Pembelian kopi',            54000,'PLG006'),
('2026-10-15','Pembelian teh',             54000,'PLG007'),
('2026-10-18','Pembelian susu',            68000,'PLG008'),
('2026-10-21','Pembelian mie instan',      35000,'PLG009'),
('2026-10-25','Pembelian sabun',           36000,'PLG010');

INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES
(1,1,65000, 2),
(2,2,36000, 3),
(3,3,16000, 5),
(4,4,28000, 2),
(5,5,12000, 4),
(6,6,18000, 3),
(7,7, 9000, 6),
(8,8,17000, 4),
(9,9, 3500,10),
(10,10,4500, 8);

INSERT INTO pembayaran (waktu_bayar, total, metode, transaksi_id) VALUES
('2026-10-01 10:15:00',130000,'TUNAI',   1),
('2026-10-03 11:20:00',108000,'TRANSFER',2),
('2026-10-05 09:45:00', 80000,'EDC',     3),
('2026-10-07 14:10:00', 56000,'TUNAI',   4),
('2026-10-09 13:30:00', 48000,'TRANSFER',5),
('2026-10-12 16:05:00', 54000,'EDC',     6),
('2026-10-15 08:50:00', 54000,'TUNAI',   7),
('2026-10-18 15:25:00', 68000,'TRANSFER',8),
('2026-10-21 12:00:00', 35000,'TUNAI',   9),
('2026-10-25 17:40:00', 36000,'EDC',    10);

INSERT INTO user (username, password, nama, alamat, hp, level) VALUES
('admin',  MD5('admin123'),  'Administrator',  'Surabaya',  '081300000001',1),
('kasir1', MD5('kasir123'),  'Kasir Satu',     'Sidoarjo',  '081300000002',2),
('kasir2', MD5('kasir123'),  'Kasir Dua',      'Gresik',    '081300000003',2),
('kasir3', MD5('kasir123'),  'Kasir Tiga',     'Surabaya',  '081300000004',2),
('kasir4', MD5('kasir123'),  'Kasir Empat',    'Malang',    '081300000005',2),
('gudang1',MD5('gudang123'), 'Staf Gudang 1',  'Surabaya',  '081300000006',2),
('gudang2',MD5('gudang123'), 'Staf Gudang 2',  'Bangkalan', '081300000007',2),
('manager',MD5('manager123'),'Manager Toko',   'Surabaya',  '081300000008',1),
('owner',  MD5('owner123'),  'Pemilik Toko',   'Surabaya',  '081300000009',1),
('magang', MD5('magang123'), 'Staf Magang',    'Mojokerto', '081300000010',2);



Didalam Folder Penjualan :

<?php
//edit.php

require "koneksi.php";

$id = (int) ($_GET["id"] ?? $_POST["id"] ?? 0);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama   = trim($_POST["nama"]);
    $telp   = trim($_POST["telp"]);
    $alamat = trim($_POST["alamat"]);

    $stmt = $conn->prepare("UPDATE supplier SET nama = ?, telp = ?, alamat = ? WHERE id = ?");
    $stmt->bind_param("sssi", $nama, $telp, $alamat, $id);
    $stmt->execute();

    header("Location: index.php?pesan=" . urlencode("Data supplier berhasil diperbarui"));
    exit;
}

$stmt = $conn->prepare("SELECT * FROM supplier WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();

if (!$data) {
    header("Location: index.php?pesan=" . urlencode("Data supplier tidak ditemukan"));
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Edit Data Master Supplier</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>
<div class="container">

  <div class="page-header">
    <h3 class="text-primary">Edit Data Master Supplier</h3>
  </div>

  <form method="post" class="form-horizontal">
    <input type="hidden" name="id" value="<?= $data["id"] ?>">
    <div class="form-group">
      <label class="col-sm-2 control-label">Nama</label>
      <div class="col-sm-6"><input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($data["nama"]) ?>" maxlength="100" required></div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">Telp</label>
      <div class="col-sm-4"><input type="text" name="telp" class="form-control" value="<?= htmlspecialchars($data["telp"]) ?>" maxlength="12" required></div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">Alamat</label>
      <div class="col-sm-4"><input type="text" name="alamat" class="form-control" value="<?= htmlspecialchars($data["alamat"]) ?>" required></div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-6">
        <button type="submit" class="btn btn-success">Update</button>
        <a href="index.php" class="btn btn-danger">Batal</a>
      </div>
    </div>
  </form>
</div>
</body>
</html>



<?php
//hapus.php
require "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = (int) ($_POST["id"] ?? 0);

    $stmt = $conn->prepare("DELETE FROM supplier WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    header("Location: index.php?pesan=" . urlencode("Data supplier berhasil dihapus"));
    exit;
}

header("Location: index.php");



//index.php
<?php
require "koneksi.php";
$result = $conn->query("SELECT * FROM supplier ORDER BY id ASC");
$pesan  = $_GET["pesan"] ?? "";
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Data Master Supplier</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>
<div class="container">

  <div class="page-header clearfix">
    <h3 class="text-primary pull-left">Data Master Supplier</h3>
    <a href="tambah.php" class="btn btn-success pull-right" style="margin-top:20px">Tambah Data</a>
  </div>

  <?php if ($pesan): ?>
    <div class="alert alert-info"><?= htmlspecialchars($pesan) ?></div>
  <?php endif; ?>

  <table class="table table-bordered table-hover">
    <thead>
      <tr class="info">
        <th width="50">No</th>
        <th>Nama</th>
        <th>Telp</th>
        <th>Alamat</th>
        <th width="160">Tindakan</th>
      </tr>
    </thead>
    <tbody>
    <?php $no = 1; while ($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= $no++ ?></td>
        <td><?= htmlspecialchars($row["nama"]) ?></td>
        <td><?= htmlspecialchars($row["telp"]) ?></td>
        <td><?= htmlspecialchars($row["alamat"]) ?></td>
        <td>
          <a href="edit.php?id=<?= $row["id"] ?>" class="btn btn-warning btn-xs">Edit</a>
          <form action="hapus.php" method="post" style="display:inline"
                onsubmit="return confirm('Anda yakin akan menghapus supplier ini?');">
            <input type="hidden" name="id" value="<?= $row["id"] ?>">
            <button type="submit" class="btn btn-danger btn-xs">Hapus</button>
          </form>
        </td>
      </tr>
    <?php endwhile; ?>
    </tbody>
  </table>
</div>
</body>
</html>



<?php
//koneksi.php
// Koneksi ke database "penjualan"
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'penjualan';

$conn = new mysqli($host, $user, $pass, $db);
$conn->set_charset('utf8mb4');



//tambah.php
<?php
require "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama   = trim($_POST["nama"]);
    $telp   = trim($_POST["telp"]);
    $alamat = trim($_POST["alamat"]);

    $stmt = $conn->prepare("INSERT INTO supplier (nama, telp, alamat) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nama, $telp, $alamat);
    $stmt->execute();

    header("Location: index.php?pesan=" . urlencode("Data supplier berhasil ditambahkan"));
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Tambah Data Master Supplier</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>
<div class="container">

  <div class="page-header">
    <h3 class="text-primary">Tambah Data Master Supplier Baru</h3>
  </div>

  <form method="post" class="form-horizontal">
    <div class="form-group">
      <label class="col-sm-2 control-label">Nama</label>
      <div class="col-sm-6"><input type="text" name="nama" class="form-control" placeholder="Nama" maxlength="100" required></div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">Telp</label>
      <div class="col-sm-4"><input type="text" name="telp" class="form-control" placeholder="telp" maxlength="12" required></div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">Alamat</label>
      <div class="col-sm-4"><input type="text" name="alamat" class="form-control" placeholder="alamat" required></div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-6">
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="index.php" class="btn btn-danger">Batal</a>
      </div>
    </div>
  </form>
</div>
</body>
</html>
