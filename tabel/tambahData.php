<?php
session_start();

if (!$_SESSION["login"]) {
	header("Location: ../form/login.php");
}

require "function_php3.php";

if (isset($_POST["submit"])) {

	if (tambah($_POST) > 0) {
		echo "
          <script>
            alert('Data Berhasil Ditambahkan');
            document.location.href = 'index.php';
          </script>
          ";
	} else {
		echo "
          <script>
            alert('Data Gagal Ditambahkan');
            document.location.href = 'index.php';
          </script>
          ";
	}
}
;

?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title></title>
   </head>
   <body>
     <h1>Tambah Data</h1>
     <br>
     <form action="" method="post" enctype="multipart/form-data">
       <ul>
         <li><label for="judul">Judul:</label>
             <input type="text" name="judul" id="judul" required>
         </li>
         <li><label for="tahun">Tahun:</label>
             <input type="text" name="tahun" id="tahun" required>
         </li>
         <li><label for="penerbit">Penerbit:</label>
             <input type="text" name="penerbit" id="penerbit" required>
         </li>
         <li><label for="halaman">Halaman:</label>
             <input type="text" name="halaman" id="halaman"required>
         </li>
         <li><label for="gambar">Gambar:</label>
              <input type="file" name="gambar" id="gambar">
         </li>

         <br><br>
         <button type="submit" name="submit">Tambah</button>
       </ul>


     </form>
     <br><br><br>
     <p><a href="../">Kembali</a> </p>
   </body>
 </html>
