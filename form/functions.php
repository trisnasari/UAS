<?php

//jangan lupa selalu connect ke database terlebih dahulu
$conn = mysqli_connect("localhost","root","","latphp");

//function registrasi
function register($data){

  global $conn;

//pastikan input username huruf kecil dan tanpa karakter space
  $username = strtolower(stripslashes($data["username"]));
//password boleh ada tanda kutip
  $password = mysqli_real_escape_string($conn, $data["password"]);
  $password2 = mysqli_real_escape_string($conn,$data["password2"]);

//cek username di database
  $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");

  if (mysqli_fetch_assoc($result)) {
    echo "<script>
            alert('Username sudah terdaftar');
          </script>";
    return false;
  }

//cek password dengan Konfirmasi password
  if  ($password !== $password2){
    echo "<script>
            alert('Masukan Konfirmasi Password yang Sesuai');
          </script>";
    return false;
  }

//enkripsi password
  $password = password_hash($password, PASSWORD_DEFAULT);

//insert ke database
  mysqli_query($conn, "INSERT INTO users VALUES('','$username','$password')");

//mengembalikan data
  return mysqli_affected_rows($conn);


}

?>
