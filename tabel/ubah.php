<?php
session_start();

if (!$_SESSION["login"]) {
	header("Location: ../form/login.php");
}
require 'function_php3.php';

$id = $_GET["id"];

$bku = query("SELECT * FROM buku WHERE id = $id")[0];

if (isset($_POST["submit"])) {
	if (ubah($_POST) > 0) {
		echo "
        <script>
          alert('Data Berhasil Diubah');
          document.location.href = 'index.php';
        </script>
        ";
	} else {
		echo "
    <script>
      alert('Data Gagal Dihapus');
    </script>
    ";
		echo var_dump($conn);
	}
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <h1>Ubah Data</h1>
    <br>
    <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?=$bku["id"];?>">
      <input type="hidden" name="gambarLama" value="<?=$bku["gambar"];?>">
      <ul>
        <li><label for="judul">Judul:</label>
            <input type="text" name="judul" id="judul" required value="<?=$bku["judul"];?>">
        </li>
        <li><label for="tahun">Tahun:</label>
            <input type="text" name="tahun" id="tahun" required value="<?=$bku["tahun"];?>">
        </li>
        <li><label for="penerbit">Penerbit:</label>
            <input type="text" name="penerbit" id="penerbit" required value="<?=$bku["penerbit"];?>">
        </li>
        <li><label for="halaman">Halaman:</label>
            <input type="text" name="halaman" id="halaman"required value="<?=$bku["halaman"];?>">
        </li>
        <li><label for="gambar">Gambar:</label><br>
              <img src="img/<?=$bku["gambar"]?>" height="100">
             <input type="file" name="gambar" id="gambar">
        </li>
        <button type="submit" name="submit">Ubah</button>
      </ul>


    </form>
    <br><br><br>
    <p><a href="index.php">Kembali</a> </p>
  </body>
</html>
