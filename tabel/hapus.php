<?php
session_start();

if (!$_SESSION["login"]) {
	header("Location: ../form/login.php");
}
require 'function_php3.php';

$id = $_GET["id"];

if (hapus($id) > 0) {
	echo "
        <script>
          alert('Data Berhasil Dihapus');
          document.location.href = 'index.php';
        </script>
        ";
} else {
	echo "
    <script>
      alert('Data Gagal Dihapus');
      document.location.href = 'index.php';
    </script>
    ";
}
?>
