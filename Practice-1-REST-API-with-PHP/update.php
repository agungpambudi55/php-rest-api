<?php
require_once('connection.php');

$npm = addslashes(htmlentities($_POST['npm']));
$nama = addslashes(htmlentities($_POST['nama']));
$prodi = addslashes(htmlentities($_POST['prodi']));
$fakultas = addslashes(htmlentities($_POST['fakultas']));
$getdata = mysqli_query($koneksi,"SELECT * FROM mahasiswa WHERE npm='$npm'");
$rows = mysqli_num_rows($getdata);

$update = "UPDATE mahasiswa SET nama='$nama',prodi='$prodi',fakultas='$fakultas' WHERE npm='$npm'";
$exequery = mysqli_query($koneksi,$update);
$respose = array();

if($rows > 0) {
  if($exequery) {
    $respose['code'] = 1;
    $respose['message'] = "Updated Success";
  }else{
    $respose['code'] = 0;
    $respose['message'] = "Updated Failed";
  }
}else{
  $respose['code'] = 0;
  $respose['message'] = "Updated Failed, Not data selected";
}
echo json_encode($respose);
?>