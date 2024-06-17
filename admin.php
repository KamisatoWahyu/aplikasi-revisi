<?php
$username = $_SESSION['username'];
$ambiladmin = mysqli_query($conn, "SELECT lvl, namaAdmin FROM login Where namaAdmin = '$username'");
$namaadmin = mysqli_fetch_array($ambiladmin);
$ambilnamanya = $namaadmin['namaAdmin'];
$lvladmin = $namaadmin['lvl'];
?>