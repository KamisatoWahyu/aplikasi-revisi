<?php
$username = $_SESSION['username'];
$ambiladmin = mysqli_query($conn, "SELECT lvl, username FROM login Where username = '$username'");
$namaadmin = mysqli_fetch_array($ambiladmin);
$ambilnamanya = $namaadmin['username'];
$lvladmin = $namaadmin['lvl'];
?>