<?php
include '../../koneksi.php';
// menyimpan data id kedalam variabel
$id_arsip   = $_GET['id_arsip'];
// query SQL untuk insert data
$query="DELETE from arsip where id_arsip='$id_arsip'";
mysqli_query($kon, $query);
// mengalihkan ke halaman index.php

header("location:../../index.php");



?>