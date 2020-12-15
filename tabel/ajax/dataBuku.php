<?php
sleep(1);
require '../function_php3.php';

$keyword = $_GET["keyword"];
$query = " SELECT * FROM buku WHERE
            judul  LIKE '%$keyword%' OR
            tahun  LIKE '%$keyword%' OR
            penerbit LIKE '%$keyword%' OR
            halaman  LIKE '%$keyword%'
            ";
$buku = query($query);

?>



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
      <?php $i = 1 ?>
      <?php foreach ($buku as $bk): ?>
      <tr>
        <td><?= $i ?></td>
        <td><?= $bk["judul"] ?></td>
        <td><?= $bk["tahun"] ?></td>
        <td><?=  $bk["penerbit"] ?></td>
        <td><?= $bk["halaman"] ?></td>
        <td> <img src='img/<?= $bk["gambar"]?>' height="100px"></td>
        <td> <a href="ubah.php?id=<?=$bk["id"]?>">Ubah</a> |
            <a href="hapus.php?id=<?= $bk["id"] ?>" onclick= "return confirm ('Apakah anda yakin menghapus data tersebut?')">Hapus</a> </td>
      </tr>
      <?php $i++ ?>
    <?php endforeach; ?>
    </table>
