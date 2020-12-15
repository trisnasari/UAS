 <?php

$conn = mysqli_connect("localhost","root","","latphp");

function query($buku){
  global $conn;

  $result = mysqli_query($conn,$buku);
  $bukub = [];

  while($buku = mysqli_fetch_assoc($result)){
    $bukub[]=$buku;
  }
  return $bukub;
};


function tambah($data){
  global $conn;

    // ambil masukan user
    $judul = htmlspecialchars($data["judul"]);
    $tahun = htmlspecialchars($data["tahun"]);
    $penerbit = htmlspecialchars($data["penerbit"]);
    $halaman = htmlspecialchars($data["halaman"]);

      // upload gambar
    $gambar = upload();
    if (!$gambar){
      return false;
    }


    $query = "INSERT INTO buku
            VALUES
            ('', '$judul', '$tahun', '$penerbit', '$halaman','$gambar')
            ";

    mysqli_query($conn,$query);

    return  mysqli_affected_rows($conn);
};


function upload(){

  $namaFile = $_FILES['gambar']['name'];
  $ukuranFile = $_FILES['gambar']['size'];
  $error = $_FILES['gambar']['error'];
  $tmpName = $_FILES['gambar']['tmp_name'];

  //cek user upload Gambar
  if( $error === 4){
    echo "<script>
            alert('Masukan Gambar!');
          </script>";
    return false;
  }
  //cek yang diupload harus Gambar
  $validasiFile = ['jpg', 'png', 'jpeg'];
  $ekstensiGambar = explode('.', $namaFile);
  $ekstensiGambar = strtolower(end($ekstensiGambar));

  if(!in_array($ekstensiGambar, $validasiFile)){
    echo "<script>
            alert('Yang Anda Masukan Bukan Gambar!');
          </script>";
    return false;
  }
  //ukuran maksimal Gambar
  if ( $ukuranFile > 1000000 ){
    echo "<script>
            alert('Ukuran Gambar Maksimal 1mb!');
          </script>";
    return false;
  }

  //upload
  //generate nama file
  $generateNama = uniqid();
  $generateNama .= '.';
  $generateNama .= $ekstensiGambar;

  //tinggal upload mas broo
  move_uploaded_file($tmpName, 'img/'.$generateNama);
  return $generateNama;

}


function hapus($id){
  global $conn;

  mysqli_query($conn, "DELETE FROM buku WHERE id = $id");

  return mysqli_affected_rows($conn);
}

function ubah($data){
  global $conn;

    $id = $data["id"];
    $judul = htmlspecialchars($data["judul"]);
    $tahun = htmlspecialchars($data["tahun"]);
    $penerbit = htmlspecialchars($data["penerbit"]);
    $halaman = htmlspecialchars($data["halaman"]);
    $gambarLama = $data["gambarLama"];

    // user upload gambar atau tidak
    if($_FILES["gambar"]["error"] === 4 ){
      $gambar = $gambarLama;
    }else {
      $gambar=upload();
    }



    $query = "UPDATE buku SET
                judul = '$judul',
                tahun = '$tahun',
                penerbit = '$penerbit',
                halaman = '$halaman',
                gambar = '$gambar'
              WHERE id = $id;
              ";

    mysqli_query($conn,$query);

    return  mysqli_affected_rows($conn);
};

function cari($keyword){
  $query = " SELECT * FROM buku WHERE
              judul  LIKE '%$keyword%' OR
              tahun  LIKE '%$keyword%' OR
              penerbit LIKE '%$keyword%' OR
              halaman  LIKE '%$keyword%'
              ";

   return query($query);
}

?>
