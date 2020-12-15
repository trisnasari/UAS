<?php

session_start();

if (!$_SESSION["login"]) {
	header("Location: ../form/login.php");
}
require 'function_php3.php';

$buku = query("SELECT * FROM buku");

if (isset($_POST["cari"])) {
	$buku = cari($_POST["keyword"]);
}
;
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>lat database</title>
    <style media="screen">
      .loader{
        width: 180px;
        position: absolute;
        z-index: -1;
        top: 95px;
        left: 240px;
        display: none;
      }

    </style>
  </head>
  <body>

    <h1>Daftar Buku</h1>
    <br><br>

    <form  action="" method="post">
      <input type="text" name="keyword" size="35" autofocus placeholder="Masukan sesuatu..." autocomplete="off" id="keyword">
      <img src="img/loadergif.gif" class="loader">
    </form>

    <br><br>
    <div class="container">

    <table border="1" cellpadding="10" cellspacing="0">
      <tr>
        <th>No.</th>
        <th>Judul</th>
        <th>Tahun</th>
        <th>Penerbit</th>
        <th>Halaman</th>
        <th>Gambar</th>
        <th>Edit</th>
      </tr>
      <?php $i = 1?>
      <?php foreach ($buku as $bk): ?>
      <tr>
        <td><?=$i?></td>
        <td><?=$bk["judul"]?></td>
        <td><?=$bk["tahun"]?></td>
        <td><?=$bk["penerbit"]?></td>
        <td><?=$bk["halaman"]?></td>
        <td> <img src='img/<?=$bk["gambar"]?>' height="100px"></td>
        <td> <a href="ubah.php?id=<?=$bk["id"]?>">Ubah</a> |
            <a href="hapus.php?id=<?=$bk["id"]?>" onclick= "return confirm ('Apakah anda yakin menghapus data tersebut?')">Hapus</a> </td>
      </tr>
      <?php $i++?>
    <?php endforeach;?>
    </table>
  </div>

    <br>
    <p><a href="tambahData.php">Tambah Data</a> </p>
    <br><br>
    <p><a href="../form/logout.php">logout</a> </p>
<?php ?>



  <script src="ajax/jquery.js" charset="utf-8"></script>
  <script src="ajax/ajaxJquery.js" charset="utf-8"></script>
  </body>
</html>
