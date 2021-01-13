<?php
include_once('connection.php');

$npm = addslashes(htmlentities($_POST['npm']));
$getdata = mysqli_query($koneksi,"SELECT * FROM mahasiswa WHERE npm = '$npm'");
$rows = mysqli_num_rows($getdata);

$delete = "DELETE FROM mahasiswa WHERE npm = '$npm'";
$exedelete = mysqli_query($koneksi,$delete);

$respose = array();

if($rows > 0){
  if ($exedelete) {
    $respose['code'] = 1;
    $respose['message'] = "Deleted Success";
  }else{
    $respose['code'] = 0;
    $respose['message'] = "Failed to Delete";
  }
}else{
  $respose['code'] = 0;
  $respose['message'] = "Failed to Delete, data Not Found";
}

echo json_encode($respose);
?>