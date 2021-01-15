# Membuat RESTful API CRUD sederhana dengan PHP
## Jenis-jenis API
API ada dua jenis yaitu SOAP dan REST, tetapi yang paling populer adalah REST API.

## Menyiapkan Database
- Membuat database

```
CREATE DATABASE practice_crud;
```

- Membuat tabel dan npm sebagai primary key

```
CREATE TABLE `mahasiswa` (
    `npm` varchar(10) NOT NULL,
    `nama` varchar(100) NOT NULL,
    `prodi` varchar(50) NOT NULL,
    `fakultas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `mahasiswa` ADD PRIMARY KEY (`npm`);
```

- Memasukkan data

```
INSERT INTO `mahasiswa` (`npm`, `nama`, `prodi`, `fakultas`) VALUES
('150590', 'Agung Pambudi', 'Teknik Komputer', 'Teknik'),
('150591', 'Dhani', 'Kedokteran', 'Dokter'),
('150592', 'Iwan Setiawan', 'Teknik Otomotif', 'Teknik'),
('150593', 'Indra Ani', 'Sistem Informasi', 'Teknik'),
('150594', 'Ahmad Fauzila', 'Kehutanan', 'Ilmu Kehutanan');
```

- Membuat koneksi ke database

```
<?php
define('HOSTNAME','localhost');
define('USERNAME','root');
define('PASSWORD','');
define('DB_NAME','practice_crud');

$connection = new mysqli(HOSTNAME, USERNAME, PASSWORD, DB_NAME) or die (mysqli_errno());
?>
```

- Membuat create

```
<?php
include_once('connection.php');

$npm = addslashes(htmlentities($_POST['npm']));
$nama = addslashes(htmlentities($_POST['nama']));
$prodi = addslashes(htmlentities($_POST['prodi']));
$fakultas = addslashes(htmlentities($_POST['fakultas']));
$insert = "INSERT INTO mahasiswa(npm,nama,prodi,fakultas) VALUES ('$npm','$nama','$prodi','$fakultas')";
$exeinsert = mysqli_query($connection,$insert);
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
```

- Membuat read

```
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
```

- Membuat update

```
<?php
require_once('connection.php');

$npm = addslashes(htmlentities($_POST['npm']));
$nama = addslashes(htmlentities($_POST['nama']));
$prodi = addslashes(htmlentities($_POST['prodi']));
$fakultas = addslashes(htmlentities($_POST['fakultas']));
$getdata = mysqli_query($koneksi,"SELECT * FROM mahasiswa WHERE npm='$npm'");
$rows = mysqli_num_rows($getdata);

$update = "UPDATE mahasiswa SET nama='$nama',prodi='$prodi',fakultas='$fakultas' WHERE npm='$npm'";
$exequery = mysqli_query($connection,$update);
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
```

- Membuat delete

```
<?php
include_once('connection.php');

$npm = addslashes(htmlentities($_POST['npm']));
$getdata = mysqli_query($koneksi,"SELECT * FROM mahasiswa WHERE npm = '$npm'");
$rows = mysqli_num_rows($getdata);

$delete = "DELETE FROM mahasiswa WHERE npm = '$npm'";
$exedelete = mysqli_query($connection,$delete);

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
```

## Link
Link practice : https://juanasss.blogspot.com/2018/10/membuat-restful-api-crud-sederhana.html
