<?php
include('../includes/db.php');  // Memasukkan koneksi database

// Menyimpan saran
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $saran = $_POST['saran'];

    $sql = "INSERT INTO saran (nama, saran) VALUES ('$nama', '$saran')";
    if ($conn->query($sql) === TRUE) {
        echo "<p style='color: green;'>Saran berhasil ditambahkan!</p>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Menampilkan saran
$sql = "SELECT * FROM saran ORDER BY tanggal DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kotak Saran OSIS</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h1>Kotak Saran OSIS</h1>

    <!-- Form untuk menambah saran -->
    <form action="index.php" method="POST">
      <div class="form-group">
        <input type="text" name="nama" placeholder="Nama" required>
      </div>
      <div class="form-group">
        <textarea name="saran" rows="4" placeholder="Tulis saran Anda..." required></textarea>
      </div>
      <div class="form-group">
        <input type="submit" value="Kirim Saran">
      </div>
    </form>

    <!-- Menampilkan saran yang sudah ada -->
    <h2>Saran yang Masuk</h2>
    <?php while($row = $result->fetch_assoc()) { ?>
      <div class="saran">
        <p><strong><?php echo $row['nama']; ?></strong> (<?php echo $row['tanggal']; ?>)</p>
        <p><?php echo nl2br($row['saran']); ?></p>
      </div>
    <?php } ?>
  </div>
</body>
</html>
