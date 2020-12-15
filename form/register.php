<?php
  require 'functions.php';

if (isset($_POST["register"])) {
  if ( register($_POST ) > 0) {
      echo "<script>
              alert('User Berhasil Ditambahkan');
            </script>";
  } else {
      echo mysqli_error($conn);
  }
}





?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>register</title>
    <link rel="stylesheet" href="auth.css">
  </head>
  <body>


  <div class="container">
    <h1>Register</h1>
    <form class="form" action="" method="post">
      <input type="text" name="username" class="username" placeholder="Username" autocomplete="off"></input>
      <input type="password" name="password" class="password" placeholder="Password"></input>
      <input type="password" name="password2" class="password" placeholder="Konfirmasi"></input>
      <input type="submit" name="register" value ="Register" class="login"></input>
    </form>

    <div class="keRegister">
      <a href="login.php">Log In</a>
    </div>
  </div>



  <script src="app.js"></script>
  </body>
</html>
