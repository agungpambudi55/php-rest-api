<?php
include_once('connection.php');

$query = "SELECT * FROM mahasiswa";
$result = mysqli_query($connection,$query);
$array_data = array();

while($baris = mysqli_fetch_assoc($result)) {
  $array_data[]=$baris;
}

echo json_encode($array_data);
?>