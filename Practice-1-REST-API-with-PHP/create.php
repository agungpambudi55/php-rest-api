<?php
include_once('connection.php');

$npm = addslashes(htmlentities($_POST['npm']));
$nama = addslashes(htmlentities($_POST['nama']));
$prodi = addslashes(htmlentities($_POST['prodi']));
$fakultas = addslashes(htmlentities($_POST['fakultas']));
$insert = "INSERT INTO mahasiswa(npm,nama,prodi,fakultas) VALUES ('$npm','$nama','$prodi','$fakultas')";
$exeinsert = mysqli_query($koneksi,$insert);
$response = array();

if($exeinsert){
    $response['code'] = 1;
    $response['message'] = "Success! Data Inserted";
}else{
    $response['code'] = 0;
    $response['message'] = "Failed! Data Not Inserted";
}

echo json_encode($response);
?>