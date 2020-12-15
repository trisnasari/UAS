<?php

session_start();
require 'functions.php';

if (isset($_COOKIE['id']) &&
	isset($_COOKIE['key'])) {

	$id = $_COOKIE['id'];
	$key = $_COOKIE['key'];

//umbil username berdasarkan id
	$result = mysqli_query($conn, "SELECT username FROM users WHERE id = $id");

	$row = mysqli_fetch_assoc($result);

//cek cookie dengan username
	if ($key === hash('sha256', $row['username'])) {
		$_SESSION['login'] = true;
	}
}

if (isset($_SESSION["login"])) {
	header("Location: ../tabel/index.php");
	exit;
}

if (isset($_POST["login"])) {

	$username = $_POST["username"];
	$password = $_POST["password"];

//cek username di database
	$result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

//cek Username
	if (mysqli_num_rows($result) === 1) {

// cek password
		$row = mysqli_fetch_assoc($result);

//mengembalikan password yang terenkripsi
		if (password_verify($password, $row["password"])) {
//set session
			$_SESSION["login"] = true;

//cek checkbox remember\
			if (isset($_POST['remember'])) {

// buat cookie
				setcookie('id', $row['id'], time() + 3600);
				setcookie('key', hash('sha256', $row['username']), time() + 3600);
//ambil Username
			}
//redirect jika benar
			header("Location: ../tabel/index.php");
			exit;
		}
	}
	$error = true;
}

?>


 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Login</title>
     <link rel="stylesheet" href="auth.css">
   </head>
   <body>


   <div class="container">
     <h1>Log In</h1>
     <form class="form" action="" method="post">
       <input type="text" name="username" class="username" placeholder="Username" autocomplete="off"></input>
       <input type="password" name="password" class="password" placeholder="Password"></input>
       <div class="remember">
         <input type="checkbox" name="remember" id="remember" ><label for="remember">Remember Me?</label>
       </div>
       <input type="submit" name="login" value ="Login" class="login"></input>

     </form>

     <?php if (isset($error)): ?>
       <div class="salah">
         <p>Password atau Username Salah</p>
         <div class="tutup">x</div>
       </div>
     <?php endif;?>

     <div class="keRegister">
       <a href="register.php">Registrasi</a>
     </div>

   </div>



   <script src="app.js"></script>
   </body>
 </html>
